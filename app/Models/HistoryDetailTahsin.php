<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryDetailTahsin extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'tahsin_id',
        'tingkat',
        'fashohah',
        'tajwid',
        'kelancaran',
        'rata_rata',
        'keterangan'
    ];
}