<?php
include_once '../DAO/Registro/Schedule.php';
$ob_sched_por_fin = new Schedule();
$num_ped = $ob_sched_por_fin->sched_pendiente_por_fin();

$ob_det_schedule = new Schedule();
$pendientes = $ob_det_schedule->sched_pendiente_detalle();

$ob_act_asig = new Schedule();
$ob_act_asig->setIdusu($_SESSION['id_username']);
$num_act_asig = $ob_act_asig->act_asig_a_usuario($ob_act_asig);

$ob_det_act_asig = new Schedule();
$ob_det_act_asig->setIdusu($_SESSION['id_username']);
$asignadas = $ob_det_act_asig->act_asig_detalle($ob_det_act_asig);

if($num_ped=='0'){
    $num_ped=null;
}

if($num_act_asig=='0'){
    $num_act_asig=null;
}
?>
<script type="text/javascript" src="../Recursos/js/JSGeneral.js"></script>
      <header class="header black-bg">
              <div class="sidebar-toggle-box">
                  <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
              </div>
            <!--logo start-->
            <a href="index.php" class="logo"><b>SISTEMA DE GENERACIÓN DE SCHEDULE</b></a>
             <div class="nav notify-row" id="top_menu">
                <!--  notification start -->
                <ul class="nav top-menu">
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="index.html#">
                            <i class="fa fa-tasks"></i>
                           <?php if ($num_ped!= null){ ?> 
                            <span class="badge bg-theme"><?php echo $num_ped; ?></span>
                           <?php } ?>
                        </a>
                        <?php if ($pendientes != null) { ?>
                        <ul class="dropdown-menu extended tasks-bar">
                            <div class="notify-arrow notify-arrow-green"></div>
                            <li>
                                <p class="green"> <?php echo $num_ped; ?> Schedule(s) pendiente</p>
                            </li>
                            <?php foreach ($pendientes as $p) {    ?>
                            <li>
                                
                                <a href="MisSchedules.php">
                                    <div class="task-info">
                                        <div class="desc"><?php echo $p['sede_nombre'].' ('.$p['turno_nombre'].')';?> </div>
                                        <div class="percent"><?php echo $p['schedule_fecha'];?></div>
                                       
                                    </div>
                                    <div class="progress progress-striped">
                                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 50%">
                                            <span class="sr-only">40% Complete (success)</span>
                                        </div>
                                    </div>
                                    <div class="task-info">
                                        <br>
                                        <div style="color:red; font-size: 8px; font-weight: bold;"><?php echo $p['usu_nombres_usuario'].' '.$p['usu_apellidos_usuario'].' ('.$p['turno_horainicio'].' a '.$p['turno_horafin'].')';?> </div>
                                    </div>   
                                </a>
                            </li>
                            <?php } ?>
                            
                            <li class="external">
                                <a href="MisSchedules.php">Ver Todos los Schedules</a>
                            </li>
                        </ul>
                        <?php } else { ?>
                        <ul class="dropdown-menu extended tasks-bar">
                             <div class="notify-arrow notify-arrow-green"></div>
                              <li>
                                <p class="green">No hay Schedules pendientes para finalizar</p>
                              </li>
                              <li>
                                 <div class="alert alert-danger"><i class="fa fa-warning"></i><b> Advertencia!</b><br>No tiene Schedules Pendientes por Finalizar</div>  
                              </li>
                              <li class="external">
                                <a href="MisSchedules.php">Ver Todos los Schedules</a>
                            </li>
                        </ul>
                         <?php } ?>
                    </li>
                    <li id="header_inbox_bar" class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="index.html#">
                            <i class="fa fa-envelope-o"></i>
                             <?php if ($num_act_asig!= null) { ?> 
                            <span class="badge bg-theme"><?php echo $num_act_asig; ?></span>
                            <?php } ?>
                        </a>
                         <?php if ($asignadas != null) { ?>                        
                        <ul class="dropdown-menu extended inbox">
                            <div class="notify-arrow notify-arrow-green"></div>
                            <li>
                                <p class="green">Tienes <?php echo $num_act_asig; ?> Actividad(es) Asignadas</p>
                            </li>
                            <?php foreach ($asignadas as $a) {    ?>
                            <li>
                                <a href="DetalleTareasAsignadas.php">
                                    <span class="photo">
                                    <?php if($a['rol_idrol']==1){?> 
                                        <img alt="avatar" src="../Recursos/assets/img/administrador.png"></span>
                                    <?php } else {?>
                                        <img alt="avatar" src="../Recursos/assets/img/operador.jpg"></span>
                                    <?php } ?>
                                    <span class="subject">
                                        <span class="from">
                                        <?php echo $a['usu_nombres_usuario'] ;?>
                                        </span>
                                    <span class="time"><?php echo $a['actasig_fecharegistro']; ?></span>
                                    </span>
                                    <span class="message">
                                        TE HA ASIGNADO UNA TAREA....
                                    </span>
                                    
                                </a>
                                <a align="center">
                                 <form id="form_confirmar" class="form-horizontal style-form" action="../Controles/Registro/CSchedule.php" method="POST">
                                            <input type="hidden" name="hidden_schedule" id="hiddenschedule">
                                            <input type="hidden" name="id_actividad_asig" id="hiddenschedule" value="<?php echo $a['schedact_idschedact']; ?>">
                                            
                                            
                                            <button type="button" class="btn btn-theme" onclick="AceptaActividad();"><i class="fa fa-check"></i> SI</button>
                                            <button type="button" class="btn btn-danger" onclick="RechazaActividad();"><i class="fa fa-trash-o"></i> NO</button>
                                    </form>   
                                </a>       
                            </li>
                            
                            <?php } ?>
                           
                            <li>
                                <a href="DetalleTareasAsignadas.php">Ver todas las Tareas Asignadas</a>
                            </li>
                        </ul>
                        <?php } else { ?>
                        <ul class="dropdown-menu extended tasks-bar">
                             <div class="notify-arrow notify-arrow-green"></div>
                              <li>
                                <p class="green">No tienes Tareas Asignadas</p>
                              </li>
                              <li>
                                 <div class="alert alert-danger"><i class="fa fa-warning"></i><b> Advertencia!</b><br>No tiene Tareas Asignadas Pendientes</div>  
                              </li>
                              <li class="external">
                                <a href="DetalleTareasAsignadas.php">Ver todas las Tareas Asignadas</a>
                            </li>
                        </ul>
                         <?php } ?>
                    </li>
                    
                </ul>
                <!--  notification end -->
            </div>
           
            <div class="top-menu">
            	<ul class="nav pull-right top-menu">
                    <li><a class="logout" href="CerrarSesion.php">Cerrar Sesión</a></li>
            	</ul>
            </div>
        </header>
      <!--header end-->
