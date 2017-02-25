<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("location:login.php");
}
//------------------------------------------------
if(!isset($_SESSION['accion_actividad'])){ 
    $_SESSION['accion_actividad']="";
}

if(!isset($_SESSION['arreglo_turnos'])){ 
    $_SESSION['arreglo_turnos']="";
}

include_once '../DAO/Registro/Actividad.php';
include_once '../DAO/Registro/Sede.php';
include_once '../DAO/Registro/Turno.php';
include_once '../DAO/Registro/Dia.php';
include_once '../DAO/Registro/Categoria.php';
include_once '../DAO/Registro/Periodo.php';
include_once '../DAO/Registro/Procedimiento.php';
include_once '../DAO/Registro/Cliente.php';
include_once '../DAO/Registro/Servidor.php';

$sede = new Sede();
$sedes = $sede->listar();

$dia = new Dia();
$dias = $dia->listar();

$periodo = new Periodo();
$periodos = $periodo->listar_act();

$procedimiento = new Procedimiento();
$procedimientos = $procedimiento->listar_act();

$cliente = new Cliente();
$clientes = $cliente->listar_act();

$servidor = new Servidor();
$servidores = $servidor->listar_act();

$categoria = new Categoria();
$categorias = $categoria->listar();

$tipoactividad = new Actividad();
$tiposact = $tipoactividad->listar_tipo_actividad();



$privilegios = $_SESSION['array_menus'];

if(isset($_SESSION['actividad_idactividad']))         { $idactividad = $_SESSION['actividad_idactividad'];} else{ $idactividad =""; }
if(isset($_SESSION['actividad_tipo']))         { $tipo = $_SESSION['actividad_tipo'];} else{ $tipo =""; }
if(isset($_SESSION['actividad_horaejecucion']))         { $horaeje = $_SESSION['actividad_horaejecucion'];} else{ $horaeje =""; }
if(isset($_SESSION['actividad_interturno']))         { $interturno = $_SESSION['actividad_interturno'];} else{ $interturno =""; }
if(isset($_SESSION['actividad_excepcion']))         { $excepcion = $_SESSION['actividad_excepcion'];} else{ $excepcion =""; }
if(isset($_SESSION['actividad_descripcion']))         { $descripcion = $_SESSION['actividad_descripcion'];} else{ $descripcion =""; }
if(isset($_SESSION['actividad_horalimite']))         { $horalim = $_SESSION['actividad_horalimite'];} else{ $horalim =""; }
if(isset($_SESSION['actividad_plataforma']))         { $plataforma = $_SESSION['actividad_plataforma'];} else{ $plataforma =""; }
if(isset($_SESSION['actividad_tiporespaldo']))         { $tiporesp = $_SESSION['actividad_tiporespaldo'];} else{ $tiporesp =""; }
if(isset($_SESSION['periodo_idperiodo']))         { $idperiodo = $_SESSION['periodo_idperiodo'];} else{ $idperiodo =""; }
if(isset($_SESSION['sede_idsede']))         { $idsede = $_SESSION['sede_idsede'];} else{ $idsede =""; }
if(isset($_SESSION['procedimiento_idprocedimiento']))         { $idproc = $_SESSION['procedimiento_idprocedimiento'];} else{ $idproc =""; }
if(isset($_SESSION['cliente_idcliente']))         { $idcli = $_SESSION['cliente_idcliente'];} else{ $idcli =""; }
if(isset($_SESSION['servidor_idservidor']))         { $idserv = $_SESSION['servidor_idservidor'];} else{ $idserv =""; }
if(isset($_SESSION['actividad_estado']))         { $estado = $_SESSION['actividad_estado'];} else{ $estado =""; }
if(isset($_SESSION['actividad_fecharegistro']))         { $fechareg = $_SESSION['actividad_fecharegistro'];} else{ $fechareg =""; }
if(isset($_SESSION['categoria_idcategoria']))         { $idcat = $_SESSION['categoria_idcategoria'];} else{ $idcat =""; }
if(isset($_SESSION['subcategoria_idsubcategoria']))         { $idsubcat = $_SESSION['subcategoria_idsubcategoria'];} else{ $idsubcat =""; }
if(isset($_SESSION['actividad_horatermino']))         { $horaterm = $_SESSION['actividad_horatermino'];} else{ $horaterm =""; }
if(isset($_SESSION['actividad_duracion']))         { $duracion = $_SESSION['actividad_duracion'];} else{ $duracion =""; }
if(isset($_SESSION['actividad_tier']))         { $tier = $_SESSION['actividad_tier'];} else{ $tier =""; }
if(isset($_SESSION['actividad_interacciones']))         { $inter = $_SESSION['actividad_interacciones'];} else{ $inter =""; }
if(isset($_SESSION['actividad_tipoproceso']))         { $tipoproc = $_SESSION['actividad_tipoproceso'];} else{ $tipoproc =""; }
if(isset($_SESSION['actividad_comentario']))         { $comentario = $_SESSION['actividad_comentario'];} else{ $comentario =""; }
if(isset($_SESSION['actividad_ventana_max']))         { $ventana = $_SESSION['actividad_ventana_max'];} else{ $ventana =""; }
if(isset($_SESSION['actividad_accion']))         { $accion = $_SESSION['actividad_accion'];} else{ $accion =""; }
if(isset($_SESSION['actividad_tws']))         { $tws = $_SESSION['actividad_tws'];} else{ $tws =""; }
if(isset($_SESSION['tipoactividad_idtipoactividad']))         { $idtipoact = $_SESSION['tipoactividad_idtipoactividad'];} else{ $idtipoact =""; }


