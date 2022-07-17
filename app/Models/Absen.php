<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absen extends Model
{
    use HasFactory;

    protected $table = "mahasiswa_absen_sesiacara";
	public $timestamps = false; 
    const UPDATED_AT = 'waktuupdate';

    public function mahasiswa(){
		return $this->belongsTo('App\Models\Mahasiswa', 'maharu_nrp', 'nrp');
	}

    public function sesi(){
		return $this->belongsTo('App\Models\Sesi', 'sesiAcara_idSesi', 'idSesi');
	}

    public function user(){
		return $this->hasOne('App\Models\User', 'updater', 'username');
	}

    public function tahumob(){
		return $this->hasOne('App\Models\TahunMOB', 'tahunMOB_idTahunMOB', 'idTahunMOB');
	}
}
