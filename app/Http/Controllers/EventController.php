<?php

namespace App\Http\Controllers;
use App\Models\Event;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)//"Yayınlanmış (published) ve kayıt süresi bitmemiş (registration_end > şu an)
        // etkinlikleri, organizatör (organizer) ve kategorileri (categories) ile birlikte listeler."
    {
        $query = Event::with(['organizer', 'categories'])  //Bu kod, yayınlanmış (published) ve kayıt bitiş tarihi henüz geçmemiş etkinlikleri,
                                                           // organizatör ve kategorileriyle birlikte getiren bir veritabanı sorgusu oluşturur.
            ->where('status', 'published')
            ->where('registration_end', '>', now());

        // Kategori filtresi
        if ($request->category) {
            $query->whereHas('categories', function ($q) use ($request) {//whereHas metodu, modelin "categories" ilişkisine sahip kayıtlarını filtreler.
                                                                                 //Yani sadece belirli bir kategoriyle ilişkilendirilmiş kayıtları getirir.
                $q->where('slug', $request->category);                           //use ($request) ile dış scope'daki $request değişkenini içeriye aktarır
            });

        }
        //Arama
        if ($request->search) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $events = $query->paginate(12);//Sayfada 12 şerli gruplarla listeyi gösterir
        $categories = Category::all();
       //KATEGORİ LİSTELEME
        $etkinlikler=Event::all();


        return view('panel.events.index', compact('events', 'categories','etkinlikler'));
    }


    //Yeni etkinlik oluşturma Sayfası
    public function createPage()
    {
        $categories = Category::all();

        // Kategorilerin gelip gelmediğini kontrol edin
        if ($categories->isEmpty()) {
            \Log::warning('Kategoriler boş!');
        }

        return view('panel.events.create')->with([

           'categories' => $categories,
            'statuses' => ['active', 'draft'] // Örnek ek veri
        ]);
    }



    public function create(Request $request)
    {
        // Validation kuralları
             $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'location' => 'required',
            'status' => 'required|in:published,draft',
            'category_id' => 'required|numeric',
             'image' =>   'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $imagePath = $request->file('image')->store('public/'. '$request->image');

        $event=new Event();//model ile veri tabanına kayıt
        $event->title=$request->title;
        $event->description=$request->description;
        $event->location=$request->location;
        $event->start_date=$request->start_date;
        $event->end_date=$request->end_date;
        $event->status=$request->status;
        $event->organizer_id= auth()->id();
        $event->image=$request->$imagePath;
        $event->registration_start = now();
        $event->registration_end = now()->addWeek();
        $event->category_id=$request->category_id;
        $event->save();


        // Kullanıcıya bağlı olarak etkinlik oluştur
        //$event = auth()->create($validated);

        return redirect()->route('events.index')
            ->with('success', 'Etkinlik başarıyla oluşturuldu!');
    }


    /**
     * Show the form for creating a new resource.
     */

    /**
     * Store a newly created resource in storage.
     */


    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        $event->load(['organizer', 'categories', 'registrations']);
        $userRegistration = null;

        if (auth()->check()) {
            $userRegistration = $event->registrations()
                ->where('user_id', auth()->id())
                ->first();
        }
        return view('panel.events.show', compact('event', 'userRegistration'));//show sayfasında kullanılacak
    }



    /**
     * Show the form for editing the specified resource.
     */



    public function mount()
    {
        // Admin ise özel yetkiler ver
        $this->isAdmin = auth()->user()->is_admin ?? false;
    }

    public $isAdmin = false;

// Sadece admin silebilir
    public function delete($id)
    {
        if (!$this->isAdmin) {
            session()->flash('error', 'Bu işlem için admin yetkisi gerekli!');
            return;
        }

        Event::find($id)->delete();
        session()->flash('message', 'Etkinlik silindi.');
    }

// Sadece admin düzenleyebilir
    public function edit($id)
    {
        if (!$this->isAdmin) {
            session()->flash('error', 'Bu işlem için admin yetkisi gerekli!');
            return;
        }

        // Düzenleme kodları...
    }
    //******

}
