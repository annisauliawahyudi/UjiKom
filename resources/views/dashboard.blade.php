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
                        <h4 class="text-center font-medium mb-2">Provinsi Terbanyak Pengaduan</h4>
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

    @if (!empty($statusCounts))
    <script>
        // Bar Chart (Status)
        const barCtx = document.getElementById('barChart').getContext('2d');
        new Chart(barCtx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($statusCounts->keys()) !!},
                datasets: [{
                    label: 'Jumlah Pengaduan',
                    data: {!! json_encode($statusCounts->values()) !!},
                    backgroundColor: ['#D1D5DB','#84E1BC', '#A4CAFE', '#ff6666']
                }]
            }
        });
    </script>
@endif

@if (!empty($topDaerah))
    <script>
        // Pie Chart (Top 5 Daerah)
        const pieCtx = document.getElementById('pieChart').getContext('2d');
        new Chart(pieCtx, {
            type: 'pie',
            data: {
                labels: {!! json_encode($topDaerah->pluck('provinsi')) !!},
                datasets: [{
                    data: {!! json_encode($topDaerah->pluck('total')) !!},
                    backgroundColor: ['#FF6384', '#D1D5DB','#84E1BC', '#A4CAFE', '#FACA15']
                }]
            },
            options: {
                responsive: false,
                maintainAspectRatio: false,
                width: 250,
                height: 250
            }
        });
    </script>
@endif
@endsection
