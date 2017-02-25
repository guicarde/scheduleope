<?php

function Conectar()
{
    $con = pg_connect("host=localhost port=5432 dbname=BDSCHEDULE user=postgres password=123456") or die("error");
    return $con;
}

