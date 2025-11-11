<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Rent;
use App\Models\Building;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DashboardRoomController extends Controller
{
    public function index()
    {
        return view('dashboard.rooms.index', [
            'title' => "Daftar Ruangan",
            'rooms' => Room::orderBy('created_at', 'desc')->paginate(10),
            'buildings' => Building::all(),
        ]);
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'code' => 'required|max:30|unique:rooms',
                'name' => 'required',
                'img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'floor' => 'required|integer',
                'capacity' => 'required|integer',
                'building_id' => 'required|exists:buildings,id',
                'type' => 'required',
                'description' => 'required|max:250',
            ]);

            if ($request->hasFile('img')) {
                $validatedData['img'] = $this->uploadImage($request, $validatedData['code']);
            }

            $validatedData['status'] = false;

            Room::create($validatedData);

            return redirect()->route('dashboard.rooms.index')->with('roomSuccess', 'Data ruangan berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->route('dashboard.rooms.index')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    private function uploadImage($request, $code)
    {
        $path = $request->file('img')->storeAs('public/assets/images/ruang', $code . '.' . $request->file('img')->extension());
        return 'assets/images/ruang/' . basename($path);
    }

    public function show(Room $room)
    {
        if (request()->wantsJson() || request()->ajax()) {
            return response()->json($room);
        }

        $imageUrls = [
            asset('img/lab-komputer.jpeg'),
            asset('img/lab-praktikum.jpeg'),
            asset('img/ruang-kelas.jpeg'),
        ];
        $randomImage = $imageUrls[array_rand($imageUrls)];

        return view('dashboard.rooms.show', [
            'title' => $room->name,
            'room' => $room,
            'rooms' => Room::all(),
            'rents' => Rent::where('room_id', $room->id)->get(),
            'randomImage' => $randomImage,
        ]);
    }

    public function update(Request $request, Room $room)
    {
        try {
            $rules = [
                'name' => 'required',
                'img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'floor' => 'required|integer',
                'capacity' => 'required|integer',
                'building_id' => 'required|exists:buildings,id',
                'type' => 'required',
                'description' => 'required|max:250',
            ];

            if ($request->code != $room->code) {
                $rules['code'] = 'required|max:30|unique:rooms';
            }

            $validatedData = $request->validate($rules);

            if ($request->hasFile('img')) {
                if ($room->img && Storage::exists('public/' . $room->img)) {
                    Storage::delete('public/' . $room->img);
                }

                $validatedData['img'] = $this->uploadImage($request, $validatedData['code'] ?? $room->code);
            }

            $validatedData['status'] = false;

            $room->update($validatedData);

            return redirect()->route('dashboard.rooms.index')->with('roomSuccess', 'Data ruangan berhasil diubah.');
        } catch (\Exception $e) {
            return redirect()->route('dashboard.rooms.index')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function destroy(Room $room)
    {
        if ($room->img && Storage::exists('public/' . $room->img)) {
            Storage::delete('public/' . $room->img);
        }

        $room->delete();
        return redirect()->route('dashboard.rooms.index')->with('deleteRoom', 'Data ruangan berhasil dihapus.');
    }
}
