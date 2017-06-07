<?php
include_once '../DAO/Conexion.php';

if(!isset($_SESSION)){
session_start();
}

class Schedule {
    
    private $id;
    private $idsede;
    private $idturno;
    private $idturnob;
    private $idperiodo;
    private $iddia;
    private $estado;
    private $fecha;
    private $idsedeturno;
    private $idusu;
    private $idschedact;
    private $idschedope;
    private $firma;      
    private $idcliente;
    private $descripcion;
    
        
  function __construct() {}
    
function getId() {
    return $this->id;
}

function getIdsede() {
    return $this->idsede;
}

function getIdturno() {
    return $this->idturno;
}

function getIdperiodo() {
    return $this->idperiodo;
}

function getIddia() {
    return $this->iddia;
}

function setId($id) {
    $this->id = $id;
}

function setIdsede($idsede) {
    $this->idsede = $idsede;
}

function setIdturno($idturno) {
    $this->idturno = $idturno;
}

function setIdperiodo($idperiodo) {
    $this->idperiodo = $idperiodo;
}

function setIddia($iddia) {
    $this->iddia = $iddia;
}
function getEstado() {
    return $this->estado;
}

function getFecha() {
    return $this->fecha;
}

function setEstado($estado) {
    $this->estado = $estado;
}

function setFecha($fecha) {
    $this->fecha = $fecha;
}

function getIdturnob() {
    return $this->idturnob;
}

function setIdturnob($idturnob) {
    $this->idturnob = $idturnob;
}
function getIdsedeturno() {
    return $this->idsedeturno;
}

function setIdsedeturno($idsedeturno) {
    $this->idsedeturno = $idsedeturno;
}

function getIdusu() {
    return $this->idusu;
}

function setIdusu($idusu) {
    $this->idusu = $idusu;
}
function getIdschedact() {
    return $this->idschedact;
}

function getIdschedope() {
    return $this->idschedope;
}

function setIdschedact($idschedact) {
    $this->idschedact = $idschedact;
}

function setIdschedope($idschedope) {
    $this->idschedope = $idschedope;
}
function getFirma() {
    return $this->firma;
}

function setFirma($firma) {
    $this->firma = $firma;
}
function getIdcliente() {
    return $this->idcliente;
}

function setIdcliente($idcliente) {
    $this->idcliente = $idcliente;
}

function getDescripcion() {
    return $this->descripcion;
}

function setDescripcion($descripcion) {
    $this->descripcion = $descripcion;
}









//------------------------------------------------------------------------------
    function grabar(Schedule $s){
        
        $con =  Conectar();
        $sql = "SELECT * FROM schedule_insertar('$s->fecha',$s->idsedeturno,'1')";
        //var_dump($sql);
        //exit();
        $res = pg_query($con,$sql);
        $val = pg_fetch_result($res,0,0);
        if($val=='0'){
            $_SESSION['mensaje_schedule']="Error al registrar Schedule"; 
            return 0;
        }
        else{
            $_SESSION['mensaje_schedule']="Los datos se registraron satisfactoriamente"; 
            return $val;
        }
        }
       function insertar_act_sc_ope(Schedule $s){
        
        $con =  Conectar();
        $sql = "SELECT * FROM schedule_ope_insertar_act('','','','',$s->idschedact,$s->idschedope)";
     
        $res = pg_query($con,$sql);
//        $val = pg_fetch_result($res,0,0);
        
        }  
        
        function asignar_operador(Schedule $s){
        
        $con =  Conectar();
        $sql = "SELECT * FROM schedule_ope_insertar($s->id,$s->idusu)";
//        var_dump($sql);
//        exit();
        $res = pg_query($con,$sql);
        $val = pg_fetch_result($res,0,0);
        if($val=='0'){
            $_SESSION['mensaje_schedule']="Error al asignar Schedule al Operador"; 
            return 0;
        }
        else{
            $_SESSION['mensaje_schedule']="Los datos se registraron satisfactoriamente"; 
            return $val;
        }
        }
        
