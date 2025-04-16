@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="p-4 sm:ml-64">
        <div class="p-4 mt-4">
                <div class="bg-white p-6 rounded shadow mb-4">
                    <h3 class="font-semibold text-xl mb-6 text-center">Statistik Pengaduan</h3>
                    <div class="grid grid-cols-2 gap-4 items-center">
                        <!-- Chart Batang -->
                        <div>
                            <h4 class="text-center font-medium mb-2">Status Pengaduan</h4>
                            <canvas id="barChart" width="400" height="200"></canvas>
                        </div>

                        <!-- Chart Pie -->
                        <div class="flex flex-col items-center">
                            <h4 class="text-center font-medium mb-2">Provinsida Terbanyak Pengaduan</h4>
                            <canvas id="pieChart" width="250" height="250"></canvas>
                        </div>
                    </div>
                </div>
        </div>
    </div>
@endsection
