<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Faculty;
use App\Models\Building;
use App\Models\Room;
use App\Models\Admin;
use App\Models\Role;
use App\Models\Rent;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        { {
            }
        }
        // \Ap{{ p\Mo }}dels\User::factory()->create([
        //    {{  'na }}me' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Role::create([
            'name' => 'admin',
        ]);

        Role::create([
            'name' => 'mahasiswa',
        ]);

        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin'),
            'nomor_induk' => '21312131',
            'role_id' => 1,
        ]);

        User::create([
            'name' => 'Mahasiswa',
            'email' => 'mahasiswa@gmail.com',
            'password' => bcrypt('mahasiswa'),
            'nomor_induk' => '21312109',
            'role_id' => 2,
        ]);
        
        user::create([
            'name' => 'Ramadhan Umbara',
            'email' => '3337230060@untirta.ac.id',
            'password' => bcrypt('rama1029'),
            'nomor_induk' => '3337230060',
            'role_id' => 2,
        ]);
        
        user::create([
            'name' => 'Ismet',
            'email' => '3337230014@untirta.ac.id',
            'password' => bcrypt('ismet'),
            'nomor_induk' => '3337230014',
            'role_id' => 1,
        ]);

        Building::create([
            'code' => 'R',
            'name' => 'Gedung U',
        ]);

        Building::create([
            'code' => 'BR',
            'name' => 'Gedung BR',
        ]);

        Building::create([
            'code' => 'COE',
            'name' => 'Gedung COE',
        ]);

        Building::create([
            'code' => 'Aula',
            'name' => 'Aula',
        ]);

        Room::create([
            'code' => '2-1',
            'name' => 'R 2-1',
            'img' => 'assets/images/ruang/r1.jpg',
            'floor' => 2,
            'status' => false,
            'capacity' => 50,
            'type' => 'Ruang Kelas',
            'description' => 'Ruangan dengan fasilitas TV sebagai media presentasi ataupun pembelajaran, dengan pencahayaan yang redup sehingga bikin ngantuk',
            'building_id' => 1,
        ]);

        Room::create([
            'code' => '2-2',
            'name' => 'R 2-2',
            'img' => 'assets/images/ruang/r1.jpg',
            'floor' => 2,
            'status' => false,
            'capacity' => 50,
            'type' => 'Ruang Kelas',
            'description' => 'Ruangan dengan fasilitas TV sebagai media presentasi ataupun pembelajaran, dengan pencahayaan yang redup sehingga bikin ngantuk',
            'building_id' => 1,
        ]);

        Room::create([
            'code' => '2-3',
            'name' => 'R 2-3',
            'img' => 'assets/images/ruang/r1.jpg',
            'floor' => 2,
            'status' => false,
            'capacity' => 50,
            'type' => 'Ruang Kelas',
            'description' => 'Ruangan dengan fasilitas TV sebagai media presentasi ataupun pembelajaran, dengan pencahayaan yang redup sehingga bikin ngantuk',
            'building_id' => 1,
        ]);

        
        Room::create([
            'code' => '1-1',
            'name' => 'BR 1-1',
            'img' => 'assets/images/ruang/br1.jpg',
            'floor' => 1,
            'status' => false,
            'capacity' => 50,
            'type' => 'Ruang Kelas',
            'description' => 'Ruangan dengan fasilitas TV sebagai media presentasi ataupun pembelajaran, dengan pencahayaan yang terang dan AC yang kurang dingin sehingga gk bikin ngantuk',
            'building_id' => 2,
        ]);

        Room::create([
            'code' => '1-2',
            'name' => 'BR 1-2',
            'img' => 'assets/images/ruang/br2.jpg',
            'floor' => 1,
            'status' => false,
            'capacity' => 50,
            'type' => 'Ruang Kelas',
            'description' => 'Ruangan dengan fasilitas TV sebagai media presentasi ataupun pembelajaran, dengan pencahayaan yang terang dan AC yang kurang dingin sehingga gk bikin ngantuk',
            'building_id' => 2,
        ]);

        Room::create([
            'code' => '1-3',
            'name' => 'BR 1-3',
            'img' => 'assets/images/ruang/br2.jpg',
            'floor' => 1,
            'status' => false,
            'capacity' => 50,
            'type' => 'Ruang Kelas',
            'description' => 'Ruangan dengan fasilitas TV sebagai media presentasi ataupun pembelajaran, dengan pencahayaan yang terang dan AC yang kurang dingin sehingga gk bikin ngantuk',
            'building_id' => 2,
        ]);

        Room::create([
            'code' => '3-1',
            'name' => 'COE 3-1',
            'img' => 'assets/images/ruang/coeg.jpg',
            'floor' => 3,
            'status' => false,
            'capacity' => 50,
            'type' => 'Ruang Kelas',
            'description' => 'Ruangan dengan fasilitas proyektor sebagai media presentasi ataupun pembelajaran, tapi anehnya ruangan tersebut cukup terpapar cahaya sehingga proyektor tidak bekerja secara maksimal, tapi nilai plus nya ruangannya gede dan luas',
            'building_id' => 3,
        ]);

        Room::create([
            'code' => '3-2',
            'name' => 'COE 3-2',
            'img' => 'assets/images/ruang/coek.jpg',
            'floor' => 3,
            'status' => false,
            'capacity' => 20,
            'type' => 'Ruang Kelas',
            'description' => 'Ruangan dengan fasilitas TV sebagai media presentasi ataupun pembelajaran, ruangan paling kecil namun sesuai dengan kapasitasnya, namun minusnya colokan dibagian belakang tidak bekerja',
            'building_id' => 3,
        ]);
        
        Room::create([
            'code' => '3-3',
            'name' => 'COE 3-3',
            'img' => 'assets/images/ruang/coek.jpg',
            'floor' => 3,
            'status' => false,
            'capacity' => 20,
            'type' => 'Ruang Kelas',
            'description' => 'Ruangan dengan fasilitas TV sebagai media presentasi ataupun pembelajaran, ruangan paling kecil namun sesuai dengan kapasitasnya, namun minusnya colokan dibagian belakang tidak bekerja',
            'building_id' => 3,
        ]);

        Room::create([
            'code' => '3-4',
            'name' => 'COE 3-4',
            'img' => 'assets/images/ruang/coegkv.jpg',
            'floor' => 3,
            'status' => false,
            'capacity' => 50,
            'type' => 'Ruang Kelas',
            'description' => 'Ruangan dengan fasilitas TV sebagai media presentasi ataupun pembelajaran, ruangan dengan interior paling berbeda dan nyaman menurut admin, ada jendela di sebelah kanan yang memancarkan cahaya yang cukup untuk mencerahkan ruangan',
            'building_id' => 3,
        ]);

        Room::create([
            'code' => 'Aula',
            'name' => 'Aula',
            'img' => 'assets/images/ruang/aula2.jpg',
            'floor' => 1,
            'status' => false,
            'capacity' => 100,
            'type' => 'Ruang Umum',
            'description' => 'Aula dengan fasilitas proyektor sebagai media presentasi, namun anehnya aula ini sangat terpapar oleh cahaya, sehingga membuat proyektor tidak bekerja secara maksimal, di sini juga banyak colokan yang scam',
            'building_id' => 4,
        ]);
    }
}