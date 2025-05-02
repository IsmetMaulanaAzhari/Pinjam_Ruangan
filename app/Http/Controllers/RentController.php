<?php

namespace App\Http\Controllers;

public function store(Request $request)
{
    $request->validate([
        'ruangan_id' => 'required|exists:rooms,id',
        'tanggal' => 'required|date',
        'jam_mulai' => 'required|date_format:H:i',
        'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
    ]);

    $exists = Rent::where('ruangan_id', $request->ruangan_id)
        ->where('tanggal', $request->tanggal)
        ->where(function ($query) use ($request) {
            $query->whereBetween('jam_mulai', [$request->jam_mulai, $request->jam_selesai])
                ->orWhereBetween('jam_selesai', [$request->jam_mulai, $request->jam_selesai])
                ->orWhere(function ($query) use ($request) {
                    $query->where('jam_mulai', '<=', $request->jam_mulai)
                          ->where('jam_selesai', '>=', $request->jam_selesai);
                });
        })->exists();

    if ($exists) {
        return back()->with('error', 'Ruangan sudah dipinjam pada waktu tersebut.');
    }

    Rent::create([
        'user_id' => Auth::id(),
        'ruangan_id' => $request->ruangan_id,
        'tanggal' => $request->tanggal,
        'jam_mulai' => $request->jam_mulai,
        'jam_selesai' => $request->jam_selesai,
    ]);
}