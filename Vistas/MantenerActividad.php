<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("location:login.php");
}
include_once '../DAO/Registro/Actividad.php';
include_once '../DAO/Registro/Actividad_Dia.php';
include_once '../DAO/Registro/Sede.php';
include_once '../DAO/Registro/Periodo.php';
include_once '../DAO/Registro/Cliente.php';
include_once '../DAO/Registro/Servidor.php';
include_once '../DAO/Registro/Procedimiento.php';
include_once '../DAO/Registro/Turno.php';
include_once '../DAO/Registro/Dia.php';
//include_once '../DAO/Registro/Periodo.php';


$dia = new Dia();
$dias = $dia->listar();

$privilegios = $_SESSION['array_menus'];
$servidor = new Servidor();
$servidores = $servidor->listar_act();


$sede = new Sede();
$sedes = $sede->listar();

$periodo = new Periodo();
$periodos = $periodo->listar_act();

$procedimiento = new Procedimiento();
$procedimientos = $procedimiento->listar_act();

$cliente = new Cliente();
$clientes = $cliente->listar_act();

$actividad = new Actividad();

if (isset($_SESSION['accion_actividad']) && $_SESSION['accion_actividad'] != '') {

    if ($_SESSION['accion_actividad'] == 'busqueda') {
        $actividades = $_SESSION['arreglo_buscado_actividad'];
    } else {
        $actividades = $actividad->listar();
    }
} else {
    $actividades = $actividad->listar();
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
        <link href="../Recursos/../Recursos/assets/css/bootstrap.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="../Recursos/assets/js/gritter/css/jquery.gritter.css" />
        <!--external css-->
        <link href="../Recursos/../Recursos/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />

        <!-- Custom styles for this template -->
        <link href="../Recursos/../Recursos/assets/css/style.css" rel="stylesheet">
        <link href="../Recursos/css/StyleGeneral.css" rel="stylesheet">
        <link href="../Recursos/../Recursos/assets/css/style-responsive.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.3.1/css/buttons.dataTables.min.css">

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
                      <a class="active" href="javascript:;" >
                          <i class="fa fa-tasks"></i>
                          <span>Actividad</span>
                      </a>
                      <ul class="sub">
                          <li class="active"><a  href="MantenerActividad.php">Consultar Actividades</a></li>
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
                    <h3><i class="fa fa-angle-right"></i> ADMINISTRAR ACTIVIDADES</h3>

                    <form class="form-horizontal style-form" action="../Controles/Registro/CActividad.php" method="POST">
                        <input type="hidden" name="hidden_actividad" value="buscar" id="hiddenactividad">    
                        <!-- Opciones de Busqueda -->
                        <div class="row mt">
                            <div class="col-lg-12">
                                <div class="form-panel">
                                    <h4 class="mb"><i class="fa fa-angle-right"></i> OPCIONES DE BUSQUEDA</h4>

                                    <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">SEDE</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="c_sede" id="id_sede_sc" onchange="cargarTurnosPorSedeSc();">

                                            <option value="0">--SELECCIONE--</option>
                                                                        <?php foreach ($sedes as $s) {   
                                                                          ?>

                                                                          <option value="<?php echo $s['sede_idsede']; ?>"><?php echo $s['sede_nombre']; ?></option>
                                                                      <?php } ?>

                                                      </select>
                                    </div>
                          </div>
                          <div id="divTurnosSc">
                              
                          </div>
                                    
                          <div class="form-group">
                                        <label class="col-sm-2 col-sm-2 control-label">DIA</label>
                                          <div class="col-sm-10">
                                              <select class="form-control" name="c_dia" id="id_cliente">

                                                      <option value="0">--SELECCIONE--</option>
                                                                                  <?php foreach ($dias as $d) {   
                                                                                    ?>

                                                                                    <option value="<?php echo $d['dia_iddia']; ?>"><?php echo $d['dia_nombre']; ?></option>
                                                                                <?php } ?>

                                                  </select>
                                              </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="col-sm-2 col-sm-2 control-label">PERIODO</label>
                                          <div class="col-sm-10">
                                                  <select class="form-control" name="c_periodo" id="id_periodo">

                                                      <option value="0">--SELECCIONE--</option>
                                                                                  <?php foreach ($periodos as $p) {   
                                                                                    ?>

                                                                                    <option value="<?php echo $p['periodo_idperiodo']; ?>"><?php echo $p['periodo_nombre']; ?></option>
                                                                                <?php } ?>

                                                                </select>
                                              </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="col-sm-2 col-sm-2 control-label">CLIENTE</label>
                                          <div class="col-sm-10">
                                                  <select class="form-control" name="c_cliente" id="id_cliente" required>

                                                      <option value="0">--SELECCIONE--</option>
                                                                                  <?php foreach ($clientes as $c) {   
                                                                                    ?>

                                                                                    <option value="<?php echo $c['cliente_idcliente']; ?>"><?php echo $c['cliente_nombre']; ?></option>
                                                                                <?php } ?>

                                                                </select>
                                              </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 col-sm-2 control-label">DESCRIPCIÓN</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="t_desc" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label">SERVIDOR (HOSTNAME)</label>
                                      <div class="col-sm-10">
                                              <select class="form-control" name="c_servidor" id="id_servidor" >

                                                  <option value="0">--SELECCIONE--</option>
                                                                              <?php foreach ($servidores as $s) {   
                                                                                ?>

                                                                                <option value="<?php echo $s['servidor_idservidor']; ?>"><?php echo $s['servidor_hostname'].' ('.$s['servidor_ip'].') '; ?></option>
                                                                            <?php } ?>

                                                            </select>
                                          </div>
                                   </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 col-sm-2 control-label">PROCEDIMIENTOS</label>
                                          <div class="col-sm-10">
                                                  <select class="form-control" name="c_procedimiento" id="id_procedimiento" >

                                                      <option value="0">--SELECCIONE--</option>
                                                                                  <?php foreach ($procedimientos as $p) {   
                                                                                    ?>

                                                                                    <option value="<?php echo $p['procedimiento_idprocedimiento']; ?>"><?php echo $p['procedimiento_nombre']; ?></option>
                                                                                <?php } ?>

                                                                </select>
                                              </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 col-sm-2 control-label">ESTADO ACTIVIDAD</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" name="c_estado">
                                                <option value="3">--SELECCIONE--</option>
                                                <option value="1">ACTIVO</option>
                                                <option value="0">INACTIVO</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 col-sm-2 control-label">FECHA DE REGISTRO</label>
                                        <div class="col-sm-10">
                                            <input type="date" name="t_fecha_reg" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 col-sm-2 control-label"></label>
                                        <div class="col-sm-10">
                                            <button type="submit" class="btn btn-theme03"><i class="fa fa-search"></i> BUSCAR</button>
                                        </div>
                                    </div>

                                </div>
                            </div><!-- col-lg-12-->      	
                        </div><!-- /row -->
                    </form>


                    <div class="row mt">
                        <div class="col-md-12">
                            <div class="content-panel">
                                <table id="example1" class="table table-responsive table-advance table-hover">
                                    <h4><i class="fa fa-angle-right"></i> RESULTADO DE BUSQUEDA DE ACTIVIDADES</h4>
                                     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span style="background-color:#68FF7E;font-weight: bold;">&nbsp;&nbsp;&nbsp;&nbsp;</span>&nbsp;&nbsp;&nbsp;&nbsp;TAREAS POR TWS
                                    <hr>

<?php if ($actividades != null) { ?>
                                        <thead>
                                            <tr style="font-size:6pt;font-weight: bold;">
                                                <th width="5%"><i></i> N</th>
                                                <th width="5%"><i></i> HORA EJECUCIÓN</th>   
                                                <th width="5%"><i></i> HORA TERMINO</th>
<!--                                                <th><i></i> DURACIÓN</th>-->
<!--                                                <th><i></i> INTER TURNO</th>-->
                                                <th width="25%"><i></i> DESCRIPCIÓN</th>
                                                <th width="5%"><i></i> DÍAS</th>
                                                <th width="5%"><i></i> HOLA LIMITE</th>
<!--                                                <th><i></i> PLATAFORMA</th>
                                                <th><i></i> T. RESPALDO</th>-->
                                                <th width="10%"><i></i> PERIODO</th>
                                                <th width="10%"><i></i> PROCEDIMIENTO</th>
                                                <th width="10%"><i></i> CLIENTE</th>
                                                <th width="14%"><i></i> SERVIDOR</th>
<!--                                                <th><i></i> CATEGORIA</th>
                                                <th><i></i> SUBCATEGORIA</th>-->
<!--                                                <th><i></i> FECHA DE REGISTRO</th>-->
                                                <th width="3%"><i></i></th>
                                                <th width="3%"><i></i></th>
                                                <th width="3%"><i></i></th>
                                            </tr>
                                        </thead>
                                        <tbody>
    <?php
    $num = 1;
    foreach ($actividades as $r) {
        ?>
                                                <tr style="font-size:8pt;" <?php if($r['actividad_tws']=='1')echo 'bgcolor="68FF7E"';?>>
                                                    <td style="font-size:5pt;" width="5%"><?php echo $num;
                                        $num++; ?></td>
                                                    <td style="font-size:5pt;" width="5%"><?php echo $r['actividad_horaejecucion'] ?></td>
                                                    <td style="font-size:5pt;" width="5%"><?php echo $r['actividad_horatermino'] ?></td>
<!--                                                    <td><?php echo $r['actividad_duracion'] ?></td>-->
<!--                                                    <td><?php if ($r['actividad_interturno'] == '1'){ echo 'SI';} ?>
                                                        <?php if ($r['actividad_interturno'] == '2'){ echo 'NO';} ?>
                                                    </td>-->
                                                    <td style="color:black;font-weight:bold;" width="25%"><?php echo $r['actividad_descripcion'] ?></td>
                                                    <td width="5%">
                                                    <?php
                                                        $dia= new Actividad_Dia();
                                                        $dia->setIdactividad($r['actividad_idactividad']);
                                                        $dias= $dia->dias_por_actividad($dia);
                                                         ?>
                                                        <?php if ($dias != null) { ?>
                                                        <?php foreach ($dias as $d) {   
                                                                    ?>
                                                        <label class="checkbox-inline">
                                                        <input type="checkbox" id="inlineCheckbox<?php echo $d['dia_iddia']; ?>" name="check_list[]" checked disabled value="<?php echo $d['dia_iddia']; ?>"> <?php if($d['dia_iddia']=='1'){echo "LUNES";}
                                                                                                                                                                                                                    if($d['dia_iddia']=='2'){echo "MARTES";}
                                                                                                                                                                                                                    if($d['dia_iddia']=='3'){echo "MIERCOLES";}
                                                                                                                                                                                                                    if($d['dia_iddia']=='4'){echo "JUEVES";}
                                                                                                                                                                                                                    if($d['dia_iddia']=='5'){echo "VIERNES";}
                                                                                                                                                                                                                    if($d['dia_iddia']=='6'){echo "SABADO";}
                                                                                                                                                                                                                    if($d['dia_iddia']=='7'){echo "DOMINGO";}?>
                                                        </label><br>
                                                         <?php } ?>
                                                        <?php } else {?>
                                                        <div class="alert alert-danger"><i class="fa fa-warning"></i><b> Advertencia!</b><br>Aún No se han asignado<br>Días para ejecución de <br>esta tarea..!</div> 
                                                        <?php } ?>
                                                    </td>
                                                    <td style="font-size:5pt;" width="5%"><?php echo $r['actividad_horalimite'] ?></td>
<!--                                                    <td><?php if ($r['actividad_plataforma'] == '1'){ echo 'BCRS';} ?>
                                                        <?php if ($r['actividad_plataforma'] == '2'){ echo 'SYSTEM I';} ?>
                                                        <?php if ($r['actividad_plataforma'] == '3'){ echo 'SYSTEM P';} ?>
                                                        <?php if ($r['actividad_plataforma'] == '4'){ echo 'SYSTEM X';} ?>
                                                    </td>
                                                    <td><?php if ($r['actividad_tiporespaldo'] == '1'){ echo 'OFFLINE';} ?>
                                                        <?php if ($r['actividad_tiporespaldo'] == '2'){ echo 'ONLINE';} ?>
                                                        <?php if ($r['actividad_tiporespaldo'] == '3'){ echo 'N.A';} ?>
                                                    </td>-->
                                                    
                                                    <td style="font-size:6pt;" width="10%"><?php echo $r['periodo_nombre'] ?></td>
                                                    <td style="font-size:6pt;" width="10%"><a href="../Controles/Registro/Procedimientos/<?php echo $r['procedimiento_archivo']?>" target="_new"><?php echo $r['procedimiento_nombre'] ?></a></td>
                                                    <td style="font-size:6pt;" width="10%"><?php echo $r['cliente_nombre'] ?></td>
                                                    <td style="font-size:6pt;" width="14%"><?php echo $r['servidor_hostname'].' ('.$r['servidor_ip'].')' ?></td>
<!--                                                    <td><?php echo $r['categoria_nombre'] ?></td>
                                                    <td><?php echo $r['subcategoria_nombre'] ?></td>-->
<!--                                                    <td><?php echo $r['actividad_fecharegistro'] ?></td>-->
                                                    <td style="font-size:6pt;" width="3%">
                                                        <div id="estado_<?php echo $r['actividad_idactividad'] ?>">
                                                         <?php if($r['actividad_estado'] == '1') { ?>
                                                            <input type="hidden" name="id_hidden_eliminar" id="id_hidden_eliminar<?php echo $r['actividad_idactividad'] ?>" value="<?php echo $r['actividad_idactividad'] ?>">
<!--                                                            <input type="hidden" name="hidden_actividad" value="anular">-->
                                                            <input type="hidden" name="hidden_estado" id="hidden_estado<?php echo $r['actividad_idactividad'] ?>" value="activo">
                                                            <button type="button" class="btn btn-success btn-xs" onclick="cambiarestado('<?php echo $r['actividad_idactividad'] ?>');" title="Desactivar"><i class="fa fa-check"></i></button>
                                                          <?php } else { ?>  
                                                             <input type="hidden" name="id_hidden_eliminar" id="id_hidden_eliminar<?php echo $r['actividad_idactividad'] ?>" value="<?php echo $r['actividad_idactividad'] ?>">
<!--                                                            <input type="hidden" name="hidden_actividad" value="anular">-->
                                                            <input type="hidden" name="hidden_estado" id="hidden_estado<?php echo $r['actividad_idactividad'] ?>" value="inactivo">
                                                            <button type="button" class="btn btn-danger btn-xs" onclick="cambiarestado('<?php echo $r['actividad_idactividad'] ?>');" title="Activar"><i class="fa fa-warning"></i></button>
                                                          <?php } ?>
                                                        </div>
                                                        
                                                    </td>
                                                    <td style="font-size:6pt;" width="3%">
                                                        <form method='POST' id="formusu" action="../Controles/Registro/CActividad.php">
                                                            <input type="hidden" name="hidden_actividad" value="buscarid">
                                                            <input type="hidden" name="idactividad" value="<?php echo $r['actividad_idactividad'] ?>">
                                                            <button type="submit" class="btn btn-primary btn-xs" title="Editar"><i class="fa fa-pencil"></i></button>
                                                        </form>    
                                                    </td>
                                                    <td style="font-size:6pt;" width="3%">
                                                        <div id="tws_<?php echo $r['actividad_idactividad'] ?>">
                                                         <?php if($r['actividad_tws'] == '1') { ?>
                                                            <input type="hidden" name="id_hidden_tws" id="id_hidden_tws<?php echo $r['actividad_idactividad'] ?>" value="<?php echo $r['actividad_idactividad'] ?>">
                                                            <input type="hidden" name="hidden_tws" id="hidden_tws<?php echo $r['actividad_idactividad'] ?>" value="activo">
                                                            <button type="button" class="btn btn-theme02 btn-xs" onclick="cambiartws('<?php echo $r['actividad_idactividad'] ?>');" title="Desactivar">Activo</button>
                                                          <?php } else if($r['actividad_tws'] == '2') { ?>  
                                                             <input type="hidden" name="id_hidden_tws" id="id_hidden_tws<?php echo $r['actividad_idactividad'] ?>" value="<?php echo $r['actividad_idactividad'] ?>">
                                                             <input type="hidden" name="hidden_tws" id="hidden_tws<?php echo $r['actividad_idactividad'] ?>" value="inactivo">
                                                             <button type="button" class="btn btn-warning btn-xs" onclick="cambiartws('<?php echo $r['actividad_idactividad'] ?>');" title="Activar">Inactivo</button>
                                                          <?php } ?>
                                                        </div>
                                                        
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
                        </div><!-- /col-md-12 -->
                    </div><!-- /row -->

                </section><! --/wrapper -->
            </section><!-- /MAIN CONTENT -->

            <!--main content end-->
            <!--footer start-->
            <footer class="site-footer">
                <div class="text-center">
                    Copyright &copy; <?php echo date("Y");?> - IBM DEL PERU - SYS-OPS
                    <a href="MantenerActividad.php" class="go-top">
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
        <script type="text/javascript" src="../Recursos/js/JSGeneral.js"></script>

        <!--common script for all pages-->
        <script src="../Recursos/../Recursos/assets/js/common-scripts.js"></script>

        <!--script for this page-->
    <script type="text/javascript" src="../Recursos/assets/js/gritter/js/jquery.gritter.js"></script>
    <script type="text/javascript" src="../Recursos/assets/js/gritter-conf.js"></script>
       !--        <script src="code.jquery.com/jquery-1.12.4.js"></script>-->
        <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.3.1/js/dataTables.buttons.min.js"></script>
<!--       <script src="cdn.datatables.net/buttons/1.3.1/js/buttons.flash.min.js"></script -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<!--       <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/pdfmake.min.js"></script>   -->
<!--       <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/vfs_fonts.js"></script>-->
        <script src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.html5.min.js"></script>
<!--        <script src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.print.min.js"></script>-->


        <script>
        $(document).ready(function() {
    $('#example1').DataTable( {
        dom: 'Bfrtip',
        buttons : [
								{
								extend : 'pageLength',
								text : '<i class="fa fa-list-ol" aria-hidden="true" style="font-size:8pt;color:black; font-weight: bold;"> &nbsp;&nbsp; MOSTRAR</i>',
							},
							{
								extend : 'excelHtml5',
								text : '<i class="fa fa-file-excel-o" style="font-size:8pt;color:black; font-weight: bold;">&nbsp;&nbsp; DESCARGAR EN EXCEL</i>',
// 								className : 'btn btn-default',
								customize : function(
										xlsx) {
									var sheet = xlsx.xl.worksheets['reporte_schedule.xml'];

									// jQuery selector to add a border
									$('row c[r*="10"]',sheet).attr('s','25');
								}
							} ]
    } );
} );
 </script> 

    </body>
</html>
