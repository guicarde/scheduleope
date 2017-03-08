<!DOCTYPE html>
<html>
<head>
	<title>ABCognitive</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
<?php
$services = getenv("VCAP_SERVICES");
$services_json = json_decode($services, true);
$elephantsql_config = $services_json["elephantsql"][0]["credentials"];
$host = "jumbo.db.elephantsql.com";
$user = "vvggesku";
$pass = "aSmF1ip7Fb_DltIN8C9EPT-hIY9apVd9";
$db_name ="vvggesku";
$port = "5432";

 // Open a PostgreSQL connection
 $con = pg_connect("host=$host dbname=$db user=$user password=$pass port=$port") or die ("Could not connect to server\n");
          echo "<h1>Conexion Exitosa PHP - PostgreSQL</h1><hr><br>";
 $query = 'SELECT * FROM tbl_periodo';
 $results = pg_query($con, $query) or die('Query failed: ' . pg_last_error());
 
 $row = pg_fetch_row($results);
 echo $row[0] . "\n";
 // Closing connection
 pg_close($con);

?>
	<table>
		<tr>
			<td>
				<h1><?php echo "TRABAJANDO EN BLUEMIX"; ?></h1>

				
				<p></p> inicio <span>BLUEMIX</span>
			</td>
			
 
		</tr>
	</table>
</body>
</html>
