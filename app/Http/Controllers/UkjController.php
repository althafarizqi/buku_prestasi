<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\KenaikanJuz;
use App\Models\DetailKenaikanJuz;
use App\Models\Juz;

class UkjController extends Controller
{
    public function index(Request $request)
    {
        $kelass = Kelas::all();
        $kelas_id = $request->input('kelasId');
        $siswa_id = $request->input('siswaId');
        $juzs = Juz::orderBy('nama', 'desc')->get();
        $results = Siswa::where('kelas_id', $kelas_id)->get();


        $ukjdetail = Siswa::select('siswas.nama', 'detail_kenaikan_juzs.*')
            ->leftJoin('kenaikan_juzs', 'siswas.id', '=', 'kenaikan_juzs.siswa_id')
            ->leftJoin('detail_kenaikan_juzs', 'kenaikan_juzs.id', '=', 'detail_kenaikan_juzs.kenaikan_juz_id')
            ->where('siswas.kelas_id', $kelas_id)
            ->get();


        // return view('ukj', compact('kelass', 'siswa_id', 'juzs', 'results', 'ukjdetail', 'kelas_id'));
        return view('ukj', [
            'kelass' => $kelass,
            'siswa_id' => $siswa_id,
            'juzs' => $juzs,
            'results' => $results,
            'ukjdetail' => $ukjdetail,
            'kelas_id' => $kelas_id,
        ]);
    }

    public function store(Request $request)
    {
        //validasi input
        $request->validate([
            'kelas_id' => 'required',
            'siswaId' => 'required',
            'juz' => 'required',
        ], [
            'kelas_id.required' => 'Kelas belum dipilih!',
            'siswaId.required' => 'Siswa belum dipilih!',
            'juz.required' => 'Nilai belum terisi!'
        ]);

        try {
            
            $profile = Profile::select('semester', 'tahun_ajaran')->first();

            $kelas_id = $request->input('kelas_id');
            $siswa_id = $request->siswaId;
            $juz = $request->juz;
            $fashohah = $request->fashohah;
            $tajwid = $request->tajwid;
            $kelancaran = $request->kelancaran;
            $rata_rata = $request->rata_rata;
            $keterangan = $request->keterangan;

            $kenaikanjuz = KenaikanJuz::updateOrInsert(
                ['siswa_id' => $siswa_id],
                [
                    'semester' => $profile->semester,
                    'tahun_ajaran' => $profile->tahun_ajaran,
                ]
            );

            $kenaikanjuzId = KenaikanJuz::where('siswa_id', $siswa_id)->first();

            foreach ($juz as $key => $juz) {
                $detailkenaikanjuz = new DetailKenaikanJuz;
                $detailkenaikanjuz->kenaikan_juz_id = $kenaikanjuzId->id;
                $detailkenaikanjuz->juz = $juz;
                $detailkenaikanjuz->fashohah = $fashohah[$key];
                $detailkenaikanjuz->tajwid = $tajwid[$key];
                $detailkenaikanjuz->kelancaran = $kelancaran[$key];
                $detailkenaikanjuz->rata_rata = $rata_rata[$key];
                $detailkenaikanjuz->keterangan = $keterangan[$key];
                $detailkenaikanjuz->save();
            }

            return back()->with('success', 'Data berhasil disimpan');
        } catch (\Throwable $th) {
            return back()->with('error', 'Data gagal disimpan. ' . $th->getMessage())->withInput();
        }
    }
}
