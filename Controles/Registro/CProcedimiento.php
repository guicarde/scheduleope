<?php

session_start();
include_once '../../DAO/Conexion.php';
include_once '../../DAO/Registro/Procedimiento.php';


//var_dump($productos);
//exit();


$direccionInicio = "location:../../Vistas/index.php";
$direccionMantener = "location: ../../Vistas/MantenerProcedimiento.php";
$direccionGuardar = "location: ../../Vistas/GuardarProcedimiento.php";
 
if (isset($_POST['hidden_procedimiento'])) {

    $accion = $_POST['hidden_procedimiento'];
    
   
    if ($accion == 'save') {

        if (isset($_SESSION['accion_procedimiento'])) {
            if ($_SESSION['accion_procedimiento'] == 'editar') {
                unset($_SESSION['procedimiento_idprocedimiento']);
                unset($_SESSION['procedimiento_nombre']);
                unset($_SESSION['procedimiento_archivo']);
                unset($_SESSION['procedimiento_estado']);
                unset($_SESSION['accion_procedimiento']);
                
                
                $id = $_POST['idprocedimiento'];
                $nombre_procedimiento = trim(strtoupper($_POST['t_nombre']));
                $nombrearchivo = $_FILES['fileArchivo']['name'];
                move_uploaded_file($_FILES['fileArchivo']['tmp_name'], "Procedimientos/" . $nombrearchivo);
                
                $procedimiento = new Procedimiento();
          
                $procedimiento->setNombre($nombre_procedimiento);
                $procedimiento->setArchivo($nombrearchivo);
                $procedimiento->setId($id);

                $valor = $procedimiento->actualizar($procedimiento);
                if ($valor == 1) {
                    header($direccionMantener);
                } else {
                    header($direccionGuardar);
                }
            } else {
             
              $nombrearchivo = $_FILES['fileArchivo']['name'];
              move_uploaded_file($_FILES['fileArchivo']['tmp_name'], "Procedimientos/" . $nombrearchivo);
              $nombre_procedimiento = trim(strtoupper($_POST['t_nombre']));
             
            
            $procedimiento = new Procedimiento();
          
            $procedimiento->setNombre($nombre_procedimiento);
            $procedimiento->setArchivo($nombrearchivo);
            $procedimiento->grabar($procedimiento);
            
            header("location: ../../Vistas/MantenerProcedimiento.php");
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
        
        $ob_procedimiento = new Procedimiento();
        $ob_procedimiento->setNombre($dato);
        $ob_procedimiento->setEstado($estado);
        $ob_procedimiento->setFecha_registro($fechareg);
         
        $arreglo = $ob_procedimiento->buscar($ob_procedimiento);
        
        $_SESSION['arreglo_buscado_procedimiento'] = $arreglo;
        $_SESSION['accion_procedimiento'] = 'busqueda';
        header("location: ../../Vistas/MantenerProcedimiento.php");
    }
         else if($accion=='buscarid')
     {
        $id_procedimiento = $_POST['idprocedimiento'];
        $procedimiento = new Procedimiento();
        $procedimiento->setId($id_procedimiento); 
        $procedimiento->buscarPorId($procedimiento);
        $_SESSION['accion_procedimiento']='editar';        
        unset($_SESSION['arreglo_buscado_procedimiento']);
        header("location: ../../Vistas/GuardarProcedimiento.php");
     }
     
         else if($accion == 'anular'){
        $id_procedimiento_eliminar = $_POST['id_hidden_eliminar'];
        $id_procedimiento_estado = $_POST['hidden_estado'];
        $ob_procedimiento = new Procedimiento();
        $ob_procedimiento->setId($id_procedimiento_eliminar);
        $ob_procedimiento->setEstado($id_procedimiento_estado);
        $ob_procedimiento->anular($ob_procedimiento);
        
        $arreglo=$ob_procedimiento->listar();
        $_SESSION['arreglo_buscado_procedimiento'] = $arreglo;
        header("location: ../../Vistas/MantenerProcedimiento.php");
         }
     
        
      
   
    
 
} else {
    header("location: ../../Vistas/Registros/MantenerProcedimiento.php");
}

//----------------- funciones ajax -----------


