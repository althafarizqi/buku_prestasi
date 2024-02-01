<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailBulanan extends Model
{
    use HasFactory;
    protected $fillable = [
        'bulan_id',
        'murrum',
        'mursek',
        'ziyadah',
        'rata_rata',
        'keterangan'
    ];

    public function bulan()
    {
        return $this->belongsTo(Bulan::class, 'bulan_id','id');
    }
}