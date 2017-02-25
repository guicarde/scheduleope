<?php
include_once '../DAO/Conexion.php';

if(!isset($_SESSION)){
session_start();
}

class Categoria {
    
    private $id;
    private $nombrecat;
        
    function __construct() {}
    
function getId() {
    return $this->id;
}

function getNombrecat() {
    return $this->nombrecat;
}

function setId($id) {
    $this->id = $id;
}

function setNombrecat($nombrecat) {
    $this->nombrecat = $nombrecat;
}



//------------------------------------------------------------------------------
   

    function listar(){
       
        $con = Conectar();
        $sql = "SELECT * FROM categoria_listar()";
//        var_dump($sql);
//        exit();
        $res = pg_query($con,$sql);
        $array=null;
        while($fila = pg_fetch_assoc($res))
        {
                   $array[] = $fila;
        }
       
        if(count($array)!=0){
//            var_dump($array);
//            exit();
            return $array;
            
            
        }
        else{
            return null;
        }
    }
    
        }
