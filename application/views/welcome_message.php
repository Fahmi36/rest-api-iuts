<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>

	<style type="text/css">

	::selection { background-color: #E13300; color: white; }
	::-moz-selection { background-color: #E13300; color: white; }

	body {
		background-color: #fff;
		margin: 40px;
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
	}

	a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
	}

	h1 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 19px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}

	code {
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 10px 12px 10px;
	}

	#body {
		margin: 0 15px 0 15px;
	}

	p.footer {
		text-align: right;
		font-size: 11px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}

	#container {
		margin: 10px;
		border: 1px solid #D0D0D0;
		box-shadow: 0 0 8px #D0D0D0;
	}
</style>
</head>
<body>

	<div>
	<canvas id="myChart" style="width: 300px; height: 100px;"></canvas></div>

	<div id="line_top_x"></div>

	<div id="columnchart_material" style="width: 800px; height: 500px;"></div>
	<div id="chart_div"></div>
</body>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
	google.charts.load('current', {'packages':['corechart']});
	google.charts.setOnLoadCallback(drawChartline);

	function drawChartline() {
		var data = google.visualization.arrayToDataTable([
			['Kelurahan', 'Jumlah Penduduk', 'Rata-Rata Pendapatan'],
			['Pasar Minggu',  1000,400],
			['Cengkareng',  1170, 460],
			['Cilincing',  660, 1120],
			['Condet',  1030,540]
			]);

		var options = {
			title: 'Perbandingan Jumlah Penduduk dan Jumlah Pendapatan',
			curveType: 'function',
			legend: { position: 'bottom' }
		};

		var chart = new google.visualization.LineChart(document.getElementById('line_top_x'));

		chart.draw(data, options);
	}
</script>
<script type="text/javascript">
	google.charts.load('current', {'packages':['bar']});
	google.charts.setOnLoadCallback(drawChartbar);

	function drawChartbar() {
		var data = google.visualization.arrayToDataTable([
			['Kelurahan', 'Jumlah Penduduk', 'Pendapatan'],
			['Cengkareng', 1000, 400],
			['Cilincing', 1170, 460],
			['Condet', 660, 1120],
			['Pasar Minggu', 1030, 540]
			]);

		var options = {
			chart: {
				title: 'Perbandingan',
				subtitle: 'Jumlah Penduduk dan Jumlah Pendapatan',
			}
		};

		var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

		chart.draw(data, google.charts.Bar.convertOptions(options));
	}
</script>
<script type="text/javascript">
	google.charts.load("current", "1", {packages:["corechart"]});
	google.charts.setOnLoadCallback(chartpryramid);

	function chartpryramid()
	{
            //var data = new google.visualization.DataTable();

            var data = google.visualization.arrayToDataTable([
            	['', 'Jumlah Penduduk', 'Pendapatan'],
            	['Pasar Minggu', 68,  -64 ],
            	['Condet', 79,  -77 ],
            	['Cilincing',   91,  -86 ],
            	['Cengkareng',   106, -104]
            	]);


            var options = {
            	isStacked: true,
            	hAxis: {
            		format: ';'
            	},
            	vAxis: {
            		direction: -1
            	},
            	bars: 'horizontal'
            };


            var formatter = new google.visualization.NumberFormat({
            	pattern: ';'
            });

            formatter.format(data, 2)

            var chart = new google.charts.Bar(document.getElementById('chart_div'));

            chart.draw(data, google.charts.Bar.convertOptions(options));
        }

    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
    <script type="text/javascript">
    	var ctx = document.getElementById('myChart').getContext('2d');
    	var chart = new Chart(ctx, {
    // Tvar myRadarChart = new Chart(ctx, {
    	type: 'radar',
    	data: {
    		labels: ['Pendapatan', 'Jumlah Penduduk','Penduduk Sakit', ' Tua Renta'],
    		datasets: [{
    			label : 'Pasar Minggu',
    			borderColor:'blue',
    			pointBackgroundColor:'blue',
    			data: [1000000, 10000000,800000, 100000]
    		},
    		{
    			label : 'Condet',
    			borderColor:'red',
    			pointBackgroundColor:'red',
    			data: [10000000, 20000000, 100000,10000]
    		}]
    	},
    	options: {
    		scale: {
        // Hides the scale
        display: true
    }
},
});
</script>
</html>