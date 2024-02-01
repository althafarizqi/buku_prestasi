<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\KenaikanJuz;
use App\Models\AkhirSemester;
use App\Models\DetailAkhirSemester;
use App\Models\Tahsin;
use App\Models\Hafalan;
use App\Models\DetailHafalan;
use App\Models\Bulanan;
use App\Models\DetailBulanan;
use Barryvdh\DomPDF\Facade\Pdf;

class RaportController extends Controller
{
    public function cetak(Request $request, $id)
    {
        try {
            $profile = Profile::first();
            $semester = $profile->semester;
            $tahun_ajaran = $profile->tahun_ajaran;
            $nama = $profile->nama;
            $kepsek = $profile->kepala_sekolah;

            $siswaData = Siswa::findOrFail($id);
            // $ukj = KenaikanJuz::where('siswa_id',$id)->get();

            $ukjdetail = KenaikanJuz::select('kenaikan_juzs.*', 'detail_kenaikan_juzs.*')
                ->leftJoin('detail_kenaikan_juzs', 'kenaikan_juzs.id', '=', 'detail_kenaikan_juzs.kenaikan_juz_id')
                ->where('kenaikan_juzs.siswa_id', $id)
                ->get();
        
            $pasdetail = AkhirSemester::select('akhir_semesters.*', 'detail_akhir_semesters.*')
                ->leftJoin('detail_akhir_semesters', 'akhir_semesters.id', '=', 'detail_akhir_semesters.akhir_semester_id')
                ->where('akhir_semesters.siswa_id', $id)
                ->get();


            $hafalandetail = Hafalan::select('hafalans.*', 'detail_hafalans.*','surahs.nama','surahs.juz')
                ->leftjoin('detail_hafalans', 'hafalans.id', '=', 'detail_hafalans.hafalan_id')
                ->leftJoin('surahs', 'detail_hafalans.surah_id', '=', 'surahs.id')
                ->where('hafalans.siswa_id',$id)
                ->orderBy('surahs.id', 'desc')
                ->get();

            $bulanandetail = Bulanan::select('bulanans.*', 'detail_bulanans.*','bulans.nama')
                ->leftjoin('detail_bulanans', 'bulanans.id', '=', 'detail_bulanans.bulanan_id')
                ->leftjoin('bulans', 'detail_bulanans.bulan_id', '=', 'bulans.id')
                ->where('bulanans.siswa_id',$id)
                ->get();

            $tahsindetail = Tahsin::select('tahsins.*', 'detail_tahsins.*','siswas.nama','siswas.kelas_id')
                ->leftJoin('detail_tahsins', 'tahsins.id', '=', 'detail_tahsins.tahsin_id')
                ->leftJoin('siswas', 'tahsins.siswa_id', '=', 'siswas.id')
                ->where('siswas.id', $id)
                ->get();
            
            if ($pasdetail->isEmpty()) {
                throw new \Exception('Nilai PAS ' . $siswaData->nama . ' belum lengkap');
            }else if ($hafalandetail->isEmpty()) {
                throw new \Exception('Nilai Hafalan ' . $siswaData->nama . ' belum lengkap');
            }else if ($bulanandetail->isEmpty()) {
                throw new \Exception('Nilai Bulanan ' . $siswaData->nama . ' belum lengkap');
            }else if ($tahsindetail->isEmpty()) {
                throw new \Exception('Nilai Tahsin ' . $siswaData->nama . ' belum lengkap');
            }
        
            $pdf = Pdf::loadView('raport', compact('kepsek','bulanandetail','semester','tahun_ajaran','nama','ukjdetail','pasdetail','hafalandetail','tahsindetail','siswaData'));
            return view('raport', compact('kepsek','bulanandetail','semester', 'tahun_ajaran', 'nama', 'ukjdetail', 'pasdetail','hafalandetail', 'tahsindetail', 'siswaData'));
        } catch (\Throwable $th) {
            return redirect()->route('raport.index')
                ->with('error', $th->getMessage())
                ->withInput();
        }
        
    }

    public function index(Request $request)
    {
        $kelas_id = $request->input('kelasId');
        $results = Siswa::where('kelas_id',$kelas_id)->get();
        $kelass = Kelas::all();
        
        return view('raport_create', compact('kelass','results'));
    }
}