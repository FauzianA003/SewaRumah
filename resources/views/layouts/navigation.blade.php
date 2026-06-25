<nav class="w-64 bg-white border-r border-slate-100 min-h-screen flex flex-col justify-between p-6">
    <div class="space-y-8">
        <!-- Logo Brand -->
        <div class="flex items-center gap-3 px-2">
            <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
            <span class="font-black text-slate-800 tracking-tight text-lg">SewaRumah</span>
        </div>

        <!-- Menu Navigasi Vertikal -->
        <div class="flex flex-col gap-1.5">
            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider px-2 mb-2">Main Menu</p>

            <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-bold transition-all {{ request()->routeIs('dashboard') ? 'bg-indigo-50 text-indigo-600' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-800' }}">
                Dashboard
            </a>

            <a href="{{ url('/houses') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-bold transition-all {{ request()->is('houses*') && !request()->is('admin*') ? 'bg-indigo-50 text-indigo-600' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-800' }}">
                Beranda
            </a>

            <a href="{{ route('bookings.my') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-bold transition-all {{ request()->routeIs('bookings.my') ? 'bg-indigo-50 text-indigo-600' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-800' }}">
                Sewa Saya
            </a>

            <!-- Menu Khusus Admin -->
            @if(Auth::user()->email === 'admin@gmail.com')
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider px-2 mt-4 mb-2">Admin Panel</p>

                <a href="{{ route('admin.houses.create') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-bold transition-all {{ request()->routeIs('admin.houses.create') ? 'bg-indigo-50 text-indigo-600' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-800' }}">
                    + Tambah Rumah
                </a>

                <a href="{{ route('bookings.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-bold transition-all {{ request()->routeIs('bookings.index') ? 'bg-indigo-50 text-indigo-600' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-800' }}">
                    Daftar Pesanan
                </a>
            @endif

            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider px-2 mt-4 mb-2">Support</p>
            <a href="{{ route('kontak') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-bold transition-all {{ request()->routeIs('kontak') ? 'bg-indigo-50 text-indigo-600' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-800' }}">
                Kontak
            </a>
        </div>
    </div>

    <!-- Identitas Pengguna & Tombol Logout -->
    <div class="border-t border-slate-100 pt-4 space-y-3">
        <div class="px-2">
            <p class="text-sm font-bold text-slate-800 truncate">{{ Auth::user()->name }}</p>
            <p class="text-xs text-slate-400 truncate mt-0.5">{{ Auth::user()->email }}</p>
        </div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full text-left flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-bold text-rose-600 hover:bg-rose-50 transition-all">
                Keluar Aplikasi
            </button>
        </form>
    </div>
</nav>
