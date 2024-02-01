<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KenaikanJuz extends Model
{
    use HasFactory;

    protected $fillable = [
        'siswa_id',
        'semester',
        'tahun_ajaran',
    ];
    
    public function siswas()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id','id');
        
    }
    
    public function getLatestUkj()
    {
        return $this->groupBy('siswa_id')
                    ->latest('created_at')
                    ->get();
    }
}