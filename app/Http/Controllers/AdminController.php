<?php

namespace App\Http\Controllers;

use App\Models\EventRegistration;
use App\Models\Event;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdminController extends Controller
{
    //Admin sayfasında tüm kayıtlar
    public function adminRegistrations(Request $request)
    {
        // Get all events with related organizer and registrations data
        $query = Event::with(['organizer', 'registrations']);

        // Arama filtresi
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
        }

        // Durum filtresi
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Tarih filtresi
        if ($request->filled('date')) {
            $today = Carbon::today();
            
            switch ($request->date) {
                case 'today':
                    $query->whereDate('start_date', $today);
                    break;
                case 'week':
                    $weekStart = $today->copy()->startOfWeek();
                    $weekEnd = $today->copy()->endOfWeek();
                    $query->whereBetween('start_date', [$weekStart, $weekEnd]);
                    break;
                case 'month':
                    $monthStart = $today->copy()->startOfMonth();
                    $monthEnd = $today->copy()->endOfMonth();
                    $query->whereBetween('start_date', [$monthStart, $monthEnd]);
                    break;
            }
        }

        $events = $query->latest()->get();

        // Kayıtların gelip gelmediğini kontrol edin
        if ($events->isEmpty()) {
            \Log::warning('Etkinlik yok!');
        }

        return view('panel.Admin.indexA')->with([
            'events' => $events,
            'statuses' => ['pending', 'approved', 'rejected', 'cancelled'],
            'total_registrations' => $events->count(),
        ]);
    }

    // Etkinlik durumunu güncelleme
    public function updateEventStatus(Request $request, $id)
    {
        $event = Event::findOrFail($id);
        
        $request->validate([
            'status' => 'required|in:published,draft,cancelled'
        ]);

        $event->update([
            'status' => $request->status
        ]);

        return redirect()->back()->with('success', 'Etkinlik durumu başarıyla güncellendi.');
    }

    // Excel export fonksiyonu
    public function exportToExcel()
    {
        // Excel export işlemi burada yapılacak
        return redirect()->back()->with('success', 'Excel export özelliği yakında eklenecek.');
    }

    // Etkinlik silme
    public function deleteEvent($id)
    {
        $event = Event::findOrFail($id);
        
        // Önce etkinliğe ait kayıtları sil
        $event->registrations()->delete();
        
        // Sonra etkinliği sil
        $event->delete();

        return redirect()->back()->with('success', 'Etkinlik başarıyla silindi.');
    }
}
