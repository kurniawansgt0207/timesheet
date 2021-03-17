<?php $__env->startSection('content'); ?>
<section class="content-header">
    <h1>
    JOBS INFO
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo e(url('/home')); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Transaksi</li>
        <li class="active">Jobs Info</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header"></div>
                <div style="margin-left:10px;"><button type="button" class="btn btn-primary" onclick="addData()">Tambah Data</button></div>                                
                <div class="box-body">                    
                    <div class="row">
                        <div class="col-sm-2">
                            <label>Status Dokumen </label>                                                    
                            <select name="statusDoc" id="statusDoc" class="form-control" onchange="showData()">
                                <option value="0" <?php echo e($status_doc == "0" ? "selected" : ""); ?>>Draft</option>
                                <option value="1" <?php echo e($status_doc == "1" ? "selected" : ""); ?>>Complete</option>
                            </select>
                        </div>
                    </div>
                    <div class="box-header"></div>
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Job No</th>
                            <th>Nama Client</th>
                            <th>Kota</th>
                            <th>Area</th>
                            <th>Tgl Mulai</th>
                            <th>Tgl Selesai</th>
                            <th>Status</th>
                            <th>#</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $job_info; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job=>$p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($job+1); ?></td>
                                <td><?php echo e($p->job_number); ?></td>
                                <td><?php echo e($p->nama); ?></td>
                                <td><?php echo e($p->kota); ?></td>
                                <td><?php echo e($p->area); ?></td>
                                <td><?php echo e(date("d/m/Y",strtotime($p->tanggal_mulai))); ?></td>
                                <td><?php echo e(isset($p->tanggal_selesai) ? date("d/m/Y",strtotime($p->tanggal_selesai)) : "-"); ?></td>
                                <td><?php echo e($p->dokStatus); ?></td>
                                <td align="center">
                                <a href="<?php echo e(url('/')); ?>/transaksi/jobs/edit_data/<?php echo e($p->id); ?>/1">
                                    <img src="<?php echo e(url('public/adminlte/dist/img/icon-edit.png')); ?>" width="18" height="18" title="Rubah Data">
                                </a>&nbsp;
                                <a href="<?php echo e(url('/')); ?>/transaksi/jobs/edit_data/<?php echo e($p->id); ?>/0">
                                    <img src="<?php echo e(url('public/adminlte/dist/img/iconfinder.png')); ?>" width="18" height="18" title="Lihat Data">
                                </a>&nbsp; 
                                <a href="javascript:" onclick="deleteData('<?php echo e($p->id); ?>','<?php echo e($_SESSION['id']); ?>')">
                                    <img src="<?php echo e(url('public/adminlte/dist/img/icon-delete.png')); ?>" width="19" height="19" title="Hapus Data">
                                </a>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    function showData(){
        var param1 = document.getElementById('statusDoc').value;        
        window.location.href="<?php echo e(url('/')); ?>/transaksi/jobs/job/"+param1+"/0/0";
    }
    
    function addData(){
        window.location.href="<?php echo e(url('/transaksi/jobs/add_data')); ?>";
    }

    function deleteData(id, userid){
      var tny = confirm("Yakin Akan Menghapus Data Ini ?"+id);
      if(tny == 1){
        window.location.href = "<?php echo e(url('/')); ?>/api/transaksi/jobs/job/delete/"+id+"/"+userid;
      }
    }
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\timesheet\resources\views//layouts/transaksi/jobs/jobs_list.blade.php ENDPATH**/ ?>