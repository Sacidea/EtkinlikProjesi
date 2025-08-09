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
            $query->whereHas('categories', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });

        }
        //Arama
        if ($request->search) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $events = $query->paginate(12);
        $categories = Category::get();
       //KATEGORİ LİSTELEME
        $etkinlikler=Event::get();


        return view('panel.events.index', compact('events', 'categories','etkinlikler'));
    }


    //Yeni etkinlik oluşturma
    public function createPage()
    {
        $categories = Category::all(); // get() yerine all() kullanın

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
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after:start_date',
            'location' => 'required',
            'status' => 'required|in:active,draft',
            'category_id' => 'required|numeric'
        ]);


        $event=new Event();
        $event->title=$request->title;
        $event->description=$request->description;
        $event->start_date=$request->start_date;
        $event->end_date=$request->end_date;
        $event->status=$request->status;
        $event->category_id=(int)$request->category_id;
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
        return view('panel.events.show', compact('event', 'userRegistration'));
    }



    /**
     * Show the form for editing the specified resource.
     */

    //Admin sayfalarında ekstra işlemler için butonları gösterecek *****
    // app/Livewire/Events.php (mevcut component'ınız)

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
