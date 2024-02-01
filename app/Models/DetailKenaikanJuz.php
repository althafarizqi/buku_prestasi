<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailKenaikanJuz extends Model
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