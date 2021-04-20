@extends('layouts.app')


@section('content')
<style>
    .disabled {
        pointer-events: none;
        cursor: default;
    }
</style>
<section class="content-header">
    <h1>
    APPROVAL TICKETS INFO
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Transaksi</li>
        <li class="active">Approval TICKETS Info</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">                                
                <div class="box-body">                    
                    <div class="row">
                        <div class="col-sm-2">
                            <label>Status Dokumen </label>                                                    
                            <select name="statusDoc" id="statusDoc" class="form-control" onchange="showData()">
                                <option value="3" {{ $status_doc == "3" ? "selected" : "" }}>Semua Status</option>
                                <option value="0" {{ $status_doc == "0" ? "selected" : "" }}>On Approve</option>
                                <option value="1" {{ $status_doc == "1" ? "selected" : "" }}>Approve</option>
                                <option value="2" {{ $status_doc == "2" ? "selected" : "" }}>Not Approve</option>
                            </select>
                        </div>
                    </div>
                    <div class="box-header"></div>
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Job No</th>
                            <th>Nama Client</th>
                            <th>Kota</th>
                            <th>Area</th>
                            <th>Tgl Mulai</th>
                            <th>Tgl Selesai</th>
                            <th>Departemen</th>
                            <th>Approval Status</th>
                            <th>#</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        echo $_SESSION['id'];
                        foreach($approval_ticket_info as $approval=>$p){                 
                            $btnEditDisabled = "";
                            $btnViewDisabled = "";
                            $btnDeleteDisabled = "";                            
                        ?>
                            <tr>
                                <td>{{$approval+1}}</td>
                                <td>{{$p->job_number}}</td>
                                <td>{{$p->nama}}</td>
                                <td>{{$p->kota}}</td>
                                <td>{{$p->area}}</td>
                                <td>{{date("d/m/Y",strtotime($p->tanggal_mulai))}}</td>
                                <td>{{isset($p->tanggal_selesai) ? date("d/m/Y",strtotime($p->tanggal_selesai)) : "-"}}</td>
                                <td>{{$p->departemen}}</td>
                                <td>{{$p->ApproveSts}}</td>
                                <td align="center">         
                                    <?php
                                        if($p->ApproveSts != "Approved"){
                                    ?>
                                    <a href="{{url('/')}}/transaksi/tickets/approval/edit_data/{{ $p->job_departemenId }}/{{ $p->employeeId }}/1">
                                        <img src="{{url('public/adminlte/dist/img/icon_approve.png')}}" width="18" height="18" title="Approve Data">
                                    </a>&nbsp;
                                    <?php 
                                        }
                                    ?>
                                    <a href="{{url('/')}}/transaksi/tickets/approval/edit_data/{{ $p->job_departemenId }}/{{ $p->employeeId }}/0">
                                        <img src="{{url('public/adminlte/dist/img/iconfinder.png')}}" width="18" height="18" title="Lihat Data">
                                    </a>
                                </td>
                            </tr>
                        <?php
                            }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    function showData(){
        var param1 = document.getElementById('statusDoc').value;        
        window.location.href="{{url('/')}}/transaksi/tickets/approval/list/"+param1+"/0/0";
    }
    
    function addData(){
        window.location.href="{{url('/transaksi/tickets/approval/add_data')}}";
    }

    function deleteData(id, userid){
      var tny = confirm("Yakin Akan Menghapus Data Ini ?"+id);
      if(tny == 1){
        window.location.href = "{{url('/')}}/api/transaksi/tickets/approval/delete/"+id+"/"+userid;
      }
    }
</script>
@endsection
