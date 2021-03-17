@extends('layouts.app')

@section('content')
<script src="{{url('public/adminlte/bower_components/jquery/dist/jquery.min.js')}}"></script>
<script>
    $(document).ready(function () {
        $("#btnSubmit").click(function (event) {
            event.preventDefault();
            var form = $('#frmGroup')[0];
            var data = new FormData(form);
            data.append("CustomField", "This is some extra data, testing");
            $("#btnSubmit").prop("disabled", true);
            $.ajax({
                type: "POST",
                enctype: 'multipart/form-data',
                url: "{{url('/api/transaksi/jobs/job/store')}}",
                data: data,
                processData: false,
                contentType: false,
                cache: false,
                timeout: 600000,
                success: function (data) {
                    var msg = data.split("~");
                    var id = msg[0];
                    var pesan = msg[1];
                    alert(pesan);
                    $("#btnSubmit").prop("disabled", false);
                    window.location = "{{url('/')}}/transaksi/jobs/edit_data/"+id+"/1";
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
        JOBS ENTRY
    </h1>
    <ol class="breadcrumb">
        <li><a href="/home"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Transaksi</li>
        <li><a href="{{url('/')}}/transaksi/jobs/job">Job Info</a></li>
        <li class="active">Input Data</li>
    </ol>
</section>
<?php
    $readonly = (Session::get('status_edit')==0) ? "readonly" : "";
    $disabled = (Session::get('status_edit')==0) ? "disabled" : "";
    $pickdate = (Session::get('status_edit')==1) ? "id=\"reservation\"" : "";    
?>
<section class="content">
    <form id="frmGroup" name="frmGroup" method="post" action="{{url('/api/transaksi/jobs/job/store')}}">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-default">
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            @foreach($job_info as $job)
                            {{ csrf_field() }}
                            <input type="hidden" name="id" value="{{ isset($job->id)?$job->id:0 }}">
                            <input type="hidden" name="sessionVal" value="{{ $_SESSION['login_status'] }}">
                            <div class="form-group">
                                <label>Job Number</label>
                                <input type="text" class="form-control" id="job_no" name="job_no" placeholder="Auto Generate" required value="{{isset($job->id)?$job->job_number:''}}" readonly="readonly">
                            </div>      
                            <div class="form-group">
                                <label>Client</label>
                                <select class="form-control select2" style="width: 100%;" name="client" id="client" <?php echo $disabled;?> required onchange="getClientInfo()">
                                    <option>[Pilih Client]</option> 
                                    <?php
                                        $selected = "";                                        
                                        foreach($client_list as $client){
                                            if(isset($job->id)){
                                                $selected = ($client->id == $job->clientId) ? "selected" : "";                                            
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
                                <input type="text" class="form-control" id="fee" name="fee" placeholder="Fee" <?php echo $readonly;?> required value="{{isset($job->id)?$job->fee:''}}" style="text-align: right">
                            </div>                                                        
                            <div class="form-group date">
                                <label>Periode Job (Mulai s/d Selesai)</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <?php
                                        $tglMulai = isset($job->id) ? date("m/d/Y",strtotime($job->tanggal_mulai)) : "";
                                        $tglSelesai = isset($job->id) ? date("m/d/Y",strtotime($job->tanggal_selesai)) : "";
                                        $jobPeriod  = $tglMulai." - ".$tglSelesai;
                                    ?>
                                    <input type="text" class="form-control pull-right" name="tgljob" <?php echo $pickdate;?> <?php echo $readonly;?> value="<?php echo isset($job->id) ? $jobPeriod : "";?>">
                                </div>
                            </div>
                            <?php
                                if(!isset($job->id)){
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
        <?php
            if(isset($job_info[0]->id)){
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
                                        $area_cost_info = Session::get('area_cost_info');
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
                                        $job_dept_info = Session::get('dept_info');
                                        foreach($job_dept_info as $dept_job){                                            
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
                            <?php
                                if(isset($job->id)){
                            ?>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary" id="btnSubmit" <?php echo $disabled;?>>Submit</button>&nbsp;
                                <button type="button" class="btn btn-primary" onclick="window.location.href='{{url("/transaksi/jobs/job/0/0/0")}}'">Back</button>                                
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
            }
        ?>
        
    </div>
    </form>
</section>

@endsection
