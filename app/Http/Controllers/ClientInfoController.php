<?php

namespace App\Http\Controllers;

//session_start();
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

use App\Http\Controllers\GroupInfoController;
use App\Http\Controllers\AreaInfoController;
use App\Http\Controllers\CityInfoController;
use App\ClientInfo;

class ClientInfoController extends Controller
{
    //
    public function index(){
        $listData = $this->showDataAll();
        return view('/layouts/master/client_info_list', ['client_info' => $listData]);
    }
    
    public function showDataAll(){
        $listData = DB::select('CALL `sp_m_client_listmenu`(?,?,?)',array(1,'',''));
        return $listData;
    }
    
    public function showData($id){
        $listData = DB::select('CALL `sp_m_client_get`(?)',array($id));
        return $listData;
    }
    
    public function findDataByIdDetail($id){
        $rs = $this->showData($id);        
        echo "<b>Alamat</b><br>".$rs[0]->alamat."<br>";
        echo "<b>Kota</b><br>".$rs[0]->kota."<br>";
        echo "<b>Kantor</b><br>"; echo ($rs[0]->isHolding==1) ? "Pusat"."<br>" : "Cabang"."<br>";
        echo "<b>Group</b><br>".$rs[0]->groupcode."<br>";
        echo "<b>Area</b><br>".$rs[0]->area;
    }
    
    public function addData(){
        $city = new CityInfoController();
        $group = new GroupInfoController();
        $area = new AreaInfoController();
        
        $client = array(0);        
        $cityList = $city->showDataAll();
        $groupList = $group->showDataAll();
        $areaList = $area->showDataAll();        
        
        Session::put('city_list',$cityList);
        Session::put('area_list',$areaList);
        
        return view('/layouts/master/client_info',
            ['client_info' => $client],
            ['group_list' => $groupList]
        );
    }
    
    public function editData($id){
        $city = new CityInfoController();
        $group = new GroupInfoController();
        $area = new AreaInfoController();
        
        $client = $this->showData($id);
        $cityList = $city->showDataAll();
        $groupList = $group->showDataAll();
        $areaList = $area->showDataAll();        
        
        Session::put('city_list',$cityList);
        Session::put('area_list',$areaList);
        
        return view('/layouts/master/client_info',
            ['client_info' => $client],
            ['group_list' => $groupList]
        );
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
        $m_pekerja = new ClientInfo();
        $m_pekerja->nama = $request->nama_client;
        $m_pekerja->alamat = $request->alamat;
        $m_pekerja->kota = $request->kota;
        $m_pekerja->telpon = $request->telpon;
        $m_pekerja->email = $request->email;
        $m_pekerja->npwp = $request->npwp;
        $m_pekerja->website = $request->website;
        $m_pekerja->contactperson = $request->kontak;
        $m_pekerja->isHolding = $request->holding;
        $m_pekerja->groupId = $request->group;
        $m_pekerja->areaId = $request->area;
        $m_pekerja->isActive = $request->aktif;
        $m_pekerja->ope = $request->ope;
        $m_pekerja->save();

        $id = DB::getPdo()->lastInsertId();
                
        echo "Data Berhasil Tersimpan";
    }
    
    public function update_data(Request $request, $id)
    {
        $m_pekerja = ClientInfo::where('id', $id)->first();
        $m_pekerja->nama = $request->nama_client;
        $m_pekerja->alamat = $request->alamat;
        $m_pekerja->kota = $request->kota;
        $m_pekerja->telpon = $request->telpon;
        $m_pekerja->email = $request->email;
        $m_pekerja->npwp = $request->npwp;
        $m_pekerja->website = $request->website;
        $m_pekerja->contactperson = $request->kontak;
        $m_pekerja->isHolding = $request->holding;
        $m_pekerja->groupId = $request->group;
        $m_pekerja->areaId = $request->area;
        $m_pekerja->isActive = $request->aktif;
        $m_pekerja->ope = $request->ope;
        $m_pekerja->save();       

        echo "Data Berhasil Terupdate";
    }
    
    public function delete_data($id)
    {
        DB::table('m_client')->where('id',$id)->delete();
        return redirect('/master/client');
    }
}
