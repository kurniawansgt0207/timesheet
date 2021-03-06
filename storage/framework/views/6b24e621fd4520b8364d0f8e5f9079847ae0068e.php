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
                url: "<?php echo e(url('/api/master/company/store')); ?>",
                data: data,
                processData: false,
                contentType: false,
                cache: false,
                timeout: 600000,
                success: function (data) {
                    var msg = data.split("~");
                    var pesan = msg[0];
                    var id = msg[1];
                    alert(pesan);
                    $("#btnSubmit").prop("disabled", false);
                    window.location = '<?php echo e(url("/")); ?>/master/company';
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
        MANAGE COMPANY
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo e(url('/home')); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Master</li>        
        <li class="active">Company Information</li>
    </ol>
</section>

<section class="content">
    <form id="frmGroup" name="frmGroup" method="post" action="<?php echo e(url('/api/master/company/store')); ?>">
    <?php $__currentLoopData = $data_company; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $company): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php echo e(csrf_field()); ?>

    <div class="row">
        <div class="col-md-6">
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">Company Information</h3>
                </div>                
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            
                            <input type="hidden" name="id" value="<?php echo e($company->id); ?>">
                            <input type="hidden" name="sessionVal" value="<?php echo e(isset($_SESSION['login_status'])?$_SESSION['login_status']:0); ?>">
                            <div class="form-group">
                                <label>Company Name</label>
                                <input type="text" class="form-control" id="company_name" name="company_name" placeholder="Company Name" required value="<?php echo e($company->company_name); ?>">
                            </div>
                            <div class="form-group">
                                <label>Company Address</label>
                                <textarea class="form-control" id="company_address" name="company_address" placeholder="Deksripsi" required><?php echo e($company->company_address); ?></textarea>
                            </div>
                            <div class="form-group">
                                <label>Company Phone</label>
                                <input type="text" class="form-control" id="company_phone" name="company_phone" placeholder="Nama Role Group" required value="<?php echo e($company->company_phone); ?>">
                            </div>
                            <div class="form-group">
                                <label>Company Email</label>
                                <input type="text" class="form-control" id="company_email" name="company_email" placeholder="Nama Role Group" required value="<?php echo e($company->company_email); ?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title"></h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Company NPWP</label>
                                <input type="text" class="form-control" id="company_npwp" name="company_npwp" placeholder="Nama Role Group" required value="<?php echo e($company->company_npwp); ?>">
                            </div>
                            <div class="form-group">
                                <label>Company Website</label>
                                <input type="text" class="form-control" id="company_website" name="company_website" placeholder="Nama Role Group" required value="<?php echo e($company->company_website); ?>">
                            </div>
                            <div class="form-group">
                                <label>Company Contact</label>
                                <input type="text" class="form-control" id="company_contact" name="company_contact" placeholder="Nama Role Group" required value="<?php echo e($company->company_contact); ?>">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary" id="btnSubmit">Submit</button>&nbsp;                                
                                <button type="button" class="btn btn-primary" onclick="window.location.href='<?php echo e(url("/home")); ?>'">Back</button>
                            </div>                                                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </form>
</section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\timesheet\resources\views//layouts/master/company_info.blade.php ENDPATH**/ ?>