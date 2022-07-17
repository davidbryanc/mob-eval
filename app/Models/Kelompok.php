<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelompok extends Model
{
    use HasFactory;

    protected $table = "kelompok";
    protected $primaryKey  = "idKelompok";

    const UPDATED_AT = "waktuupdate";

    public function tahumob(){
		return $this->belongsTo('App\Models\TahunMOB', 'tahunMOB_idTahunMOB', 'idTahunMOB');
	}

    public function user(){
		return $this->hasOne('App\Models\User', 'updater', 'username');
	}
}