if (isset($_SESSION['accion_actividad']) && $_SESSION['accion_actividad'] == 'editar') {
$diast = $_SESSION['arreglo_dias'];
//var_dump($diast);
//exit();
}

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
                      <a class="active"  href="javascript:;" >
                          <i class="fa fa-tasks"></i>
                          <span>Actividad</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="MantenerActividad.php">Consultar Actividades</a></li>
                          <li class="active"><a  href="GuardarActividad.php">Registrar Actividad</a></li>
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
          	<h3><i class="fa fa-angle-right"></i> REGISTRAR ACTIVIDAD</h3> 
                
                
                     
                     <!-- Datos del Usuario -->
          	<div class="row mt">
          		<div class="col-lg-12">
                  <div class="form-panel">
                  	  <h4 class="mb"><i class="fa fa-angle-right"></i> DATOS DE LA ACTIVIDAD</h4>
                    
                 <form class="form-horizontal style-form" action="../Controles/Registro/CActividad.php" method="POST" >
                 <input type="hidden" id="hiddenactividad" name="hidden_actividad" value="save">  
                 <input type="hidden" name="idactividad" value="<?php echo $idactividad ?>"/>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">SEDE</label>
                                <div class="col-sm-10">
                                        <select class="form-control" name="c_sede" id="id_sede" onchange="cargarTurnosPorSede();">

                                            <option value="0">--SELECCIONE--</option>
                                                                        <?php foreach ($sedes as $s) {   
                                                                          ?>

                                                                          <option value="<?php echo $s['sede_idsede']; ?>" <?php if ($idsede == $s['sede_idsede']) echo 'selected'; ?>><?php echo $s['sede_nombre']; ?></option>
                                                                      <?php } ?>

                                                      </select>
                                    </div>
                          </div>
                          <div id="divTurnos">
                              
                          </div>
                          <div class="form-group">
                                        <label class="col-sm-2 col-sm-2 control-label">TIPO</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" name="c_tipo" required>
                                                <option value="">--SELECCIONE--</option>
                                                <option value="1" <?php if ($tipo == '1') echo 'selected'; ?>>CORTO</option>
                                                <option value="2" <?php if ($tipo == '2') echo 'selected'; ?>>LARGO</option>
                                            </select>
                                        </div>
                        </div>
                        <div class="form-group">
                                        <label class="col-sm-2 col-sm-2 control-label">EXCEPCIÓN</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" name="c_excepcion">
                                                <option value="">--SELECCIONE--</option>
                                                <option value="1" <?php if ($excepcion == '1') echo 'selected'; ?>>SI</option>
                                                <option value="2" <?php if ($excepcion == '2') echo 'selected'; ?>>NO</option>
                                            </select>
                                        </div>
                        </div>
                        <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">CATEGORIA</label>
                                <div class="col-sm-10">
                                        <select class="form-control" id="id_categoria"  name="c_categoria" onchange="cargarSubcatPorCat();" required>

                                            <option>--SELECCIONE--</option>
                                                                        <?php foreach ($categorias as $c) {   
                                                                          ?>

                                                                          <option value="<?php echo $c['categoria_idcategoria']; ?>" <?php if ($idcat == $c['categoria_idcategoria']) echo 'selected'; ?> ><?php echo $c['categoria_nombre']; ?></option>
                                                                      <?php } ?>

                                                      </select>
                                    </div>
                          </div>
                          <div id="divSubCategoria">
                              
                          </div>
                        <div class="form-group">
                                        <label class="col-sm-2 col-sm-2 control-label">SELECCIONAR DÍAS</label>
                                        <div class="col-sm-10">                                            
                                            <?php foreach ($dias as $d) { 
                                                    
                                                ?>
                                            
                                            <label class="checkbox-inline">
                                                <input type="checkbox" id="inlineCheckbox<?php echo $d['dia_iddia']; ?>" name="check_list[]" value="<?php echo $d['dia_iddia']; ?>" <?php if (isset($_SESSION['accion_actividad']) && $_SESSION['accion_actividad'] == 'editar') { if ($diast != null) { foreach ($diast as $t) { if ($t['dia_iddia'] == $d['dia_iddia']) echo 'checked'; }} }?>> <?php echo $d['dia_nombre']; ?>
                                            </label>
                                            <br>
                                                    <?php } ?>                                   
                                        </div>
                        </div>  
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">HORA EJECUCIÓN</label>
                              <div class="col-sm-10">
                                  <input type="time" name="t_hora" maxlength="8" value="<?php echo $horaeje; ?>" class="form-control" required>
                              </div>
                          </div>
                          
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">HORA TERMINACIÓN</label>
                              <div class="col-sm-10">
                                  <input type="time" name="t_hora_ter" value="<?php echo $horaterm; ?>" maxlength="8" class="form-control" required>
                              </div>
                          </div>
                         
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">PERIODO</label>
                                <div class="col-sm-10">
                                        <select class="form-control" name="c_periodo" id="id_periodo">

                                            <option>--SELECCIONE--</option>
                                                                        <?php foreach ($periodos as $p) {   
                                                                          ?>

                                                                          <option value="<?php echo $p['periodo_idperiodo']; ?>" <?php if ($idperiodo == $p['periodo_idperiodo']) echo 'selected'; ?>><?php echo $p['periodo_nombre']; ?></option>
                                                                      <?php } ?>

                                                      </select>
                                    </div>
                          </div>
                          
                          
