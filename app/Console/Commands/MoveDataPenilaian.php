<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\DB;
use Illuminate\Console\Command;
use App\Models\KenaikanJuz;
use App\Models\HistoryKenaikanJuz;
use App\Models\DetailKenaikanJuz;
use App\Models\HistoryDetailKenaikanJuz;
use App\Models\AkhirSemester;
use App\Models\HistoryAkhirSemester;
use App\Models\DetailAkhirSemester;
use App\Models\HistoryDetailAkhirSemester;
use App\Models\Tahsin;
use App\Models\HistoryTahsin;
use App\Models\DetailTahsin;
use App\Models\HistoryDetailTahsin;
use App\Models\Hafalan;
use App\Models\HistoryHafalan;
use App\Models\DetailHafalan;
use App\Models\HistoryDetailHafalan;
use App\Models\Bulanan;
use App\Models\HistoryBulanan;
use App\Models\DetailBulanan;
use App\Models\HistoryDetailBulanan;

class MoveDataPenilaian extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'move:move-data-penilaian';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Move data penilaian ke tabel history';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Move data from kenaikan_juzs to history_kenaikan_juzs
        $kenaikanJuzs = KenaikanJuz::all();
        $detailKenaikanJuzs = DetailKenaikanJuz::all();
        $akhirSemesters = AkhirSemester::all();
        $detailAkhirSemesters = DetailAkhirSemester::all();
        $tahsins = Tahsin::all();
        $detailTahsins = DetailTahsin::all();
        $hafalans = Hafalan::all();
        $detailHafalans = DetailHafalan::all();
        $bulanans = Bulanan::all();
        $detailBulanans = DetailBulanan::all();


        foreach ($detailKenaikanJuzs as $detailKenaikanJuz) {
            HistoryDetailKenaikanJuz::create($detailKenaikanJuz->toArray());
        }

        foreach ($kenaikanJuzs as $kenaikanJuz) {
            HistoryKenaikanJuz::create($kenaikanJuz->toArray());
            $kenaikanJuz->delete();
        }

        foreach ($detailAkhirSemesters as $detailAkhirSemester) {
            HistoryDetailAkhirSemester::create($detailAkhirSemester->toArray());
        }

        foreach ($akhirSemesters as $akhirSemester) {
            HistoryAkhirSemester::create($akhirSemester->toArray());
            $akhirSemester->delete();
        }

        foreach ($detailTahsins as $detailTahsin) {
            HistoryDetailTahsin::create($detailTahsin->toArray());
        }

        foreach ($tahsins as $tahsin) {
            HistoryTahsin::create($tahsin->toArray());
            $tahsin->delete();
        }
        
        foreach ($detailHafalans as $detailHafalan) {
            HistoryDetailHafalan::create($detailHafalan->toArray());
        }

        foreach ($hafalans as $hafalan) {
            HistoryHafalan::create($hafalan->toArray());
            $hafalan->delete();
        }

        foreach ($detailBulanans as $detailBulanan) {
            HistoryDetailBulanan::create($detailBulanan->toArray());
        }

        foreach ($bulanans as $bulanan) {
            HistoryBulanan::create($bulanan->toArray());
            $bulanan->delete();
        }
        $this->info('Data has been moved successfully.');
    }
}