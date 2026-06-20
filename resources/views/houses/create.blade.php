<x-app-layout>
    <div class="bg-gray-50 min-h-screen py-12">
        <div class="container mx-auto px-4">
            <div class="max-w-2xl mx-auto">

                <!-- Tombol Kembali -->
                <a href="{{ route('houses.index') }}" class="inline-flex items-center text-gray-500 hover:text-blue-600 mb-6 transition">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali
                </a>

                <div class="bg-white rounded-3xl shadow-sm p-8 border border-gray-100">
                    <h1 class="text-2xl font-bold text-gray-800 mb-8">Tambah Rumah Baru</h1>

                    <form action="{{ route('admin.houses.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf

                        <!-- Judul Rumah -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Nama / Judul Rumah</label>
                            <input type="text" name="title" required placeholder="Contoh: Rumah Minimalis Modern"
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition shadow-sm">
                        </div>

                        <!-- Harga & Alamat -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Harga per Bulan (Rp)</label>
                                <input type="number" name="price_per_month" required placeholder="Contoh: 2000000"
                                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition shadow-sm">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Alamat Singkat</label>
                                <input type="text" name="address" required placeholder="Contoh: Jakarta Selatan"
                                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition shadow-sm">
                            </div>
                        </div>

                        <!-- Deskripsi -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi Lengkap</label>
                            <textarea name="description" rows="4" required placeholder="Jelaskan fasilitas rumah..."
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition shadow-sm"></textarea>
                        </div>

                        <!-- Upload Gambar -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Foto Rumah</label>
                            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-2xl bg-gray-50 hover:bg-gray-100 transition">
                                <div class="space-y-1 text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <div class="flex text-sm text-gray-600">
                                        <label for="thumbnail" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none">
                                            <span>Upload file gambar</span>
                                            <input id="thumbnail" name="thumbnail" type="file" class="sr-only" accept="image/*">
                                        </label>
                                    </div>
                                    <p class="text-xs text-gray-500 italic">PNG, JPG, JPEG hingga 2MB</p>
                                </div>
                            </div>
                        </div>

                        <!-- Tombol Submit -->
                        <div class="pt-4">
                            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-4 rounded-2xl transition-all duration-300 shadow-lg shadow-blue-100 transform hover:scale-[1.01]">
                                Simpan Data Rumah
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
