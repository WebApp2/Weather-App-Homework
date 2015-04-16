
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<?php 

require_once('chartData.php');
//Gets the data from app_home.php makes a function call to chartData.php
$month = $_REQUEST['monthData'];
$f = $INFILES[$month];
 
csv_to_json($HOME, $f); 
?>
<html>

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
       
       <link rel="stylesheet" href="http://www.amcharts.com/lib/style.css" type="text/css">
<script src="http://www.amcharts.com/lib/3/amcharts.js" type="text/javascript"></script>
<script src="http://www.amcharts.com/lib/3/serial.js" type="text/javascript"></script>
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
                var chartData = AmCharts.loadJSON('jsonData.php');
                chart.pathToImages = "http://www.amcharts.com/lib/images/";
                chart.dataProvider = chartData;
                chart.categoryField = "Date";
                chart.dataDateFormat = "MMDDYYYY";
              
                //Legend
                var legend = new AmCharts.AmLegend();
                chart.addLegend(legend);

                // AXES
                // category
                var categoryAxis = chart.categoryAxis;
                categoryAxis.parseDates = false; // as our data is date-based, we set parseDates to true
                categoryAxis.minPeriod = "DD"; // our data is daily, so we set minPeriod to DD
                categoryAxis.dashLength = 1;
                categoryAxis.gridAlpha = 0.15;
                categoryAxis.minorGridEnabled = true;
                categoryAxis.axisColor = "#DADADA";
                categoryAxis.equalSpacing = true;
                categoryAxis.labelFrequency= 2;
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

                 // GRAPH
                var graph = new AmCharts.AmGraph();
                graph.title = "High";
                graph.valueField = "High";
                graph.bullet = "round";
                graph.bulletBorderColor = "#FFFFFF";
                graph.bulletBorderThickness = 2;
                graph.bulletBorderAlpha = 1;
                graph.lineThickness = 2;
                graph.lineColor = "#b5030d";
                graph.negativeLineColor = "#0352b5";
                graph.balloonText = "[[category]]<br><b><span style='font-size:14px;'>value: [[value]]</span></b>";
                graph.hideBulletsCount = 50; // this makes the chart to hide bullets when there are more than 50 series in selection
                chart.addGraph(graph);

                 // GRAPH
                var graph = new AmCharts.AmGraph();
                graph.title = "Low";
                graph.valueField = "Low";
                graph.bullet = "round";
                graph.bulletBorderColor = "#0066FF";
                graph.bulletBorderThickness = 2;
                graph.bulletBorderAlpha = 1;
                graph.lineThickness = 2;
                graph.lineColor = "#0066FF";
                graph.negativeLineColor = "#0352b5";
                graph.balloonText = "[[category]]<br><b><span style='font-size:14px;'>value: [[value]]</span></b>";
                graph.hideBulletsCount = 50; // this makes the chart to hide bullets when there are more than 50 series in selection
                chart.addGraph(graph);

                // CURSOR
                chartCursor = new AmCharts.ChartCursor();
                chartCursor.cursorPosition = "mouse";
                chart.addChartCursor(chartCursor);

                // SCROLLBAR
                var chartScrollbar = new AmCharts.ChartScrollbar();
                //chartScrollbar.graph = graph;
               // chartScrollbar.scrollbarHeight = 40;
                //chartScrollbar.color = "#FFFFFF";
                //chartScrollbar.autoGridCount = true;
                chart.addChartScrollbar(chartScrollbar);

                
                chart.write("chartdiv");


                
            });

            

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
        <div id="chartdiv" style="width: 800px; height: 500px;"></div>

    </body>

</html>
