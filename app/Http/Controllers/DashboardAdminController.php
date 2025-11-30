<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DashboardAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.admin.index', [
            'title' => "Daftar Admin",
            'admins' => User::where('role_id', 1)->orderBy('created_at', 'desc')->get(),
            'users' => User::where('role_id', 2)->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:100',
            'nomor_induk' => 'required|min:8|unique:users,nomor_induk',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:4'
        ]);

        $validatedData['role_id'] = 1;
        $validatedData['password'] = bcrypt($validatedData['password']);

        try {
            User::create($validatedData);
            return redirect('/dashboard/admin')->with('adminSuccess', 'Data admin berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect('/dashboard/admin')->with('deleteAdmin', 'Error: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return json_encode($user);
    }

    public function editRoom($id)
    {
        $room = Room::findOrFail($id);
        return view('dashboard.admin.edit-room', compact('room'));
    }

    public function updateRoom(Request $request, $id)
    {
        $room = Room::findOrFail($id);
        $room->update($request->all());

        return redirect()->route('dashboard.admin')->with('success', 'Ruangan berhasil diubah');
    }
        /**
     * Update the specified resource in storage.
     *
 * @param  \Illuminate\Http\Request  $request
 * @param  \App\Models\User  $user
 * @return \Illuminate\Http\Response
 */
public function update(Request $request, User $admin)
{
    $rules = [
        'name' => 'required|max:100',
        'nomor_induk' => 'required|min:8',
        'email' => 'required|email',
        'password' => 'nullable|min:4',
    ];

    if ($request->nomor_induk != $admin->nomor_induk) {
        $rules['nomor_induk'] = 'required|min:8|unique:users,nomor_induk';
    }

    if ($request->email != $admin->email) {
        $rules['email'] = 'required|email|unique:users,email';
    }

    $validatedData = $request->validate($rules);
    // handle optional password
    if ($request->filled('password')) {
        $validatedData['password'] = bcrypt($request->password);
    } else {
        unset($validatedData['password']);
    }

    $validatedData['role_id'] = 1;

    $admin->update($validatedData);

    return redirect('/dashboard/admin')->with('adminSuccess', 'Data Admin berhasil diubah');
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $admin)
    {
        $admin->delete();
        return redirect('/dashboard/admin')->with('deleteAdmin', 'Hapus data admin berhasil');
    }
    

    public function removeAdmin($id)
    {
        $adminData = [
            'role_id' => 1
        ];

        User::where('id', $id)->update($adminData);

        return redirect('/dashboard/admin');
    }

    public function demoteAdmin($id)
    {
        $user = User::findOrFail($id);
        
        // Update role_id dari 1 (admin) menjadi 2 (mahasiswa)
        $user->update([
            'role_id' => 2
        ]);

        return redirect('/dashboard/users')->with('userSuccess', 'Admin berhasil diturunkan menjadi mahasiswa');
    }
}
