
<div class="col-md-6">
    <div class="box box-danger">
        <?php
          $category="";
          $value="0";
          $tgl="";
          $bln = date("m")-1;
          $thn = date("Y")-1;
          $blnName = "December";
          $param_1 = Session::get('param_1');

          if((Session::get('report_1'))>0){
            foreach(Session::get('report_1') as $rpt){
                $category .= "'".$rpt->kategori_layanan."',";
                $value .= $rpt->jml.",";
                $bln = ($rpt->bulan!="") ? $rpt->bulan : "01";
                $thn = $rpt->tahun;
                $tgl = $thn."-".$bln."-01";
                $blnName = date("F",strtotime($tgl));
            }
          } else {
            $category="";
            $value="0";
            $tgl="";
            $bln = date("m")-1;
            $thn = date("Y")-1;
            $blnName = "December";
          }
        ?>
        <div class="box-header with-border">
            <h3 class="box-title">Layanan Per Bulan, <?php echo e(($bln!="" && $thn!="")?$blnName." ".$thn:"(Data Not Found)"); ?></h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
            <div style="margin-top:8px; margin-left:150px">
                Status
                <select name="status_1" id="status_1">
                <option value="-">Semua Status</option>
                <option value="open" <?php echo ($param_1=="open")?"selected":"";?>>Open</option>
                <option value="inprogress" <?php echo ($param_1=="inprogress")?"selected":"";?>>In Progress</option>
                <option value="closed" <?php echo ($param_1=="closed")?"selected":"";?>>Closed</option>
                </select>
                <input type="button" value="Lihat" onclick="getGraph_1()">
            </div>
        </div>

        <div class="box-body">
            <div class="chart">

                <canvas id="barChart1" style="height:230px"></canvas>
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

        var barChartCanvas                   = $('#barChart1').get(0).getContext('2d')
        var barChart                         = new Chart(barChartCanvas)
        var barChartData                     = {
          labels  : [<?php echo $category;?>],
          datasets: [
            {
              label               : 'Hardware',
              fillColor           : 'rgba(210, 214, 222, 1)',
              strokeColor         : 'rgba(210, 214, 222, 1)',
              pointColor          : 'rgba(210, 214, 222, 1)',
              pointStrokeColor    : '#c1c7d1',
              pointHighlightFill  : '#fff',
              pointHighlightStroke: 'rgba(220,220,220,1)',
              data                : [<?php echo $value;?>]
            }
          ]
        }
        barChartData.datasets[0].fillColor   = '#3096f0'
        barChartData.datasets[0].strokeColor = '#3096f0'
        barChartData.datasets[0].pointColor  = '#00a65a'

        barChartOptions.datasetFill = false
        barChart.Bar(barChartData, barChartOptions)

      })

      function getGraph_1()
      {
        var status = document.getElementById('status_1').value;
        $('#graph_1').load('<?php echo e(url("/")); ?>/dashboard/graph_1/'+status);
      }
    </script><?php /**PATH C:\xampp\htdocs\sdhc\resources\views/layouts/graph_dashboard/graph_1.blade.php ENDPATH**/ ?>