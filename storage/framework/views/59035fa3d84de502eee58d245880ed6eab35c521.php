<?php $__env->startSection('content'); ?>
<section class="content-header">
    <h1>
    LIST SET DOCUMENT INFO
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo e(url('/home')); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
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
                        <?php $__currentLoopData = $setting_document_info; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $set_doc=>$p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($set_doc+1); ?></td>
                                <td><?php echo e($p->keterangan); ?></td>
                                <td><?php echo e($p->autonodefault); ?></td>
                                <td><?php echo e(($p->allowprefix==1) ? "Aktif" : "Tidak Aktif"); ?></td>
                                <td><?php echo e($p->textprefix); ?></td>
                                <td><?php echo e(($p->allowyop==1) ? "Aktif" : "Tidak Aktif"); ?></td>
                                <td><?php echo e(($p->allowmop==1) ? "Aktif" : "Tidak Aktif"); ?></td>
                                <td><?php echo e($p->doclength); ?></td>
                                <td><?php echo e($p->docnumfmt); ?></td>
                                <td align="center">
                                <a href="<?php echo e(url('/')); ?>/master/set_document/edit_data/<?php echo e($p->docid); ?>">
                                <img src="<?php echo e(url('public/adminlte/dist/img/icon-edit.png')); ?>" width="18" height="18" title="Rubah Data">
                                </a> 
                                <a href="javascript:" onclick="deleteData('<?php echo e($p->docid); ?>')">
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
        window.location.href="<?php echo e(url('/master/set_document/add_data')); ?>";
    }

    function deleteData(id){
      var tny = confirm("Yakin Akan Menghapus Data Ini ?"+id);
      if(tny == 1){
        window.location.href = "<?php echo e(url('/')); ?>/api/master/set_document/delete/"+id;
      }
    }
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\timesheet\resources\views//layouts/master/set_document_info_list.blade.php ENDPATH**/ ?>