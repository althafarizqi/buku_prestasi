<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


use App\Models\DetailAkhirSemester;
use App\Models\Siswa;
use App\Models\AkhirSemester;
use App\Models\Juz;

class DetailPasController extends Controller
{
    public function edit($id)
    {
        $pasdetail = Siswa::select('siswas.nama', 'detail_akhir_semesters.*')
            ->leftJoin('akhir_semesters', 'siswas.id', '=', 'akhir_semesters.siswa_id')
            ->leftJoin('detail_akhir_semesters', 'akhir_semesters.id', '=', 'detail_akhir_semesters.akhir_semester_id')
            ->where('detail_akhir_semesters.id', $id)
            ->get();

            // dd($pasdetail);

        $detail = DetailAkhirSemester::findOrFail($id);
        $juzs = Juz::all();
        return view('pas_edit', compact('detail', 'pasdetail', 'juzs'));
    }

    public function update(Request $request, $id)
    {
       $detail = DetailAkhirSemester::findOrFail($id);

        // Konversi nilai menjadi float sebelum menyimpan
        $rataRataValue = (float) $request->rata_rata;

        $detail->update([
            'juz' => $request->juz,
            'fashohah' => $request->fashohah,
            'tajwid' => $request->tajwid,
            'kelancaran' => $request->kelancaran,
            'rata_rata' => $rataRataValue,
            'keterangan' => $request->keterangan,
        ]);

        return redirect('pas')->withSuccess('Data nilai berhasil di Update');
    }

    public function destroy($id)
    {
        $detail = DetailAkhirSemester::findOrFail($id);
        $detail->delete();
        return back()->withSuccess('Data nilai berhasil di Hapus');
    }

}