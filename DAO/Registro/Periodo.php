<?php
include_once '../DAO/Conexion.php';

if(!isset($_SESSION)){
session_start();
}

class Periodo {
    
    private $id;
    private $nombre;
    private $estado; 
    private $fecha_registro;
   
    
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

function getFecha_registro() {
    return $this->fecha_registro;
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

function setFecha_registro($fecha_registro) {
    $this->fecha_registro = $fecha_registro;
}


//------------------------------------------------------------------------------
     function grabar(Periodo $p){
        
        $con =  Conectar();
        $sql = "SELECT * FROM periodo_insertar('$p->nombre','1')";
//        var_dump($sql);
//        exit();       
        $res = pg_query($con,$sql);
        $val = pg_fetch_result($res,0,0);
        if($val=='0'){
            $_SESSION['mensaje_periodo']="Error al registrar periodo"; 
            return 0;
        }
        else{
            $_SESSION['mensaje_periodo']="Los datos se registraron satisfactoriamente"; 
            return $val;
        }
        }
         function actualizar(Periodo $p)
    {
        $con =  Conectar();
        $sql = "select * from periodo_editar('$p->nombre','1',$p->id)";
//        var_dump($sql);
//        exit();
        $res = pg_query($con,$sql);
        $val = pg_fetch_result($res,0,0);
        if($val=='0'){
            $_SESSION['mensaje_periodo']="Algun(os) datos ya estan registrados"; 
            return 0;
        }
        else{
            $_SESSION['mensaje_periodo']="Los datos se actualizaron satisfactoriamente"; 
            return $val;
        }
    }
     
      function listar(){
       
        $con = Conectar();
        $sql = "SELECT * FROM periodo_listar()";
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
        $sql = "SELECT * FROM periodo_listar_act()";
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
    
     function buscarPorId(Periodo $p){
        $con = Conectar();
        $sql = "SELECT * FROM periodo_buscar_por_id($p->id)";
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
                $_SESSION['periodo_idperiodo'] = $a['periodo_idperiodo'] ;
                $_SESSION['periodo_nombre'] = $a['periodo_nombre'];
                $_SESSION['periodo_estado'] = $a['periodo_estado'];
                $_SESSION['accion_periodo'] = 'editar';
            } 
         }
         else{
         return null;
         }
    }
         function buscar(Periodo $p)
    {
         $con = Conectar();
         $sql = "SELECT * FROM periodo_buscar('%$p->nombre%','$p->estado','$p->fecha_registro')";
     
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
     function anular(Periodo $p){
        $con = Conectar();
        $sql = "SELECT * FROM periodo_anular('$p->estado',$p->id)";  
        pg_query($con,$sql); 
    }
    
         function eliminar(Periodo $p)
    {
        $con = Conectar();
        $sql = "SELECT * FROM periodo_eliminar($p->id)";
        pg_query($con,$sql);
    }
    
}
