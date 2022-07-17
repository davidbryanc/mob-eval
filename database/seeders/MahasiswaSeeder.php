<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=10; $i <= 20; $i++) { 
            DB::table('mahasiswa')->insert([
                'nrp' => '1604180'.$i,
                'nama' => str_shuffle('Anasthasya Averina'),
                'kelompok_id' => 'Anjing 1'
            ]);
        }
    }
}
