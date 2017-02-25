<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("location:login.php");
}
$privilegios = $_SESSION['array_menus'];

include_once '../DAO/Registro/Usuario.php';
include_once '../DAO/Registro/Rol.php';
$usuario = new Usuario();

$rol = new Rol();
$roles = $rol->listar();

if (isset($_SESSION['accion_usuario']) && $_SESSION['accion_usuario'] != '') {

    if ($_SESSION['accion_usuario'] == 'busqueda') {
        $usuarios = $_SESSION['arreglo_buscado_usuario'];
    } else {
        $usuarios = $usuario->listar();
    }
} else {
    $usuarios = $usuario->listar();
}

if (isset($_SESSION['usu_idusu'])) {
    $idusu = $_SESSION['usu_idusu'];
} else {
    $idusu = "";
}
if (isset($_SESSION['usu_nombres_usuario'])) {
    $nomusu = $_SESSION['usu_nombres_usuario'];
} else {
    $nomusu = "";
}
if (isset($_SESSION['usu_apellidos_usuario'])) {
    $apeusu = $_SESSION['usu_apellidos_usuario'];
} else {
    $apeusu = "";
}
if (isset($_SESSION['usu_numdoc_usuario'])) {
    $numdoc = $_SESSION['usu_numdoc_usuario'];
} else {
    $numdoc = "";
}
if (isset($_SESSION['usu_nom_usuario'])) {
    $usunom = $_SESSION['usu_nom_usuario'];
} else {
    $usunom = "";
}
if (isset($_SESSION['usu_estado'])) {
    $usu_estado = $_SESSION['usu_estado'];
} else {
    $usu_estado = "";
}
if (isset($_SESSION['usu_email_institucional'])) {
    $correoinst = $_SESSION['usu_email_institucional'];
} else {
    $correoinst = "";
}
if (isset($_SESSION['usu_fecharegistro'])) {
    $fechareg = $_SESSION['usu_fecharegistro'];
} else {
    $fechareg = "";
}

