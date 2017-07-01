<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("location:login.php");
}

unset($_SESSION['actividad_idactividad']);
unset($_SESSION['actividad_tipo']);
unset($_SESSION['actividad_horaejecucion']);
unset($_SESSION['actividad_interturno']);
unset($_SESSION['actividad_excepcion']);
unset($_SESSION['actividad_descripcion']);
unset($_SESSION['actividad_horalimite']);
unset($_SESSION['actividad_plataforma']);
unset($_SESSION['actividad_tiporespaldo']);
unset($_SESSION['periodo_idperiodo']);
unset($_SESSION['procedimiento_idprocedimiento']);
unset($_SESSION['cliente_idcliente']);
unset($_SESSION['servidor_idservidor']);
unset($_SESSION['actividad_estado']);
unset($_SESSION['actividad_fecharegistro']);
unset($_SESSION['subcategoria_idsubcategoria']);
unset($_SESSION['actividad_horatermino']);
unset($_SESSION['actividad_duracion']);
unset($_SESSION['actividad_tier']);
unset($_SESSION['actividad_interacciones']);
unset($_SESSION['actividad_tipoproceso']);
unset($_SESSION['actividad_comentario']);
unset($_SESSION['actividad_ventana_max']);
unset($_SESSION['actividad_accion']);
unset($_SESSION['actividad_tws']);
unset($_SESSION['accion_actividad']);
unset($_SESSION['sede_idsede']);
unset($_SESSION['categoria_idcategoria']);
unset($_SESSION['mensaje_actividad']);
unset($_SESSION['arreglo_buscado_actividad']);
unset($_SESSION['arreglo_turnos']);
unset($_SESSION['arreglo_dias']);
unset($_SESSION['arreglo_cargado_actividad']);

unset($_SESSION['mensaje_cliente']);
unset($_SESSION['cliente_idcliente']);
unset($_SESSION['clientefin_idclientefin']);
unset($_SESSION['cliente_nombre']);
unset($_SESSION['accion_cliente']);
unset($_SESSION['arreglo_buscado_cliente']);


unset($_SESSION['mensaje_clientefin']);
unset($_SESSION['clientefin_nombre']);
unset($_SESSION['clientefin_estado']);
unset($_SESSION['clientefin_fecharegistro']);
unset($_SESSION['accion_clientefin']);
unset($_SESSION['clientefin_idclientefin']);
unset($_SESSION['arreglo_buscado_clientefin']);

unset($_SESSION['mensaje_periodo']);
unset($_SESSION['periodo_idperiodo']);
unset($_SESSION['periodo_nombre']);
unset($_SESSION['periodo_estado']);
unset($_SESSION['accion_periodo']);
unset($_SESSION['arreglo_buscado_periodo']);
unset($_SESSION['arreglo_cargado_fecha']);
unset($_SESSION['fechas']);

unset($_SESSION['mensaje_privilegio']);
unset($_SESSION['arreglo_buscado_usuario']);
unset($_SESSION['accion_privilegio']);
unset($_SESSION['arreglo_buscado_privilegio']);

unset($_SESSION['mensaje_procedimiento']);
unset($_SESSION['procedimiento_idprocedimiento']);
unset($_SESSION['procedimiento_nombre']);
unset($_SESSION['procedimiento_archivo']);
unset($_SESSION['procedimiento_estado']);
unset($_SESSION['accion_procedimiento']);
unset($_SESSION['arreglo_buscado_procedimiento']);

