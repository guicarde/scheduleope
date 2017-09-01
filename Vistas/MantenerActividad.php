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
include_once '../DAO/Registro/Categoria.php';
include_once '../DAO/Registro/Actividad_Dia.php';
include_once '../DAO/Registro/Periodo.php';

$categoria = new Categoria();
$categorias = $categoria->listar();

$dia = new Dia();
$dias = $dia->listar();

$dia2 = new Dia();
$dias2 = $dia2->listar();

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

$tipoactividad = new Actividad();
$tiposact = $tipoactividad->listar_tipo_actividad();



if (isset($_SESSION['accion_actividad']) && $_SESSION['accion_actividad'] != '') {

    if ($_SESSION['accion_actividad'] == 'busqueda') {
        $actividades = $_SESSION['arreglo_buscado_actividad'];
    } else {
        $actividades = null;
    }
} else {
    $actividades = null;
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
        <link href="../Recursos/assets/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="../Recursos/assets/js/gritter/css/jquery.gritter.css" />
        <!--external css-->
        <link href="../Recursos/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    
        <!-- Custom styles for this template -->
        <link href="../Recursos/assets/css/style.css" rel="stylesheet">
        <link href="../Recursos/css/StyleGeneral.css" rel="stylesheet">
        <link href="../Recursos/assets/css/style-responsive.css" rel="stylesheet">
        <script type="text/javascript" src="../Recursos/js/JSGeneral.js"></script>
        <!-- Select2 -->
        <link rel="stylesheet" href="plugins/select2/select2.min.css">
<!--        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">-->
    
        <!--        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
                <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.3.1/css/buttons.dataTables.min.css">-->

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
                            <?php foreach ($privilegios as $p) { ?>

                                <?php if ($p['menu_idmenu'] == 1) { ?>
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
                                <?php if ($p['menu_idmenu'] == 2) { ?>
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
                                <?php if ($p['menu_idmenu'] == 3) { ?>
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
                                <?php if ($p['menu_idmenu'] == 4) { ?>
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
                                <?php if ($p['menu_idmenu'] == 5) { ?>
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
                                <?php if ($p['menu_idmenu'] == 6) { ?>
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
                                <?php if ($p['menu_idmenu'] == 7) { ?>
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
                                <?php if ($p['menu_idmenu'] == 8) { ?>
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
                                <?php if ($p['menu_idmenu'] == 9) { ?>
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
                                            <select class="form-control select2" name="c_sede" id="id_sede_sc" onchange="cargarTurnosPorSedeSc();">

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
                                            <select class="form-control select2" name="c_dia" id="id_cliente">

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
                                            <select class="form-control select2" name="c_periodo" id="id_periodo">

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
                                            <select class="form-control select2" name="c_cliente" id="id_cliente" required>

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
                                            <select class="form-control select2" name="c_servidor" id="id_servidor" >

                                                <option value="0">--SELECCIONE--</option>
                                                <?php foreach ($servidores as $s) {
                                                    ?>

                                                    <option value="<?php echo $s['servidor_idservidor']; ?>"><?php echo $s['servidor_hostname'] . ' (' . $s['servidor_ip'] . ') '; ?></option>
                                                <?php } ?>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 col-sm-2 control-label">PROCEDIMIENTOS</label>
                                        <div class="col-sm-10">
                                            <select class="form-control select2" name="c_procedimiento" id="id_procedimiento" >

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
                                            <select class="form-control select2" name="c_estado">
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
                               <div class="table-responsive">
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
                                                <th width="25%"><i></i> DESCRIPCIÓN</th>
                                                <th width="5%"><i></i> DÍAS</th>
                                                <th width="5%"><i></i> HOLA LIMITE</th>
                                                <th width="10%"><i></i> PERIODO</th>
                                                <th width="10%"><i></i> PROCEDIMIENTO</th>
                                                <th width="10%"><i></i> CLIENTE</th>
                                                <th width="14%"><i></i> SERVIDOR</th>
                                                <th width="3%"><i></i></th>
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
                                                <tr style="font-size:8pt;" <?php if ($r['actividad_tws'] == '1') echo 'bgcolor="68FF7E"'; ?>>
                                                    <td style="font-size:5pt;" width="5%"><?php
                                                        echo $num;
                                                        $num++;
                                                        ?></td>
                                                    <td style="font-size:5pt;" width="5%"><?php echo $r['actividad_horaejecucion'] ?></td>
                                                    <td style="font-size:5pt;" width="5%"><?php echo $r['actividad_horatermino'] ?></td>
        <!--                                                    <td><?php echo $r['actividad_duracion'] ?></td>-->
        <!--                                                    <td><?php
                                                    if ($r['actividad_interturno'] == '1') {
                                                        echo 'SI';
                                                    }
                                                    ?>
                                                    <?php
                                                    if ($r['actividad_interturno'] == '2') {
                                                        echo 'NO';
                                                    }
                                                    ?>
                                                    </td>-->
                                                    <td style="color:black;font-weight:bold;" width="25%"><?php echo $r['actividad_descripcion'] ?></td>
                                                    <td width="5%">
                                                        <?php
                                                        $dia = new Actividad_Dia();
                                                        $dia->setIdactividad($r['actividad_idactividad']);
                                                        $dias = $dia->dias_por_actividad($dia);
                                                        ?>
                                                        <?php if ($dias != null) { ?>
                                                            <?php foreach ($dias as $d) {
                                                                ?>
                                                                <label class="checkbox-inline">
                                                                    <input type="checkbox" id="inlineCheckbox<?php echo $d['dia_iddia']; ?>" name="check_list[]" checked disabled value="<?php echo $d['dia_iddia']; ?>"> <?php
                                                                    if ($d['dia_iddia'] == '1') {
                                                                        echo "LUNES";
                                                                    }
                                                                    if ($d['dia_iddia'] == '2') {
                                                                        echo "MARTES";
                                                                    }
                                                                    if ($d['dia_iddia'] == '3') {
                                                                        echo "MIERCOLES";
                                                                    }
                                                                    if ($d['dia_iddia'] == '4') {
                                                                        echo "JUEVES";
                                                                    }
                                                                    if ($d['dia_iddia'] == '5') {
                                                                        echo "VIERNES";
                                                                    }
                                                                    if ($d['dia_iddia'] == '6') {
                                                                        echo "SABADO";
                                                                    }
                                                                    if ($d['dia_iddia'] == '7') {
                                                                        echo "DOMINGO";
                                                                    }
                                                                    ?>
                                                                </label><br>
                                                            <?php } ?>
                                                        <?php } else { ?>
                                                            <div class="alert alert-danger"><i class="fa fa-warning"></i><b> Advertencia!</b><br>Aún No se han asignado<br>Días para ejecución de <br>esta tarea..!</div> 
                                                        <?php } ?>
                                                    </td>
                                                    <td style="font-size:5pt;" width="5%"><?php echo $r['actividad_horalimite'] ?></td>
        <!--                                                    <td><?php
                                                    if ($r['actividad_plataforma'] == '1') {
                                                        echo 'BCRS';
                                                    }
                                                    ?>
                                                    <?php
                                                    if ($r['actividad_plataforma'] == '2') {
                                                        echo 'SYSTEM I';
                                                    }
                                                    ?>
                                                    <?php
                                                    if ($r['actividad_plataforma'] == '3') {
                                                        echo 'SYSTEM P';
                                                    }
                                                    ?>
                                                    <?php
                                                    if ($r['actividad_plataforma'] == '4') {
                                                        echo 'SYSTEM X';
                                                    }
                                                    ?>
                                                    </td>
                                                    <td><?php
                                                    if ($r['actividad_tiporespaldo'] == '1') {
                                                        echo 'OFFLINE';
                                                    }
                                                    ?>
                                                    <?php
                                                    if ($r['actividad_tiporespaldo'] == '2') {
                                                        echo 'ONLINE';
                                                    }
                                                    ?>
                                                    <?php
                                                    if ($r['actividad_tiporespaldo'] == '3') {
                                                        echo 'N.A';
                                                    }
                                                    ?>
                                                    </td>-->

                                                    <td style="font-size:6pt;" width="10%"><?php echo $r['periodo_nombre'] ?></td>
                                                    <td style="font-size:6pt;" width="10%"><a><?php echo $r['procedimiento_nombre'] ?></a></td>
                                                    <td style="font-size:6pt;" width="10%"><?php echo $r['cliente_nombre'] ?></td>
                                                    <td style="font-size:6pt;" width="14%"><?php echo $r['servidor_hostname'] . ' (' . $r['servidor_ip'] . ')' ?></td>
        <!--                                                    <td><?php echo $r['categoria_nombre'] ?></td>
                                                    <td><?php echo $r['subcategoria_nombre'] ?></td>-->
        <!--                                                    <td><?php echo $r['actividad_fecharegistro'] ?></td>-->
                                                    <td style="font-size:6pt;" width="3%">
                                                        <div id="estado_<?php echo $r['actividad_idactividad'] ?>">
                                                            <?php if ($r['actividad_estado'] == '1') { ?>
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
                                                        <button type="button" class="btn btn-theme" data-toggle="modal" data-target="#exampleModal<?php echo $r['actividad_idactividad']; ?>"><i class="fa fa-pencil"> </i><b>&nbsp; EDITAR ACTIVIDAD</b></button>
                                                        <form action="../Controles/Registro/CActividad.php" method="POST">
                                                            <div class="modal fade" id="exampleModal<?php echo $r['actividad_idactividad']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                            <h4 class="modal-title" id="exampleModalLabel">EDITAR ACTIVIDAD</h4>
                                                                        </div>

                                                                        <div class="modal-body">

                                                                            <input type="hidden" name="hidden_actividad" value="actualizar">
                                                                            <input type="hidden" name="idactividad" value="<?php echo $r['actividad_idactividad']; ?>"/>
                                                                            <input type="hidden" name="idsubcaterogiap" id="id_subcaterogia<?php echo $r['actividad_idactividad']; ?>" value="<?php echo $r['subcategoria_idsubcategoria']; ?>"/>

                                                                            <div class="form-group">
                                                                                <label for="recipient-name" class="control-label">SEDE:  <a style="color:red"> (*)</a></label>
                                                                                <select class="form-control select2" style="width: 100%;" name="c_sede" id="id_sede<?php echo $r['actividad_idactividad']; ?>" onchange="cargarTurnosPorSedeEdit(<?php echo $r['actividad_idactividad']; ?>);">
                                                                                    <option value="0">--SELECCIONE--</option>
                                                                                    <?php foreach ($sedes as $s) {
                                                                                        ?>

                                                                                        <option value="<?php echo $s['sede_idsede']; ?>" <?php if ($r['sede_idsede'] == $s['sede_idsede']) echo 'selected'; ?>><?php echo $s['sede_nombre']; ?></option>
                                                                                    <?php } ?>
                                                                                </select>
                                                                            </div>
                                                                            <div id="divTurnos<?php echo $r['actividad_idactividad']; ?>"></div>
                                                                            
                                                                            <div class="form-group">
                                                                                <label for="recipient-name" class="control-label">EXCEPCIÓN:  <a style="color:red"> (*)</a></label>
                                                                                <select class="form-control select2" style="width: 100%;" name="c_excepcion" id="id_excepcion">                                                                                            
                                                                                    <option value="">--SELECCIONE--</option>
                                                                                    <option value="1" <?php if ($r['actividad_excepcion'] == '1') echo 'selected'; ?>>SI</option>
                                                                                    <option value="2" <?php if ($r['actividad_excepcion'] == '2') echo 'selected'; ?>>NO</option>

                                                                                </select>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="recipient-name" class="control-label">CATEGORIA:  <a style="color:red"> (*)</a></label>

                                                                                <?php
                                                                                $_SESSION['subcategoria_idsubcategoria'] = $r['subcategoria_idsubcategoria'];
                                                                                ?>
                                                                                <select class="form-control select2" style="width: 100%;" name="c_categoria" id="id_categoria<?php echo $r['actividad_idactividad']; ?>" onchange="cargarSubcatPorCatEdit(<?php echo $r['actividad_idactividad']; ?>);">
                                                                                    <option>--SELECCIONE--</option>
                                                                                    <?php foreach ($categorias as $c) {
                                                                                        ?>

                                                                                        <option value="<?php echo $c['categoria_idcategoria']; ?>" <?php if ($r['categoria_nombre'] == $c['categoria_nombre']) echo 'selected'; ?> ><?php echo $c['categoria_nombre']; ?></option>
                                                                                    <?php } ?>
                                                                                </select>
                                                                            </div>
                                                                            <div id="divSubCategoria<?php echo $r['actividad_idactividad']; ?>"></div>
                                                                            <div class="form-group">
                                                                                <label for="recipient-name" class="control-label">SELECCIONAR DÍAS:  <a style="color:red"> (*)</a></label><br>
                                                                                <?php
                                                                                $adia = new Actividad_Dia();
                                                                                $adia->setIdactividad($r['actividad_idactividad']);
                                                                                $adias = $adia->dias_por_actividad($adia);
                                                                                ?>
                                                                                <?php foreach ($dias2 as $d) { ?>

                                                                                    <label class="checkbox-inline">
                                                                                        <input type="checkbox" id="inlineCheckbox<?php echo $d['dia_iddia']; ?>" name="check_list[]" value="<?php echo $d['dia_iddia']; ?>" <?php
                                                                                        if ($adias != null) {
                                                                                            foreach ($adias as $t) {
                                                                                                if ($t['dia_iddia'] == $d['dia_iddia'])
                                                                                                    echo 'checked';
                                                                                            }
                                                                                        }
                                                                                        ?>> <?php echo $d['dia_nombre']; ?>
                                                                                    </label>
                                                                                    <br>
                                                                                <?php } ?>    
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="recipient-name" class="control-label">HORA EJECUCIÓN:  <a style="color:red"> (*)</a></label>
                                                                                <input type="time" name="t_hora" class="form-control" value="<?php echo $r['actividad_horaejecucion']; ?>">
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="recipient-name" class="control-label">HORA TERMINO:  <a style="color:red"> (*)</a></label>
                                                                                <input type="time" name="t_hora_ter" class="form-control" value="<?php echo $r['actividad_horatermino']; ?>">
                                                                            </div>

                                                                            <div class="form-group">
                                                                                <label for="recipient-name" class="control-label">PERIODO:  <a style="color:red"> (*)</a></label>
                                                                                <select class="form-control select2" style="width: 100%;" name="c_periodo" >
                                                                                    <option>--SELECCIONE--</option>
                                                                                    <?php foreach ($periodos as $p) {
                                                                                        ?>

                                                                                        <option value="<?php echo $p['periodo_idperiodo']; ?>" <?php if ($r['periodo_nombre'] == $p['periodo_nombre']) echo 'selected'; ?>><?php echo $p['periodo_nombre']; ?></option>
                                                                                    <?php } ?>
                                                                                </select>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="recipient-name" class="control-label">PROCEDIMIENTO:  <a style="color:red"> (*)</a></label>
                                                                                <select class="form-control select2" style="width: 100%;" name="c_procedimiento" id="id_procedimiento" >

                                                                                    <option>--SELECCIONE--</option>
                                                                                    <?php foreach ($procedimientos as $p) {
                                                                                        ?>

                                                                                        <option value="<?php echo $p['procedimiento_idprocedimiento']; ?>" <?php if ($r['procedimiento_nombre'] == $p['procedimiento_nombre']) echo 'selected'; ?>><?php echo $p['procedimiento_nombre']; ?></option>
                                                                                    <?php } ?>

                                                                                </select>
                                                                            </div> 
                                                                            <div class="form-group">
                                                                                <label for="recipient-name" class="control-label">CLIENTE:  <a style="color:red"> (*)</a></label>
                                                                                <select class="form-control select2" style="width: 100%;" name="c_cliente" >
                                                                                    <option>--SELECCIONE--</option>
                                                                                    <?php foreach ($clientes as $c) {
                                                                                        ?>

                                                                                        <option value="<?php echo $c['cliente_idcliente']; ?>" <?php if ($r['cliente_nombre'] == $c['cliente_nombre']) echo 'selected'; ?>><?php echo $c['cliente_nombre']; ?></option>
                                                                                    <?php } ?>
                                                                                </select>
                                                                                </select>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="recipient-name" class="control-label">SERVIDOR (HOSTNAME):  <a style="color:red"> (*)</a></label>
                                                                                <select class="form-control select2" style="width: 100%;" name="c_servidor" >
                                                                                    <option>--SELECCIONE--</option>
                                                                                    <?php foreach ($servidores as $s) {
                                                                                        ?>

                                                                                        <option value="<?php echo $s['servidor_idservidor']; ?>" <?php if ($r['servidor_hostname'] . ' ' . $r['servidor_ip'] == $s['servidor_hostname'] . ' ' . $s['servidor_ip']) echo 'selected'; ?>><?php echo $s['servidor_hostname'] . ' ' . $s['servidor_ip'] ?></option>
                                                                                    <?php } ?>
                                                                                </select>                                                                               
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="recipient-name" class="control-label">DESCRIPCIÓN DE LA ACTIVIDAD:  <a style="color:red"> (*)</a></label>
                                                                                <textarea name="ta_descripcion" id="id_descripcion" class="form-control" rows="8" required><?php echo $r['actividad_descripcion']; ?></textarea>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="recipient-name" class="control-label">HORA LIMITE:  <a style="color:red"> (*)</a></label>
                                                                                <input type="time" name="t_hora_limite" class="form-control" value="<?php echo $r['actividad_horalimite']; ?>">
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="recipient-name" class="control-label">INTER TURNOS:  <a style="color:red"> (*)</a></label>
                                                                                <select class="form-control select2" style="width: 100%;" name="c_inter_turnos" id="id_interturnos">                                                                                            
                                                                                    <option value="">--SELECCIONE--</option>
                                                                                    <option value="1" <?php if ($r['actividad_interturno'] == '1') echo 'selected'; ?>>SI</option>
                                                                                    <option value="2" <?php if ($r['actividad_interturno'] == '2') echo 'selected'; ?>>NO</option>

                                                                                </select>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="recipient-name" class="control-label">PLATAFORMA:  <a style="color:red"> (*)</a></label>
                                                                                <select class="form-control select2" style="width: 100%;" name="c_plataforma" id="id_plataforma">                                                                                            
                                                                                    <option value="-1">--SELECCIONE--</option>
                                                                                    <option value="1" <?php if ($r['actividad_plataforma'] == '1') echo 'selected'; ?>>BCRS</option>
                                                                                    <option value="2" <?php if ($r['actividad_plataforma'] == '2') echo 'selected'; ?>>SYSTEM I</option>
                                                                                    <option value="3" <?php if ($r['actividad_plataforma'] == '3') echo 'selected'; ?>>SYSTEM P</option>
                                                                                    <option value="4" <?php if ($r['actividad_plataforma'] == '4') echo 'selected'; ?>>SYSTEM X</option>

                                                                                </select>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="recipient-name" class="control-label">TWS:  <a style="color:red"> (*)</a></label>
                                                                                <select class="form-control select2" style="width: 100%;" name="c_tws" id="id_tws">                                                                                            
                                                                                    <option value="">--SELECCIONE--</option>
                                                                                    <option value="1" <?php if ($r['actividad_tws'] == '1') echo 'selected'; ?>>SI</option>
                                                                                    <option value="2" <?php if ($r['actividad_tws'] == '2') echo 'selected'; ?>>NO</option>
                                                                                </select>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="recipient-name" class="control-label">TIPO DE RESPALDO:  <a style="color:red"> (*)</a></label>
                                                                                <select class="form-control select2" style="width: 100%;" name="c_tipo_respaldo" id="id_tipo_respaldo">                                                                                            
                                                                                    <option value="">--SELECCIONE--</option>
                                                                                    <option value="">--SELECCIONE--</option>
                                                                                    <option value="1" <?php if ($r['actividad_tiporespaldo'] == '1') echo 'selected'; ?>>OFFLINE</option>
                                                                                    <option value="2" <?php if ($r['actividad_tiporespaldo'] == '2') echo 'selected'; ?>>ONLINE</option>
                                                                                    <option value="3" <?php if ($r['actividad_tiporespaldo'] == '3') echo 'selected'; ?>>N.A</option>
                                                                                </select>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="recipient-name" class="control-label">TIPO DE PROCESO:  <a style="color:red"> (*)</a></label>
                                                                                <select class="form-control select2" style="width: 100%;" name="c_tipo_proceso" id="id_tipo_proceso">                                                                                         
                                                                                    <option value="">--SELECCIONE--</option>
                                                                                    <option value="">--SELECCIONE--</option>
                                                                                    <option value="1" <?php if ($r['actividad_tipoproceso'] == '1') echo 'selected'; ?>>AUTOMÁTICO</option>
                                                                                    <option value="2" <?php if ($r['actividad_tipoproceso'] == '2') echo 'selected'; ?>>MANUAL</option>
                                                                                </select>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="recipient-name" class="control-label">COMENTARIO:</label>
                                                                                <textarea name="ta_comentario" id="id_comentario" class="form-control" rows="8"><?php echo $r['actividad_comentario']; ?></textarea>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="recipient-name" class="control-label">VENTANA MÁXIMA:</label>
                                                                                <input type="time" name="t_ventana" class="form-control" value="<?php echo $r['actividad_ventana_max']; ?>">
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="recipient-name" class="control-label">ACCIÓN A TOMAR:</label>
                                                                                <input type="text" name="t_accion" value="<?php echo $r['actividad_accion']; ?>" id="id_accion" class="form-control">
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="recipient-name" class="control-label">TIPO ACTIVIDAD:</label>
                                                                                <select class="form-control select2" style="width: 100%;" name="c_tipo_actividad" >
                                                                                    <option value="24">--SELECCIONE--</option>
                                                                                    <?php foreach ($tiposact as $t) { ?>
                                                                                        <option value="<?php echo $t['tipoactividad_idtipoactividad']; ?>" <?php if ($r['tipoactividad_idtipoactividad'] == $t['tipoactividad_idtipoactividad']) echo 'selected'; ?>><?php echo $t['tipoactividad_nombre']; ?></option>
                                                                                    <?php } ?>
                                                                                </select>                                                                               
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="recipient-name" class="control-label">TEAM:  <a style="color:red"> (*)</a></label>
                                                                                <select class="form-control select2" style="width: 100%;" name="c_tier" id="id_team" required>                                                                                            
                                                                                    <option value="">--SELECCIONE--</option>
                                                                                    <option value="1" <?php if ($r['actividad_tier'] == '1') echo 'selected';?>>SI</option>
                                                                                    <option value="2" <?php if ($r['actividad_tier'] == '2') echo 'selected';?>>NO</option>
                                                                                </select>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="recipient-name" class="control-label">MOTIVO DE ACTUALIZACIÓN:  <a style="color:red"> (*)</a></label>
                                                                                <select class="form-control select2" style="width: 100%;" name="c_motivo" id="id_motivo" required="">                                                                                            
                                                                                    <option value="">--SELECCIONE--</option>
                                                                                    <option value="1">ACTIVACIÓN</option>
                                                                                    <option value="2">CORREO</option>
                                                                                    <option value="3">INCIDENTE</option>
                                                                                    <option value="4">REQUERIMIENTO</option>
                                                                                </select>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="recipient-name" class="control-label">DETALLE DE MOTIVO:  <a style="color:red"> (*)</a></label>
                                                                                <input type="text" name="t_det_mot"  id="id_det_mot" class="form-control" required>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-default" data-dismiss="modal">CERRAR</button>
                                                                            <button type="submit" class="btn btn-primary">ACTUALIZAR</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form> 






                                                        <!--                                                        <form method='POST' id="formusu" action="../Controles/Registro/CActividad.php">
                                                                                                                    <input type="hidden" name="hidden_actividad" value="buscarid">
                                                                                                                    <input type="hidden" name="idactividad" value="<?php echo $r['actividad_idactividad'] ?>">
                                                                                                                    <button type="submit" class="btn btn-primary btn-xs" title="Editar"><i class="fa fa-pencil"></i></button>
                                                                                                                </form>    -->
                                                    </td>
                                                    <td style="font-size:6pt;" width="3%">
                                                        <div id="tws_<?php echo $r['actividad_idactividad'] ?>">
                                                            <?php if ($r['actividad_tws'] == '1') { ?>
                                                                <input type="hidden" name="id_hidden_tws" id="id_hidden_tws<?php echo $r['actividad_idactividad'] ?>" value="<?php echo $r['actividad_idactividad'] ?>">
                                                                <input type="hidden" name="hidden_tws" id="hidden_tws<?php echo $r['actividad_idactividad'] ?>" value="activo">
                                                                <button type="button" class="btn btn-theme02 btn-xs" onclick="cambiartws('<?php echo $r['actividad_idactividad'] ?>');" title="Desactivar">Activo</button>
                                                            <?php } else if ($r['actividad_tws'] == '2') { ?>  
                                                                <input type="hidden" name="id_hidden_tws" id="id_hidden_tws<?php echo $r['actividad_idactividad'] ?>" value="<?php echo $r['actividad_idactividad'] ?>">
                                                                <input type="hidden" name="hidden_tws" id="hidden_tws<?php echo $r['actividad_idactividad'] ?>" value="inactivo">
                                                                <button type="button" class="btn btn-warning btn-xs" onclick="cambiartws('<?php echo $r['actividad_idactividad'] ?>');" title="Activar">Inactivo</button>
                                                            <?php } ?>
                                                        </div>

                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-theme02" data-toggle="modal" data-target="#exampleModalLong<?php echo $r['actividad_idactividad']; ?>" data-whatever="@mdo"><i class="fa fa-history"> </i><b>&nbsp; VER HISTORIAL</b></button> 
                                                        <div class="modal fade" id="exampleModalLong<?php echo $r['actividad_idactividad']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLongTitleHistory">HISTORIAL DE CAMBIOS REALIZADOS</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        
                                                                        <?php 
                                                                        $auditoria = new Actividad();
                                                                        $$r['actividad_idactividad'] = $auditoria->auditoria($r['actividad_idactividad']);                                                                       
                                                                        ?>
                                                                        <div class="table-responsive">
                                                                            <table id="example1<?php echo $r['actividad_idactividad']; ?>" class="table table-responsive table-advance table-hover">
                                                                                <?php if ($$r['actividad_idactividad'] != null) { ?>
                                                                                    <thead>
                                                                                        <tr>
                                                                                            <th width="3%">N</th>
                                                                                            <th width="3%">HORA EJECUCIÓN</th>   
                                                                                            <th width="3%">HORA TERMINO</th>
                                                                                            <th width="3%">DESCRIPCIÓN</th>
                                                                                            <th width="3%">DÍAS</th>
                                                                                            <th width="3%">HOLA LIMITE</th>
                                                                                            <th width="3%">PERIODO</th>
                                                                                            <th width="3%">PROCEDIMIENTO</th>
                                                                                            <th width="3%">CLIENTE</th>
                                                                                            <th width="3%">SERVIDOR</th>
                                                                                            <th width="3%">TIPO CAMBIO</th>
                                                                                            <th width="3%">DETALLE</th>
                                                                                            <th width="3%">USUARIO</th>
                                                                                            <th width="3%">FECHA MODIF</th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                        <?php
                                                                                        $num5 = 1;
                                                                                        foreach ( $$r['actividad_idactividad'] as $h) {
                                                                                            ?>
                                                                                            <tr>
                                                                                                <td><?php echo $num5;
                                                                            $num5++;
                                                                                            ?></td>
                                                                                                <td style="font-size:8pt;"><?php echo $h['actividad_horaejecucion'] ?></td>
                                                                                                <td style="font-size:8pt;"><?php echo $h['actividad_horatermino'] ?></td>
                                                                                                <td style="color:black;font-weight:bold;"><?php echo $h['actividad_descripcion'] ?></td>
                                                                                                <td>
                                                                                                    <?php
                                                                                                    $diau = new Actividad_Dia();
                                                                                                    $$h['actaudit_idactaudit'] = $diau->dias_por_actividad_audit($h['actaudit_idactaudit']);
                                                                                                    ?>
                                                                                                    <?php if ($$h['actaudit_idactaudit'] != null) { ?>
                                                                                                        <?php foreach ($$h['actaudit_idactaudit'] as $d) {
                                                                                                            ?>
                                                                                                            <label class="checkbox-inline">
                                                                                                                <input type="checkbox" id="inlineCheckbox<?php echo $d['dia_iddia']; ?>" name="check_list[]" checked disabled value="<?php echo $d['dia_iddia']; ?>"> <?php
                                                                                                                if ($d['dia_iddia'] == '1') {
                                                                                                                    echo "LUNES";
                                                                                                                }
                                                                                                                if ($d['dia_iddia'] == '2') {
                                                                                                                    echo "MARTES";
                                                                                                                }
                                                                                                                if ($d['dia_iddia'] == '3') {
                                                                                                                    echo "MIERCOLES";
                                                                                                                }
                                                                                                                if ($d['dia_iddia'] == '4') {
                                                                                                                    echo "JUEVES";
                                                                                                                }
                                                                                                                if ($d['dia_iddia'] == '5') {
                                                                                                                    echo "VIERNES";
                                                                                                                }
                                                                                                                if ($d['dia_iddia'] == '6') {
                                                                                                                    echo "SABADO";
                                                                                                                }
                                                                                                                if ($d['dia_iddia'] == '7') {
                                                                                                                    echo "DOMINGO";
                                                                                                                }
                                                                                                                ?>
                                                                                                            </label><br>
                                                                                                        <?php } ?>
                                                                                                    <?php } else { ?>
                                                                                                        <div class="alert alert-danger"><i class="fa fa-warning"></i><b> Advertencia!</b><br>Aún No se han asignado<br>Días para ejecución de <br>esta tarea..!</div> 
                <?php } ?>
                                                                                                </td>
                                                                                                <td style="font-size:8pt;"><?php echo $h['actividad_horalimite'] ?></td>
                                                                                                <td style="font-size:8pt;"><?php echo $h['periodo_nombre'] ?></td>
                                                                                                <td style="font-size:8pt;"><a href="../Controles/Registro/Procedimientos/<?php echo $h['procedimiento_archivo'] ?>" target="_new"><?php echo $h['procedimiento_nombre'] ?></a></td>
                                                                                                <td style="font-size:8pt;"><?php echo $h['cliente_nombre'] ?></td>
                                                                                                <td style="font-size:8pt;"><?php echo $h['servidor_hostname'] . ' (' . $h['servidor_ip'] . ')' ?></td>
                                                                                                <td style="font-size:8pt;"><?php
                                                                                                    if ($h['actaudit_tipo'] == '1') {
                                                                                                        echo 'ACTIVACION';
                                                                                                    }
                                                                                                    if ($h['actaudit_tipo'] == '2') {
                                                                                                        echo 'CORREO';
                                                                                                    }
                                                                                                    if ($h['actaudit_tipo'] == '3') {
                                                                                                        echo 'INCIDENTE';
                                                                                                    }
                                                                                                    if ($h['actaudit_tipo'] == '4') {
                                                                                                        echo 'REQUERIMIENTO';
                                                                                                    }
                                                                                                    ?></td>
                                                                                                <td style="font-size:8pt;"><?php echo $h['actaudit_detalle'] ?></td>
                                                                                                <td style="font-size:8pt;"><?php echo $h['usu_nombres_usuario'] . ' ' . $h['usu_apellidos_usuario'] ?></td>
                                                                                                <td><?php echo date("d/m/y",strtotime($h['actaudit_fecha_modif'])) ?></td>
                                                                                            </tr>   

            <?php } ?>   
                                                                                    </tbody>
        <?php } else { ?>
                                                                                    <div class="alert alert-danger"><i class="fa fa-warning"></i><b> MENSAJE!</b><br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;No Tiene Historial registrados..!</div> 
                                                                <!--                                        <center><label>Su búsqueda no produjo ningún resultado. </label></center>-->


        <?php } ?>
                                                                            </table>   
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                                                                        <!--<button type="button" class="btn btn-primary">Save changes</button>-->
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>    


                                                    </td>
                                                </tr>
    <?php } ?>

                                        </tbody>
<?php } else { ?>
                                        <div class="alert alert-danger"><i class="fa fa-warning"></i><b> ADVERTENCIA!</b><br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Su búsqueda no produjo ningún resultado..!</div> 


<?php } ?>
                                </table>
                               </div>
                            </div><!-- /content-panel -->
                        </div><!-- /col-md-12 -->
                    </div><!-- /row -->

                </section>
            </section><!-- /MAIN CONTENT -->

            <!--main content end-->
            <!--footer start-->
            <footer class="site-footer">
                <div class="text-center">
                    Copyright &copy; <?php echo date("Y"); ?> - IBM DEL PERU - SYS-OPS
                    <a href="MantenerActividad.php" class="go-top">
                        <i class="fa fa-angle-up"></i>
                    </a>
                </div>
            </footer>
            <!--footer end-->
        </section>

        <!-- js placed at the end of the document so the pages load faster -->
<!--        <script src="../Recursos/assets/js/jquery.js"></script>-->
        <script src="../Recursos/assets/js/bootstrap.min.js"></script>
        <script class="include" type="text/javascript" src="../Recursos/assets/js/jquery.dcjqaccordion.2.7.js"></script>
        <script src="../Recursos/assets/js/jquery.scrollTo.min.js"></script>
        <script src="../Recursos/assets/js/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!-- Select2 -->
    <script src="plugins/select2/select2.full.min.js"></script>
        <!--common script for all pages-->
        <script src="../Recursos/assets/js/common-scripts.js"></script>

        <!--script for this page-->
        <script type="text/javascript" src="../Recursos/assets/js/gritter/js/jquery.gritter.js"></script>
        <script type="text/javascript" src="../Recursos/assets/js/gritter-conf.js"></script>
        <script>
          $(function () {
            //Initialize Select2 Elements
            $(".select2").select2();
          });
        </script>
        <script>
                                                                    $('#exampleModal').on('show.bs.modal', function (event) {
                                                                        var button = $(event.relatedTarget) // Button that triggered the modal
                                                                        var recipient = button.data('whatever') // Extract info from data-* attributes
                                                                        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
                                                                        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
                                                                        var modal = $(this)
                                                                        modal.find('.modal-title').text('New message to ' + recipient)
                                                                        modal.find('.modal-body input').val(recipient)
                                                                    })
        </script>
        
        <script type="text/javascript">

            function cargarTurnosPorSedeEdit(idactividad)
            {
//    alert('si llego');


                var id_sede = document.getElementById('id_sede' + idactividad).value;
                if (id_sede === '1') {
                    $("#divTurnos" + idactividad).load("../Controles/Registro/CActividad.php",
                            {
                                hidden_actividad: "cargarTurnosPorSedeEdit",
                                hidden_sede: id_sede,
                                hidden_id: idactividad

                            }, function () {
                    }
                    );

                }
                if (id_sede === '2') {
                    $("#divTurnos" + idactividad).load("../Controles/Registro/CActividad.php",
                            {
                                hidden_actividad: "cargarTurnosPorAramEdit",
                                hidden_sede: id_sede,
                                hidden_id: idactividad

                            }, function () {
                    }
                    );

                }



            }

            function cargarSubcatPorCatEdit(idactividad)
            {

                var id_cat = document.getElementById('id_categoria' + idactividad).value;
                var id_subcat = document.getElementById('id_subcaterogia' + idactividad).value;
//       alert(id_cat);
//      exit();
                $("#divSubCategoria" + idactividad).load("../Controles/Registro/CActividad.php",
                        {
                            hidden_actividad: "cargarSubcatPorCatEdit",
                            hidden_cat: id_cat,
                            hidden_subcat: id_subcat

                        }, function () {
                }
                );

            }
        </script>

        <script type="text/javascript">
<?php foreach ($actividades as $r) { ?>
                cargarTurnosPorSedeEdit(<?php echo $r['actividad_idactividad']; ?>);
                cargarSubcatPorCatEdit(<?php echo $r['actividad_idactividad']; ?>)
<?php } ?>
        </script> 




    </body>
</html>
