<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggaran extends Model
{
    use HasFactory;

    protected $table = "pelanggaran";
    protected $primaryKey  = "idPelanggaran";

    const UPDATED_AT = "waktuupdate";

    public function user(){
		return $this->hasOne('App\Models\User', 'updater', 'username');
	}

    public function tahumob(){
		return $this->hasOne('App\Models\TahunMOB', 'tahunMOB_idTahunMOB', 'idTahunMOB');
	}
}