<!--                          <aside class="col-lg-9 mt">
                                <section class="panel">
                                    <div class="panel-body">
                                        <div id="calendar" class="has-toolbar"></div>
                                    </div>
                                </section>
                          </aside>  SCRIPT PARA GENERAR EL CALENDARIO AGENDA-->
                        
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">PROCEDIMIENTOS</label>
                                <div class="col-sm-10">
                                        <select class="form-control" name="c_procedimiento" id="id_procedimiento" >

                                            <option>--SELECCIONE--</option>
                                                                        <?php foreach ($procedimientos as $p) {   
                                                                          ?>

                                                                          <option value="<?php echo $p['procedimiento_idprocedimiento']; ?>" <?php if ($idproc == $p['procedimiento_idprocedimiento']) echo 'selected'; ?>><?php echo $p['procedimiento_nombre']; ?></option>
                                                                      <?php } ?>

                                                      </select>
                                    </div>
                          </div>
                            <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">CLIENTE</label>
                                <div class="col-sm-10">
                                        <select class="form-control" name="c_cliente" id="id_cliente" required>

                                            <option>--SELECCIONE--</option>
                                                                        <?php foreach ($clientes as $c) {   
                                                                          ?>

                                                                          <option value="<?php echo $c['cliente_idcliente']; ?>" <?php if ($idcli == $c['cliente_idcliente']) echo 'selected'; ?>><?php echo $c['cliente_nombre']; ?></option>
                                                                      <?php } ?>

                                                      </select>
                                    </div>
                             </div>
                             <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">SERVIDOR (HOSTNAME)</label>
                                <div class="col-sm-10">
                                        <select class="form-control" name="c_servidor" id="id_servidor" >

                                            <option>--SELECCIONE--</option>
                                                                        <?php foreach ($servidores as $s) {   
                                                                          ?>

                                                                          <option value="<?php echo $s['servidor_idservidor']; ?>" <?php if ($idserv == $s['servidor_idservidor']) echo 'selected'; ?>><?php echo $s['servidor_hostname'] .' '.$s['servidor_ip'] ?></option>
                                                                      <?php } ?>

                                                      </select>
                                    </div>
                             </div>
                             
                             <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">DESCRIPCIÓN DE LA ACTIVIDAD</label>
                              <div class="col-sm-10">
                                  <textarea name="ta_descripcion" id="id_descripcion" class="form-control" rows="8" required><?php echo $descripcion;?></textarea>
                              </div>
                          </div>
                          
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">HORA LIMITE</label>
                              <div class="col-sm-10">
                                  <input type="time" name="t_hora_limite" value="<?php echo $horalim;?>" id="id_horalimite" class="form-control">
                              </div>
                          </div>

                          <div class="form-group">
                                        <label class="col-sm-2 col-sm-2 control-label">INTER TURNOS</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" name="c_inter_turnos">
                                                <option value="">--SELECCIONE--</option>
                                                <option value="1" <?php if ($interturno == '1') echo 'selected'; ?>>SI</option>
                                                <option value="2" <?php if ($interturno == '2') echo 'selected'; ?>>NO</option>
                                            </select>
                                        </div>
                        </div>
                        
                        <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">PLATAFORMA</label>
                              <div class="col-sm-10">
                                  <select class="form-control" name="c_plataforma" required>
                                                <option value="-1">--SELECCIONE--</option>
                                                <option value="1" <?php if ($plataforma == '1') echo 'selected'; ?>>BCRS</option>
                                                <option value="2" <?php if ($plataforma == '2') echo 'selected'; ?>>SYSTEM I</option>
                                                <option value="3" <?php if ($plataforma == '3') echo 'selected'; ?>>SYSTEM P</option>
                                                <option value="4" <?php if ($plataforma == '4') echo 'selected'; ?>>SYSTEM X</option>
                                            </select>
                              </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">TWS</label>
                                <div class="col-sm-10">
                                            <select class="form-control" name="c_tws">
                                                <option value="">--SELECCIONE--</option>
                                                <option value="1" <?php if ($tws == '1') echo 'selected'; ?>>SI</option>
                                                <option value="2" <?php if ($tws == '2') echo 'selected'; ?>>NO</option>
                                            </select>
                                        </div>
                          </div>

                        <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">TIPO DE RESPALDO</label>
                                <div class="col-sm-10">
                                            <select class="form-control" name="c_tipo_respaldo">
                                                <option value="">--SELECCIONE--</option>
                                                <option value="1" <?php if ($tiporesp == '1') echo 'selected'; ?>>OFFLINE</option>
                                                <option value="2" <?php if ($tiporesp == '2') echo 'selected'; ?>>ONLINE</option>
                                                <option value="3" <?php if ($tiporesp == '3') echo 'selected'; ?>>N.A</option>
                                            </select>
                                        </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">TIPO DE PROCESO</label>
                                <div class="col-sm-10">
                                            <select class="form-control" name="c_tipo_proceso" required>
                                                <option value="">--SELECCIONE--</option>
                                                <option value="1" <?php if ($tipoproc == '1') echo 'selected'; ?>>AUTOMÁTICO</option>
                                                <option value="2" <?php if ($tipoproc == '2') echo 'selected'; ?>>MANUAL</option>
                                            </select>
                                        </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">COMENTARIO</label>
                              <div class="col-sm-10">
                                  <textarea name="ta_comentario" id="id_comentario" class="form-control" rows="8"><?php echo $comentario;?></textarea>
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">VENTANA MÁXIMA</label>
                              <div class="col-sm-10">
                                  <input type="time" name="t_ventana" value="<?php echo $ventana;?>" id="id_ventanamax" class="form-control">
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">ACCIÓN A TOMAR</label>
                              <div class="col-sm-10">
                                  <input type="time" name="t_accion" value="<?php echo $accion;?>" id="id_accion" class="form-control">
                              </div>
                          </div>

