<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailHafalan extends Model
{
    use HasFactory;

    protected $fillable = [
        'surah_id',
        'fashohah',
        'tajwid',
        'kelancaran',
        'rata_rata',
        'keterangan'
    ];

    public function surah()
    {
        return $this->belongsTo(Surah::class, 'surah_id','id');
    }

    public function hafalan()
    {
        return $this->belongsTo(Hafalan::class, 'hafalan_id','id');
    }
}