<?php

namespace App\Http\Controllers;
use App\Models\Event;
use App\Models\Category;
use App\Models\EventRegistration;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;




class EventRegistrationController extends Controller
{

    public function register(Request $request, Event $event)
    {
        // Kontroller: Kullanıcı giriş yapmış mı?
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Başvuru yapmak için giriş yapmalısınız.');
        }

        // Kontroller: Kayıt açık mı?
        if (!$event->isRegistrationOpen()) {
            return back()->with('error', 'Bu etkinlik için kayıt süresi dolmuş.');
        }

        // Kontroller: Yer var mı?
        if (!$event->hasAvailableSpots()) {
            return back()->with('error', 'Bu etkinlik için yer kalmamış.');
        }
        // Kontroller: Daha önce başvuru yapmış mı?
        $existingRegistration = EventRegistration::where([
            'event_id' => $event->id,
            'user_id' => auth()->id()
        ])->first();
        if ($existingRegistration) {
            return back()->with('error', 'Bu etkinliğe zaten başvuru yapmışsınız.');
        }
        // Başvuru oluştur
        EventRegistration::create([
            'event_id' => $event->id,
            'user_id' => auth()->id(),
            'status' => 'pending',
            'registered_at' => now()
        ]);
        return back()->with('success', 'Başvurunuz başarıyla alındı. Onay bekleniyor.');
    }
    public function cancel(Event $event)
    {
        $registration = EventRegistration::where([
            'event_id' => $event->id,
            'user_id' => auth()->id()
        ])->first();

        if ($registration) {
            $registration->update(['status' => 'cancelled']);
            return back()->with('success', 'Başvurunuz iptal edildi.');
        }

        return back()->with('error', 'İptal edilecek başvuru bulunamadı.');
    }

    public function showPage(Event $event){
        $userRegistration = null;
        if(auth()->check()) {
            $userRegistration = EventRegistration::where('event_id', $event->id)
                ->where('user_id', auth()->id())
                ->first();
        }

        return view('panel.events.show', [
            'event' => $event,
            'userRegistration' => $userRegistration
        ]);
    }

    //Tüm Eventregistrationdaki kayıtlar getir

    public function organizerPage()
    {
        $registrations = EventRegistration::where('organizer_id' ); // get() yerine all() kullanın

        // Kayıtların gelip gelmediğini kontrol edin
        if ($registrations->isEmpty()) {
            \Log::warning('Başvuru yok!');
        }

        return view('panel.eventRegistration.index')->with([
            'event_registrations' => $registrations,
            'statuses' => ['pending', 'approved', 'rejected', 'cancelled'] // Örnek ek veri
        ]);

    }






    // Organizer'ın etkinliklerine yapılan başvuruları listele
    public function organizerIndex()
    {
        $registrations = EventRegistration::join('events', 'event_registrations.event_id', '=', 'events.id')
            ->join('users', 'event_registrations.user_id', '=', 'users.id')
            ->where('events.organizer_id', auth()->id())
            ->select(
                'event_registrations.*',
                'events.title as event_title',
                'users.name as applicant_name',
                'users.email as applicant_email'
            )
            ->orderBy('event_registrations.registered_at', 'desc')
            ->get();

        return view('panel.eventRegistration.index', compact('registrations'));
    }

    // Başvuru durumunu güncelle
    public function updateStatus($registrationId, Request $request)
    {
        $registrations = EventRegistration::join('events', 'event_registrations.event_id', '=', 'events.id')
            ->where('event_registrations.id', $registrationId)
            ->where('events.organizer_id', auth()->id()) // Direkt güvenlik kontrolü
            ->select('event_registrations.*')
            ->first();

        if (!$registrations) {
            abort(403, 'Bu başvuruya erişim yetkiniz yok veya başvuru bulunamadı.');
        }

        $request->validate([
            'status' => 'required|in:pending,approved,rejected,cancelled'
        ]);

        $registrations->update([
            'status' => $request->status
        ]);

        return back()->with('success', 'Başvuru durumu güncellendi.');
    }

    // Kullanıcının kendi başvurularını listele
    public function myRegistrations()
    {
        $myRegistrations = EventRegistration::with('event')
            ->where('user_id', auth()->id())
            ->orderBy('registered_at', 'desc')
            ->get();

        return view('panel.eventRegistration.myRegistrations', compact('myRegistrations'));
    }


}
