<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ModulGroupInfoController extends Controller
{
    //
    public function showDataAll() {
        $listData = DB::select("SELECT * FROM m_modul_group ORDER BY visorder");
        return $listData;
    }
    
    public function showModulGroupByRole($roleuser){
        $listData = DB::select("SELECT DISTINCT a.modul_group,c.`modul_group_icon` FROM m_modul a
        INNER JOIN m_role_detail b ON a.`id`=b.`modul_id`
        INNER JOIN m_modul_group c ON a.`modul_group`=c.`modul_group`
        AND b.`role_id` IN ($roleuser) AND a.`modul_status`=1 ORDER BY c.visorder");
        return $listData;
    }
}
