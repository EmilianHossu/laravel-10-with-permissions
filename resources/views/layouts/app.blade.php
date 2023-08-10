<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
            @endif

            @if( session('success') || session('error') || session('alert') )
            @if( session('success') )
            <div class="text-green-500 w-full text-center py-2 font-bold mt-6 -mb-6" role="alert">
                {{session('success')}}
            </div>
            @endif

            @if( session('error') )
            <div class="text-red-500 w-full text-center py-2 font-bold mt-6 -mb-6" role="alert">
                {{session('error')}}
            </div>
            @endif

            @if( session('alert') )
            <div class="text-yellow-500 w-full text-center py-2 font-bold mt-6 -mb-6" role="alert">
                {{session('alert')}}
            </div>
            @endif
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
        @stack('footer-js')
    </body>

</html>
