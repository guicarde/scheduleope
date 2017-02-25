<?php
include_once 'C:\xampp\htdocs\SistemaSchedule\DAO\Conexion.php';

if(!isset($_SESSION)){
session_start();
}

class Actividad_Turno {
    
    private $id;
    private $idactividad;
    private $idturno;
    private $estado;
        
    function __construct() {}

function getId() {
    return $this->id;
}

function getIdactividad() {
    return $this->idactividad;
}

function getIdturno() {
    return $this->idturno;
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

function setIdturno($idturno) {
    $this->idturno = $idturno;
}

function setEstado($estado) {
    $this->estado = $estado;
}







//------------------------------------------------------------------------------
   
   function grabar(Actividad_Turno $at){
        
        $con =  Conectar();
        $sql = "SELECT * FROM actividad_sede_turno_insertar($at->idactividad,$at->idturno,'1')";
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
      function actualizar(Actividad_Turno $at){
        
        $con =  Conectar();
        $sql = "SELECT * FROM actividad_sede_turno_actualizar($at->idactividad,$at->idturno,'1')";
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
    
        }
