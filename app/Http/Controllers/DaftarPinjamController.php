<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rent;
use App\Models\Room;

class DaftarPinjamController extends Controller
{
    public function index()
    {
        return view('daftarpinjam', [
            'userRents' => Rent::where('user_id', auth()->user()->id)->latest()->paginate(5),
            'title' => "Daftar Pinjam",
            'rooms' => Room::all(),
        ]);
    }

    public function store(Request $request)
    {
        // Validasi input dari form
        $validated = $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'time_start_use' => 'required|date|before:time_end_use',
            'time_end_use' => 'required|date|after:time_start_use',
            'purpose' => 'required|string|max:255',
        ]);

        // Simpan data peminjaman ke database
        Rent::create([
            'room_id' => $validated['room_id'],
            'user_id' => auth()->id(),
            'time_start_use' => $validated['time_start_use'],
            'time_end_use' => $validated['time_end_use'],
            'purpose' => $validated['purpose'],
            'transaction_start' => now(), // Waktu transaksi dimulai
            'transaction_end' => null, // Nilai awal untuk kolom transaction_end
            'status' => 'pending', // Status default
        ]);

        // Redirect ke halaman daftar pinjam dengan pesan sukses
        return redirect()->route('daftarpinjam')->with('success', 'Peminjaman berhasil diajukan.');
    }
}