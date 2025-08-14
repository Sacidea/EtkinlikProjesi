<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        $categories = [
            [
                'name'=>'Tiyatro ve Sahne Sanatları',
                'description'=>'Tiyatro oyunları, dans gösterileri, opera ve bale performansları'
            ],

            [
                'name' => 'Konserler ve Müzik Etkinlikleri',
                'description' => ' Canlı müzik performansları, konserler, festivaller ve diğer müzik etkinlikleri'
            ],
            [
                'name' => 'Sergi ve Fuarlar',
                'description' => 'Sanat sergileri, ticari fuarlar, fotoğraf ve el sanatları sergileri'
            ],
            [
                'name' => 'Eğitim ve Seminerler',
                'description' => 'Konferanslar, workshoplar, eğitim programları ve kişisel gelişim etkinlikleri'
            ],

            [
            'name' => 'festivaller-ve-ozel-etkinlikler',
            'description' => 'Yerel festivaller, kültürel etkinlikler, özel gün kutlamaları'
        ]
        ];

        foreach ($categories as $category) {
            Category::create($category); // Slug otomatik oluşturulur
        }

    }
}
