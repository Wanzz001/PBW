@extends('layouts.app')

@section('content')
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <div class="w-full max-w-screen-xl mx-auto px-6 py-4 bg-white shadow-md sm:rounded-lg">
            <h2 class="text-2xl font-semibold text-gray-800 leading-tight mb-4">{{ __('Tambah Transaksi') }}</h2>

            <form method="POST" action="{{ route('transaksi.store') }}">
                @csrf

                <!-- Peminjam -->
                <div class="mt-4">
                    <x-input-label for="idPeminjam" :value="__('Peminjam*')" />
                    <select name="idPeminjam" id="idPeminjam" class="block mt-1 w-full form-select" required>
                        <option value="">--Pilih Dahulu--</option>
                        @foreach($users as $user)
                        @if($user->id == old('idPeminjam'))
                        <option value="{{ $user->id }}" selected>{{ $user->name }}</option>
                        @elseif($user->id != auth()->user()->id)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endif
                        @endforeach
                    </select>
                </div>


                <div class="mt-4">
                    <x-input-label for="idKendaraan" :value="__('Kendaraan*')" />
                    <select name="idKendaraan" id="idKendaraan" class="block mt-1 w-full form-select" required>
                        <option value="-1">--Pilih Dahulu--</option>
                        @foreach($vehicles as $vehicle)
                        <option value="{{ $vehicle->id }}" @if($vehicle->id == old('idKendaraan')) selected @endif>{{ $vehicle->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mt-4">
                    <x-input-label for="startDate" :value="__('Start*')" />
                    <input type="date" name="startDate" id="startDate" class="block mt-1 w-full form-control" required>
                </div>

                <div class="mt-4">
                    <x-input-label for="endDate" :value="__('End*')" />
                    <input type="date" name="endDate" id="endDate" class="block mt-1 w-full form-control" required>
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
    @endsection

