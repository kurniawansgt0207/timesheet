@extends('layouts.app')

@section('content')
<script src="{{url('public/adminlte/bower_components/jquery/dist/jquery.min.js')}}"></script>
<script>
    $(document).ready(function () {
        $("#btnSubmit").click(function (event) {
            event.preventDefault();
            var form = $('#frmRole')[0];
            var data = new FormData(form);
            data.append("CustomField", "This is some extra data, testing");
            $("#btnSubmit").prop("disabled", true);
            $.ajax({
                type: "POST",
                enctype: 'multipart/form-data',
                url: "{{url('/api/master/role/store')}}",
                data: data,
                processData: false,
                contentType: false,
                cache: false,
                timeout: 600000,
                success: function (data) {
                    alert(data);
                    $("#btnSubmit").prop("disabled", false);
                    window.location = "{{url('/master/role')}}";
                },
                error: function (e) {
                    alert("Gagal Menyimpan Data, Silahkan Ulangi Proses.");
                    $("#btnSubmit").prop("disabled", false);
                }
            });
        });
    });
</script>
<section class="content-header">
    <h1>
        MANAGE ROLE INFO
    </h1>
    <ol class="breadcrumb">
        <li><a href="/home"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Master</li>
        <li><a href="{{url('/')}}/master/role">Area Info</a></li>
        <li class="active">Input Data</li>
    </ol>
</section>

<section class="content">
    <form id="frmRole" name="frmRole" method="post" action="{{url('/api/master/role/store')}}">
    <div class="row">
        <div class="col-md-6">
            <div class="box box-default">
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            @foreach($role_info as $role)                            
                            {{ csrf_field() }}
                            <input type="hidden" name="id" value="{{ isset($role->id)?$role->id:'' }}">
                            <input type="hidden" name="sessionVal" value="{{ $_SESSION['login_status'] }}">
                            <div class="form-group">
                                <label>Role Name</label>
                                <input type="text" class="form-control" id="role" name="role" placeholder="Role Name" required value="{{isset($role->id) ? strtoupper($role->role) :''}}">
                            </div>
                            <div class="row">
                                <div class="col-md-12">                            
                                    <label>Role</label>                            
                                    <table id="example" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th style="text-align: center">No</th>
                                                <th style="text-align: center">Modul Group</th>
                                                <th style="text-align: center">Modul Vidorder</th>
                                                <th style="text-align: center">Modul Name</th>
                                                <th style="text-align: center">Aktif</th>
                                            </tr>
                                        </thead> 
                                        <tbody>                                    
                                            <?php
                                                $no = 1;  
                                                
                                                foreach($modul_info as $modul){
                                                    $checked = "";
                                                    foreach($role_detail as $roledtl){
                                                        if($modul->id == $roledtl->modul_id){
                                                            $checked = "checked";
                                                            break;
                                                        }
                                                    }
                                            ?>
                                            <tr>
                                                <td align="center">{{$no}}<input type="hidden" name="modulid[]" id="modulid" value="{{ $modul->id }}"></td>
                                                <td align="center">{{ strtoupper($modul->modul_group) }}</td>
                                                <td align="center">{{ strtoupper($modul->modul_visorder) }}</td>
                                                <td align="center">{{ strtoupper($modul->modul_label) }}</td>
                                                <td align="center">
                                                    <input type="checkbox" name="modulactive[]" id="modulactive" value="{{$modul->id}}" {{ $checked }}>
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
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary" id="btnSubmit">Submit</button>&nbsp;                                
                                <button type="button" class="btn btn-primary" onclick="window.location.href='{{url("/master/role")}}'">Back</button>                                
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </form>
</section>

@endsection