                function desasignar_schedule(Schedule $s){
        
        $con =  Conectar();
        $sql = "SELECT * FROM schedule_desasignar($s->id)";
//        var_dump($sql);
//        exit();
        $res = pg_query($con,$sql);
        $val = pg_fetch_result($res,0,0);
        if($val=='0'){
            $_SESSION['mensaje_schedule']="Error al desasignar Schedule al Operador"; 
            return 0;
        }
        else{
            $_SESSION['mensaje_schedule']="Los datos se registraron satisfactoriamente"; 
            return $val;
        }
        }
        
      function buscar_actividad_por_schedule(Schedule $s)
    {
         $con = Conectar();
         $sql = "SELECT * FROM actividad_por_schedule($s->id)";
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
      function listar(){
       
        $con = Conectar();
        $sql = "SELECT * FROM schedule_listar()";
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
          function listar_tareas_pendientes(){
       
        $con = Conectar();
        $sql = "SELECT * FROM tareas_pendientes_por_cerrar()";
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
    
        function listar_sin_asignar(){
       
        $con = Conectar();
        $sql = "SELECT * FROM schedule_listar_sin_asignar()";
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
    
            function listar_sc_por_usu(Schedule $s){
       
        $con = Conectar();
        $sql = "SELECT * FROM schedule_por_usuario($s->idusu)";
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
                function buscar_sc_por_usu(Schedule $s){
       
        $con = Conectar();
        $sql = "SELECT * FROM schedule_por_usuario_buscar($s->idusu,'$s->estado','$s->fecha')";
//                var_dump($sql);
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
    
                function listar_sc_activos(){
       
        $con = Conectar();
        $sql = "SELECT * FROM schedule_activos()";
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
                    function listar_sc_finalizados(){
       
        $con = Conectar();
        $sql = "SELECT * FROM schedule_finalizados()";
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
    
         function buscarPorId(Schedule $s){
       
        $con = pg_connect("host=jumbo.db.elephantsql.com port=5432 dbname=vvggesku user=vvggesku password=aSmF1ip7Fb_DltIN8C9EPT-hIY9apVd9") or die("PROBLEMAS AL LOGRAR CONEXIÓN");
        $sql = "SELECT * FROM schedule_buscar_por_id($s->id)";
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
         $sql = "SELECT * FROM actividad_buscar_schedule_c('$s->fecha',$s->idsedeturno,$s->iddia)";
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
    
             function reporte(Schedule $s)
    {
          $con = pg_connect("host=jumbo.db.elephantsql.com port=5432 dbname=vvggesku user=vvggesku password=aSmF1ip7Fb_DltIN8C9EPT-hIY9apVd9") or die("PROBLEMAS AL LOGRAR CONEXIÓN");
   
         //$con = Conectar();
         //echo 'SI conecta correctamente';
         //exit();
                 
         $sql = "SELECT * FROM schedule_reporte($s->id)";
     
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
                 function reporte_cierre(Schedule $s)
    {
         $con = pg_connect("host=jumbo.db.elephantsql.com port=5432 dbname=vvggesku user=vvggesku password=aSmF1ip7Fb_DltIN8C9EPT-hIY9apVd9") or die("PROBLEMAS AL LOGRAR CONEXIÓN");
   
         $sql = "SELECT * FROM schedule_reporte_cierre($s->id)";
     
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
    
                function listar_por_schedule_usu(Schedule $s)
    {
         $con = Conectar();
         $sql = "SELECT * FROM actividad_por_schedule_usu($s->id)";
         
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
                  function listar_por_schedule_usu_noche(Schedule $s)
    {
         $con = Conectar();
         $sql = "SELECT * FROM actividad_por_schedule_usu_noche($s->id)";
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
           function listar_por_schedule_usu_dia(Schedule $s)
    {
         $con = Conectar();
         $sql = "SELECT * FROM actividad_por_schedule_usu_dia($s->id)";
         
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
    
                    function listar_por_schedule_activo(Schedule $s)
    {
         $con = Conectar();
         $sql = "SELECT * FROM actividad_por_schedule_activo($s->id)";
         
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
                    function listar_act_ventana_maxima(Schedule $s)
    {
         $con = Conectar();
         $sql = "SELECT * FROM actividad_por_schedule_usu_ventana_max($s->id)";
         var_dump($sql);
         exit();
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
    
                    function filtrar_por_schedule_usu_dia(Schedule $s)
    {
         $con = Conectar();
         $sql = "SELECT * FROM actividad_por_schedule_usu_filtrar_dia($s->idcliente,'$s->estado','%$s->descripcion%',$s->id)";
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
    
                        function filtrar_por_schedule_usu_noche(Schedule $s)
    {
         $con = Conectar();
         $sql = "SELECT * FROM actividad_por_schedule_usu_filtrar_noche($s->idcliente,'$s->estado','%$s->descripcion%',$s->id)";
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
    
                        function filtrar_por_schedule_usu_tarde_noche(Schedule $s)
    {
         $con = Conectar();
         $sql = "SELECT * FROM actividad_por_schedule_usu_filtrar_tarde_noche($s->idcliente,'$s->estado','%$s->descripcion%',$s->id)";
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
    
            function iniciar_tarea(Schedule $s){
       
        $con = Conectar();
        $sql = "SELECT * FROM actividad_schedule_iniciar($s->idschedact,$s->idusu)";
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

    
    
                function finalizar_tarea(Schedule $s){
       
        $con = Conectar();
        $sql = "SELECT * FROM actividad_schedule_finalizar($s->idschedact,$s->idusu)";
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
                  function cerrar_schedule(Schedule $s){
       
        $con = Conectar();
        $sql = "SELECT * FROM actividad_cerrar_schedule($s->id,'$s->firma',$s->idusu)";
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
    
         function sched_pendiente_por_fin(){
        $con =  Conectar();
        $sql = "SELECT * FROM schedules_pendientes_por_fin()";
//        var_dump($sql);
//        exit();
        $res = pg_query($con,$sql);
        $val = pg_fetch_result($res,0,0);
//        if($val!='0'){
//            $_SESSION['mensaje_entrega_doc']="El Nombre Ingresado ya esta Registrado"; 
            return $val;
//        }        
    }
             function act_asig_a_usuario(Schedule $s){
        $con =  Conectar();
        $sql = "SELECT * FROM actividades_asignadas($s->idusu)";

        $res = pg_query($con,$sql);
        $val = pg_fetch_result($res,0,0);
//        if($val!='0'){
//            $_SESSION['mensaje_entrega_doc']="El Nombre Ingresado ya esta Registrado"; 
            return $val;
//        }        
    }
             function sched_pendiente_detalle(){
        $con = Conectar();
        $sql = "SELECT * FROM schedules_pendientes_detalle()";
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
    }         function act_asig_detalle(Schedule $s){
        $con = Conectar();
        $sql = "SELECT * FROM actividades_asig_det_por_usu($s->idusu)";
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
    } function act_asig_para_usuario(Schedule $s){
        $con = Conectar();
        $sql = "SELECT * FROM actividades_asig_detalle($s->idusu)";
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
    
      function tomar_actividad(Schedule $s){
        
        $con =  Conectar();
        $sql = "SELECT * FROM actividad_tomar_tarea($s->id,$s->idusu)";
     
        $res = pg_query($con,$sql);
//        $val = pg_fetch_result($res,0,0);
        
        }
    function elimina_schedule(Schedule $s){
        
        $con =  Conectar();
        $sql = "SELECT * FROM schedule_eliminar($s->id)";
     
        $res = pg_query($con,$sql);
//        $val = pg_fetch_result($res,0,0);
        
        }
    
    
        }

        
        
