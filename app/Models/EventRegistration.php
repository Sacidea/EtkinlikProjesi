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






}
