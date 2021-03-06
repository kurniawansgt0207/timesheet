<?php
    $support="";
    $value2="";
    $tgl2="";
    $bln = date("m")-1;
    $thn = date("Y")-1;
    $blnName = "December";
    $param_2 = Session::get('param_2');
    if((Session::get('report_2'))>0){
        foreach(Session::get('report_2') as $rpt2){
            $support .= "'".$rpt2->support_desc."',";
            $value2 .= $rpt2->jml.",";
            $bln = $rpt2->bulan;
            $thn = $rpt2->tahun;
            $tgl2 = $thn."-".$bln."-01";
            $blnName = date("F",strtotime($tgl2));
        }
    } else {
        $support="";
        $value2="";
        $tgl2="";
        $bln = date("m")-1;
        $thn = date("Y")-1;
        $blnName = "December";
    }
?>
<div class="col-md-6">
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">Fungsi Per Bulan, <?php echo e(($tgl2!="")? $blnName." ".$thn:"(Data Not Found)"); ?></h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
            <div style="margin-top:8px; margin-left:150px">
                Status
                <select name="status_2" id="status_2">
                <option value="-">Semua Status</option>
                <option value="open" <?php echo ($param_2=="open")?"selected":"";?>>Open</option>
                <option value="inprogress" <?php echo ($param_2=="inprogress")?"selected":"";?>>In Progress</option>
                <option value="closed" <?php echo ($param_2=="closed")?"selected":"";?>>Closed</option>
                </select>
                <input type="button" value="Lihat" onclick="getGraph_2()">
            </div>
        </div>
        <div class="box-body">
            <div class="chart">
                <canvas id="barChart2" style="height:230px"></canvas>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo e(url('public/adminlte/bower_components/jquery/dist/jquery.min.js')); ?>"></script>
<script src="<?php echo e(url('public/adminlte/bower_components/jquery-ui/jquery-ui.min.js')); ?>"></script>

<script>
    $(function () {

    /* ChartJS
        * -------
        * Here we will create a few charts using ChartJS
        */

    //-------------
    //- BAR CHART -
    //-------------
    var barChartOptions = {
        //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
        scaleBeginAtZero        : true,
        //Boolean - Whether grid lines are shown across the chart
        scaleShowGridLines      : true,
        //String - Colour of the grid lines
        scaleGridLineColor      : 'rgba(0,0,0,.05)',
        //Number - Width of the grid lines
        scaleGridLineWidth      : 1,
        //Boolean - Whether to show horizontal lines (except X axis)
        scaleShowHorizontalLines: true,
        //Boolean - Whether to show vertical lines (except Y axis)
        scaleShowVerticalLines  : false,
        //Boolean - If there is a stroke on each bar
        barShowStroke           : true,
        //Number - Pixel width of the bar stroke
        barStrokeWidth          : 2,
        //Number - Spacing between each of the X value sets
        barValueSpacing         : 5,
        //Number - Spacing between data sets within X values
        barDatasetSpacing       : 1,
        //String - A legend template
        legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
        //Boolean - whether to make the chart responsive
        responsive              : true,
        maintainAspectRatio     : true
    }

    var barChartCanvas2                   = $('#barChart2').get(0).getContext('2d')
    var barChart2                         = new Chart(barChartCanvas2)
    var barChartData2                     = {
        labels  : [<?php echo $support;?>],
        datasets: [
        {
            label               : 'Hardware',
            fillColor           : 'rgba(210, 214, 222, 1)',
            strokeColor         : 'rgba(210, 214, 222, 1)',
            pointColor          : 'rgba(210, 214, 222, 1)',
            pointStrokeColor    : '#c1c7d1',
            pointHighlightFill  : '#fff',
            pointHighlightStroke: 'rgba(220,220,220,1)',
            data                : [<?php echo $value2;?>]
        }
        ]
    }
    barChartData2.datasets[0].fillColor   = '#00a65a'
    barChartData2.datasets[0].strokeColor = '#00a65a'
    barChartData2.datasets[0].pointColor  = '#00a65a'

    barChartOptions.datasetFill = false
    barChart2.Bar(barChartData2, barChartOptions)

    })

    function getGraph_2()
    {
        var status2 = document.getElementById('status_2').value;
        $('#graph_2').load('<?php echo e(url("/")); ?>/dashboard/graph_2/'+status2);
    }

</script><?php /**PATH C:\xampp\htdocs\sdhc\resources\views/layouts/graph_dashboard/graph_2.blade.php ENDPATH**/ ?>