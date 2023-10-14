<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Collections') }}
        </h2>
    </x-slot>
<!-- Nama: Wandi Ridwansyah -->
<!-- NIM: 6706220080 -->
<!-- Kelas: 46-03 -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="container mx-auto p-4">
                    <h1 class="text-2xl font-semibold mb-4 ">Detail Koleksi</h1>

                    <div class="shadow-md rounded px-8 pt-6 pb-8 mb-4 ">
                        <div class="mb-4 ">
                            <strong>Nama Koleksi:</strong> {{ $collection->namaKoleksi }}
                        </div>
                        @php
                        $jenisKoleksi = '';
                        switch ($collection->jenisKoleksi) {
                        case 1:
                        $jenisKoleksi = 'Buku';
                        break;
                        case 2:
                        $jenisKoleksi = 'Majalah';
                        break;
                        case 3:
                        $jenisKoleksi = 'Cakram Digital';
                        break;
                        }
                        @endphp
                        <div class="mb-4">
                            <strong>Jenis Koleksi:</strong> {{ $jenisKoleksi }}
                        </div>
                        <div class="mb-4">
                            <strong>Jumlah Koleksi:</strong> {{ $collection->jumlahKoleksi }}
                        </div>
                    </div>

                    <a href="{{ route('collection.index') }}" class="bg-blue-500 hover:bg-blue-700  font-bold py-2 px-4 rounded text-white">
                        Kembali ke Daftar Koleksi
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>