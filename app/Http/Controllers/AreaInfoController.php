<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class AreaInfoController extends Controller
{
    //
    public function index() {
        
    }
    
    public function showDataAll() {
        $listData = DB::select("SELECT * FROM m_area ORDER BY id");
        return $listData;
    }
}
