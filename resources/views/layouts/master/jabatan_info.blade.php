@extends('layouts.app')

@section('content')
<script src="{{url('public/adminlte/bower_components/jquery/dist/jquery.min.js')}}"></script>
<script>
    $(document).ready(function () {
        $("#btnSubmit").click(function (event) {
            event.preventDefault();
            var form = $('#frmJabatan')[0];
            var data = new FormData(form);
            data.append("CustomField", "This is some extra data, testing");
            $("#btnSubmit").prop("disabled", true);
            $.ajax({
                type: "POST",
                enctype: 'multipart/form-data',
                url: "{{url('/api/master/jabatan/store')}}",
                data: data,
                processData: false,
                contentType: false,
                cache: false,
                timeout: 600000,
                success: function (data) {
                    alert(data);
                    $("#btnSubmit").prop("disabled", false);
                    window.location = "{{url('/master/jabatan')}}";
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
        MANAGE JABATAN INFO
    </h1>
    <ol class="breadcrumb">
        <li><a href="/home"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Master</li>
        <li><a href="{{url('/')}}/master/jabatan">Area Info</a></li>
        <li class="active">Input Data</li>
    </ol>
</section>

<section class="content">
    <form id="frmGroup" name="frmGroup" method="post" action="{{url('/api/master/jabatan/store')}}">
    <div class="row">
        <div class="col-md-6">
            <div class="box box-default">
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            @foreach($jabatan_info as $jabatan)                            
                            {{ csrf_field() }}
                            <input type="hidden" name="id" value="{{ isset($jabatan->id)?$jabatan->id:'' }}">
                            <input type="hidden" name="sessionVal" value="{{ $_SESSION['login_status'] }}">
                            <div class="form-group">
                                <label>Jabatan</label>
                                <input type="text" class="form-control" id="jabatan" name="jabatan" placeholder="Jabatan" required value="{{isset($jabatan->id)?$jabatan->jabatan:''}}">
                            </div>      
                            <div class="form-group">
                                <label>Level</label>
                                <select class="form-control select2" name="level" id="level" required>                                    
                                    <option>[Pilih Level]</option>                                    
                                    <?php
                                        $selected = "";
                                        foreach($level_info as $level){                                                 
                                            if(isset($jabatan->id)){
                                                $selected = ($level->id == $jabatan->levelId) ? "selected" : "";                                            
                                            }
                                    ?>
                                    <option value="{{ $level->id }}" <?php echo $selected;?>>- {{ $level->levelname }} -</option>
                                    <?php                                        
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary" id="btnSubmit">Submit</button>&nbsp;                                
                                <button type="button" class="btn btn-primary" onclick="window.location.href='{{url("/master/jabatan")}}'">Back</button>                                
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