unset($_SESSION['mensaje_schedule']);
unset($_SESSION['Schedule']);
unset($_SESSION['Schedule_cabecera']);
unset($_SESSION['id_schedule']);
unset($_SESSION['id_turno']);
unset($_SESSION['id_turnob']);
unset($_SESSION['arreglo_buscado_actividad_sc']);
unset($_SESSION['accion_schedule']);
unset($_SESSION['fecha']);
unset($_SESSION['id_sede']);
unset($_SESSION['id_turno']);
unset($_SESSION['id_turnob']);
unset($_SESSION['id_dia']);
unset($_SESSION['arreglo_cargado_schedule']);
unset($_SESSION['id_schedule']);
unset($_SESSION['arreglo_actividad_por_schedule']);
unset($_SESSION['hora_turno']);
unset($_SESSION['id_schedule_act']);
unset($_SESSION['arreglo_filtro_schedule']);
unset($_SESSION['id_schedule_act']);
unset($_SESSION['id_schedule_act']);



unset($_SESSION['mensaje_servidor']);
unset($_SESSION['servidor_idservidor']);
unset($_SESSION['servidor_hostname']);
unset($_SESSION['servidor_ip']);
unset($_SESSION['accion_servidor']);
unset($_SESSION['arreglo_buscado_servidor']);


unset($_SESSION['mensaje_usuario']);
unset($_SESSION['usu_idusu']);
unset($_SESSION['usu_nombres_usuario']);
unset($_SESSION['usu_apellidos_usuario']);
unset($_SESSION['usu_numdoc_usuario']);
unset($_SESSION['usu_nom_usuario']);
unset($_SESSION['usu_contrasenia']);
unset($_SESSION['usu_estado']);
unset($_SESSION['usu_email_institucional']);
unset($_SESSION['usu_fecharegistro']);
unset($_SESSION['rol_idrol']);
unset($_SESSION['accion_usuario']);
unset($_SESSION['arreglo_buscado_usuario']);


$privilegios = $_SESSION['array_menus'];
include_once '../DAO/Registro/Usuario.php';

$usuario = new Usuario();
$usuarios = $usuario->listar();

