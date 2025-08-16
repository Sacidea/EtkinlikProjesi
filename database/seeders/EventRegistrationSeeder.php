<?php

namespace Database\Seeders;

use App\Models\EventRegistration;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class EventRegistrationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


       $eventRegistrations = [
            ['event_id' => 1,
            'user_id' => 1,
            'status' => 'approved',
            'notes' => 'Erken kayıt bonusu ile katılım',
            'registered_at' => Carbon::now()->subDays(25),
            'created_at' => Carbon::now()->subDays(25),
            'updated_at' => Carbon::now()->subDays(20),
        ],
            [
                'event_id' => 1,
                'user_id' => 2,
                'status' => 'approved',
                'notes' => 'Lin Pesto hayranı - ön sıra',
                'registered_at' => Carbon::now()->subDays(20),
                'created_at' => Carbon::now()->subDays(20),
                'updated_at' => Carbon::now()->subDays(15),
            ],
            [
                'event_id' => 1,
                'user_id' => 3,
                'status' => 'pending',
                'notes' => 'Ödeme onayı bekleniyor',
                'registered_at' => Carbon::now()->subDays(5),
                'created_at' => Carbon::now()->subDays(5),
                'updated_at' => Carbon::now()->subDays(5),
            ],

            // Event 2: Teknoloji ve Yapay Zeka Konferansı (2 hafta sonra) - Kayıt: 30 gün önce başladı, 1 hafta sonra bitiyor
            [
                'event_id' => 2,
                'user_id' => 4,
                'status' => 'approved',
                'notes' => 'VIP katılımcı - teknoloji uzmanı',
                'registered_at' => Carbon::now()->subDays(28),
                'created_at' => Carbon::now()->subDays(28),
                'updated_at' => Carbon::now()->subDays(25),
            ],
            [
                'event_id' => 2,
                'user_id' => 5,
                'status' => 'approved',
                'notes' => 'AI şirketi temsilcisi',
                'registered_at' => Carbon::now()->subDays(22),
                'created_at' => Carbon::now()->subDays(22),
                'updated_at' => Carbon::now()->subDays(20),
            ],
            [
                'event_id' => 2,
                'user_id' => 6,
                'status' => 'pending',
                'notes' => 'Şirket onayı bekleniyor',
                'registered_at' => Carbon::now()->subDays(3),
                'created_at' => Carbon::now()->subDays(3),
                'updated_at' => Carbon::now()->subDays(3),
            ],

            // Event 3: Doğa Yürüyüşü (10 gün sonra) - Kayıt: 15 gün önce başladı, 8 gün sonra bitiyor
            [
                'event_id' => 3,
                'user_id' => 7,
                'status' => 'approved',
                'notes' => 'Profesyonel fotoğrafçı',
                'registered_at' => Carbon::now()->subDays(12),
                'created_at' => Carbon::now()->subDays(12),
                'updated_at' => Carbon::now()->subDays(10),
            ],
            [
                'event_id' => 3,
                'user_id' => 8,
                'status' => 'approved',
                'notes' => 'Doğa yürüyüşü deneyimli',
                'registered_at' => Carbon::now()->subDays(8),
                'created_at' => Carbon::now()->subDays(8),
                'updated_at' => Carbon::now()->subDays(8),
            ],
            [
                'event_id' => 3,
                'user_id' => 9,
                'status' => 'cancelled',
                'notes' => 'Sağlık sorunu nedeniyle iptal',
                'registered_at' => Carbon::now()->subDays(10),
                'created_at' => Carbon::now()->subDays(10),
                'updated_at' => Carbon::now()->subDays(2),
            ],

            // Event 4: Girişimcilik Zirvesi (1 ay sonra) - Kayıt: şimdi başladı, 3 hafta sonra bitiyor - DRAFT durumda
            [
                'event_id' => 4,
                'user_id' => 10,
                'status' => 'pending',
                'notes' => 'Start-up kurucusu - onay bekliyor',
                'registered_at' => Carbon::now()->subDays(2),
                'created_at' => Carbon::now()->subDays(2),
                'updated_at' => Carbon::now()->subDays(2),
            ],
            [
                'event_id' => 4,
                'user_id' => 11,
                'status' => 'approved',
                'notes' => 'Ücretsiz etkinlik - genç girişimci',
                'registered_at' => Carbon::now()->subDay(),
                'created_at' => Carbon::now()->subDay(),
                'updated_at' => Carbon::now()->subDay(),
            ],

            // Event 5: Hamlet Tiyatro (2025-11-05) - Kayıt: 2025-09-15'te başladı, 2025-11-04'te bitiyor
            [
                'event_id' => 5,
                'user_id' => 12,
                'status' => 'approved',
                'notes' => 'Tiyatro abonesi - sezon bileti',
                'registered_at' => Carbon::create(2025, 9, 18, 14, 30),
                'created_at' => Carbon::create(2025, 9, 18, 14, 30),
                'updated_at' => Carbon::create(2025, 9, 20, 10, 15),
            ],
            [
                'event_id' => 5,
                'user_id' => 13,
                'status' => 'approved',
                'notes' => 'Shakespeare hayranı',
                'registered_at' => Carbon::create(2025, 9, 25, 16, 45),
                'created_at' => Carbon::create(2025, 9, 25, 16, 45),
                'updated_at' => Carbon::create(2025, 9, 26, 9, 30),
            ],

            // Event 6: Modern Dans (2025-12-03) - Kayıt: 2025-10-01'de başladı, 2025-12-02'de bitiyor
            [
                'event_id' => 6,
                'user_id' => 14,
                'status' => 'approved',
                'notes' => 'Dans öğretmeni - mesleki gelişim',
                'registered_at' => Carbon::create(2025, 10, 5, 12, 0),
                'created_at' => Carbon::create(2025, 10, 5, 12, 0),
                'updated_at' => Carbon::create(2025, 10, 6, 8, 20),
            ],
            [
                'event_id' => 6,
                'user_id' => 15,
                'status' => 'pending',
                'notes' => 'Grup bileti için onay bekleniyor',
                'registered_at' => Carbon::create(2025, 10, 12, 18, 30),
                'created_at' => Carbon::create(2025, 10, 12, 18, 30),
                'updated_at' => Carbon::create(2025, 10, 12, 18, 30),
            ],

            // Event 7: Sanat Fuarı (2025-10-15 - 2025-10-22) - Kayıt: 2025-08-01'de başladı, 2025-10-10'da bitiyor
            [
                'event_id' => 7,
                'user_id' => 16,
                'status' => 'approved',
                'notes' => 'Sanatçı - stant sahibi',
                'registered_at' => Carbon::create(2025, 8, 5, 10, 0),
                'created_at' => Carbon::create(2025, 8, 5, 10, 0),
                'updated_at' => Carbon::create(2025, 8, 8, 14, 30),
            ],
            [
                'event_id' => 7,
                'user_id' => 17,
                'status' => 'approved',
                'notes' => 'El sanatları meraklısı - atölye katılımı',
                'registered_at' => Carbon::create(2025, 8, 15, 16, 20),
                'created_at' => Carbon::create(2025, 8, 15, 16, 20),
                'updated_at' => Carbon::create(2025, 8, 16, 11, 45),
            ],
            [
                'event_id' => 7,
                'user_id' => 18,
                'status' => 'approved',
                'notes' => 'Sanat koleksiyoncusu',
                'registered_at' => Carbon::create(2025, 9, 1, 13, 15),
                'created_at' => Carbon::create(2025, 9, 1, 13, 15),
                'updated_at' => Carbon::create(2025, 9, 2, 9, 30),
            ],

            // Ek kayıtlar - farklı eventlere dağıtılmış
            [
                'event_id' => 1,
                'user_id' => 19,
                'status' => 'rejected',
                'notes' => 'Kapasite dolu - bekleme listesinde',
                'registered_at' => Carbon::now()->subDays(2),
                'created_at' => Carbon::now()->subDays(2),
                'updated_at' => Carbon::now()->subDays(1),
            ],
            [
                'event_id' => 2,
                'user_id' => 20,
                'status' => 'cancelled',
                'notes' => 'İş seyahati çakışması nedeniyle iptal',
                'registered_at' => Carbon::now()->subDays(15),
                'created_at' => Carbon::now()->subDays(15),
                'updated_at' => Carbon::now()->subDays(3),
            ]
        ];
       foreach ($eventRegistrations as $eventRegistration) {
           EventRegistration::create($eventRegistration);
       }
    }
}
