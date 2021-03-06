<?php $__env->startSection('content'); ?>

<section class="content-header">
    <h1>Dashboard</h1>
</section>

<section class="content">
    <?php
        if(Session::get('role_name')!="'Employee'")
        {
    ?>
    <div class="row">
        <div id="graph_1"><?php echo $__env->make('layouts.graph_dashboard.graph_1', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?></div>
        <div id="graph_2"><?php echo $__env->make('layouts.graph_dashboard.graph_2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?></div>
    </div>
    <div class="row">
        <div id="graph_3"><?php echo $__env->make('layouts.graph_dashboard.graph_3', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?></div>
        <div class="col-md-6">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">Grafik per Category per Status (Not Completed),<br><?php echo date("F")." ".date("Y");?></h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <?php
                        if(Session::get('report_4')>0)
                        {
                            foreach(Session::get('report_4') as $key=>$rpt2)
                            {
                                $jmlAll = $rpt2->jmlall;
                                $jmlOpen = $rpt2->jmlopen;
                                $jmlNotCompleted = $rpt2->jmlnotcompleted;
                                $jmlLain = $jmlAll-$jmlOpen;
                                $achieve = ($jmlOpen > 0) ? ($rpt2->jmlnotcompleted*1)/($rpt2->jmlopen*1) : 0;
                                $persentase = number_format($achieve,2)*100;
                                
                                //if($rpt2->jmlnotcompleted > 0 || $rpt2->jmlopen > 0){
                    ?>
                    <div class="progress-group">
                        <span class="progress-text"><?php echo e($rpt2->kategori_layanan); ?> (<?php echo e($persentase."%"); ?>)</span>
                        <span class="progress-number"><b><?php echo e($rpt2->jmlnotcompleted); ?></b>/<?php echo e($rpt2->jmlopen); ?></span>
                        <div class="progress sm">
                            <div class="progress-bar <?php echo e($rpt2->color_style); ?>" style="width: <?php echo $persentase.'%';?>"></div>
                        </div>
                    </div>
                    <?php
                                //}
                            }
                        } else {
                            echo "Data Not Available";
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <?php
        }
    ?>
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Monitoring Status per Ticket per User (Not Completed)</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <?php
                    if(Session::get('report_5')>0){
                ?>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table no-margin">
                            <thead>
                                <tr>
                                    <th>No. Request</th>
                                    <th>Requestor</th>
                                    <th>Tanggal Request</th>
                                    <th>Status</th>
                                    <th>Kategori</th>
                                    <th>Permintaan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    foreach (Session::get('report_5') as $rpt3)
                                    {
                                        if($rpt3->status_doc == "Request"){
                                            if($rpt3->status_request=="Draft"){
                                                $statusDoc = "SAVED";
                                            } else {
                                                $statusDoc = "SUBMITTED";
                                            }
                                        } else {
                                            $statusDoc = strtoupper($rpt3->status_doc);
                                        } 
                                ?>
                                <tr>
                                    <td><a href="<?php echo e(url('/')); ?>/ticketing/all_activity/<?php echo e($rpt3->id); ?>"><?php echo e($rpt3->nomor_request); ?></a></td>
                                    <td><?php echo e($rpt3->nama_requestor); ?></td>
                                    <td><?php echo e($rpt3->tgl_request); ?></td>
                                    <td><span class="label <?php echo $rpt3->color_style;?>"><?php echo e($statusDoc); ?></span></td>
                                    <td><?php echo e($rpt3->kategori_layanan_desc); ?>

                                    <td>
                                    <div class="sparkbar" data-color="#00a65a" data-height="20"><?php echo e($rpt3->permintaan); ?></div>
                                    </td>
                                </tr>
                                <?php
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="box-footer clearfix">
                    <a href="<?php echo e(url('/ticketing/all_activity')); ?>" class="btn btn-sm btn-default btn-flat pull-right">View All Ticket</a>
                </div>
                <?php
                    } else {
                        echo "Data Not Available";
                    }

                    $btn = (Session::get('report_5')>0) ? "" : "disabled";
                ?>
            </div>
        </div>
    </div>
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\sdhc\resources\views//layouts/dashboard.blade.php ENDPATH**/ ?>