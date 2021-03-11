<?php $__env->startSection('content'); ?>
<section class="content-header">
    <h1>
    LIST ROLE INFO
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo e(url('/home')); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Master</li>
        <li class="active">Role Info</li>
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
                            <th>ROLE</th>
                            <th>#</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $role_info; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role=>$p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($role+1); ?></td>
                                <td><?php echo e($p->role); ?></td>
                                <td align="center">
                                <a href="<?php echo e(url('/')); ?>/master/role/edit_data/<?php echo e($p->id); ?>">
                                <img src="<?php echo e(url('public/adminlte/dist/img/icon-edit.png')); ?>" width="18" height="18" title="Rubah Data">
                                </a> 
                                <a href="javascript:" onclick="deleteData('<?php echo e($p->id); ?>')">
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
    function addData(){
        window.location.href="<?php echo e(url('/master/role/add_data')); ?>";
    }

    function deleteData(id){
      var tny = confirm("Yakin Akan Menghapus Data Ini ?"+id);
      if(tny == 1){
        window.location.href = "<?php echo e(url('/')); ?>/api/master/role/delete/"+id;
      }
    }
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\timesheet\resources\views//layouts/master/role_info_list.blade.php ENDPATH**/ ?>