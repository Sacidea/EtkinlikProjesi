<?php
// app/Models/Category.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Otomatik slug oluşturma
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($category) {
            if (empty($category->slug)) {
                $category->slug = Str::slug($category->name);
            }
        });

        static::updating(function ($category) {
            if ($category->isDirty('name') && empty($category->slug)) {
                $category->slug = Str::slug($category->name);
            }
        });
    }

    // Event'lerle many-to-many ilişki
    public function events()
    {
        return $this->belongsToMany(Event::class, 'event_category');
    }

    // Kategori URL'si için
    public function getRouteKeyName()
    {
        return 'slug';
    }

    // Kategori içindeki etkinlik sayısı
    public function getEventsCountAttribute()
    {
        return $this->events()->count();
    }

    // Aktif etkinlikleri getir
    public function activeEvents()
    {
        return $this->events()
            ->where('status', 'published')
            ->where('registration_end', '>', now());
    }

    // Scope'lar
    public function scopeWithEventsCount($query)
    {
        return $query->withCount('events');
    }

    public function scopeHasEvents($query)
    {
        return $query->has('events');
    }
}
