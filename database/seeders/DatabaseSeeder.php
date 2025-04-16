<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TipePengaduan;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // Seeder Tipe Pengaduan
        $this->call([
            UserSeeder::class,
            TipePengaduanSeeder::class,
            StatusPengaduanSeeder::class,
        ]);
        
    }
}
