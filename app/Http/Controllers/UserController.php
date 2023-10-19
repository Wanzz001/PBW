<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\DataTables\UsersDataTable;

// Nama: Wandi Ridwansyah
// NIM: 6706220080
// Kelas: 46-03
class UserController extends User
{
    public function index(UsersDataTable $dataTable)
    {
        return $dataTable->render('user.daftarPengguna');
    }

    public function create()
    {
        return view('user.registrasi');
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => ['required', 'string', 'max:100'],
            'fullname' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'address' => ['required', 'string', 'max:1000'],
            'birthdate' => ['required', 'date'],
            'phonenumber' => ['required', 'string', 'max:20'],
            'religion' => ['required', 'string', 'max:20'],
            'gender' => ['required', 'integer', 'in:0,1']
        ]);

        $user = User::create([
            'username' => $request->username,
            'fullname' => $request->fullname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'address' => $request->address,
            'birthdate' => $request->birthdate,
            'phoneNumber' => $request->phonenumber,
            'religion' => $request->religion,
            'gender' => $request->gender
        ]);

        return redirect()->route('user.index');
    }

    public function show(User $user)
    {
        return view('user.infoPengguna', compact('user'));
    }


    // Nama: Wandi Ridwansyah
    // NIM: 6706220080
    // Kelas: 46-03

    public function updateUser(Request $request)
    {
        $request->validate([
            'fullname' => ['required', 'string', 'max:100'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'address' => ['required', 'string', 'max:1000'],
            'phonenumber' => ['required', 'string', 'max:20'],
        ]);


        DB::table('users')
            ->where('id', $request->id)
            ->update([
                'fullname' => $request->fullname,
                'password' => Hash::make($request->password),
                'address' => $request->address,
                'phoneNumber' => $request->phonenumber
            ]);

        return redirect()->route('user.index');
    }
}
