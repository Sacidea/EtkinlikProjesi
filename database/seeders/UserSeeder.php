<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [   //$user değişkeni aşağıdaki foreach içinde tanımlanıyor

            ['name' => 'Admin',
                'role' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('12345678'),
                'email_verified_at' => now()
            ],
            ['name' => 'organizer',
                'role' => 'organizer',
                'email' => 'organizer@gmail.com',
                'password' => bcrypt('12345678'),
                'email_verified_at' => now()
            ],

            ['name' => 'organizer2',
            'role' => 'organizer',
            'email' => 'organizer2@gmail.com',
            'password' => bcrypt('12345678'),
            'email_verified_at' => now()
           ],
            ['name' => 'katilimci',
                'role' => 'participant',
                'email' => 'katilimci@gmail.com',
                'password' => bcrypt('12345678'),
                'email_verified_at' => now()
            ],

            ['name' => 'Ayşe Demir',
                'role' => 'participant',
                'email' =>'participant'.Str::random(8).'@gmail.com',
                'password' => bcrypt('12345678'),
                'email_verified_at' => now()
            ],

            ['name' => 'Zeynep Çelik',
                'role' => 'participant',
                'email' =>'participant'.Str::random(8).'@gmail.com',
                'password' => bcrypt('12345678'),
                'email_verified_at' => now()
            ],

            ['name' => 'Deniz Alaz',
                'role' => 'participant',
                'email' =>'participant'.Str::random(8).'@gmail.com',
                'password' => bcrypt('12345678'),
                'email_verified_at' => now()
            ],
            ['name' => 'Arda Nova',
                'role' => 'participant',
                'email' =>'participant'.Str::random(8).'@gmail.com',
                'password' => bcrypt('12345678'),
                'email_verified_at' => now()
            ],
            ['name' => 'Elif Öztürk',
                'role' => 'participant',
                'email' =>'participant'.Str::random(8).'@gmail.com',
                'password' => bcrypt('12345678'),
                'email_verified_at' => now()
            ],
            ['name' => 'Kuzey Atlas',
                'role' => 'participant',
                'email' =>'participant'.rand(1, 100).'@gmail.com',
                'password' => bcrypt('12345678'),
                'email_verified_at' => now()
            ],
            ['name' => 'Alp Tekin',
                'role' => 'participant',
                'email' =>'participant'.rand(1, 100).'@gmail.com',
                'password' => bcrypt('12345678'),
                'email_verified_at' => now()
            ],
            ['name' => 'Cemre Deniz',
                'role' => 'participant',
                'email' =>'participant'.rand(1, 100).'@gmail.com',
                'password' => bcrypt('12345678'),
                'email_verified_at' => now()
            ],
            ['name' => 'Efe Can',
                'role' => 'participant',
                'email' =>'participant'.rand(1, 100).'@gmail.com',
                'password' => bcrypt('12345678'),
                'email_verified_at' => now()
            ],
            ['name' => 'Elis Ayna',
                'role' => 'participant',
                'email' =>'participant'.Str::random(8).'@gmail.com',
                'password' => bcrypt('12345678'),
                'email_verified_at' => now()
            ],
            ['name' =>'Lara İdil',
                'role' => 'participant',
                'email' =>'participant'.Str::random(8).'@gmail.com',
                'password' => bcrypt('12345678'),
                'email_verified_at' => now()
            ],


        ];


        foreach ($users as $user) {
            User::create($user);
        }
    }

}
