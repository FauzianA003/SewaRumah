<x-app-layout>
    <div class="bg-gray-50 min-h-screen py-10">
        <div class="container mx-auto px-4">

            <!-- Tombol Kembali -->
            <a href="{{ route('houses.index') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 mb-6 transition">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali ke Daftar Rumah
            </a>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <!-- Kolom Kiri: Informasi Rumah -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-3xl shadow-sm overflow-hidden border border-gray-100">
                        @php
                            $imageSrc = filter_var($house->thumbnail, FILTER_VALIDATE_URL)
                                        ? $house->thumbnail
                                        : asset('storage/' . $house->thumbnail);
                        @endphp

                        <img src="{{ $imageSrc }}" class="w-full h-[450px] object-cover" alt="{{ $house->title }}">

                        <div class="p-8">
                            <div class="flex justify-between items-start mb-4">
                                <h1 class="text-3xl font-bold text-gray-800">{{ $house->title }}</h1>
                                <span class="bg-green-100 text-green-700 px-4 py-1 rounded-full text-sm font-semibold">
                                    Tersedia
                                </span>
                            </div>

                            <div class="flex items-center text-gray-500 mb-6">
                                <svg class="w-5 h-5 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                </svg>
                                <span class="text-lg">{{ $house->address }}</span>
                            </div>

                            <div class="border-t border-gray-100 pt-6">
                                <h3 class="text-xl font-bold text-gray-800 mb-4">Tentang Rumah Ini</h3>
                                <p class="text-gray-600 leading-relaxed text-lg italic">
                                    {{ $house->description }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Kolom Kanan: Form Sewa (Sticky) -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-3xl shadow-xl p-8 sticky top-24 border border-blue-50">
                        <div class="mb-6">
                            <p class="text-gray-500 text-sm italic">Harga Sewa</p>
                            <div class="flex items-baseline">
                                <span class="text-3xl font-bold text-blue-600">Rp {{ number_format($house->price_per_month, 0, ',', '.') }}</span>
                                <span class="text-gray-400 ml-1">/ bulan</span>
                            </div>
                        </div>

                        <h3 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">Isi Data Penyewa</h3>

                        <form action="{{ route('bookings.store') }}" method="POST" class="space-y-4">
                            @csrf
                            <input type="hidden" name="house_id" value="{{ $house->id }}">

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Nama Lengkap</label>
                                <input type="text" name="user_name" value="{{ Auth::user()->name ?? '' }}" required
                                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:bg-white transition">
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">WhatsApp</label>
                                <input type="text" name="user_phone" placeholder="08123456789" required
                                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:bg-white transition">
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-1">Mulai Sewa</label>
                                    <input type="date" name="start_date" required
                                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:bg-white transition text-sm">
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-1">Durasi (Bln)</label>
                                    <input type="number" name="duration_months" min="1" value="1" required
                                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:bg-white transition">
                                </div>
                            </div>

                            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-4 rounded-2xl transition-all duration-300 transform hover:scale-[1.02] shadow-lg shadow-blue-200 mt-4">
                                Sewa Sekarang
                            </button>
                        </form>

                        <p class="text-[10px] text-gray-400 mt-6 text-center uppercase tracking-wider italic">Konfirmasi pesanan cepat & aman</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
