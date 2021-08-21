<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

use App\DepartemenInfo;

class DepartemenInfoController extends Controller
{
    //
    public function index() {
        $listData = $this->showDataAll();
        return view('/layouts/master/departemen_info_list', ['departemen_info' => $listData]);
    }
    
    public function showDataAllJoin() {
        
    }
    
    public function showDataAll() {
        $listData = DB::select("SELECT * FROM m_departemen ORDER BY id");
        return $listData;
    }
    
    public function showData($id){
        $listData = DB::select("SELECT * FROM m_departemen WHERE id=".$id);
        return $listData;
    }
    
    public function addData(){
        $level = new LevelInfoController();
        
        $group = array(0);        
        $levelList = $level->showDataAll();
        
        return view('/layouts/master/departemen_info',['departemen_info' => $group, 'level_info' => $levelList]);
    }
    
    public function editData($id){
        $level = new LevelInfoController();
        
        $group = $this->showData($id);
        $levelList = $level->showDataAll();
        
        return view('/layouts/master/departemen_info',['departemen_info' => $group, 'level_info' => $levelList]);
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
        $m_departemen = new DepartemenInfo();
        $m_departemen->departemen = $request->departemen;
        $m_departemen->audituser = $_SESSION['nama'];
        $m_departemen->save();

        $id = DB::getPdo()->lastInsertId();
                
        echo "Data Berhasil Tersimpan";
    }
    
    public function update_data(Request $request, $id)
    {
        $m_departemen = DepartemenInfo::where('id', $id)->first();
        $m_departemen->departemen = $request->departemen;
        $m_departemen->audituser = $_SESSION['nama'];
        $m_departemen->save();       

        echo "Data Berhasil Terupdate";
    }
    
    public function delete_data($id)
    {
        DB::table('m_departemen')->where('id',$id)->delete();
        return redirect('/master/jabatan');
    }
}
