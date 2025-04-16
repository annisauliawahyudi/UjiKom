@extends('layouts.app')

@section('title', 'index.admin')

@section('content')
    <div class="p-4 sm:ml-64">
        <div class="p-4 mt-4">
            <!-- modal add user -->
            @include('admin.create')
            {{-- table --}}
            @include('admin.show')
            {{-- @include('admin.officerAcount') --}}
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
            <script>
        const input = document.getElementById('table-search');
        input.addEventListener('input', function () {
            this.form.submit();
        });
    </script>
        </div>
        {{-- @include('admin.officerAcount') --}}
    @endsection
