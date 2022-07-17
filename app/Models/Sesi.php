<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sesi extends Model
{
    use HasFactory;

    protected $table = "sesiacara";
    protected $primaryKey  = "idSesi";

    const UPDATED_AT = 'waktuupdate';

    public function jadwal(){
      return $this->belongsTo('App\Models\JadwalHari', 'tanggal', 'tanggal');
    }

    public function tahunmob(){
      return $this->hasOne('App\Models\TahunMOB', 'tahunMOB_idTahunMOB', 'idTahunMOB');
    }

    public function user(){
      return $this->hasOne('App\Models\User', 'updater', 'username');
    }
}
