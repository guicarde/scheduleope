<?php

function Conectar()
{
    $con = pg_connect("host=jumbo.db.elephantsql.com port=5432 dbname=vvggesku user=vvggesku password=aSmF1ip7Fb_DltIN8C9EPT-hIY9apVd9") or die("error");
    return $con;
}

