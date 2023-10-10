<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('123456'),
                'role' => 'admin',
                'status_pengunjung' => 'umum',
                'alamat' => ''
            ],
            [
                'name' => 'Pengelola 1',
                'email' => 'pengelola1@gmail.com',
                'password' => Hash::make('123456'),
                'role' => 'pengelola',
                'status_pengunjung' => 'umum',
                'alamat' => ''
            ],
            [
                'name' => 'Pengunjung A',
                'email' => 'pengunjung@gmail.com',
                'password' => Hash::make('123456'),
                'role' => 'pengunjung',
                'status_pengunjung' => 'mahasiswa',
                'alamat' => 'Cirebon'
            ],
        ];

        DB::table('users')->insert($data);
    }
}
