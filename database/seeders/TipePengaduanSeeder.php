<?php

namespace Database\Seeders;

use App\Models\TipePengaduan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipePengaduanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tipe = [
            'Sosial',
            'Infrastruktur',
            'Layanan Publik',
            'Lingkungan',
        ];

        foreach ($tipe as $item) {
            TipePengaduan::create([
                'nama' => $item
            ]);
        }
    }
}
