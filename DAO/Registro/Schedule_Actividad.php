<?php
include_once 'C:\xampp\htdocs\SistemaSchedule\DAO\Conexion.php';

if(!isset($_SESSION)){
session_start();
}

class Schedule_Actividad {
    
    private $id;
    private $idschedule;
    private $idactividad;
    private $estado;
    private $fecha;
    private $comentario;
    private $horain;
    private $horafin;
    private $idusu;
    private $idactasig;
    private $estar;
    
        
  function __construct() {}
    
function getId() {
    return $this->id;
}

function getIdschedule() {
    return $this->idschedule;
}

function getIdactividad() {
    return $this->idactividad;
}

function getEstado() {
    return $this->estado;
}

function getFecha() {
    return $this->fecha;
}

function setId($id) {
    $this->id = $id;
}

function setIdschedule($idschedule) {
    $this->idschedule = $idschedule;
}

function setIdactividad($idactividad) {
    $this->idactividad = $idactividad;
}

function setEstado($estado) {
    $this->estado = $estado;
}

function setFecha($fecha) {
    $this->fecha = $fecha;
}


function getComentario() {
    return $this->comentario;
}

function getHorain() {
    return $this->horain;
}

function getHorafin() {
    return $this->horafin;
}

function setComentario($comentario) {
    $this->comentario = $comentario;
}

function setHorain($horain) {
    $this->horain = $horain;
}

function setHorafin($horafin) {
    $this->horafin = $horafin;
}
function getIdusu() {
    return $this->idusu;
}

function setIdusu($idusu) {
    $this->idusu = $idusu;
}


function getIdactasig() {
    return $this->idactasig;
}

function setIdactasig($idactasig) {
    $this->idactasig = $idactasig;
}

function getEstar() {
    return $this->estar;
}

function setEstar($estar) {
    $this->estar = $estar;
}




//------------------------------------------------------------------------------
   
    function grabar(Schedule_Actividad $sa){
        
        $con =  Conectar();
        $sql = "SELECT * FROM schedule_act_insertar($sa->idschedule,$sa->idactividad,'1')";
     
        $res = pg_query($con,$sql);
//        $val = pg_fetch_result($res,0,0);
        
        }
        function insertar_comentario(Schedule_Actividad $sa){
                    
//        $duracionfin = $this->RestarHoras($sa->horain,$sa->horafin);
        $con = Conectar();
        $sql = "SELECT * FROM actividad_schedule_comentario($sa->id,'$sa->comentario',$sa->idusu,'$sa->estar')";
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
            function insertar_comentario_asig(Schedule_Actividad $sa){
                    
        $duracionfin = $this->RestarHoras($sa->horain,$sa->horafin);
        $con = Conectar();
        $sql = "SELECT * FROM actividad_schedule_comentario_asignado($sa->id,'$sa->comentario','$duracionfin',$sa->idusu,$sa->idactasig)";
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
    
          function buscar_actividad(Schedule $s)
    {
         $con = Conectar();
         $sql = "SELECT * FROM actividad_buscar_schedule('$s->fecha',$s->idsede,$s->idturno,$s->idturnob,$s->iddia)";
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
    
       function RestarHoras($horaini,$horafin)

{

	$horai=substr($horaini,0,2);

	$mini=substr($horaini,3,2);

	$segi=substr($horaini,6,2);

 

	$horaf=substr($horafin,0,2);

	$minf=substr($horafin,3,2);

	$segf=substr($horafin,6,2);

 

	$ini=((($horai*60)*60)+($mini*60)+$segi);

	$fin=((($horaf*60)*60)+($minf*60)+$segf);

 

	$dif=$fin-$ini;

 

	$difh=floor($dif/3600);

	$difm=floor(($dif-($difh*3600))/60);

	$difs=$dif-($difm*60)-($difh*3600);

	return date("H:i:s",mktime($difh,$difm,$difs));

}
    


    function asignar_act_apoyo(Schedule_Actividad $sa){
        
        $con =  Conectar();
        $sql = "SELECT * FROM actividad_schedule_asig_apoyo($sa->id,$sa->idusu)";
     
        $res = pg_query($con,$sql);
//        $val = pg_fetch_result($res,0,0);
        
        }
        
         function rechazar_act(Schedule_Actividad $sa){
        
        $con =  Conectar();
        $sql = "SELECT * FROM actividad_asig_rechazar($sa->id,$sa->idusu)";
     
        $res = pg_query($con,$sql);
//        $val = pg_fetch_result($res,0,0);
        
        } 
        
        }
