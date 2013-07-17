<?
require_once 'mysql.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <title>Statistik</title>
  <script type="text/javascript" src="http://www.google.com/jsapi"></script>
  <script type="text/javascript">
    google.load('visualization', '1', {packages: ['geomap']});

    function drawVisualization() {
      var data = google.visualization.arrayToDataTable([
<?
$results = DB::query("SELECT * FROM logland");
foreach ($results as $row) {
  echo "['" . $row['land'];
  echo "', " . $row['count'] . "],";
if($row['land']=='??'){
$i++ ;
}
if($row['land']=='XX'){
$i++ ;
}
}?>

        ['??', 0]
      ]);
    
      var geomap = new google.visualization.GeoMap(
          document.getElementById('visualization'));
      geomap.draw(data, null);
    }
    

    google.setOnLoadCallback(drawVisualization);
  </script>

    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Task', 'domän info'],
<?
$results = DB::query("SELECT * FROM logdoman");
foreach ($results as $row) {
  echo "['" . $row['doman'];
  echo "', " . $row['count'] . "],";

}?>
          ['Sleep',    0]
        ]);

        var options = {
          title: 'domän info'
        };

        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Task', 'domän info'],
<?
$results = DB::query("SELECT * FROM logurl");
foreach ($results as $row) {
  echo "['" . $row['url'];
  echo "', " . $row['count'] . "],";

}?>
          ['Sleep',    0]
        ]);

        var options = {
          title: 'Url info'
        };

        var chart = new google.visualization.PieChart(document.getElementById('chart_div2'));
        chart.draw(data, options);
      }
    </script>
</head>
<body style="font-family: Arial;border: 0 none; ">
	<div id="visualization" ></div><? echo $i; ?> som vi inte vet landet på.
	<div id="chart_div" style="width: 900px; height: 500px;"></div>
	<div id="chart_div2" style="width: 1200px; height: 500px;"></div>

</html>
