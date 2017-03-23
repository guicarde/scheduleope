<?php

session_start();
//include_once '../../DAO/Registro/Documento.php';
//include_once '../../DAO/Registro/Compra.php';
//include_once '../../DAO/Registro/Producto.php';
include_once '../../DAO/Registro/Schedule.php';
//$direccion="location: ../../Vistas/Registros/serv_Reporte_Final.php";


if(isset($_POST['hidden_documento']))
{
    $accion = $_POST['hidden_documento'];
  
            if($accion=='generar_reporte_schedule')
    {   
       $idschedule= $_POST['id_schedule'];
       var_dump($idschedule);
                exit();
     
                $ob = new Schedule();
                $ob->setId($idschedule);
                $lista = $ob->reporte($ob);
                $lista2 = $ob->buscarPorId($ob);
                $_SESSION['Schedule']=$lista;
                $_SESSION['Schedule_cabecera']=$lista2;
                $_SESSION['id_schedule']=$idschedule;

                 header("location: ../../Vistas/ReporteSchedule.php");
           
       

    }
           if($accion=='generar_reporte_cierre_schedule')
    {   
       $idschedule= $_POST['id_schedule'];
       
     
                $ob = new Schedule();
                $ob->setId($idschedule);
                $lista = $ob->reporte_cierre($ob);
                $lista2 = $ob->buscarPorId($ob);
                $_SESSION['Schedule']=$lista;
                $_SESSION['Schedule_cabecera']=$lista2;
                $_SESSION['id_schedule']=$idschedule;

                 header("location: ../../Vistas/ReporteCierreSchedule.php");
           
       

    }
    
    
    
    

}
?>

