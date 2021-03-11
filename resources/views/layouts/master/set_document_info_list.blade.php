@extends('layouts.app')


@section('content')
<section class="content-header">
    <h1>
    LIST SET DOCUMENT INFO
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Master</li>
        <li class="active">Set Document Info</li>
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
                            <th>Keterangan</th>
                            <th>Auto No</th>
                            <th>Allow Prefix</th>
                            <th>Text Prefix</th>
                            <th>Allow YOP</th>
                            <th>Allow MOP</th>
                            <th>Doc Length</th>
                            <th>Doc No Format</th>
                            <th>#</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($setting_document_info as $set_doc=>$p)
                            <tr>
                                <td>{{$set_doc+1}}</td>
                                <td>{{$p->keterangan}}</td>
                                <td>{{$p->autonodefault}}</td>
                                <td>{{ ($p->allowprefix==1) ? "Aktif" : "Tidak Aktif" }}</td>
                                <td>{{ $p->textprefix }}</td>
                                <td>{{ ($p->allowyop==1) ? "Aktif" : "Tidak Aktif" }}</td>
                                <td>{{ ($p->allowmop==1) ? "Aktif" : "Tidak Aktif" }}</td>
                                <td>{{$p->doclength}}</td>
                                <td>{{$p->docnumfmt}}</td>
                                <td align="center">
                                <a href="{{url('/')}}/master/set_document/edit_data/{{ $p->docid }}">
                                <img src="{{url('public/adminlte/dist/img/icon-edit.png')}}" width="18" height="18" title="Rubah Data">
                                </a> 
                                <a href="javascript:" onclick="deleteData('{{$p->docid}}')">
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
        window.location.href="{{url('/master/set_document/add_data')}}";
    }

    function deleteData(id){
      var tny = confirm("Yakin Akan Menghapus Data Ini ?"+id);
      if(tny == 1){
        window.location.href = "{{url('/')}}/api/master/set_document/delete/"+id;
      }
    }
</script>
@endsection
