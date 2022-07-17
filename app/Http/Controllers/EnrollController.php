<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Panitia;
use Auth;
use Illuminate\Http\Request;

class EnrollController extends Controller
{
    public function index()
    {
        return view('enroll');
    }

    public function get_faculty($nrp){
        $code = substr($nrp, -8, 1);
        $faculty = "-";
        switch ($code) {
            case "1":
                $faculty = "FARMASI";
                break;
            case "2":
                $faculty = "HUKUM";
                break;
            case "3":
                $faculty = "FBE";
                break;
            case "4":
                $faculty = "POLITEKNIK";
                break;
            case "5":
                $faculty = "PSIKOLOGI";
                break;
            case "6":
                $faculty = "TEKNIK";
                break;
            case "7":
                $faculty = "TEKNOBIOLOGI";
                break;
            case "8":
                $faculty = "INDUSTRI KREATIF";
                break;
            case "9":
                $faculty = "KEDOKTERAN";
                break;
            default:
                break;
        }
        return $faculty;
    }

    public function get_student(Request $request){
		$nrp = $request->get("nrp");
        $mhs = Mahasiswa::where('nrp','LIKE','%'.$nrp.'%')->whereNull('kelompok_id')->get();
        $mahasiswa = array();
        foreach ($mhs as $m) {
            $add_faculty = array(
                'nrp' => $m->nrp,
                'nama' => strtoupper($m->nama),
                'fakultas' => $this->get_faculty($m->nrp)
            );
            array_push($mahasiswa, $add_faculty);
        }

        return response()->json(array(
            'msg'=>view('enroll_student', compact('mahasiswa'))->render(),
        ),200);
	}

    public function set_kelompok(Request $request){
		$nrp = $request->get("nrp");
        $mahasiswa = Mahasiswa::where('nrp', $nrp)->first();

        $user = Auth::user();
        $panitia = Panitia::where('nrpnpk', $user->username)->first();

        $mahasiswa->kelompok_id = $panitia->kelompok_idKelompok;
        $saved = $mahasiswa->save();

        $msg = "not";
        if ($saved) 
            $msg = 'ok';

        return response()->json(array(
            'msg'=>$msg,
        ),200);
	}
}
