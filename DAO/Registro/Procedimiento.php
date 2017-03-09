<?php
include_once '../DAO/Conexion.php';

if(!isset($_SESSION)){
session_start();
}

class Procedimiento {
    
    private $id;
    private $nombre;
    private $archivo;
    private $estado; 
    private $fecha_registro;
   
    
    function __construct() {}
    
function getId() {
    return $this->id;
}

function getNombre() {
    return $this->nombre;
}

function getArchivo() {
    return $this->archivo;
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

function setNombre($nombre) {
    $this->nombre = $nombre;
}

function setArchivo($archivo) {
    $this->archivo = $archivo;
}

function setEstado($estado) {
    $this->estado = $estado;
}

function setFecha_registro($fecha_registro) {
    $this->fecha_registro = $fecha_registro;
}



//------------------------------------------------------------------------------
     function grabar(Procedimiento $p){
        
        $con =  Conectar();
        $sql = "SELECT * FROM procedimiento_insertar('$p->nombre','$p->archivo','1')";
//        var_dump($sql);
//        exit();       
        $res = pg_query($con,$sql);
        $val = pg_fetch_result($res,0,0);
        if($val=='0'){
            $_SESSION['mensaje_procedimiento']="Error al registrar Procedimiento"; 
            return 0;
        }
        else{
            $_SESSION['mensaje_procedimiento']="Los datos se registraron satisfactoriamente"; 
            return $val;
        }
        }
        
    function actualizar(Procedimiento $p)
    {
        $con =  Conectar();
        $sql = "select * from procedimiento_editar('$p->nombre','$p->archivo',$p->id)";
//        var_dump($sql);
//        exit();
        $res = pg_query($con,$sql);
        $val = pg_fetch_result($res,0,0);
        if($val=='0'){
            $_SESSION['mensaje_usuario']="Algun(os) datos ya estan registrados"; 
            return 0;
        }
        else{
            $_SESSION['mensaje_usuario']="Los datos se actualizaron satisfactoriamente"; 
            return 1;
        }
    }
     
      function listar(){
       
        $con = Conectar();
        $sql = "SELECT * FROM procedimiento_listar()";
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
    
          function listar_act(){
       
        $con = Conectar();
        $sql = "SELECT * FROM procedimiento_listar_act()";
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
    
     function buscarPorId(Procedimiento $p){
        $con = Conectar();
        $sql = "SELECT * FROM procedimiento_buscar_por_id($p->id)";
//        var_dump($sql);
//        exit();
        $res = pg_query($con,$sql);
        $array = null;
        while($fila = pg_fetch_assoc($res))
        {
            $array[]=$fila;
        }
         if(count($array)!=0)
         {
            
          foreach($array as $a)
            {
                $_SESSION['procedimiento_idprocedimiento'] = $a['procedimiento_idprocedimiento'] ;
                $_SESSION['procedimiento_nombre'] = $a['procedimiento_nombre'];
                $_SESSION['procedimiento_archivo'] = $a['procedimiento_archivo'];
                $_SESSION['procedimiento_estado'] = $a['procedimiento_estado'];
                $_SESSION['accion_procedimiento'] = 'editar';
                
            } 
         }
         else{
         return null;
         }
    }
         function buscar(Procedimiento $p)
    {
         $con = Conectar();
         $sql = "SELECT * FROM procedimiento_buscar('%$p->nombre%','$p->estado','$p->fecha_registro')";
     
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
     function anular(Procedimiento $p){
        $con = Conectar();
        $sql = "SELECT * FROM procedimiento_anular('$p->estado',$p->id)";  
        pg_query($con,$sql); 
    } 
    
}
