<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

use App\RoleInfo;
use App\ModulInfo;
use App\RoleDetailInfo;

class RoleInfoController extends Controller
{
    //
    public function index() {
        $listData = $this->showDataAll();
        return view('/layouts/master/role_info_list', ['role_info' => $listData]);
    }
    
    public function showDataAll() {
        $listData = DB::select("SELECT * FROM m_role ORDER BY id");
        return $listData;
    }
    
    public function showData($id){
        $listData = DB::select("SELECT * FROM m_role WHERE id IN (".$id.")");
        return $listData;
    }        
    
    public function addData(){        
        $role = array(0);      
        $modul = new ModulInfoController();
        $roledetail = new RoleDetailInfoController();
        
        $modulList = $modul->showDataAll();
        $roleDtlList = $roledetail->showDataByRole(0);
        
        return view('/layouts/master/role_info',['role_info' => $role, 'modul_info' => $modulList, 'role_detail' => $roleDtlList]);
    }
    
    public function editData($id){
        $role = $this->showData($id);
        $modul = new ModulInfoController();
        $roledetail = new RoleDetailInfoController();
        
        $modulList = $modul->showDataAll();
        $roleDtlList = $roledetail->showDataByRole($id);
        
        return view('/layouts/master/role_info',['role_info' => $role, 'modul_info' => $modulList, 'role_detail' => $roleDtlList]);
    }
    
    public function storeData(Request $request)
    {
        $session = isset($request->sessionVal)?$request->sessionVal:0;
        $id = isset($request->id)?$request->id:0;
        if($session==0){
            return redirect('login')->with('alert','Silahkan Login ...!!!');
        } else {
            if ($id == 0) {
                $this->save_data($request);
            } else {
                $this->update_data($request, $id);
            }
        }
    }

    public function save_data(Request $request)
    {
        $m_role = new RoleInfo();
        $m_role->role = $request->role;
        $m_role->audituser = $_SESSION['nama'];
        $m_role->created_at = date("Y-m-d");
        $m_role->audituser = $_SESSION['nama'];
        $m_role->save();

        $id = DB::getPdo()->lastInsertId();
        
        $jmlListModul = count($request->modulid);
        $modulId = $request->modulid;
        $modulCheck = $request->modulactive;                
        
        $role_detail = new RoleDetailInfoController();        
        
        for($a=0;$a<$jmlListModul;$a++){
            $idModul = $modulId[$a];
            $modulActive = 0;
            for($b=0;$b<count($modulCheck);$b++){                
                if($idModul == $modulCheck[$b]) {
                    $modulActive = "1";
                    break;                 
                }
            } 
            if($modulActive==1){         
                $role_detail->simpan_data($id, $idModul);
            }            
        }
                
        echo "Data Berhasil Tersimpan";
    }
    
    public function update_data(Request $request, $id)
    {
        $m_role = RoleInfo::where('id', $id)->first();
        $m_role->role = $request->role;
        $m_role->updated_at = date("Y-m-d H:i:s");
        $m_role->audituser = $_SESSION['nama'];
        $m_role->save();       

        $jmlListModul = count($request->modulid);
        $modulId = $request->modulid;
        $modulCheck = $request->modulactive;                
        
        $role_detail = new RoleDetailInfoController();
        $role_detail->delete_data_by_role($id);
        
        for($a=0;$a<$jmlListModul;$a++){
            $idModul = $modulId[$a];
            $modulActive = 0;
            for($b=0;$b<count($modulCheck);$b++){                
                if($idModul == $modulCheck[$b]) {
                    $modulActive = "1";
                    break;                 
                }
            } 
            if($modulActive==1){
                $role_detail->simpan_data($id, $idModul);
            }            
        }
        
        echo "Data Berhasil Terupdate";
    }
        
    public function delete_data($id)
    {
        DB::table('m_role')->where('id',$id)->delete();
        return redirect('/master/role');
    }
}
