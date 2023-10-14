<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>
<!-- Nama: Wandi Ridwansyah -->
<!-- NIM: 6706220080 -->
<!-- Kelas: 46-03 -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="container mx-auto p-4">
                    <h1 class="text-2xl font-semibold mb-4">Detail User</h1>
                    <div class="shadow-md rounded px-8 pt-6 pb-8 mb-4">
                        <div class="mb-4">
                            <strong>Fullname: </strong> {{ $user->fullname }}
                        </div>
                        <div class="mb-4 ">
                            <strong>Email: </strong> {{ $user->email }}
                        </div>
                        <div class="mb-4">
                            <strong>Username: </strong> {{ $user->username }}
                        </div>
                        <div class="mb-4">
                            <strong>Alamat: </strong> {{ $user->address }}
                        </div>
                        <div class="mb-4">
                            <strong>No Telepon: </strong> {{ $user->phoneNumber }}
                        </div>
                        <div class="mb-4">
                            <strong>Tanggal Lahir: </strong> {{ $user->birthdate}}
                        </div>
                        <div class="mb-4">
                            <strong>Agama: </strong> {{ $user->religion }}
                        </div>
                        @php
                        $gender = '';
                        switch ($user->gender) {
                        case 0:
                        $gender = 'Wanita';
                        break;
                        case 1:
                        $gender = 'Pria';
                        break;
                        }
                        @endphp
                        <div class="mb-4">
                            <strong>Jenis Kelamin: </strong> {{ $gender }}
                        </div>
                    </div>
                    <a href="{{ route('user.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-3">
                        Kembali ke Daftar User
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
