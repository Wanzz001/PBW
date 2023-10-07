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
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">

                <div class="container p-4">
                    <h1 class="text-2xl font-semibold mb-4 text-white">Users</h1>

                    <a href="{{ route('user.create')}}" class="text-white">Tambah User</a>

                    <table class="ml-12 mt-6">
                        <thead>
                            <tr>
                                <th class="border px-6 py-2 text-white">No</th>
                                <th class="border px-6 py-2 text-white">Nama</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $index => $user)
                            <tr>
                                <td class="border px-6 py-2 text-white">{{ $index + 1 }}</td>
                                <td class="border px-6 py-2 text-white">
                                    <a href="{{ route('user.show', $user->id) }}">{{ $user->fullname }}</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>