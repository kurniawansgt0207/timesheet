<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;



class TicketController extends Controller
{
    //
    public function index($param1,$param2,$param3) {
        $statusDoc = $param1;
        $searchBy = $param2;
        $email = $param3;
        
        $listData = $this->showDataAllJoin($statusDoc,$searchBy,$email);
        return view('/layouts/transaksi/tickets/ticket_list', ['ticket_info' => $listData, 'status_doc' => $statusDoc]);
    }
    
    public function showDataAllJoin($status,$searchby,$email) {
        $email = $_SESSION['email'];
        $listData = DB::select("CALL `sp_t_ticket_listmenu_admin`('".$status."','".$searchby."','".$email."')");
        return $listData;
    }
    
    public function showDataAll() {
        $listData = DB::select("SELECT * FROM m_employee ORDER BY id");
        return $listData;
    }
    
    public function showData($deptid){
        $listData = DB::select("CALL `sp_t_ticket_get`(?)",array($deptid));
        return $listData;
    }
        
    public  function showTicketDepartemen($id,$deptid){
        $listData = DB::select("CALL `sp_t_ticket_dept_get`(?,?)",array($id,$deptid));
        return $listData;
    }

    public function addData(){        
        $client = new ClientInfoController();
        
        $group = array(0);        
        $clientInfo = $client->showDataAll();
        
        Session::put('status_edit', 1);
        
        return view('/layouts/transaksi/tickets/job',['job_info' => $group, 'client_list' => $clientInfo]);
    }
    
    public function editData($id,$deptid,$jobdeptid,$sts){
        $client = new ClientInfoController();
        
        $ticket = $this->showData($jobdeptid);
        $deptInfo = $this->showTicketDepartemen($id,$deptid); 
        $clientInfo = $client->showDataAll();
                
        return view('/layouts/transaksi/tickets/ticket',
                [
                    'ticket_info' => $ticket, 'dept_list' => $deptInfo, 
                    'client_list' => $clientInfo, 'status_edit' => $sts
                ]
        );
    }
    
    public function storeData(Request $request)
    {
        $session = isset($request->sessionVal)?$request->sessionVal:0;
        $id = isset($request->job_id)?$request->job_id:0;
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
        $userAuditId = $_SESSION['id'];
        $tgl_job = explode(" - ",$request->tgljob);
        $tglmulai = date("Y-m-d",strtotime($tgl_job[0]));
        $tglselesai = date("Y-m-d",strtotime($tgl_job[1]));           
        
        $listData = DB::select("CALL `sp_t_job_insert`(?,?,?,?,?,?,?,?)",array($request->id,$request->client,"",$request->fee,"$tglmulai","$tglselesai",0,$userAuditId));
        
        $getLastId = DB::select("SELECT id FROM t_job ORDER BY id DESC LIMIT 1");
        $lastId = $getLastId[0]->id;
        
        echo $lastId."~Data Berhasil Tersimpan";
    }
    
    public function update_data(Request $request, $id)
    {
        $userAuditId = $_SESSION['id'];
        $job_id = $request->job_id;
        $jobdept_id = $request->job_deptid;
        $tgl_job = explode(" - ",$request->tgljob);
        $tglmulai = date("Y-m-d",strtotime($tgl_job[0]));
        $tglselesai = date("Y-m-d",strtotime($tgl_job[1]));
        
        $updateJob = DB::select("CALL `sp_t_ticket_dept_update`(?,?,?)", array($jobdept_id,$request->stsdoc,$userAuditId));                
        
        $jmlDeptJob = count($request->iddeptjob);
        $idDeptJob = $request->iddeptjob;
        $idTicket = $request->ticketid;
        $deptJobActive = $request->deptjobactive;
        
        for($b=0;$b<count($request->iddeptjob);$b++){            
            $updateDeptJob = DB::select("CALL sp_t_ticket_update(?,?,?)", array($idTicket[$b],isset($deptJobActive[$b])?1:0,$userAuditId));
        }
        echo $request->id."~Data Berhasil Terupdate";
    }
    
    public function delete_data($id,$user)
    {
        DB::select("CALL sp_t_job_delete(?,?)", array($id,$user));
        return redirect('/transaksi/tickets/job/0/0/0');
    }
}
