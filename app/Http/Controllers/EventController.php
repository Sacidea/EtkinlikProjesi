<?php

namespace App\Http\Controllers;
use App\Models\Event;
use App\Models\EventRegistration;
use App\Models\Category;

use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)//"Yayınlanmış (published) ve kayıt süresi bitmemiş (registration_end > şu an)
        // etkinlikleri, organizatör (organizer) ve kategorileri (categories) ile birlikte listeler."
    {
        $query = Event::with(['organizer', 'categories'])
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
            $query->where('title', 'like', '%'.$request->search.'%');
        }

        $events = $query->paginate(12);
        $categories = Category::all();


        return view('events.index', compact('events', 'categories'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

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
        return view('events.show', compact('event', 'userRegistration'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
