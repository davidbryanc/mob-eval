<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $table = "mahasiswa";
    protected $primaryKey  = "nrp";
    public $timestamps = false;

    public function pelanggaran(){
		return $this->hasMany('App\Models\PelanggaranMhs', 'mahasiswa_nrp', 'nrp');
	}
}
