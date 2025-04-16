<?php

namespace App\Exports;

use App\Models\Pengaduan;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Events\AfterSheet;

class ReportExcel implements FromCollection, WithMapping, WithEvents, WithCustomStartCell
{
    public function collection()
    {
        $user = Auth::user();

        if (!$user) {
            return Pengaduan::with(['user', 'tipePengaduan', 'status'])->get();
        }

        if ($user->role === 'masyarakat') {
            return Pengaduan::with(['user', 'tipePengaduan', 'status'])->where('user_id', $user->id)->get();
        }

        if ($user->role === 'petugas') {
            return Pengaduan::with(['user', 'tipePengaduan', 'status'])->where('provinsi', $user->provinsi)->get();
        }

        return Pengaduan::with(['user', 'tipePengaduan', 'status'])->get();
    }

    public function map($pengaduan): array
    {
        return [
            $pengaduan->created_at ? $pengaduan->created_at->format('d-m-Y') : '-',
            $pengaduan->user->name ?? 'Tidak diketahui',
            $pengaduan->tipePengaduan->nama ?? 'Tidak ada tipePengaduan',
            $pengaduan->status->status_pengaduan ?? 'Tidak diketahui',
            $pengaduan->provinsi,
            $pengaduan->kota_kabupaten,
            $pengaduan->kecamatan,
            $pengaduan->kelurahan,
            $pengaduan->keluhan,
            asset('storage/' . $pengaduan->gambar),
        ];
    }

    public function startCell(): string
    {
        return 'A3'; // Data dimulai dari baris ke-3
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                // Judul di A1
                $event->sheet->setCellValue('A1', 'DAFTAR LAPORAN PENGADUAN MASYARAKAT');
                $event->sheet->mergeCells('A1:J1');
                $event->sheet->getDelegate()->getStyle('A1')->getFont()->setBold(true)->setSize(14);
                $event->sheet->getDelegate()->getStyle('A1')->getAlignment()->setHorizontal('center');

                // Manual heading di A2:J2
                $headings = [
                    'Tanggal',
                    'Nama Pelapor',
                    'Tipe Pengaduan',
                    'Status Pengaduan',
                    'Provinsi',
                    'Kota/Kabupaten',
                    'Kecamatan',
                    'Kelurahan',
                    'Isi Laporan',
                    'Gambar',
                ];

                $column = 'A';
                foreach ($headings as $heading) {
                    $event->sheet->setCellValue($column . '2', $heading);
                    $column++;
                }

                // Bold header
                $event->sheet->getDelegate()->getStyle('A2:J2')->getFont()->setBold(true);
                $event->sheet->getDelegate()->getStyle('A2:J2')->getAlignment()->setHorizontal('center');
            },
        ];
    }
}
