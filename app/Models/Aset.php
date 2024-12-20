<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aset extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $primaryKey = 'nomor_urut';
    
    protected $table = 'asets';

    public function jenis()
    {
        return $this->belongsTo(JenisAset::class);
    }

    public function lokasi()
    {
        return $this->belongsTo(LokasiAset::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
}
