<?php

namespace App\Http\Controllers;

use App\Models\Rent;
use App\Models\Room;
use Illuminate\Http\Request;

class DashboardRentController extends Controller
{
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
    // public function store(Request $request)
    // {
    //     $validatedData = $request->validate([
    //         'room_id' => 'required',
    //         'time_start_use' => 'required',
    //         'time_end_use' => 'required',
    //         'purpose' => 'required|max:250',
    //     ]);
    //     $validatedData['user_id'] = auth()->user()->id;
    //     $validatedData['transaction_start'] = now();
    //     $validatedData['status'] = 'pending';
    //     $validatedData['transaction_end'] = null;

    //     Rent::create($validatedData);

    //     return redirect('/dashboard/rents')->with('rentSuccess', 'Peminjaman diajukan. Harap tunggu konfirmasi admin.');
    // }
    public function store(Request $request)
{
    $validatedData = $request->validate([
        'room_id' => 'required',
        'time_start_use' => 'required',
        'time_end_use' => 'required|after:time_start_use',
        'purpose' => 'required|max:250',
    ]);

    // Validasi ruangan tidak bentrok
    $cekBentrok = Rent::where('room_id', $request->room_id)
        ->where(function ($query) use ($request) {
            $query->whereBetween('time_start_use', [$request->time_start_use, $request->time_end_use])
                  ->orWhereBetween('time_end_use', [$request->time_start_use, $request->time_end_use])
                  ->orWhere(function($query) use ($request) {
                      $query->where('time_start_use', '<', $request->time_start_use)
                            ->where('time_end_use', '>', $request->time_end_use);
                  });
        })
        ->where('status', '!=', 'ditolak') // opsional: abaikan yang ditolak
        ->exists();

    if ($cekBentrok) {
        return back()->withErrors(['Ruangan sudah dibooking pada waktu tersebut.'])->withInput();
    }

    $validatedData['user_id'] = auth()->user()->id;
    $validatedData['transaction_start'] = now();
    $validatedData['status'] = 'pending';
    $validatedData['transaction_end'] = null;

    Rent::create($validatedData);

    if (auth()->user()->role_id === 1) {
        return redirect('/dashboard/rents')->with('rentSuccess', 'Peminjaman diajukan. Harap tunggu konfirmasi admin.');
    } elseif (auth()->user()->role_id === 2) {
        return redirect('/daftarpinjam')->with('rentSuccess', 'Peminjaman diajukan. Harap tunggu konfirmasi admin.');
    }
}



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Rent  $rent
     * @return \Illuminate\Http\Response
     */
    public function show(Rent $rent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Rent  $rent
     * @return \Illuminate\Http\Response
     */
    public function edit(Rent $rent)
    {
        //
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
        //
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

        return redirect('/dashboard/rents');
    }
}
