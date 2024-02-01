<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Surah;
use App\Models\Hafalan;
use App\Models\DetailHafalan;


class HafalanController extends Controller
{
    public function index(Request $request)
    {
        $kelas_id = $request->input('kelasId');
        $siswa_id = $request->input('siswaId');
        // dd($siswa_id);

        $siswaByKelas = Siswa::where('kelas_id',$kelas_id)->get();
        
        $hafalandetail = Siswa::select('siswas.nama', 'detail_hafalans.*', 'surahs.nama as nama_surah')
            ->leftJoin('hafalans', 'siswas.id', '=', 'hafalans.siswa_id')
            ->leftJoin('detail_hafalans', 'hafalans.id', '=', 'detail_hafalans.hafalan_id')
            ->leftJoin('surahs', 'detail_hafalans.surah_id', '=', 'surahs.id')
            ->where('siswas.kelas_id', $kelas_id)
            ->get();

        $kelass = Kelas::all();
        $surahs = Surah::orderBy('id','desc')->get();
        
        return view('hafalan', compact('kelass','hafalandetail','surahs','kelas_id', 'siswaByKelas', 'siswa_id'));
    }

    public function store(Request $request)
    {
        //validasi input
        $request->validate([
            'kelas_id' => 'required',
            'siswaId' => 'required',
            'surah_id' => 'required',
        ], [
            'kelas_id.required' => 'Kelas belum dipilih!',
            'siswaId.required' => 'Siswa belum dipilih!',
            'surah_id.required' => 'Nilai belum terisi!'
        ]);

        try {
            $profile = Profile::select('semester', 'tahun_ajaran')->first();
            $kelas_id = $request->kelas_id;
            $data = $request->all();

            $siswa_id = $data['siswaId'];

            $surah_ids = $data['surah_id'];
            $fashohahs = $data['fashohah'];
            $tajwids = $data['tajwid'];
            $kelancarans = $data['kelancaran'];
            $rataRatas = $data['rata_rata'];
            $keterangans = $data['keterangan'];

            // $hafalan = new Hafalan;
            // $hafalan->siswa_id = $siswa_id;
            // $hafalan->semester = $profile->semester;
            // $hafalan->tahun_ajaran = $profile->tahun_ajaran;
            // $hafalan->save();

            $hafalan = Hafalan::updateOrInsert(
                ['siswa_id' => $siswa_id],
                [
                    'semester' => $profile->semester,
                    'tahun_ajaran' => $profile->tahun_ajaran,
                ]
            );

            $hafalanId = Hafalan::where('siswa_id', $siswa_id)->first();

            foreach ($surah_ids as $key => $surah_id) {
                $detailhafalan = new DetailHafalan;
                $detailhafalan->hafalan_id = $hafalanId->id;
                $detailhafalan->surah_id = $surah_id;
                $detailhafalan->fashohah = $fashohahs[$key];
                $detailhafalan->tajwid = $tajwids[$key];
                $detailhafalan->kelancaran = $kelancarans[$key];
                $detailhafalan->rata_rata = $rataRatas[$key];
                $detailhafalan->keterangan = $keterangans[$key];
                $detailhafalan->save();
            }

            // Redirect atau lakukan sesuatu setelah data disimpan
            return back()->withSuccess('Data Hafalan berhasil disimpan');
        } catch (\Throwable $th) {
            return back()->withError('Data gagal disimpan'. $th->getMessage())->withInput();
        }
        
    }


}