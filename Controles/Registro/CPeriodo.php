<?php

session_start();
include_once '../../DAO/Conexion.php';
include_once '../../DAO/Registro/Periodo.php';
include_once '../../DAO/Registro/Periodo_Fecha.php';



//var_dump($productos);
//exit();


$direccionInicio = "location:../../Vistas/index.php";
$direccionMantener = "location: ../../Vistas/MantenerPeriodo.php";
$direccionGuardar = "location: ../../Vistas/GuardarPeriodo.php";
 
if (isset($_POST['hidden_periodo'])) {

    $accion = $_POST['hidden_periodo'];
    
   
    if ($accion == 'save') {

        if (isset($_SESSION['accion_periodo'])) {
            if ($_SESSION['accion_periodo'] == 'editar') {
                $id = $_POST['idperiodo'];
                $nombrearchivo = $_FILES['fileArchivo']['name'];
              move_uploaded_file($_FILES['fileArchivo']['tmp_name'], "TxtFechas/" . $nombrearchivo);
             
             $nombre_periodo = trim(strtoupper($_POST['t_nombre']));
 
             $periodo = new Periodo();
             $periodo->setId($id);
             $periodo->setNombre($nombre_periodo);
            
             $resul=$periodo->actualizar($periodo);
             
             
                $file = fopen("TxtFechas/$nombrearchivo", "r");

                while(!feof($file)) {
                    
                $ob_pf = new Periodo_Fecha();
                $ob_pf->setFecha(fgets($file));
                $ob_pf->setIdperiodo($resul);             
                $valor = $ob_pf->grabar($ob_pf);   

                }

                fclose($file);
                 header("location: ../../Vistas/MantenerPeriodo.php");
            } else {
            
             $nombrearchivo = $_FILES['fileArchivo']['name'];
              move_uploaded_file($_FILES['fileArchivo']['tmp_name'], "TxtFechas/" . $nombrearchivo);
             
             $nombre_periodo = trim(strtoupper($_POST['t_nombre']));
 
            $periodo = new Periodo();
          
            $periodo->setNombre($nombre_periodo);
            
            $resul=$periodo->grabar($periodo);
            

                $file = fopen("TxtFechas/$nombrearchivo", "r");

                while(!feof($file)) {
                    
                $ob_pf = new Periodo_Fecha();
                $ob_pf->setFecha(fgets($file));
                $ob_pf->setIdperiodo($resul);             
                $valor = $ob_pf->grabar($ob_pf);   

                }

                fclose($file);

         
            
           
            
//            $arreglo_fecha = $_SESSION['fechas'];
//            foreach ($arreglo_fecha as $r) {
//            $ob_pf = new Periodo_Fecha();
//            $ob_pf->setFecha($r[0]);
//            $ob_pf->setIdperiodo($resul);             
//            $valor = $ob_pf->grabar($ob_pf);            
//            }
           
             
            
            
//            unset($_SESSION['fechas']);
             
            header("location: ../../Vistas/MantenerPeriodo.php");
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
        
        $ob_periodo = new Periodo();
        $ob_periodo->setNombre($dato);
        $ob_periodo->setEstado($estado);
        $ob_periodo->setFecha_registro($fechareg);
         
        $arreglo = $ob_periodo->buscar($ob_periodo);
        
        $_SESSION['arreglo_buscado_periodo'] = $arreglo;
        $_SESSION['accion_periodo'] = 'busqueda';
        header("location: ../../Vistas/MantenerPeriodo.php");
    }
         else if($accion=='buscarid')
     {
        $id_periodo = $_POST['idperiodo'];
        $periodo = new Periodo();
        $periodo->setId($id_periodo); 
        $periodo->buscarPorId($periodo);
        $_SESSION['accion_periodo']='editar';        
        unset($_SESSION['arreglo_buscado_periodo']);
        header("location: ../../Vistas/GuardarPeriodo.php");
     }
     
         else if($accion == 'anular'){
        $id_periodo_eliminar = $_POST['id_hidden_eliminar'];
        $id_periodo_estado = $_POST['hidden_estado'];
        $ob_periodo = new Periodo();
        $ob_periodo->setId($id_periodo_eliminar);
        $ob_periodo->setEstado($id_periodo_estado);
        $ob_periodo->anular($ob_periodo);
        
        $arreglo=$ob_periodo->listar();
        $_SESSION['arreglo_buscado_periodo'] = $arreglo;
        header("location: ../../Vistas/MantenerPeriodo.php");
         }
         
        else if($accion == 'eliminar')
    {
        $id_periodo_eliminar = $_POST['id_hidden_eliminar'];
        
        $ob_periodo = new Periodo();
        $ob_periodo->setId($id_periodo_eliminar);
        
        $ob_periodo->eliminar($ob_periodo);
        header($direccionMantener);   
           
    }
     
         else if ($accion == 'agregarFecha') {
        unset($_SESSION['arreglo_cargado_fecha']);

            $fecha = $_POST['hidden_fecha'];
            $estado=1;
            
//            var_dump($num_tel);
//            exit();
            if (isset($_SESSION['fechas'])) {
                $arreglo = $_SESSION['fechas'];
                $datos = array($fecha,$estado);
                $arreglo[] = $datos;
                $_SESSION['fechas'] = $arreglo;
                llenarTablaFecha($_SESSION['fechas']);
            }
            else{
                 // si no hay sesion
                $arreglo = array();
                $datos = array($fecha,$estado);
                $arreglo[] = $datos;
                $_SESSION['fechas'] = $arreglo;
                llenarTablaFecha($_SESSION['fechas']);
            
            }
       
    }
  
 
      else if ($accion == 'eliminaFecha') {
        unset($_SESSION['arreglo_cargado_fecha']);

            $fecha = $_POST['hidden_fecha'];
              
            $arreglo = $_SESSION['fechas'];
            if (count($arreglo) == 0) {
            unset($_SESSION['fechas']);
            }
            else {
            for ($i = 0; $i < count($arreglo); $i++) {
                $obj = $arreglo[$i];

                if ($obj != null) {
                    if ($obj[0] == $fecha) {
                        $obj[1] = 0;
                        $arreglo[$i] = $obj;
                    }
                } else {
                    $obj[i][1] = 0;
                    $arreglo[$i] = $obj;
                }
            }
       $_SESSION['fechas'] = $arreglo;
    }
    llenarTablaFecha($_SESSION['fechas']);
        }   
    
      
   
    
 
} else {
    header("location: ../../Vistas/MantenerPeriodo.php");
}

//----------------- funciones ajax -----------

function llenarTablaFecha($datos){
    //var_dump($datos);exit();
    
     echo "<table class='table table-striped table-advance table-hover'>";
     echo "<h4><i class='fa fa-calendar'></i> FECHAS AGREGADAS</h4>";
     echo "<hr>";
     if(isset($datos) != null) {
     echo "<thead>";
     echo "<tr>";
     echo "<th><i class='fa fa-arrow-circle-down'></i> N°</th>";
     echo "<th><i class='fa fa-calendar'></i> Fecha</th>";
     echo "<th><i class='fa fa-trash-o'></i> Eliminar</th></tr>";
     echo "</thead>";                                 
     echo "<tbody>";                                  
                                        
    
    $num = 1;
    foreach ($datos as $d) {
       if ($d[1] == 1) {
           
    echo "<tr>";
    echo "<td>".$num;$num++;"</td>";
    echo "<td>".$d[0]."</td>";
    echo "<td><input type='hidden' id='hidden_fecha$d[0]' name='t_fecha' value='".$d[0]."'>"            
            
            . "<button type='button' class='btn btn-danger btn-xs'  title='Eliminar' onclick=eliminaFecha('hidden_fecha$d[0]');>"            
            . "<i class='fa fa-trash-o '></i></button></td>";
    
                                                           
                                                    
    echo "</tr>";                                                   
    } }

    echo "</tbody>";
                                }
    echo "</table>";
     
}

