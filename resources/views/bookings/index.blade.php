<x-app-layout>
    <div class="bg-gray-50 min-h-screen py-10">
        <div class="container mx-auto px-4">

            <!-- Pesan Notifikasi Berhasil -->
            @if(session('message'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl mb-6 flex justify-between">
                    <span>{{ session('message') }}</span>
                    <button onclick="this.parentElement.remove()" class="font-bold">&times;</button>
                </div>
            @endif

            <div class="flex justify-between items-center mb-8">
                <h1 class="text-2xl font-bold text-gray-800">Daftar Pesanan Masuk (Admin)</h1>
                <span class="bg-blue-600 text-white px-4 py-1 rounded-full text-sm font-bold shadow-sm">
                    Total: {{ $bookings->count() }}
                </span>
            </div>

            <div class="bg-white rounded-2xl shadow-sm overflow-hidden border border-gray-100">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-100">
                            <th class="px-6 py-4 text-sm font-semibold text-gray-600 uppercase">Penyewa</th>
                            <th class="px-6 py-4 text-sm font-semibold text-gray-600 uppercase">Rumah</th>
                            <th class="px-6 py-4 text-sm font-semibold text-gray-600 uppercase text-center">Status</th>
                            <th class="px-6 py-4 text-sm font-semibold text-gray-600 uppercase text-right">Harga Total</th>
                            <th class="px-6 py-4 text-sm font-semibold text-gray-600 uppercase text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse($bookings as $booking)
                            <tr class="hover:bg-blue-50/30 transition duration-150">
                                <td class="px-6 py-4">
                                    <p class="font-bold text-gray-800">{{ $booking->user_name }}</p>
                                    <a href="https://wa.me{{ $booking->user_phone }}" target="_blank" class="text-xs text-blue-500 hover:underline flex items-center mt-1">
                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.438 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.149-.174.198-.298.297-.497.099-.198.05-.372-.025-.521-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                                        {{ $booking->user_phone }}
                                    </a>
                                </td>
                                <td class="px-6 py-4">
                                    <p class="text-gray-600 font-medium">{{ $booking->house->title ?? 'Rumah Dihapus' }}</p>
                                    <p class="text-xs text-gray-400 italic">{{ $booking->duration_months }} Bulan</p>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <form action="{{ route('bookings.updateStatus', $booking->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <select name="status" onchange="this.form.submit()"
                                            class="text-xs font-bold uppercase rounded-lg px-2 py-1 border-gray-200 focus:ring-0 cursor-pointer shadow-sm
                                            {{ $booking->status == 'pending' ? 'bg-yellow-100 text-yellow-700' : ($booking->status == 'confirmed' ? 'bg-blue-100 text-blue-700' : 'bg-green-100 text-green-700') }}">
                                            <option value="pending" {{ $booking->status == 'pending' ? 'selected' : '' }}>Tertunda</option>
                                            <option value="confirmed" {{ $booking->status == 'confirmed' ? 'selected' : '' }}>Dikonfirmasi</option>
                                            <option value="completed" {{ $booking->status == 'completed' ? 'selected' : '' }}>Selesai</option>
                                        </select>
                                    </form>
                                </td>
                                <td class="px-6 py-4 font-bold text-gray-800 text-right">
                                    Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus pesanan ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-400 hover:text-red-600 transition p-2 hover:bg-red-50 rounded-lg">
                                            <svg class="w-5 h-5 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-16 text-center text-gray-400 italic">
                                    Belum ada pesanan yang masuk.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
