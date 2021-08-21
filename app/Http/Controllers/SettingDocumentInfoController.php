<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

use App\SettingDocumentInfo;

class SettingDocumentInfoController extends Controller
{
    //
    public function index() {
        $listData = $this->showDataAll();
        return view('/layouts/master/set_document_info_list', ['setting_document_info' => $listData]);
    }
    
    public function showDataAllJoin() {
        $listData = DB::select("");
        return $listData;
    }
    
    public function showDataAll() {
        $listData = DB::select("SELECT * FROM m_set_document ORDER BY docid");
        return $listData;
    }
    
    public function showData($id){
        $listData = DB::select("SELECT * FROM m_set_document WHERE docid=".$id);
        return $listData;
    }
    
    public function addData(){        
        $setdocument = array(0);        
        
        return view('/layouts/master/set_document_info',['setting_document_info' => $setdocument]);
    }
    
    public function editData($id){
        $setdocument = $this->showData($id);
        
        return view('/layouts/master/set_document_info',['setting_document_info' => $setdocument]);
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
        $m_sett_document = new SettingDocumentInfo();
        $m_sett_document->keterangan = $request->keterangan;
        $m_sett_document->autonodefault = $request->autonodefault;
        $m_sett_document->allowprefix = $request->allowprefix;
        $m_sett_document->textprefix = $request->textprefix;
        $m_sett_document->allowyop = $request->allowyop;
        $m_sett_document->allowmop = $request->allowmop;
        $m_sett_document->doclength = $request->doclength;
        $m_sett_document->docnumfmt = $request->docnumfmt;
        $m_sett_document->docnum = $request->docnum;
        $m_sett_document->objtype = $request->objtype;
        $m_sett_document->textprefix_last = $request->textprefix_last;
        $m_sett_document->yop_last = $request->yop_last;
        $m_sett_document->mop_last = $request->mop_last;
        $m_sett_document->audituser = $_SESSION['nama'];
        $m_sett_document->save();

        $id = DB::getPdo()->lastInsertId();
                
        echo "Data Berhasil Tersimpan";
    }
    
    public function update_data(Request $request, $id)
    {
        $m_sett_document = SettingDocumentInfo::where('docid', $id)->first();
        $m_sett_document->keterangan = $request->keterangan;
        $m_sett_document->autonodefault = $request->autonodefault;
        $m_sett_document->allowprefix = $request->allowprefix;
        $m_sett_document->textprefix = $request->textprefix;
        $m_sett_document->allowyop = $request->allowyop;
        $m_sett_document->allowmop = $request->allowmop;
        $m_sett_document->doclength = $request->doclength;
        $m_sett_document->docnumfmt = $request->docnumfmt;
        $m_sett_document->docnum = $request->docnum;
        $m_sett_document->objtype = $request->objtype;
        $m_sett_document->textprefix_last = $request->textprefix_last;
        $m_sett_document->yop_last = $request->yop_last;
        $m_sett_document->mop_last = $request->mop_last;
        $m_sett_document->audituser = $_SESSION['nama'];
        $m_sett_document->save();       

        echo "Data Berhasil Terupdate";
    }
    
    public function delete_data($id)
    {
        DB::table('m_sett_document')->where('id',$id)->delete();
        return redirect('/master/set_document');
    }
}
