<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:role-list|role-create|role-edit|role-delete'], ['only' => ['index', 'show']]);
        $this->middleware(['permission:role-create'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:role-edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:role-delete'], ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with('role')->get();
        $roles = Role::all();
        return view('users.index', compact('users', 'roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'regex:/^[A-Za-z0-9_.]+$/', 'unique:users,username'],
            'nik' => ['nullable', 'numeric', 'digits_between:16,20'],
            'jabatan' => ['nullable', 'string', 'max:100'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'regex:/[a-z]/', 'regex:/[A-Z]/', 'regex:/[0-9]/', 'regex:/[@$!%*#?&]/',],
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'name.string' => 'Nama lengkap harus berupa teks.',
            'name.max' => 'Nama lengkap maksimal 255 karakter.',

            'username.required' => 'Username wajib diisi.',
            'username.string' => 'Username harus berupa teks.',
            'username.max' => 'Username maksimal 255 karakter.',
            'username.unique' => 'Username sudah digunakan, silakan pilih yang lain.',
            'username.regex' => 'Username hanya boleh berisi huruf, angka, titik, dan underscore tanpa spasi.',

            'nik.numeric'         => 'NIK/NIP harus berupa angka.',
            'nik.digits_between'  => 'NIK/NIP harus terdiri dari 16 sampai 20 digit angka.',

            'jabatan.string' => 'Jabatan harus berupa teks.',
            'jabatan.max' => 'Jabatan maksimal 100 karakter.',

            'email.required' => 'Alamat email wajib diisi.',
            'email.string' => 'Alamat email harus berupa teks.',
            'email.email' => 'Format email tidak valid.',
            'email.max' => 'Alamat email maksimal 255 karakter.',
            'email.unique' => 'Alamat email sudah terdaftar.',

            'password.required' => 'Kata sandi wajib diisi.',
            'password.string' => 'Kata sandi harus berupa teks.',
            'password.min' => 'Kata sandi minimal 8 karakter.',
            'password.regex' => 'Kata sandi harus mengandung huruf besar, huruf kecil, angka, dan simbol.',
        ]);

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'nik' => $request->nik,
            'jabatan' => $request->jabatan,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->syncRoles($request->roles);

        toast('Data berhasil ditambahkan!', 'success');
        return redirect()->route('user.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        return view('users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'regex:/^[A-Za-z0-9_.]+$/', Rule::unique('users', 'username')->ignore($id)],
            'nik' => ['nullable', 'numeric', 'digits_between:16,20'],
            'jabatan' => ['nullable', 'string', 'max:100'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users', 'email')->ignore($id)],
            'password' => ['nullable', 'string', 'min:8', 'regex:/[a-z]/', 'regex:/[A-Z]/', 'regex:/[0-9]/', 'regex:/[@$!%*#?&]/',],
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'name.string' => 'Nama lengkap harus berupa teks.',
            'name.max' => 'Nama lengkap maksimal 255 karakter.',

            'username.required' => 'Username wajib diisi.',
            'username.string' => 'Username harus berupa teks.',
            'username.max' => 'Username maksimal 255 karakter.',
            'username.unique' => 'Username sudah digunakan, silakan pilih yang lain.',
            'username.regex' => 'Username hanya boleh berisi huruf, angka, titik, dan underscore tanpa spasi.',

            'nik.numeric'         => 'NIK/NIP harus berupa angka.',
            'nik.digits_between'  => 'NIK/NIP harus terdiri dari 16 sampai 20 digit angka.',

            'jabatan.string' => 'Jabatan harus berupa teks.',
            'jabatan.max' => 'Jabatan maksimal 100 karakter.',

            'email.required' => 'Alamat email wajib diisi.',
            'email.string' => 'Alamat email harus berupa teks.',
            'email.email' => 'Format email tidak valid.',
            'email.max' => 'Alamat email maksimal 255 karakter.',
            'email.unique' => 'Alamat email sudah terdaftar.',

            'password.string' => 'Kata sandi harus berupa teks.',
            'password.min' => 'Kata sandi minimal 8 karakter.',
            'password.regex' => 'Kata sandi harus mengandung huruf besar, huruf kecil, angka, dan simbol.',
        ]);

        $user = User::findOrFail($id);

        $user->update([
            'name' => $request->name,
            'username' => $request->username,
            'nik' => $request->nik,
            'jabatan' => $request->jabatan,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->syncRoles($request->roles);

        toast('Data berhasil diperbarui!', 'success');
        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        toast('Data berhasil dihapus!', 'success');
        return redirect()->route('user.index');
    }
    public function updateRole(Request $request)
    {
        $request->validate([
            'role_id' => 'required|exists:roles,id',
            'user_id' => 'required',
        ]);

        $userId = $request->user_id;
        $roleId = $request->role_id;

        $user = User::findOrFail($userId);
        $user->role_id = $roleId;
        $user->save();

        toast('Role berhasil diubah', 'success');
        return redirect()->route('user.index');
    }
}
