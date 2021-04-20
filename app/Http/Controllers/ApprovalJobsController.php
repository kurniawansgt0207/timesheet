<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ApprovalJobsController extends Controller
{
    //
    public function index($param1,$param2,$param3) {
        $statusDoc = $param1;
        $searchBy = $param2;
        $email = ($param3 == 0) ? $_SESSION['email'] : $param3;
        
        $listData = $this->showDataAllJoin($statusDoc,$searchBy,$email);
        return view('/layouts/transaksi/jobs/approval_jobs_list', ['approval_job_info' => $listData, 'status_doc' => $statusDoc]);
    }
    
    public function showDataAllJoin($status,$searchby,$email) {        
        $listData = DB::select("CALL `sp_t_job_listmenu_approve`('".$status."','".$searchby."','".$email."')");
        return $listData;
    }
    
    public function showDataAll() {
        $listData = DB::select("SELECT * FROM m_employee ORDER BY id");
        return $listData;
    }
    
    public function showData($id){
        $listData = DB::select("CALL `sp_t_job_get`(?)",array($id));
        return $listData;
    }
    
    public function showJobAreaCost($id){
        $listData = DB::select("CALL `sp_t_job_area_cost_get`(?)",array($id));
        return $listData;
    }
    
    public  function showJobDepartemen($id){
        $listData = DB::select("CALL `sp_t_job_departemen_get`(?)",array($id));
        return $listData;
    }
    
    public function showApprove($id,$userid){
        $listData = DB::select("CALL `sp_t_job_approval_get`(?,?)",array($id,$userid));
        return $listData;
    }

    public function addData(){        
        $client = new ClientInfoController();
        
        $group = array(0);        
        $clientInfo = $client->showDataAll();
        
        Session::put('status_edit', 1);
        
        return view('/layouts/transaksi/jobs/job',['job_info' => $group, 'client_list' => $clientInfo]);
    }
    
    public function editData($id,$userid,$sts){
        $client = new ClientInfoController();
        
        $jobs = $this->showData($id);
        $areaCost = $this->showJobAreaCost($id);
        $jobDept = $this->showJobDepartemen($id);
        $clientInfo = $client->showDataAll();
        $approveInfo = $this->showApprove($id, $userid);
                
        return view('/layouts/transaksi/jobs/approval_jobs',
                [
                    'approval_job_info' => $jobs, 'client_list' => $clientInfo, 
                    'status_edit' => $sts,'area_cost_info' => $areaCost,
                    'dept_info' => $jobDept,'approve_info' => $approveInfo
                ]
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
        $job_no = $request->job_no;
        $tgl_job = explode(" - ",$request->tgljob);
        $tglmulai = date("Y-m-d",strtotime($tgl_job[0]));
        $tglselesai = date("Y-m-d",strtotime($tgl_job[1]));
        $status_job = ($request->stsdocjob=="Complete") ? 1 : 0;
        
        $updateJob = DB::select("CALL `sp_t_job_update`(?,?,?,?,?,?,?,?)", array($request->id,$request->client,"$job_no",$request->fee,"$tglmulai","$tglselesai",$status_job,$userAuditId));
        
        $jmlDataAreaCost = count($request->idareacost);
        $idAreaCostJob = $request->idareacost;
        $AreaCostJodAmt = $request->areacostamt;
        for($a=0;$a<$jmlDataAreaCost;$a++){            
            $updateAreaCost = DB::select("CALL sp_t_job_area_cost_update(?,?,?)", array($idAreaCostJob[$a],$AreaCostJodAmt[$a],$userAuditId));
        }
        
        $jmlDeptJob = count($request->iddeptjob);
        $idDeptJob = $request->iddeptjob;
        $deptJobActive = $request->deptjobactive;
        
        for($b=0;$b<count($request->iddeptjob);$b++){            
            $updateDeptJob = DB::select("CALL sp_t_job_departemen_update(?,?,?)", array($idDeptJob[$b],isset($deptJobActive[$b])?1:0,$userAuditId));
        }
        
        $updateApproval = DB::select("CALL sp_t_job_approval_update(?,?,?,?,?)", array($request->idApproval,date("Y-m-d",strtotime($request->tgl_approval)),$request->ket_approval,$request->sts_approval,$userAuditId));
        
        echo $request->id."~".$userAuditId."~"."Data Berhasil Terupdate";
    }
    
    public function delete_data($id,$user)
    {
        DB::select("CALL sp_t_job_delete(?,?)", array($id,$user));
        return redirect('/transaksi/jobs/job/0/0/0');
    }
}
