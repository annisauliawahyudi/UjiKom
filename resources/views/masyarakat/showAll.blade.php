@extends('layouts.app')

@section('title', 'Daftardmin')

@section('content')
<h1 class="text-4xl font-bold mb-2">Daftar Laporan Saya</h1>
@if (session('error'))
    <div class="bg-red-100 text-red-800 px-4 py-2 rounded-md mb-4">
        {{ session('error') }}
    </div>
@endif
<form method="GET" action="{{ route('masyarakat.index') }}">
    <div class="pb-4 mt-8">
        <label for="table-search" class="sr-only">Search</label>
        <div class="relative mt-1">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                </svg>
            </div>
            <input type="text" name="search" value="{{ $search ?? '' }}" id="table-search"
                class="block pt-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
                placeholder="Search name or email">
        </div>
    </div>
</form>
<div class="flex items-center gap-4 mb-4">
    <form action="{{ route('export_pengaduan') }}" method="GET">
        <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">
            Export Pengaduan Saya
        </button>
    </form>

    <div>
        @include('masyarakat.create')
    </div>
</div>


{{-- table --}}
<div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-8">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Gambar
                </th>
                <th scope="col" class="px-6 py-3">
                    Lokasi & Tanggal
                </th>
                <th scope="col" class="px-6 py-3">
                    Deskripsi
                </th>
                <th scope="col" class="px-6 py-3">
                    Tipe
                </th>
                <th scope="col" class="px-6 py-3">
                    Status
                </th>
                <th scope="col" class="px-6 py-3">
                    Aksi
                </th>
            </tr>
        </thead>
        <tbody>
            @if ($pengaduans->count())
                @foreach ($pengaduans as $pengaduan)
                    <tr
                        class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <div class="flex items-center gap-4">
                                <img class="w-20 h-20 object-cover rounded-sm"
                                    src="{{ asset('storage/' . $pengaduan->gambar) }}" alt="Gambar Pengaduan">
                            </div>
                        </th>

                        <td class="px-6 py-4">
                              {{ $pengaduan->provinsi }}
                              kot/kabw{{ $pengaduan->kota_kabupaten }}, Kel.{{ $pengaduan->kelurahan }},
                            Kec.{{ $pengaduan->kecamatan }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $pengaduan->keluhan }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $pengaduan->tipePengaduan->nama ?? '-' }}
                        </td>
                        <td class="px-6 py-4">
                            @php
                                $statusId = $pengaduan->status_pengaduan_id;
                                $statusText = $pengaduan->status->status_pengaduan ?? 'Pending';
                                $statusColor = match ($statusId) {
                                    1 => 'bg-gray-200 text-gray-800 dark:bg-gray-700 dark:text-gray-300',
                                    2 => 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300',
                                    3 => 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300',
                                    4 => 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-400',
                                    default => 'bg-gray-200 text-gray-800 dark:bg-gray-700 dark:text-gray-300',
                                };
                                $dotColor = match ($statusId) {
                                    1 => 'bg-gray-500',
                                    2 => 'bg-green-500',
                                    3 => 'bg-blue-500',
                                    4 => 'bg-red-500',
                                    default => 'bg-gray-500',
                                };
                            @endphp

                            <span
                                class="inline-flex items-center {{ $statusColor }} text-xs font-medium px-2.5 py-0.5 rounded-full">
                                <span class="w-2 h-2 me-1 {{ $dotColor }} rounded-full"></span>
                                {{ $statusText }}
                            </span>
                        </td>

                        <td class="px-6 py-4 text-right flex gap-2 mt-4">
                            <!-- Tombol untuk membuka modal edit -->
                            <button data-modal-target="authentication-modal-edit-{{ $pengaduan->id }}"
                                data-modal-toggle="authentication-modal-edit-{{ $pengaduan->id }}"
                                class="block text-white bg-yellow-400 hover:bg-yellow-800 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-yellow-600 dark:hover:bg-yellow-700 dark:focus:ring-yellow-800"
                                type="button">
                                Edit
                            </button>
                            <button data-modal-target="popup-modal-delete-{{ $pengaduan->id }}"
                                data-modal-toggle="popup-modal-delete-{{ $pengaduan->id }}"
                                class="block text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800"
                                type="button">
                                Delete
                            </button>
                        </td>
                    </tr>
                    {{-- @include('masyarakat.edit')
                    @include('masyarakat.delete') --}}
                @endforeach
            @else
                <tr>
                    <td colspan="6" class="text-center py-4">Tidak ada data pengaduan.</td>
                </tr>
            @endif

        </tbody>
    </table>
</div>
{{-- paginate --}}
<nav class="flex items-center flex-column flex-wrap md:flex-row justify-between pt-6 px-10"
    aria-label="Table navigation">
    <span class="text-sm font-normal text-gray-500 dark:text-gray-400 mb-4 md:mb-0 block w-full md:inline md:w-auto">
        Showing
        <span class="font-semibold text-gray-900 ">{{ $pengaduans->firstItem() }}-{{ $pengaduans->lastItem() }}</span>
        of
        <span class="font-semibold text-gray-900 ">{{ $pengaduans->total() }}</span>
    </span>

    <ul class="inline-flex -space-x-px rtl:space-x-reverse text-sm h-8">
        {{-- Previous Page Link --}}
        @if ($pengaduans->onFirstPage())
            <li>
                <span
                    class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-400 bg-white border border-gray-300 rounded-s-lg">Previous</span>
            </li>
        @else
            <li>
                <a href="{{ $pengaduans->previousPageUrl() }}"
                    class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Previous</a>
            </li>
        @endif

        {{-- Pagination Numbers --}}
        @foreach ($pengaduans->getUrlRange(1, $pengaduans->lastPage()) as $page => $url)
            @if ($page == $pengaduans->currentPage())
                <li>
                    <span
                        class="flex items-center justify-center px-3 h-8 text-blue-600 border border-gray-300 bg-blue-50 hover:bg-blue-100 hover:text-blue-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white">{{ $page }}</span>
                </li>
            @else
                <li>
                    <a href="{{ $url }}"
                        class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">{{ $page }}</a>
                </li>
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($pengaduans->hasMorePages())
            <li>
                <a href="{{ $pengaduans->nextPageUrl() }}"
                    class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Next</a>
            </li>
        @else
            <li>
                <span
                    class="flex items-center justify-center px-3 h-8 leading-tight text-gray-400 bg-white border border-gray-300 rounded-e-lg">Next</span>
            </li>
        @endif
    </ul>
</nav>
@endsection

