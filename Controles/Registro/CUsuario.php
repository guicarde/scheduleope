<?php
session_start();
include_once '../../DAO/Conexion.php';
include_once '../../DAO/Registro/Usuario.php';

$direccionInicio = "location:../../Vistas/index.php";
$direccionMantener = "location: ../../Vistas/MantenerUsuario.php";
$direccionGuardar = "location: ../../Vistas/GuardarUsuario.php";

if(isset($_POST['hidden_usuario']))
{
   
    $accion = $_POST['hidden_usuario'];

    if($accion=='save')
    {   
        
        if(isset($_SESSION['accion_usuario']))
            {
                 if($_SESSION['accion_usuario']=='editar')
                 {
                    $nombrearchivo = $_FILES['fileArchivo']['name'];
                    move_uploaded_file($_FILES['fileArchivo']['tmp_name'], "Fotos/" . $nombrearchivo);
                    $id = $_POST['idusu'];
                    $nombreusu     = trim(strtoupper($_POST['t_nombre'])); 
                    $apeusuario     = trim(strtoupper($_POST['t_apellidos'])); 
                    $numdoc     = trim(strtoupper($_POST['t_numdoc']));
                    $usuario     = trim(strtoupper($_POST['t_nomusu']));
                    $estado  =$_POST['c_estado'];
                    $email_inst  =trim($_POST['t_correo_inst']);   
                    $rol = $_POST['c_rol'];   
                    
                    $ob_usuario = new Usuario();
                    $ob_usuario->setId($id);
                    $ob_usuario->setNombreusu($nombreusu);
                    $ob_usuario->setApeusuario($apeusuario);
                    $ob_usuario->setNumdoc($numdoc);
                    $ob_usuario->setUsuario($usuario);
                    $ob_usuario->setEstado($estado);
                    $ob_usuario->setEmail_inst($email_inst);
                    $ob_usuario->setRol($rol);
                    $ob_usuario->setFoto($nombrearchivo);
                    
                    $valor = $ob_usuario->actualizar($ob_usuario);
                    if($valor==1){
                    header($direccionMantener);    
                    }
                    else{
                    header($direccionGuardar);
                    }
                 }
                 else
                 {
                    $nombrearchivo = $_FILES['fileArchivo']['name'];
                    move_uploaded_file($_FILES['fileArchivo']['tmp_name'], "Fotos/" . $nombrearchivo);
                    $nombreusu     = trim(strtoupper($_POST['t_nombre'])); 
                    $apeusuario     = trim(strtoupper($_POST['t_apellidos']));  
                    $numdoc     = trim(strtoupper($_POST['t_numdoc']));
                    $usuario     = trim(strtoupper($_POST['t_nomusu']));
                    $estado  =$_POST['c_estado'];
                    $email_inst  =trim($_POST['t_correo_inst']); 
                    $rol = $_POST['c_rol'];                    
                    
                    $ob_usuario = new Usuario();
                    $ob_usuario->setNombreusu($nombreusu);
                    $ob_usuario->setApeusuario($apeusuario);
                    $ob_usuario->setNumdoc($numdoc);
                    $ob_usuario->setUsuario($usuario);
                    $ob_usuario->setEstado($estado);
                    $ob_usuario->setEmail_inst($email_inst);
                    $ob_usuario->setRol($rol);
                    $ob_usuario->setFoto($nombrearchivo);
            
            
                    $ob_usuario->grabar($ob_usuario);
                    header("location: ../../Vistas/MantenerUsuario.php");
                 }
           }
           else 
            {
                    $nombrearchivo = $_FILES['fileArchivo']['name'];
                    move_uploaded_file($_FILES['fileArchivo']['tmp_name'], "Fotos/" . $nombrearchivo);
                    $nombreusu     = trim(strtoupper($_POST['t_nombre'])); 
                    $apeusuario     = trim(strtoupper($_POST['t_apellidos']));  
                    $numdoc     = trim(strtoupper($_POST['t_numdoc']));
                    $usuario     = trim(strtoupper($_POST['t_nomusu']));
                    $estado  =$_POST['c_estado'];
                    $email_inst  =trim($_POST['t_correo_inst']); 
                    $rol = $_POST['c_rol'];                    
                    
                    $ob_usuario = new Usuario();
                    $ob_usuario->setNombreusu($nombreusu);
                    $ob_usuario->setApeusuario($apeusuario);
                    $ob_usuario->setNumdoc($numdoc);
                    $ob_usuario->setUsuario($usuario);
                    $ob_usuario->setEstado($estado);
                    $ob_usuario->setEmail_inst($email_inst);
                    $ob_usuario->setRol($rol);
                    $ob_usuario->setFoto($nombrearchivo);
            
            
                    $ob_usuario->grabar($ob_usuario);
                    header("location: ../../Vistas/MantenerUsuario.php");
        
            }
        }
    
     else if($accion=='buscar')
    {
           
            
        $dato = trim(strtoupper($_POST['t_nombre']));
        $apeusuario = trim(strtoupper($_POST['t_apellidos']));
        $numdoc = trim(strtoupper($_POST['t_numdoc']));
        $rol = $_POST['c_rol'];
        $estado = $_POST['c_estado'];
        $fechareg=trim(strtoupper($_POST['t_fecha_reg']));
        
        $ob_usuario = new Usuario();
        $ob_usuario->setNombreusu($dato);
        $ob_usuario->setApeusuario($apeusuario);
        $ob_usuario->setNumdoc($numdoc);
        $ob_usuario->setRol($rol);
        $ob_usuario->setEstado($estado);
        $ob_usuario->setFecha_registro($fechareg);
         
        $arreglo = $ob_usuario->buscar($ob_usuario);
        
        $_SESSION['arreglo_buscado_usuario'] = $arreglo;
        $_SESSION['accion_usuario'] = 'busqueda';
        header("location: ../../Vistas/MantenerUsuario.php");
    }
    
     else if($accion=='buscarid')
     {
        $id_dato = $_POST['idusu'];
        $ob_usuario = new Usuario();
        $ob_usuario->setId($id_dato); 
        $ob_usuario->buscarPorId($ob_usuario);
        $_SESSION['accion_usuario']='editar';
        unset($_SESSION['arreglo_buscado_usuario']);
        header("location: ../../Vistas/GuardarUsuario.php");
     }
     
    else if($accion == 'anular'){
        $id_usuario_eliminar = $_POST['id_hidden_eliminar'];
        $id_usuario_estado = $_POST['hidden_estado'];
        $ob_usuario = new Usuario();
        $ob_usuario->setId($id_usuario_eliminar);
        $ob_usuario->setEstado($id_usuario_estado);
        $ob_usuario->anular($ob_usuario);
        
        $arreglo=$ob_usuario->listar();
        $_SESSION['arreglo_buscado_usuario'] = $arreglo;
        header("location: ../../Vistas/MantenerUsuario.php");
         }
    else if($accion == 'cambiarcontrasenia'){
        $pass = md5($_POST['t_contrasenia']);
        $id_usuario = $_POST['idusu'];
        $ob_usuario = new Usuario();
        $ob_usuario->setId($id_usuario);
        $ob_usuario->setContrasenia($pass);
        $valor=$ob_usuario->cambiar_pass($ob_usuario);
        $_SESSION = array();
        header("location: ../../Vistas/index.php");
         }
         
     else if($accion == 'cancelar_guardar'){
         
        //quita datos de la sesion
        $_SESSION['usu_idusu']="";
        $_SESSION['usu_nombres_usuario']="";
        $_SESSION['usu_apellidos_usuario']=""; 
        $_SESSION['usu_numdoc_usuario']="";
        $_SESSION['usu_nom_usuario']="";
        $_SESSION['usu_contrasenia']="";
        $_SESSION['usu_estado']="";
        $_SESSION['usu_email_institucional']="";
        $_SESSION['usu_fecharegistro']="";
        $_SESSION['rol_idrol']="";
        unset($_SESSION['arreglo_buscado_usuario']);
        unset($_SESSION['accion_usuario']);
        header("location: ../../Vistas/MantenerUsuario.php");
    }
    else if($accion == 'cancelar_mant_usua'){
        
        //quita datos de la sesion
        $_SESSION['usu_idusu']="";
        $_SESSION['usu_nombres_usuario']="";
        $_SESSION['usu_apellidos_usuario']=""; 
        $_SESSION['usu_numdoc_usuario']="";
        $_SESSION['usu_nom_usuario']="";
        $_SESSION['usu_contrasenia']="";
        $_SESSION['usu_estado']="";
        $_SESSION['usu_email_institucional']="";
        $_SESSION['usu_fecharegistro']="";
        $_SESSION['rol_idrol']="";
        unset($_SESSION['arreglo_buscado_usuario']);
        unset($_SESSION['accion_usuario']);

        header("location: ../../Vistas/GuardarUsuario.php");
    }    
    
     else if($accion == 'agregar_mantenimiento'){
        //quita datos de la sesion
        $_SESSION['usu_idusu']="";
        $_SESSION['usu_nombres_usuario']="";
        $_SESSION['usu_apellidos_usuario']=""; 
        $_SESSION['usu_tipdoc_usuario']=""; 
        $_SESSION['usu_numdoc_usuario']="";
        $_SESSION['usu_nom_usuario']="";
        $_SESSION['usu_contrasenia']="";
        $_SESSION['usu_estado']="";
        $_SESSION['usu_email_institucional']="";
        $_SESSION['usu_fecharegistro']="";
        
        unset($_SESSION['arreglo_buscado_usuario']);
        unset($_SESSION['accion_usuario']);
        header("location: ../../Vistas/Registros/serv_GuardarUsuario.php");
    }
    else if($accion == 'eliminar')
    {
        $id_usuario_eliminar = $_POST['id_hidden_eliminar'];
        $nombre_usuario_eliminar = $_POST['nombre_hidden_eliminar'];
        $ob_usuario = new Usuario();
        $ob_usuario->setId($id_usuario_eliminar);
        $ob_usuario->setNombreusu($nombre_usuario_eliminar);
        $contador=$ob_usuario->eliminar($ob_usuario);
        header($direccionMantener);   
           
    }
    else if($accion == 'irInicio'){
        //quita datos de la sesion
        $_SESSION['usu_idusu']="";
        $_SESSION['usu_nombres_usuario']="";
        $_SESSION['usu_apellidos_usuario']=""; 
        $_SESSION['usu_tipdoc_usuario']=""; 
        $_SESSION['usu_numdoc_usuario']="";
        $_SESSION['usu_nom_usuario']="";
        $_SESSION['usu_contrasenia']="";
        $_SESSION['usu_estado']="";
        $_SESSION['usu_email_institucional']="";
        $_SESSION['usu_fecharegistro']="";
        
        unset($_SESSION['arreglo_buscado_usuario']);
        unset($_SESSION['accion_usuario']);
        header($direccionInicio);
    }
    else if($accion == 'irMantener'){
        //quita datos de la sesion
        $_SESSION['usu_idusu']="";
        $_SESSION['usu_nombres_usuario']="";
        $_SESSION['usu_apellidos_usuario']=""; 
        $_SESSION['usu_tipdoc_usuario']=""; 
        $_SESSION['usu_numdoc_usuario']="";
        $_SESSION['usu_nom_usuario']="";
        $_SESSION['usu_contrasenia']="";
        $_SESSION['usu_estado']="";
        $_SESSION['usu_email_institucional']="";
        $_SESSION['usu_fecharegistro']="";
        
        unset($_SESSION['arreglo_buscado_usuario']);
        unset($_SESSION['accion_usuario']);
        header($direccionMantener);
    }
    
   }
    
else 
{
    header("location: ../../Vistas/GuardarUsuario.php");
         
}