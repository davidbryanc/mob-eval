<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalHari extends Model
{
    use HasFactory;

    protected $table = "jadwalhari";
    protected $primaryKey  = "idjadwal";
}
