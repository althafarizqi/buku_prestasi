<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Surah;
use App\Models\Juz;
use App\Models\AkhirSemester;
use App\Models\DetailAkhirSemester;

class PasController extends Controller
{
    public function index(Request $request)
    {
        $profile = Profile::select('semester', 'tahun_ajaran')->first();
        $kelas_id = $request->input('kelasId');
        $siswa_id = $request->input('siswaId');
        $juzs = Juz::orderBy('nama', 'desc')->get();
        
        $results = Siswa::where('kelas_id',$kelas_id)->get();
        $kelass = Kelas::all();
        $surahs = Surah::orderBy('id','desc')->get();

        // $pasdetail = Siswa::select('siswas.nama', 'detail_akhir_semesters.*')
        //     ->leftJoin('akhir_semesters', 'siswas.id', '=', 'akhir_semesters.siswa_id')
        //     ->leftJoin('detail_akhir_semesters', 'akhir_semesters.id', '=', 'detail_akhir_semesters.akhir_semester_id')
        //     ->where('siswas.kelas_id', $kelas_id)
        //     ->where(function ($query) use ($profile) {
        //         $query->where(function ($subquery) use ($profile) {
        //             $subquery->where('akhir_semesters.tahun_ajaran', $profile->tahun_ajaran)
        //                 ->where('akhir_semesters.semester', $profile->semester);
        //         })
        //         ->orWhereNull('akhir_semesters.id');
        //     })
        //     ->get();

        $pasdetail = Siswa::select('siswas.nama', 'detail_akhir_semesters.*')
            ->leftJoin('akhir_semesters', 'siswas.id', '=', 'akhir_semesters.siswa_id')
            ->leftJoin('detail_akhir_semesters', 'akhir_semesters.id', '=', 'detail_akhir_semesters.akhir_semester_id')
            ->where('siswas.kelas_id', $kelas_id)
            ->get();


        
        return view('pas', compact('kelass','results','surahs','kelas_id', 'juzs','pasdetail', 'siswa_id'));
    }

    public function store(Request $request)
    {
         //validasi input
         $request->validate([
            'kelas_id' => 'required',
            'siswaId' => 'required',
            'juz' => 'required|array',
        ], [
            'kelas_id.required' => 'Kelas belum dipilih!',
            'siswaId.required' => 'Siswa belum dipilih!',
            'juz.required' => 'Nilai belum terisi!',
        ]);

        try {

            // $kelas_id = $request->input('kelas_id');
            $profile = Profile::select('semester', 'tahun_ajaran')->first();
            
            $data = $request->all();
            
            $siswa_id = $data['siswaId'];
        
            $juzs = $data['juz'];
            $fashohahs = $data['fashohah'];
            $tajwids = $data['tajwid'];
            $kelancarans = $data['kelancaran'];
            $rataRatas = $data['rata_rata'];
            $keterangans = $data['keterangan'];

            // $akhirsemester = new AkhirSemester;
            // $akhirsemester->siswa_id = $siswa_id;
            // $akhirsemester->semester = $profile->semester;
            // $akhirsemester->tahun_ajaran = $profile->tahun_ajaran;
            // $akhirsemester->save();

            $kenaikanjuz = AkhirSemester::updateOrInsert(
                ['siswa_id' => $siswa_id],
                [
                    'semester' => $profile->semester,
                    'tahun_ajaran' => $profile->tahun_ajaran,
                ]
            );

            $akhirsemesterId = AkhirSemester::where('siswa_id', $siswa_id)->first();

            foreach ($juzs as $key => $juz) {
                $detailakhirsemester = new DetailAkhirSemester;
                $detailakhirsemester->akhir_semester_id = $akhirsemesterId->id;
                $detailakhirsemester->juz = $juz;
                $detailakhirsemester->fashohah = $fashohahs[$key];
                $detailakhirsemester->tajwid = $tajwids[$key];
                $detailakhirsemester->kelancaran = $kelancarans[$key];
                $detailakhirsemester->rata_rata = $rataRatas[$key];
                $detailakhirsemester->keterangan = $keterangans[$key];
                $detailakhirsemester->save();
            }

            // Redirect atau lakukan sesuatu setelah data disimpan
            return back()->withSuccess('Data berhasil disimpan');
        } catch (\Throwable $th) {
            return back()->with('error', 'Data gagal disimpan. ' . $th->getMessage())->withInput();
        }
    }
}