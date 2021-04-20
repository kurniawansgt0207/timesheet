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
                url: "{{url('/api/transaksi/tickets/ticket/store')}}",
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
                    window.location = "{{url('/')}}/transaksi/tickets/ticket/0/0/0";
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
        TICKET ENTRY
    </h1>
    <ol class="breadcrumb">
        <li><a href="/home"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Ticket</li>
        <li><a href="{{url('/')}}/transaksi/tickets/ticket">Ticket Info</a></li>
        <li class="active">Input Data</li>
    </ol>
</section>
<?php
    $readonly = ($status_edit==0) ? "readonly" : "";
    $disabled = ($status_edit==0) ? "disabled" : "";
    $pickdate = ($status_edit==1) ? "id=\"reservation\"" : "";    
?>
<section class="content">
    <form id="frmGroup" name="frmGroup" method="post" action="{{url('/api/transaksi/tickets/ticket/store')}}">
    <div class="row">
        <div class="col-md-6">
            <div class="box box-default">
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            @foreach($ticket_info as $ticket)
                            {{ csrf_field() }}
                            <input type="hidden" name="job_deptid" value="{{ isset($ticket->job_departemenId)?$ticket->job_departemenId:0 }}">
                            <input type="hidden" name="job_id" value="{{ isset($ticket->job_departemenId)?$ticket->jobId:0 }}">
                            <input type="hidden" name="sessionVal" value="{{ $_SESSION['login_status'] }}">
                            <div class="form-group">
                                <label>Job Number</label>
                                <input type="text" class="form-control" id="job_no" name="job_no" placeholder="Auto Generate" required value="{{isset($ticket->job_departemenId)?$ticket->job_number:''}}" readonly="readonly">
                            </div>      
                            <div class="form-group">
                                <label>Client</label>
                                <select class="form-control select2" style="width: 100%;" name="client" id="client" <?php echo $disabled;?> required onchange="getClientInfo()">
                                    <option>[Pilih Client]</option> 
                                    <?php
                                        $selected = "";                                        
                                        foreach($client_list as $client){
                                            if(isset($ticket->job_departemenId)){
                                                $selected = ($client->id == $ticket->clientId) ? "selected" : "";                                            
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
                                <input type="text" class="form-control" id="fee" name="fee" placeholder="Fee" <?php echo $readonly;?> required value="{{isset($ticket->job_departemenId)?$ticket->fee:''}}" style="text-align: right">
                            </div>                                                        
                            <div class="form-group date">
                                <label>Periode Job (Mulai s/d Selesai)</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <?php
                                        $tglMulai = isset($ticket->job_departemenId) ? date("m/d/Y",strtotime($ticket->tanggal_mulai)) : "";
                                        $tglSelesai = isset($ticket->job_departemenId) ? date("m/d/Y",strtotime($ticket->tanggal_selesai)) : "";
                                        $ticketPeriod  = $tglMulai." - ".$tglSelesai;
                                    ?>
                                    <input type="text" class="form-control pull-right" name="tgljob" <?php echo $pickdate;?> <?php echo $readonly;?> value="<?php echo isset($ticket->job_departemenId) ? $ticketPeriod : "";?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Status Job&nbsp;</label>
                                <input type="radio" class="minimal" id="stsdoc" name="stsdoc" value="0" <?php echo $disabled;?> <?php echo (isset($ticket->job_departemenId) && $ticket->dokStatus=="Draft") ? "checked" : "";?> required>&nbsp;Draft&nbsp;
                                <input type="radio" class="minimal" id="stsdoc" name="stsdoc" value="1" <?php echo $disabled;?> <?php echo (isset($ticket->job_departemenId) && $ticket->dokStatus=="Complete") ? "checked" : "";?> required>&nbsp;Complete&nbsp;
                            </div>
                            <?php
                                if(!isset($ticket->job_departemenId)){
                            ?>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary" id="btnSubmit">Submit</button>&nbsp;                                
                                <button type="button" class="btn btn-primary" onclick="window.location.href='{{url("/transaksi/tickets/ticket/0/0/0")}}'">Back</button>                                
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
            if(isset($ticket_info[0]->job_departemenId)){
        ?>        
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
                                        <th>NIK</th>
                                        <th>NAMA</th>
                                        <th>JABATAN</th>
                                        <th>ACTIVE</th>
                                    </tr>
                                </thead> 
                                <tbody>                                    
                                    <?php
                                        $no = 1;                                
                                        foreach($dept_list as $dept_job){                                            
                                    ?>
                                    <tr>
                                        <td align="center">{{$no}}
                                            <input type="hidden" name="iddeptjob[]" id="iddeptjob" value="{{ $dept_job->departemenId }}">
                                            <input type="hidden" name="ticketid[]" id="ticketid" value="{{ $dept_job->ticketId }}">
                                        </td>
                                        <td align="center">{{ $dept_job->nik}}</td>
                                        <td align="left">{{ $dept_job->nama}}</td>
                                        <td align="left">{{ $dept_job->jabatan}}</td>
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
                                if(isset($ticket->job_departemenId)){
                            ?>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary" id="btnSubmit" <?php echo $disabled;?>>Submit</button>&nbsp;
                                <button type="button" class="btn btn-primary" onclick="window.location.href='{{url("/transaksi/tickets/ticket/0/0/0")}}'">Back</button>                                
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
