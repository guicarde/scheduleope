<?php
include_once '../DAO/Conexion.php';

if(!isset($_SESSION)){
session_start();
}

class Actividad {
    
    private $id;
    private $tipo;
    private $horaejec;
    private $horatermino;
    private $duracion;
    private $interturno;
    private $excepcion;
    private $descripcion;
    private $horalimite;
    private $plataforma;
    private $tws;
    private $tiporespaldo;
    private $subcategoria;
    private $idperiodo;
    private $idsede;
    private $idturno;
    private $idprocedimiento;
    private $idcliente;
    private $idservidor;
    private $estado;
    private $fechareg;
    private $idcategoria;
    private $comentario;
    private $ventana;
    private $accion;
    private $tipoproceso;
    private $idtipoact;
    private $iddia;
    
        
    function __construct() {}
    
function getId() {
    return $this->id;
}

function getTipo() {
    return $this->tipo;
}

function getHoraejec() {
    return $this->horaejec;
}

function getInterturno() {
    return $this->interturno;
}

function getExcepcion() {
    return $this->excepcion;
}

function getDescripcion() {
    return $this->descripcion;
}

function getHoralimite() {
    return $this->horalimite;
}

function getPlataforma() {
    return $this->plataforma;
}

function getTws() {
    return $this->tws;
}

function getTiporespaldo() {
    return $this->tiporespaldo;
}

function getSubcategoria() {
    return $this->subcategoria;
}

function getIdperiodo() {
    return $this->idperiodo;
}

function getIdsede() {
    return $this->idsede;
}

function getIdturno() {
    return $this->idturno;
}

function getIdprocedimiento() {
    return $this->idprocedimiento;
}

function getIdcliente() {
    return $this->idcliente;
}

function getIdservidor() {
    return $this->idservidor;
}

function getEstado() {
    return $this->estado;
}

function getFechareg() {
    return $this->fechareg;
}

function setId($id) {
    $this->id = $id;
}

function setTipo($tipo) {
    $this->tipo = $tipo;
}

function setHoraejec($horaejec) {
    $this->horaejec = $horaejec;
}

function setInterturno($interturno) {
    $this->interturno = $interturno;
}

function setExcepcion($excepcion) {
    $this->excepcion = $excepcion;
}

function setDescripcion($descripcion) {
    $this->descripcion = $descripcion;
}

function setHoralimite($horalimite) {
    $this->horalimite = $horalimite;
}

function setPlataforma($plataforma) {
    $this->plataforma = $plataforma;
}

function setTws($tws) {
    $this->tws = $tws;
}

function setTiporespaldo($tiporespaldo) {
    $this->tiporespaldo = $tiporespaldo;
}

function setSubcategoria($subcategoria) {
    $this->subcategoria = $subcategoria;
}

function setIdperiodo($idperiodo) {
    $this->idperiodo = $idperiodo;
}

function setIdsede($idsede) {
    $this->idsede = $idsede;
}

function setIdturno($idturno) {
    $this->idturno = $idturno;
}

function setIdprocedimiento($idprocedimiento) {
    $this->idprocedimiento = $idprocedimiento;
}

function setIdcliente($idcliente) {
    $this->idcliente = $idcliente;
}

function setIdservidor($idservidor) {
    $this->idservidor = $idservidor;
}

function setEstado($estado) {
    $this->estado = $estado;
}

function setFechareg($fechareg) {
    $this->fechareg = $fechareg;
}
function getIdcategoria() {
    return $this->idcategoria;
}

function setIdcategoria($idcategoria) {
    $this->idcategoria = $idcategoria;
}
function getHoratermino() {
    return $this->horatermino;
}

function getDuracion() {
    return $this->duracion;
}

function setHoratermino($horatermino) {
    $this->horatermino = $horatermino;
}

function setDuracion($duracion) {
    $this->duracion = $duracion;
}

function getComentario() {
    return $this->comentario;
}

function getVentana() {
    return $this->ventana;
}

function getAccion() {
    return $this->accion;
}

function setComentario($comentario) {
    $this->comentario = $comentario;
}

function setVentana($ventana) {
    $this->ventana = $ventana;
}

function setAccion($accion) {
    $this->accion = $accion;
}
function getTipoproceso() {
    return $this->tipoproceso;
}

function setTipoproceso($tipoproceso) {
    $this->tipoproceso = $tipoproceso;
}

function getIdtipoact() {
    return $this->idtipoact;
}

function setIdtipoact($idtipoact) {
    $this->idtipoact = $idtipoact;
}
function getIddia() {
    return $this->iddia;
}

function setIddia($iddia) {
    $this->iddia = $iddia;
}





//------------------------------------------------------------------------------

