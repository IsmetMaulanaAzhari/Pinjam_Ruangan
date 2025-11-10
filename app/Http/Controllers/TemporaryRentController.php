<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rent;
use App\Models\Room;

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
        $rentStatus = [
            'status' => 'dipinjam',
        ];

        $rent = Rent::where('id', $id)->update($rentStatus);

<<<<<<< HEAD
        return redirect('/dashboard/temporaryRents')->with('acceptSuccess', 'Peminjaman berhasil disetujui');
=======
        return redirect('/dashboard/temporaryRents');
>>>>>>> 18f67a814eafdb41af007f183bfe0f5d74aa8ac7
    }

    public function declineRents($id)
    {
        $rentStatus = [
            'status' => 'ditolak',
        ];

        Rent::where('id', $id)->update($rentStatus);

<<<<<<< HEAD
        return redirect('/dashboard/temporaryRents')->with('declineSuccess', 'Peminjaman berhasil ditolak');
=======
        return redirect('/dashboard/temporaryRents');
>>>>>>> 18f67a814eafdb41af007f183bfe0f5d74aa8ac7
    }
}
