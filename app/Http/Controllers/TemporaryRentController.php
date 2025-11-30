<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rent;
use App\Models\Room;
use Illuminate\Support\Facades\Storage;

class TemporaryRentController extends Controller
{
    public function index()
    {
        return view('dashboard.temporaryRents.index', [
            'title' => "Daftar Peminjaman Sementara",
            'rents' => Rent::where('status', 'pending')->latest()->paginate(10),
        ]);
    }

    public function acceptRents($id)
    {
        Rent::where('id', $id)->update([
            'status' => 'dipinjam',
            'transaction_end' => now(),
        ]);

        return redirect('/dashboard/temporaryRents')->with('acceptSuccess', 'Peminjaman berhasil disetujui');
    }

    public function declineRents($id)
    {
        Rent::where('id', $id)->update([
            'status' => 'ditolak',
            'transaction_end' => now(),
        ]);

        return redirect('/dashboard/temporaryRents')->with('declineSuccess', 'Peminjaman berhasil ditolak');
    }
}
