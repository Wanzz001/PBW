<x-app-layout>
    <style>
        .buttons-copy,
        .buttons-excel,
        .buttons-csv,
        .buttons-pdf,
        .buttons-print {
            display: none;
        }
    </style>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Transaksi') }}
        </h2>
    </x-slot>
    <!-- Nama: Wandi Ridwansyah -->
    <!-- NIM: 6706220080 -->
    <!-- Kelas: 46-03 -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="container p-4">
                    <a href="{{ route('transaction.create')}}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-3">Tambah Transaksi</a>
                    <div class="container mt-4">
                        <div class="card">
                            <div class="card-body overflow-x-auto">
                                {{ $dataTable->table() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
    @endpush
</x-app-layout>