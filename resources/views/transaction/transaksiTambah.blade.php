<x-app-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <div class="w-full max-w-screen-xl mx-auto px-6 py-4 bg-white shadow-md sm:rounded-lg">
            <h2 class="text-2xl font-semibold text-gray-800 leading-tight mb-4">{{ __('Tambah Transaksi') }}</h2>

            <form method="POST" action="{{ route('transaction.store') }}">
                @csrf

                <!-- Nama: Wandi Ridwansyah -->
                <!-- NIM: 6706220080 -->
                <!-- Kelas: 46-03 -->

                <!-- Peminjam -->
                <div class="mt-4">
                    <x-input-label for="idPeminjam" :value="__('Peminjam')" />
                    <select name="idPeminjam" id="idPeminjam" class="block mt-1 w-full form-select" required>
                        <option value="">Pilih Dahulu</option>
                        @foreach($users as $user)
                        @if($user->id == old('idPeminjam'))
                        <option value="{{ $user->id }}" selected>{{ $user->fullname }}</option>
                        @elseif($user->id != auth()->user()->id)
                        <option value="{{ $user->id }}">{{ $user->fullname }}</option>
                        @endif
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('idPeminjam')" class="mt-2" />
                </div>


                <!-- Koleksi -->
                <div class="mt-4">
                    <x-input-label for="idKoleksi1" :value="__('Koleksi')" />
                    <select name="idKoleksi1" id="idKoleksi1" class="block mt-1 w-full form-select" required>
                        <option value="-1">Pilih Dahulu</option>
                        @foreach($collections as $collection)
                        <option value="{{ $collection->id }}" @if($collection->id == old('idKoleksi1')) selected @endif>{{ $collection->namaKoleksi }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('idKoleksi')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="idKoleksi2" :value="__('Koleksi')" />
                    <select name="idKoleksi2" id="idKoleksi2" class="block mt-1 w-full form-select">
                        <option value="-1">Pilih Dahulu</option>
                        @foreach($collections as $collection)
                        <option value="{{ $collection->id }}" @if($collection->id == old('idKoleksi')) selected @endif>{{ $collection->namaKoleksi }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('idKoleksi')" class="mt-2" />
                </div>

                <!-- Submit Button -->
                <div class="flex items-center justify-end mt-6">
                    <x-primary-button>
                        {{ __('Submit') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>