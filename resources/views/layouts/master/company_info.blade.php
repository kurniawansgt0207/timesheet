@extends('layouts.app')

@section('content')
<script src="{{url('public/adminlte/bower_components/jquery/dist/jquery.min.js')}}"></script>
<script>
    $(document).ready(function () {
        $("#btnSubmit").click(function (event) {
            event.preventDefault();
            var form = $('#frmCompany')[0];
            var data = new FormData(form);
            data.append("CustomField", "This is some extra data, testing");
            $("#btnSubmit").prop("disabled", true);
            $.ajax({
                type: "POST",
                enctype: 'multipart/form-data',
                url: "{{url('/api/master/company/store')}}",
                data: data,
                processData: false,
                contentType: false,
                cache: false,
                timeout: 600000,
                success: function (data) {
                    var msg = data.split("~");
                    var pesan = msg[0];
                    var id = msg[1];
                    alert(pesan);
                    $("#btnSubmit").prop("disabled", false);
                    window.location = '{{url("/")}}/master/company';
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
        MANAGE COMPANY
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Master</li>        
        <li class="active">Company Information</li>
    </ol>
</section>

<section class="content">
    <form id="frmCompany" name="frmCompany" method="post" action="{{url('/api/master/company/store')}}">
    @foreach($data_company as $company)
    {{ csrf_field() }}
    <div class="row">
        <div class="col-md-6">
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">Company Information</h3>
                </div>                
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            
                            <input type="hidden" name="id" value="{{ $company->id }}">
                            <input type="hidden" name="sessionVal" value="{{ isset($_SESSION['login_status'])?$_SESSION['login_status']:0 }}">
                            <div class="form-group">
                                <label>Company Name</label>
                                <input type="text" class="form-control" id="company_name" name="company_name" placeholder="Company Name" required value="{{ $company->company_name }}">
                            </div>
                            <div class="form-group">
                                <label>Company Address</label>
                                <textarea class="form-control" id="company_address" name="company_address" placeholder="Deksripsi" required>{{ $company->company_address }}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Company Phone</label>
                                <input type="text" class="form-control" id="company_phone" name="company_phone" placeholder="Nama Role Group" required value="{{ $company->company_phone }}">
                            </div>
                            <div class="form-group">
                                <label>Company Email</label>
                                <input type="text" class="form-control" id="company_email" name="company_email" placeholder="Nama Role Group" required value="{{ $company->company_email }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title"></h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Company NPWP</label>
                                <input type="text" class="form-control" id="company_npwp" name="company_npwp" placeholder="Nama Role Group" required value="{{ $company->company_npwp }}">
                            </div>
                            <div class="form-group">
                                <label>Company Website</label>
                                <input type="text" class="form-control" id="company_website" name="company_website" placeholder="Nama Role Group" required value="{{ $company->company_website }}">
                            </div>
                            <div class="form-group">
                                <label>Company Contact</label>
                                <input type="text" class="form-control" id="company_contact" name="company_contact" placeholder="Nama Role Group" required value="{{ $company->company_contact }}">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary" id="btnSubmit">Submit</button>&nbsp;                                
                                <button type="button" class="btn btn-primary" onclick="window.location.href='{{url("/home")}}'">Back</button>
                            </div>                                                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    </form>
</section>

@endsection
