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
                url: "{{url('/api/master/group/store')}}",
                data: data,
                processData: false,
                contentType: false,
                cache: false,
                timeout: 600000,
                success: function (data) {
                    alert(data);
                    $("#btnSubmit").prop("disabled", false);
                    window.location = "{{url('/master/group')}}";
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
        MANAGE GROUP INFO
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{url('/')}}/home"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Master</li>
        <li><a href="{{url('/')}}/master/group">Group Info</a></li>
        <li class="active">Input Data</li>
    </ol>
</section>

<section class="content">
    <form id="frmGroup" name="frmGroup" method="post" action="{{url('/api/master/group/store')}}">
    <div class="row">
        <div class="col-md-6">
            <div class="box box-default">
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            @foreach($group_info as $group)                            
                            {{ csrf_field() }}
                            <input type="hidden" name="id" value="{{ isset($group->id)?$group->id:'' }}">
                            <input type="hidden" name="sessionVal" value="{{ $_SESSION['login_status'] }}">
                            <div class="form-group">
                                <label>Group Code</label>
                                <input type="text" class="form-control" id="groupcode" name="groupcode" placeholder="Group Code" required value="{{isset($group->id)?$group->groupcode:''}}">
                            </div>
                            <div class="form-group">
                                <label>Group Name</label>
                                <input type="text" class="form-control" id="groupname" name="groupname" placeholder="Alamat" rows="3" required value="{{isset($group->id)?$group->groupname:''}}">
                            </div>
                            <div class="form-group">
                                <label>Kota</label>
                                <input type="text" class="form-control" id="jmlkota" name="jmlkota" placeholder="Jumlah Kota" required value="{{isset($group->id)?$group->jmlkota:''}}">
                            </div>                        
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary" id="btnSubmit">Submit</button>&nbsp;                                
                                <button type="button" class="btn btn-primary" onclick="window.location.href='{{url("/master/group")}}'">Back</button>                                
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
