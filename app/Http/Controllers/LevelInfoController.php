<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

use App\LevelInfo;

class LevelInfoController extends Controller
{
    //
    public function index() {
        $listData = $this->showDataAll();
        return view('/layouts/master/level_info_list', ['level_info' => $listData]);
    }
    
    public function showDataAll() {
        $listData = DB::select("SELECT * FROM m_level ORDER BY id");
        return $listData;
    }
    
    public function showData($id){
        $listData = DB::select("SELECT * FROM m_level WHERE id=".$id);
        return $listData;
    }
    
    public function addData(){        
        $group = array(0);        
        return view('/layouts/master/level_info',['level_info' => $group]);
    }
    
    public function editData($id){
        $group = $this->showData($id);
        return view('/layouts/master/level_info',['level_info' => $group]);
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
        $m_level = new LevelInfo();
        $m_level->levelname = $request->levelname;
        $m_level->levelno = $request->levelno;
        $m_level->audituser = $_SESSION['name'];
        $m_level->save();

        $id = DB::getPdo()->lastInsertId();
                
        echo "Data Berhasil Tersimpan";
    }
    
    public function update_data(Request $request, $id)
    {
        $m_level = LevelInfo::where('id', $id)->first();
        $m_level->levelname = $request->levelname;
        $m_level->levelno = $request->levelno;
        $m_level->audituser = $_SESSION['name'];
        $m_level->save();       

        echo "Data Berhasil Terupdate";
    }
    
    public function delete_data($id)
    {
        DB::table('m_level')->where('id',$id)->delete();
        return redirect('/master/jabatan');
    }
}
