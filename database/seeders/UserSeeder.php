<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
            ],
            [
                'name' => 'masyarakat',
                'email' => 'masyarakat@gmail.com',
                'password' => Hash::make('masyarakat123'),
                'role' => 'masyarakat',
            ],
        ];

        $provinces = [
            'aceh' => 'ACEH',
            'bali' => 'BALI',
            'banten' => 'BANTEN',
            'bengkulu' => 'BENGKULU',
            'diy' => 'DI YOGYAKARTA',
            'dki' => 'DKI JAKARTA',
            'gorontalo' => 'GORONTALO',
            'jambi' => 'JAMBI',
            'jabar' => 'JAWA BARAT',
            'jateng' => 'JAWA TENGAH',
            'jatim' => 'JAWA TIMUR',
            'kalbar' => 'KALIMANTAN BARAT',
            'kalsel' => 'KALIMANTAN SELATAN',
            'kalteng' => 'KALIMANTAN TENGAH',
            'kaltim' => 'KALIMANTAN TIMUR',
            'kalut' => 'KALIMANTAN UTARA',
            'babel' => 'KEPULAUAN BANGKA BELITUNG',
            'kepri' => 'KEPULAUAN RIAU',
            'lampung' => 'LAMPUNG',
            'maluku' => 'MALUKU',
            'malut' => 'MALUKU UTARA',
            'ntb' => 'NUSA TENGGARA BARAT',
            'ntt' => 'NUSA TENGGARA TIMUR',
            'papua' => 'PAPUA',
            'pabar' => 'PAPUA BARAT',
            'riau' => 'RIAU',
            'sulbar' => 'SULAWESI BARAT',
            'sulsel' => 'SULAWESI SELATAN',
            'sulteng' => 'SULAWESI TENGAH',
            'sultra' => 'SULAWESI TENGGARA',
            'sulut' => 'SULAWESI UTARA',
            'sumbar' => 'SUMATERA BARAT',
            'sumsel' => 'SUMATERA SELATAN',
            'sumut' => 'SUMATERA UTARA',
        ];

        foreach ($provinces as $code => $name) {
            User::create([
                'name' => 'petugas' . strtoupper($code),
                'email' => $code . '@gmail.com',
                'password' => Hash::make($code . '123'),
                'role' => 'petugas',
                'provinsi' => $name,
            ]);
        }

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
