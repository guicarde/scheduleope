<?php

session_start();
include_once '../../DAO/Conexion.php';
include_once '../../DAO/Registro/Cliente_Final.php';


//var_dump($productos);
//exit();


$direccionInicio = "location:../../Vistas/index.php";
$direccionMantener = "location: ../../Vistas/MantenerClienteFinal.php";
$direccionGuardar = "location: ../../Vistas/GuardarClienteFinal.php";
 
if (isset($_POST['hidden_clientefin'])) {

    $accion = $_POST['hidden_clientefin'];
    
   
    if ($accion == 'save') {

        if (isset($_SESSION['accion_clientefin'])) {
            if ($_SESSION['accion_clientefin'] == 'editar') {
                unset($_SESSION['clientefin_idclientefin']);
                unset($_SESSION['clientefin_nombre']);
                unset($_SESSION['clientefin_estado']);
                unset($_SESSION['accion_clientefin']);
                
                
                $id = $_POST['idclientefin'];
                $nombre_cliente = trim(strtoupper($_POST['t_nombre']));
                
                $clientefin = new Cliente_Final();
          
                $clientefin->setId($id);
                $clientefin->setNombre($nombre_cliente);

                $valor = $clientefin->actualizar($clientefin);
                if ($valor == 1) {
                    header($direccionMantener);
                } else {
                    header($direccionGuardar);
                }
            } else {
                
              $nombre_cliente = trim(strtoupper($_POST['t_nombre']));
             
            
            $clientefin = new Cliente_Final();
          
            $clientefin->setNombre($nombre_cliente);
            $clientefin->grabar($clientefin);
            
            header("location: ../../Vistas/MantenerClienteFinal.php");
            }
        } else {
            
            echo '2';
            exit();
        }
    } 
    
         else if($accion=='buscar')
    {
           
            
        $dato = trim(strtoupper($_POST['t_nombre']));
        $estado = $_POST['c_estado'];
        $fechareg=trim(strtoupper($_POST['t_fecha_reg']));
        
        $ob_cliente_fin = new Cliente_Final();
        $ob_cliente_fin->setNombre($dato);
        $ob_cliente_fin->setEstado($estado);
        $ob_cliente_fin->setFechareg($fechareg);
         
        $arreglo = $ob_cliente_fin->buscar($ob_cliente_fin);
        
        $_SESSION['arreglo_buscado_clientefin'] = $arreglo;
        $_SESSION['accion_clientefin'] = 'busqueda';
        header("location: ../../Vistas/MantenerClienteFinal.php");
    }
         else if($accion=='buscarid')
     {
        $id_cliente = $_POST['idclientefin'];
        $cliente_fin = new Cliente_Final();
        $cliente_fin->setId($id_cliente); 
        $cliente_fin->buscarPorId($cliente_fin);
        $_SESSION['accion_clientefin']='editar';        
        unset($_SESSION['arreglo_buscado_clientefin']);
        header("location: ../../Vistas/GuardarClienteFinal.php");
     }
     
         else if($accion == 'anular'){
        $id_cliente_eliminar = $_POST['id_hidden_eliminar'];
        $id_cliente_estado = $_POST['hidden_estado'];
        $ob_cliente_fin = new Cliente_Final();
        $ob_cliente_fin->setId($id_cliente_eliminar);
        $ob_cliente_fin->setEstado($id_cliente_estado);
        $ob_cliente_fin->anular($ob_cliente_fin);
        
        $arreglo=$ob_cliente_fin->listar();
        $_SESSION['arreglo_buscado_clientefin'] = $arreglo;
        header("location: ../../Vistas/MantenerClienteFinal.php");
         }
     
        
      
   
    
 
} else {
    header("location: ../../Vistas/Registros/MantenerClienteFinal.php");
}

//----------------- funciones ajax -----------


