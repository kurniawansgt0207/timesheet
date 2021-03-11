<?php

namespace App\Http\Controllers;

//session_start();
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\CompanyInfo;

class CompanyInfoController extends Controller
{
    //
    public function index(){        
        $company = DB::select("select * from m_company_info");        
        return view('/layouts/master/company_info',['data_company' => $company]);
    }
    
    public function showAll()
    {
        
    }

    public function get_data($id)
    {
        $modulList = DB::select("SELECT * FROM m_company_info WHERE id=".$id);
        return $modulList;
    }

    public static function get_data_all()
    {
        
    }

    public function add_data()
    {
        
    }

    public function edit_data($id)
    {
        
    }

    public function save_data(Request $request)
    {
        
    }

    public function update_data(Request $request, $id)
    {
        $m_company = CompanyInfo::where('id', $id)->first();
        $m_company->company_name = $request->company_name;
        $m_company->company_address = $request->company_address;
        $m_company->company_phone = $request->company_phone;
        $m_company->company_email = $request->company_email;
        $m_company->company_npwp = $request->company_npwp;
        $m_company->company_website = $request->company_website;
        $m_company->company_contact = $request->company_contact;
        $m_company->save();
        echo "Data Berhasil Terupdate";
    }

    public function store_data(Request $request)
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

    public function delete_data($id)
    {
        DB::table('m_company_info')->where('id',$id)->delete();
        return redirect('/home');
    }
}
