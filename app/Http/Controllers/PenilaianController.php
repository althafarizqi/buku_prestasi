<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Kelas;

class PenilaianController extends Controller
{
    public function index()
    {
        // $siswas = Siswa::all();
        $kelass = Kelas::all();

        return view('penilaian', compact(['kelass']));
    }

    public function tampilSiswaByKelas(Request $request)
    {
        $siswaByKelas = $request->input('kelas_id');
        $siswas = Siswa::where('id', $siswaByKelas);
        

        return view('penilaian', compact(['siswas']));
    }
}