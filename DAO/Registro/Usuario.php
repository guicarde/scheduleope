<?php
 include_once '../Conexion.php';

if(!isset($_SESSION)){
session_start();
}

class Usuario {
    
    private $id;
    private $nombreusu;
    private $apeusuario;
    private $numdoc;
    private $usuario;
    private $contrasenia;
    private $estado; 
    private $email_inst;
    private $fecha_registro;
    private $rol;
    private $foto;
    
    function __construct() {}
    
    public function getId() {
        return $this->id;
    }

    public function getNombreusu() {
        return $this->nombreusu;
    }

    public function getApeusuario() {
        return $this->apeusuario;
    }

    public function getNumdoc() {
        return $this->numdoc;
    }

    public function getUsuario() {
        return $this->usuario;
    }

    public function getContrasenia() {
        return $this->contrasenia;
    }

    public function getEstado() {
        return $this->estado;
    }

    public function getEmail_inst() {
        return $this->email_inst;
    }

    public function getFecha_registro() {
        return $this->fecha_registro;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setNombreusu($nombreusu) {
        $this->nombreusu = $nombreusu;
    }

    public function setApeusuario($apeusuario) {
        $this->apeusuario = $apeusuario;
    }

    public function setNumdoc($numdoc) {
        $this->numdoc = $numdoc;
    }

    public function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

    public function setContrasenia($contrasenia) {
        $this->contrasenia = $contrasenia;
    }

    public function setEstado($estado) {
        $this->estado = $estado;
    }

    public function setEmail_inst($email_inst) {
        $this->email_inst = $email_inst;
    }

    public function setFecha_registro($fecha_registro) {
        $this->fecha_registro = $fecha_registro;
    }
    public function getRol() {
        return $this->rol;
    }

    public function setRol($rol) {
        $this->rol = $rol;
    }
    
    function getFoto() {
        return $this->foto;
    }

    function setFoto($foto) {
        $this->foto = $foto;
    }


//------------------------------------------------------------------------------
    function grabar(Usuario $usu){
          
         $con = Conectar();
         
         $pass = md5('123456');
         
         //verificar si usuario esta registrado --------------------------------
         $sql = "SELECT * FROM usu_verificarexistencia('$usu->usuario')";
         
         $res = pg_query($con,$sql);
         $cont=0;
            while($fila = pg_fetch_assoc($res))
            {
                      $cont++;
            }
         ///--------------------------------------------------------------------   
         
         if($cont!=0)
         {
             $_SESSION['mensaje_usuario']='Este usuario ya está registrado';
             return 'error';
         }
         else
         {
            $sql = "select * from usu_insertar('$usu->nombreusu','$usu->apeusuario','$usu->numdoc','$usu->usuario','$pass','$usu->email_inst','$usu->estado',$usu->rol,'$usu->foto')";
//            var_dump($sql);
//            exit();
            pg_query($con,$sql);
            
            $_SESSION['mensaje_usuario']='Usuario registrado correctamente';
            
         }
    }
    
        function buscar(Usuario $usu)
    {
         $con = Conectar();
         $sql = "SELECT * FROM usu_buscar('%$usu->nombreusu%','%$usu->apeusuario%','$usu->numdoc',$usu->rol,'$usu->estado','$usu->fecha_registro')";
     
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
    
    
    

    function buscarPorId(Usuario $usu){
        $con = Conectar();
        $sql = "SELECT * FROM usu_buscar_por_id($usu->id)";
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
                $_SESSION['usu_idusu'] = $a['usu_idusu'] ;
                $_SESSION['usu_nombres_usuario'] = $a['usu_nombres_usuario'];
                $_SESSION['usu_apellidos_usuario'] = $a['usu_apellidos_usuario'];
                $_SESSION['usu_numdoc_usuario'] = $a['usu_numdoc_usuario'];
                $_SESSION['usu_nom_usuario'] = $a['usu_nom_usuario'];
                $_SESSION['usu_contrasenia'] = $a['usu_contrasenia'];
                $_SESSION['usu_estado'] = $a['usu_estado'];
                $_SESSION['usu_email_institucional'] = $a['usu_email_institucional'];
                $_SESSION['usu_fecharegistro'] = $a['usu_fecharegistro'];
                $_SESSION['rol_idrol'] = $a['rol_idrol'];
                $_SESSION['accion_usuario'] = 'editar';
            } 
         }
         else{
         return null;
         }
    }
    
  
   function anular(Usuario $usu){
        $con = Conectar();
        $sql = "SELECT * FROM usu_anular('$usu->estado',$usu->id)";  
        pg_query($con,$sql); 
    } 

    function listar(){
       
        $con = Conectar();
        $sql = "SELECT * FROM usu_listar()";
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
        function listar_conectado(Usuario $usu){
       
        $con = Conectar();
        $sql = "SELECT * FROM usu_listar_conectados($usu->id)";
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
    
    function listar_sin_privilegios(){
       
        $con = Conectar();
        $sql = "SELECT * FROM usu_listar_sin_priv()";
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
    
    function actualizar(Usuario $usu)
    {
        $con =  Conectar();
        $sql = "select * from usu_editar('$usu->nombreusu','$usu->apeusuario','$usu->numdoc','$usu->usuario','$usu->email_inst','$usu->estado',$usu->id,$usu->rol,'$usu->foto')";
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
        function cambiar_pass(Usuario $usu)
    {
        $con =  Conectar();
        $sql = "select * from usu_cambiar_pass('$usu->contrasenia',$usu->id)";
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
 function eliminar(Usuario $usu)
    {
        $con = Conectar();
        $sql = "select * from usu_eliminar($usu->id)";
        pg_query($con,$sql);
    }
    
    function restablecerPass(Usuario $usu){
        $con = Conectar();
            $pass = md5('123456');
            $sql = "select * from usu_restablecer_pass($usu->id,'$pass')";
            pg_query($con,$sql);
            $_SESSION['mensaje_usuario']="Contraseña restablecida correctamente";
    }
    
     function conectado(Usuario $usu){
        $con = Conectar();
        $sql = "SELECT * FROM usu_sesion_conectado($usu->id)";  
        pg_query($con,$sql); 
    } 
         function desconectado(Usuario $usu){
        $con = Conectar();
        $sql = "SELECT * FROM usu_sesion_desconectado($usu->id)";  
        pg_query($con,$sql); 
    } 
    
}
