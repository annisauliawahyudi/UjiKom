<!-- Modal Edit -->
<div id="authentication-modal-edit" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-4xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white  text-left">
                    Edit Laporan Pengaduan
                </h3>
                <button type="button"
                    class="text-gray-400 hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-hide="authentication-modal-edit">
                    <svg class="w-3 h-3" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M1 1l6 6m0 0l6 6M7 7l6-6M7 7L1 13" />
                    </svg>
                </button>
            </div>

            <!-- Modal body -->
            <div class="p-6">
                <form action="" method="POST"
                    enctype="multipart/form-data" class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Provinsi -->
                        <div>
                            <label for="edit-provinsi"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white  text-left">Provinsi</label>
                            <input type="text" id="edit-provinsi" name="provinsi" 
                                class="w-full p-2.5 rounded-lg text-sm bg-gray-50 border border-gray-300 text-gray-900 dark:bg-gray-600 dark:text-white dark:border-gray-500"
                                required />
                        </div>

                        <!-- Kota/Kabupaten -->
                        <div>
                            <label for="edit-kota"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white  text-left">Kota/Kabupaten</label>
                            <input type="text" id="edit-kota" name="kota_kabupaten"
                                class="w-full p-2.5 rounded-lg text-sm bg-gray-50 border border-gray-300 text-gray-900 dark:bg-gray-600 dark:text-white dark:border-gray-500"
                                required />
                        </div>

                        <!-- Kecamatan -->
                        <div>
                            <label for="edit-kecamatan"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white  text-left">Kecamatan</label>
                            <input type="text" id="edit-kecamatan" name="kecamatan"
                                class="w-full p-2.5 rounded-lg text-sm bg-gray-50 border border-gray-300 text-gray-900 dark:bg-gray-600 dark:text-white dark:border-gray-500"
                                required />
                        </div>

                        <!-- Kelurahan -->
                        <div>
                            <label for="edit-kelurahan"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white  text-left">Kelurahan</label>
                            <input type="text" id="edit-kelurahan" name="kelurahan"
                                class="w-full p-2.5 rounded-lg text-sm bg-gray-50 border border-gray-300 text-gray-900 dark:bg-gray-600 dark:text-white dark:border-gray-500"
                                required />
                        </div>

                        <!-- Tipe -->
                        <div>
                            <label for="edit-tipe"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white  text-left">Tipe</label>
                            <select id="edit-tipe" name="tipe_pengaduan_id"
                                class="w-full p-2.5 rounded-lg text-sm bg-gray-50 border border-gray-300 text-gray-900 dark:bg-gray-600 dark:text-white dark:border-gray-500"
                                required>
                            </select>
                        </div>

                        <!-- Gambar Pendukung -->
                        <div>
                            <label for="edit-gambar"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white  text-left">Gambar
                                Pendukung</label>
                            <input type="file" id="edit-gambar" name="gambar"
                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400" />
                        </div>
                    </div>

                    <!-- Detail Keluhan -->
                    <div>
                        <label for="edit-keluhan"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white  text-left">Detail
                            Keluhan</label>
                        <textarea id="edit-keluhan" name="keluhan" rows="4"
                            class="w-full p-2.5 rounded-lg text-sm bg-gray-50 border border-gray-300 text-gray-900 dark:bg-gray-600 dark:text-white dark:border-gray-500"
                            placeholder="Jelaskan keluhan Anda">jalanan jelek banget</textarea>
                    </div>

                    <!-- Tombol Simpan -->
                    <div class="text-right pt-4">
                        <button type="submit"
                            class="text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
