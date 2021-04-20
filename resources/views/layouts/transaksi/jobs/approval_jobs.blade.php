@extends('layouts.app')

@section('content')
<script src="{{url('public/adminlte/bower_components/jquery/dist/jquery.min.js')}}"></script>
<script>
    $(document).ready(function () {
        $("#btnSubmit").click(function (event) {
            event.preventDefault();
            var form = $('#frmApproval')[0];
            var data = new FormData(form);
            data.append("CustomField", "This is some extra data, testing");
            $("#btnSubmit").prop("disabled", true);
            $.ajax({
                type: "POST",
                enctype: 'multipart/form-data',
                url: "{{url('/api/transaksi/jobs/approval/store')}}",
                data: data,
                processData: false,
                contentType: false,
                cache: false,
                timeout: 600000,
                success: function (data) {
                    var msg = data.split("~");
                    var id = msg[0];
                    var iduser = msg[1];
                    var pesan = msg[2];
                    alert(pesan);
                    $("#btnSubmit").prop("disabled", false);                    
                    window.location = "{{url('/')}}/transaksi/jobs/approval/list/0/0/0";
                },
                error: function (e) {
                    alert("Gagal Menyimpan Data, Silahkan Ulangi Proses.");
                    $("#btnSubmit").prop("disabled", false);
                }
            });
        });
    });
    
    function getClientInfo(){
        var clientId = document.getElementById('client').value;        
        var url = "{{url('/')}}/master/client/find_data_detail/"+clientId;
        $("#clientdtl").load(url);      
    }
</script>
<section class="content-header">
    <h1>
        APPROVAL JOBS ENTRY
    </h1>
    <ol class="breadcrumb">
        <li><a href="/home"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Transaksi</li>
        <li><a href="{{url('/')}}/transaksi/jobs/approval/0/0/0">Approval Job Info</a></li>
        <li class="active">Input Data</li>
    </ol>
</section>
<?php    
    $readonly = ($status_edit==0) ? "readonly" : "";
    $disabled = ($status_edit==0) ? "disabled" : "";
    $pickdate = ($status_edit==1) ? "id=\"reservation\"" : "";    
