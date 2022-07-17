<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PelanggaranMhs extends Model
{
    use HasFactory;

    protected $table = "mahasiswa_has_pelanggaran";
	public $timestamps = false;

    public function mahasiswa(){
		return $this->belongsTo('App\Models\Mahasiswa', 'mahasiswa_nrp', 'nrp');
	}

    public function pelanggaran(){
		return $this->belongsTo('App\Models\Pelanggaran', 'pelanggaran_idPelanggaran', 'idPelanggaran');
	}

    public function jadwalhari(){
		return $this->belongsTo('App\Models\JadwalHari', 'jadwalhari_idjadwal', 'idJadwal');
	}

    public function user(){
		return $this->hasOne('App\Models\User', 'updater', 'username');
	}

    public function tahumob(){
		return $this->hasOne('App\Models\TahunMOB', 'tahunMOB_idTahunMOB', 'idTahunMOB');
	}
}
