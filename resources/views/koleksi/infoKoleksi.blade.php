<x-guest-layout>

    <form method="POST" action="{{ route('collection.update') }}">
        @csrf

        <!-- Wandi Ridwansyah -->
        <!-- 6706228808 -->

        <div class="mt-4">
            <x-input-label for="idKoleksi" :value="__('ID Koleksi')" />
            <x-text-input id="idKoleksi" class="block mt-1 w-full" type="text" name="id" :value="$collection -> id" readonly/>
        </div>


        <div class="mt-4">
            <x-input-label for="namaKoleksi" :value="__('Nama Koleksi')" />
            <x-text-input id="namaKoleksi" class="block mt-1 w-full" type="text" name="namaKoleksi" :value="$collection -> namaKoleksi" />
            <x-input-error :messages="$errors->get('namaKoleksi')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="jenisKoleksi" :value="__('Jenis Koleksi')" />
            <div class="flex items-center">
                <input class="mr-2 leading-tight" type="radio" id="buku" name="jenisKoleksi" value="1" @if(old('jenisKoleksi', $collection->jenisKoleksi) == 1) checked @endif required autofocus>
                <label class="ml-2" for="buku">
                    Buku
                </label>
            </div>

            <div class="flex items-center mt-2">
                <input class="mr-2 leading-tight" type="radio" id="majalah" name="jenisKoleksi" value="2" @if(old('jenisKoleksi', $collection->jenisKoleksi) == 2) checked @endif required>
                <label class="ml-2" for="majalah">
                    Majalah
                </label>
            </div>

            <div class="flex items-center mt-2">
                <input class="mr-2 leading-tight" type="radio" id="cakramDigital" name="jenisKoleksi" value="3" @if(old('jenisKoleksi', $collection->jenisKoleksi) == 3) checked @endif  required>
                <label class="ml-2" for="cakramDigital">
                    Cakram Digital
                </label>
            </div>

            <x-input-error :messages="$errors->get('jenisKoleksi')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="jumlahKoleksi" :value="__('Jumlah Koleksi')" />
            <x-text-input id="jumlahKoleksi" class="block mt-1 w-full" type="text" name="jumlahKoleksi" :value="$collection -> jumlahKoleksi" />
            <x-input-error :messages="$errors->get('jumlahKoleksi')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ml-3">
                {{ __('Update') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>