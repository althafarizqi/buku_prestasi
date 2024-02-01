<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryDetailAkhirSemester extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'akhir_semester_id',
        'juz',
        'fashohah',
        'tajwid',
        'kelancaran',
        'rata_rata',
        'keterangan'
    ];
}