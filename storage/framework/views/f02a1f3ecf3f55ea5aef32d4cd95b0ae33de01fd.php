<?php $__env->startSection('content'); ?>
<script src="<?php echo e(url('public/adminlte/bower_components/jquery/dist/jquery.min.js')); ?>"></script>
<script>
    $(document).ready(function () {
        $("#btnSubmit").click(function (event) {
            event.preventDefault();
            var form = $('#frmClient')[0];
            var data = new FormData(form);
            data.append("CustomField", "This is some extra data, testing");
            $("#btnSubmit").prop("disabled", true);
            $.ajax({
                type: "POST",
                enctype: 'multipart/form-data',
                url: "<?php echo e(url('/api/master/client/store')); ?>",
                data: data,
                processData: false,
                contentType: false,
                cache: false,
                timeout: 600000,
                success: function (data) {
                    alert(data);
                    $("#btnSubmit").prop("disabled", false);
                    window.location = "<?php echo e(url('/master/client')); ?>";
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
        MANAGE CLIENT INFO
    </h1>
    <ol class="breadcrumb">
        <li><a href="/home"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Master</li>
        <li class="active">Client Info</li>
        <li class="active">Input Data</li>
    </ol>
</section>

<section class="content">
    <form id="frmClient" name="frmClient" method="post" action="<?php echo e(url('/api/master/client/store')); ?>">
    <div class="row">
        <div class="col-md-6">
            <div class="box box-default">
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <?php $__currentLoopData = $client_info; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>                            
                            <?php echo e(csrf_field()); ?>

                            <input type="hidden" name="id" value="<?php echo e(isset($client->id)?$client->id:''); ?>">
                            <input type="hidden" name="sessionVal" value="<?php echo e($_SESSION['login_status']); ?>">
                            <div class="form-group">
                                <label>Nama Client</label>
                                <input type="text" class="form-control" id="nama_client" name="nama_client" placeholder="Nama Client" required value="<?php echo e(isset($client->id)?$client->nama:''); ?>">
                            </div>
                            <div class="form-group">
                                <label>Alamat</label>
                                <textarea class="form-control" id="alamat" name="alamat" placeholder="Alamat" rows="3" required><?php echo e(isset($client->id)?$client->alamat:''); ?></textarea>
                            </div>
                            <div class="form-group">
                                <label>Kota</label>
                                <select class="form-control select2" style="width: 100%;" name="kota" id="kota" required>
                                    <option>[Pilih Kota]</option>
                                    <?php
                                        $selected = "";
                                        $city_list = Session::get('city_list');
                                        foreach($city_list as $city){
                                            if(isset($client->id)){
                                                $selected = ($city->kabupatenkota == $client->kota) ? "selected" : "";                                            
                                            }
                                    ?>
                                    <option value="<?php echo e($city->kabupatenkota); ?>" <?php echo e($selected); ?>>- <?php echo e($city->kabupatenkota); ?> -</option>
                                    <?php
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Telepon</label>
                                <input type="text" class="form-control" id="telpon" name="telpon" placeholder="Telepon" required value="<?php echo e(isset($client->id)?$client->telpon:''); ?>">
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" class="form-control" id="email" name="email" placeholder="Email" required value="<?php echo e(isset($client->id)?$client->email:''); ?>">
                            </div>
                            <div class="form-group">
                                <label>NPWP</label>
                                <input type="text" class="form-control" id="npwp" name="npwp" placeholder="NPWP" required value="<?php echo e(isset($client->id)?$client->npwp:''); ?>">
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
                                <label>Website</label>
                                <input type="text" class="form-control" id="website" name="website" placeholder="Website" required value="<?php echo e(isset($client->id)?$client->website:''); ?>">
                            </div>
                            <div class="form-group">
                                <label>Kontak Person</label>
                                <input type="text" class="form-control" id="kontak" name="kontak" placeholder="Kontak Person" required value="<?php echo e(isset($client->id)?$client->contactperson:''); ?>">
                            </div>
                            <div class="form-group">
                                <label>Holding ?</label>
                                <input type="radio" class="minimal" id="holding" name="holding" value="1" <?php echo (isset($client->id) && $client->isHolding=="1") ? "checked" : "";?> required>&nbsp;Ya&nbsp;
                                <input type="radio" class="minimal" id="holding" name="holding" value="0" <?php echo (isset($client->id) && $client->isHolding=="0") ? "checked" : "";?> required>&nbsp;Tidak&nbsp;
                            </div>
                            <div class="form-group">
                                <label>Group</label>
                                <select class="form-control select2" name="group" id="group" required>                                    
                                    <option>[Pilih Group]</option>                                    
                                    <?php
                                        $selected = "";
                                        foreach($group_list as $group){                                                 
                                            if(isset($client->id)){
                                                $selected = ($group->id == $client->groupId) ? "selected" : "";                                            
                                            }
                                    ?>
                                    <option value="<?php echo e($group->id); ?>" <?php echo $selected;?>>- <?php echo e($group->groupname); ?> -</option>
                                    <?php                                        
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Area</label>
                                <select class="form-control select2" style="width: 100%;" name="area" id="area" required>
                                    <option>[Pilih Area]</option>
                                    <?php
                                        $selected = "";
                                        $area_list = Session::get('area_list');
                                        foreach($area_list as $area){
                                            if(isset($client->id)){
                                                $selected = ($area->id == $client->areaId) ? "selected" : "";                                            
                                            }
                                    ?>
                                    <option value="<?php echo e($area->id); ?>" <?php echo $selected;?>>- <?php echo e($area->area); ?> -</option>
                                    <?php
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Aktif ?</label>
                                <input type="radio" class="minimal" id="aktif" name="aktif" value="1" <?php echo (isset($client->id) && $client->isActive=="1") ? "checked" : "";?> required>&nbsp;Ya&nbsp;
                                <input type="radio" class="minimal" id="aktif" name="aktif" value="0" <?php echo (isset($client->id) && $client->isActive=="0") ? "checked" : "";?> required>&nbsp;Tidak&nbsp;
                            </div>
                            <div class="form-group">
                                <label>OPE</label>
                                <input type="text" class="form-control" id="ope" name="ope" placeholder="Nilai OPE" required value="<?php echo e(isset($client->id)?$client->ope:''); ?>">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary" id="btnSubmit">Submit</button>&nbsp;                                
                                <button type="button" class="btn btn-primary" onclick="window.location.href='<?php echo e(url("/master/client")); ?>'">Back</button>                                
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\timesheet\resources\views//layouts/master/client_info.blade.php ENDPATH**/ ?>