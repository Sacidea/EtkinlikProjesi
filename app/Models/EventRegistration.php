<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Event; // Bu satırı ekleyin
use App\Models\Category;
use Illuminate\Database\Eloquent\SoftDeletes;

class EventRegistration extends Model

{
    use SoftDeletes;
    protected $table = 'event_registrations';
    protected $fillable = [
        'event_id', 'user_id', 'status', 'notes', 'registered_at'
    ];

    protected $casts = [
        'registered_at' => 'datetime'
    ];




    public function event(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }



// EventRegistration modelinde
    public function getStatusColorAttribute()
    {
        return match($this->status) {
            'pending' => 'warning',
            'approved' => 'success',
            'cancelled' => 'secondary',
            'rejected' => 'danger',
            default => 'info'
        };
    }

    public function getStatusTextAttribute()
    {
        return match($this->status) {
            'pending' => 'Beklemede',
            'approved' => 'Onaylandı',
            'cancelled' => 'İptal Edildi',
            'rejected' => 'Reddedildi',
            default => 'Bilinmeyen'
        };
    }

    public function canBeCancelled()
    {
        return $this->status === 'pending' &&
            $this->event->start_date > now();
    }


}
