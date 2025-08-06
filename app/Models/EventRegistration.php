<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Event; // Bu satırı ekleyin
use App\Models\Category;
class EventRegistration extends Model
{
    protected $fillable = [
        'event_id', 'user_id', 'status', 'notes', 'registered_at'
    ];

    protected $casts = [
        'registered_at' => 'datetime'
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
