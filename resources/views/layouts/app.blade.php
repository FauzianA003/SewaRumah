<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf_token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://bunny.net">
        <link href="https://bunny.net/css?family=figtree:400,500,600,700,800,900&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-slate-50/50 text-slate-800">
        <!-- Mengubah kontainer utama menjadi flex row agar sidebar berada di kiri -->
        <div class="flex min-h-screen">

            <!-- Memanggil komponen Navigasi Sidebar yang baru -->
            @include('layouts.navigation')

            <!-- Konten Halaman Sebelah Kanan -->
            <div class="flex-1 flex flex-col min-w-0 overflow-y-auto">
                @isset($header)
                    <header class="bg-white border-b border-slate-100 py-6 px-8">
                        <div class="max-w-7xl mx-auto">
                            {{ $header }}
                        </div>
                    </header>
                @endisset

                <!-- Isi Workspace Halaman Utama -->
                <main class="flex-1 p-8">
                    {{ $slot }}
                </main>
            </div>
        </div>
    </body>
</html>
