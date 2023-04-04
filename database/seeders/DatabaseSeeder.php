<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        DB::table('barangays')->insert([
            [
                'name' => 'Balayhangin'
            ],
            [
                'name' => 'Bangyas'
            ],
            [
                'name' => 'Dayap'
            ],
            [
                'name' => 'Hanggan'
            ],
            [
                'name' => 'Imok'
            ],
            [
                'name' => 'Lamot 1'
            ],
            [
                'name' => 'Lamot 2'
            ],
            [
                'name' => 'Limao'
            ],
            [
                'name' => 'Mabacan'
            ],
            [
                'name' => 'Masiit'
            ],
            [
                'name' => 'Paliparan'
            ],
            [
                'name' => 'Perez'
            ],
            [
                'name' => 'Kanluran'
            ],
            [
                'name' => 'Silangan'
            ],
            [
                'name' => 'Prinza'
            ],
            [
                'name' => 'San Isidro'
            ],
            [
                'name' => 'Santo Tomas'
            ]
        ]);

        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin123')
        ]);
    }
}
