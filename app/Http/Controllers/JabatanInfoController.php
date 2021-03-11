<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

use App\JabatanInfo;
use App\LevelInfo;
use App\Http\Controllers\LevelInfoController;

class JabatanInfoController extends Controller
{
    //
    public function index() {
        $listData = $this->showDataAllJoin();
        return view('/layouts/master/jabatan_info_list', ['jabatan_info' => $listData]);
    }
    
    public function showDataAllJoin() {
        $listData = DB::select("SELECT a.*,b.levelname FROM m_jabatan a"
                . " INNER JOIN m_level b ON a.levelId=b.id"
                . " ORDER BY a.id");
        return $listData;
    }
    
    public function showDataAll() {
        $listData = DB::select("SELECT * FROM m_jabatan ORDER BY id");
        return $listData;
    }
    
    public function showData($id){
        $listData = DB::select("SELECT * FROM m_jabatan WHERE id=".$id);
        return $listData;
    }
    
    public function addData(){
        $level = new LevelInfoController();
        
        $group = array(0);        
        $levelList = $level->showDataAll();
        
        return view('/layouts/master/jabatan_info',['jabatan_info' => $group, 'level_info' => $levelList]);
    }
    
    public function editData($id){
        $level = new LevelInfoController();
        
        $group = $this->showData($id);
        $levelList = $level->showDataAll();
        
        return view('/layouts/master/jabatan_info',['jabatan_info' => $group, 'level_info' => $levelList]);
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
        $m_jabatan = new JabatanInfo();
        $m_jabatan->jabatan = $request->groupcode;
        $m_jabatan->levelId = $request->groupname;
        $m_jabatan->audituser = $_SESSION['name'];
        $m_jabatan->save();

        $id = DB::getPdo()->lastInsertId();
                
        echo "Data Berhasil Tersimpan";
    }
    
    public function update_data(Request $request, $id)
    {
        $m_jabatan = JabatanInfo::where('id', $id)->first();
        $m_jabatan->jabatan = $request->groupcode;
        $m_jabatan->levelId = $request->groupname;
        $m_jabatan->audituser = $_SESSION['name'];
        $m_jabatan->save();       

        echo "Data Berhasil Terupdate";
    }
    
    public function delete_data($id)
    {
        DB::table('m_jabatan')->where('id',$id)->delete();
        return redirect('/master/jabatan');
    }
}
