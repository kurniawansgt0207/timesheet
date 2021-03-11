<?php

namespace App\Http\Controllers;

//session_start();
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\ModelUser;
use App\UserDetail;

class User extends Controller
{
    //
    public function index(){
        return view('/layouts/dashboard');
    }
    
    public function listData(){
        $listData = $this->showDataAll();
        return view('/layouts/master/user_info_list', ['user_info' => $listData]);
    }
    
    public function showDataAll() {
        $listData = DB::select("SELECT * FROM m_user ORDER BY id");
        return $listData;
    }
    
    public function showData($id){
        $listData = DB::select("SELECT * FROM m_user WHERE id=".$id);
        return $listData;
    }
    
    public function addData(){        
        $user = array(0);        
        return view('/layouts/master/user_info',['user_info' => $user]);
    }
    
    public function editData($id){
        $user = $this->showData($id);
        return view('/layouts/master/user_info',['user_info' => $user]);
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
        $m_pekerja = new ModelUser();
        $m_pekerja->name = $request->name;
        $m_pekerja->email = $request->email;
        $m_pekerja->password = Hash::make($request->password);
        $m_pekerja->password_ori = $request->password;
        $m_pekerja->img_profile = "profile-icon.png";
        $m_pekerja->stat_active = $request->stat_active;
        $m_pekerja->save();

        $id = DB::getPdo()->lastInsertId();
                
        echo "Data Berhasil Tersimpan";
    }
    
    public function update_data(Request $request, $id)
    {
        $m_pekerja = ModelUser::where('id', $id)->first();
        $m_pekerja->name = $request->name;
        $m_pekerja->email = $request->email;
        $m_pekerja->password = Hash::make($request->password);
        $m_pekerja->password_ori = $request->password;
        $m_pekerja->img_profile = "profile-icon.png";
        $m_pekerja->stat_active = $request->stat_active;
        $m_pekerja->save();       

        echo "Data Berhasil Terupdate";
    }
    
    public function delete_data($id)
    {
        DB::table('m_user')->where('id',$id)->delete();
        return redirect('/master/user');
    }

    public function login_admin(){
        return view('/layouts/login_admin');
    }

    public function login(){
        return view('/layouts/login');
    }
    
    public function changePassword(){
        $passwordOri = "123456";
        $password = Hash::make($passwordOri);
        $update = DB::update("update m_user set password='".$password."',password_ori='".$passwordOri."',updated_at=NOW()");
    }

    public function loginPost(Request $request){

        $email = $request->email;
        $password = $request->password;

        $data = ModelUser::where('email',$email)->first();

        if($data){ //apakah email tersebut ada atau tidak
//            $userDtl = UserDetail::where('user_id',$data->id)->get();
//
//            $userLayanan = DB::select("SELECT * FROM m_data_pekerja_support_group a
//			WHERE a.user_id=".$data->id);
//
//            $roleDtl = new RoleGroupDetailController();
//            $modul = new MasterModulController();
//            $modulCategory = new ModulCategoryController();

            if(Hash::check($password,$data->password)){
                Session::put('id',$data->id);
                Session::put('name',$data->name);
                Session::put('email',$data->email);
                Session::put('picture',$data->img_profile);
                Session::put('loginSts',TRUE);
                                     
                $_SESSION['id'] = $data->id;
                $_SESSION['name'] = $data->name;
                $_SESSION['email'] = $data->email;
                $_SESSION['picture'] = $data->img_profile;
                $_SESSION['login_status'] = true;
//                $i=1;
//                $roleGrpUser="";
//                foreach($userDtl as $usr)
//                {
//                    $roleGrpUser .= (count($userDtl)==$i)?"'".$usr->role_group."'":"'".$usr->role_group."',";
//                    $i++;
//                }
//                $roleDtl_ = $roleDtl->get_submenu_by_role($roleGrpUser);
//                $modulCat_ = $modulCategory->get_parent_menu($data->id);
//                $modulCat_ = count($modulCat_)>0 ? $modulCat_ : 0;
//
//                Session::put('role_name',$roleGrpUser);
//                Session::put('role_submenu',$roleDtl_);
//                Session::put('parent_menu',$modulCat_);
//                Session::put('user_layanan',$userLayanan);

                return redirect('/home');
            }
            else{
                return redirect('login')->with('alert','Password atau Email, Salah !');
            }
        }
        else{
            return redirect('login')->with('alert','Password atau Email, Salah!');
        }
    }

