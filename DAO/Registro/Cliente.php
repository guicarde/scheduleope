<?php
include_once '../DAO/Conexion.php';

if(!isset($_SESSION)){
session_start();
}

class Cliente {
    
    private $id;
    private $nombre;
    private $estado;
    private $fechareg;
    private $idclifin;
    private $idschedule;
        
    function __construct() {}
    
function getId() {
    return $this->id;
}

function getNombre() {
    return $this->nombre;
}

function setId($id) {
    $this->id = $id;
}

function setNombre($nombre) {
    $this->nombre = $nombre;
}
function getEstado() {
    return $this->estado;
}

function getFechareg() {
    return $this->fechareg;
}

function setEstado($estado) {
    $this->estado = $estado;
}

function setFechareg($fechareg) {
    $this->fechareg = $fechareg;
}

function getIdclifin() {
    return $this->idclifin;
}

function setIdclifin($idclifin) {
    $this->idclifin = $idclifin;
}
function getIdschedule() {
    return $this->idschedule;
}

function setIdschedule($idschedule) {
    $this->idschedule = $idschedule;
}






//------------------------------------------------------------------------------
        function grabar(Cliente $c){
        
        $con =  Conectar();
        $sql = "SELECT * FROM cliente_insertar('$c->nombre',$c->idclifin)";
//        var_dump($sql);
//        exit();       
        $res = pg_query($con,$sql);
        $val = pg_fetch_result($res,0,0);
        if($val=='0'){
            $_SESSION['mensaje_cliente']="Error al registrar Cliente"; 
            return 0;
        }
        else{
            $_SESSION['mensaje_cliente']="Los datos se registraron satisfactoriamente"; 
            return $val;
        }
        }
        
    function actualizar(Cliente $c)
    {
        $con =  Conectar();
        $sql = "select * from cliente_editar('$c->nombre',$c->idclifin,$c->id)";
//        var_dump($sql);
//        exit();
        $res = pg_query($con,$sql);
        $val = pg_fetch_result($res,0,0);
        if($val=='0'){
            $_SESSION['mensaje_cliente']="Algun(os) datos ya estan registrados"; 
            return 0;
        }
        else{
            $_SESSION['mensaje_cliente']="Los datos se actualizaron satisfactoriamente"; 
            return 1;
        }
    }

    function listar(){
       
        $con = Conectar();
        $sql = "SELECT * FROM cliente_listar()";
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
    function listar_por_schedule(Cliente $c){
       
        $con = Conectar();
        $sql = "SELECT * FROM cliente_listar_por_schedule($c->idschedule)";
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
        $sql = "SELECT * FROM cliente_listar_act()";
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
    
         function buscarPorId(Cliente $c){
        $con = Conectar();
        $sql = "SELECT * FROM cliente_buscar_por_id($c->id)";
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
                $_SESSION['cliente_idcliente'] = $a['cliente_idcliente'] ;
                $_SESSION['clientefin_idclientefin'] = $a['clientefin_idclientefin'] ;
                $_SESSION['cliente_nombre'] = $a['cliente_nombre'];
                $_SESSION['accion_cliente'] = 'editar';
                
            } 
         }
         else{
         return null;
         }
    }
         function buscar(Cliente $c)
    {
         $con = Conectar();
         $sql = "SELECT * FROM cliente_buscar('%$c->nombre%',$c->idclifin,'$c->estado','$c->fechareg')";
         
//         var_dump($sql);
//         exit();
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
     function anular(Cliente $c){
        $con = Conectar();
        $sql = "SELECT * FROM cliente_anular('$c->estado',$c->id)";  
        pg_query($con,$sql); 
    } 
    
        }
