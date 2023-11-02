@extends('layouts.app')

@section('content')
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <div class="w-full max-w-screen-xl mx-auto px-6 py-4 bg-white shadow-md sm:rounded-lg">

            <form method="POST" action="{{ route('transaksi.update') }}">
                @csrf

                <div class="mt-4">
                    <x-input-label for="idTransaksi" :value="__('ID Transaksi')" />
                    <x-text-input id="idTransaksi" class="block mt-1 w-full" type="text" name="idTransaksi" :value="$transaksi -> id" readonly />
                </div>

                <div class="mt-4">
                    <x-input-label for="idPeminjam" :value="__('Peminjam')" />
                    <x-text-input id="idPeminjam" class="block mt-1 w-full" type="text" name="idPeminjam" :value="$transaksi -> peminjam" readonly />
                </div>

                <div class="mt-4">
                    <x-input-label for="kendaraan" :value="__('Kendaraan')" />
                    <x-text-input id="kendaraan" class="block mt-1 w-full" type="text" name="kendaraan" :value="$transaksi -> kendaraan" readonly />
                </div>

                <div class="mt-4">
                    <x-input-label for="start" :value="__('Start')" />
                    <x-text-input id="start" class="block mt-1 w-full" type="text" name="start" :value="$transaksi -> start" readonly />
                </div>

                <div class="mt-4">
                    <x-input-label for="end" :value="__('End')" />
                    <x-text-input id="end" class="block mt-1 w-full" type="text" name="end" :value="$transaksi -> end" readonly />
                </div>

                <div class="mt-4">
                    <x-input-label for="price" :value="__('Harga')" />
                    <x-text-input id="price" class="block mt-1 w-full" type="text" name="price" :value="$transaksi -> price" readonly />
                </div>

                <div class="mt-4">
                    <x-input-label for="status" :value="__('Status')" />
                    <select name="status" id="status" class="block mt-1 w-full form-select">
                        <option value="1" @if(old('status', $transaksi->status) == 1) selected @endif>Pinjam</option>
                        <option value="2" @if(old('status', $transaksi->status) == 2) selected @endif>Kembali</option>
                        <option value="3" @if(old('status', $transaksi->status) == 3) selected @endif>Hilang</option>
                    </select>
                </div>

                <div class="flex items-center justify-end mt-4">
                    <x-primary-button class="ml-3">
                        {{ __('Update') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
    @endsection