<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{    use SoftDeletes;
    /**
     * @var \Illuminate\Support\Carbon|mixed
     */

    protected $table = 'events';

    protected $fillable = [  //Laravel'de "toplu atanabilir (mass assignable)" alanları tanımlamak için kullanılır.
        'title', 'description', 'image', 'location',
        'start_date', 'end_date', 'registration_start',
        'registration_end', 'max_participants', 'price',
        'status', 'organizer_id'
    ];



    protected $casts = [   // Veritabanındaki bu alanlar, belirtilen türlerde otomatik olarak çevrilir.
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'registration_start' => 'datetime',
        'registration_end' => 'datetime',
        'price' => 'decimal:2'
    ];




    // İlişkiler


    public function organizer()
    {
        return $this->belongsTo(User::class, 'organizer_id');
    }

    public function registrations()
    {
        return $this->hasMany(EventRegistration::class);
    }

    public function categories()
    {
        return $this->belongsTo(Category::class);
    }



    // Helper metodlar
    public function isRegistrationOpen(): bool//Kayıtların şu an açık olup olmadığını kontrol eder.
    {
        return now()->between($this->registration_start, $this->registration_end);//now(), registration_start ve registration_end aralığında mı?
    }

    public function hasAvailableSpots(): bool//Etkinlikte boş kontenjan olup olmadığını kontrol eder
    {
        if (!$this->max_participants) return true;//Eğer max_participants belirtilmemişse (null), her zaman true (sınırsız katılım).
        return $this->registrations()->where('status', 'approved')->count() < $this->max_participants;//Belirtilmişse, onaylı (approved) kayıt sayısı kontenjanı aşmış mı?
    }
}
