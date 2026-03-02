<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Hypnobirthing App') }}</title>
    <link rel="icon" type="image/png" href="{{ asset('images/pregnant-mother.png') }}">

    <!-- Font -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- AlpineJS -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

</head>

<body class="font-sans antialiased bg-gradient-to-br from-pink-50 via-white to-purple-50">

    <div class="min-h-screen">

        <!-- NAVIGATION -->
        @include('layouts.navigation')


        <!-- HEADER -->
        @isset($header)

        <header class="bg-white/80 backdrop-blur border-b border-gray-200 shadow-sm">

            <div class="max-w-7xl mx-auto py-5 px-6">

                <h1 class="text-2xl font-bold text-gray-800">
                    {{ $header }}
                </h1>

            </div>

        </header>

        @endisset



        <!-- MAIN CONTENT -->
        <main class="max-w-7xl mx-auto px-6 py-8">

            {{ $slot }}

        </main>


        <!-- FOOTER -->
        <footer class="text-center text-xs text-gray-400 pb-6">

            © {{ date('Y') }} Hypnobirthing App

        </footer>

    </div>

</body>

</html>