    function grabarExcel($a,$b,$c,$d,$e,$f,$g,$h,$i,$j,$k,$l,$m,$n,$o,$p,$q,$r,$s,$t,$u,$v,$w,$y)
    {
        $duracion = $this->RestarHoras($e,$k);
        
        $con = Conectar();
        $sql = "SELECT * FROM actividad_insertar_excel_d('$c','$d','$e','$f','$g','$h','%$i%','$j','$k','$l','$m','$n','$o','$p','$q','$r','$s','$t','$duracion','$u','$v','$w','$y') ";
//        var_dump($sql);
//        exit();
        $res = pg_query($con,$sql);
        return pg_fetch_result($res,0,0);
    }




    function grabar(Actividad $a){
        
        $con =  Conectar();
        $sql = "SELECT * FROM actividad_insertar('$a->tipo','$a->horaejec','$a->interturno','$a->excepcion','$a->descripcion','$a->horalimite','$a->plataforma','$a->tws','$a->tiporespaldo',$a->idperiodo,$a->idsede,$a->idprocedimiento,$a->idcliente,$a->idservidor,'1',$a->idcategoria,'$a->horatermino','$a->duracion','$a->comentario','$a->ventana','$a->accion','$a->tipoproceso',$a->idtipoact)";
        //var_dump($sql);
        //exit();       
        $res = pg_query($con,$sql);
        $val = pg_fetch_result($res,0,0);
        if($val=='0'){
            $_SESSION['mensaje_actividad']="Error al registrar periodo"; 
            return 0;
        }
        else{
            $_SESSION['mensaje_actividad']="Los datos se registraron satisfactoriamente";
            return $val;
        }
        }
        function actualizar(Actividad $a){
        
        $con =  Conectar();
        $sql = "SELECT * FROM actividad_editar('$a->tipo','$a->horaejec','$a->interturno','$a->excepcion','$a->descripcion','$a->horalimite','$a->plataforma','$a->tws','$a->tiporespaldo',$a->idperiodo,$a->idsede,$a->idprocedimiento,$a->idcliente,$a->idservidor,'1',$a->idcategoria,'$a->horatermino','$a->duracion','$a->comentario','$a->ventana','$a->accion','$a->tipoproceso',$a->id,$a->idtipoact)";
    //    var_dump($sql);
    //    exit();       
        $res = pg_query($con,$sql);
        $val = pg_fetch_result($res,0,0);
        if($val=='0'){
            $_SESSION['mensaje_actividad']="Error al registrar periodo"; 
            return 0;
        }
        else{
            $_SESSION['mensaje_actividad']="Los datos se registraron satisfactoriamente";
            return $val;
        }
        }
     function listar(){
       
        $con = Conectar();
        $sql = "SELECT * FROM actividad_listar()";
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
	         function listar_india(){
       
        $con = Conectar();
        $sql = "SELECT * FROM schedule_india_prueba()";
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
    
         function listar_tipo_actividad(){
       
        $con = Conectar();
        $sql = "SELECT * FROM tipo_actividad_listar()";
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
    
          function buscar(Actividad $a)
    {
         $con = Conectar();
         $sql = "SELECT * FROM actividad_buscar($a->idperiodo,$a->idcliente,'$a->estado','$a->fechareg','%$a->descripcion%',$a->idservidor,$a->idprocedimiento,$a->idturno,$a->iddia)";
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

function anular(Actividad $a){
        $con = Conectar();
        $sql = "SELECT * FROM actividad_anular('$a->estado',$a->id)";  
        pg_query($con,$sql); 
    }

function cambiar_tws(Actividad $a){
    $con = Conectar();
    $sql = "SELECT * FROM actividad_tws('$a->estado',$a->id)"; 
//            var_dump($sql);
//        exit();
    pg_query($con,$sql); 
}
    
function buscarPorId(Actividad $a){
        $con = Conectar();
        $sql = "SELECT * FROM actividad_buscar_por_id($a->id)";
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
                $_SESSION['actividad_idactividad'] = $a['actividad_idactividad'] ;
                $_SESSION['actividad_tipo'] = $a['actividad_tipo'] ;
                $_SESSION['actividad_horaejecucion'] = $a['actividad_horaejecucion'];
                $_SESSION['actividad_interturno'] = $a['actividad_interturno'];
                $_SESSION['actividad_excepcion'] = $a['actividad_excepcion'];
                $_SESSION['actividad_descripcion'] = $a['actividad_descripcion'];
                $_SESSION['actividad_horalimite'] = $a['actividad_horalimite'];
                $_SESSION['actividad_plataforma'] = $a['actividad_plataforma'];
                $_SESSION['actividad_tiporespaldo'] = $a['actividad_tiporespaldo'];
                $_SESSION['periodo_idperiodo'] = $a['periodo_idperiodo'];
                $_SESSION['procedimiento_idprocedimiento'] = $a['procedimiento_idprocedimiento'];
                $_SESSION['cliente_idcliente'] = $a['cliente_idcliente'];
                $_SESSION['servidor_idservidor'] = $a['servidor_idservidor'];
                $_SESSION['actividad_estado'] = $a['actividad_estado'];
                $_SESSION['actividad_fecharegistro'] = $a['actividad_fecharegistro'];
                $_SESSION['subcategoria_idsubcategoria'] = $a['subcategoria_idsubcategoria'];
                $_SESSION['actividad_horatermino'] = $a['actividad_horatermino'];
                $_SESSION['actividad_duracion'] = $a['actividad_duracion'];
                $_SESSION['actividad_tier'] = $a['actividad_tier'];
                $_SESSION['actividad_interacciones'] = $a['actividad_interacciones'];
                $_SESSION['actividad_tipoproceso'] = $a['actividad_tipoproceso'];
                $_SESSION['actividad_comentario'] = $a['actividad_comentario'];
                $_SESSION['actividad_ventana_max'] = $a['actividad_ventana_max'];
                $_SESSION['actividad_accion'] = $a['actividad_accion'];
                $_SESSION['actividad_tws'] = $a['actividad_tws'];
                $_SESSION['tipoactividad_idtipoactividad'] = $a['tipoactividad_idtipoactividad'];
                $_SESSION['accion_actividad'] = 'editar';
                
            } 
         }
         else{
         return null;
         }
    }
      function turno_por_actividad(Actividad $a){
       
        $con = Conectar();
        $sql = "SELECT * FROM turno_por_actividad($a->id)";
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
    function sede_por_actividad(Actividad $a){
        $con = Conectar();
        $sql = "SELECT * FROM sede_por_actividad($a->id)";
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
                $_SESSION['sede_idsede'] = $a['sede_idsede'] ;
                              
            } 
         }
         else{
         return null;
         }
    }
    
        function categoria_por_actividad(Actividad $a){
        $con = Conectar();
        $sql = "SELECT * FROM categoria_por_actividad($a->id)";
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
                $_SESSION['categoria_idcategoria'] = $a['categoria_por_actividad'] ;
                              
            } 
         }
         else{
         return null;
         }
    }
        }
