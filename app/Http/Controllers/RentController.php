<?php

namespace App\Http\Controllers;
public function store(Request $request)
{
    $request->validate([
        'ruangan_id' => 'required',
        'tanggal_peminjaman' => 'required|date',
        'jam_mulai' => 'required',
        'jam_selesai' => 'required|after:jam_mulai',
    ]);

    $cekBentrok = Peminjaman::where('ruangan_id', $request->ruangan_id)
        ->where('tanggal_peminjaman', $request->tanggal_peminjaman)
        ->where(function($query) use ($request) {
            $query->whereBetween('jam_mulai', [$request->jam_mulai, $request->jam_selesai])
                  ->orWhereBetween('jam_selesai', [$request->jam_mulai, $request->jam_selesai])
                  ->orWhere(function($query) use ($request) {
                      $query->where('jam_mulai', '<', $request->jam_mulai)
                            ->where('jam_selesai', '>', $request->jam_selesai);
                  });
        })
        ->exists();

    if ($cekBentrok) {
        return back()->withErrors(['Ruangan sudah dibooking pada jam tersebut.'])->withInput();
    }

    // Jika tidak bentrok, simpan data
    Peminjaman::create([
        'user_id' => auth()->id(),
        'ruangan_id' => $request->ruangan_id,
        'tanggal_peminjaman' => $request->tanggal_peminjaman,
        'jam_mulai' => $request->jam_mulai,
        'jam_selesai' => $request->jam_selesai,
    ]);

    return redirect()->route('rent.index')->with('success', 'Peminjaman berhasil disimpan.');
}
