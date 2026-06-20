@extends('layouts.app')

@section('content')
<div class="bg-gray-50 min-h-screen flex items-center justify-center py-12 px-4">
    <div class="max-w-md w-full bg-white rounded-3xl shadow-xl p-10 text-center border border-gray-100">

        <!-- Ikon Sukses -->
        <div class="inline-flex items-center justify-center w-20 h-20 bg-green-100 rounded-full mb-6">
            <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
            </svg>
        </div>

        <!-- Pesan Sukses -->
        <h1 class="text-3xl font-bold text-gray-800 mb-4">Pemesanan Berhasil!</h1>

        @if(session('message'))
            <p class="text-gray-600 mb-8 leading-relaxed">
                {{ session('message') }}
            </p>
        @else
            <p class="text-gray-600 mb-8 leading-relaxed">
                Terima kasih telah melakukan pemesanan. Tim kami akan segera menghubungi kamu melalui WhatsApp untuk proses selanjutnya.
            </p>
        @endif

        <!-- Tombol Aksi -->
        <div class="space-y-3">
            <a href="{{ route('houses.index') }}" class="block w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-4 rounded-2xl transition duration-200 shadow-lg shadow-blue-100">
                Kembali ke Beranda
            </a>
            <p class="text-sm text-gray-400 pt-4">Butuh bantuan cepat? <a href="#" class="text-blue-500 font-medium hover:underline">Hubungi CS</a></p>
        </div>

    </div>
</div>
@endsection
