<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Mahasiswa_MatakuliahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $nilai = [
            [
                'mahasiswa_id' => 2141720001,
                'matakuliah_id' => 1,
                'nilai' => 80,
            ],
            [
                'mahasiswa_id' => 2141720001,
                'matakuliah_id' => 2,
                'nilai' => 98,
            ],
            [
                'mahasiswa_id' => 2141720001,
                'matakuliah_id' => 3,
                'nilai' => 77,
            ],
            [
                'mahasiswa_id' => 2141720001,
                'matakuliah_id' => 4,
                'nilai' => 79,
            ],
        ];
            
            DB::table('mahasiswas_matakuliah')->insert($nilai);
            
    }
}
