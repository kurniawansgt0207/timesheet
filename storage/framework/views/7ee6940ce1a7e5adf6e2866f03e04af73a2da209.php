<?php $__env->startSection('content'); ?>
<script src="<?php echo e(url('public/adminlte/bower_components/jquery/dist/jquery.min.js')); ?>"></script>
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
                url: "<?php echo e(url('/api/master/group/store')); ?>",
                data: data,
                processData: false,
                contentType: false,
                cache: false,
                timeout: 600000,
                success: function (data) {
                    alert(data);
                    $("#btnSubmit").prop("disabled", false);
                    window.location = "<?php echo e(url('/master/group')); ?>";
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
        MANAGE GROUP INFO
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo e(url('/')); ?>/home"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Master</li>
        <li><a href="<?php echo e(url('/')); ?>/master/group">Group Info</a></li>
        <li class="active">Input Data</li>
    </ol>
</section>

<section class="content">
    <form id="frmGroup" name="frmGroup" method="post" action="<?php echo e(url('/api/master/group/store')); ?>">
    <div class="row">
        <div class="col-md-6">
            <div class="box box-default">
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <?php $__currentLoopData = $group_info; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>                            
                            <?php echo e(csrf_field()); ?>

                            <input type="hidden" name="id" value="<?php echo e(isset($group->id)?$group->id:''); ?>">
                            <input type="hidden" name="sessionVal" value="<?php echo e($_SESSION['login_status']); ?>">
                            <div class="form-group">
                                <label>Group Code</label>
                                <input type="text" class="form-control" id="groupcode" name="groupcode" placeholder="Group Code" required value="<?php echo e(isset($group->id)?$group->groupcode:''); ?>">
                            </div>
                            <div class="form-group">
                                <label>Group Name</label>
                                <input type="text" class="form-control" id="groupname" name="groupname" placeholder="Alamat" rows="3" required value="<?php echo e(isset($group->id)?$group->groupname:''); ?>">
                            </div>
                            <div class="form-group">
                                <label>Kota</label>
                                <input type="text" class="form-control" id="jmlkota" name="jmlkota" placeholder="Jumlah Kota" required value="<?php echo e(isset($group->id)?$group->jmlkota:''); ?>">
                            </div>                        
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary" id="btnSubmit">Submit</button>&nbsp;                                
                                <button type="button" class="btn btn-primary" onclick="window.location.href='<?php echo e(url("/master/group")); ?>'">Back</button>                                
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </form>
</section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\timesheet\resources\views//layouts/master/group_info.blade.php ENDPATH**/ ?>