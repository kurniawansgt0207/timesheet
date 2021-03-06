<?php
    $ytd="";
    $value3="";
    $tgl3="";
    $label = "";
    $param_3 = Session::get('param_3');

    if(Session::get('report_3')>0){
        foreach(Session::get('report_3') as $rpt){
            $ytd .= "'".$rpt->kategori_layanan_desc."',";
            $value3 .= $rpt->jml.",";
        }
    } else {
        $ytd="";
        $value3="";
        $tgl3="";
        $label = "(Data Not Found)";
    }
?>
<div class="col-md-6">
    <div class="box box-danger">
        <div class="box-header with-border">
            <h3 class="box-title">Per Category Year to Date {{ $label }}</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
        </div>
        <div style="margin-top:8px; margin-left:150px">
                Status
                <select name="status_3" id="status_3">
                <option value="-">Semua Status</option>
                <option value="open" <?php echo ($param_3=="open")?"selected":"";?>>Open</option>
                <option value="inprogress" <?php echo ($param_3=="inprogress")?"selected":"";?>>In Progress</option>
                <option value="closed" <?php echo ($param_3=="closed")?"selected":"";?>>Closed</option>
                </select>
                <input type="button" value="Lihat" onclick="getGraph_3()">
            </div>
        <div class="box-body">
            <div class="chart">
                <canvas id="barChart3" style="height:230px"></canvas>
            </div>
        </div>
    </div>
</div>

<script src="{{url('public/adminlte/bower_components/jquery/dist/jquery.min.js')}}"></script>
<script src="{{url('public/adminlte/bower_components/jquery-ui/jquery-ui.min.js')}}"></script>

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

    var barChartCanvas3                   = $('#barChart3').get(0).getContext('2d')
    var barChart3                         = new Chart(barChartCanvas3)
    var barChartData3                     = {
        labels  : [<?php echo $ytd;?>],
        datasets: [
        {
            label               : 'Hardware',
            fillColor           : 'rgba(210, 214, 222, 1)',
            strokeColor         : 'rgba(210, 214, 222, 1)',
            pointColor          : 'rgba(210, 214, 222, 1)',
            pointStrokeColor    : '#c1c7d1',
            pointHighlightFill  : '#fff',
            pointHighlightStroke: 'rgba(220,220,220,1)',
            data                : [<?php echo $value3;?>]
        }
        ]
    }
    barChartData3.datasets[0].fillColor   = '#00a65a'
    barChartData3.datasets[0].strokeColor = '#00a65a'
    barChartData3.datasets[0].pointColor  = '#00a65a'

    barChartOptions.datasetFill = false
    barChart3.Bar(barChartData3, barChartOptions)

    })

    function getGraph_3()
    {
        var status3 = document.getElementById('status_3').value;
        $('#graph_3').load('{{url("/")}}/dashboard/graph_3/'+status3);
    }

</script>