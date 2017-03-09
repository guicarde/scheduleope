<?php
include_once '../DAO/Conexion.php';

if(!isset($_SESSION)){
session_start();
}

class Subcategoria {
    
    private $id;
    private $nombre;
    private $estado;
    private $fechareg;
    private $idcat;
        
    function __construct() {}

function getId() {
    return $this->id;
}

function getNombre() {
    return $this->nombre;
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

function setEstado($estado) {
    $this->estado = $estado;
}

function setFechareg($fechareg) {
    $this->fechareg = $fechareg;
}

function getIdcat() {
    return $this->idcat;
}

function setIdcat($idcat) {
    $this->idcat = $idcat;
}




//------------------------------------------------------------------------------
   

    function listar(Subcategoria $sc){
       
        $con = Conectar();
        $sql = "SELECT * FROM listar_subcategoria_por_cat($sc->idcat)";
        
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
