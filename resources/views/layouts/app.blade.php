<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" >
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title', 'LaporMas')</title>
  <link rel="stylesheet" href="{{ asset('tailwind/css/flowbite.min.css') }}">
</head>

<body class="bg-gray-100 text-gray-800">
  @guest
    @include('partials.navbar')
  @endguest
  <div class="flex">
      @auth
        @include('partials.sidebar')
      @endauth
        <main class="flex-1 p-6">
            @yield('content')
        </main>
    </div>

  <script src="{{ asset('tailwind/js/apexcharts.min.js') }}"></script>
  <script src="{{ asset('tailwind/js/flowbite.min.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>

</html>
