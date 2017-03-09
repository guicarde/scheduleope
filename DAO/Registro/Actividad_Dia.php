<?php
include_once '../DAO/Conexion.php';

if(!isset($_SESSION)){
session_start();
}

class Actividad_Dia {
    
    private $id;
    private $idactividad;
    private $iddia;
    private $estado;
        
    function __construct() {}
function getId() {
    return $this->id;
}

function getIdactividad() {
    return $this->idactividad;
}

function getIddia() {
    return $this->iddia;
}

function getEstado() {
    return $this->estado;
}

function setId($id) {
    $this->id = $id;
}

function setIdactividad($idactividad) {
    $this->idactividad = $idactividad;
}

function setIddia($iddia) {
    $this->iddia = $iddia;
}

function setEstado($estado) {
    $this->estado = $estado;
}

  





//------------------------------------------------------------------------------
   
   function grabar(Actividad_Dia $ad){
        
        $con =  Conectar();
        $sql = "SELECT * FROM actividad_dia_insertar($ad->idactividad,$ad->iddia,'1')";
//        var_dump($sql);
//        exit();       
        $res = pg_query($con,$sql);
        $val = pg_fetch_result($res,0,0);
        if($val=='0'){
            return 0;
        }
        else{
            return $val;
        }
        }
    function actualizar(Actividad_Dia $ad){
        
        $con =  Conectar();
        $sql = "SELECT * FROM actividad_dia_editar($ad->idactividad,$ad->iddia,'1')";
//        var_dump($sql);
//        exit();       
        $res = pg_query($con,$sql);
        $val = pg_fetch_result($res,0,0);
        if($val=='0'){
            return 0;
        }
        else{
            return $val;
        }
        }
        
  function dias_por_actividad(Actividad_Dia $ad){
       
        $con = Conectar();
        $sql = "SELECT * FROM dia_por_actividad($ad->idactividad)";
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
