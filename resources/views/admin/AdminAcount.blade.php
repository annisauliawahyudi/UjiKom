@extends('layouts.app')

@section('title', 'Daftardmin')

@section('content')
    <div class="p-4 sm:ml-64">
        <div class="p-4 mt-4">
            <div class="flex justify-between items-center mb-4">
                <form method="GET" action="">
                    <div class="pb-4">
                        <label for="table-search" class="sr-only">Search</label>
                        <div class="relative mt-1">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                </svg>
                            </div>
                            <input type="text" name="search" id="table-search"
                                class="block pt-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Search name or email">
                        </div>
                    </div>
                </form>

                {{-- button modal --}}
            </div>
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">

                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">No</th>
                            <th scope="col" class="px-6 py-3">Nama</th>
                            <th scope="col" class="px-6 py-3">Email</th>
                            <th scope="col" class="px-6 py-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                            <td class="px-6 py-4"></td>
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                admin</td>
                            <td class="px-6 py-4">admin@gmail.com</td>
                            
                            {{-- <button data-modal-target="authentication-modal-edit"
                                data-modal-toggle="authentication-modal-edit"
                                class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                type="button">
                                Edit
                            </button>
                            <button data-modal-target="popup-modal-delete" data-modal-toggle="popup-modal-delete"
                                class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                type="button">
                                Delete
                            </button> --}}
                        </td> 
                        </tr>
                        {{-- modal edit user --}}
                        {{-- @include('admin.edit') --}}
                        {{-- modal delete --}}
                        {{-- @include('admin.delete') --}}
                    </tbody>
                </table>
            </div>


            <p class="text-gray-500 mt-4">Tidak ada hasil ditemukan.</p>
        </div>
    </div>
    {{-- @include('admin.officerAcount') --}}
@endsection
