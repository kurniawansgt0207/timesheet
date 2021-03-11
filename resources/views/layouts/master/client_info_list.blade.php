@extends('layouts.app')


@section('content')
<section class="content-header">
    <h1>
    LIST CLIENT INFO
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Master</li>
        <li>Client Info</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header"></div>
                <div style="margin-left:10px;"><button type="button" class="btn btn-primary" onclick="addData()">Tambah Data</button></div>                
                <div class="box-body">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Client Name</th>
                            <th>Address</th>                            
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Active</th>
                            <th>#</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($client_info as $client=>$p)
                            <tr>
                                <td>{{$client+1}}</td>
                                <td>{{$p->nama}}</td>
                                <td>{{$p->alamat}}</td>
                                <td>{{$p->telpon}}</td>
                                <td>{{$p->email}}</td>
                                <td><?php echo ($p->isActive==1) ? "Aktif" : "Tidak Aktif";?></td>
                                <td align="center">
                                <a href="{{url('/')}}/master/client/edit_data/{{ $p->id }}">
                                <img src="{{url('public/adminlte/dist/img/icon-edit.png')}}" width="18" height="18" title="Rubah Data">
                                </a> 
                                <a href="javascript:" onclick="deleteData('{{$p->id}}')">
                                  <img src="{{url('public/adminlte/dist/img/icon-delete.png')}}" width="19" height="19" title="Hapus Data">
                                </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    function addData(){
        window.location.href="{{url('/master/client/add_data')}}";
    }

    function deleteData(id){
      var tny = confirm("Yakin Akan Menghapus Data Ini ?"+id);
      if(tny == 1){
        window.location.href = "{{url('/')}}/api/master/client/delete/"+id;
      }
    }
</script>
@endsection
