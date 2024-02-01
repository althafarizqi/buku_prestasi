<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Profile;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Surah;
use App\Models\Tahsin;
use App\Models\DetailTahsin;

class TahsinController extends Controller
{
    public function index(Request $request)
    {
        $kelas_id = $request->input('kelasId');
        $siswa_id = $request->input('siswaId');

        // $tahsindetail = Tahsin::select('tahsins.*', 'detail_tahsins.*','siswas.nama','siswas.kelas_id')
        //     ->leftJoin('detail_tahsins', 'tahsins.id', '=', 'detail_tahsins.tahsin_id')
        //     ->leftJoin('siswas', 'tahsins.siswa_id', '=', 'siswas.id')
        //     ->where('siswas.id', $siswa_id)
        //     ->get();

        $tahsindetail = Siswa::select('siswas.nama', 'detail_tahsins.*')
            ->leftJoin('tahsins', 'siswas.id', '=', 'tahsins.siswa_id')
            ->leftJoin('detail_tahsins', 'tahsins.id', '=', 'detail_tahsins.tahsin_id')
            ->where('siswas.kelas_id', $kelas_id)
            ->get();
        
        $results = Siswa::where('kelas_id',$kelas_id)->get();
        $kelass = Kelas::all();
        $surahs = Surah::orderBy('id','desc')->get();
        
        return view('tahsin', compact('kelass','results','surahs', 'kelas_id', 'siswa_id', 'tahsindetail'));
    }

    public function store(Request $request)
    {
        //validasi input
        $request->validate([
            'kelas_id' => 'required',
            'siswaId' => 'required',
            'tingkat' => 'required',
        ], [
            'kelas_id.required' => 'Kelas belum dipilih!',
            'siswaId.required' => 'Siswa belum dipilih!',
            'tingkat.required' => 'Nilai belum terisi!'
        ]);

        try {
            $profile = Profile::select('semester', 'tahun_ajaran')->first();
            $data = $request->all();
            
            $siswa_id = $data['siswaId'];
            $tingkats = $data['tingkat'];
            $fashohahs = $data['fashohah'];
            $tajwids = $data['tajwid'];
            $kelancarans = $data['kelancaran'];
            $rataRatas = $data['rata_rata'];
            $keterangans = $data['keterangan'];

            // $tahsin = new Tahsin;
            // $tahsin->siswa_id = $siswa_id;
            // $tahsin->semester = $profile->semester;
            // $tahsin->tahun_ajaran = $profile->tahun_ajaran;
            // $tahsin->save();


            $tahsin = Tahsin::updateOrInsert(
                ['siswa_id' => $siswa_id],
                [
                    'semester' => $profile->semester,
                    'tahun_ajaran' => $profile->tahun_ajaran,
                ]
            );

            $tahsinId = Tahsin::where('siswa_id', $siswa_id)->first();

            foreach ($tingkats as $key => $tingkat) {
                $detailtahsin = new DetailTahsin;
                $detailtahsin->tahsin_id = $tahsinId->id;
                $detailtahsin->tingkat = $tingkat;
                $detailtahsin->fashohah = $fashohahs[$key];
                $detailtahsin->tajwid = $tajwids[$key];
                $detailtahsin->kelancaran = $kelancarans[$key];
                $detailtahsin->rata_rata = $rataRatas[$key];
                $detailtahsin->keterangan = $keterangans[$key];
                $detailtahsin->save();
            }

            // Redirect atau lakukan sesuatu setelah data disimpan
            return back()->withSuccess('Data berhasil disimpan');
        } catch (\Throwable $th) {
            return back()->with('error', 'Data gagal disimpan. ' . $th->getMessage())->withInput();
        }
        
    }

    // public function store(Request $request)
    // {
    //     $siswa_id = $request->siswa_id;
        

    //     foreach ($siswa_id as $key => $siswa_id) {
    //         $tingkat = $request->tingkat[$key];
    //         $fashohah = $request->fashohah[$key];
    //         $tajwid = $request->tajwid[$key];
    //         $kelancaran = $request->kelancaran[$key];
    //         $rata_rata = $request->rata_rata[$key];
    //         $keterangan = $request->keterangan[$key];
    //         // Hanya menyimpan data jika ada tingkat atau atribut lain yang memiliki nilai
    //         if ($tingkat || $fashohah || $tajwid || $kelancaran || $rata_rata || $keterangan) {
    //             // Check if a record already exists for the same siswa_id
    //             $existingRecord = Tahsin::where('siswa_id', $siswa_id)->first();

    //             if ($existingRecord) {
    //                 $existingRecord->update([
    //                     'tingkat' => $tingkat,
    //                     'fashohah' => $fashohah,
    //                     'tajwid' => $tajwid,
    //                     'kelancaran' => $kelancaran,
    //                     'rata_rata' => $rata_rata,
    //                     'keterangan' => $keterangan,
    //                 ]);
    //             } else {
    //                 Tahsin::create([
    //                     'siswa_id' => $siswa_id,
    //                     'tingkat' => $tingkat,
    //                     'fashohah' => $fashohah,
    //                     'tajwid' => $tajwid,
    //                     'kelancaran' => $kelancaran,
    //                     'rata_rata' => $rata_rata,
    //                     'keterangan' => $keterangan,
    //                 ]);
    //             }
    //         }
    //     }

    //     return redirect('/tahsin')->withSuccess('Task Created Successfully!');
    // }

}