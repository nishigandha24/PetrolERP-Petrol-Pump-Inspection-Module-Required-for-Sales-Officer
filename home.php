<?php
include ("connection.php");
error_reporting(0);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>IOCL - Dashboard</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/font-awesome.min.css" rel="stylesheet">
        <link href="css/datepicker3.css" rel="stylesheet">
        <link href="css/styles.css" rel="stylesheet">
        <!--Custom Font-->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    
    
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);
google.charts.setOnLoadCallback(drawChart1);
function drawChart() {

    var data = google.visualization.arrayToDataTable([
      ['MS', 'HSD'],
      <?php
      $sql = "select ms,sum(ms) as num1,hsd,sum(hsd) as num2 from purchase";
      $data = mysqli_query($conn, $sql);
      $total = mysqli_num_rows($data);
      if($data->num_rows > 0){
          while($row = $data->fetch_assoc()){
            echo "['MS', ".$row['num1']."],";
            echo "['HSD', ".$row['num2']."],";
          }
      }
      ?>
    ]);
    
    var options = {
        //title: 'Purchase Details',
        width: 900,
        height: 500,
        pieHole:0.5
    };
    
    var chart = new google.visualization.PieChart(document.getElementById('piechart'));
    
    chart.draw(data, options);
}

function drawChart1() {

    var data = google.visualization.arrayToDataTable([
      ['MS', 'HSD'],
      <?php
      $sql1 = "select ms,sum(ms) as num1,hsd,sum(hsd) as num2 from sale";
      $data1 = mysqli_query($conn, $sql1);
      $total1 = mysqli_num_rows($data1);
      if($data1->num_rows > 0){
          while($row = $data1->fetch_assoc()){
            echo "['MS', ".$row['num1']."],";
            echo "['HSD', ".$row['num2']."],";
          }
      }
      ?>
    ]);
    
    var options = {
        //title: 'Sale Details',
        width: 900,
        height: 500,
        pieHole:0.5       
    };
    
    var chart = new google.visualization.PieChart(document.getElementById('piechart1'));
    
    chart.draw(data, options);
}
</script>
</head>
<body>
        <?php
        include_once ("NavBarCommon.php");
        ?>
        <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main ">
            <div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Welcome</h1>
			</div>
		</div>
<div class="panel panel-container">
			<div class="row">
				<div class="col-xs-6 col-md-3 col-lg-3 no-padding">
					<div class="panel panel-teal panel-widget border-right">
						<div class="row no-padding"><em class="fa fa-xl fa-shopping-cart color-blue"></em>
							<div class="large">120</div>
							<div class="text-muted">New Orders</div>
						</div>
					</div>
				</div>
				<div class="col-xs-6 col-md-3 col-lg-3 no-padding">
					<div class="panel panel-blue panel-widget border-right">
						<div class="row no-padding"><em class="fa fa-xl fa-comments color-orange"></em>
							<div class="large">52</div>
							<div class="text-muted">Comments</div>
						</div>
					</div>
				</div>
				<div class="col-xs-6 col-md-3 col-lg-3 no-padding">
					<div class="panel panel-orange panel-widget border-right">
						<div class="row no-padding"><em class="fa fa-xl fa-users color-teal"></em>
							<div class="large">24</div>
							<div class="text-muted">New Users</div>
						</div>
					</div>
				</div>
				<div class="col-xs-6 col-md-3 col-lg-3 no-padding">
					<div class="panel panel-red panel-widget ">
						<div class="row no-padding"><em class="fa fa-xl fa-search color-red"></em>
							<div class="large">25.2k</div>
							<div class="text-muted">Page Views</div>
						</div>
					</div>
				</div>
                        </div></div>
    <div class="col-md-12">
	<div class="panel panel-default">
	    <div class="panel-heading">
                <b>Purchase Details</b>
		<span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span>
            </div>
                <div class="panel-body">
		<div class="canvas-wrapper">
		<div  id="piechart" ></div>
		</div>
		</div>
	</div>
    </div>
		
<div class="col-md-12">
	<div class="panel panel-default">
	    <div class="panel-heading">
                <b> Sales Details</b>
		<span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span>
            </div>
                <div class="panel-body">
		<div class="canvas-wrapper">
		<div  id="piechart1" ></div>
		</div>
		</div>
	</div>
    </div>
        </div>
        </div>
        <script src="js/jquery-3.3.1.js" type="text/javascript"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/chart.min.js"></script>
        <script src="js/chart-data.js"></script>
        <script src="js/easypiechart.js"></script>
        <script src="js/easypiechart-data.js"></script>
        <script src="js/bootstrap-datepicker.js"></script>
        <script src="js/custom.js"></script>
        <script>
            window.onload = function () {
                var chart1 = document.getElementById("line-chart").getContext("2d");
                window.myLine = new Chart(chart1).Line(lineChartData, {
                    responsive: true,
                    scaleLineColor: "rgba(0,0,0,.2)",
                    scaleGridLineColor: "rgba(0,0,0,.05)",
                    scaleFontColor: "#c5c7cc"
                });
            };
        </script>
    </body>
</html>