<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\KenaikanJuz;
use App\Models\DetailKenaikanJuz;

class KenaikanJuzController extends Controller
{
    public function index(Request $request)
    {
        $kelas_id = $request->input('kelasId');
        $siswa_id = $request->input('siswaId');
        $juzs = Juz::orderBy('nama', 'desc')->get();
        $results = Siswa::where('kelas_id',$kelas_id)->get();

        $ukjdetail = KenaikanJuz::select('kenaikan_juzs.*', 'detail_kenaikan_juzs.*')
            ->leftJoin('detail_kenaikan_juzs', 'kenaikan_juzs.id', '=', 'detail_kenaikan_juzs.kenaikan_juz_id')
            ->where('siswas.kelas_id', $kelas_id)
            ->get();

        // $latestRecords = KenaikanJuz::where('kelas_id', $kelas_id)->groupBy('siswa_id')
        //     ->selectRaw('MAX(created_at) as max_created_at, siswa_id')
        //     ->get();

        // $results = KenaikanJuz::whereIn('siswa_id', $latestRecords->pluck('siswa_id'))
        //     ->whereIn('created_at', $latestRecords->pluck('max_created_at'))
        //     ->get();

        $kelass = Kelas::all();

        return view('ukj', compact('kelass', 'siswa_id', 'juzs', 'results', 'ukjdetail', 'kelas_id'));
    }

    public function ambilDataSiswa(Request $request)
    {
        
        $kelass = Kelas::all();
        
        $kelas_id = $request->input('kelas_id');
        
        $siswas = Siswa::where('kelas_id', $kelas_id)->get();
        // dd($siswas);
        
        return view('tabel_kenaikan_juz', compact('siswas','kelass'))->render();

        // return response()->json([
        //     'status' => true,
        //     'html' => $html,
        //     'message' => 'Success',
        // ]);

    }

    public function store(Request $request)
    {
        $siswa_id = $request->siswa_id;
        $profile = Profile::select('semester', 'tahun_ajaran')->first();
        dd($profile);
        
        $juz = $request->juz;
        $fashohah = $request->fashohah;
        $tajwid = $request->tajwid;
        $kelancaran = $request->kelancaran;
        $rata_rata = $request->rata_rata;  

        $kenaikanjuz = new KenaikanJuz;
        $kenaikanjuz->siswa_id = $siswa_id;
        $kenaikanjuz->semester = $profile->semester;
        $kenaikanjuz->tahun_ajaran = $profile->tahun_ajaran;
        $kenaikanjuz->save();

        foreach($juz as $key => $juz){
            $detailkenaikanjuz = new DetailKenaikanJuz;
            $detailkenaikanjuz->kenaikan_juz_id = $kenaikanhuz->id;
            $detailkenaikanjuz->juz = $juz;
            $detailkenaikanjuz->fashohah = $fashohah[$key];
            $detailkenaikanjuz->tajwid = $tajwid[$key];
            $detailkenaikanjuz->kelancaran = $kelancaran[$key];
            $detailkenaikanjuz->rata_rata = $rata_rata[$key];
            $detailkenaikanjuz->save();
        }

        return redirect('/ukj')->with('success', 'Data berhasil disimpan');
    }
}