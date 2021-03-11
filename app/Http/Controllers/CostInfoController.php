<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

use App\AreaInfo;

class AreaInfoController extends Controller
{
    //
    public function index() {
        $listData = $this->showDataAll();
        return view('/layouts/master/area_info_list', ['area_info' => $listData]);
    }
    
    public function showDataAll() {
        $listData = DB::select("SELECT * FROM m_area ORDER BY id");
        return $listData;
    }
    
    public function showData($id){
        $listData = DB::select("SELECT * FROM m_area WHERE id=".$id);
        return $listData;
    }
    
    public function addData(){        
        $area = array(0);        
        return view('/layouts/master/area_info',['area_info' => $area]);
    }
    
    public function editData($id){
        $area = $this->showData($id);
        return view('/layouts/master/area_info',['area_info' => $area]);
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
        $m_pekerja = new AreaInfo();
        $m_pekerja->area = $request->area;
        $m_pekerja->audituser = $_SESSION['name'];
        $m_pekerja->save();

        $id = DB::getPdo()->lastInsertId();
                
        echo "Data Berhasil Tersimpan";
    }
    
    public function update_data(Request $request, $id)
    {
        $m_pekerja = AreaInfo::where('id', $id)->first();
        $m_pekerja->area = $request->area;
        $m_pekerja->audituser = $_SESSION['name'];
        $m_pekerja->save();       

        echo "Data Berhasil Terupdate";
    }
    
    public function delete_data($id)
    {
        DB::table('m_area')->where('id',$id)->delete();
        return redirect('/master/area');
    }
}
