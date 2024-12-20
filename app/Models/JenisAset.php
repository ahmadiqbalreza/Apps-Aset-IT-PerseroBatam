<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisAset extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $primaryKey = 'id';

}


// SELECT COUNT(asets.jenis_id) AS total_data, jenis_asets.nama_jenis
// FROM asets
// LEFT JOIN jenis_asets
// ON asets.jenis_id = jenis_asets.id
// GROUP BY asets.jenis_id
