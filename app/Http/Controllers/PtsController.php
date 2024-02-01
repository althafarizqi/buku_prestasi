<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\TengahSemester;

class PtsController extends Controller
{
    public function index(Request $request)
    {
        $kelas_id = $request->input('kelasId');
        
        $results = Siswa::where('kelas_id',$kelas_id)->get();
        $kelass = Kelas::all();
        
        return view('pts', compact('kelass','results'));
    }

    public function store(Request $request)
    {
        $siswa_id = $request->siswa_id;
        $kelas_id = $request->kelas_id;
        $juz = $request->juz;
        $fashohah = $request->fashohah;
        $tajwid = $request->tajwid;
        $kelancaran = $request->kelancaran;
        $rata_rata = $request->rata_rata;
        $keterangan = $request->keterangan;

        foreach ($siswa_id as $key => $siswa_id) {
            // Check if a record already exists for the same siswa_id and kelas_id
            $existingRecord = TengahSemester::where('siswa_id', $siswa_id)
                ->where('kelas_id', $kelas_id[$key])
                ->where('fashohah', null)
                ->where('tajwid', null)
                ->where('kelancaran', null)
                ->where('rata_rata', null)
                ->where('keterangan', null)
                ->first();

            if ($existingRecord) {
                // Update the existing record
                $existingRecord->juz = $juz[$key];
                $existingRecord->fashohah = $fashohah[$key];
                $existingRecord->tajwid = $tajwid[$key];
                $existingRecord->kelancaran = $kelancaran[$key];
                $existingRecord->rata_rata = $rata_rata[$key];
                $existingRecord->keterangan = $keterangan[$key];
                $existingRecord->save();
            } else {
                // Create a new record if it doesn't exist
                $tengahsemester = new TengahSemester;
                $tengahsemester->siswa_id = $siswa_id;
                $tengahsemester->kelas_id = $kelas_id[$key];
                $tengahsemester->juz = $juz[$key];
                $tengahsemester->fashohah = $fashohah[$key];
                $tengahsemester->tajwid = $tajwid[$key];
                $tengahsemester->kelancaran = $kelancaran[$key];
                $tengahsemester->rata_rata = $rata_rata[$key];
                $tengahsemester->keterangan = $keterangan[$key];
                $tengahsemester->save();
            }
        }

        return redirect('/pts')->withSuccess('Task Created Successfully!');
    }
}