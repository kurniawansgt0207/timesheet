<?php $__env->startSection('content'); ?>
<script src="<?php echo e(url('public/adminlte/bower_components/jquery/dist/jquery.min.js')); ?>"></script>
<script>
    $(document).ready(function () {
        $("#btnSubmit").click(function (event) {
            event.preventDefault();
            var form = $('#frmSetDoc')[0];
            var data = new FormData(form);
            data.append("CustomField", "This is some extra data, testing");
            $("#btnSubmit").prop("disabled", true);
            $.ajax({
                type: "POST",
                enctype: 'multipart/form-data',
                url: "<?php echo e(url('/api/master/set_document/store')); ?>",
                data: data,
                processData: false,
                contentType: false,
                cache: false,
                timeout: 600000,
                success: function (data) {
                    alert(data);
                    $("#btnSubmit").prop("disabled", false);
                    window.location = "<?php echo e(url('/master/set_document')); ?>";
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
        MANAGE SETTING DOCUMENT INFO
    </h1>
    <ol class="breadcrumb">
        <li><a href="/home"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Master</li>
        <li><a href="<?php echo e(url('/')); ?>/master/set_document">Setting Document Info</a></li>
        <li class="active">Input Data</li>
    </ol>
</section>

<section class="content">
    <form id="frmSetDoc" name="frmSetDoc" method="post" action="<?php echo e(url('/api/master/set_document/store')); ?>">
    <div class="row">
        <div class="col-md-6">
            <div class="box box-default">
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <?php $__currentLoopData = $setting_document_info; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $set_document): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>                            
                            <?php echo e(csrf_field()); ?>                            
                            <input type="hidden" name="id" value="<?php echo e(isset($set_document->docid)?$set_document->docid:''); ?>">
                            <input type="hidden" name="sessionVal" value="<?php echo e($_SESSION['login_status']); ?>">
                            <div class="form-group">
                                <label>KETERANGAN</label>
                                <input type="text" class="form-control" id="keterangan" name="keterangan" placeholder="KETERANGAN" required value="<?php echo e(isset($set_document->docid)?$set_document->keterangan:''); ?>">
                            </div>      
                            <div class="form-group">
                                <label>Auto No</label>
                                <input type="text" class="form-control" id="autonodefault" name="autonodefault" placeholder="Auto Number" required value="<?php echo e(isset($set_document->docid)?$set_document->autonodefault:''); ?>">
                            </div>      
                            <div class="form-group">
                                <label>Allow Prefix</label>
                                <input type="radio" class="minimal" id="allowprefix" name="allowprefix" value="1" <?php echo (isset($set_document->docid) && $set_document->allowprefix=="1") ? "checked" : "";?> required>&nbsp;Ya&nbsp;
                                <input type="radio" class="minimal" id="allowprefix" name="allowprefix" value="0" <?php echo (isset($set_document->docid) && $set_document->allowprefix=="0") ? "checked" : "";?> required>&nbsp;Tidak&nbsp;
                            </div>      
                            <div class="form-group">
                                <label>Text Prefix</label>
                                <input type="text" class="form-control" id="textprefix" name="textprefix" placeholder="Text Prefix" required value="<?php echo e(isset($set_document->docid)?$set_document->textprefix:''); ?>">
                            </div>  
                            <div class="form-group">
                                <label>Allow YOP ?</label>
                                <input type="radio" class="minimal" id="allowyop" name="allowyop" value="1" <?php echo (isset($set_document->docid) && $set_document->allowyop=="1") ? "checked" : "";?> required>&nbsp;Ya&nbsp;
                                <input type="radio" class="minimal" id="allowyop" name="allowyop" value="0" <?php echo (isset($set_document->docid) && $set_document->allowyop=="0") ? "checked" : "";?> required>&nbsp;Tidak&nbsp;
                            </div>
                            <div class="form-group">
                                <label>Allow MOP ?</label>
                                <input type="radio" class="minimal" id="allowmop" name="allowmop" value="1" <?php echo (isset($set_document->docid) && $set_document->allowmop=="1") ? "checked" : "";?> required>&nbsp;Ya&nbsp;
                                <input type="radio" class="minimal" id="allowmop" name="allowmop" value="0" <?php echo (isset($set_document->docid) && $set_document->allowmop=="0") ? "checked" : "";?> required>&nbsp;Tidak&nbsp;
                            </div>
                            <div class="form-group">
                                <label>Document Length</label>
                                <input type="text" class="form-control" id="doclength" name="doclength" placeholder="Document Length" required value="<?php echo e(isset($set_document->docid)?$set_document->doclength:''); ?>">
                            </div>                              
                            <div class="form-group">
                                <label>Document Number Format</label>
                                <input type="text" class="form-control" id="docnumfmt" name="docnumfmt" placeholder="Document Number Format" required value="<?php echo e(isset($set_document->docid)?$set_document->docnumfmt:''); ?>">
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
                                <label>Document Number</label>
                                <input type="text" class="form-control" id="docnum" name="docnum" placeholder="Document Number" required value="<?php echo e(isset($set_document->docid)?$set_document->docnum:''); ?>">
                            </div>
                            <div class="form-group">
                                <label>Object Type</label>
                                <input type="text" class="form-control" id="objtype" name="objtype" placeholder="Object Type" required value="<?php echo e(isset($set_document->docid)?$set_document->objtype:''); ?>">
                            </div>
                            <div class="form-group">
                                <label>Text Prefix (Last)</label>
                                <input type="text" class="form-control" id="textprefix_last" name="textprefix_last" placeholder="Text Prefix (Last)" required value="<?php echo e(isset($set_document->docid)?$set_document->textprefix_last:''); ?>">
                            </div>
                            <div class="form-group">
                                <label>YOP (Last)</label>
                                <input type="text" class="form-control" id="yop_last" name="yop_last" placeholder="Year of Period (Last)" required value="<?php echo e(isset($set_document->docid)?$set_document->yop_last:''); ?>">
                            </div>
                            <div class="form-group">
                                <label>MOP (Last)</label>
                                <input type="text" class="form-control" id="mop_last" name="mop_last" placeholder="Month of Period (Last)" required value="<?php echo e(isset($set_document->docid)?$set_document->mop_last:''); ?>">
                            </div>      
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary" id="btnSubmit">Submit</button>&nbsp;                                
                                <button type="button" class="btn btn-primary" onclick="window.location.href='<?php echo e(url("/master/set_document")); ?>'">Back</button>                                
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\timesheet\resources\views//layouts/master/set_document_info.blade.php ENDPATH**/ ?>