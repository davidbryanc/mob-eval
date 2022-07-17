<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TahunMOB extends Model
{
    use HasFactory;

    protected $table = "tahunmob";
    protected $primaryKey  = "idTahunMOB";

    const UPDATED_AT = "waktuupdate";

    public function user(){
		return $this->hasOne('App\Models\User', 'updater', 'username');
	}
}
