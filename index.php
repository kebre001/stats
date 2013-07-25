
<?php 

$url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$ip = $_SERVER['REMOTE_ADDR'];  //$_SERVER["HTTP_X_FORWARDED_FOR"];
$domain = $_SERVER["HTTP_HOST"];
$land = file_get_contents('http://api.hostip.info/country.php?ip='.$ip);
$today = date("Ymd");

//mysql connect
$link = mysql_connect('host', 'user', 'password');
if (!$link) {
    die('Could not connect: ' . mysql_error());
}


error_reporting(E_ALL);
mysql_select_db("stats") or die(mysql_error());

//mysql insert update 
$query ="INSERT INTO logurl(url, count) VALUES ('$url', 1) ON DUPLICATE KEY UPDATE count=count+1";
$query2 ="INSERT INTO logip(ip, count) VALUES ('$ip', 1) ON DUPLICATE KEY UPDATE count=count+1";
$query3 ="INSERT INTO logdomain(domain, count) VALUES ('$domain', 1) ON DUPLICATE KEY UPDATE count=count+1";
$query4 ="INSERT INTO logland(land, count) VALUES ('$land', 1) ON DUPLICATE KEY UPDATE count=count+1";
$query5 ="INSERT INTO logdate(date, count) VALUES ('$today', 1) ON DUPLICATE KEY UPDATE count=count+1";

mysql_query($query);
mysql_query($query2);
mysql_query($query3);
mysql_query($query4);
mysql_query($query5);
mysql_close($link);
//end mysql

?>
