<?php
include_once '../DAO/Conexion.php';

if(!isset($_SESSION)){
session_start();
}

class Privilegio {
    
    private $id;
    private $idusu;
    private $idmenu;
    private $nombrepriv;
    private $nombreusu;
    private $idrol;
    private $estado;
    private $fecha_registro;
    
    function __construct() {}
    
function getId() {
    return $this->id;
}

function getIdusu() {
    return $this->idusu;
}

function getIdmenu() {
    return $this->idmenu;
}

function setId($id) {
    $this->id = $id;
}

function setIdusu($idusu) {
    $this->idusu = $idusu;
}

function setIdmenu($idmenu) {
    $this->idmenu = $idmenu;
}

function getNombrepriv() {
    return $this->nombrepriv;
}

function setNombrepriv($nombrepriv) {
    $this->nombrepriv = $nombrepriv;
}
public function getNombreusu() {
    return $this->nombreusu;
}

public function setNombreusu($nombreusu) {
    $this->nombreusu = $nombreusu;
}
public function getIdrol() {
    return $this->idrol;
}

public function setIdrol($idrol) {
    $this->idrol = $idrol;
}

public function getEstado() {
    return $this->estado;
}

public function getFecha_registro() {
    return $this->fecha_registro;
}

public function setEstado($estado) {
    $this->estado = $estado;
}

public function setFecha_registro($fecha_registro) {
    $this->fecha_registro = $fecha_registro;
}



 


//------------------------------------------------------------------------------
   

    function grabar(Privilegio $priv){
        $con =  Conectar();
        $sql = "SELECT * FROM privilegio_insertar($priv->idusu,$priv->idmenu)";
        $res = pg_query($con,$sql);
        $val = pg_fetch_result($res,0,0);
        if($val=='0'){
            $_SESSION['mensaje_privilegio']="El Nombre Ingresado ya esta Registrado"; 
            return 0;
        }
        else{
            $_SESSION['mensaje_privilegio']="Los datos se registraron satisfactoriamente"; 
            return 1;
        }
    }
    
    function listar($idusua){
       
        $con = Conectar();
        $sql = "SELECT * FROM listar_privilegios_por_usuario($idusua)";
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
    
     function eliminar(Privilegio $priv)
    {
        $con = Conectar();
        $sql = "select * from priv_eliminar($priv->idusu)";
        pg_query($con,$sql);
    }
    
    
    function buscar(Privilegio $priv)
    {
         $con = Conectar();
         $sql = "SELECT * FROM usu_buscar_priv('%$priv->nombreusu%',$priv->idrol,$priv->idmenu,'$priv->estado','$priv->fecha_registro')";
     
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
