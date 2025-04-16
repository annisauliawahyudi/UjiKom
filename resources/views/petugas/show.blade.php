
  <form action="" method="GET" class="mb-4">
      <button type="submit" class="mt-4 px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">
          Export Pengaduan.xlsx
      </button>
  </form>
  <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-8">
      <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
          <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
              <tr>
                  <th scope="col" class="px-6 py-3 text-center whitespace-nowrap">
                      Gambar & Pengirim
                  </th>
                  <th scope="col" class="px-6 py-3 text-center whitespace-nowrap">
                      Lokasi & Tanggal
                  </th>
                  <th scope="col" class="px-6 py-3 text-center whitespace-nowrap">
                      Deskripsi
                  </th>
                  <th scope="col" class="px-6 py-3 text-center whitespace-nowrap">
                      Jumlah Vote
                  </th>
                  <th scope="col" class="px-6 py-3 text-center whitespace-nowrap">
                      Status
                  </th>
                  <th scope="col" class="px-6 py-3 text-center whitespace-nowrap">
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
                                      <div
                                          class="w-20 h-20 bg-gray-200 rounded-sm flex items-center justify-center text-gray-500 text-xs">
                                          Tidak ada gambar
                                      </div>
                              </div>
                          </th>
                          <td class="px-6 py-4 w-[280px] break-words">
                              kecamatan
                               <br>
                              <span class="text-xs text-gray-400">
                                  10 juni
                              </span>
                          </td>
                          <td class="px-6 py-4">
                              jalan rusak
                          </td>
                          <td class="px-6 py-4">
                            1
                          </td>
                          <td class="px-6 py-4">
                              {{-- status --}}
                          </td>
                          <td class="px-6 py-4">
                              <!-- Button to toggle modal -->
                              <button data-modal-target="default-modal"
                                  data-modal-toggle="default-modal"
                                  class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
                                  type="button">
                                  Detail
                              </button>
                              <div class="mt-4">
                                  <button data-modal-target="popup-modal-delete"
                                      data-modal-toggle="popup-modal-delete"
                                      class="block text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800"
                                      type="button">
                                      Delete
                                  </button>
                              </div>
                          </td>
                      </tr>
                      @include('petugas.create')
                      @include('petugas.delete')

                  <tr>
                      <td colspan="6" class="text-center py-4">Tidak ada data pengaduan.</td>
                  </tr>
          </tbody>
      </table>
  </div>
  {{-- paginate --}}
  
