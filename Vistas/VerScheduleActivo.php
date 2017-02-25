<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("location:login.php");
}

include_once '../DAO/Registro/Schedule.php';
include_once '../DAO/Registro/Usuario.php';
include_once '../DAO/Registro/Cliente_Final.php';
include_once '../DAO/Registro/Cliente.php';
$privilegios = $_SESSION['array_menus'];

//
//$idusu = $_SESSION['id_username'];
//$usuario = new Usuario();
//$usuario->setId($idusu);
//$usuarios=$usuario->listar_conectado($usuario);


$cliente = new Cliente();
$cliente->setIdschedule($_SESSION['id_schedule']);
$clientes = $cliente->listar_por_schedule($cliente);

$clientefin = new Cliente_Final();
$clientesfin = $clientefin->listar_act();

$ventmax = new Schedule();
$ventmax->setId($_SESSION['id_schedule']);
$ventanas=$ventmax->listar_act_ventana_maxima($ventmax);

if (isset($_SESSION['accion_schedule']) && $_SESSION['accion_schedule'] != '') {

    if ($_SESSION['accion_schedule'] == 'detalle_schedule') {
        $actividades = $_SESSION['arreglo_actividad_por_schedule'];
    } 
    if ($_SESSION['accion_schedule'] == 'filtro_schedule_activo') {
        $actividades = $_SESSION['arreglo_filtro_schedule'];
    }
} 

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <META HTTP-EQUIV="REFRESH" CONTENT="300;URL=DetalleScheduleOpe.php">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="Dashboard">
        <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

        <title>SISTEMA DE GENERACIÓN DE SCHEDULE</title>

        <!-- Bootstrap core CSS -->
        <link href="../Recursos/../Recursos/assets/css/bootstrap.css" rel="stylesheet">
         <link rel="stylesheet" type="text/css" href="../Recursos/assets/js/gritter/css/jquery.gritter.css" />
        <!--external css-->
        <link href="../Recursos/../Recursos/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />

        <!-- Custom styles for this template -->
        <link href="../Recursos/../Recursos/assets/css/style.css" rel="stylesheet">
        <link href="../Recursos/css/StyleGeneral.css" rel="stylesheet">
        <link href="../Recursos/../Recursos/assets/css/style-responsive.css" rel="stylesheet">

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
                      <a class="active" href="javascript:;" >
                          <i class="fa fa-fax"></i>
                          <span>Ejecutar Schedule</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="SeleccionarSchedule.php">Seleccionar Schedule</a></li>
                          <li><a  href="MisSchedules.php">Mis Schedules</a></li>
                          <li><a  href="SchedulesActivos.php">Schedules Activos</a></li>
                          <li><a  href="SchedulesFinalizados.php">Schedules Finalizados</a></li>
                          <li class="active"><a  href="VerScheduleActivo.php">Ver Schedule Activo</a></li>
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
                    <h3><i class="fa fa-angle-right"></i> VER SCHEDULE ACTIVO</h3>
                    <form class="form-horizontal style-form" action="../Controles/Registro/CSchedule.php" method="POST">
                        <input type="hidden" name="hidden_schedule" value="filtrarscheduleactivo" id="hiddenfiltro">    
                        <!-- Opciones de Busqueda -->
                        <div class="row mt">
                            <div class="col-lg-12">
                                <div class="form-panel">
                                    <h4 class="mb"><i class="fa fa-angle-right"></i> OPCIONES DE FILTRO</h4>
                                    
                                    <div class="form-group">
                                    <label class="col-sm-1 col-sm-1 control-label">CLIENTE</label>
                                      <div class="col-sm-2">
                                              <select class="form-control" name="c_cliente" id="id_cliente_fin" required>

                                                  <option value="0">--SELECCIONE--</option>
                                                                              <?php foreach ($clientes as $c) {   
                                                                                ?>

                                                                                <option value="<?php echo $c['cliente_idcliente']; ?>"><?php echo $c['cliente_nombre']; ?></option>
                                                                            <?php } ?>

                                                            </select>
                                          </div>
                                       <label class="col-sm-1 col-sm-1 control-label">ESTADO</label>
                                        <div class="col-sm-2">
                                            <select class="form-control" name="c_estado">
                                                <option value="">--SELECCIONE--</option>
                                                <option value="2">ATENDIDO</option>
                                                <option value="1">NO ATENDIDO</option>
                                            </select>
                                        </div>
                                       
                                       <label class="col-sm-2 col-sm-2 control-label">DESCRIPCIÓN DE TAREA</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="t_descripcion" class="form-control">
                                        </div>
                                   </div>
                                   <div class="form-group" align="center">
                                        <div class="col-sm-10">
                                            <button type="submit" class="btn btn-theme03"><i class="fa fa-search"></i> FILTRAR</button>
                                        </div>
                                    </div>

                                </div>
                            </div><!-- col-lg-12-->      	
                        </div><!-- /row -->
                    </form>

                    <div class="row mt">
                        <div class="col-md-12">
                            <div class="content-panel">
                                <table class="table table-striped table-advance table-hover">
                                    <h4><i class="fa fa-angle-right"></i> DETALLE DE ACTIVIDADES DEL SCHEDULE</h4>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span style="background-color:#68FF7E;font-weight: bold;">&nbsp;&nbsp;&nbsp;&nbsp;</span>&nbsp;&nbsp;&nbsp;&nbsp;TAREAS POR TWS
                                    <hr>

