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
                $turno =  $_POST['turno'];
//                var_dump($turno);
//                exit();
                $ob = new Schedule();
                $ob->setId($idschedule);
                if($turno=='23:00:00'){
                $lista = $ob->listar_por_schedule_usu_noche($ob);    
                }else if($turno=='19:00:00'){
                $lista = $ob->listar_por_schedule_usu($ob);    
                }else{
                $lista = $ob->listar_por_schedule_usu_dia($ob);    
                }
                //echo 'si carga arreglo';
                //exit();
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

