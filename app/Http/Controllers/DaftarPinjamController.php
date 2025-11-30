<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rent;
use App\Models\Room;
use Illuminate\Support\Facades\Storage;

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

        // Konversi format datetime untuk SQL Server
        $timeStartUse = \Carbon\Carbon::parse($validated['time_start_use'])->format('Y-m-d H:i:s');
        $timeEndUse = \Carbon\Carbon::parse($validated['time_end_use'])->format('Y-m-d H:i:s');
        $transactionStart = \Carbon\Carbon::now()->format('Y-m-d H:i:s');

        // Simpan data peminjaman ke database
        Rent::create([
            'room_id' => $validated['room_id'],
            'user_id' => auth()->id(),
            'time_start_use' => $timeStartUse,
            'time_end_use' => $timeEndUse,
            'purpose' => $validated['purpose'],
            'transaction_start' => $transactionStart, // Waktu transaksi dimulai
            'transaction_end' => null, // Nilai awal untuk kolom transaction_end
            'status' => 'pending', // Status default
        ]);

        // Redirect ke halaman daftar pinjam dengan pesan sukses
        return redirect()->route('daftarpinjam')->with('success', 'Peminjaman berhasil diajukan.');
    }

    public function cancelRent($id)
    {
        $rent = Rent::findOrFail($id);
        
        // Pastikan hanya mahasiswa yang mengajukan yang bisa menarik
        if ($rent->user_id != auth()->id()) {
            return redirect()->route('daftarpinjam')->with('error', 'Anda tidak memiliki akses untuk menarik permintaan ini.');
        }
        
        // Pastikan status masih pending
        if ($rent->status != 'pending') {
            return redirect()->route('daftarpinjam')->with('error', 'Hanya permintaan dengan status pending yang bisa ditarik.');
        }
        
        // Hapus data peminjaman
        $rent->delete();
        
        return redirect()->route('daftarpinjam')->with('rentSuccess', 'Permintaan peminjaman berhasil ditarik.');
    }
}