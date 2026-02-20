<?php

namespace App\Http\Controllers;

use App\Models\Rent;
use App\Models\Room;
use Illuminate\Http\Request;
use App\Traits\RoomAvailabilityTrait;
use Carbon\Carbon;

class DashboardRentController extends Controller
{
    use RoomAvailabilityTrait;
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.rents.index', [
            'adminRents' => Rent::latest()->paginate(10),
            'userRents' => Rent::where('user_id', auth()->user()->id)->get(),
            'title' => "Peminjaman",
            'rooms' => Room::all(),
        ]);
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
            'room_id' => 'required',
            'time_start_use' => 'required|date',
            'time_end_use' => 'required|date|after:time_start_use',
            'purpose' => 'required|max:250',
        ]);

        // Log untuk debugging
        \Log::info('Validasi peminjaman ruangan', [
            'room_id' => $request->room_id,
            'time_start_use' => $request->time_start_use,
            'time_end_use' => $request->time_end_use
        ]);

        // Validasi ketersediaan ruangan
        if (!$this->isRoomAvailable($request->room_id, $request->time_start_use, $request->time_end_use)) {
            // Untuk debugging, kita bisa lihat peminjaman yang overlap
            $overlaps = $this->getOverlappingBookings($request->room_id, $request->time_start_use, $request->time_end_use);
            \Log::warning('Ruangan tidak tersedia - bentrok dengan peminjaman lain', [
                'overlapping_bookings' => $overlaps->toArray()
            ]);
            
            return back()->withErrors(['room_id' => 'Ruangan sudah dibooking pada waktu tersebut.'])->withInput();
        }

        // Pastikan format waktu konsisten sebelum disimpan
        $validatedData['time_start_use'] = Carbon::parse($request->time_start_use)->format('Y-m-d H:i:s');
        $validatedData['time_end_use'] = Carbon::parse($request->time_end_use)->format('Y-m-d H:i:s');
        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['transaction_start'] = now();
        $validatedData['status'] = 'pending';
        $validatedData['transaction_end'] = null;

        // Simpan data
        $newRent = Rent::create($validatedData);
        \Log::info('Peminjaman berhasil dibuat', ['rent_id' => $newRent->id]);

        if (auth()->user()->role_id === 1) {
            return redirect('/dashboard/rents')->with('rentSuccess', 'Peminjaman diajukan. Harap tunggu konfirmasi admin.');
        } elseif (auth()->user()->role_id === 2) {
            return redirect('/daftarpinjam')->with('rentSuccess', 'Peminjaman diajukan. Harap tunggu konfirmasi admin.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Rent  $rent
     * @return \Illuminate\Http\Response
     */
    public function edit(Rent $rent)
    {
        return view('dashboard.rents.edit', [
            'rent' => $rent,
            'rooms' => Room::all(),
            'title' => 'Edit Peminjaman'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Rent  $rent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rent $rent)
    {
        $validatedData = $request->validate([
            'room_id' => 'required',
            'time_start_use' => 'required|date',
            'time_end_use' => 'required|date|after:time_start_use',
            'purpose' => 'required|max:250',
        ]);

        // Validasi ketersediaan ruangan (kecualikan peminjaman saat ini)
        if (!$this->isRoomAvailable($request->room_id, $request->time_start_use, $request->time_end_use, $rent->id)) {
            return back()->withErrors(['room_id' => 'Ruangan sudah dibooking pada waktu tersebut.'])->withInput();
        }

        // Pastikan format waktu konsisten
        $validatedData['time_start_use'] = Carbon::parse($request->time_start_use)->format('Y-m-d H:i:s');
        $validatedData['time_end_use'] = Carbon::parse($request->time_end_use)->format('Y-m-d H:i:s');
        
        // Pertahankan status peminjaman yang sudah ada
        $validatedData['status'] = $rent->status;

        Rent::where('id', $rent->id)->update($validatedData);
        \Log::info('Peminjaman berhasil diupdate', ['rent_id' => $rent->id]);

        return redirect('/dashboard/rents')->with('updateSuccess', 'Data peminjaman berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rent  $rent
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rent $rent)
    {
        Rent::destroy($rent->id);
        \Log::info('Peminjaman berhasil dihapus', ['rent_id' => $rent->id]);
        return redirect('/dashboard/rents')->with('deleteRent', 'Data peminjaman berhasil dihapus');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Rent  $rent
     * @return \Illuminate\Http\Response
     */
    public function endTransaction($id)
    {
        $transaction = [
            'transaction_end' => now(),
            'status' => 'selesai',
        ];

        Rent::where('id', $id)->update($transaction);
        \Log::info('Transaksi peminjaman berhasil diselesaikan', ['rent_id' => $id]);

        return redirect('/dashboard/rents');
    }
    
    /**
     * Metode untuk menampilkan detail peminjaman yang bentrok
     * Berguna untuk troubleshooting
     */
    public function checkOverlaps(Request $request)
    {
        $request->validate([
            'room_id' => 'required',
            'time_start_use' => 'required|date',
            'time_end_use' => 'required|date|after:time_start_use',
        ]);
        
        $overlaps = $this->getOverlappingBookings(
            $request->room_id,
            $request->time_start_use,
            $request->time_end_use
        );
        
        return view('dashboard.rents.check-overlaps', [
            'overlaps' => $overlaps,
            'room' => Room::find($request->room_id),
            'start_time' => $request->time_start_use,
            'end_time' => $request->time_end_use,
            'title' => 'Pengecekan Bentrok Peminjaman'
        ]);
    }
}