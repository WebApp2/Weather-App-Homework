

<?php  


File::requireOnce('C:\xampp\htdocs\laravel\laravel\app\views\weather_app\chart_data.blade.php');
 
$HOME='C:\xampp\htdocs\laravel\laravel\app\views\weather_app';     
$INFILES['jan'] ='\012015data.csv';     
$INFILES['feb'] ='\022015data.csv';     
$INFILES['march'] ='\032015data.csv';     
$INFILES['april'] ='\042015data.csv';     
$month = $_REQUEST['monthData'];
$f = $INFILES[$month];

csv_to_json($HOME, $f);
?>
<html>

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
       
       <link rel="stylesheet" href="http://www.amcharts.com/lib/style.css" type="text/css">
<script src="amcharts/amcharts.js" type="text/javascript"></script>
<script src="amcharts/serial.js" type="text/javascript"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script>
AmCharts.loadJSON = function(url) {
    
if (window.XMLHttpRequest) {

var request = new XMLHttpRequest();
} else {

var request = new ActiveXObject('Microsoft.XMLHTTP');
} 


request.open('GET', url, false);
request.send();


return eval(request.responseText);
};
</script>
        <script type="text/javascript">

            
          
            var chartCursor;
            var chart;

            AmCharts.ready(function() {


                // SERIAL CHART
                chart = new AmCharts.AmSerialChart();
                var chartData = AmCharts.loadJSON('/jsonData.php');
                chart.pathToImages = "amcharts/images/";
                chart.dataProvider = chartData;
                chart.categoryField = "Date";
                chart.dataDateFormat = "MMDDYYYY";
                
                //Legend
                var legend = new AmCharts.AmLegend();
                chart.addLegend(legend);

                // AXES
                // category
                var categoryAxis = chart.categoryAxis;
                categoryAxis.parseDates = true; // as our data is date-based, we set parseDates to true
                categoryAxis.minPeriod = "DD"; // our data is daily, so we set minPeriod to DD
                categoryAxis.dashLength = 1;
                categoryAxis.gridAlpha = 0.15;
                categoryAxis.minorGridEnabled = true;
                categoryAxis.axisColor = "#DADADA";
                categoryAxis.equalSpacing = true;
                
                // value
                var valueAxis = new AmCharts.ValueAxis();
                valueAxis.axisAlpha = 0.2;
                valueAxis.dashLength = 1;
                chart.addValueAxis(valueAxis);

                // GRAPH
                var graph = new AmCharts.AmGraph();
                graph.title = "Average";
                graph.valueField = "Average";
                graph.bullet = "round";
                graph.bulletBorderColor = "#FF6600";
                graph.bulletBorderThickness = 2;
                graph.bulletBorderAlpha = 1;
                graph.lineThickness = 2;
                graph.lineColor = "#FF6600";
                graph.negativeLineColor = "#0352b5";
                graph.balloonText = "[[category]]<br><b><span style='font-size:14px;'>value: [[value]]</span></b>";
                graph.hideBulletsCount = 50; // this makes the chart to hide bullets when there are more than 50 series in selection
                chart.addGraph(graph);
                 //Graph hidden by default, will show if checkbox is selected
                <?php if(isset($_REQUEST['ShowAverage'])){
                    echo 'chart.showGraph(graph)';
                }
                else{
                    echo'chart.hideGraph(graph);';
                } 
                ?>

                 // GRAPH
                var high = new AmCharts.AmGraph();
                high.title = "High";
                high.valueField = "High";
                high.bullet = "round";
                high.bulletBorderColor = "#FFFFFF";
                high.bulletBorderThickness = 2;
                high.bulletBorderAlpha = 1;
                high.lineThickness = 2;
                high.lineColor = "#b5030d";
                high.negativeLineColor = "#0352b5";
                high.balloonText = "[[category]]<br><b><span style='font-size:14px;'>value: [[value]]</span></b>";
                high.hideBulletsCount = 50; // this makes the chart to hide bullets when there are more than 50 series in selection
                chart.addGraph(high);
                 //Graph hidden by default, will show if checkbox is selected
                <?php if(isset($_REQUEST['ShowHigh'])){
                    echo 'chart.showGraph(high);';
                }
                else{
                    echo'chart.hideGraph(high);';
                } 
                ?>

                 // GRAPH
                var low = new AmCharts.AmGraph();
                low.title = "Low";
                low.valueField = "Low";
                low.bullet = "round";
                low.bulletBorderColor = "#0066FF";
                low.bulletBorderThickness = 2;
                low.bulletBorderAlpha = 1;
                low.lineThickness = 2;
                low.lineColor = "#0066FF";
                low.negativeLineColor = "#0352b5";
                low.balloonText = "[[category]]<br><b><span style='font-size:14px;'>value: [[value]]</span></b>";
                low.hideBulletsCount = 50; // this makes the chart to hide bullets when there are more than 50 series in selection
                chart.addGraph(low);

                //Graph hidden by default, will show if checkbox is selected
                <?php if(isset($_REQUEST['ShowLow'])){
                    echo 'chart.showGraph(low);';
                }
                else{
                    echo'chart.hideGraph(low);';
                } 
                ?>
                
                    
                
                
                // CURSOR
                chartCursor = new AmCharts.ChartCursor();
                chartCursor.cursorPosition = "mouse";
                chart.addChartCursor(chartCursor);

                // SCROLLBAR
                var chartScrollbar = new AmCharts.ChartScrollbar();
                chartScrollbar.graph = graph;
                chartScrollbar.scrollbarHeight = 40;
                chartScrollbar.color = "#FFFFFF";
                chart.addChartScrollbar(chartScrollbar);
                 if($('#average').is(':checked')){
                graphs[Average].hidden = true;
                }  
                
                chart.write("chartdiv");


                
            });

            
            function handleClick(){

            }
             // this method is called when chart is first inited as we listen for "dataUpdated" event
            
             // changes cursor mode from pan to select
            function setPanSelect() {
                if (document.getElementById("rb1").checked) {
                    chartCursor.pan = false;
                    chartCursor.zoomable = true;

                } else {
                    chartCursor.pan = true;
                }
                chart.validateNow();
            }
        </script>
    </head>

   <body>
         <label id="titleDiv"></label><p>
          (<a href="weather">Go Back to the Form</a>)<p>
           <div id="appendDiv" style="width: 500; height: 50;"><?php print"<h1>".$_REQUEST['graphName']."</h1>"; ?></div>
        <div id="chartdiv" style="width: 800px; height: 500px;"></div>



    </body>

</html>