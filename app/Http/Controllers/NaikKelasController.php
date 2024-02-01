<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\Siswa;

class NaikKelasController extends Controller
{
    public function index(Request $request)
    {
        $kelas_id = $request->input('kelasId');
        $kelass = Kelas::all();

        $siswas = Siswa::select('siswas.nis', 'siswas.nama', 'siswas.kelas_id', 'kelas.nama as kelas')
            ->leftJoin('kelas', 'siswas.kelas_id', '=', 'kelas.id')
            ->where('siswas.kelas_id', $kelas_id)
            ->get();


        
        return view('naik_kelas', compact('siswas', 'kelass', 'kelas_id'));
    }

    public function updateKelas(Request $request)
    {
        $selectKelasId = $request->input('kelas');
        $updateKelasId = $request->input('kelas_id');

        // Ambil data siswa berdasarkan kelas_id
        $siswas = Siswa::where('kelas_id', $selectKelasId)->get();
        
        // Loop melalui siswa-siswa yang akan diupdate
        foreach ($siswas as $siswa) {
            if ($updateKelasId > $selectKelasId) {
            // Update kelas_id pada setiap siswa
            Siswa::where('id', $siswa->id)->update(['kelas_id' => $updateKelasId]);
        } else {
            return redirect()->route('naik-kelas.index')->with('error', 'Kelas asal tidak boleh lebih besar dari kelas tujuan!');
        }
    }
    return redirect()->route('naik-kelas.index')->with('success', 'Berhasil Naik Kelas.');

        
    }
}