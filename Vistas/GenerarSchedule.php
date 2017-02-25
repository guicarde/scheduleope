<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("location:login.php");
}
//------------------------------------------------
if(!isset($_SESSION['accion_schedule'])){ 
    $_SESSION['accion_schedule']="";
}
include_once '../DAO/Registro/Sede.php';
include_once '../DAO/Registro/Turno.php';
include_once '../DAO/Registro/Dia.php';
//include_once '../DAO/Registro/Periodo.php';

$sede = new Sede();
$sedes = $sede->listar();

$dia = new Dia();
$dias = $dia->listar();

//$periodo = new Periodo();
//$periodos = $periodo->listar_act();


if (isset($_SESSION['accion_schedule']) && $_SESSION['accion_schedule'] != '') {

    if ($_SESSION['accion_schedule'] == 'busqueda_act') {
        $actividades = $_SESSION['arreglo_buscado_actividad_sc'];
    }
    
} else {
        $actividades = null;
    }

$privilegios = $_SESSION['array_menus'];


if(isset($_SESSION['fecha']))         { $fecha = $_SESSION['fecha'];} else{ $fecha =""; }
if(isset($_SESSION['id_sede']))         { $idsede = $_SESSION['id_sede'];} else{ $idsede =""; }
if(isset($_SESSION['id_turno']))         { $idturno = $_SESSION['id_turno'];} else{ $idturno =""; }
if(isset($_SESSION['id_periodo']))         { $idperiodo = $_SESSION['id_periodo'];} else{ $idperiodo =""; }
if(isset($_SESSION['id_dia']))         { $iddia = $_SESSION['id_dia'];} else{ $iddia =""; }


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
    <link rel="stylesheet" type="text/css" href="../Recursos/assets/js/bootstrap-datepicker/css/datepicker.css" />
    <link rel="stylesheet" type="text/css" href="../Recursos/assets/js/bootstrap-daterangepicker/daterangepicker.css" />
    <!-- para calendario -->
    <link href="../Recursos/assets/js/fullcalendar/bootstrap-fullcalendar.css" rel="stylesheet" />
    <!-- Aaqui muere -->    
    <!-- Custom styles for this template -->
    <link href="../Recursos/assets/css/style.css" rel="stylesheet">
    <link href="../Recursos/assets/css/style-responsive.css" rel="stylesheet">

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
                      <a href="index.php">
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
                          <li><a  href="GuardarUsuario.php">Registrar Usuario</a></li>
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
                      <a  class="active" href="javascript:;" >
                          <i class="fa fa-bookmark"></i>
                          <span>Shedule</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="MantenerSchedule.php">Consultar Schedule</a></li>
                          <li class="active"><a  href="GenerarSchedule.php">Generar Schedule</a></li>
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
                  
                   <?php } ?>
                  <?php } ?>
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-clock-o"></i>
                          <span>Tareas Pendientes</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="TareasPendientes.php">Tareas Pendientes</a></li>
                      </ul>
                  </li>
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
          	<h3><i class="fa fa-angle-right"></i> GENERAR SCHEDULE</h3> 
                <form class="form-horizontal style-form" id="form_schedule" action="../Controles/Registro/CSchedule.php" method="POST">
                    <input type="hidden" name="hidden_schedule" id="hiddenschedule" value="">  
                <input type="hidden" name="idschedule" value=""/>
               
                     <!-- Datos del Usuario -->
          	<div class="row mt">
          		<div class="col-lg-12">
                  <div class="form-panel">
                  	  <h4 class="mb"><i class="fa fa-angle-right"></i> SELECCIONE LOS FILTROS NECESARIOS PARA GENERAR EL SCHEDULE</h4>
                                          
                          
                     
                          
                        <div class="form-group">
                                        <label class="col-sm-2 col-sm-2 control-label">FECHA DE SCHEDULE</label>
                                        <div class="col-sm-10">
                                            <input type="date" name="t_fecha_sc" class="form-control" value="<?php echo $fecha;?>" required>
                                        </div>
                        </div>
                         <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">SEDE</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="c_sede" id="id_sede_sc" onchange="cargarTurnosPorSedeSc();" required>

                                            <option value="0">--SELECCIONE--</option>
                                                                        <?php foreach ($sedes as $s) {   
                                                                          ?>

                                                                          <option value="<?php echo $s['sede_idsede']; ?>" <?php if ($idsede == $s['sede_idsede']) echo 'selected'; ?>><?php echo $s['sede_nombre']; ?></option>
                                                                      <?php } ?>

                                                      </select>
                                    </div>
                          </div>
                          <div id="divTurnosSc">
                              
                          </div>
                                    
                                    <div class="form-group">
                                        <label class="col-sm-2 col-sm-2 control-label">DIA</label>
                                          <div class="col-sm-10">
                                              <select class="form-control" name="c_dia" id="id_cliente" required>

                                                      <option value="">--SELECCIONE--</option>
                                                                                  <?php foreach ($dias as $d) {   
                                                                                    ?>

                                                                                    <option value="<?php echo $d['dia_iddia']; ?>" <?php if ($iddia == $d['dia_iddia']) echo 'selected'; ?>><?php echo $d['dia_nombre']; ?></option>
                                                                                <?php } ?>

                                                  </select>
                                              </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 col-sm-2 control-label"></label>
                                        <div class="col-sm-10">
                                            <button type="button" class="btn btn-theme03" onclick="BuscarSchedule();"><i class="fa fa-search"></i> BUSCAR</button>
                                        </div>
                                    </div>
                          
                  
                  </div>
                            
                            
          		</div>
                </div>
                 
                 <div class="row mt">
                        <div class="col-md-12">
                            <div class="content-panel">
                                <table class="table table-striped table-advance table-hover">
                                    <h4><i class="fa fa-angle-right"></i> RESULTADO DE BUSQUEDA DE ACTIVIDADES</h4>
                                    <hr>

