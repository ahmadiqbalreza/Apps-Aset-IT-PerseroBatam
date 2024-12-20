<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PublicAPPS extends Model
{
    use HasFactory;

    protected $table = 'PUBLIC_APPS'; 
    protected $guarded = ['id'];
    protected $primaryKey = 'id';
}
