<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-extrabold text-xl text-gray-900 tracking-tight">
                {{ __('Dashboard Workspace') }}
            </h2>
            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold tracking-wider uppercase {{ Auth::user()->email == 'admin@gmail.com' ? 'bg-indigo-50 text-indigo-700 border border-indigo-200' : 'bg-emerald-50 text-emerald-700 border border-emerald-200' }}">
                <span class="w-1.5 h-1.5 mr-1.5 rounded-full {{ Auth::user()->email == 'admin@gmail.com' ? 'bg-indigo-500' : 'bg-emerald-500' }}"></span>
                {{ Auth::user()->email == 'admin@gmail.com' ? 'Platform Admin' : 'Penyewa Properti' }}
            </span>
        </div>
    </x-slot>

    <div class="py-2 bg-slate-50/50 min-h-screen font-sans">
        <div class="max-w-7xl mx-auto space-y-6">

            <!-- Welcome Hub Banner -->
            <div class="relative overflow-hidden bg-indigo-900 shadow-xl rounded-3xl p-8 text-white" style="background-color: #1e1b4b !important;">
                <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#ffffff_1px,transparent_1px)] [background-size:16px_16px]"></div>
                <div class="relative z-10 max-w-2xl">
                    <p class="text-indigo-300 text-xs font-bold tracking-widest uppercase mb-1">Manajemen Real Estate</p>
                    <h3 class="text-3xl font-black tracking-tight sm:text-4xl">
                        Selamat Datang Kembali, {{ Auth::user()->name }}!
                    </h3>
                    <p class="text-slate-300 mt-2 text-sm leading-relaxed font-medium">
                        Akses instan ke katalog properti, pantau siklus transaksi sewa, dan kelola operasional hunian Anda dalam satu ruang kendali terpusat.
                    </p>
                </div>
            </div>

            <!-- TAMPILAN GRID STATISTIK MODERN (KHUSUS ADMIN) -->
            @if(Auth::user()->email == 'admin@gmail.com')
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">

                    <!-- Card 1: Total Properti -->
                    <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm flex items-center gap-4">
                        <div class="p-3 bg-blue-50 text-blue-600 rounded-xl">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Total Rumah</p>
                            <h4 class="text-2xl font-black text-slate-800 mt-0.5">{{ $totalHouses ?? 0 }}</h4>
                        </div>
                    </div>

                    <!-- Card 2: Rumah Disewa -->
                    <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm flex items-center gap-4">
                        <div class="p-3 bg-emerald-50 text-emerald-600 rounded-xl">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Rumah Disewa</p>
                            <h4 class="text-2xl font-black text-slate-800 mt-0.5">{{ $totalBookings ?? 0 }}</h4>
                        </div>
                    </div>

                    <!-- Card 3: Pending Pembayaran -->
                    <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm flex items-center gap-4">
                        <div class="p-3 bg-amber-50 text-amber-600 rounded-xl">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Menunggu BRI</p>
                            <h4 class="text-2xl font-black text-amber-600 mt-0.5">{{ $pendingBookings ?? 0 }}</h4>
                        </div>
                    </div>

                    <!-- Card 4: Status Pendapatan -->
                    <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm flex items-center gap-4">
                        <div class="p-3 bg-indigo-50 text-indigo-600 rounded-xl">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M12 16V15"></path></svg>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Total Pendapatan</p>
                            <h4 class="text-xl font-black text-indigo-600 mt-0.5">Aktif</h4>
                        </div>
                    </div>

                </div>
            @endif

            <!-- Pusat Kendali Operasional Admin -->
            @if(Auth::user()->email == 'admin@gmail.com')
                <div class="bg-white p-8 rounded-3xl shadow-sm border border-slate-100">
                    <div class="border-b border-slate-100 pb-5 mb-6">
                        <h4 class="text-lg font-extrabold text-slate-800 tracking-tight">Pusat Kendali Operasional</h4>
                        <p class="text-xs text-slate-400 mt-0.5">Pilih tindakan cepat di bawah ini untuk memperbarui ekosistem persewaan.</p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <a href="{{ route('admin.houses.create') }}" class="group relative flex items-start gap-4 p-5 rounded-2xl border border-slate-100 bg-slate-50/50 hover:bg-indigo-600 hover:border-indigo-600 transition-all duration-300 shadow-sm hover:shadow-md hover:-translate-y-0.5">
                            <div class="p-3 bg-indigo-50 text-indigo-600 rounded-xl group-hover:bg-indigo-500 group-hover:text-white transition-colors">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"></path></svg>
                            </div>
                            <div>
                                <h5 class="font-bold text-slate-800 group-hover:text-white transition-colors text-sm sm:text-base">Tambah Katalog Baru</h5>
                                <p class="text-slate-400 group-hover:text-indigo-200 transition-colors text-xs mt-0.5">Ekspansi bisnis dengan memasukkan data unit rumah atau apartemen baru.</p>
                            </div>
                        </a>

                        <a href="{{ route('bookings.index') }}" class="group relative flex items-start gap-4 p-5 rounded-2xl border border-slate-100 bg-slate-50/50 hover:bg-indigo-600 hover:border-indigo-600 transition-all duration-300 shadow-sm hover:shadow-md hover:-translate-y-0.5">
                            <div class="p-3 bg-emerald-50 text-emerald-600 rounded-xl group-hover:bg-indigo-500 group-hover:text-white transition-colors">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                            </div>
                            <div>
                                <h5 class="font-bold text-slate-800 group-hover:text-white transition-colors text-sm sm:text-base">Verifikasi Pesanan Masuk</h5>
                                <p class="text-slate-400 group-hover:text-indigo-200 transition-colors text-xs mt-0.5">Tinjau lembar invoice sewa dan validasi pengajuan verifikasi pengguna.</p>
                            </div>
                        </a>
                    </div>
                </div>
            @endif
            <!-- TAMPILAN KHUSUS USER BIASA -->
            @if(Auth::user()->email !== 'admin@gmail.com')
                <div class="bg-white p-8 rounded-3xl shadow-sm border border-slate-100">
                    <div class="flex items-center justify-between border-b border-slate-100 pb-5 mb-6">
                        <div>
                            <h4 class="text-lg font-extrabold text-slate-800 tracking-tight">Log Aktivitas Sewa Anda</h4>
                            <p class="text-xs text-slate-400 mt-0.5">Daftar kesepakatan sewa properti aktif dan pengajuan terkini.</p>
                        </div>
                    </div>

                    <div class="divide-y divide-slate-100">
                        @forelse($myRecentBookings ?? [] as $recent)
                            <div class="py-4 flex flex-col sm:flex-row sm:items-center justify-between gap-4 group">
                                <div class="flex items-center gap-3.5">
                                    <div class="p-2.5 bg-slate-50 text-slate-500 rounded-xl group-hover:bg-indigo-50 group-hover:text-indigo-600 transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                                    </div>
                                    <div>
                                        <p class="font-bold text-slate-800 text-sm sm:text-base group-hover:text-indigo-600 transition-colors">{{ $recent->house->title }}</p>
                                        <p class="text-xs text-slate-400 mt-0.5 font-medium">Diajukan: {{ $recent->created_at->format('d M Y') }} <span class="mx-1.5">•</span> Durasi: {{ $recent->duration_months }} Bulan</p>
                                    </div>
                                </div>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold tracking-wide uppercase {{ $recent->status == 'pending' ? 'bg-amber-50 text-amber-700 border border-amber-200' : 'bg-emerald-50 text-emerald-700 border border-emerald-200' }}">
                                    {{ $recent->status }}
                                </span>
                            </div>
                        @empty
                            <div class="py-12 text-center">
                                <div class="w-16 h-16 bg-slate-50 text-slate-300 rounded-2xl flex items-center justify-center mx-auto mb-4">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"></path></svg>
                                </div>
                                <p class="text-slate-400 font-medium text-sm">Anda belum memiliki riwayat kontrak hunian apapun saat ini.</p>
                                <a href="{{ url('/houses') }}" class="inline-flex items-center gap-1.5 mt-3 text-xs font-bold text-indigo-600 hover:text-indigo-700 transition-all hover:underline">
                                    Cari Properti Pertama Anda
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"></path></svg>
                                </a>
                            </div>
                        @endforelse
                    </div>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
