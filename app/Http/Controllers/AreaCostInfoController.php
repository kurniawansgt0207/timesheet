<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

use App\Http\Controllers\AreaInfoController;
use App\Http\Controllers\CostInfoController;
use App\AreaCostInfo;

class AreaCostInfoController extends Controller
{
    //
    public function index() {
        $listData = $this->showDataAllJoin();
        return view('/layouts/master/area_cost_info_list', ['area_cost_info' => $listData]);
    }
    
    public function showDataAllJoin() {
        $listData = DB::select("SELECT a.id,a.areaId,b.area,"
                . " a.costId,c.costname,a.costAmt,a.isActive"
                . " FROM m_area_cost a"
                . " INNER JOIN m_area b ON a.areaId=b.id "
                . " INNER JOIN m_cost c ON a.costId=c.id "
                . " ORDER BY a.areaId,a.costId");
        return $listData;
    }
    
    public function showDataAll() {
        $listData = DB::select("SELECT * FROM m_area_cost ORDER BY id");
        return $listData;
    }
    
    public function showData($id){
        $listData = DB::select("SELECT * FROM m_area_cost WHERE id=".$id);
        return $listData;
    }
    
    public function addData(){     
        $area = new AreaInfoController();
        $cost = new CostInfoController();
        
        $areaCost = array(0);        
        $area_list = $area->showDataAll();
        $cost_list = $cost->showDataAll();
        
        Session::put('area_list',$area_list);
        Session::put('cost_list',$cost_list);
        
        return view('/layouts/master/area_cost_info',['area_cost_info' => $areaCost]);
    }
    
    public function editData($id){
        $area = new AreaInfoController();
        $cost = new CostInfoController();
        
        $areaCost = $this->showData($id);
        $area_list = $area->showDataAll();
        $cost_list = $cost->showDataAll();
        
        Session::put('area_list',$area_list);
        Session::put('cost_list',$cost_list);
        
        return view('/layouts/master/area_cost_info',['area_cost_info' => $areaCost]);
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
        $m_area_cost = new AreaCostInfo();
        $m_area_cost->areaId = $request->area;
        $m_area_cost->costId = $request->cost;
        $m_area_cost->costAmt = $request->costamt;
        $m_area_cost->isActive = $request->active;
        $m_area_cost->audituser = $_SESSION['name'];
        $m_area_cost->save();

        $id = DB::getPdo()->lastInsertId();
                
        echo "Data Berhasil Tersimpan";
    }
    
    public function update_data(Request $request, $id)
    {
        $m_area_cost = AreaCostInfo::where('id', $id)->first();
        $m_area_cost->areaId = $request->area;
        $m_area_cost->costId = $request->cost;
        $m_area_cost->costAmt = $request->costamt;
        $m_area_cost->isActive = $request->active;
        $m_area_cost->audituser = $_SESSION['name'];
        $m_area_cost->save();       

        echo "Data Berhasil Terupdate";
    }
    
    public function delete_data($id)
    {
        DB::table('m_area_cost')->where('id',$id)->delete();
        return redirect('/master/areacost');
    }
}