if (isset($_SESSION['rol_idrol'])) {
    $rol_idrol = $_SESSION['rol_idrol'];
} else {
    $rol_idrol = "";
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
                      <a class="active" href="javascript:;" >
                          <i class="fa fa-users"></i>
                          <span>Usuarios</span>
                      </a>
                      <ul class="sub">
                           <li><a  onclick="cancelarmantusu();" style="cursor: pointer">Registrar Usuario</a></li>
                          <li class="active"><a  href="MantenerUsuario.php">Administrar Usuarios</a></li>
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
                    <h3><i class="fa fa-angle-right"></i> ADMINISTRAR USUARIO</h3>
                    <form id="formcanc" action="../Controles/Registro/CUsuario.php" method="POST">
                    <input type="hidden" name="hidden_usuario" id="cancusuario"> 
                    </form>
                    <form class="form-horizontal style-form" action="../Controles/Registro/CUsuario.php" method="POST">
                        <input type="hidden" name="hidden_usuario" value="buscar" id="hiddenusuario">    
                        <!-- Opciones de Busqueda -->
                        <div class="row mt">
                            <div class="col-lg-12">
                                <div class="form-panel">
                                    <h4 class="mb"><i class="fa fa-angle-right"></i> Opciones de Búsqueda</h4>

                                    <div class="form-group">
                                        <label class="col-sm-2 col-sm-2 control-label">DNI</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="t_numdoc" maxlength="8" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 col-sm-2 control-label">Nombres</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="t_nombre" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 col-sm-2 control-label">Apellidos</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="t_apellidos" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 col-sm-2 control-label">Rol</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" name="c_rol">                                      
                                                <option value="0">--SELECCIONE--</option>

<?php foreach ($roles as $r) { ?>                                                                    
                                                    <option value="<?php echo $r['rol_idrol']; ?>"><?php echo $r['rol_nombre']; ?></option>
                                                <?php } ?>

                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 col-sm-2 control-label">Estado de Usuario</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" name="c_estado">
                                                <option value="">--SELECCIONE--</option>
                                                <option value="1">ACTIVO</option>
                                                <option value="0">INACTIVO</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 col-sm-2 control-label">Fecha de Registro</label>
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
                                <table class="table table-striped table-advance table-hover">
                                    <h4><i class="fa fa-angle-right"></i> Resultado de Búsqueda de Usuarios</h4>
                                    <hr>

<?php if ($usuarios != null) { ?>
                                        <thead>
                                            <tr>
                                                <th><i class="fa fa-arrow-circle-down"></i> N°</th>
                                                <th><i class="fa fa-male"></i> Nombres</th>
                                                <th><i class="fa fa-history"></i> Apellidos</th>
                                                <th><i class="fa fa-bookmark"></i> Código IBM</th>
                                                <th><i class="fa fa-database"></i> Usuario</th>
                                                <th><i class=" fa fa-legal"></i> Rol</th>
                                                <th><i class=" fa fa-edit"></i> Estado</th>
                                                <th><i class="fa fa-calendar"></i> Fecha de Registro</th>
                                                <th><i class="fa fa-photo"></i> Foto</th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
    <?php
    $num = 1;
    foreach ($usuarios as $r) {
        ?>
                                                <tr>
                                                    <td><?php echo $num;
                                        $num++; ?></td>
                                                    <td><?php echo $r['usu_nombres_usuario'] ?></td>
                                                    <td><?php echo $r['usu_apellidos_usuario'] ?></td>
                                                    <td><?php echo $r['usu_numdoc_usuario'] ?></td>
                                                    <td><?php echo $r['usu_nom_usuario'] ?></td>
                                                    <td>
                                                         <?php foreach ($roles as $f) {   
                                                                    ?>
                                                        <?php if ($r['rol_idrol'] == $f['rol_idrol']) echo $f['rol_nombre']; ?>
                                                         <?php } ?>
                                                    </td>
                                                    <td> 
                                                        <?php if ($r['usu_estado'] == '1') { ?>
                                                            <span class="label label-info label-mini">Activo</span>
                                                        <?php } ?>
                                                        <?php if ($r['usu_estado'] == '0') { ?>
                                                            <span class="label label-danger label-mini">Inactivo</span>
                                                        <?php } ?>
                                                    </td>

                                                    <td><?php echo $r['usu_fecharegistro'] ?></td>
                                                    <td><img src="../Controles/Registro/Fotos/<?php echo $r['usu_foto'] ?>" class="img-circle" width="60"></td>
        <!--                                  <td><a href="basic_table.html#">Company Ltd</a></td>
        <td class="hidden-phone">Lorem Ipsum dolor</td>
        <td>12000.00$ </td>
        <td><span class="label label-info label-mini">Due</span></td>-->
                                                    <td>
                                                        <?php
                                                        if ($r['usu_estado'] == '1') {
                                                            ?>
                                                            <form method='POST' id="formusu" action="../Controles/Registro/CUsuario.php">
                                                                <input type="hidden" name="id_hidden_eliminar" value="<?php echo $r['usu_idusu'] ?>">
                                                                <input type="hidden" name="hidden_usuario" value="anular">
                                                                <input type="hidden" name="hidden_estado" value="activo">
                                                                <button type="submit" class="btn btn-success btn-xs" title="Desactivar"><i class="fa fa-check"></i></button>
                                                            </form>    
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <form method='POST' id="formusu" action="../Controles/Registro/CUsuario.php">
                                                                <input type="hidden" name="id_hidden_eliminar" value="<?php echo $r['usu_idusu'] ?>">
                                                                <input type="hidden" name="hidden_usuario" value="anular">
                                                                <input type="hidden" name="hidden_estado" value="inactivo">
                                                                <button type="submit" class="btn btn-danger btn-xs" title="Activar"><i class="fa fa-warning"></i></button>
                                                            </form> 
                                                        <?php } ?>
                                                    </td>
                  <!--                                      <button class="btn btn-success btn-xs"><i class="fa fa-check"></i></button>-->
                                                    <td>
                                                        <form method='POST' id="formusu" action="../Controles/Registro/CUsuario.php">
                                                            <input type="hidden" name="hidden_usuario" value="buscarid">
                                                            <input type="hidden" name="idusu" value="<?php echo $r['usu_idusu'] ?>">
                                                            <button type="submit" class="btn btn-primary btn-xs" title="Editar"><i class="fa fa-pencil"></i></button>
                                                        </form>    
                                                    </td>
                                                    <td>
                                                        <form method='POST' id="formusu" action="../Controles/Registro/CUsuario.php">
                                                            <input type="hidden" name="id_hidden_eliminar" value="<?php echo $r['usu_idusu'] ?>">
                                                            <input type="hidden" name="nombre_hidden_eliminar" value="<?php echo $r['usu_nombres_usuario'] ?>">
                                                            <input type="hidden" name="hidden_usuario" value="eliminar">
                                                            <input type="hidden" name="hidden_estado" value="activo">
                                                            <button type="submit" class="btn btn-danger btn-xs"  title="Eliminar"><i class="fa fa-trash-o "></i></button>
                                                        </form>    
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
                    2015 - IBM OPERATION SERVICE
                    <a href="MantenerUsuario.php" class="go-top">
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

        <script>
            //custom select box

            $(function() {
                $('select.styled').customSelect();
            });

        </script>

    </body>
</html>
