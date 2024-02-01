<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailAkhirSemester extends Model
{
    use HasFactory;
    protected $fillable = [
        'juz',
        'fashohah',
        'tajwid',
        'kelancaran',
        'rata_rata',
        'keterangan'
    ];
}