<?php
include_once '../DAO/Conexion.php';

if(!isset($_SESSION)){
session_start();
}

class Servidor {
    
    private $id;
    private $hostname;
    private $ip;
    private $fechareg;
    private $estado;
        
    function __construct() {}
    
function getId() {
    return $this->id;
}

function getHostname() {
    return $this->hostname;
}

function getIp() {
    return $this->ip;
}

function setId($id) {
    $this->id = $id;
}

function setHostname($hostname) {
    $this->hostname = $hostname;
}

function setIp($ip) {
    $this->ip = $ip;
}

function getFechareg() {
    return $this->fechareg;
}

function setFechareg($fechareg) {
    $this->fechareg = $fechareg;
}
function getEstado() {
    return $this->estado;
}

function setEstado($estado) {
    $this->estado = $estado;
}







//------------------------------------------------------------------------------
    function grabar(Servidor $s){
        
        $con =  Conectar();
        $sql = "SELECT * FROM servidor_insertar('$s->hostname','$s->ip')";
//        var_dump($sql);
//        exit();       
        $res = pg_query($con,$sql);
        $val = pg_fetch_result($res,0,0);
        if($val=='0'){
            $_SESSION['mensaje_servidor']="Error al registrar Servidor"; 
            return 0;
        }
        else{
            $_SESSION['mensaje_servidor']="Los datos se registraron satisfactoriamente"; 
            return $val;
        }
        }
        
    function actualizar(Servidor $s)
    {
        $con =  Conectar();
        $sql = "select * from servidor_editar('$s->hostname','$s->ip',$s->id)";
//        var_dump($sql);
//        exit();
        $res = pg_query($con,$sql);
        $val = pg_fetch_result($res,0,0);
        if($val=='0'){
            $_SESSION['mensaje_servidor']="Algun(os) datos ya estan registrados"; 
            return 0;
        }
        else{
            $_SESSION['mensaje_servidor']="Los datos se actualizaron satisfactoriamente"; 
            return 1;
        }
    }

    function listar(){
       
        $con = Conectar();
        $sql = "SELECT * FROM servidor_listar()";
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
        $sql = "SELECT * FROM servidor_listar_act()";
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
    
             function buscarPorId(Servidor $s){
        $con = Conectar();
        $sql = "SELECT * FROM servidor_buscar_por_id($s->id)";
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
                $_SESSION['servidor_idservidor'] = $a['servidor_idservidor'] ;
                $_SESSION['servidor_hostname'] = $a['servidor_hostname'];
                $_SESSION['servidor_ip'] = $a['servidor_ip'];
                $_SESSION['accion_servidor'] = 'editar';
                
            } 
         }
         else{
         return null;
         }
    }
         function buscar(Servidor $s)
    {
         $con = Conectar();
         $sql = "SELECT * FROM servidor_buscar('%$s->hostname%','%$s->ip%','$s->estado','$s->fechareg')";
     
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
     function anular(Servidor $s){
        $con = Conectar();
        $sql = "SELECT * FROM servidor_anular('$s->estado',$s->id)";  
        pg_query($con,$sql); 
    } 
    
    
        }
