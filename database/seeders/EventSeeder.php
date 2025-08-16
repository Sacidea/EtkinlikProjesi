<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Event;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $events = [
            [
                'title'=> 'Lin Pesto “KABUL” Albüm Lansman Konseri',
                'description'=>'Ankara’da doğan ve hayatı boyunca orada yaşayan Lin Pesto’nun kayıt teknolojileri ve pop müziğe karşı ilgisi, YouTube’da paylaştığı cover’lara ve kendi bestelediği şarkılara kadar uzandı. Bülent Ersoy’un Maazallah şarkısının yorumuyla binlerce kişiye erişti. 2019’da prodüktörlüğünü Taner Yücel’in üstlendiği SON isimli, synth-pop ağırlıklı ilk kısaçalarını yayımladı. 2024 başında ‘Üzgün’ ve ‘Gözyaşı Odası’ adlı teklileriyle sessizliğini bozan Lin Pesto, ilk uzunçaları KABUL’ün lansmanı için Salon’un yolunu tutuyor.',
                'image'=>'Event1.jpg',
                'location'=>'Salon1',
                'start_date' => '2025-09-01 14:30:00',
                'end_date' => '2025-09-01 14:30:00',
                'registration_start' => Carbon::now()->subDays(30)->format('Y-m-d H:i:s'),
                'registration_end' => Carbon::now()->addWeek()->format('Y-m-d H:i:s'),
                'max_participants' => 200,
                'price' => 299.99,
                'status' => 'published',
                'organizer_id' => 3, // Bu ID'nin users tablosunda olması gerekiyor
                'category_id' => 2,  // Bu ID'nin categories tablosunda olması gerekiyor
                'created_at' => Carbon::now(),


            ],

               [ 'title' => 'Teknoloji ve Yapay Zeka Konferansı',
                'description' => 'Yapay zeka, makine öğrenmesi ve gelişen teknolojiler hakkında uzmanlardan bilgi alın. Sektörün önde gelen isimleri deneyimlerini paylaşacak.',
                'image' => 'Event2.jpg',
                'location' => 'İstanbul Kongre Merkezi, Harbiye',
                'start_date' => Carbon::now()->addWeeks(2)->format('Y-m-d H:i:s'),
                'end_date' => Carbon::now()->addWeeks(2)->addHours(8)->format('Y-m-d H:i:s'),
                'registration_start' => Carbon::now()->subDays(30)->format('Y-m-d H:i:s'),
                'registration_end' => Carbon::now()->addWeek()->format('Y-m-d H:i:s'),
                'max_participants' => 500,
                'price' => 299.99,
                'status' => 'published',
                'organizer_id' => 3, // Bu ID'nin users tablosunda olması gerekiyor
                'category_id' => 4,  // Bu ID'nin categories tablosunda olması gerekiyor
                'created_at' => Carbon::now(),

                   ],
            [
                'title' => 'Doğa Yürüyüşü ve Fotoğraf Turu',
                'description' => 'Beykoz Koruları\'nda profesyonel rehber eşliğinde doğa yürüyüşü ve fotoğraf çekimi etkinliği. Tüm seviyelerden katılımcılara açık.',
                'image' => 'Event3.jpg',
                'location' => 'Beykoz Koruları, İstanbul',
                'start_date' => Carbon::now()->addDays(10)->setTime(9, 0)->format('Y-m-d H:i:s'),
                'end_date' => Carbon::now()->addDays(10)->setTime(16, 0)->format('Y-m-d H:i:s'),
                'registration_start' => Carbon::now()->subDays(15)->format('Y-m-d H:i:s'),
                'registration_end' => Carbon::now()->addDays(8)->format('Y-m-d H:i:s'),
                'max_participants' => 25,
                'price' => 75.00,
                'status' => 'published',
                'organizer_id' => 3,
                'category_id' => 4,
                'created_at' => Carbon::now(),

            ],
            [
                'title' => 'Girişimcilik ve İnovasyon Zirvesi',
                'description' => 'Genç girişimciler için networking ve eğitim etkinliği. Start-up dünyasından başarılı isimler deneyimlerini paylaşacak ve yatırımcılarla buluşma fırsatı.',
                'image' => 'Event4.jpg', // nullable alan için null değer
                'location' => 'Ankara Ticaret Odası Kongre Merkezi',
                'start_date' => Carbon::now()->addMonth()->setTime(10, 0)->format('Y-m-d H:i:s'),
                'end_date' => Carbon::now()->addMonth()->setTime(18, 0)->format('Y-m-d H:i:s'),
                'registration_start' => Carbon::now()->format('Y-m-d H:i:s'),
                'registration_end' => Carbon::now()->addWeeks(3)->format('Y-m-d H:i:s'),
                'max_participants' => 200,
                'price' => 0, // Ücretsiz etkinlik
                'status' => 'draft', // Henüz yayınlanmamış
                'organizer_id' => 3,
                'category_id' => 3,
                'created_at' => Carbon::now(),

            ],
            [
                'title' => 'Hamlet - Klasik Tiyatro Oyunu',
                'description' => 'Shakespeare\'in ölümsüz eseri Hamlet, usta oyuncular tarafından modern bir yorumla sahneleniyor. İki perde arası 20 dakika mola.',
                'image' => 'Event5.jpg',
                'location' => 'İstanbul Devlet Tiyatrosu, Beyoğlu',
                'start_date' => '2025-11-05 20:00:00',
                'end_date' => '2025-11-05 22:30:00',
                'registration_start' => '2025-09-15 09:00:00',
                'registration_end' => '2025-11-04 18:00:00',
                'max_participants' => 350,
                'price' => 120.00,
                'status' => 'published',
                'organizer_id' => 3,
                'category_id' => 1, // Sahne Sanatları ve Tiyatro kategorisi
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'Modern Dans Gösterisi: "Rüya"',
                'description' => 'Genç koreografların hazırladığı çağdaş dans performansı. Müzik, hareket ve ışığın büyülü birleşimi. Gösterim sonrası sanatçılarla sohbet.',
                'image' => 'Event6.jpg',
                'location' => 'Ankara Opera Sahnesi, Ulus',
                'start_date' => '2025-12-03 19:30:00',
                'end_date' => '2025-12-03 21:00:00',
                'registration_start' => '2025-10-01 12:00:00',
                'registration_end' => '2025-12-02 17:00:00',
                'max_participants' => 280,
                'price' => 85.50,
                'status' => 'published',
                'organizer_id' => 3,
                'category_id' => 1, // Sahne Sanatları ve Tiyatro kategorisi
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                ],
            [
                'title' => 'İstanbul Sanat ve El Sanatları Fuarı',
                'description' => 'Geleneksel Türk el sanatları, modern sanat eserleri ve zanaat ürünlerinin sergilendiği büyük fuar. Sanatçılarla buluşma ve atölye deneyimi fırsatı.',
                'image' => 'Event7.jpg',
                'location' => 'CNR Expo İstanbul, Yeşilköy',
                'start_date' => '2025-10-15 10:00:00',
                'end_date' => '2025-10-22 18:00:00',
                'registration_start' => '2025-08-01 00:00:00',
                'registration_end' => '2025-10-10 23:59:59',
                'max_participants' => 1000,
                'price' => 45.00,
                'status' => 'published',
                'organizer_id' => 3,
                'category_id' => 3, // Sergi ve Fuar kategorisi
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]

        ];
        foreach ($events as $event) {
            Event::create($event);
        }
    }
}
