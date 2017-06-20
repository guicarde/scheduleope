<?php
$services = getenv("VCAP_SERVICES");
$services_json = json_decode($services, true);
$elephantsql_config = $services_json["elephantsql"][0]["credentials"];
$host = "echo.db.elephantsql.com";
$user = "isbcajie";
$pass = "4d8utyiTFBbOUrvMSaXZkoEg2JyL4c8i";
$db_name ="isbcajie";
$port = "5432";

//var_dump('SI LLEGAMOS AQUI');

function Conectar()
{
    $con = pg_connect("host=echo.db.elephantsql.com port=5432 dbname=isbcajie user=isbcajie password=4d8utyiTFBbOUrvMSaXZkoEg2JyL4c8i") or die("PROBLEMAS AL LOGRAR CONEXIÓN");
    //$con = pg_connect("host=9.6.98.139 port=5432 dbname=BDSCHEDULE user=postgres password=123456") or die("PROBLEMAS AL LOGRAR CONEXION");
    return $con;
}

