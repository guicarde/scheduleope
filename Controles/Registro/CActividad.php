<?php

session_start();
if(isset($_SESSION['accion_actividad'])){ 
     if($_SESSION['accion_actividad']=='editar'){
?>
<!--<script type="text/javascript">
         cargarTurnosPorSede();
         cargarSubcatPorCat();
  
    </script>-->
<?php 
 }}
include_once '../../DAO/Conexion.php';
include_once '../../DAO/Registro/Turno.php';
include_once '../../DAO/Registro/Actividad.php';
include_once '../../DAO/Registro/Actividad_Dia.php';
include_once '../../DAO/Registro/Actividad_Turno.php';
include_once '../../DAO/Registro/Subcategoria.php';
//var_dump($productos);
//exit();



$direccionInicio = "location:../../Vistas/index.php";
$direccionMantener = "location: ../../Vistas/MantenerActividad.php";
$direccionGuardar = "location: ../../Vistas/GuardarActividad.php";
 
if (isset($_POST['hidden_actividad'])) {
    $idturnob = null;
    $accion = $_POST['hidden_actividad'];
//    var_dump($accion);
//    exit();
     
    

     if($accion=='registrar') {
        $idturnob=$_POST['c_turno_tn'];  
              $tipo= $_POST['c_tipo'];
              $horaejec= $_POST['t_hora'];
              $horatermino= $_POST['t_hora_ter'];
              $interturno=$_POST['c_inter_turnos'];
              $excepcion=$_POST['c_excepcion'];
              $descripcion=trim(strtoupper($_POST['ta_descripcion']));
              $horalimite=$_POST['t_hora_limite'];
              $plataforma=$_POST['c_plataforma'];
              $tws=$_POST['c_tws'];
              $tipoproc = $_POST['c_tipo_proceso'];
              $tiporesp=$_POST['c_tipo_respaldo'];
              $comentario=trim(strtoupper($_POST['ta_comentario']));
              $ventana=$_POST['t_ventana'];
              $accion=trim(strtoupper($_POST['t_accion']));
              $idperiodo=$_POST['c_periodo'];
              $idsede=$_POST['c_sede'];      
              $idturno=$_POST['c_turno'];
              $idproced=$_POST['c_procedimiento'];
              $idcliente=$_POST['c_cliente'];
              $idservidor=$_POST['c_servidor'];
              $subcategoria=$_POST['c_subcategoria'];
              $idtipoact = $_POST['c_tipo_actividad'];
              
              $duracion= new Actividad();
              $hora_dur=$duracion->RestarHoras($horaejec, $horatermino);
                      
              
                      
                      
            $Actividad = new Actividad();
          
            $Actividad->setTipo($tipo);
            $Actividad->setHoraejec($horaejec);
            $Actividad->setHoratermino($horatermino);
            $Actividad->setDuracion($hora_dur);
            $Actividad->setInterturno($interturno);
            $Actividad->setExcepcion($excepcion);
            $Actividad->setDescripcion($descripcion);
            $Actividad->setHoralimite($horalimite);
            $Actividad->setPlataforma($plataforma);
            $Actividad->setTws($tws);
            $Actividad->setTiporespaldo($tiporesp);
            $Actividad->setTipoproceso($tipoproc);
            $Actividad->setComentario($comentario);
            $Actividad->setVentana($ventana);
            $Actividad->setAccion($accion);
            $Actividad->setIdperiodo($idperiodo);
            $Actividad->setIdsede($idsede);
            $Actividad->setIdprocedimiento($idproced);
            $Actividad->setIdcliente($idcliente);
            $Actividad->setIdservidor($idservidor);
            $Actividad->setIdcategoria($subcategoria);
            $Actividad->setIdtipoact($idtipoact);
            $resul=$Actividad->grabar($Actividad);
            
            $ob_act_tur = new Actividad_Turno();
            $ob_act_tur->setIdactividad($resul);
            $ob_act_tur->setIdturno($idturno);
            $valor = $ob_act_tur->grabar($ob_act_tur);
            
            if($idturnob!=null){
            $ob_act_tur = new Actividad_Turno();
            $ob_act_tur->setIdactividad($resul);
            $ob_act_tur->setIdturno($idturnob);
            $valor = $ob_act_tur->grabar($ob_act_tur);    
            }
            
            if(!empty($_POST['check_list'])) {
                    foreach($_POST['check_list'] as $selected) {
                    $ob_actividad = new Actividad_Dia();
                    
                    $ob_actividad->setIdactividad($resul);
                    $ob_actividad->setIddia($selected);                
                    $valor = $ob_actividad->grabar($ob_actividad);
                    }
                    }
            header("location: ../../Vistas/MantenerActividad.php");
        }
    
    
    
    
       else if($accion=='actualizar'){
              $id = $_POST['idactividad'];
              $idturnob=$_POST['c_turno_tn'];  
              $tipo= $_POST['c_tipo'];
              $horaejec= $_POST['t_hora'];
              $horatermino= $_POST['t_hora_ter'];
              $interturno=$_POST['c_inter_turnos'];
              $excepcion=$_POST['c_excepcion'];
              $descripcion=trim(strtoupper($_POST['ta_descripcion']));
              $horalimite=$_POST['t_hora_limite'];
              $plataforma=$_POST['c_plataforma'];
              $tws=$_POST['c_tws'];
              $tipoproc = $_POST['c_tipo_proceso'];
              $tiporesp=$_POST['c_tipo_respaldo'];
              $comentario=trim(strtoupper($_POST['ta_comentario']));
              $ventana=$_POST['t_ventana'];
              $accion=trim(strtoupper($_POST['t_accion']));
              $idperiodo=$_POST['c_periodo'];
              $idsede=$_POST['c_sede'];      
              $idturno=$_POST['c_turno'];
              $idproced=$_POST['c_procedimiento'];
              $idcliente=$_POST['c_cliente'];
              $idservidor=$_POST['c_servidor'];
              $subcategoria=$_POST['c_subcategoria'];
              $idtipoact = $_POST['c_tipo_actividad'];
              $motivo= $_POST['c_motivo'];
              $detmot = $_POST['t_det_mot'];
              $id_usuario = $_SESSION['id_username'];
              
              $duracion= new Actividad();
              $hora_dur=$duracion->RestarHoras($horaejec, $horatermino);
                      
            $Actividad = new Actividad();
            $Actividad->setId($id);
            $Actividad->setTipo($tipo);
            $Actividad->setHoraejec($horaejec);
            $Actividad->setHoratermino($horatermino);
            $Actividad->setDuracion($hora_dur);
            $Actividad->setInterturno($interturno);
            $Actividad->setExcepcion($excepcion);
            $Actividad->setDescripcion($descripcion);
            $Actividad->setHoralimite($horalimite);
            $Actividad->setPlataforma($plataforma);
            $Actividad->setTws($tws);
            $Actividad->setTiporespaldo($tiporesp);
            $Actividad->setTipoproceso($tipoproc);
            $Actividad->setComentario($comentario);
            $Actividad->setVentana($ventana);
            $Actividad->setAccion($accion);
            $Actividad->setIdperiodo($idperiodo);
            $Actividad->setIdsede($idsede);
            $Actividad->setIdprocedimiento($idproced);
            $Actividad->setIdcliente($idcliente);
            $Actividad->setIdservidor($idservidor);
            $Actividad->setIdcategoria($subcategoria);
            $Actividad->setIdtipoact($idtipoact);
            $Actividad->setMotivo($motivo);
            $Actividad->setDetmot($detmot);
            $Actividad->setIdusu($id_usuario);
            $resul=$Actividad->actualizar($Actividad);
            
            $ob_act_tur = new Actividad_Turno();
            $ob_act_tur->setIdactividad($resul);
            $ob_act_tur->setIdturno($idturno);
            $valor = $ob_act_tur->actualizar($ob_act_tur);
            
            if($idturnob!=null){
            $ob_act_tur = new Actividad_Turno();
            $ob_act_tur->setIdactividad($resul);
            $ob_act_tur->setIdturno($idturnob);
            $valor = $ob_act_tur->actualizar($ob_act_tur);    
            }
            
            if(!empty($_POST['check_list'])) {
                    foreach($_POST['check_list'] as $selected) {
                    $ob_actividad = new Actividad_Dia();
                    
                    $ob_actividad->setIdactividad($resul);
                    $ob_actividad->setIddia($selected);                
                    $valor = $ob_actividad->actualizar($ob_actividad);
                    }
                    }
            header("location: ../../Vistas/MantenerActividad.php");
            }
    
    
    
         else if($accion=='buscar')
    {
        if(isset($_POST['c_turno']))         { $idturno = $_POST['c_turno'];} else{ $idturno ='0'; }
        if(isset($_POST['c_turno_tn']))         { $idturnob = $_POST['c_turno'];} else{ $idturnob ='0'; }
        $idsede = $_POST['c_sede'];
//        $idturno = $_POST['c_turno'];
//        $idturnob = $_POST['c_turno_tn'];
        $iddia = $_POST['c_dia'];
        $descripcion = trim(strtoupper($_POST['t_desc']));
        $idperiodo = $_POST['c_periodo'];
        $idprocedimiento = $_POST['c_procedimiento'];
        $idcliente = $_POST['c_cliente'];
        $estado = $_POST['c_estado'];
        $idservidor = trim(strtoupper($_POST['c_servidor']));
        $fechareg=trim(strtoupper($_POST['t_fecha_reg']));
        
         if($idturno!='0'){
            $ob_actividad = new Actividad();
            $ob_actividad->setIdperiodo($idperiodo);
            $ob_actividad->setIdcliente($idcliente);
            $ob_actividad->setEstado($estado);
            $ob_actividad->setIdservidor($idservidor);
            $ob_actividad->setFechareg($fechareg);
            $ob_actividad->setDescripcion($descripcion);
            $ob_actividad->setIdprocedimiento($idprocedimiento);
            $ob_actividad->setIdsede($idsede);
            $ob_actividad->setIdturno($idturno);
            $ob_actividad->setIddia($iddia);
            
            $arreglo = $ob_actividad->buscar($ob_actividad);

            $_SESSION['arreglo_buscado_actividad'] = $arreglo;
            $_SESSION['accion_actividad'] = 'busqueda';
            header("location: ../../Vistas/MantenerActividad.php");
        }else if($idturno=='0' && $idturnob=='0'){
            $ob_actividad = new Actividad();
            $ob_actividad->setIdperiodo($idperiodo);
            $ob_actividad->setIdcliente($idcliente);
            $ob_actividad->setEstado($estado);
            $ob_actividad->setIdservidor($idservidor);
            $ob_actividad->setFechareg($fechareg);
            $ob_actividad->setDescripcion($descripcion);
            $ob_actividad->setIdprocedimiento($idprocedimiento);
            $ob_actividad->setIdsede($idsede);
            $ob_actividad->setIdturno($idturno);
            $ob_actividad->setIddia($iddia);
//exit();
            $arreglo = $ob_actividad->buscar($ob_actividad);

            $_SESSION['arreglo_buscado_actividad'] = $arreglo;
            $_SESSION['accion_actividad'] = 'busqueda';
            header("location: ../../Vistas/MantenerActividad.php");
        }else if($idturno=='0' && $idturnob!='0' ) {
            $ob_actividad = new Actividad();
            $ob_actividad->setIdperiodo($idperiodo);
            $ob_actividad->setIdcliente($idcliente);
            $ob_actividad->setEstado($estado);
            $ob_actividad->setIdservidor($idservidor);
            $ob_actividad->setFechareg($fechareg);
            $ob_actividad->setDescripcion($descripcion);
            $ob_actividad->setIdprocedimiento($idprocedimiento);
            $ob_actividad->setIdsede($idsede);
            $ob_actividad->setIdturno($idturnob);
            $ob_actividad->setIddia($iddia);
//exit();
            $arreglo = $ob_actividad->buscar($ob_actividad);

            $_SESSION['arreglo_buscado_actividad'] = $arreglo;
            $_SESSION['accion_actividad'] = 'busqueda';
            header("location: ../../Vistas/MantenerActividad.php");
        }
        
        
    }
         else if($accion=='buscarid')
     {
        $id_actividad = $_POST['idactividad'];
        $actividad = new Actividad();
        $actividad->setId($id_actividad); 
        $actividad->buscarPorId($actividad);
        
        $turno = new Actividad();
        $turno->setId($id_actividad); 
        $turnos = $turno->turno_por_actividad($turno); 
        
        $sede = new Actividad();
        $sede->setId($id_actividad); 
        $sedes = $sede->sede_por_actividad($sede); 
        
        $categoria = new Actividad();
        $categoria->setId($id_actividad); 
        $categoria->categoria_por_actividad($categoria); 
        
        $dia= new Actividad_Dia();
        $dia->setIdactividad($id_actividad);
        $dias= $dia->dias_por_actividad($dia);
        
//        var_dump($dias);
//        exit();
        
        unset($_SESSION['arreglo_buscado_actividad']);
        $_SESSION['arreglo_turnos'] = $turnos;
        $_SESSION['arreglo_dias'] = $dias;
        $_SESSION['accion_actividad']='editar';  
        header("location: ../../Vistas/GuardarActividad.php");
     }
     
              else if($accion=='buscar_india')
     {
        unset($_SESSION['arreglo_buscado_india']);
        $fecha = $_POST['t_fecha_schedule'];
        $actividad = new Actividad();
        $actividad->setFechareg($fecha); 
        $arreglo=$actividad->listar_india($actividad);

        $_SESSION['arreglo_buscado_india'] = $arreglo;
        $_SESSION['accion_actividad']='busqueda_india';  
        header("location: ../../Vistas/MonitoreoIndia.php");
     }
     
         else if($accion == 'anular'){
             
        $id_actividad_eliminar = $_POST['id_hidden_eliminar'];
        $id_actividad_estado = $_POST['hidden_estado'];
        $ob_actividad= new Actividad();
        $ob_actividad->setId($id_actividad_eliminar);
        $ob_actividad->setEstado($id_actividad_estado);
        $ob_actividad->anular($ob_actividad);
        
        
        if($id_actividad_estado=='activo'){
        ?>
            <input type="hidden" name="id_hidden_eliminar" id="id_hidden_eliminar<?php echo $id_actividad_eliminar ?>" value="<?php echo $id_actividad_eliminar ?>">
            <input type="hidden" name="hidden_estado" id="hidden_estado<?php echo $id_actividad_eliminar ?>" value="inactivo">
            <button type="submit" class="btn btn-danger btn-xs" onclick="cambiarestado('<?php echo $id_actividad_eliminar ?>');" title="Activar"><i class="fa fa-warning"></i></button>
         <?php } else { ?>
            <input type="hidden" name="id_hidden_eliminar" id="id_hidden_eliminar<?php echo $id_actividad_eliminar ?>" value="<?php echo $id_actividad_eliminar ?>">
            <input type="hidden" name="hidden_estado" id="hidden_estado<?php echo $id_actividad_eliminar ?>" value="activo">
            <button type="button" class="btn btn-success btn-xs" onclick="cambiarestado('<?php echo $id_actividad_eliminar ?>');" title="Desactivar"><i class="fa fa-check"></i></button>

        <?php }
          exit();
        
//        $arreglo=$ob_actividad->listar();
//        $_SESSION['arreglo_buscado_actividad'] = $arreglo;
//        header("location: ../../Vistas/MantenerActividad.php");
         }
             else if($accion == 'cambiar_tws'){
             
        $id_actividad_tws = $_POST['id_hidden_tws'];
        $id_actividad_estado = $_POST['hidden_tws'];
        $ob_actividad= new Actividad();
        $ob_actividad->setId($id_actividad_tws);
        $ob_actividad->setEstado($id_actividad_estado);
        $ob_actividad->cambiar_tws($ob_actividad);
        
        
        if($id_actividad_estado=='activo'){
        ?>
            <input type="hidden" name="id_hidden_tws" id="id_hidden_tws<?php echo $id_actividad_tws ?>" value="<?php echo $id_actividad_tws ?>">
            <input type="hidden" name="hidden_tws" id="hidden_tws<?php echo $id_actividad_tws ?>" value="inactivo">
            <button type="button" class="btn btn-warning btn-xs" onclick="cambiartws('<?php echo $id_actividad_tws ?>');" title="Activar">Inactivo</button>
            
         <?php } else if($id_actividad_estado=='inactivo'){ ?>
            <input type="hidden" name="id_hidden_tws" id="id_hidden_tws<?php echo $id_actividad_tws ?>" value="<?php echo $id_actividad_tws ?>">
            <input type="hidden" name="hidden_tws" id="hidden_tws<?php echo $id_actividad_tws ?>" value="activo"> 
            <button type="button" class="btn btn-theme02 btn-xs" onclick="cambiartws('<?php echo $id_actividad_tws ?>');" title="Desactivar">Activo</button>
        <?php }
          exit();
        
//        $arreglo=$ob_actividad->listar();
//        $_SESSION['arreglo_buscado_actividad'] = $arreglo;
//        header("location: ../../Vistas/MantenerActividad.php");
         }
     
        
        else if ($accion == 'cargarTurnosPorSede') {
        unset($_SESSION['arreglo_cargado_actividad']);

        $id_sede = $_POST['hidden_sede'];

        
            $ob_turno = new Turno();
            $ob_turno->setId($id_sede);
            $arreglo = $ob_turno->listar($ob_turno);
            $arreglo2 = $ob_turno->listar_tn($ob_turno);
            LlenarComboTurno($arreglo,$arreglo2);
       
    }
    else if ($accion == 'cargarTurnosPorSedeEdit') {
        unset($_SESSION['arreglo_cargado_actividad']);

        $id_sede = $_POST['hidden_sede'];
        $id = $_POST['hidden_id'];
        
            $ob_turno = new Turno();
            $ob_turno->setId($id_sede);
            $arreglo = $ob_turno->listar($ob_turno);
            $arreglo2 = $ob_turno->listar_tn($ob_turno);
            $turno = new Actividad();
            $turno->setId($id); 
            $turnos = $turno->turno_por_actividad($turno); 
//            var_dump($arreglo);
//            exit();
            LlenarComboTurnoEdit($arreglo,$arreglo2,$turnos);
       
    }
            else if ($accion == 'cargarTurnosPorAram') {
        unset($_SESSION['arreglo_cargado_actividad']);

        $id_sede = $_POST['hidden_sede'];

        
            $ob_turno = new Turno();
            $ob_turno->setId($id_sede);
            $arreglo = $ob_turno->listar_aram($ob_turno);
            LlenarComboTurnoAr($arreglo);
       
    }
             else if ($accion == 'cargarTurnosPorAramEdit') {
        unset($_SESSION['arreglo_cargado_actividad']);

        $id_sede = $_POST['hidden_sede'];
        $id = $_POST['hidden_id'];
        
            $ob_turno = new Turno();
            $ob_turno->setId($id_sede);
            $arreglo = $ob_turno->listar_aram($ob_turno);
            $turno = new Actividad();
            $turno->setId($id); 
            $turnos = $turno->turno_por_actividad($turno); 
            LlenarComboTurnoArEdit($arreglo,$turnos);
       
    }
    
    
            else if ($accion == 'cargarSubcatPorCat') {
        unset($_SESSION['arreglo_cargado_actividad']);

        $id_cat = $_POST['hidden_cat'];

        
            $ob_subcat = new Subcategoria();
            $ob_subcat->setIdcat($id_cat);
            $arreglo = $ob_subcat->listar($ob_subcat);
            LlenarComboSubCat($arreglo);
       
    }
                else if ($accion == 'cargarSubcatPorCatEdit') {
        unset($_SESSION['arreglo_cargado_actividad']);

        $id_cat = $_POST['hidden_cat'];
        $subcat = $_POST['hidden_subcat'];
        
            $ob_subcat = new Subcategoria();
            $ob_subcat->setIdcat($id_cat);
            $arreglo = $ob_subcat->listar($ob_subcat);
//            var_dump($arreglo);
//            exit();
            LlenarComboSubCatEdit($arreglo,$subcat);
       
    }
   
    
 
} else {
    header("location: ../../Vistas/Registros/MantenerActividad.php");
}

