<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

use App\EmployeeInfo;
use App\Http\Controllers\DepartemenInfoController;
use App\Http\Controllers\JabatanInfoController;
use App\Http\Controllers\LevelInfoController;
use App\Http\Controllers\RoleInfoController;

class EmployeeInfoController extends Controller
{
    //
    public function index() {
        $listData = $this->showDataAllJoin();
        return view('/layouts/master/employee_info_list', ['employee_info' => $listData]);
    }
    
    public function showDataAllJoin() {
        $listData = DB::select("CALL `sp_m_employee_listmenu`(3,'','')");
        return $listData;
    }
    
    public function showDataAll() {
        $listData = DB::select("SELECT * FROM m_employee ORDER BY id");
        return $listData;
    }
    
    public function showData($id){
        $listData = DB::select("CALL `sp_m_employee_get`(".$id.")");
        return $listData;
    }
    
    public function addData(){        
        $departemen = new DepartemenInfoController();
        $jabatan = new JabatanInfoController();
        $level = new LevelInfoController();
        $role = new RoleInfoController();
        
        $group = array(0);        
        $departemen_list = $departemen->showDataAll();
        $jabatan_list = $jabatan->showDataAll();
        $level_list = $level->showDataAll();
        $role_list = $role->showDataAll();
        
        Session::put('jabatan_list',$jabatan_list);
        Session::put('level_list',$level_list);
        Session::put('role_list',$role_list);
        
        return view('/layouts/master/employee_info',['employee_info' => $group, 'departemen_list' => $departemen_list]);
    }
    
    public function editData($id){
        $departemen = new DepartemenInfoController();
        $jabatan = new JabatanInfoController();
        $level = new LevelInfoController();
        $role = new RoleInfoController();
        
        $group = $this->showData($id);
        $departemen_list = $departemen->showDataAll();
        $jabatan_list = $jabatan->showDataAll();
        $level_list = $level->showDataAll();
        $role_list = $role->showDataAll();
        
        Session::put('jabatan_list',$jabatan_list);
        Session::put('level_list',$level_list);
        Session::put('role_list',$role_list);
        
        return view('/layouts/master/employee_info',['employee_info' => $group, 'departemen_list' => $departemen_list]);
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
        $m_employee = new EmployeeInfo();
        $m_employee->email = $request->email;
        $m_employee->nama = $request->name;
        $m_employee->nik = $request->nik;
        $m_employee->password = Hash::make($request->password);
        $m_employee->departemenID = $request->departemen;
        $m_employee->jabatanID = $request->jabatan;
        $m_employee->levelId = $request->level;
        $m_employee->roleId = $request->role;
        $m_employee->isActive = $request->active;
        $m_employee->audituserid = $_SESSION['id'];
        $m_employee->save();

        $id = DB::getPdo()->lastInsertId();
                
        echo "Data Berhasil Tersimpan";
    }
    
    public function update_data(Request $request, $id)
    {
        $m_employee = EmployeeInfo::where('id', $id)->first();
        $m_employee->email = $request->email;
        $m_employee->nama = $request->name;
        $m_employee->nik = $request->nik;
        $m_employee->password = Hash::make($request->password);
        $m_employee->departemenID = $request->departemen;
        $m_employee->jabatanID = $request->jabatan;
        $m_employee->levelId = $request->level;
        $m_employee->roleId = $request->role;
        $m_employee->isActive = $request->active;
        $m_employee->audituserid = $_SESSION['id'];
        $m_employee->save();       

        echo "Data Berhasil Terupdate";
    }
    
    public function delete_data($id)
    {
        DB::table('m_employee')->where('id',$id)->delete();
        return redirect('/master/employee');
    }
}
