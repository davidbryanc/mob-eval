<?php

namespace App\Http\Controllers;

use App\Models\JadwalHari;
use App\Models\Sesi;
use App\Models\Panitia;
use App\Models\Mahasiswa;
use App\Models\Pelanggaran;
use App\Models\Absen;
use App\Models\PelanggaranMhs;
use Auth;
use DB;
use Illuminate\Http\Request;

class AbsenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $jadwalHari = JadwalHari::orderBy('tanggal')->get();

        return view('students', compact('jadwalHari'));
    }

    public function get_mhs(Request $request){
        $user = Auth::user();
        $panitia = Panitia::where('nrpnpk', $user->username)->first();
        $mahasiswa = Mahasiswa::where('kelompok_id', $panitia->kelompok_idKelompok)->orderBy('nrp')->get();
        $count_pelanggaran = array();
        $status_absen = array();
        $sesi = Sesi::find($request->idsesi);
        $idhari = $request->hari;
        if (count($mahasiswa) > 0) {
            foreach ($mahasiswa as $mhs) {
                // Mendapatkan data total pelanggaran per mahasiswa per hari
                $pelanggaranMhs = PelanggaranMhs::where('mahasiswa_nrp', $mhs->nrp)->where('jadwalhari_idjadwal', $request->hari)->get();
                $count_pelanggaran[$mhs->nrp] = 0;
                if (count($pelanggaranMhs) > 0) {
                    foreach ($pelanggaranMhs as $item) {
                        $count_pelanggaran[$mhs->nrp] += $item->jumlah;
                    }
                }
    
                // Mendapatkan status absen per mahasiswa per sesi
                $data_absen = Absen::where('maharu_nrp', $mhs->nrp)->where('sesiAcara_idSesi', $request->idsesi)->first();
                if ($data_absen != null) {
                    $status_absen[$mhs->nrp] = $data_absen->absen;
                } else {
                    $status_absen[$mhs->nrp] = 3;
                }
            }
            return response()->json(array(
                'msg'=>view('tabel_absen_mhs', compact('mahasiswa', 'count_pelanggaran', 'status_absen', 'sesi', 'idhari'))->render(),
            ),200);
        }
        return response()->json(array(
            'msg'=>"Belum ada data yang tersedia !",
        ),200);
    }

    public function get_sesi(Request $request){
		$idtanggal = $request->get("tanggal");
        $tanggal = JadwalHari::find($idtanggal);
		$sesi = Sesi::where('tanggal', $tanggal->tanggal)->get();

		$html = "";
        if (count($sesi) > 0) {
            foreach ($sesi as $value) {
                $html .= "<option value='".$value->idSesi."'>".$value->namasesi."</option>";
            }
        }
		else
            $html = "<option value='0' disabled selected>--Tidak ada sesi yang ditemukan--</option>";

        return response()->json(array(
            'msg'=>$html,
        ),200);
	}

    public function get_modal_pelanggaran(Request $request){
        $mahasiswa = Mahasiswa::find($request->nrp);
        $pelanggaran = Pelanggaran::all();
        $pelanggaranMhs = PelanggaranMhs::where('mahasiswa_nrp', $request->nrp)->where('jadwalhari_idjadwal', $request->hari)->get();
        $idhari = $request->hari;
        return response()->json(array(
            'msg'=>view('modal_pelanggaran', compact('pelanggaran', 'pelanggaranMhs', 'mahasiswa', 'idhari'))->render(),
        ),200);
    }

    public function get_modal_izin(Request $request)
    {
        $mahasiswa = Mahasiswa::find($request->nrp);
        $idsesi = $request->get("idsesi");
        $absensi = Absen::where('maharu_nrp', $request->nrp)->where('sesiAcara_idSesi', $idsesi)->where('absen', 2)->first();
        $alasan = "";
        if ($absensi != null) {
            $alasan = $absensi->alasan_izin;
        }
        return response()->json(array(
            'msg'=>view('modal_izin', compact('alasan', 'mahasiswa', 'idsesi'))->render(),
        ),200);
    }

    public function set_absensi(Request $request){
		$nrp = $request->get("nrp");
        $absen = $request->get("absen");
        $idsesi = $request->get("idsesi");
        $alasan = $request->get("alasan");
        $sesi = Sesi::find($idsesi);

        $html = "";
        // Cek data absen mahasiswa sekarang sudah pernah ada atau tidak
        $absensi = Absen::where('maharu_nrp', $nrp)->where('sesiAcara_idSesi', $idsesi)->first();
        $user = Auth::user();

        if ($absensi != null) {
            // Jika sudah pernah ada data sebelumnya, lakukan modifikasi
            $saved = DB::table('mahasiswa_absen_sesiacara')
                ->where('maharu_nrp', $nrp)
                ->where('sesiAcara_idSesi', $idsesi)
                ->update(['absen' => $absen, 'updater' => $user->username, 'alasan_izin' => $alasan,'waktuupdate' => date('Y-m-d H:i:s')]);
        }
        else {
            // Jika belum pernah ada data sebelumnya, tambahkan data baru
            $absensi = new Absen();
            $absensi->maharu_nrp = $nrp;
            $absensi->sesiAcara_idSesi = $idsesi;
            $absensi->absen = $absen;
            $absensi->alasan_izin = $alasan;
            $absensi->updater = $user->username;
            $absensi->waktuupdate = date('Y-m-d H:i:s');
            $absensi->tahunMOB_idTahunMOB = $sesi->tahunMOB_idTahunMOB;
            $absensi->save();
        }
        if ($absen == 0) {
            $html = "<span class=\"iconify text-danger\" data-icon=\"mdi:check-bold\" data-inline=\"false\"></span>";
        } elseif ($absen == 1) {
            $html = "<span class=\"iconify text-success\" data-icon=\"mdi:check-bold\" data-inline=\"false\"></span>";
        } else {
            $html = "<span class=\"iconify text-warning\" data-icon=\"mdi:check-bold\" data-inline=\"false\"></span>";
        }
        
        return response()->json(array(
            'msg'=>$html,
            'alasan'=>$alasan,
        ),200);
	}

    public function set_pelanggaran(Request $request){
		$nrp = $request->get("nrp");
        $idpelanggaran = $request->get("violation");
        $hari = $request->get("hari");
        $pelanggaran = Pelanggaran::find($idpelanggaran);
        $jadwal = JadwalHari::find($hari);

        $pelanggaranMhs = PelanggaranMhs::where('mahasiswa_nrp', $nrp)->where('jadwalhari_idjadwal', $hari)->where('pelanggaran_idPelanggaran', $idpelanggaran)->first();
        if ($pelanggaranMhs != null) {
            if ($request->jenis == "plus") {
                $newcount = $pelanggaranMhs->jumlah + 1;
            } else {
                $newcount = $pelanggaranMhs->jumlah - 1;
            }
            if ($newcount == 0 && $request->jenis == "minus") {
                $saved = DB::table('mahasiswa_has_pelanggaran')
                ->where('mahasiswa_nrp', $nrp)
                ->where('jadwalhari_idjadwal', $hari)
                ->where('pelanggaran_idPelanggaran', $idpelanggaran)
                ->delete();
                return response()->json(array(
                    'status'=>'delete'
                ),200);
            } else {
                $saved = DB::table('mahasiswa_has_pelanggaran')
                ->where('mahasiswa_nrp', $nrp)
                ->where('jadwalhari_idjadwal', $hari)
                ->where('pelanggaran_idPelanggaran', $idpelanggaran)
                ->update(
                    ['jumlah' => $newcount],
                    ['updater' => Auth::user()->username],
                    ['waktuupdate' => date('Y-m-d H:i:s')]);
                return response()->json(array(
                    'status'=>'update'
                ),200);
            }
        } else {
            if ($request->jenis == "plus") {
                $pelanggaranMhs = new PelanggaranMhs();
                $pelanggaranMhs->mahasiswa_nrp = $nrp;
                $pelanggaranMhs->pelanggaran_idPelanggaran = $idpelanggaran;
                $pelanggaranMhs->jadwalhari_idjadwal = $hari;
                $pelanggaranMhs->poin = $pelanggaran->poinPelanggaran;
                $pelanggaranMhs->jumlah = 1;
                $user = Auth::user();
                $pelanggaranMhs->updater = $user->username;
                $pelanggaranMhs->tahunMOB_idTahunMOB = date('Y', strtotime($jadwal->tanggal));
                $pelanggaranMhs->save();
                return response()->json(array(
                    'status'=>'new',
                    'msg'=>view('baris_tabel_pelanggaran', compact('pelanggaranMhs'))->render(),
                ),200);
            }
        }
	}
}
