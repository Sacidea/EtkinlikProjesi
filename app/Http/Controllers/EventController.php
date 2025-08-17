<?php

namespace App\Http\Controllers;
use App\Models\Event;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
       //LİSTELEME
        $etkinlikler = Event::where('status', 'published')
            ->where('registration_end', '>', now())
            ->get();


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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Resim yükleme işlemi
        $imagePath = null;
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $imagePath = $request->file('image')->store('public/events', 'public');
        }

        // Etkinlik oluşturma
        $event = new Event();
        $event->title = $request->title;
        $event->description = $request->description;
        $event->location = $request->location;
        $event->start_date = $request->start_date;
        $event->end_date = $request->end_date;
        $event->status = $request->status;
        $event->organizer_id = auth()->id();
        $event->image = $imagePath;
        $event->registration_start = now();
        $event->registration_end = now()->addWeek();
        $event->category_id = $request->category_id;
        $event->save();

        return redirect()->route('event.index')
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
    public function organizerIndex()
    {
        $events = Event::where('organizer_id', auth()->id())
            ->get();

        return view('panel.events.myEvent', compact('events'));
    }






    public function eventUpdatePage( Event $myEvent)
    {



        $categories = Category::all();


        return view('panel.events.myEventUpdate',compact('myEvent','categories') );//redirect kullandığım için hata aldım sonsuz döngüye sebep oldu view kullanılmalı
        }

    public function update(Request $request)
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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $event = Event::find($request->id);
        // Resim yükleme işlemi

        // Resim yükleme işlemi (sadece yeni resim yüklenirse)
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            // Eski resmi sil
            if ($event->image) {
                Storage::disk('public')->delete($event->image);
            }

            $validated['image'] = $request->file('image')->store('events', 'public');
        }

        // Sadece değişen alanları güncelle
        $event->update($validated);

        return redirect()->route('organizer.index')
            ->with('success', 'Etkinlik başarıyla güncellendi!');
    }


    public function eventDelete(Event $myEvent)
    {
        // Yetki kontrolü - sadece etkinlik sahibi silebilir
        if ($myEvent->organizer_id != auth()->id()) {
            abort(403, 'Bu işlem için yetkiniz yok.');
        }

        $myEvent->delete();

        return redirect()->route('organizer.index')
            ->with('success', 'Etkinlik başarıyla silindi.');
    }
}
