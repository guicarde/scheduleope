<?php
include_once '../DAO/Conexion.php';

if(!isset($_SESSION)){
session_start();
}

class Rol {
    
    private $id;
    private $nombrerol;
        
    function __construct() {}
    
public function getId() {
    return $this->id;
}

public function getNombrerol() {
    return $this->nombrerol;
}

public function setId($id) {
    $this->id = $id;
}

public function setNombrerol($nombrerol) {
    $this->nombrerol = $nombrerol;
}


//------------------------------------------------------------------------------
   

    function listar(){
       
        $con = Conectar();
        $sql = "SELECT * FROM rol_listar()";
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
