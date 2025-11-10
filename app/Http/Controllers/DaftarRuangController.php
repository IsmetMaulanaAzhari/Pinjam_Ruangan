<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Rent;
use App\Models\Building;

class DaftarRuangController extends Controller
{
    public function index(Request $request)
    {
        $query = Room::query();

        // Filter berdasarkan gedung
        if ($request->has('building_id') && $request->building_id) {
            $query->where('building_id', $request->building_id);
        }

        // Filter berdasarkan tanggal dan waktu
        if ($request->has('date') && $request->has('time') && $request->date && $request->time) {
            $datetime = $request->date . ' ' . $request->time;

            $query->whereDoesntHave('rentals', function ($q) use ($datetime) {
                $q->where('time_start_use', '<=', $datetime)
                  ->where('time_end_use', '>=', $datetime);
            });
        }

        return view('daftarruang', [
            'title' => "Daftar Ruang",
            'rooms' => $query->orderBy('created_at', 'desc')->paginate(6),
            'buildings' => Building::all(),
        ]);
    }

    public function show(Room $room)
    {
        return view('showruang', [
            'title' => $room->name,
            'room' => $room,
            'rooms' => Room::all(),
            'rents' => Rent::where('room_id', $room->id)->latest()->paginate(5), 
        ]);
    }
}