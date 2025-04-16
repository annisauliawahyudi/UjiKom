
<!-- Tombol untuk membuka modal tambah -->
<button data-modal-target="authentication-modal-add-report" data-modal-toggle="authentication-modal-add-report"
    class="block text-white bg-blue-400 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
    type="button">
    Tambah Pengaduan
</button>

<!-- Modal Edit -->
<div id="authentication-modal-add-report" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-4xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white  text-left">
                    Tambah Pengaduan
                </h3>
                <button type="button"
                    class="text-gray-400 hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-hide="authentication-modal-add-report">
                    <svg class="w-3 h-3" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M1 1l6 6m0 0l6 6M7 7l6-6M7 7L1 13" />
                    </svg>
                </button>
            </div>

            <!-- Modal body -->
            <div class="p-6">
                <form action="" method="POST" enctype="multipart/form-data" class="space-y-4">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Provinsi -->
                        <div>
                            <label for="provinsi"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Provinsi</label>
                            <select id="provinsi" name="provinsi"
                                class="w-full p-2.5 rounded-lg text-sm bg-gray-50 border border-gray-300 text-gray-900 dark:bg-gray-700 dark:text-white dark:border-gray-600"
                                required>
                            </select>
                        </div>

                        <!-- Kota/Kabupaten -->
                        <div>
                            <label for="kota/kabupaten"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kota/Kabupaten</label>
                            <select id="kotaKab" name="kota_kabupaten"
                                class="w-full p-2.5 rounded-lg text-sm bg-gray-50 border border-gray-300 text-gray-900 dark:bg-gray-700 dark:text-white dark:border-gray-600"
                                required>
                            </select>
                        </div>

                        <!-- Kecamatan -->
                        <div>
                            <label for="kecamatan"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kecamatan</label>
                            <select id="kecamatan" name="kecamatan"
                                class="w-full p-2.5 rounded-lg text-sm bg-gray-50 border border-gray-300 text-gray-900 dark:bg-gray-700 dark:text-white dark:border-gray-600"
                                required>
                            </select>
                        </div>

                        <!-- Kelurahan -->
                        <div>
                            <label for="kelurahan"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kelurahan</label>
                            <select id="kelurahan" name="kelurahan"
                                class="w-full p-2.5 rounded-lg text-sm bg-gray-50 border border-gray-300 text-gray-900 dark:bg-gray-700 dark:text-white dark:border-gray-600"
                                required>
                            </select>
                        </div>

                        <!-- Tipe Pengaduan -->
                        <div>
                            <label for="tipe"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tipe
                                Pengaduan</label>
                            <select id="tipe" name="tipe_pengaduan_id"
                                class="w-full p-2.5 rounded-lg text-sm bg-gray-50 border border-gray-300 text-gray-900 dark:bg-gray-700 dark:text-white dark:border-gray-600"
                                required>
                                <option value="">Pilih Tipe</option>
                            </select>
                        </div>

                        <!-- Gambar Pendukung -->
                        <div>
                            <label for="gambar"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Gambar Pendukung</label>
                            <input type="file" id="gambar" name="gambar"
                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" />
                        </div>
                    </div>

                    <!-- Detail Keluhan -->
                    <div>
                        <label for="keluhan"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Detail
                            Keluhan</label>
                        <textarea id="keluhan" name="keluhan" rows="5"
                            class="w-full p-2.5 rounded-lg text-sm bg-gray-50 border border-gray-300 text-gray-900 dark:bg-gray-700 dark:text-white dark:border-gray-600"
                            placeholder="Jelaskan keluhan Anda dengan rinci" required></textarea>
                    </div>

                    <!-- Tombol Submit -->
                    <div class="text-right">
                        <button type="submit"
                            class="bg-blue-700 hover:bg-blue-800 text-white font-medium rounded-lg text-sm px-6 py-2.5 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Kirim Pengaduan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    fetch(`https://kanglerian.my.id/api-wilayah-indonesia/api/provinces.json`)
        .then(response => response.json())
        .then(provinces => {
            var data = provinces;
            var tampung = '<option>Pilih Provinsi</option>';
            data.forEach(element => {
                tampung +=
                    `<option data-reg="${element.id}" value="${element.name}">${element.name}</option>`;
            });
            // pasang di sini setelah data selesai diload
            document.getElementById('provinsi').innerHTML = tampung;
        });
</script>

<script>
    // Ambil data provinsi
    fetch(`https://kanglerian.my.id/api-wilayah-indonesia/api/provinces.json`)
        .then(response => response.json())
        .then(provinces => {
            let tampung = '<option value="">Pilih Provinsi</option>';
            provinces.forEach(element => {
                tampung +=
                    `<option data-reg="${element.id}" value="${element.name}">${element.name}</option>`;
            });
            document.getElementById('provinsi').innerHTML = tampung;
        });

    // Event saat provinsi dipilih
    const selectProvinsi = document.getElementById('provinsi');
    selectProvinsi.addEventListener('change', (e) => {
        const provinsiID = e.target.options[e.target.selectedIndex].dataset.reg;
        fetch(`https://kanglerian.my.id/api-wilayah-indonesia/api/regencies/${provinsiID}.json`)
            .then(response => response.json())
            .then(regencies => {
                let tampung = '<option value="">Pilih Kota/Kabupaten</option>';
                regencies.forEach(element => {
                    tampung +=
                        `<option data-dist="${element.id}" value="${element.name}">${element.name}</option>`;
                });
                document.getElementById('kotaKab').innerHTML = tampung;

                // Reset kecamatan dan kelurahan
                document.getElementById('kecamatan').innerHTML =
                    '<option value="">Pilih Kecamatan</option>';
                document.getElementById('kelurahan').innerHTML =
                    '<option value="">Pilih Kelurahan</option>';
            });
    });

    // Event saat kota/kabupaten dipilih
    const selectKota = document.getElementById('kotaKab');
    selectKota.addEventListener('change', (e) => {
        const kotaID = e.target.options[e.target.selectedIndex].dataset.dist;
        fetch(`https://kanglerian.my.id/api-wilayah-indonesia/api/districts/${kotaID}.json`)
            .then(response => response.json())
            .then(districts => {
                let tampung = '<option value="">Pilih Kecamatan</option>';
                districts.forEach(element => {
                    tampung +=
                        `<option data-vill="${element.id}" value="${element.name}">${element.name}</option>`;
                });
                document.getElementById('kecamatan').innerHTML = tampung;

                // Reset kelurahan
                document.getElementById('kelurahan').innerHTML =
                    '<option value="">Pilih Kelurahan</option>';
            });
    });

    // Event saat kecamatan dipilih
    const selectKecamatan = document.getElementById('kecamatan');
    selectKecamatan.addEventListener('change', (e) => {
        const kecamatanID = e.target.options[e.target.selectedIndex].dataset.vill;
        fetch(`https://kanglerian.my.id/api-wilayah-indonesia/api/villages/${kecamatanID}.json`)
            .then(response => response.json())
            .then(villages => {
                let tampung = '<option value="">Pilih Kelurahan</option>';
                villages.forEach(element => {
                    tampung += `<option value="${element.name}">${element.name}</option>`;
                });
                document.getElementById('kelurahan').innerHTML = tampung;
            });
    });
</script>
