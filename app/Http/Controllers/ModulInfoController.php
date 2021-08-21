<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ModulInfoController extends Controller
{
    //
    public function showDataAll() {
        $listData = DB::select("SELECT * FROM m_modul ORDER BY modul_group,modul_visorder");
        return $listData;
    }
    
    public function showDataByGroup($group) {
        $listData = DB::select("SELECT * FROM m_modul WHERE modul_group='$group' ORDER BY modul_visorder");
        return $listData;
    }
}