$usuario2 = new Usuario();
$usuario2->setId($_SESSION['id_username']);
$usuario2->conectado($usuario2);
//var_dump($privilegios);
//exit();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>SISTEMA DE GENERACIÓN DE SCHEDULE</title>

    <!-- Bootstrap core CSS -->
    <link href="../Recursos/assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="../Recursos/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="../Recursos/assets/css/zabuto_calendar.css">
    <link rel="stylesheet" type="text/css" href="../Recursos/assets/js/gritter/css/jquery.gritter.css" />
    <link rel="stylesheet" type="text/css" href="../Recursos/assets/lineicons/style.css">    
    
    <!-- Custom styles for this template -->
    <link href="../Recursos/assets/css/style.css" rel="stylesheet">
    <link href="../Recursos/assets/css/style-responsive.css" rel="stylesheet">

    <script src="../Recursos/assets/js/chart-master/Chart.js"></script>
    
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body onload="nobackbutton();">

  <section id="container" >
      <!-- **********************************************************************************************************************************************************
      TOP BAR CONTENT & NOTIFICATIONS
      *********************************************************************************************************************************************************** -->
      <?php require 'Cabecera.php' ?>     
      <!-- **********************************************************************************************************************************************************
      MAIN SIDEBAR MENU
      *********************************************************************************************************************************************************** -->
      <!--sidebar start-->
      <aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">
              
                  <p class="centered"><a href="profile.html"><img src="../Controles/Registro/Fotos/<?php echo $_SESSION['foto']; ?>" class="img-circle" width="60"></a></p>
              	  <h5 class="centered"><?php echo $_SESSION['user_personal'] ?></h5>              	  
                  <li class="mt">
                      <a href="javascript:;" class="active">
                          <i class="fa fa-dashboard"></i>
                          <span>Resumen</span>
                      </a>
                  </li>
                  
                  <?php if ($privilegios != null) { ?>
                   <?php foreach ($privilegios as $p) {    ?>
                  
                  <?php if ($p['menu_idmenu']==1) {?>
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-users"></i>
                          <span>Usuarios</span>
                      </a>
                      <ul class="sub">
                           <li><a  onclick="cancelarmantusu();" style="cursor: pointer">Registrar Usuario</a></li>
                          <li><a  href="MantenerUsuario.php">Administrar Usuarios</a></li>
                          <li><a  href="AsignarPrivilegios.php">Asignar Privilegios</a></li>
                          <li><a  href="MantenerPrivilegios.php">Administrar Privilegios</a></li>
                      </ul>
                  </li>
                  <?php } ?>
                  <?php if ($p['menu_idmenu']==2) {?>
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-tasks"></i>
                          <span>Actividad</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="MantenerActividad.php">Consultar Actividades</a></li>
                          <li><a  href="GuardarActividad.php">Registrar Actividad</a></li>
                      </ul>
                  </li>
                  <?php } ?>
                  <?php if ($p['menu_idmenu']==3) {?>
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-calendar"></i>
                          <span>Periodo</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="MantenerPeriodo.php">Consultar Periodos</a></li>
                          <li><a  href="GuardarPeriodo.php">Registrar Periodo</a></li>
                      </ul>
                  </li>
                  <?php } ?>
                  
                  <?php if ($p['menu_idmenu']==4) {?>
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-barcode"></i>
                          <span>Procedimiento</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="MantenerProcedimiento.php">Consultar Procedimientos</a></li>
                          <li><a  href="GuardarProcedimiento.php">Registrar Procedimiento</a></li>
                      </ul>
                  </li>
                  <?php } ?>
                  <?php if ($p['menu_idmenu']==5) {?>
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-bookmark"></i>
                          <span>Shedule</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="MantenerSchedule.php">Consultar Schedule</a></li>
                          <li><a  href="GenerarSchedule.php">Generar Schedule</a></li>
                      </ul>
                  </li>
                  <?php } ?>   
                  <?php if ($p['menu_idmenu']==6) {?>
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-money"></i>
                          <span>Cliente</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="MantenerClienteFinal.php">Consultar Clientes Finales</a></li>
                          <li><a  href="GuardarClienteFinal.php">Registrar Cliente Final</a></li>
                          <li><a  href="MantenerCliente.php">Consultar Clientes</a></li>
                          <li><a  href="GuardarCliente.php">Registrar Cliente</a></li>
                      </ul>
                  </li>
                  <?php } ?> 
                  <?php if ($p['menu_idmenu']==7) {?>
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-fax"></i>
                          <span>Servidor</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="MantenerServidor.php">Consultar Servidores</a></li>
                          <li><a  href="GuardarServidor.php">Registrar Servidor</a></li>
                      </ul>
                  </li>
                  <?php } ?> 
                 <?php if ($p['menu_idmenu']==8) {?>
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-fax"></i>
                          <span>Ejecutar Schedule</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="SeleccionarSchedule.php">Seleccionar Schedule</a></li>
                          <li><a  href="MisSchedules.php">Mis Schedules</a></li>
                          <li><a  href="SchedulesActivos.php">Schedules Activos</a></li>
                          <li><a  href="SchedulesFinalizados.php">Schedules Finalizados</a></li>
                          <li><a  href="TareasPendientes.php">Tareas Pendientes</a></li>
                      </ul>
                  </li>
                  <?php } ?>                   
                  
                 <?php if ($p['menu_idmenu']==9) {?>
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-file-excel-o"></i>
                          <span>Subir Excel</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="GuardarExcel.php">Guardar EXCEL</a></li>
                      </ul>
                  </li>
                  <?php } ?>                         
                   
		  <?php if ($p['menu_idmenu']==10) {?>
                  <li class="sub-menu">
                      <a  href="javascript:;" >
                          <i class="fa fa-clock-o"></i>
                          <span>Monitoreo India</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="MonitoreoIndia.php">Monitoreo India</a></li>
                      </ul>
                  </li>
                   <?php } ?>
		       
                   <?php if ($p['menu_idmenu']==8) {?>
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-clock-o"></i>
                          <span>Tareas Pendientes</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="TareasPendientes.php">Tareas Pendientes</a></li>
                      </ul>
                  </li>
		  <?php } ?>
                  <?php } ?>
                  <?php } ?>
                       <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-warning"></i>
                          <span>Cambiar Contraseña</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="CambiarContrasenia.php">Cambiar Contraseña</a></li>
                      </ul>
                  </li>
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-lock"></i>
                          <span>Bloquear Sistema</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="lock_screen.php">Bloquear Sistema</a></li>
                      </ul>
                  </li>
                  </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>
      <!--sidebar end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">
              <form id="formcanc" action="../Controles/Registro/CUsuario.php" method="POST">
                    <input type="hidden" name="hidden_usuario" id="cancusuario"> 
                    </form>
              <div class="row">
                  <div class="col-lg-9 main-chart">	
					
		<div class="row mt">
                      <!--CUSTOM CHART START -->
                      <div class="border-head">
                          <h3>SCHEDULES</h3>
                      </div>
                      <div class="custom-bar-chart">
                          <ul class="y-axis">
                              <li><span>10.000</span></li>
                              <li><span>8.000</span></li>
                              <li><span>6.000</span></li>
                              <li><span>4.000</span></li>
                              <li><span>2.000</span></li>
                              <li><span>0</span></li>
                          </ul>
                          <div class="bar">
                              <div class="title">JAN</div>
                              <div class="value tooltips" data-original-title="8.500" data-toggle="tooltip" data-placement="top">85%</div>
                          </div>
                          <div class="bar ">
                              <div class="title">FEB</div>
                              <div class="value tooltips" data-original-title="5.000" data-toggle="tooltip" data-placement="top">50%</div>
                          </div>
                          <div class="bar ">
                              <div class="title">MAR</div>
                              <div class="value tooltips" data-original-title="6.000" data-toggle="tooltip" data-placement="top">60%</div>
                          </div>
                          <div class="bar ">
                              <div class="title">APR</div>
                              <div class="value tooltips" data-original-title="4.500" data-toggle="tooltip" data-placement="top">45%</div>
                          </div>
                          <div class="bar">
                              <div class="title">MAY</div>
                              <div class="value tooltips" data-original-title="3.200" data-toggle="tooltip" data-placement="top">32%</div>
                          </div>
                          <div class="bar ">
                              <div class="title">JUN</div>
                              <div class="value tooltips" data-original-title="6.200" data-toggle="tooltip" data-placement="top">62%</div>
                          </div>
                          <div class="bar">
                              <div class="title">JUL</div>
                              <div class="value tooltips" data-original-title="7.500" data-toggle="tooltip" data-placement="top">75%</div>
                          </div>
                      </div>
                      <!--custom chart end-->
					</div><!-- /row -->	
					
                  </div><!-- /col-lg-9 END SECTION MIDDLE -->
                  
                  
      <!-- **********************************************************************************************************************************************************
      RIGHT SIDEBAR CONTENT
      *********************************************************************************************************************************************************** -->                  
                  
                  <div class="col-lg-3 ds">
                    <!--COMPLETED ACTIONS DONUTS CHART-->
                       <!-- USERS ONLINE SECTION -->
						<h3>MIEMBROS DEL TEAM</h3>
                      <!-- First Member -->
                      <?php if ($usuarios != null) { ?>
                      <?php foreach ($usuarios as $r) { ?>
                      <div class="desc">
                      	<div class="thumb">
                        <img class="img-circle" src="../Controles/Registro/Fotos/<?php echo $r['usu_foto'];  ?>" width="35px" height="35px" align="">
                               
                      	</div>
                      	<div class="details">
                      		<p><a href="#"><?php echo $r['usu_nombres_usuario'].' '.$r['usu_apellidos_usuario'] ?></a><br/>
                      		<?php if ($r['usu_sesion']=='1'){ ?>   
                                    <a style="font-weight: bold; color: #48D364;"><muted>DISPONIBLE</muted></a>
                                <?php }else {  ?>
                                    <a style="font-weight: bold; color: red;"><muted>DESCONECTADO</muted></a>
                                <?php } ?>
                      		</p>
                      	</div>
                      </div>
                      <?php } ?>
                      
                     <?php } ?>
                        <!-- CALENDAR-->
                        <div id="calendar" class="mb">
                            <div class="panel green-panel no-margin">
                                <div class="panel-body">
                                    <div id="date-popover" class="popover top" style="cursor: pointer; disadding: block; margin-left: 33%; margin-top: -50px; width: 175px;">
                                        <div class="arrow"></div>
                                        <h3 class="popover-title" style="disadding: none;"></h3>
                                        <div id="date-popover-content" class="popover-content"></div>
                                    </div>
                                    <div id="my-calendar"></div>
                                </div>
                            </div>
                        </div><!-- / calendar -->
                      
                  </div><!-- /col-lg-3 -->
              </div><! --/row -->
          </section>
      </section>

      <!--main content end-->
      <!--footer start-->
      <footer class="site-footer">
          <div class="text-center">
              2015 - IBM DEL PERU S.A.C.
              <a href="index.php" class="go-top">
                  <i class="fa fa-angle-up"></i>
              </a>
          </div>
      </footer>
      <!--footer end-->
  </section>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="../Recursos/assets/js/jquery.js"></script>
    <script src="../Recursos/assets/js/jquery-1.8.3.min.js"></script>
    <script src="../Recursos/assets/js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="../Recursos/assets/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="../Recursos/assets/js/jquery.scrollTo.min.js"></script>
    <script src="../Recursos/assets/js/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="../Recursos/assets/js/jquery.sparkline.js"></script>
    <script type="text/javascript" src="../Recursos/js/JSGeneral.js"></script>

    <!--common script for all pages-->
    <script src="../Recursos/assets/js/common-scripts.js"></script>
    
    <script type="text/javascript" src="../Recursos/assets/js/gritter/js/jquery.gritter.js"></script>
    <script type="text/javascript" src="../Recursos/assets/js/gritter-conf.js"></script>

    <!--script for this page-->
    <script src="../Recursos/assets/js/sparkline-chart.js"></script>    
	<script src="../Recursos/assets/js/zabuto_calendar.js"></script>	
	
	<script type="text/javascript">
        $(document).ready(function () {
        var unique_id = $.gritter.add({
            // (string | mandatory) the heading of the notification
            title: 'Bienvenido al Sistema de SCHEDULE!',
            // (string | mandatory) the text inside the notification
            text: 'Para conocer mas sobre nuestra empresa por favor ingresar a nuestra web <a href="http://www.ibm.com/" target="_blank" style="color:#ffd777">IBM DEL PERU</a>',
            // (string | optional) the image to display on the left
            image: '../Recursos/assets/img/ui-sam.jpg',
            // (bool | optional) if you want it to fade out on its own or just sit there
            sticky: true,
            // (int | optional) the time you want it to be alive for before fading out
            time: '',
            // (string | optional) the class name you want to apply to that specific message
            class_name: 'my-sticky-class'
        });

        return false;
        });
	</script>
	
	<script type="application/javascript">
        $(document).ready(function () {
            $("#date-popover").popover({html: true, trigger: "manual"});
            $("#date-popover").hide();
            $("#date-popover").click(function (e) {
                $(this).hide();
            });
        
            $("#my-calendar").zabuto_calendar({
                action: function () {
                    return myDateFunction(this.id, false);
                },
                action_nav: function () {
                    return myNavFunction(this.id);
                },
                ajax: {
                    url: "show_data.php?action=1",
                    modal: true
                },
                legend: [
                    {type: "text", label: "Special event", badge: "00"},
                    {type: "block", label: "Regular event", }
                ]
            });
        });
        
        
        function myNavFunction(id) {
            $("#date-popover").hide();
            var nav = $("#" + id).data("navigation");
            var to = $("#" + id).data("to");
            console.log('nav ' + nav + ' to: ' + to.month + '/' + to.year);
        }
    </script>
  

  </body>
</html>
