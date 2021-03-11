<?php $__env->startSection('content'); ?>
<script src="<?php echo e(url('public/adminlte/bower_components/jquery/dist/jquery.min.js')); ?>"></script>
<script>
    $(document).ready(function () {
        $("#btnSubmit").click(function (event) {
            event.preventDefault();
            var form = $('#frmEmoloyee')[0];
            var data = new FormData(form);
            data.append("CustomField", "This is some extra data, testing");
            $("#btnSubmit").prop("disabled", true);
            $.ajax({
                type: "POST",
                enctype: 'multipart/form-data',
                url: "<?php echo e(url('/api/master/employee/store')); ?>",
                data: data,
                processData: false,
                contentType: false,
                cache: false,
                timeout: 600000,
                success: function (data) {
                    alert(data);
                    $("#btnSubmit").prop("disabled", false);
                    window.location = "<?php echo e(url('/master/employee')); ?>";
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
        MANAGE EMPLOYEE INFO
    </h1>
    <ol class="breadcrumb">
        <li><a href="/home"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Master</li>
        <li><a href="<?php echo e(url('/')); ?>/master/employee">Employee Info</a></li>
        <li class="active">Input Data</li>
    </ol>
</section>

<section class="content">
    <form id="frmEmoloyee" name="frmEmoloyee" method="post" action="<?php echo e(url('/api/master/employee/store')); ?>">
    <div class="row">
        <div class="col-md-6">
            <div class="box box-default">
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <?php $__currentLoopData = $employee_info; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>                            
                            <?php echo e(csrf_field()); ?>

                            <input type="hidden" name="id" value="<?php echo e(isset($employee->id)?$employee->id:''); ?>">
                            <input type="hidden" name="sessionVal" value="<?php echo e($_SESSION['login_status']); ?>">
                            <div class="form-group">
                                <label>NIK</label>
                                <input type="text" class="form-control" id="nik" name="nik" placeholder="NIK" required value="<?php echo e(isset($employee->id)?$employee->nik:''); ?>">
                            </div>      
                            <div class="form-group">
                                <label>Fullname</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Fullname" required value="<?php echo e(isset($employee->id)?$employee->nama:''); ?>">
                            </div>      
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" class="form-control" id="email" name="email" placeholder="Email" required value="<?php echo e(isset($employee->id)?$employee->email:''); ?>">
                            </div>      
                            <div class="form-group">
                                <label>Password</label>
                                <input type="text" class="form-control" id="password" name="password" placeholder="Password" required>
                            </div>  
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box box-default">
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Departemen</label>
                                <select class="form-control select2" style="width: 100%;" name="departemen" id="departemen" required>
                                    <option>[Pilih Departemen]</option> 
                                    <?php
                                        $selected = "";                                        
                                        foreach($departemen_list as $dept){
                                            if(isset($employee->id)){
                                                $selected = ($dept->id == $employee->departemenID) ? "selected" : "";                                            
                                            }
                                    ?>
                                    <option value="<?php echo e($dept->id); ?>" <?php echo e($selected); ?>>- <?php echo e($dept->departemen); ?> -</option>
                                    <?php
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Jabatan</label>
                                <select class="form-control select2" style="width: 100%;" name="jabatan" id="jabatan" required>
                                    <option>[Pilih Jabatan]</option>                                    
                                    <?php
                                        $selected = "";
                                        $jabatan_list = Session::get('jabatan_list');
                                        foreach($jabatan_list as $jabatan){
                                            if(isset($employee->id)){
                                                $selected = ($jabatan->id == $employee->jabatanID) ? "selected" : "";                                            
                                            }
                                    ?>
                                    <option value="<?php echo e($jabatan->id); ?>" <?php echo e($selected); ?>>- <?php echo e($jabatan->jabatan); ?> -</option>
                                    <?php
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Level</label>
                                <select class="form-control select2" style="width: 100%;" name="level" id="level" required>
                                    <option>[Pilih Level]</option>        
                                    <?php
                                        $selected = "";
                                        $level_list = Session::get('level_list');
                                        foreach($level_list as $level){
                                            if(isset($employee->id)){
                                                $selected = ($level->id == $employee->levelId) ? "selected" : "";                                            
                                            }
                                    ?>
                                    <option value="<?php echo e($level->id); ?>" <?php echo e($selected); ?>>- <?php echo e($level->levelname); ?> -</option>
                                    <?php
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Role</label>
                                <select class="form-control select2" style="width: 100%;" name="role" id="role" required>
                                    <option>[Pilih Role]</option>
                                    <?php
                                        $selected = "";
                                        $role_list = Session::get('role_list');
                                        foreach($role_list as $role){
                                            if(isset($employee->id)){
                                                $selected = ($role->id == $employee->roleId) ? "selected" : "";                                            
                                            }
                                    ?>
                                    <option value="<?php echo e($role->id); ?>" <?php echo e($selected); ?>>- <?php echo e($role->role); ?> -</option>
                                    <?php
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Status Aktif</label>
                                <input type="radio" class="minimal" id="active" name="active" value="1" <?php echo (isset($employee->id) && $employee->isActive=="1") ? "checked" : "";?> required>&nbsp;Ya&nbsp;
                                <input type="radio" class="minimal" id="active" name="active" value="0" <?php echo (isset($employee->id) && $employee->isActive=="0") ? "checked" : "";?> required>&nbsp;Tidak&nbsp;
                            </div>      
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary" id="btnSubmit">Submit</button>&nbsp;                                
                                <button type="button" class="btn btn-primary" onclick="window.location.href='<?php echo e(url("/master/employee")); ?>'">Back</button>                                
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\timesheet\resources\views//layouts/master/employee_info.blade.php ENDPATH**/ ?>