@extends('layouts.app')

@section('title', 'index.admin')

@section('content')
    <div class="p-4 sm:ml-64">
        <div class="p-4 mt-4">
            <!-- modal add user -->
            @include('admin.create')
            {{-- table --}}
            @include('admin.show')
            {{-- @include('admin.AdminAcount') --}}
            </div>
        </div>
    @endsection
