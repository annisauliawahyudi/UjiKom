<!-- Main modal -->
<div id="default-modal-coment" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-4xl mx-auto">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow-lg flex overflow-hidden dark:bg-gray-800 max-h-[80vh] h-[80vh]">
            <!-- Close button -->
            <div class="absolute top-4 right-4 z-10">
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-hide="default-modal-coment">
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
                <div class="w-1/2 bg-gray-100 flex items-center justify-center">
                    <div class="aspect-square w-full h-full">
                        <img src="{{ asset('images/report.png') }}" alt="Gambar Pengaduan"
                            class="object-cover w-full h-full rounded-l-lg" />
                    </div>
                </div>

                <!-- Right: Komentar dengan scroll snap -->
                <div class="w-1/2 p-6 flex flex-col h-full">
                    <!-- Title -->
                    <h3 class="text-xl font-semibold text-gray-800 dark:text-white mb-4 shrink-0">Komentar</h3>

                    <!-- Scrollable comment area -->
                    <div class="overflow-y-auto pr-2 space-y-4 flex-1 snap-y scroll-smooth">
                            <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg shadow-sm snap-start h-[100px]">
                                <p class="font-medium text-gray-900 dark:text-white">
                                </p>

                                <p class="text-sm text-gray-700 dark:text-gray-300"></p>
                            </div>
                            <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg shadow-sm snap-start h-[100px]">
                                <p class="text-sm text-gray-700 dark:text-gray-300">Tidak ada komentar untuk pengaduan
                                    ini.</p>
                            </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
