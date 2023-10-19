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
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                @csrf

                <!-- Wandi Ridwansyah -->
                <!-- 6706228808 -->
                <div class="container p-4">
                    <div class="mt-4">
                        <x-input-label for="peminjam" :value="__('Peminjam')" />
                        <x-text-input id="peminjam" class="block mt-1 w-full" type="text" name="peminjam" :value="$transactionData->fullnamePeminjam" readonly />
                    </div>


                    <div class="mt-4">
                        <x-input-label for="petugas" :value="__('Petugas')" />
                        <x-text-input id="petugas" class="block mt-1 w-full" type="text" name="petugas" :value="$transactionData->fullnamePetugas" readonly />
                    </div>

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