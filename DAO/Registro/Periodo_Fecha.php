<?php
include_once '../DAO/Conexion.php';

if(!isset($_SESSION)){
session_start();
}

class Periodo_Fecha {
    
    private $id;
    private $fecha;
    private $idperiodo;
    private $estado; 
    private $fecha_registro;
   
    
    function __construct() {}
    
function getId() {
    return $this->id;
}

function getFecha() {
    return $this->fecha;
}

function getIdperiodo() {
    return $this->idperiodo;
}

function getEstado() {
    return $this->estado;
}

function getFecha_registro() {
    return $this->fecha_registro;
}

function setId($id) {
    $this->id = $id;
}

function setFecha($fecha) {
    $this->fecha = $fecha;
}

function setIdperiodo($idperiodo) {
    $this->idperiodo = $idperiodo;
}

function setEstado($estado) {
    $this->estado = $estado;
}

function setFecha_registro($fecha_registro) {
    $this->fecha_registro = $fecha_registro;
}




//------------------------------------------------------------------------------
     function grabar(Periodo_Fecha $pf){
        
        $con =  Conectar();
        $sql = "SELECT * FROM periodo_fecha_insertar('$pf->fecha',$pf->idperiodo,'1')";
//        var_dump($sql);
//        exit();       
        $res = pg_query($con,$sql);
//        $val = pg_fetch_result($res,0,0);
//        if($val=='0'){
//            return 0;
//        }
//        else{
//            return $val;
//        }
        }
     
       function listar_por_periodo(Periodo_Fecha $pf){
       
        $con = Conectar();
        $sql = "SELECT * FROM listar_fechas_por_periodo($pf->idperiodo)";
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
    
          function listar_por_periodo_row(Periodo_Fecha $pf){
       
        $con = Conectar();
        $sql = "SELECT * FROM listar_fechas_por_periodo($pf->idperiodo)";
//        var_dump($sql);
//        exit();
        $res = pg_query($con,$sql);
        $array=null;
        while($fila = pg_fetch_row($res))
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
