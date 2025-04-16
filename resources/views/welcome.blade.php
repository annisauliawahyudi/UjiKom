@extends('layouts.app')

@section('title', 'Welcome')

@section('content')
    <div class="text-center mt-6">
        <h1 class="text-4xl font-bold mb-4">Selamat Datang di Aplikasi LaporMas</h1>
        <p class="mb-6 text-gray-600">Silahkan Login atau Daftar Untuk Melanjutkan.</p>

        <div class="mt-10 px-6">
            <h2 class="text-3xl font-bold mb-6 text-center">Laporan</h2>

                <div class="text-center py-20 bg-white rounded-lg shadow-md dark:bg-gray-800">
                    <h3 class="text-2xl font-semibold text-gray-700 dark:text-white mb-4">Tidak ada pengaduan</h3>
                    <p class="text-gray-500 dark:text-gray-300 mb-6">YUK BUAT PENGADUAN!</p>
                    <a href=""
                        class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg">
                        Buat Pengaduan
                    </a>
                </div>

                <div class="flex justify-between items-center mt-8 pb-4">
                    <form method="GET" action="#">
                        <div class="pb-4 mt-8">
                            <label for="table-search" class="sr-only">Search</label>
                            <div class="relative mt-1">
                                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" fill="none"
                                        viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                    </svg>
                                </div>
                                <input type="text" name="search" value="{{ $search ?? '' }}" id="table-search"
                                    class="block pt-2 ps-10  text-sm text-gray-900 border border-gray-300 rounded-lg w-80 h-10 py-2.5 bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
                                    placeholder="Search name or email" oninput="this.form.submit()" />
                            </div>
                        </div>
                    </form>
                    <div>
                        <label for="provinsi" class="block text-sm font-medium">Provinsi</label>
                        <select name="provinsi" id="provinsi" onchange="this.form.submit()"
                            class="block w-48 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Semua</option>

                        </select>
                    </div>

                    <!-- Filter Status -->
                    <div>
                        <label for="status" class="block text-sm font-medium">Status</label>
                        <select name="status" id="status" onchange="this.form.submit()"
                            class="block w-40 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Semua</option>

                        </select>
                    </div>

                    <!-- Filter Tipe -->
                    <div>
                        <label for="tipe" class="block text-sm font-medium">Tipe Pengaduan</label>
                        <select name="tipe" id="tipe" onchange="this.form.submit()"
                            class="block w-52 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Semua</option>

                        </select>
                    </div>

                    <form action="" method="GET" class="mb-4">
                        <button type="submit" class="mt-4 px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">
                            Export Pengaduan.xlsx
                        </button>
                    </form>
                </div>



                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">

                        <div
                            class="bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
                            <a href="#">
                                <img class="rounded-t-lg w-full h-48 object-cover"
                                    src="{{ asset('image/report.png') }}" alt="Gambar Pengaduan" />
                            </a>
                            <div class="p-5">
                                <div class="flex gap-3 items-center justify-center">
                                    <h5
                                        class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white overflow-hidden text-ellipsis whitespace-nowrap max-w-xs sm:max-w-sm md:max-w-md lg:max-w-lg xl:max-w-xl"> jalan rusak
                                    </h5>
                                    {{-- status pengaduan --}}
                                    <div>
                                        <span
                                            class="inline-flex items-center 
                                             ext-xs font-medium px-2.5 py-0.5 rounded-full">
                                            <span class="w-2 h-2 me-1 
                                             rounded-full"></span>
                                             pending
                                        </span>
                                    </div>
                                </div>

                                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400 line-clamp-2">
                                    📍Lokasi<br>
                                    jawa
                                </p>
                                {{-- Form komentar --}}
                                <form action="#" method="POST">
                                    <label for="chat" class="sr-only">Komentar..</label>
                                    <div
                                        class="flex justify-between items-end px-3 py-2 rounded-lg bg-gray-50 dark:bg-gray-700 space-x-4">
                                        <div class="flex flex-col w-full space-y-4">
                                            <input type="text" name="guest_name"
                                                class="block p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:text-white"
                                                placeholder="Nama Anda" required>

                                            <textarea id="chat" rows="1" name="isi"
                                                class="block p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:text-white"
                                                placeholder="Komentar..." required></textarea>

                                            <input type="hidden" name="tipe_komentator"

                                                >
                                        </div>

                                        <button type="submit"
                                            class="shrink-0 self-end inline-flex justify-center p-2 text-blue-600 rounded-full hover:bg-blue-100 dark:text-blue-500 dark:hover:bg-gray-600">
                                            <svg class="w-5 h-5 rotate-45" xmlns="http://www.w3.org/2000/svg"
                                                fill="currentColor" viewBox="0 0 18 20">
                                                <path
                                                    d="m17.914 18.594-8-18a1 1 0 0 0-1.828 0l-8 18a1 1 0 0 0 1.157 1.376L8 18.281V9a1 1 0 0 1 2 0v9.281l6.758 1.689a1 1 0 0 0 1.156-1.376Z" />
                                            </svg>
                                            <span class="sr-only">Komentar..</span>
                                        </button>
                                    </div>
                                </form>

                                {{-- Like & Modal Komentar --}}
                                <div class="flex items-center gap-4 mt-4 justify-center">
                                    <div class="flex flex-col items-center">

                                        <button type="button" id="like-btn-"

                                            class="p-2 rounded-lg cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:hover:text-white dark:hover:bg-gray-600">
                                            <svg class="w-6 h-6 "

                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12.01 6.001C6.5 1 1 8 5.782 13.001L12.011 20l6.23-7C23 8 17.5 1 12.01 6.002Z" />
                                            </svg>
                                        </button>
                                        <p class="text-xs text-gray-900 dark:text-white mt-1"
                                            id="like-count">

                                        </p>
                                    </div>

                                    <button data-modal-target="default-modal-coment"

                                        data-modal-toggle="default-modal-coment"
                                        class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5"
                                        type="button">
                                        Lihat Komentar
                                    </button>

                                    @include('modalDetail')
                                </div>
                            </div>
                        </div>

                </div>

        </div>
    </div>
    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: '{{ session('success') }}',
                    confirmButtonText: 'Oke',
                });
            });
        </script>
    @endif

@endsection

<script src="https://cdn.tailwindcss.com"></script>
