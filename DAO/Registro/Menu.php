<?php
include_once '../DAO/Conexion.php';

if(!isset($_SESSION)){
session_start();
}

class Menu {
    
    private $id;
    private $nombremenu;
        
    function __construct() {}
    
function getId() {
    return $this->id;
}

function getNombremenu() {
    return $this->nombremenu;
}

function setId($id) {
    $this->id = $id;
}

function setNombremenu($nombremenu) {
    $this->nombremenu = $nombremenu;
}




//------------------------------------------------------------------------------
   

    function listar(){
       
        $con = Conectar();
        $sql = "SELECT * FROM menu_listar()";
        $res = pg_query($con,$sql);
        $array=null;
        while($fila = pg_fetch_assoc($res))
        {
                   $array[] = $fila;
        }
       
        if(count($array)!=0){
            return $array; 
        }
        else{
            return null;
        }
    }
    
    function listar_por_usuario($idusu){
       
        $con = Conectar();
        $sql = "SELECT * FROM menus_por_usuario($idusu)";
//        var_dump($sql);
//        exit();
        $res = pg_query($con,$sql);
        $array=null;
        while($fila = pg_fetch_assoc($res))
        {
                   $array[] = $fila;
        }
       
        if(count($array)!=0){
            return $array; 
        }
        else{
            return null;
        }
    }
    
        }
