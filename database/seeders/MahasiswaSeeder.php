<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data=[[
            'Nim'=>'2141720002',
            'Nama'=> 'Shin Ryujin',
            'Tanggal_Lahir'=> Carbon::create('2001', '04','17'),
            'Kelas'=> 'TI2G',
            'Jurusan'=>'Teknik Informatika',
            'Email'=> 'shin@gmail.com',
            'No_Handphone'=>'083454678989'

        ],
        [
            'Nim'=>'2141721449',
            'Nama'=> 'Choi Ji-Su',
            'Tanggal_Lahir'=> Carbon::create('2000', '05','17'),
            'Kelas'=> 'TI2H',
            'Jurusan'=>'DKV',
            'Email'=> 'choi@gmail.com',
            'No_Handphone'=>'087638978790'
        ],
        [
            'Nim'=>'2141722589',
            'Nama'=> 'Lee Jeno',
            'Tanggal_Lahir'=> Carbon::create('2000', '04','23'),
            'Kelas'=> 'TI2H',
            'Jurusan'=>'Sipil',
            'Email'=> 'jeno@gmail.com',
            'No_Handphone'=>'0876389762039'
        ],
        [
            'Nim'=>'2141720229',
            'Nama'=> 'Mark Lee',
            'Tanggal_Lahir'=> Carbon::create('1999', '08','02'),
            'Kelas'=> 'TI2G',
            'Jurusan'=>'Seni',
            'Email'=> 'mark@gmail.com',
            'No_Handphone'=>'087638976780'
        ],
        [
            'Nim'=>'2141720424',
            'Nama'=> 'Choi Siwon',
            'Tanggal_Lahir'=> Carbon::create('1989', '08','24'),
            'Kelas'=> 'TI2I',
            'Jurusan'=>'Kedokteran',
            'Email'=> 'siwon@gmail.com',
            'No_Handphone'=>'087898458790'
        ],
        [
            'Nim'=>'2141720456',
            'Nama'=> 'Jung Jaehyun',
            'Tanggal_Lahir'=> Carbon::create('1999', '03','27'),
            'Kelas'=> 'TI2F',
            'Jurusan'=>'Arsitek',
            'Email'=> 'jung@gmail.com',
            'No_Handphone'=>'087898458990'
        ]];
        DB::table('mahasiswas')->insert($data);
    }
}
