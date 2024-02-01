<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Profile;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Bulan;
use App\Models\Bulanan;
use App\Models\DetailBulanan;

class BulananController extends Controller
{
    public function index(Request $request)
    {
        $kelas_id = $request->input('kelasId');
        $siswa_id = $request->input('siswaId');

        // $bulanandetail = Bulanan::select('bulanans.*', 'detail_bulanans.*','bulans.nama')
        //     ->leftjoin('detail_bulanans', 'bulanans.id', '=', 'detail_bulanans.bulanan_id')
        //     ->leftjoin('bulans', 'detail_bulanans.bulan_id', '=', 'bulans.id')
        //     ->where('bulanans.siswa_id',$siswa_id)
        //     ->get();
        $bulanandetail = Siswa::select('siswas.nama', 'detail_bulanans.*', 'bulans.nama as nama_bulan')
            ->leftJoin('bulanans', 'siswas.id', '=', 'bulanans.siswa_id')
            ->leftJoin('detail_bulanans', 'bulanans.id', '=', 'detail_bulanans.bulanan_id')
            ->leftJoin('bulans', 'detail_bulanans.bulan_id', '=', 'bulans.id')
            ->where('siswas.kelas_id', $kelas_id)
            ->get();
        $results = Siswa::where('kelas_id',$kelas_id)->get();
        $kelass = Kelas::all();
        
        //select bulan berdasarkan semester
        $profile = Profile::select('semester')->first();
        $semesterType = strtoupper(optional($profile)->semester);
        $months = [];
        if ($semesterType == 'GANJIL') {
            $months = [7, 8, 9, 10, 11, 12];
        } elseif ($semesterType == 'GENAP') {
            $months = [1, 2, 3, 4, 5, 6];
        }
        $bulans = Bulan::whereIn('id', $months)
                    ->orderBy('id', 'asc')
                    ->get();
        
        return view('bulanan', compact('kelass','results','bulans','kelas_id', 'siswa_id', 'bulanandetail'));
    }

    public function store(Request $request)
    {
         //validasi input
         $request->validate([
            'kelas_id' => 'required',
            'siswaId' => 'required',
            'bulan_id' => 'required',
        ], [
            'kelas_id.required' => 'Kelas belum dipilih!',
            'siswaId.required' => 'Siswa belum dipilih!',
            'bulan_id.required' => 'Nilai belum terisi!'
        ]);

        try {

            $profile = Profile::select('semester', 'tahun_ajaran')->first();
            $data = $request->all();

            $siswa_id = $data['siswaId'];

            $bulan_ids = $data['bulan_id'];
            $murrums = $data['murrum'];
            $murseks = $data['mursek'];
            $ziyadahs = $data['ziyadah'];
            $rataRatas = $data['rata_rata'];
            $keterangans = $data['keterangan'];

            // $bulanan = new Bulanan;
            // $bulanan->siswa_id = $siswa_id;
            // $bulanan->semester = $profile->semester;
            // $bulanan->tahun_ajaran = $profile->tahun_ajaran;
            // $bulanan->save();

            $bulanan = Bulanan::updateOrInsert(
                ['siswa_id' => $siswa_id],
                [
                    'semester' => $profile->semester,
                    'tahun_ajaran' => $profile->tahun_ajaran,
                ]
            );

            $bulananId = Bulanan::where('siswa_id', $siswa_id)->first();

            foreach ($bulan_ids as $key => $bulan_id) {
                $detailbulanan = new DetailBulanan;
                $detailbulanan->bulanan_id = $bulananId->id;
                $detailbulanan->bulan_id = $bulan_id;
                $detailbulanan->murrum = $murrums[$key];
                $detailbulanan->mursek = $murseks[$key];
                $detailbulanan->ziyadah = $ziyadahs[$key];
                $detailbulanan->rata_rata = $rataRatas[$key];
                $detailbulanan->keterangan = $keterangans[$key];
                $detailbulanan->save();
            }

            // Redirect atau lakukan sesuatu setelah data disimpan
            return back()->withSuccess('Data Hafalan berhasil disimpan');
        } catch (\Throwable $th) {
            return back()->withError('Data gagal disimpan. ' . $th->getMessage())->withInput();
        }
        
    }
}