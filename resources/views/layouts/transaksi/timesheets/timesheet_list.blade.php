@extends('layouts.app')


@section('content')
<style>
    .disabled {
        pointer-events: none;
        cursor: default;
    }
</style>
<section class="content-header">
    <h1>
    TIMESHEET INFO
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Transaksi</li>
        <li class="active">Timesheet Info</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">                                
                <div class="box-body">                    
                    <div class="row">
                        <div class="col-sm-2">
                            <label>Tahun </label>                                                    
                            <select name="tahun" id="tahun" class="form-control">
                                <?php
                                    $nowYear = date("Y");
                                    $minYear = $nowYear-1;
                                    $maxYear = $nowYear+1;
                                    for($thn=$minYear;$thn<=$maxYear;$thn++){
                                        $selected = ($thn==$tahun) ? "selected" : "";
                                ?>
                                <option value="<?php echo $thn;?>" <?php echo $selected;?>><?php echo $thn;?></option>
                                <?php
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="col-sm-2">
                            <label>Bulan</label>
                            <select name="bulan" id="bulan" class="form-control">
                                <?php
                                    $monthArr = array(
                                        1=>"Januari",2=>"Februari",3=>"Maret",4=>"April",5=>"Mei",6=>"Juni",7=>"Juli",
                                        8=>"Agustus",9=>"September",10=>"Oktober",11=>"Nopember",12=>"Desember"
                                    );
                                    for($bln=1;$bln<=12;$bln++){                                        
                                        $blnNo = strlen($bln)<2 ? "0".$bln : $bln;
                                        $selected = ($bulan==$bln)?"selected":"";
                                ?>
                                <option value="<?php echo $bln;?>" <?php echo $selected;?>><?php echo $blnNo." - ".$monthArr[$bln];?></option>
                                <?php
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="col-sm-2">
                            <label>Model</label>
                            <select name="model" id="model" class="form-control">
                                <option value="1" <?php echo ($model==1) ? "selected":"";?>>1 s/d 15</option>
                                <option value="2" <?php echo ($model==2) ? "selected":"";?>>16 s/d 31</option>
                            </select>
                        </div>
                        <div class="col-sm-2">
                            <label><br></label>
                            <button type="button" class="btn btn-danger" style="margin-top: 24px;" onclick="showData()">Lihat Data</button>
                        </div>
                    </div>
                    <div class="box-header"></div>
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Job No</th>
                            <th>Nama Client</th>
                            <th>Alamat</th>
                            <?php
                                $startDate = ($model==1) ? 1 : 16;
                                $endDate = ($model==1) ? 15 : 31;
                                
                                for($colDate=$startDate;$colDate<=$endDate;$colDate++){
                                    $colDateNo = strlen($colDate)<2 ? "0".$colDate : $colDate;
                            ?>
                            <th><?php echo $colDateNo;?></th>
                            <?php
                                }
                            ?>
                            <th>01 s/d 15</th>
                            <th>01 s/d 31</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                            $no = 1;
                            $bln2 = (strlen($bulan)<2) ? "0".$bulan : $bulan;                            
                            foreach($timesheet_info as $data){
                        ?>
                            <tr>
                                <td><?php echo $no;?></td>
                                <td><?php echo $data->job_number;?></td>
                                <td><?php echo $data->namaClient;?></td>
                                <td><?php echo $data->alamat;?></td>
                                <?php
                                    $startCol = ($model==1) ? 1 : 16;
                                    $endCol = ($model==1) ? 15 : 31;
                                    $totalColModel = ($model==1) ? "ttljam01_15" : "ttljamt16_31";
                                    for($col=$startCol;$col<=$endCol;$col++){
                                        $colNo = (strlen($col)<2) ? "0".$col : $col;
                                        $colTgl = "tgl".$colNo;
                                        $colJmlJam = "jmljam".$colNo;
                                        $colIsOpen = "isOpen".$colNo;
                                        $tglCol = $tahun."-".$bln2."-".$colNo;
                                ?>
                                <td>
                                    <a href="#<?php echo $data->ticketId;?>" onclick="showForm('<?php echo $data->ticketId;?>','<?php echo $tglCol;?>')"><?php echo $data->$colJmlJam;?></a>
                                </td>
                                <?php                            
                                    }
                                ?>
                                <td align="center"><?php echo $data->$totalColModel;?></td>
                                <td align="center"><?php echo $data->ttljam01_31;?></td>
                            </tr>
                        <?php
                                $no++;
                            }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>    
</section>
    
<script>
    function showData(){
        var param1 = document.getElementById('tahun').value;        
        var param2 = document.getElementById('bulan').value;        
        var param3 = document.getElementById('model').value;        
        window.location.href="{{url('/')}}/transaksi/timesheets/timesheet/"+param1+"/"+param2+"/"+param3;
    }
    
    function showForm(ticketid,tglcol){
        window.location.href="{{url('/')}}/transaksi/timesheets/add_data/"+ticketid+"/"+tglcol;
    }

    function deleteData(id, userid){
      var tny = confirm("Yakin Akan Menghapus Data Ini ?"+id);
      if(tny == 1){
        window.location.href = "{{url('/')}}/api/transaksi/tickets/ticket/delete/"+id+"/"+userid;
      }
    }    
</script>
@endsection
