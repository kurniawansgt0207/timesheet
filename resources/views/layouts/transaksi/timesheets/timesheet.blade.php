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
                url: "{{url('/api/transaksi/timesheets/store')}}",
                data: data,
                processData: false,
                contentType: false,
                cache: false,
                timeout: 600000,
                success: function (data) {
                    var msg = data.split("~");
                    var thn = msg[0];
                    var bln = msg[1];
                    var model = msg[2];
                    var pesan = msg[3];
                    alert(pesan);
                    $("#btnSubmit").prop("disabled", false);
                    window.location = "{{url('/')}}/transaksi/timesheets/timesheet/"+thn+"/"+bln+"/"+model;
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
        TIMESHEET ENTRY
    </h1>
    <ol class="breadcrumb">
        <li><a href="/home"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Timesheet</li>
        <li><a href="{{url('/')}}/transaksi/tickets/ticket">Timesheet Info</a></li>
        <li class="active">Input Data</li>
    </ol>
</section>
<?php
    
?>
<section class="content">
    <form id="frmGroup" name="frmGroup" method="post" action="{{url('/api/transaksi/timesheets/store')}}">
    <div class="row">
        <div class="col-md-6">
            <div class="box box-default">
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            @foreach($rsData as $timesheet)
                            {{ csrf_field() }}
                            <input type="hidden" name="activityId" value="{{ isset($timesheet->activityId)?$timesheet->activityId:0 }}">
                            <input type="hidden" name="tglCol" value="{{ isset($timesheet->activityId)?$timesheet->tanggal:date("Y-m-d") }}">
                            <input type="hidden" name="sessionVal" value="{{ $_SESSION['login_status'] }}">
                            <div class="form-group">
                                <label>Ticket Id</label>
                                <input type="text" class="form-control" name="ticketid" id="ticketid" value="{{isset($timesheet->activityId)?$timesheet->ticketId:0}}" readonly="readonly">
                            </div>
                            <div class="form-group">
                                <label>No. Job</label>
                                <input type="text" class="form-control" name="nojob" id="nojob" value="{{isset($timesheet->activityId)?$timesheet->job_number:0}}" readonly="readonly">
                            </div>
                            <div class="form-group">
                                <label>Nama Client</label>
                                <input type="text" class="form-control" name="client" id="client" value="{{isset($timesheet->activityId)?$timesheet->nama:""}}" readonly="readonly">
                            </div>
                            <div class="form-group">
                                <label>No. Aktifitas</label>
                                <input type="text" class="form-control" value="{{isset($timesheet->activityId)?$timesheet->activityId:""}}" readonly="readonly">
                            </div>
                            <div class="form-group">
                                <label>Tanggal Aktifitas</label>
                                <input type="text" class="form-control" name="tglAktifitas" id="tglAktifitas" value="{{isset($timesheet->activityId)?$timesheet->tanggal:""}}" readonly="readonly">
                            </div>
                            <div class="form-group">
                                <label>Lokasi</label>
                                <input type="radio" class="minimal" id="isInClient" name="isInClient" value="0" <?php echo (isset($timesheet->activityId) && $timesheet->isInClient=="0") ? "checked" : "";?> required>&nbsp;Office&nbsp;
                                <input type="radio" class="minimal" id="isInClient" name="isInClient" value="1" <?php echo (isset($timesheet->activityId) && $timesheet->isInClient=="1") ? "checked" : "";?> required>&nbsp;Client&nbsp;
                            </div>
                            <div class="form-group">
                                <label>Tipe Aktifitas</label>
                                <select class="form-control select2" style="width: 100%;" name="tipeAktifitas" id="tipeAktifitas" required>
                                    <option>[Pilih Tipe Aktifitas]</option> 
                                    <?php
                                        foreach($activity_type_list as $activity_type){
                                            $selected = ($activity_type->id == $timesheet->activity_typeId) ? "selected" : "";
                                    ?>
                                    <option value="<?php echo $activity_type->id;?>" <?php echo $selected;?>>-- <?php echo $activity_type->aktifitas;?> --</option>
                                    <?php
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Aktifitas</label>
                                <textarea class="form-control" name="aktifitas" id="aktifitas">{{isset($timesheet->activityId)?$timesheet->aktifitas:""}}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Jumlah Jam</label>
                                <input type="text" class="form-control" name="jmlJam" id="jmlJam" value="{{isset($timesheet->activityId)?$timesheet->jml_jam:0}}">
                            </div>
                            <?php
                                $thnSlc = date("Y",strtotime($timesheet->tanggal));
                                $blnSlc = date("n",strtotime($timesheet->tanggal));
                                $hariSlc = date("j",strtotime($timesheet->tanggal));

                                $modelTgl = ($hariSlc >= 1 && $hariSlc <= 15) ? 1 : 2;
                            ?>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary" id="btnSubmit">Submit</button>&nbsp;                                
                                <button type="button" class="btn btn-primary" onclick="window.location.href='{{url("/")}}/transaksi/timesheets/timesheet/{{$thnSlc}}/{{$blnSlc}}/{{$modelTgl}}'">Back</button>                                
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
