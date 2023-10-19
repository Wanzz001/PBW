<x-app-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <div class="w-full max-w-screen-xl mx-auto px-6 py-4 bg-white shadow-md sm:rounded-lg">

            <form method="POST" action="{{ route('detailTransaction.update') }}">
                @csrf

                <!-- Wandi Ridwansyah -->
                <!-- 6706228808 -->

                <div class="mt-4">
                    <x-input-label for="idTransaksi" :value="__('ID Transaksi')" />
                    <x-text-input id="idTransaksi" class="block mt-1 w-full" type="text" name="idTransaksi" :value="$detailTransaksi -> idTransaksi" readonly />
                </div>

                <div class="mt-4">
                    <x-input-label for="idDetailTransaksi" :value="__('ID Detail Transaksi')" />
                    <x-text-input id="idDetailTransaksi" class="block mt-1 w-full" type="text" name="idDetailTransaksi" :value="$detailTransaksi -> id" readonly />
                </div>

                <div class="mt-4">
                    <x-input-label for="idPeminjam" :value="__('Peminjam')" />
                    <x-text-input id="idPeminjam" class="block mt-1 w-full" type="text" name="idPeminjam" :value="$detailTransaksi -> namaPeminjam" readonly />
                </div>

                <div class="mt-4">
                    <x-input-label for="idPetugas" :value="__('Petugas')" />
                    <x-text-input id="idPetugas" class="block mt-1 w-full" type="text" name="idPetugas" :value="$detailTransaksi -> namaPetugas" readonly />
                </div>

                <div class="mt-4">
                    <x-input-label for="koleksi" :value="__('Koleksi')" />
                    <x-text-input id="koleksi" class="block mt-1 w-full" type="text" name="koleksi" :value="$detailTransaksi -> koleksi" readonly />
                </div>

                <div class="mt-4">
                    <x-input-label for="status" :value="__('Status')" />
                    <select name="status" id="status" class="block mt-1 w-full form-select">
                        <option value="1" @if(old('status', $detailTransaksi->status) == 1) selected @endif>Pinjam</option>
                        <option value="2" @if(old('status', $detailTransaksi->status) == 2) selected @endif>Kembali</option>
                        <option value="3" @if(old('status', $detailTransaksi->status) == 3) selected @endif>Hilang</option>
                    </select>
                </div>

                <input type="hidden" value="{{ $detailTransaksi -> idKoleksi }}" id="idKoleksi" name="idKoleksi">

                <div class="flex items-center justify-end mt-4">
                    <x-primary-button class="ml-3">
                        {{ __('Update') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>