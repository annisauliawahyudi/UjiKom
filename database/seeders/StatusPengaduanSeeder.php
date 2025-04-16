<?php

namespace Database\Seeders;

use App\Models\StatusPengaduan;
use Illuminate\Database\Seeder;

class StatusPengaduanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $status = [
            'Pending',
            'Proses',
            'Selesai',
            'Tolak',
        ];

        foreach ($status as $item) {
            StatusPengaduan::create([
                'status_pengaduan' => $item
            ]);
        }
    }
}
