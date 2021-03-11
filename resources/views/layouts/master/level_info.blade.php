@extends('layouts.app')

@section('content')
<script src="{{url('public/adminlte/bower_components/jquery/dist/jquery.min.js')}}"></script>
<script>
    $(document).ready(function () {
        $("#btnSubmit").click(function (event) {
            event.preventDefault();
            var form = $('#frmLevel')[0];
            var data = new FormData(form);
            data.append("CustomField", "This is some extra data, testing");
            $("#btnSubmit").prop("disabled", true);
            $.ajax({
                type: "POST",
                enctype: 'multipart/form-data',
                url: "{{url('/api/master/level/store')}}",
                data: data,
                processData: false,
                contentType: false,
                cache: false,
                timeout: 600000,
                success: function (data) {
                    alert(data);
                    $("#btnSubmit").prop("disabled", false);
                    window.location = "{{url('/master/level')}}";
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
        MANAGE LEVEL INFO
    </h1>
    <ol class="breadcrumb">
        <li><a href="/home"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Master</li>
        <li><a href="{{url('/')}}/master/level">Level Info</a></li>
        <li class="active">Input Data</li>
    </ol>
</section>

<section class="content">
    <form id="frmLevel" name="frmLevel" method="post" action="{{url('/api/master/level/store')}}">
    <div class="row">
        <div class="col-md-6">
            <div class="box box-default">
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            @foreach($level_info as $level)                            
                            {{ csrf_field() }}
                            <input type="hidden" name="id" value="{{ isset($level->id)?$level->id:'' }}">
                            <input type="hidden" name="sessionVal" value="{{ $_SESSION['login_status'] }}">
                            <div class="form-group">
                                <label>Level Name</label>
                                <input type="text" class="form-control" id="levelname" name="levelname" placeholder="Level Name" required value="{{isset($level->id)?$level->levelname:''}}">
                            </div>      
                            <div class="form-group">
                                <label>Level No</label>
                                <select class="form-control select2" style="width: 100%;" name="levelno" id="levelno" required>
                                    <option>[Pilih Level No]</option> 
                                    <?php
                                        $selected = "";                                        
                                        for($a=0;$a<10;$a++){
                                            if(isset($employee->id)){
                                                $selected = (($a+1) == $employee->levelno) ? "selected" : "";                                            
                                            }
                                    ?>
                                    <option value="{{ ($a+1) }}" {{ $selected }}>- {{ ($a+1) }} -</option>
                                    <?php
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary" id="btnSubmit">Submit</button>&nbsp;                                
                                <button type="button" class="btn btn-primary" onclick="window.location.href='{{url("/master/level")}}'">Back</button>                                
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
