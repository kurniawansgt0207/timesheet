<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

use App\CostInfo;

class CostInfoController extends Controller
{
    //
    public function index() {
        $listData = $this->showDataAll();
        return view('/layouts/master/cost_info_list', ['cost_info' => $listData]);
    }
    
    public function showDataAll() {
        $listData = DB::select("SELECT * FROM m_cost ORDER BY id");
        return $listData;
    }
    
    public function showData($id){
        $listData = DB::select("SELECT * FROM m_cost WHERE id=".$id);
        return $listData;
    }
    
    public function addData(){        
        $area = array(0);        
        return view('/layouts/master/cost_info',['cost_info' => $area]);
    }
    
    public function editData($id){
        $area = $this->showData($id);
        return view('/layouts/master/cost_info',['cost_info' => $area]);
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
        $m_cost = new CostInfo();
        $m_cost->costname = $request->costname;
        $m_cost->visOrder = $request->visorder;
        $m_cost->audituser = $_SESSION['nama'];
        $m_cost->save();

        $id = DB::getPdo()->lastInsertId();
                
        echo "Data Berhasil Tersimpan";
    }
    
    public function update_data(Request $request, $id)
    {
        $m_cost = CostInfo::where('id', $id)->first();
        $m_cost->costname = $request->costname;
        $m_cost->visOrder = $request->visorder;
        $m_cost->audituser = $_SESSION['nama'];
        $m_cost->save();       

        echo "Data Berhasil Terupdate";
    }
    
    public function delete_data($id)
    {
        DB::table('m_cost')->where('id',$id)->delete();
        return redirect('/master/cost');
    }
}
