<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" >
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'LaporMas')</title>
    <link rel="stylesheet" href="{{ asset('tailwind/css/flowbite.min.css') }}">
</head>

<body class="bg-gray-100 text-gray-800">
    @include('partials.navbar')
  <div class="flex">

         @include('partials.sidebar')
        <main class="flex-1 p-6">
            @yield('content')
        </main>
    </div>

  <script src="{{ asset('tailwind/js/apexcharts.min.js') }}"></script>
  <script src="{{ asset('tailwind/js/flowbite.min.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>

</html>