//----------------- funciones ajax -----------

function LlenarComboTurno($datos,$datosb)
{
    if($datos!=null){
     
        echo "<div class='form-group'>";
        echo "<label class='col-sm-2 col-sm-2 control-label'>TURNO</label>";
        echo "<div class='col-sm-10'>";
        echo "<select class='form-control' name='c_turno' id='id_turno'>";
        echo "<option value='0'>--SELECCIONE--</option>";
        
        
        foreach ($datos as $d) {   
            $id = $d['sedeturno_idsedeturno'];
            $nombre = $d['turno_nombre'];
            $horain = $d['turno_horainicio'];
            $horafin = $d['turno_horafin'];
           ?> 

        <option value="<?php echo $id?>"><?php echo $nombre.' ('.$horain.' a '.$horafin.')'; ?></option>
            <?php
        }
        echo "</select>";      
        echo "</div> </div>";        
    }
    if($datosb!=null){
     
        echo "<div class='form-group'>";
        echo "<label class='col-sm-2 col-sm-2 control-label'>TURNO 2</label>";
        echo "<div class='col-sm-10'>";
        echo "<select class='form-control' name='c_turno_tn' id='id_turno_tn'>";
        echo "<option value='0'>--SELECCIONE--</option>";
       
        foreach ($datosb as $f) {   
            
            $id = $f['sedeturno_idsedeturno'];
            $nombre = $f['turno_nombre'];
            $horain = $f['turno_horainicio'];
            $horafin = $f['turno_horafin'];
           ?>                                                                    
        <option value="<?php echo $id?>"><?php echo $nombre.' ('.$horain.' a '.$horafin.')'; ?></option>
            <?php
        }
        echo "</select>";      
        echo "</div> </div>";        
    }
    
    
}
function LlenarComboTurnoEdit($datos,$datosb,$turnos)
{
    if($datos!=null){
     
        echo "<div class='form-group'>";
        echo "<label for='recipient-turno' class='control-label'>TURNO:</label>";
        echo "<select class='form-control' style='width: 100%;' name='c_turno' id='id_turno'>";
        echo "<option value='0'>--SELECCIONE--</option>";
        
        
        foreach ($datos as $d) {   
            $id = $d['sedeturno_idsedeturno'];
            $nombre = $d['turno_nombre'];
            $horain = $d['turno_horainicio'];
            $horafin = $d['turno_horafin'];
           ?> 

        <option value="<?php echo $id?>" 
            
            <?php 

                                foreach ($turnos as $t) {
                                    if($t['sedeturno_idsedeturno']==$id){ echo 'selected';}
                            }
//            }
                        ?>
                        
                        ><?php echo $nombre.' ('.$horain.' a '.$horafin.')'; ?></option>
            <?php
        }
        echo "</select>";      
        echo "</div>";        
    }
    if($datosb!=null){
     
        echo "<div class='form-group'>";
        echo "<label for='recipient-turno' class='control-label'>TURNO 2:</label>";       
        echo "<select class='form-control'  style='width: 100%;' name='c_turno_tn' id='id_turno_tn'>";
        echo "<option value='0'>--SELECCIONE--</option>";
       
        foreach ($datosb as $f) {   
            
            $id = $f['sedeturno_idsedeturno'];
            $nombre = $f['turno_nombre'];
            $horain = $f['turno_horainicio'];
            $horafin = $f['turno_horafin'];
           ?>                                                                    
        <option value="<?php echo $id?>" 
            
            <?php 
//            
                    
                                foreach ($turnos as $t) {
                                if($t['sedeturno_idsedeturno']==$id){ echo 'selected';}
                            }
//            }
                        ?>
                        
                        ><?php echo $nombre.' ('.$horain.' a '.$horafin.')'; ?></option>
            <?php
        }
        echo "</select>";      
        echo "</div>";        
    }
    
    
}
function LlenarComboTurnoAr($datos)
{
    if($datos!=null){
     
        echo "<div class='form-group'>";
        echo "<label class='col-sm-2 col-sm-2 control-label'>TURNO<a style='color:red'>(*)</a></label>";
        echo "<div class='col-sm-10'>";
        echo "<select class='form-control' name='c_turno' id='id_turnoar'>";
        echo "<option value='0'>--SELECCIONE--</option>";
        
        foreach ($datos as $d) {   
            $id = $d['sedeturno_idsedeturno'];
            $nombre = $d['turno_nombre'];
            $horain = $d['turno_horainicio'];
            $horafin = $d['turno_horafin'];
           ?>                                                                    
        <option value="<?php echo $id?>"><?php echo $nombre.' ('.$horain.' a '.$horafin.')'; ?></option>
            <?php
        }
        echo "</select>";      
        echo "</div> </div>";        
    }   
}
function LlenarComboTurnoArEdit($datos,$turnos)
{
    if($datos!=null){
     
        echo "<div class='form-group'>";
        echo "<label for='recipient-turno' class='control-label'>TURNO:</label>";      
        echo "<select class='form-control' style='width: 100%;' name='c_turno' id='id_turnoar'>";
        echo "<option value='0'>--SELECCIONE--</option>";
        
        foreach ($datos as $d) {   
            $id = $d['sedeturno_idsedeturno'];
            $nombre = $d['turno_nombre'];
            $horain = $d['turno_horainicio'];
            $horafin = $d['turno_horafin'];
           ?>                                                                    
        <option value="<?php echo $id?>" 
            
            <?php 
//            foreach ($_SESSION['arreglo_turnos'] as $t) {
                            
                                foreach ($turnos as $t) {
                               if($t['sedeturno_idsedeturno']==$id){ echo 'selected';}
                            }
//            }
                        ?>
                        
                        ><?php echo $nombre.' ('.$horain.' a '.$horafin.')'; ?></option>
            <?php
        }
        echo "</select>";      
        echo "</div>";        
    }   
}
function LlenarComboSubCat($datos)
{
    if($datos!=null){
     
        echo "<div class='form-group'>";
        echo "<label class='col-sm-2 col-sm-2 control-label'>SUBCATEGORIA <a style=color:red>(*)</a></label>";
        echo "<div class='col-sm-10'>";
        echo "<select class='form-control' name='c_subcategoria' id='id_subcategoria' required>";
        echo "<option>--SELECCIONE--</option>";
        foreach ($datos as $d) {   
            $id = $d['subcategoria_idsubcategoria'];
            $nombre = $d['subcategoria_nombre'];
           ?>                                                                    
        <option value="<?php echo $id?>"><?php echo $nombre; ?></option>
            <?php
        }
        echo "</select>";      
        echo "</div> </div>";        
    }
}

function LlenarComboSubCatEdit($datos,$subcat)
{
    if($datos!=null){
     
        echo "<div class='form-group'>";
        echo "<label for='recipient-turno' class='control-label'>SUBCATEGORIA:</label>";
        echo "<select class='form-control' style='width: 100%;' name='c_subcategoria' id='id_subcategoria' required>";
        echo "<option>--SELECCIONE--</option>";
        foreach ($datos as $d) {   
            $id = $d['subcategoria_idsubcategoria'];
            $nombre = $d['subcategoria_nombre'];
           ?>                                                                    
        <option value="<?php echo $id?>" 
            
            <?php 
                            
                                if($subcat==$id){ echo 'selected';}
                            
                        ?>
                        
                        ><?php echo $nombre; ?></option>
            <?php
        }
        echo "</select>";      
        echo "</div>";        
    }
}