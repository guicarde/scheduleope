<?php

session_start();
include_once '../../DAO/Conexion.php';
include_once '../../DAO/Registro/Servidor.php';


//var_dump($productos);
//exit();


$direccionInicio = "location:../../Vistas/index.php";
$direccionMantener = "location: ../../Vistas/MantenerServidor.php";
$direccionGuardar = "location: ../../Vistas/GuardarServidor.php";
 
if (isset($_POST['hidden_servidor'])) {

    $accion = $_POST['hidden_servidor'];
    
   
    if ($accion == 'save') {

        if (isset($_SESSION['accion_servidor'])) {
            if ($_SESSION['accion_servidor'] == 'editar') {
                unset($_SESSION['servidor_idservidor']);
                unset($_SESSION['servidor_hostname']);
                unset($_SESSION['servidor_ip']);
                unset($_SESSION['accion_servidor']);
                
                
                $id = $_POST['idservidor'];
                $hostname = trim(strtoupper($_POST['t_hostname']));
                $ip = trim(strtoupper($_POST['t_ip']));
                
                $servidor = new Servidor();
          
                $servidor->setId($id);
                $servidor->setHostname($hostname);
                $servidor->setIp($ip);
                

                $valor = $servidor->actualizar($servidor);
                if ($valor == 1) {
                    header($direccionMantener);
                } else {
                    header($direccionGuardar);
                }
            } else {
                
              $hostname = trim(strtoupper($_POST['t_hostname']));
              $ip = trim(strtoupper($_POST['t_ip']));
            
            $servidor = new Servidor();
          
            $servidor->setHostname($hostname);
            $servidor->setIp($ip);
            
            $servidor->grabar($servidor);
            
            header("location: ../../Vistas/MantenerServidor.php");
            }
        } else {
            
            echo '2';
            exit();
        }
    } 
    
         else if($accion=='buscar')
    {
           
            
        $hostname = trim(strtoupper($_POST['t_hostname']));
        $ip = trim(strtoupper($_POST['t_ip']));
        $estado = $_POST['c_estado'];
        $fechareg=trim(strtoupper($_POST['t_fecha_reg']));
        
        $ob_servidor = new Servidor();
        $ob_servidor->setHostname($hostname);
        $ob_servidor->setIp($ip);
        $ob_servidor->setEstado($estado);
        $ob_servidor->setFechareg($fechareg);
         
        $arreglo = $ob_servidor->buscar($ob_servidor);
        
        $_SESSION['arreglo_buscado_servidor'] = $arreglo;
        $_SESSION['accion_servidor'] = 'busqueda';
        header("location: ../../Vistas/MantenerServidor.php");
    }
         else if($accion=='buscarid')
     {
        $id_servidor = $_POST['idservidor'];
        $servidor = new Servidor();
        $servidor->setId($id_servidor); 
        $servidor->buscarPorId($servidor);
        $_SESSION['accion_servidor']='editar';        
        unset($_SESSION['arreglo_buscado_servidor']);
        header("location: ../../Vistas/GuardarServidor.php");
     }
     
         else if($accion == 'anular'){
        $id_servidor_eliminar = $_POST['id_hidden_eliminar'];
        $id_servidor_estado = $_POST['hidden_estado'];
        $ob_servidor = new Servidor();
        $ob_servidor->setId($id_servidor_eliminar);
        $ob_servidor->setEstado($id_servidor_estado);
        $ob_servidor->anular($ob_servidor);
        
        $arreglo=$ob_servidor->listar();
        $_SESSION['arreglo_buscado_servidor'] = $arreglo;
        header("location: ../../Vistas/MantenerServidor.php");
         }
     
 
} else {
    header("location: ../../Vistas/MantenerServidor.php");
}

//----------------- funciones ajax -----------


