<x-app-layout>
    <div class="bg-gray-50 min-h-screen py-10">
        <div class="container mx-auto px-4">
            <h1 class="text-3xl font-bold text-gray-800 mb-8">Riwayat Sewa Saya</h1>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @forelse($bookings as $booking)
                    <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100 flex flex-col md:flex-row gap-6 relative">
                        <!-- Thumbnail Rumah -->
                        <div class="w-full md:w-32 h-32 flex-shrink-0">
                            @php
                                $thumb = filter_var($booking->house->thumbnail, FILTER_VALIDATE_URL)
                                         ? $booking->house->thumbnail
                                         : asset('storage/' . $booking->house->thumbnail);
                            @endphp
                            <img src="{{ $thumb }}" class="w-full h-full object-cover rounded-xl" alt="{{ $booking->house->title }}">
                        </div>

                        <!-- Informasi Sewa -->
                        <div class="flex-grow">
                            <div class="flex justify-between items-start mb-2">
                                <h2 class="text-xl font-bold text-gray-800">{{ $booking->house->title }}</h2>
                                <span class="px-3 py-1 rounded-full text-xs font-bold uppercase
                                    {{ $booking->status == 'pending' ? 'bg-yellow-100 text-yellow-700' : ($booking->status == 'confirmed' ? 'bg-blue-100 text-blue-700' : 'bg-green-100 text-green-700') }}">
                                    {{ $booking->status }}
                                </span>
                            </div>
                            <p class="text-sm text-gray-500 mb-4">{{ $booking->house->address }}</p>

                            <div class="grid grid-cols-2 gap-4 text-sm border-t pt-4">
                                <div>
                                    <p class="text-gray-400">Durasi</p>
                                    <p class="font-semibold">{{ $booking->duration_months }} Bulan</p>
                                </div>
                                <div>
                                    <p class="text-gray-400">Total Tagihan</p>
                                    <p class="font-bold text-blue-600">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</p>
                                </div>
                            </div>

                            <!-- TOMBOL MEMBUKA POP-UP PEMBAYARAN BRI -->
                            @if($booking->status == 'pending')
                                <div class="mt-6">
                                    <button onclick="openPaymentModal({{ $booking->id }}, '{{ number_format($booking->total_price, 0, ',', '.') }}')" class="w-full bg-blue-600 hover:bg-blue-700 text-white text-sm font-bold py-3 rounded-xl transition shadow-md flex items-center justify-center gap-2">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                                        Bayar Sekarang (BRI)
                                    </button>
                                </div>
                            @endif

                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-20 text-center">
                        <div class="bg-white p-10 rounded-3xl shadow-sm border border-gray-100 inline-block">
                            <p class="text-gray-400 italic mb-4">Kamu belum memiliki riwayat sewa.</p>
                            <a href="{{ url('/houses') }}" class="text-blue-600 font-bold hover:underline">Cari Rumah Sekarang</a>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- STRUKTUR MODAL POP-UP GABUNGAN: REKENING & BARCODE BRI -->
    <div id="customPaymentModal" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm hidden items-center justify-center z-50 p-4">
        <div class="bg-white rounded-3xl p-6 max-w-sm w-full shadow-2xl border border-slate-100 text-center max-h-[90vh] overflow-y-auto">

            <h4 class="text-lg font-black text-slate-800">Metode Pembayaran</h4>
            <p class="text-xs text-slate-400 mt-1 mb-4">Silakan pilih transfer rekening atau scan barcode BRI di bawah ini.</p>

            <!-- OPSI 1: INFORMASI TRANSFER REKENING BANK BRI -->
            <div class="p-4 bg-blue-50/60 rounded-2xl border border-blue-100 text-left mb-3">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-[10px] font-black text-blue-700 bg-blue-100 px-2 py-0.5 rounded-md tracking-wider">PILIHAN 1: TRANSFER REKENING BRI</span>
                </div>
                <p class="text-[10px] uppercase font-bold text-slate-400 tracking-wider">No. Rekening:</p>
                <p class="font-mono text-sm font-bold text-slate-800 tracking-wide">0341-01-000123-30-5</p>
                <p class="text-[10px] uppercase font-bold text-slate-400 tracking-wider mt-1.5">Atas Nama (A/N):</p>
                <p class="text-xs font-bold text-slate-600">PT SEWA RUMAH INDONESIA</p>
            </div>

            <!-- OPSI 2: INSTRUKSI SCAN BARCODE BRI (QRIS OFFLINE) -->
            <div class="p-4 bg-blue-50/40 rounded-2xl border border-blue-200 text-center mb-4">
                <span class="text-[10px] font-black text-blue-700 bg-blue-100 px-2 py-0.5 rounded-md inline-block mb-2 tracking-wider">PILIHAN 2: SCAN BARCODE BRI</span>
                <div class="p-2 bg-white rounded-xl border border-slate-100 inline-block w-full">
                    <!-- Membaca file barcode-BRI.png dari folder public Anda secara offline -->
                    <img src="{{ asset('barcode-BRI.png') }}" alt="Scan Barcode BRI" class="w-36 h-36 mx-auto object-contain">
                </div>
            </div>

            <!-- Ringkasan Nilai Tagihan -->
            <div class="p-3 rounded-xl mb-5 text-center border border-slate-200" style="background-color: #1e293b !important;">
                <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider">Total Pembayaran:</p>
                <p id="modalTotalPrice" class="text-base font-black text-white mt-0.5" style="color: #ffffff !important;">Rp 0</p>
            </div>

            <!-- Form Pengirim Konfirmasi Pengubahan Status Otomatis -->
            <form id="confirmPaymentForm" action="" method="POST">
                @csrf
                @method('PATCH')
                <button type="submit" class="w-full text-white font-bold py-3 rounded-xl text-sm transition mb-2 shadow-sm" style="background-color: #4f46e5 !important;">
                    Saya Sudah Transfer
                </button>
            </form>

            <button onclick="closePaymentModal()" class="w-full bg-slate-100 hover:bg-slate-200 text-slate-500 font-semibold py-2.5 rounded-xl text-xs transition">
                Batal
            </button>
        </div>
    </div>

    <!-- INTEGRASI LOGIKA JAVASCRIPT POP-UP MODAL -->
    <script>
        function openPaymentModal(bookingId, formattedPrice) {
            // Memasang URL rute PATCH dinamis sesuai ID data sewa yang diklik
            document.getElementById('confirmPaymentForm').action = "/my-bookings/" + bookingId + "/confirm";
            // Menyuntikkan nominal harga sewa secara dinamis ke panel modal
            document.getElementById('modalTotalPrice').innerText = "Rp " + formattedPrice;

            // Mengubah status tampilan modal menjadi muncul (flex)
            document.getElementById('customPaymentModal').classList.remove('hidden');
            document.getElementById('customPaymentModal').classList.add('flex');
        }

        function closePaymentModal() {
            // Menyembunyikan kembali modal dari layar (hidden)
            document.getElementById('customPaymentModal').classList.remove('flex');
            document.getElementById('customPaymentModal').classList.add('hidden');
        }
    </script>
</x-app-layout>
