<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Panitia extends Model
{
    use HasFactory;

    protected $table = 'panitia';
	protected $primaryKey = 'idPanitia';
    
    const UPDATED_AT = "waktuupdate";

    public function divisi(){
		return $this->belongsTo('App\Models\Divisi', 'divisi_idDivisi', 'idDivisi');
	}

    public function tahumob(){
		return $this->belongsTo('App\Models\TahunMOB', 'tahunMOB_idTahunMOB', 'idTahunMOB');
	}

    public function kelompok(){
		return $this->hasOne('App\Models\Kelompok', 'kelompok_idKelompok', 'idKelompok');
	}

    public function user(){
		return $this->hasOne('App\Models\User', 'updater', 'username');
	}
}
