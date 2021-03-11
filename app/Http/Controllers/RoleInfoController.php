<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

use App\RoleInfo;

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
        $listData = DB::select("SELECT * FROM m_role WHERE id=".$id);
        return $listData;
    }
    
    public function addData(){        
        $group = array(0);        
        return view('/layouts/master/role_info',['role_info' => $group]);
    }
    
    public function editData($id){
        $group = $this->showData($id);
        return view('/layouts/master/role_info',['role_info' => $group]);
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
        $m_role->audituser = $_SESSION['name'];
        $m_role->save();

        $id = DB::getPdo()->lastInsertId();
                
        echo "Data Berhasil Tersimpan";
    }
    
    public function update_data(Request $request, $id)
    {
        $m_role = RoleInfo::where('id', $id)->first();
        $m_role->role = $request->role;
        $m_role->audituser = $_SESSION['name'];
        $m_role->save();       

        echo "Data Berhasil Terupdate";
    }
    
    public function delete_data($id)
    {
        DB::table('m_role')->where('id',$id)->delete();
        return redirect('/master/role');
    }
}
