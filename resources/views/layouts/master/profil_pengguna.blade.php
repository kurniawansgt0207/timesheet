@extends('layouts.app')

@section('content')
<script src="{{url('public/adminlte/bower_components/jquery/dist/jquery.min.js')}}"></script>
<script>
  $(document).ready(function () {
      $("#btnSubmit").click(function (event) {
          event.preventDefault();
          var form = $('#frmProfil')[0];
          var data = new FormData(form);
          data.append("CustomField", "This is some extra data, testing");
          $("#btnSubmit").prop("disabled", true);
          $.ajax({
              type: "POST",
              enctype: 'multipart/form-data',
              url: "{{url('/api/data_pekerja/update_profil')}}",
              data: data,
              processData: false,
              contentType: false,
              cache: false,
              timeout: 600000,
              success: function (data) {
                  alert(data);
                  $("#btnSubmit").prop("disabled", false);
                  window.location = '{{url("/logout")}}';
              },
              error: function (e) {
                  alert("Gagal Menyimpan Data, Silahkan Ulangi Proses.");
                  $("#btnSubmit").prop("disabled", false);
              }
          });
      });
  });

  function cekPasswordLama(){
      var noPekerja = document.getElementById('no_pekerja').value;
      var passLama = document.getElementById('passwordlama').value;

      $("#cekPass").load('/master/data_pekerja/cek_pass/'+noPekerja+'/'+passLama);
  }

  function cekPasswordBaru(){
      var passBaru1 = document.getElementById('passwordbaru').value;
      var passBaru2 = document.getElementById('passwordbaru2').value;
      if(passBaru1 != passBaru2){
          document.getElementById('cekPassBaru').innerHTML = "Password Baru Tidak Sama, Ulangi !!!";
      } else {
          document.getElementById('cekPassBaru').innerHTML = "Password Konfirmasi Sama, Lanjutkan !!!";
      }
  }
</script>
<section class="content-header">
    <h1>
        PROFIL PENGGUNA
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Profil Pengguna</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-6">
            <div class="box box-default">

                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            @foreach($data_profil as $profil)
                            <form id="frmProfil" name="frmProfil" method="post" enctype="multipart/form-data" action="{{url('/api/data_pekerja/update_profil')}}">
                            {{ csrf_field() }}
                            <input type="hidden" name="id" id="id" value="{{ isset($profil->id)?$profil->id:'' }}">
                            <input type="hidden" id="no_pekerja" name="no_pekerja" value="{{isset($profil->id)?$profil->no_pekerja:''}}">
                            <input type="hidden" name="sessionVal" value="{{Session::get('login')}}">
                            <div class="form-group">
                                <label>Nama Lengkap</label>
                                <input type="text" class="form-control" id="nama_pekerja" name="nama_pekerja" placeholder="Nama Pekerja" required value="{{isset($profil->id)?$profil->nama_pekerja:''}}">
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" class="form-control" id="email" name="email" placeholder="Email" required value="{{isset($profil->id)?$profil->email:''}}">
                            </div>
                            <div class="form-group">
                                <label>Tanggal Lahir</label>
                                <input type="text" class="form-control pull-right" name="datepicker" id="datepicker" value="{{isset($profil->id)?$profil->tgl_lahir:''}}">
                            </div>
                            <div class="form-group">
                                <label>Jenis Kelamin</label>
                                <select class="form-control select2" name="jenis_kelamin" id="jenis_kelamin">
                                    <option value="" selected>[Jenis Kelamin]</option>
                                    <option value="LK" {{ ($profil->jns_kelamin=="LK")?"selected":"" }}>Laki-laki</option>
                                    <option value="PR" {{ ($profil->jns_kelamin=="PR")?"selected":"" }}>Perempuan</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Foto Profil</label>
                                <input type="file" name="fotoprofil" id="fotoprofil" accept="image/*" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Password Lama</label>
                                <input type="password" name="passwordlama" id="passwordlama" class="form-control" autocomplete="new-password" onchange="cekPasswordLama()">
                                <input type="hidden" name="passLama" id="passLama" value="{{$profil->password}}">
                                <div id="cekPass"></div>
                            </div>
                            <div class="form-group">
                                <label>Password Baru</label>
                                <input type="password" name="passwordbaru" id="passwordbaru" class="form-control" autocomplete="new-password">
                            </div>
                            <div class="form-group">
                                <label>Konfirmasi Password Baru</label>
                                <input type="password" name="passwordbaru2" id="passwordbaru2" class="form-control" autocomplete="new-password" onchange="cekPasswordBaru()">
                                <div id="cekPassBaru"></div>
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="pic_profil" id="pic_profil" value="{{$profil->img_profile}}">
                                <button type="submit" class="btn btn-primary" id="btnSubmit">Submit</button>
                            </div>
                            </form>
                            @endforeach
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
                        @foreach($data_profil as $profil)
                        <center>
                            <img src="{{url('/')}}/public/adminlte/dist/img/profile/{{$profil->img_profile}}" width="150" height="150" class="user-image" alt="User Image">
                        </center>
                        @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