?>
<section class="content">
    <form id="frmApproval" name="frmApproval" method="post" action="{{url('/api/transaksi/jobs/approval/store')}}">
    <div class="row">
        <div class="col-md-6">
            <div class="box box-default">
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            @foreach($approval_job_info as $approval)
                            {{ csrf_field() }}
                            <input type="hidden" name="id" value="{{ isset($approval->id)?$approval->id:0 }}">
                            <input type="hidden" name="sessionVal" value="{{ $_SESSION['login_status'] }}">
                            <div class="form-group">
                                <label>Job Number</label>
                                <input type="text" class="form-control" id="job_no" name="job_no" placeholder="Auto Generate" required value="{{isset($approval->id)?$approval->job_number:''}}" readonly="readonly">
                            </div>      
                            <div class="form-group">
                                <label>Client</label>
                                <select class="form-control select2" style="width: 100%;" name="client" id="client" <?php echo $disabled;?> required onchange="getClientInfo()">
                                    <option>[Pilih Client]</option> 
                                    <?php
                                        $selected = "";                                        
                                        foreach($client_list as $client){
                                            if(isset($approval->id)){
                                                $selected = ($client->id == $approval->clientId) ? "selected" : "";                                            
                                            }
                                    ?>
                                    <option value="{{ $client->id }}"{{ $selected }}>- {{ $client->nama }} -</option>
                                    <?php
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <div id="clientdtl"></div>
                            </div>
                            <div class="form-group">
                                <label>Fee</label>
                                <input type="text" class="form-control" id="fee" name="fee" placeholder="Fee" <?php echo $readonly;?> required value="{{isset($approval->id)?$approval->fee:''}}" style="text-align: right">
                            </div>                                                        
                            <div class="form-group date">
                                <label>Periode Job (Mulai s/d Selesai)</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <?php
                                        $tglMulai = isset($approval->id) ? date("m/d/Y",strtotime($approval->tanggal_mulai)) : "";
                                        $tglSelesai = isset($approval->id) ? date("m/d/Y",strtotime($approval->tanggal_selesai)) : "";
                                        $approvalPeriod  = $tglMulai." - ".$tglSelesai;
                                    ?>
                                    <input type="text" class="form-control pull-right" name="tgljob" <?php echo $pickdate;?> <?php echo $readonly;?> value="<?php echo isset($approval->id) ? $approvalPeriod : "";?>">
                                </div>
                            </div>
                            <!--<div class="form-group">
                                <label>Status Job&nbsp;</label>
                                <input type="radio" class="minimal" id="stsdoc" name="stsdoc" value="0" <?php echo (isset($approval->id) && $approval->dokStatus=="Draft") ? "checked" : "";?> required>&nbsp;Draft&nbsp;
                                <input type="radio" class="minimal" id="stsdoc" name="stsdoc" value="1" <?php echo (isset($approval->id) && $approval->dokStatus=="Complete") ? "checked" : "";?> required>&nbsp;Complete&nbsp;
                            </div>-->
                            <input type="hidden" name="stsdocjob" id="stsdocjob" value="<?php echo isset($approval->id)?$approval->dokStatus:"";?>">
                            <?php
                                if(!isset($approval->id)){
                            ?>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary" id="btnSubmit">Submit</button>&nbsp;                                
                                <button type="button" class="btn btn-primary" onclick="window.location.href='{{url("/transaksi/jobs/job/0/0/0")}}'">Back</button>                                
                            </div>
                            <?php
                                }
                            ?>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box box-default">
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">                            
                            <label>DETAIL JOB DEPARTEMEN</label>                            
                            <table id="example" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Departemen</th>
                                        <th>#</th>
                                    </tr>
                                </thead> 
                                <tbody>                                    
                                    <?php
                                        $no = 1;
                                        foreach($dept_info as $dept_job){                                            
                                    ?>
                                    <tr>
                                        <td align="center">{{$no}}<input type="hidden" name="iddeptjob[]" id="iddeptjob" value="{{ $dept_job->id}}"></td>
                                        <td align="center">{{$dept_job->departemen}}</td>
                                        <td align="center">
                                            <input type="checkbox" name="deptjobactive[{{ ($no-1) }}]" id="deptjobactive" <?php echo $disabled;?> <?php echo ($dept_job->isActive=="1") ? "checked" : "" ;?>>
                                        </td>                                        
                                    </tr>
                                    <?php
                                            $no++;
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <?php
            //if(isset($approval_info[0]->id)){
        ?>
        <div class="col-md-6">
            <div class="box box-default">
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">                            
                            <label>DETAIL JOB AREA COST</label>                            
                            <table id="example" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Area</th>
                                        <th>Cost</th>
                                        <th>Nilai Cost</th>
                                        <th>#</th>
                                    </tr>
                                </thead> 
                                <tbody>                                    
                                    <?php
                                        $no = 1;                                        
                                        foreach($area_cost_info as $area_cost){
                                            
                                    ?>
                                    <tr>
                                        <td align="center">{{$no}}<input type="hidden" name="idareacost[]" id="idareacost" value="{{ $area_cost->id}}"></td>
                                        <td align="center">{{$area_cost->area}}</td>
                                        <td align="left">{{$area_cost->costname}}</td>
                                        <td align="center">                                            
                                            <input type="text" name="areacostamt[]" id="areacostamt" <?php echo $readonly;?> style="text-align: right; width: 110px" value="{{ str_replace(".00", "", $area_cost->costAmt) }}">
                                        </td>
                                        <td align="center">
                                            <input type="checkbox" name="areacostactive[]" id="areacostactive" value="{{ $area_cost->isActive }}" <?php echo $disabled;?> <?php echo ($area_cost->isActive=="1") ? "checked" : "" ;?>>
                                        </td>                                        
                                    </tr>
                                    <?php
                                            $no++;
                                        }
                                    ?>
                                </tbody>
                            </table>                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="box box-default">
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">                            
                            <label>APPROVE DOKUMEN JOB</label>                            
                            <table id="example" class="table table-bordered table-hover">  
                                <input type="hidden" name="idApproval" id="idApproval" value="{{isset($approval->id)?$approve_info[0]->job_approvalId:0}}">
                                <div class="form-group">
                                    <label>Urutan</label>
                                    <input type="text" class="form-control" id="urutan" name="urutan" placeholder="Urutan Approval" <?php echo $readonly;?> required value="{{isset($approval->id)?$approve_info[0]->noUrut:''}}">
                                </div> 
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" class="form-control" id="nama_approval" name="nama_approval" placeholder="Nama Approval" <?php echo $readonly;?> required value="{{isset($approval->id)?$approve_info[0]->nama:''}}">
                                </div> 
                                <div class="form-group">
                                    <label>Jabatan</label>
                                    <input type="text" class="form-control" id="jabatan_approval" name="jabatan_approval" placeholder="Jabatan Approval" <?php echo $readonly;?> required value="{{isset($approval->id)?$approve_info[0]->jabatan:''}}">
                                </div> 
                                <div class="form-group">
                                    <label>Tanggal Approve</label>
                                    <input type="text" class="form-control pull-right" id="datepicker" name="tgl_approval" placeholder="Tanggal Approval" <?php echo $readonly;?> required value="{{($approve_info[0]->approvalDate!="")?date("m/d/Y",strtotime($approve_info[0]->approvalDate)):date("m/d/Y")}}">
                                </div> 
                                <div class="form-group">
                                    <label>Keterangan</label>
                                    <textarea class="form-control" id="ket_approval" name="ket_approval" placeholder="Keterangan Approval" <?php echo $readonly;?> required>{{isset($approval->id)?$approve_info[0]->keterangan:""}}</textarea>                                    
                                </div> 
                                <div class="form-group">                                    
                                    <input type="radio" class="minimal" id="sts_approval" name="sts_approval" value="1" <?php echo $disabled;?> <?php echo (isset($approval->id) && $approve_info[0]->approvalSts=="1") ? "checked" : "";?> required>&nbsp;Approve&nbsp;
                                    <input type="radio" class="minimal" id="sts_approval" name="sts_approval" value="0" <?php echo $disabled;?> <?php echo (isset($approval->id) && $approve_info[0]->approvalSts=="0") ? "checked" : "";?> required>&nbsp;Not Approve&nbsp;                                    
                                </div>
                            </table>
                            <?php
                                if(isset($approval->id)){
                            ?>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary" id="btnSubmit" <?php echo $disabled;?>>Submit</button>&nbsp;
                                <button type="button" class="btn btn-primary" onclick="window.location.href='{{url("/transaksi/jobs/approval/list/0/0/0")}}'">Back</button>                                
                            </div>
                            <?php
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
            //}
        ?>
        
    </div>
    </form>
</section>

@endsection
