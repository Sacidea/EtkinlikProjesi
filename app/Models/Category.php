<?php
// app/Models/Category.php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{


   // public mixed $name;// mixed $name 'in herhangi bir türde değer alabileceğini belirtir
    protected $fillable = [//toplu atamada hangi alanlara atama yapılacağını belirtir
        'name',
        'slug',
        'description',
    ];

    protected $casts = [             // created_at ve updated_at alanlarını Carbon datetime nesnesine dönüştürür
                                     // Laravel'in otomatik timestamp yönetimini aktif hale getirir
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

    // Event'lerle ilişki (bir kategorinin birden çok etkinliği olabilir)
    public function events()
    {
        return $this->hasMany(Event::class, 'category_id');
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
    #[Scope]
    protected function withEventsCount($query)
    {
        return $query->withCount('events');
    }

    #[Scope]
    protected function hasEvents($query)
    {
        return $query->has('events');
    }
}
