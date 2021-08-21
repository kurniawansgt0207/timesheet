<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class RoleDetailInfoController extends Controller
{
    //
    public function showDataAll() {
        $listData = DB::select("SELECT * FROM m_role_detail ORDER BY id");
        return $listData;
    }
    
    public function showData($id){
        $listData = DB::select("SELECT * FROM m_role_detail WHERE id=".$id);
        return $listData;
    }
    
    public function showDataByRole($roleid){
        $listData = DB::select("SELECT * FROM m_role_detail WHERE role_id=".$roleid);
        return $listData;
    }
    
    public function showDataByRoleUser($roleuser) {
        $listData = DB::select("SELECT a.`modul_id`,b.`modul_visorder`,b.`modul_label`,b.`modul_link`,b.`modul_icon`,b.`modul_group` 
        FROM m_role_detail a 
        INNER JOIN m_modul b ON a.`modul_id`=b.`id`
        INNER JOIN m_modul_group c ON b.`modul_group`=c.`modul_group`
        WHERE a.`role_id` IN ($roleuser) AND b.`modul_status`=1
        GROUP BY a.`modul_id`,b.`modul_visorder`,b.`modul_label`,b.`modul_link`,b.`modul_icon`,b.`modul_group`
        ORDER BY b.`modul_visorder`");
        return $listData;
    }
    
    public function simpan_data($roleId,$modulId){
        $user = $_SESSION['nama'];
        $nowDate = date("Y-m-d H:i:s");
        DB::insert("INSERT INTO m_role_detail (role_id,modul_id,created_at,updated_at,audituser) values (?,?,?,?,?)",[$roleId,$modulId,$nowDate,$nowDate,$user]);
    }
    
    public function delete_data_by_role($roleid){
        DB::table('m_role_detail')->where('role_id',$roleid)->delete();
    }
    
}
