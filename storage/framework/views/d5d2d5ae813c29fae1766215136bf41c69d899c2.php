<?php $__env->startSection('content'); ?>
<script src="<?php echo e(url('public/adminlte/bower_components/jquery/dist/jquery.min.js')); ?>"></script>
<script>
    $(document).ready(function () {
        $("#btnSubmit").click(function (event) {
            event.preventDefault();
            var form = $('#frmAreaCost')[0];
            var data = new FormData(form);
            data.append("CustomField", "This is some extra data, testing");
            $("#btnSubmit").prop("disabled", true);
            $.ajax({
                type: "POST",
                enctype: 'multipart/form-data',
                url: "<?php echo e(url('/api/master/areacost/store')); ?>",
                data: data,
                processData: false,
                contentType: false,
                cache: false,
                timeout: 600000,
                success: function (data) {
                    alert(data);
                    $("#btnSubmit").prop("disabled", false);
                    window.location = "<?php echo e(url('/master/areacost')); ?>";
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
        MANAGE AREA COST INFO
    </h1>
    <ol class="breadcrumb">
        <li><a href="/home"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Master</li>
        <li><a href="<?php echo e(url('/')); ?>/master/areacost">Area Cost Info</a></li>
        <li class="active">Input Data</li>
    </ol>
</section>

<section class="content">
    <form id="frmAreaCost" name="frmAreaCost" method="post" action="<?php echo e(url('/api/master/areacost/store')); ?>">
    <div class="row">
        <div class="col-md-6">
            <div class="box box-default">
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <?php $__currentLoopData = $area_cost_info; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $area_cost): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>                            
                            <?php echo e(csrf_field()); ?>

                            <input type="hidden" name="id" value="<?php echo e(isset($area_cost->id)?$area_cost->id:''); ?>">
                            <input type="hidden" name="sessionVal" value="<?php echo e($_SESSION['login_status']); ?>">
                            <div class="form-group">
                                <label>Area <?php echo e($area_cost->areaId); ?></label>
                                <select class="form-control select2" style="width: 100%;" name="area" id="area" required>
                                    <option>[Pilih Area]</option> 
                                    <?php
                                        $selected = "";                                        
                                        $area_list = Session::get('area_list');
                                        foreach($area_list as $area){
                                            if(isset($area_cost->id)){
                                                $selected = ($area->id == $area_cost->areaId) ? "selected" : "";
                                            }
                                    ?>
                                    <option value="<?php echo e($area->id); ?>" <?php echo e($selected); ?>>- <?php echo e($area->area); ?> -</option>
                                    <?php
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Cost</label>
                                <select class="form-control select2" style="width: 100%;" name="cost" id="cost" required>
                                    <option>[Pilih Cost]</option> 
                                    <?php
                                        $selected = "";                                        
                                        $cost_list = Session::get('cost_list');
                                        foreach($cost_list as $cost){
                                            if(isset($area_cost->id)){
                                                $selected = ($cost->id == $area_cost->costId) ? "selected" : "";
                                            }
                                    ?>
                                    <option value="<?php echo e($cost->id); ?>" <?php echo e($selected); ?>>- <?php echo e($cost->costname); ?> -</option>
                                    <?php
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Cost Amount</label>
                                <input type="text" class="form-control" id="costamt" name="costamt" placeholder="Cost Amount" required value="<?php echo e(isset($area_cost->id)?$area_cost->costAmt:''); ?>">
                            </div>      
                            <div class="form-group">
                                <label>Is Active</label>
                                <select class="form-control select2" style="width: 100%;" name="active" id="active" required>
                                    <option>[Pilih Status]</option>
                                    <option value="1" <?php echo (isset($area_cost->id) && $area_cost->isActive == 1) ? "selected" : "";?>>- Aktif -</option>
                                    <option value="0" <?php echo (isset($area_cost->id) && $area_cost->isActive == 0) ? "selected" : "";?>>- Tidak Aktif -</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary" id="btnSubmit">Submit</button>&nbsp;                                
                                <button type="button" class="btn btn-primary" onclick="window.location.href='<?php echo e(url("/master/areacost")); ?>'">Back</button>                                
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\timesheet\resources\views//layouts/master/area_cost_info.blade.php ENDPATH**/ ?>