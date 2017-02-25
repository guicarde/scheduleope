<?php
session_start();
include_once '../../DAO/Conexion.php';
include_once '../../DAO/Registro/Privilegio.php';
//include_once '../../DAO/Registro/Menu.php';
include_once '../../DAO/Registro/Usuario.php';

$direccionInicio = "location:../../Vistas/index.php";
$direccionMantener = "location: ../../Vistas/MantenerPrivilegios.php";
$direccionGuardar = "location: ../../Vistas/AsignarPrivilegios.php";

if(isset($_POST['hidden_privilegio']))
{
   
    $accion = $_POST['hidden_privilegio'];
//    var_dump($accion);
//    exit();
    if($accion=='save')
    {   
        
        if(isset($_SESSION['accion_privilegio']))
            {
                 if($_SESSION['accion_privilegio']=='editar')
                 {
                    $idusu = $_POST['c_usuario'];
                    
                    $ob_privilegio = new Privilegio();
                    $ob_privilegio->setIdusu($idusu);
                    
                    $ob_privilegio->eliminar($ob_privilegio);
              
                    if(!empty($_POST['check_list'])) {
                    foreach($_POST['check_list'] as $selected) {
                    $ob_privilegios = new Privilegio();
                    
                    $ob_privilegios->setIdusu($idusu);
                    $ob_privilegios->setIdmenu($selected);                
                    $valor = $ob_privilegios->grabar($ob_privilegios);
                    }
                    }
                    
                    if ($valor == 1) {
                       header($direccionMantener);
                       unset($_SESSION['accion_privilegio']);
                       } else {
                       header($direccionMantener);
                       }
                        }
                 else
                 {
                    $idusu = $_POST['c_usuario'];
                    
                    $ob_privilegio = new Privilegio();
                    $ob_privilegio->setIdusu($idusu);
                    
                    $ob_privilegio->eliminar($ob_privilegio);
              
                    if(!empty($_POST['check_list'])) {
                    foreach($_POST['check_list'] as $selected) {
                    $ob_privilegios = new Privilegio();
                    
                    $ob_privilegios->setIdusu($idusu);
                    $ob_privilegios->setIdmenu($selected);                
                    $valor = $ob_privilegios->grabar($ob_privilegios);
                    }
                    }
                    
                    if ($valor == 1) {
                       header($direccionMantener);
                       unset($_SESSION['accion_privilegio']);
                       } else {
                       header($direccionGuardar);
                       }
                 }
           }
           else 
            {
                    $idusu     = $_POST['c_usuario']; 
                    
                    if(!empty($_POST['check_list'])) {
                    foreach($_POST['check_list'] as $selected) {
                    $ob_privilegios = new Privilegio();
                    
                    $ob_privilegios->setIdusu($idusu);
                    $ob_privilegios->setIdmenu($selected);                
                    $valor = $ob_privilegios->grabar($ob_privilegios);
                    }
                    }
                    
                    
                    if ($valor == 1) {
                header($direccionMantener);
                unset($_SESSION['accion_privilegio']);
                } else {
                header($direccionGuardar);
                }
        
            }
        }
    
     else if($accion=='buscar')
    {
           
            
        $dato = trim(strtoupper($_POST['t_nombre']));
        $rol = $_POST['c_rol'];
        $menu = $_POST['c_menu'];
        $estado = $_POST['c_estado'];
        $fechareg=trim(strtoupper($_POST['t_fecha_reg']));
        
        $ob_privilegio = new Privilegio();
        $ob_privilegio->setNombreusu($dato);
        $ob_privilegio->setIdrol($rol);
        $ob_privilegio->setIdmenu($menu);
        $ob_privilegio->setEstado($estado);
        $ob_privilegio->setFecha_registro($fechareg);
         
        $arreglo = $ob_privilegio->buscar($ob_privilegio);
        
        $_SESSION['arreglo_buscado_usuario'] = $arreglo;
        $_SESSION['accion_privilegio'] = 'busqueda';
        header("location: ../../Vistas/MantenerPrivilegios.php");
    }
    
     else if($accion=='buscarid')
     {
        $id_dato = $_POST['idusu'];
        $ob_usuario = new Usuario();
        $ob_usuario->setId($id_dato); 
        $ob_usuario->buscarPorId($ob_usuario);
        $_SESSION['accion_privilegio']='editar';
        unset($_SESSION['arreglo_buscado_privilegio']);
        header("location: ../../Vistas/AsignarPrivilegios.php");
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
        $_SESSION['usumenu_idusumenu']="";
        
        unset($_SESSION['arreglo_buscado_privilegio']);
        unset($_SESSION['accion_privilegio']);
        header("location: ../../Vistas/MantenerPrivilegios.php");
    }
//     else if($accion == 'agregar_mantenimiento'){
//        //quita datos de la sesion
//        $_SESSION['usu_idusu']="";
//        $_SESSION['usu_nombres_usuario']="";
//        $_SESSION['usu_apellidos_usuario']=""; 
//        $_SESSION['usu_tipdoc_usuario']=""; 
//        $_SESSION['usu_numdoc_usuario']="";
//        $_SESSION['usu_nom_usuario']="";
//        $_SESSION['usu_contrasenia']="";
//        $_SESSION['usu_estado']="";
//        $_SESSION['usu_email_institucional']="";
//        $_SESSION['usu_fecharegistro']="";
//        
//        unset($_SESSION['arreglo_buscado_usuario']);
//        unset($_SESSION['accion_usuario']);
//        header("location: ../../Vistas/Registros/serv_GuardarUsuario.php");
//    }
    else if($accion == 'eliminar')
    {
        $id_usuario_eliminar = $_POST['id_hidden_eliminar'];
        
        $ob_privilegio = new Privilegio();
        $ob_privilegio->setIdusu($id_usuario_eliminar);
        
        $ob_privilegio->eliminar($ob_privilegio);
        header($direccionMantener);   
           
    }
//    else if($accion == 'irInicio'){
//        //quita datos de la sesion
//        $_SESSION['usu_idusu']="";
//        $_SESSION['usu_nombres_usuario']="";
//        $_SESSION['usu_apellidos_usuario']=""; 
//        $_SESSION['usu_tipdoc_usuario']=""; 
//        $_SESSION['usu_numdoc_usuario']="";
//        $_SESSION['usu_nom_usuario']="";
//        $_SESSION['usu_contrasenia']="";
//        $_SESSION['usu_estado']="";
//        $_SESSION['usu_email_institucional']="";
//        $_SESSION['usu_fecharegistro']="";
//        
//        unset($_SESSION['arreglo_buscado_usuario']);
//        unset($_SESSION['accion_usuario']);
//        header($direccionInicio);
//    }
//    else if($accion == 'irMantener'){
//        //quita datos de la sesion
//        $_SESSION['usu_idusu']="";
//        $_SESSION['usu_nombres_usuario']="";
//        $_SESSION['usu_apellidos_usuario']=""; 
//        $_SESSION['usu_tipdoc_usuario']=""; 
//        $_SESSION['usu_numdoc_usuario']="";
//        $_SESSION['usu_nom_usuario']="";
//        $_SESSION['usu_contrasenia']="";
//        $_SESSION['usu_estado']="";
//        $_SESSION['usu_email_institucional']="";
//        $_SESSION['usu_fecharegistro']="";
//        
//        unset($_SESSION['arreglo_buscado_usuario']);
//        unset($_SESSION['accion_usuario']);
//        header($direccionMantener);
//    }
    
   }
    
else 
{
    header("location: ../../Vistas/AsignarPrivilegios.php");
         
}