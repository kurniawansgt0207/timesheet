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
    TICKET INFO
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Transaksi</li>
        <li class="active">Tikcet Info</li>
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
                                <option value="2" {{ $status_doc == "3" ? "selected" : "" }}>Semua Status</option>
                                <option value="0" {{ $status_doc == "0" ? "selected" : "" }}>Draft</option>
                                <option value="1" {{ $status_doc == "1" ? "selected" : "" }}>Complete</option>
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
                            <th>Doc Status</th>
                            <th>#</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        
                        foreach($ticket_info as $ticket=>$p){                 
                            $btnEditDisabled = "";
                            $btnViewDisabled = "";
                            $btnDeleteDisabled = "";                            
                        ?>
                            <tr>
                                <td>{{$ticket+1}}</td>
                                <td>{{$p->job_number}}</td>
                                <td>{{$p->nama}}</td>
                                <td>{{$p->kota}}</td>
                                <td>{{$p->area}}</td>                                
                                <td>{{date("d/m/Y",strtotime($p->tanggal_mulai))}}</td>
                                <td>{{isset($p->tanggal_selesai) ? date("d/m/Y",strtotime($p->tanggal_selesai)) : "-"}}</td>
                                <td>{{$p->departemen}}</td>
                                <td>{{$p->dokStatus}}</td>                                
                                <td align="center">         
                                    <?php
                                        if($p->dokStatus != "Approved"){
                                    ?>
                                    <a href="{{url('/')}}/transaksi/tickets/ticket/edit_data/{{ $p->jobId }}/{{ $p->departemenId }}/{{ $p->job_departemenId }}/1">
                                        <img src="{{url('public/adminlte/dist/img/icon-edit.png')}}" width="18" height="18" title="Ubah Data">
                                    </a>&nbsp;
                                    <?php 
                                        }
                                    ?>
                                    <a href="{{url('/')}}/transaksi/tickets/ticket/edit_data/{{ $p->jobId }}/{{ $p->departemenId }}/{{ $p->job_departemenId }}/0">
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
        window.location.href="{{url('/')}}/transaksi/tickets/ticket/"+param1+"/0/0";
    }
    
    function addData(){
        window.location.href="{{url('/transaksi/tickets/ticket/add_data')}}";
    }

    function deleteData(id, userid){
      var tny = confirm("Yakin Akan Menghapus Data Ini ?"+id);
      if(tny == 1){
        window.location.href = "{{url('/')}}/api/transaksi/tickets/ticket/delete/"+id+"/"+userid;
      }
    }
</script>
@endsection
