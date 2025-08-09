<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Event;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //
    public function createPage(Event $event)
    {
        return view('panel.categories.create');

    }

    public function create(Request $request){
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'description' => 'nullable|string'
        ]);

        // Veritabanına kayıt
        try {
            Category::create($validated);
            return redirect()->route('events.index')->with('success', 'Kategori eklendi');
        } catch (\Exception $e) {
            \Log::error('Kategori ekleme hatası: '.$e->getMessage());
            return back()->withInput()->with('error', 'Kategori eklenemedi: '.$e->getMessage());
        }



    }
}
