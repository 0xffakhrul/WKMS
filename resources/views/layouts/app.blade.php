<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

    <!-- Scripts -->
    {{-- <script src="//unpkg.com/alpinejs" defer></script> --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
    .active {
        color: #34D399; /* Set your desired green color code */
    }
</style>
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @if (isset($header))
            <header class="ml-64">
                <div class="max-w-7xl mx-auto px-8 pt-20 font-bold text-2xl">
                    <div>Welcome, {{ Auth::user()->name }}</div>
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main class="ml-64">
            {{ $slot }}
            <x-flash-message />
        </main>
    </div>
    <!-- Add the Toastr JS at the end of the body or in the head -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <!-- Initialize Toastr (optional, you can customize this as needed) -->
    <script>
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
        }
    </script>
</body>

</html>
