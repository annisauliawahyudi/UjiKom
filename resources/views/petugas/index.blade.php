@extends('layouts.app')

@section('title', 'DataReport')

@section('content')
    <div class="p-4 sm:ml-64">
        <div class="p-4 mt-4">
            <h1 class="text-4xl font-bold mb-2">Daftar Laporan</h1>
            @include('petugas.show')
        </div>
    </div>
@endsection
<script src="https://cdn.tailwindcss.com"></script>
