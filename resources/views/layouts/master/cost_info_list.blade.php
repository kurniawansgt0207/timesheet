@extends('layouts.app')


@section('content')
<section class="content-header">
    <h1>
    LIST COST INFO
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Master</li>
        <li class="active">Cost Info</li>
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
                            <th>Cost Name</th>
                            <th>Visual Order</th>
                            <th>#</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($cost_info as $cost=>$p)
                            <tr>
                                <td>{{$cost+1}}</td>
                                <td>{{$p->costname}}</td>
                                <td>{{$p->visOrder}}</td>
                                <td align="center">
                                <a href="{{url('/')}}/master/cost/edit_data/{{ $p->id }}">
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
        window.location.href="{{url('/master/cost/add_data')}}";
    }

    function deleteData(id){
      var tny = confirm("Yakin Akan Menghapus Data Ini ?"+id);
      if(tny == 1){
        window.location.href = "{{url('/')}}/api/master/cost/delete/"+id;
      }
    }
</script>
@endsection
