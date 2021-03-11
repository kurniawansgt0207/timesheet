<?php $__env->startSection('content'); ?>
<script src="<?php echo e(url('public/adminlte/bower_components/jquery/dist/jquery.min.js')); ?>"></script>
<script>
    $(document).ready(function () {
        $("#btnSubmit").click(function (event) {
            event.preventDefault();
            var form = $('#frmUser')[0];
            var data = new FormData(form);
            data.append("CustomField", "This is some extra data, testing");
            $("#btnSubmit").prop("disabled", true);
            $.ajax({
                type: "POST",
                enctype: 'multipart/form-data',
                url: "<?php echo e(url('/api/master/user/store')); ?>",
                data: data,
                processData: false,
                contentType: false,
                cache: false,
                timeout: 600000,
                success: function (data) {
                    alert(data);
                    $("#btnSubmit").prop("disabled", false);
                    window.location = "<?php echo e(url('/master/user')); ?>";
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
        MANAGE USER INFO
    </h1>
    <ol class="breadcrumb">
        <li><a href="/home"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Master</li>
        <li><a href="<?php echo e(url('/')); ?>/master/user">User Info</a></li>
        <li class="active">Input Data</li>
    </ol>
</section>

<section class="content">
    <form id="frmUser" name="frmUser" method="post" action="<?php echo e(url('/api/master/user/store')); ?>">
    <div class="row">
        <div class="col-md-6">
            <div class="box box-default">
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <?php $__currentLoopData = $user_info; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>                            
                            <?php echo e(csrf_field()); ?>

                            <input type="hidden" name="id" value="<?php echo e(isset($user->id)?$user->id:''); ?>">
                            <input type="hidden" name="sessionVal" value="<?php echo e($_SESSION['login_status']); ?>">
                            <div class="form-group">
                                <label>Fullname</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Fullname" required value="<?php echo e(isset($user->id)?$user->name:''); ?>">
                            </div>      
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" class="form-control" id="email" name="email" placeholder="Email" required value="<?php echo e(isset($user->id)?$user->email:''); ?>">
                            </div>      
                            <div class="form-group">
                                <label>Password</label>
                                <input type="text" class="form-control" id="password" name="password" placeholder="Password" required value="<?php echo e(isset($user->id)?$user->password_ori:''); ?>">
                            </div>      
                            <div class="form-group">
                                <label>Status Aktif</label>
                                <input type="radio" class="minimal" id="stat_active" name="stat_active" value="1" <?php echo (isset($user->id) && $user->stat_active=="1") ? "checked" : "";?> required>&nbsp;Ya&nbsp;
                                <input type="radio" class="minimal" id="stat_active" name="stat_active" value="0" <?php echo (isset($user->id) && $user->stat_active=="0") ? "checked" : "";?> required>&nbsp;Tidak&nbsp;
                            </div>      
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary" id="btnSubmit">Submit</button>&nbsp;                                
                                <button type="button" class="btn btn-primary" onclick="window.location.href='<?php echo e(url("/master/user")); ?>'">Back</button>                                
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\timesheet\resources\views//layouts/master/user_info.blade.php ENDPATH**/ ?>