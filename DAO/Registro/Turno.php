<?php
include_once '../DAO/Conexion.php';

if(!isset($_SESSION)){
session_start();
}

class Turno {
    
    private $id;
    private $nombre;
    private $horain;
    private $horafin;
    private $estado;
    private $fechareg;
    private $idactividad;
        
    function __construct() {}

function getId() {
    return $this->id;
}

function getNombre() {
    return $this->nombre;
}

function getHorain() {
    return $this->horain;
}

function getHorafin() {
    return $this->horafin;
}

function getEstado() {
    return $this->estado;
}

function getFechareg() {
    return $this->fechareg;
}

function setId($id) {
    $this->id = $id;
}

function setNombre($nombre) {
    $this->nombre = $nombre;
}

function setHorain($horain) {
    $this->horain = $horain;
}

function setHorafin($horafin) {
    $this->horafin = $horafin;
}

function setEstado($estado) {
    $this->estado = $estado;
}

function setFechareg($fechareg) {
    $this->fechareg = $fechareg;
}

function getIdactividad() {
    return $this->idactividad;
}

function setIdactividad($idactividad) {
    $this->idactividad = $idactividad;
}


//------------------------------------------------------------------------------
   

    function listar(Turno $t){
       
        $con = Conectar();
        $sql = "SELECT * FROM listar_turnos_por_sede_lm($t->id)";
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
        function listar_aram(Turno $t){
       
        $con = Conectar();
        $sql = "SELECT * FROM listar_turnos_por_sede($t->id)";
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
    
    function listar_tn(Turno $t){
       
        $con = Conectar();
        $sql = "SELECT * FROM listar_turnos_por_sede_tm($t->id)";
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
        function listar_turno_por_act(Turno $t){
       
        $con = Conectar();
        $sql = "SELECT * FROM listar_turnos_por_act($t->idactividad)";
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
