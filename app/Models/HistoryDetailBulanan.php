<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryDetailBulanan extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'bulanan_id',
        'bulan_id',
        'murrum',
        'mursek',
        'ziyadah',
        'rata_rata',
        'keterangan'
    ];
}