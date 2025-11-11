<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;

class DashboardUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.users.index', [
            'title' => 'Daftar Mahasiswa',
            'roles' => Role::all() ?? collect(),  // Aman meskipun tabel roles kosong
            'users' => User::where('role_id', 2)->paginate(10) ?? collect(), // Aman jika users kosong
            'user' => null, // Tambahan untuk menghindari "Undefined variable $user"
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:100',
            'nomor_induk' => 'required|min:8|unique:users,nomor_induk',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:4',
        ]);

        // Otomatis set role_id = 2 (mahasiswa)
        $validatedData['role_id'] = 2;
        $validatedData['password'] = bcrypt($validatedData['password']);

        try {
            User::create($validatedData);
            return redirect('/dashboard/users')->with('userSuccess', 'Data mahasiswa berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect('/dashboard/users')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        // Mengembalikan data user dalam format JSON (untuk AJAX edit form)
        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $rules = [
            'name' => 'required|max:100',
            'nomor_induk' => 'required|min:8',
            'email' => 'required|email',
        ];

        if ($request->nomor_induk != $user->nomor_induk) {
            $rules['nomor_induk'] = 'required|min:8|unique:users,nomor_induk';
        }

        if ($request->email != $user->email) {
            $rules['email'] = 'required|email|unique:users,email';
        }

        $validatedData = $request->validate($rules);
        $validatedData['role_id'] = 2;

        $user->update($validatedData);

        return redirect('/dashboard/users')->with('userSuccess', 'Data mahasiswa berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        try {
            User::destroy($user->id);
            return redirect('/dashboard/users')->with('deleteUser', 'Hapus data mahasiswa berhasil');
        } catch (\Exception $e) {
            return redirect('/dashboard/users')->with('error', 'Terjadi kesalahan saat menghapus: ' . $e->getMessage());
        }
    }

    /**
     * Ubah role user menjadi admin.
     */
    public function makeAdmin($id)
    {
        try {
            User::where('id', $id)->update(['role_id' => 1]);
            return redirect('/dashboard/admin')->with('adminSuccess', 'Data admin berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect('/dashboard/admin')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
