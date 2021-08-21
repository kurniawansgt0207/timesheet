<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

use App\Http\Controllers\ActivityTypeInfoController;

class TimesheetController extends Controller
{
    //
    public function index($param1,$param2,$param3) {
        $tahun = isset($param1) && $param1 != 0 ? $param1 : date("Y");
        $bulan = isset($param2) && $param2 != 0 ? $param2 : date("n");
        $model = isset($param3) && $param3 != 0 ? $param3 : 1;
        
        $listData = $this->showDataAllJoin($tahun,$bulan,$model);
        return view('/layouts/transaksi/timesheets/timesheet_list', ['timesheet_info' => $listData, 'tahun'=> $tahun, 'bulan'=>$bulan, 'model'=>$model]);
    }
    
    public function showDataAllJoin($tahun,$bulan,$model) {
        $userid = $_SESSION['id'];
        $listData = DB::select("CALL sp_t_timesheet_listmenu(".$tahun.",".$bulan.",".$model.",".$userid.")");
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

    public function addData($ticketid,$tglcol){
        $activityTypeInfo = new ActivityTypeInfoController();
        
        $rsData = DB::select("CALL sp_t_timesheet_detail_get(?,?)",array($ticketid,$tglcol));
        $activitytype = $activityTypeInfo->showDataAll();
        
        return view('/layouts/transaksi/timesheets/timesheet',['rsData'=>$rsData, 'activity_type_list'=>$activitytype]);
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
        $id = isset($request->activityId)?$request->activityId:0;
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
        $activityId = $request->activityId;
        $tglCol = $request->tglCol;
        $ticketId = $request->ticketid;
        $isInClient = $request->isInClient;
        $activityType = $request->tipeAktifitas;
        $activity = $request->aktifitas;
        $jmlJam = $request->jmlJam;
        $isComplete = 1;
        $userAuditId = $_SESSION['id'];
        
        $thnSlc = date("Y",strtotime($tglCol));
        $blnSlc = date("n",strtotime($tglCol));
        $hariSlc = date("j",strtotime($tglCol));
        
        $modelTgl = ($hariSlc >= 1 && $hariSlc <= 15) ? 1 : 2;
        
        $execute = DB::select("CALL sp_t_timesheet_detail_insert_update(?,?,?,?,?,?,?,?,?)",
                array($activityId,$ticketId,$isInClient,$tglCol,$activityType,$activity,$jmlJam,$isComplete,$userAuditId));
        
        echo $thnSlc."~".$blnSlc."~".$modelTgl."~Data Berhasil Tersimpan";
    }
    
    public function update_data(Request $request, $id)
    {
        $activityId = $id;
        $tglCol = $request->tglCol;
        $ticketId = $request->ticketid;
        $isInClient = $request->isInClient;
        $activityType = $request->tipeAktifitas;
        $activity = $request->aktifitas;
        $jmlJam = $request->jmlJam;
        $isComplete = 1;
        $userAuditId = $_SESSION['id'];
        
        $thnSlc = date("Y",strtotime($tglCol));
        $blnSlc = date("n",strtotime($tglCol));
        $hariSlc = date("j",strtotime($tglCol));
        
        $modelTgl = ($hariSlc >= 1 && $hariSlc <= 15) ? 1 : 2;
        
        $execute = DB::select("CALL sp_t_timesheet_detail_insert_update(?,?,?,?,?,?,?,?,?)",
                array($activityId,$ticketId,$isInClient,$tglCol,$activityType,$activity,$jmlJam,$isComplete,$userAuditId));
        
        echo $thnSlc."~".$blnSlc."~".$modelTgl."~Data Berhasil Terupdate";
    }
    
    public function delete_data($id,$user)
    {
        DB::select("CALL sp_t_job_delete(?,?)", array($id,$user));
        return redirect('/transaksi/tickets/job/0/0/0');
    }
}
