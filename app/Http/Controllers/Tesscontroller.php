<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class TessController extends Controller
{
    public function tes(){
        $users=DB::select('SELECT * FROM ASET');
        echo json_encode($users);
    }
}