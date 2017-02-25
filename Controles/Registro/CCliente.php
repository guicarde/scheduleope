<?php

session_start();
include_once '../../DAO/Conexion.php';
include_once '../../DAO/Registro/Cliente.php';


//var_dump($productos);
//exit();


$direccionInicio = "location:../../Vistas/index.php";
$direccionMantener = "location: ../../Vistas/MantenerCliente.php";
$direccionGuardar = "location: ../../Vistas/GuardarCliente.php";
 
if (isset($_POST['hidden_cliente'])) {

    $accion = $_POST['hidden_cliente'];
    
   
    if ($accion == 'save') {

        if (isset($_SESSION['accion_cliente'])) {
            if ($_SESSION['accion_cliente'] == 'editar') {
                unset($_SESSION['cliente_idcliente']);
                unset($_SESSION['cliente_nombre']);
                unset($_SESSION['cliente_estado']);
                unset($_SESSION['clientefin_idclientefin']);
                unset($_SESSION['accion_cliente']);
                unset($_SESSION['arreglo_buscado_cliente']);
                
                $id = $_POST['idcliente'];
                $nombre_cliente = trim(strtoupper($_POST['t_nombre']));
                $idclifin = $_POST['c_cliente'];
                
                $cliente = new Cliente();
          
                $cliente->setId($id);
                $cliente->setNombre($nombre_cliente);
                $cliente->setIdclifin($idclifin);

                $valor = $cliente->actualizar($cliente);
                if ($valor == 1) {
                    header($direccionMantener);
                } else {
                    header($direccionGuardar);
                }
            } else {
              $_SESSION['accion_cliente'] = '';   
              $nombre_cliente = trim(strtoupper($_POST['t_nombre']));
              $idclifin = $_POST['c_cliente'];
            
            $cliente = new Cliente();
          
            $cliente->setNombre($nombre_cliente);
            $cliente->setIdclifin($idclifin);
            $cliente->grabar($cliente);
            
            header("location: ../../Vistas/MantenerCliente.php");
            }
        } else {
            
            echo '2';
            exit();
        }
    } 
    
         else if($accion=='buscar')
    {
           
            
        $dato = trim(strtoupper($_POST['t_nombre']));
        $idclifin = $_POST['c_cliente'];
        $estado = $_POST['c_estado'];
        $fechareg=trim(strtoupper($_POST['t_fecha_reg']));
        
        $ob_cliente = new Cliente();
        $ob_cliente->setNombre($dato);
        $ob_cliente->setIdclifin($idclifin);
        $ob_cliente->setEstado($estado);
        $ob_cliente->setFechareg($fechareg);
         
        $arreglo = $ob_cliente->buscar($ob_cliente);
        
        $_SESSION['arreglo_buscado_cliente'] = $arreglo;
        $_SESSION['accion_cliente'] = 'busqueda';
        header("location: ../../Vistas/MantenerCliente.php");
    }
         else if($accion=='buscarid')
     {
        $id_cliente = $_POST['idcliente'];
        $cliente = new Cliente();
        $cliente->setId($id_cliente); 
        $cliente->buscarPorId($cliente);
        $_SESSION['accion_cliente']='editar';        
        unset($_SESSION['arreglo_buscado_cliente']);
        header("location: ../../Vistas/GuardarCliente.php");
     }
     
         else if($accion == 'anular'){
        $id_cliente_eliminar = $_POST['id_hidden_eliminar'];
        $id_cliente_estado = $_POST['hidden_estado'];
        $ob_cliente = new Cliente();
        $ob_cliente->setId($id_cliente_eliminar);
        $ob_cliente->setEstado($id_cliente_estado);
        $ob_cliente->anular($ob_cliente);
        
        $arreglo=$ob_cliente->listar();
        $_SESSION['arreglo_buscado_cliente'] = $arreglo;
        header("location: ../../Vistas/MantenerCliente.php");
         }
     
        
      
   
    
 
} else {
    header("location: ../../Vistas/Registros/MantenerCliente.php");
}

//----------------- funciones ajax -----------


