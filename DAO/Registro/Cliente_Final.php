<?php
include_once '../DAO/Conexion.php';

if(!isset($_SESSION)){
session_start();
}

class Cliente_Final {
    
    private $id;
    private $nombre;
    private $estado;
    private $fechareg;
        
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





//------------------------------------------------------------------------------
        function grabar(Cliente_Final $cf){
        
        $con =  Conectar();
        $sql = "SELECT * FROM cliente_fin_insertar('$cf->nombre')";
//        var_dump($sql);
//        exit();       
        $res = pg_query($con,$sql);
        $val = pg_fetch_result($res,0,0);
        if($val=='0'){
            $_SESSION['mensaje_clientefin']="Error al registrar Cliente Final"; 
            return 0;
        }
        else{
            $_SESSION['mensaje_clientefin']="Los datos se registraron satisfactoriamente"; 
            return $val;
        }
        }
        
    function actualizar(Cliente_Final $cf)
    {
        $con =  Conectar();
        $sql = "select * from cliente_fin_editar('$cf->nombre',$cf->id)";
//        var_dump($sql);
//        exit();
        $res = pg_query($con,$sql);
        $val = pg_fetch_result($res,0,0);
        if($val=='0'){
            $_SESSION['mensaje_clientefin']="Algun(os) datos ya estan registrados"; 
            return 0;
        }
        else{
            $_SESSION['mensaje_clientefin']="Los datos se actualizaron satisfactoriamente"; 
            return 1;
        }
    }

    function listar(){
       
        $con = Conectar();
        $sql = "SELECT * FROM cliente_fin_listar()";
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
        $sql = "SELECT * FROM cliente_fin_listar_act()";
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
    
         function buscarPorId(Cliente_Final $cf){
        $con = Conectar();
        $sql = "SELECT * FROM cliente_fin_buscar_por_id($cf->id)";
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
                $_SESSION['clientefin_idclientefin'] = $a['clientefin_idclientefin'] ;
                $_SESSION['clientefin_nombre'] = $a['clientefin_nombre'];
                $_SESSION['clientefin_estado'] = $a['clientefin_estado'];
                $_SESSION['clientefin_fecharegistro'] = $a['clientefin_fecharegistro'];
                $_SESSION['accion_clientefin'] = 'editar';
                
            } 
         }
         else{
         return null;
         }
    }
         function buscar(Cliente_Final $cf)
    {
         $con = Conectar();
         $sql = "SELECT * FROM cliente_fin_buscar('%$cf->nombre%','$cf->estado','$cf->fechareg')";
     
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
     function anular(Cliente_Final $cf){
        $con = Conectar();
        $sql = "SELECT * FROM cliente_fin_anular('$cf->estado',$cf->id)";  
        pg_query($con,$sql); 
    } 
    
        }