<!--                        <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">SUBCATEGORIA RESPALDO</label>
                                <div class="col-sm-10">
                                            <select class="form-control" name="c_subcat">
                                                <option value="">--SELECCIONE--</option>
                                                <option value="1">BASE DE DATOS</option>
                                                <option value="2">CONFIGURACIÓN SAP</option>
                                                <option value="3">JOURNAL</option>
                                                <option value="4">N.A</option>
                                                <option value="5">OPCIÓN 21</option>
                                                <option value="6">OPCIÓN 22</option>
                                            </select>
                                        </div>
                          </div>-->
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">TIPO ACTIVIDAD</label>
                                <div class="col-sm-10">
                                        <select class="form-control" name="c_tipo_actividad" required>

                                            <option value="">--SELECCIONE--</option>
                                                                        <?php foreach ($tiposact as $t) {   
                                                                          ?>

                                                                          <option value="<?php echo $t['tipoactividad_idtipoactividad']; ?>" <?php if ($idtipoact == $t['tipoactividad_idtipoactividad']) echo 'selected'; ?>><?php echo $t['tipoactividad_nombre']; ?></option>
                                                                      <?php } ?>

                                                      </select>
                                    </div>
                             </div>


                        <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label"></label>
                              <div class="col-sm-10">
                                  <button type="submit" class="btn btn-theme"><i class="fa fa-check"></i> GUARDAR</button>
                                  <button type="button" class="btn btn-danger" onclick="cancelar();"><i class="fa fa-trash-o"></i> CANCELAR</button>
                              </div>
                          </div>

                    </form>      
                         
                  </div>
                            
                            
          		</div><!-- col-lg-12-
                ->      	
-->          	</div>
                
<!--                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						  <div class="modal-dialog">
						    <div class="modal-content">
						      <div class="modal-header">
						        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						        <h4 class="modal-title" id="myModalLabel">Mensaje</h4>
						      </div>
						      <div class="modal-body">
						        Se ha registrado satisfactoriamente el procedimiento.
						      </div>
						      <div class="modal-footer">
						        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
						        <button type="button" class="btn btn-primary">Guardar Cambios</button>
						      </div>
						    </div>
						  </div>
						</div> -->
         
          	
          	
		</section>
      </section><!-- /MAIN CONTENT -->

      <!--main content end-->
      <!--footer start-->
      <footer class="site-footer">
          <div class="text-center">
              2015 - IBM OPERATION SERVICE
              <a href="GuardarProcedimiento.php" class="go-top">
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
  <?php if(isset($_SESSION['accion_actividad'])){ 
     if($_SESSION['accion_actividad']=='editar'){

    ?>
    <script type="text/javascript">
        
   
             cargarTurnosPorSede();
             cargarSubcatPorCat();
    </script>

    <?php }}?>
    

  </body>
</html>
