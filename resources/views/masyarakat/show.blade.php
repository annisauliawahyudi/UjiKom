<h1 class="text-4xl font-bold mb-2">Daftar Laporan Saya</h1>

<form method="GET" action="#">
    <div class="pb-4 mt-8">
        <label for="table-search" class="sr-only">Search</label>
        <div class="relative mt-1">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                </svg>
            </div>
            <input type="text" name="search" 
            id="table-search"
                class="block pt-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
                placeholder="Search name or email">
        </div>
    </div>
</form>
<div class="flex items-center gap-4 mb-4">
    <form action="" method="GET">
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
                    <tr
                        class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <div class="flex items-center gap-4">
                                <img class="w-20 h-20 object-cover rounded-sm"
                                    src="{{ asset('image/report.png') }}" alt="Gambar Pengaduan">
                            </div>
                        </th>

                        <td class="px-6 py-4">
                          
                            bojong gede
                        </td>
                        <td class="px-6 py-4">
                            jalanan bolong
                        </td>
                        <td class="px-6 py-4">
                             annisa
                        </td>
                        <td class="px-6 py-4">
                            oke
                        </td>

                        <td class="px-6 py-4 text-right flex gap-2 mt-4">
                            <!-- Tombol untuk membuka modal edit -->
                            <button data-modal-target="authentication-modal-edit"
                                data-modal-toggle="authentication-modal-edit"
                                class="block text-white bg-yellow-400 hover:bg-yellow-800 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-yellow-600 dark:hover:bg-yellow-700 dark:focus:ring-yellow-800"
                                type="button">
                                Edit
                            </button>
                            <button data-modal-target="popup-modal-delete"
                                data-modal-toggle="popup-modal-delete"
                                class="block text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800"
                                type="button">
                                Delete
                            </button>
                        </td>
                    </tr>
                    @include('masyarakat.edit')
                    @include('masyarakat.delete')
                <tr>
                    <td colspan="6" class="text-center py-4">Tidak ada data pengaduan.</td>
                </tr>

        </tbody>
    </table>
</div>
{{-- paginate --}}

