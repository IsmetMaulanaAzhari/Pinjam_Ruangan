<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Room;
use Illuminate\Http\Request;

class DashboardAdminController extends Controller
{
    public function index()
    {
        return view('dashboard.admin.index', [
            'title' => "Daftar Admin",
            'admins' => User::where('role_id', 1)->get(),
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:100',
            'nomor_induk' => 'required|min:8|unique:users,nomor_induk',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:4',
        ]);

        $validatedData['role_id'] = 1;
        $validatedData['password'] = bcrypt($validatedData['password']);

        User::create($validatedData);

        return redirect()->route('dashboard.admin.index')->with('adminSuccess', 'Data admin berhasil ditambahkan');
    }

    public function edit(User $admin)
    {
        return view('dashboard.admin.edit', [
            'title' => "Edit Admin",
            'admin' => $admin,
        ]);
    }

    public function update(Request $request, $id)
    {
        $admin = User::findOrFail($id);

        $rules = [
            'name' => 'required|max:100',
            'email' => 'required|email|unique:users,email,' . $id,
        ];

        if ($request->nomor_induk != $admin->nomor_induk) {
            $rules['nomor_induk'] = 'required|min:8|unique:users,nomor_induk';
        }

        $validatedData = $request->validate($rules);
        $admin->update($validatedData);

        return redirect()->route('dashboard.admin.index')->with('adminSuccess', 'Data admin berhasil diubah');
    }

    public function destroy($id)
    {
        $admin = User::findOrFail($id);
        $admin->delete();

        return redirect()->route('dashboard.admin.index')->with('deleteAdmin', 'Data admin berhasil dihapus');
    }

    // Custom room update
    public function updateRoom(Request $request, $id)
    {
        $room = Room::findOrFail($id);
        $room->update($request->all());

        return redirect()->route('dashboard.admin.index')->with('success', 'Ruangan berhasil diubah');
    }

    public function removeAdmin($id)
    {
        User::where('id', $id)->update(['role_id' => 2]);
        return redirect()->route('dashboard.admin.index')->with('adminSuccess', 'Admin berhasil dihapus dari daftar.');
    }
}
