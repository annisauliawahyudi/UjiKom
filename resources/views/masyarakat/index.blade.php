@extends('layouts.app')

@section('title', 'LaporanSaya')

@section('content')
    <div class="p-4 sm:ml-64">
        <div class="p-4 mt-4">
            @include('masyarakat.show')
            {{-- @include('masyarakat.showAll') --}}
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
            input.addEventListener('input', function() {
                this.form.submit();
            });
        </script>
    </div>
    {{-- @include('admin.officerAcount') --}}
@endsection