<?php if ($actividades != null) { ?>
                                        <thead>
                                            <tr style="font-size:6pt;font-weight: bold;">
                                                <th><i></i> N°</th>
                                                <th><i></i> HORA EJECUCIÓN</th>   
                                                <th><i></i> DESCRIPCIÓN</th>
                                                <th><i></i> HORA LIMITE</th>
<!--                                                <th><i></i> PLATAFORMA</th>-->
<!--                                                <th><i></i> TIPO RESPALDO</th>-->
<!--                                                <th><i></i> SUBCATEGORIA R.</th>-->
                                                <th><i></i> PERIODO</th>
                                                <th><i></i> PROCEDIMIENTO</th>
                                                <th><i></i> CLIENTE</th>
                                                <th><i></i> SERVIDOR</th>
                                                <th><i></i> COMENTARIO</th>
<!--                                                <th><i></i> INICIO</th>
                                                <th><i></i> FINALIZACIÓN</th>
                                                <th><i></i> OBSERVACIÓN</th>
                                                <th><i></i> ASIGNAR</th>-->
                                            </tr>
                                        </thead>
                                        <tbody>
                            <?php
                            $num = 1;
                            foreach ($actividades as $r) {                              
                                ?>
                                                <tr style="font-size:8pt;"  <?php if($r['actividad_tws']=='1')echo 'bgcolor="68FF7E"';?>>
                                                    <td><?php echo $num;
                                        $num++; ?></td>
                                                    <td><?php echo $r['actividad_horaejecucion'] ?></td>
                                                    <td><?php echo $r['actividad_descripcion'] ?></td>
                                                    <td><?php echo $r['actividad_horalimite'] ?></td>
<!--                                                    <td><?php if ($r['actividad_plataforma'] == '1'){ echo 'BCRS';} ?>
                                                        <?php if ($r['actividad_plataforma'] == '2'){ echo 'SYSTEM I';} ?>
                                                        <?php if ($r['actividad_plataforma'] == '3'){ echo 'SYSTEM P';} ?>
                                                        <?php if ($r['actividad_plataforma'] == '4'){ echo 'SYSTEM X';} ?>
                                                    </td>-->
<!--                                                    <td><?php if ($r['actividad_tiporespaldo'] == '1'){ echo 'OFFLINE';} ?>
                                                        <?php if ($r['actividad_tiporespaldo'] == '2'){ echo 'ONLINE';} ?>
                                                        <?php if ($r['actividad_tiporespaldo'] == '3'){ echo 'N.A';} ?>
                                                    </td>-->

                                                    <td><?php echo $r['periodo_nombre'] ?></td>
                                                    
                                                    <td><a href="../Controles/Registro/Procedimientos/<?php echo $r['procedimiento_archivo']?>" target="_new"><?php echo $r['procedimiento_nombre'] ?></a></td>
                                                    <td>
                                                    <input type="hidden"  name="t_activ<?php echo $r['actividad_idactividad']?>" value="<?php echo $r['actividad_idactividad']?>" >                                                  
                                                    <?php echo $r['cliente_nombre'] ?>
                                                    </td>
                                                    <td><?php echo $r['servidor_hostname'].' ('.$r['servidor_ip'].')' ?></td>
                                                    
                                                    <td>
                                                        <a onclick="ventana('<?php if ($r['actividad_comentario']!=null){ echo $r['actividad_comentario'];}else {echo 'NO TIENE COMENTARIO';} ?>')" class="btn btn-info  btn-sm" >Comentario</a>
                                                        <!--
                                                        <a id="add-without-image" class="btn btn-info  btn-sm" href="javascript:;">Comentario</a>
                                                        -->
                                                    </td>
                                                    
                                                      
                                                    
                                                    
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
                                  <button type="button" class="btn btn-theme" onclick="cerrarSchedule();"><i class="fa fa-check"></i> GUARDAR</button>
                                  <button type="button" class="btn btn-danger"  onclick="cancelar();"><i class="fa fa-trash-o"></i> CANCELAR</button>
                              </div>
                          </div>
                        </div><!-- /col-md-12 -->
                    </div>
            
                </section><! --/wrapper -->
            </section><!-- /MAIN CONTENT -->

            <!--main content end-->
            <!--footer start-->
            <footer class="site-footer">
                <div class="text-center">
                    2015 - IBM OPERATION SERVICE
                    <a href="VerScheduleActivo.php" class="go-top">
                        <i class="fa fa-angle-up"></i>
                    </a>
                </div>
            </footer>
            <!--footer end-->
        </section>

        <!-- js placed at the end of the document so the pages load faster -->
        <script src="../Recursos/../Recursos/assets/js/jquery.js"></script>
        <script src="../Recursos/../Recursos/assets/js/bootstrap.min.js"></script>
        <script class="include" type="text/javascript" src="../Recursos/../Recursos/assets/js/jquery.dcjqaccordion.2.7.js"></script>
        <script src="../Recursos/../Recursos/assets/js/jquery.scrollTo.min.js"></script>
        <script src="../Recursos/../Recursos/assets/js/jquery.nicescroll.js" type="text/javascript"></script>
        <!-- Unicas Librerias Utiliazabas para subir archivos imagens, audio, etc-->
        <link href="../Recursos/filebootstrap/kartik-v-bootstrap-fileinput-d66e684/css/fileinput.css" media="all" rel="stylesheet" type="text/css" />
        <script src="../Recursos/filebootstrap/kartik-v-bootstrap-fileinput-d66e684/js/fileinput.js" type="text/javascript"></script>    
        <!-- fin -->
        <script type="text/javascript" src="../Recursos/js/JSGeneral.js"></script>
        <!--common script for all pages-->
        <script src="../Recursos/../Recursos/assets/js/common-scripts.js"></script>
        <!--script for this page-->
    <!--script for this page-->
    <script type="text/javascript" src="../Recursos/assets/js/gritter/js/jquery.gritter.js"></script>
    <script type="text/javascript" src="../Recursos/assets/js/gritter-conf.js"></script>
    <?php if ($ventanas != null) { ?>
                        <?php
                            $num = 1;
                            foreach ($ventanas as $v) {                              
                         ?>
        <script type="text/javascript">
        $(document).ready(function () {
        var unique_id = $.gritter.add({
            // (string | mandatory) the heading of the notification
            title: 'VENTANA MÁXIMA',
            // (string | mandatory) the text inside the notification
            text: '<marquee direction="up" behavior="alternate">TAREA:<br><?php echo $v['actividad_descripcion'];?> <br><br>Cliente:<?php echo $v['cliente_nombre'];?> <br><br>Hora Máxima de Ventana: <?php echo $v['actividad_ventana_max'];?> <br><br>Accion a Tomar: <?php echo $v['actividad_accion'];?></marquee> ',
            // (string | optional) the image to display on the left
            image: '../Recursos/assets/img/limites.jpg',
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
        <?php } ?> 
    <?php } ?>  
        
    </body>
</html>