<?php if ($actividades != null) { ?>
                                        <thead>
                                            <tr style="font-size:6pt;font-weight: bold;">
                                                <th><i></i> N°</th>
                                                <th><i></i> TIPO</th>
                                                <th><i></i> HORA EJECUCIÓN</th>                                                
                                                <th><i></i> INTER TURNO</th>
                                                <th><i></i> DESCRIPCIÓN</th>
                                                <th><i></i> HORA LIMITE</th>
                                                <th><i></i> PLATAFORMA</th>
                                                <th><i></i> T. RESPALDO</th>
                                                <th><i></i> PERIODO</th>
                                                <th><i></i> PROCEDIMIENTO</th>
                                                <th><i></i> CLIENTE</th>
                                                <th><i></i> SERVIDOR</th>
                                                <th><i></i> CATEGORIA</th>
                                                <th><i></i> SUBCATEGORIA</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                            <?php
                            $num = 1;
                            foreach ($actividades as $r) {
                                ?>
                                                <tr style="font-size:8pt;">
                                                    <td><?php echo $num;
                                        $num++; ?></td>
                                                    <td><?php if ($r['actividad_tipo'] == '1'){ echo 'CORTO';} ?>
                                                        <?php if ($r['actividad_tipo'] == '2'){ echo 'LARGO';} ?>
                                                    </td>
                                                    <td><?php echo $r['actividad_horaejecucion'] ?></td>
                                                    <td><?php if ($r['actividad_interturno'] == '1'){ echo 'SI';} ?>
                                                        <?php if ($r['actividad_interturno'] == '2'){ echo 'NO';} ?>
                                                    </td>
                                                    <td><?php echo $r['actividad_descripcion'] ?></td>
                                                    <td><?php echo $r['actividad_horalimite'] ?></td>
                                                    <td><?php if ($r['actividad_plataforma'] == '1'){ echo 'BCRS';} ?>
                                                        <?php if ($r['actividad_plataforma'] == '2'){ echo 'SYSTEM I';} ?>
                                                        <?php if ($r['actividad_plataforma'] == '3'){ echo 'SYSTEM P';} ?>
                                                        <?php if ($r['actividad_plataforma'] == '4'){ echo 'SYSTEM X';} ?>
                                                    </td>
                                                    <td><?php if ($r['actividad_tiporespaldo'] == '1'){ echo 'OFFLINE';} ?>
                                                        <?php if ($r['actividad_tiporespaldo'] == '2'){ echo 'ONLINE';} ?>
                                                        <?php if ($r['actividad_tiporespaldo'] == '3'){ echo 'N.A';} ?>
                                                    </td>
                                                    
                                                    <td><?php echo $r['periodo_nombre'] ?></td>
                                                    
                                                    <td><a href="../Controles/Registro/Procedimientos/<?php echo $r['procedimiento_archivo']?>" target="_new"><?php echo $r['procedimiento_nombre'] ?></a></td>
                                                    <td>
                                                    <input type="hidden"  name="t_activ<?php echo $r['actividad_idactividad']?>" value="<?php echo $r['actividad_idactividad']?>" >                                                  
                                                    <?php echo $r['cliente_nombre'] ?>
                                                    </td>
                                                    <td><?php echo $r['servidor_hostname'].' ('.$r['servidor_ip'].')' ?></td>
                                                    <td><?php echo $r['categoria_nombre'] ?></td>
                                                    <td><?php echo $r['subcategoria_nombre'] ?></td>                                                 
                                                    
                                                </tr>
                                            <?php } ?>

                                        </tbody>
                                    <?php } else { ?>

<!--                                        <div class="alerta">
                                            <table align="left">
                                                <tr><td></td></tr>
                                                <tr>
                                                    <td>&nbsp;&nbsp;&nbsp;</td>
                                                    <td>
                                                        <img class="image-alerta" src="../Recursos/Imagenes/caution.png">
                                                    </td>    
                                                    <td>
                                                        <label class="LText"><b>Aún no se han asignado Documento(s).</b></label>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>-->
<div class="alert alert-danger"><i class="fa fa-warning"></i><b> Error!</b><br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Su búsqueda no produjo ningún resultado..!</div> 
<!--                                        <center><label>Su búsqueda no produjo ningún resultado. </label></center>-->


                                    <?php } ?>
                                </table>
                                
                            </div><!-- /content-panel -->
                            <br>
                                <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label"></label>
                              <div class="col-sm-10">
                                  <button type="button" class="btn btn-theme" onclick="guardarSchedule();"><i class="fa fa-check"></i> GUARDAR</button>
                                  <button type="button" class="btn btn-danger"  onclick="cancelar();"><i class="fa fa-trash-o"></i> CANCELAR</button>
                              </div>
                          </div>
                        </div><!-- /col-md-12 -->
                    </div>
                   <!-- /row -->
              
                </form>
         
          	 
          	
		</section><! --/wrapper -->
      </section><!-- /MAIN CONTENT -->

      <!--main content end-->
      <!--footer start-->
      <footer class="site-footer">
          <div class="text-center">
              2015 - IBM OPERATION SERVICE
              <a href="GenerarSchedule.php" class="go-top">
                  <i class="fa fa-angle-up"></i>
              </a>
          </div>
      </footer>
      <!--footer end-->
  </section>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="../Recursos/assets/js/jquery.js"></script>
    <script src="../Recursos/assets/js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="../Recursos/assets/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="../Recursos/assets/js/jquery.scrollTo.min.js"></script>
    <script src="../Recursos/assets/js/jquery.nicescroll.js" type="text/javascript"></script>


    <!--common script for all pages-->
    <script src="../Recursos/assets/js/common-scripts.js"></script>

    <!--script for this page-->
    <script src="../Recursos/assets/js/jquery-ui-1.9.2.custom.min.js"></script>

	<!--custom switch-->
	<script src="../Recursos/assets/js/bootstrap-switch.js"></script>
	
	<!--custom tagsinput-->
	<script src="../Recursos/assets/js/jquery.tagsinput.js"></script>
        
        <!-- para calendario -->
        <script src="../Recursos/assets/js/fullcalendar/fullcalendar.min.js"></script>   
        <script src="../Recursos/assets/js/calendar-conf-events.js"></script>   
	<!-- para calendario -->
        
	<!--custom checkbox & radio-->
	
	<script type="text/javascript" src="../Recursos/assets/js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
	<script type="text/javascript" src="../Recursos/assets/js/bootstrap-daterangepicker/date.js"></script>
	<script type="text/javascript" src="../Recursos/assets/js/bootstrap-daterangepicker/daterangepicker.js"></script>
	
	<script type="text/javascript" src="../Recursos/assets/js/bootstrap-inputmask/bootstrap-inputmask.min.js"></script>
        <script type="text/javascript" src="../Recursos/js/JSGeneral.js"></script>
	
	<script src="../Recursos/assets/js/form-component.js"></script>    
 
    
  <script>
      //custom select box

      $(function(){
          $('select.styled').customSelect();
      });

  </script>

   <?php if(isset($_SESSION['accion_schedule'])){ 
     if($_SESSION['accion_schedule']=='busqueda_act'){

    ?>
    <script type="text/javascript">
        
   
             cargarTurnosPorSedeSc();
  
    </script>

    <?php }}?>   

  </body>
</html>