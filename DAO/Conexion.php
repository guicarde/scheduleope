<?php
$services = getenv("VCAP_SERVICES");
$services_json = json_decode($services, true);
$elephantsql_config = $services_json["elephantsql"][0]["credentials"];
$host = "jumbo.db.elephantsql.com";
$user = "vvggesku";
$pass = "aSmF1ip7Fb_DltIN8C9EPT-hIY9apVd9";
$db_name ="vvggesku";
$port = "5432";

//var_dump('SI LLEGAMOS AQUI');

function Conectar()
{
    $con = pg_connect("host=jumbo.db.elephantsql.com port=5432 dbname=vvggesku user=vvggesku password=aSmF1ip7Fb_DltIN8C9EPT-hIY9apVd9") or die("PROBLEMAS AL LOGRAR CONEXIÓN");
    return $con;
}

