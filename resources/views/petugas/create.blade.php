<!-- Main modal -->
<div id="default-modal-{{ $pengaduan->id }}" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-4xl mx-auto">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadoww-lg flex overflow-hidden dark:bg-gray-800 max-h-[80vh] h-[80vh]">
            <!-- Close button -->
            <div class="absolute top-4 right-4 z-10">
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-hide="default-modal-{{ $pengaduan->id }}">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>

            <!-- Modal body -->
            <div class="flex w-full h-full">
                <!-- Left: Gambar -->
                <div class="w-1/2 bg-gray-100 flex flex-col">
                    <!-- Bagian Gambar -->
                    <div class="h-2/3">
                        <div class="w-full h-full">
                            <img src="{{ asset('storage/' . $pengaduan->gambar) }}" alt="Foto"
                                class="object-cover w-full h-full rounded-tl-lg" />
                        </div>
                    </div>

                    <!-- Bagian Deskripsi -->
                    <div
                        class="h-1/3 p-4 bg-white border-t border-gray-200 dark:bg-gray-700 dark:border-gray-600 overflow-y-auto">
                        <h4 class="text-lg font-semibold text-gray-800 dark:text-white mb-2">Deskripsi Foto</h4>
                        <div class="space-y-1 text-sm">
                            <p class="text-gray-600 dark:text-gray-300"><span class="font-medium">Alamat:</span>
                                {{ $pengaduan->kota_kabupaten }}, Kel.{{ $pengaduan->kelurahan }},
                                Kec.{{ $pengaduan->kecamatan }}</p>
                            <p class="text-gray-600 dark:text-gray-300"><span class="font-medium">Jenis:</span>
                                {{ $pengaduan->tipePengaduan->nama }}</p>
                            <p class="text-gray-600 dark:text-gray-300"><span class="font-medium">Tanggal:</span>
                                {{ $pengaduan->created_at ? $pengaduan->created_at->format('d M Y') : '-' }}</p>
                            <p class="text-gray-600 dark:text-gray-300"><span class="font-medium">Deskripsi:</span>
                                {{ $pengaduan->keluhan }}</p>
                        </div>
                    </div>
                </div>
                <!-- Right: Komentar dengan scroll snap -->
                <div class="w-1/2 p-6 flex flex-col h-full">
                    <!-- Title -->
                    <h3 class="text-xl font-semibold text-gray-800 dark:text-white mb-4 shrink-0">Komentar</h3>

                    <!-- Scrollable comment area -->
                    <div class="overflow-y-auto pr-2 space-y-4 flex-1 snap-y scroll-smooth">
                        @forelse ($pengaduan->komentars as $komentar)
                            <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg shadow-sm snap-start h-auto">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <p class="font-medium text-gray-900 dark:text-white">
                                            {{ $komentar->user->name ?? $komentar->guest_name }}
                                        </p>
                                        <p class="text-sm text-gray-700 dark:text-gray-300">{{ $komentar->isi }}</p>
                                    </div>

                                    @if (auth()->check() && auth()->user()->role === 'petugas')
                                        <form action="{{ route('petugas.komentar.destroy', $komentar->id) }}"
                                            method="POST" class="ml-4">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-700 text-sm">
                                                Hapus
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg shadow-sm snap-start h-[100px]">
                                <p class="text-sm text-gray-700 dark:text-gray-300">Tidak ada komentar untuk pengaduan
                                    ini.</p>
                            </div>
                        @endforelse
                    </div>


                    <form class="mt-4" action="{{ route('petugas.aksi', $pengaduan->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div
                            class="w-full mb-4 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600">
                            <div class="px-4 py-2 bg-white rounded-t-lg dark:bg-gray-800">
                                <label for="comment" class="sr-only">Your comment</label>
                                <textarea id="comment" rows="4" name="isi"
                                    class="w-full px-0 text-sm text-gray-900 bg-white border-0 dark:bg-gray-800 focus:ring-0 dark:text-white dark:placeholder-gray-400"
                                    placeholder="Write a comment..."></textarea>
                            </div>
                            <div
                                class="flex items-center justify-between px-3 py-2 border-t dark:border-gray-600 border-gray-200">
                                <button type="submit"
                                    class="inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-900 hover:bg-blue-800">
                                    Post comment
                                </button>
                                <div class="flex ps-0 space-x-1 rtl:space-x-reverse sm:ps-2">
                                    <select name="status_pengaduan_id"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-32 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        <option selected disabled value>Aksi</option>
                                        <option value="2">Proses</option>
                                        <option value="3">Selesai</option>
                                        <option value="4">Tolak</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.tailwindcss.com"></script>
