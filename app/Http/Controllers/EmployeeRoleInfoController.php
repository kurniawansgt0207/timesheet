<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

use App\EmployeeRoleInfo;

class EmployeeRoleInfoController extends Controller
{
    //
    public function showDataAll() {
        $listData = DB::select("SELECT * FROM m_employee_role ORDER BY id");
        return $listData;
    }
    
    public function showData($id){
        $listData = DB::select("SELECT * FROM m_employee_role WHERE id=".$id);
        return $listData;
    }
    
    public function showDataByUserAll($userid) {
        $listData = DB::select("SELECT * FROM m_employee_role WHERE employeeId=$userid ORDER BY id");
        return $listData;
    }
    
    public function showDataByUser($userid) {
        $listData = DB::select("SELECT * FROM m_employee_role WHERE employeeId=$userid AND `isActive`=1 ORDER BY id");
        return $listData;
    }
    
    public function showDataByUserRole($userid) {
        $listData = DB::select("SELECT GROUP_CONCAT(roleId) roleUser FROM m_employee_role WHERE employeeId=$userid AND `isActive`=1 GROUP BY employeeId ORDER BY id");
        return $listData;
    }
    
    public function deleteDataByUser($userid){
        DB::table('m_employee_role')->where('employeeId',$userid)->delete();
    }
    
    public function save_data($userId,$roleId,$isActive)
    {   $user = $_SESSION['nama'];
        $nowDate = date("Y-m-d");
        DB::insert("INSERT INTO m_employee_role (employeeId,roleId,isActive,created_at,updated_at,audituser) values (?,?,?,?,?,?)",[$userId,$roleId,$isActive,$nowDate,$nowDate,$user]);
    }
        
}
