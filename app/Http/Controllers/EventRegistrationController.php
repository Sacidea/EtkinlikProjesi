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

    public function show(Request $request, Event $event)
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

    }