    public static function cekPengguna($email){
        $data = ModelUser::where('email',$email)->first();

        if($data){
            $userDtl = UserDetail::where('user_id',$data->id)->get();

            $userLayanan = DB::select("SELECT * FROM m_data_pekerja_support_group a
            WHERE a.user_id=".$data->id);

            $roleDtl = new RoleGroupDetailController();
            $modul = new MasterModulController();
            $modulCategory = new ModulCategoryController();

            Session::put('id',$data->id);
            Session::put('name',$data->nama_pekerja);
            Session::put('no_pekerja',$data->no_pekerja);
            Session::put('email',$data->email);
            Session::put('picture',$data->img_profile);
            Session::put('login',TRUE);

            $i=1;
            $roleGrpUser="";
            foreach($userDtl as $usr)
            {
                $roleGrpUser .= (count($userDtl)==$i)?"'".$usr->role_group."'":"'".$usr->role_group."',";
                $i++;
            }
            $roleDtl_ = $roleDtl->get_submenu_by_role($roleGrpUser);
            $modulCat_ = $modulCategory->get_parent_menu($data->id);
            $modulCat_ = count($modulCat_)>0 ? $modulCat_ : 0;

            Session::put('role_name',$roleGrpUser);
            Session::put('role_submenu',$roleDtl_);
            Session::put('parent_menu',$modulCat_);
            Session::put('user_layanan',$userLayanan);

            return redirect("home");
        } else {
            return redirect('login')->with('alert','Password atau Email, Salah!');
        }

    }
    
    public function ldap_reject(){        
        return redirect('login')->with('alert','Anda Gagal Login, Silahkan Mengulangi.');
    }

    public function logout(){
        Session::flush();
        session_destroy();
        return redirect('login')->with('alert','Anda Sudah Keluar Dari Sistem.');
    }

    /* untuk model, controller master_layanan */
    public function kategori_layanan(){
    	if(!Session::get('login')){
            return redirect('login')->with('alert','Silahkan Login ...!!!');
        }
        else{
            return view('/layouts/master/kategori_layanan');
        }
    }

    /* untuk model, controller data pekerja */
    public function data_pekerja(){
    	if(!Session::get('login')){
            return redirect('login')->with('alert','Silahkan Login ...!!!');
        }
        else{
            return view('/layouts/master/data_pekerja');
        }
    }

    /* untuk model, controller mitra kerja */
    public function mitra_kerja(){
    	if(!Session::get('login')){
            return redirect('login')->with('alert','Silahkan Login ...!!!');
        }
        else{
            return view('/layouts/master/mitra_kerja');
        }
    }

    public static function is_ok($ldap_data){
        try {
            $val=$ldap_data->dataLDAP->Data->value;
            return true;
        } catch(\Throwable  $e) {
            return false;
        }
    }

    public static function get(Request $request){
        $ldap_array=self::periksa_ldap($request->email,$request->password);
        $ldap_data = json_encode($ldap_array);        
        $ldap_data = json_decode($ldap_data,false);
        //$sync = DB::update("EXEC p_v_sap_employee_loop");
        if (self::is_ok($ldap_data)){        	            
            if ($ldap_data->dataLDAP->Data->value==true){
                //echo "Berhasil";
                $email = $ldap_data->dataLDAP->Data->Email;
                return redirect('/ldap_post/'.$email);
            } else {
                //echo "Gagal";
                $email = $request->email;                
                return redirect('/ldap_post/'.$email);                
            }
        } else {
            //echo "Gagal";
            $email = $request->email;            
            return redirect('/ldap_post/'.$email);                
        }
    }

    public static function get_ldap(Request $request){
        $isldap=0;
        $response['status'] = 'FAIL';        
        $ldap_array=self::periksa_ldap($request->email,$request->password);
        $ldap_data = json_encode($ldap_array);        
        $ldap_data = json_decode($ldap_data,false);
        $response['value']=$ldap_data->dataLDAP->Data->value;
        if (self::is_ok($ldap_data)){
            
            if ($ldap_data->dataLDAP->Data->value==true){
                $isldap=1;

                //$data = ModelUser::where('email',$ldap_data->dataLDAP->Data->Email)->first();
            } else {

            }

            /*if (!empty($data)){
                $response['status'] = 'SUCCESS';
            }*/
        }

        $response['ldap_data'] = $ldap_data->dataLDAP->Data;
        $response['code'] = 200;
        //$response['data'] = $data;
        $response['isldap'] = $isldap;

        return response()->json($response);
    }

    public static function connect_ldap(Request $request){
        $array = self::periksa_ldap($request->username,$request->password);

        $response['status'] = 'SUCCESS';
        $response['code'] = 200;
        $response['data'] = $array;
        return response()->json($response);
    }

    public static  function periksa_ldap($username,$password){
        $param=array(
            'username' => $username,
            'password' => $password,
            'appname'  => ''
        );
        $param_set = json_encode($param);
        $url = env('LDAP_URL');
        $link = curl_init($url);
        curl_setopt($link, CURLOPT_CUSTOMREQUEST,'POST');
        curl_setopt($link, CURLOPT_POSTFIELDS,$param_set);
        curl_setopt($link, CURLOPT_RETURNTRANSFER,true);
        curl_setopt($link, CURLOPT_HTTPHEADER,array(
            'Content-type: application/json'
        ));
        $contents=curl_exec($link);
        //echo $contents;
        return json_decode($contents,true);
    }
}
