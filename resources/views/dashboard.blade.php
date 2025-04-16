@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="p-4 sm:ml-64">
        <div class="p-4 mt-4">
            @if (Auth::user()->role == 'admin')    
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
            @elseif (Auth::user()->role == 'petugas')
                @include('petugas.index')
            @elseif (Auth::user()->role == 'masyarakat')
                @include('masyarakat.index')
            @endif
        </div>
    </div>
    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil Login!',
                    text: '{{ session('success') }}',
                    confirmButtonText: 'Lanjutkan',
                });
            });
        </script>
    @endif
    <script src="{{ asset('tailwind/js/apexcharts.min.js') }}"></script>
    <script src="{{ asset('tailwind/js/flowbite.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endsection
