function cancelar(){
window.location.replace("index.php");
}
function iniciarTarea(id_schedule)
{  
    var idschedule = document.getElementById('id_schedule_act'+id_schedule).value;
    var accion = document.getElementById('hidden_schedule').value;
             
        $("#inicio_tar"+id_schedule).load("../Controles/Registro/CSchedule.php", 
            {
              hidden_schedule : accion,
              id_schedule_act: idschedule
            }, function(){
            }
            );    
    
        
        $("#div_finalizar_tarea"+id_schedule).load("../Controles/Registro/CSchedule.php", 
            {
              hidden_schedule : 'habilitar_finalizar',
              id_schedule_act: idschedule
            }, function(){
            }
            );   
    
}

function cambiarestado(id_actividad)
{  
//    aler('si llego');
//    exit();
    var idactividad = document.getElementById('id_hidden_eliminar'+id_actividad).value;
    var estado = document.getElementById('hidden_estado'+id_actividad).value;
             
        $("#estado_"+id_actividad).load("../Controles/Registro/CActividad.php", 
            {
              hidden_estado : estado,
              id_hidden_eliminar: idactividad,
              hidden_actividad: 'anular'
            }, function(){
            }
            );    
    
}
function cambiartws(id_actividad)
{  
//    aler('si llego');
//    exit();
    var idactividad = document.getElementById('id_hidden_tws'+id_actividad).value;
    var tws = document.getElementById('hidden_tws'+id_actividad).value;
             
        $("#tws_"+id_actividad).load("../Controles/Registro/CActividad.php", 
            {
              hidden_tws : tws,
              id_hidden_tws: idactividad,
              hidden_actividad: 'cambiar_tws'
            }, function(){
            }
            );    
    
}


function comentario_Tarea(id_schedule)
{
    $("#div_comentario_tarea"+id_schedule).load("../Controles/Registro/CSchedule.php", 
            {
              hidden_schedule : 'insertar_comentario',
              txt_comentario: document.getElementById('txt_comentario'+id_schedule).value,
              horainicio: document.getElementById('horainicio'+id_schedule).value,
              horafinal: document.getElementById('horafinal'+id_schedule).value,
              c_estado_tar: document.getElementById('c_estado_tar'+id_schedule).value,
              id_schedule_act: id_schedule
            }, function(){
            }
            );  
}


function finalizar_Tarea(id_schedule)
{
        $("#div_finalizatarea"+id_schedule).load("../Controles/Registro/CSchedule.php", 
            {
              hidden_schedule : 'finalizar_tarea',
              id_schedule_act: id_schedule
            }, function(){
            }
            ); 
    
    
    setTimeout(function(){
    
  
     $("#div_comentario_tarea"+id_schedule).load("../Controles/Registro/CSchedule.php", 
            {
              hidden_schedule : 'habilitar_comentario_tarea',
              id_schedule_act: id_schedule,
              hora_inicio : document.getElementById("id_marcado_hora_inicio"+id_schedule).value,
              hora_fin : document.getElementById("id_marcado_hora_fin"+id_schedule).value              
            }, function(){
            }
            ); 
    
    },10000);
    
    
}


function AceptaActividad(){
    
    document.getElementById('hiddenschedule').value = 'aceptar_act';
    document.getElementById('form_confirmar').submit();
}
function RechazaActividad(){
    
//    alert('pruebame');
//    exit();
    document.getElementById('hiddenschedule').value = 'rechazar_act';
    document.getElementById('form_confirmar').submit();
}


function cancelarguardar(){
     var fecha_periodo = document.getElementById('id_fecha').value;
    document.getElementById('hiddenusuario').value = 'cancelar_guardar';
    document.getElementById('formcancelar').submit();
}


function guardarSchedule(){
    
//    alert('pruebame');
//   exit();
    document.getElementById('hiddenschedule').value = 'save';
    document.getElementById('form_schedule').submit();
}

function cerrarSchedule(){
    
//    alert('pruebame');
//   exit();
    document.getElementById('hiddenschedule').value = 'guardarscheduleope';
    document.getElementById('form_cerrar_schedule').submit();
}
function BuscarSchedule(){
    
//    alert('pruebame');
//    exit();
    document.getElementById('hiddenschedule').value = 'buscar_act';
    document.getElementById('form_schedule').submit();
}


function cancelarmantusu(){
    document.getElementById('cancusuario').value = 'cancelar_mant_usua';
    document.getElementById('formcanc').submit();
}

function cancelarguardarpriv(){
    document.getElementById('hiddenprivilegio').value = 'cancelar_guardar';
    document.getElementById('formcancelar2').submit();
}






//A partir de aqui se utiliza los Scripts Para el Sistema Schedule --->>>>


function agregarFechaPeriodo()
{  
    var fecha_periodo = document.getElementById('id_fecha').value;
     
     if(fecha_periodo===''){
   
    alert('Seleccione Al menos Una Fecha Para el Periodo');
     }
     else{
        
             
        $("#tabla_agrega_fecha").load("../Controles/Registro/CPeriodo.php", 
            {
              hidden_periodo : "agregarFecha",
              hidden_fecha: fecha_periodo
            }, function(){
            }
            );
    document.getElementById('id_fecha').value = '';
         

     }
}
function eliminaFecha(h)
{  
//    alert(h);
    var fecha = document.getElementById(h).value;
    
//    alert(numteleli);
//    exit();
        $("#tabla_agrega_fecha").load("../Controles/Registro/CPeriodo.php", 
            {
              hidden_periodo : "eliminaFecha",
              hidden_fecha  : fecha
            }, function(){
            }
            );
 
}

function cargarTurnosPorSede()
{
    
    var id_sede = document.getElementById('id_sede').value;
   if(id_sede==='1'){
    $("#divTurnos").load("../Controles/Registro/CActividad.php", 
      {
          hidden_actividad: "cargarTurnosPorSede",
          hidden_sede: id_sede
          
      }, function(){
      }
      );
      
   }
   if(id_sede==='2'){
    $("#divTurnos").load("../Controles/Registro/CActividad.php", 
      {
          hidden_actividad: "cargarTurnosPorAram",
          hidden_sede: id_sede
          
      }, function(){
      }
      );
      
   }
   
   

}

function cargarTurnosPorSedeSc()
{
    
    var id_sede = document.getElementById('id_sede_sc').value;
    if(id_sede==='1'){
    $("#divTurnosSc").load("../Controles/Registro/CSchedule.php", 
      {
          hidden_schedule: "cargarTurnosPorSede",
          hidden_sede: id_sede
          
      }, function(){
      }
      );
    }
    if(id_sede==='2'){
   $("#divTurnosSc").load("../Controles/Registro/CSchedule.php", 
      {
          hidden_schedule: "cargarTurnosPorAram",
          hidden_sede: id_sede
          
      }, function(){
      }
      );
      
   }
}

function cargarSubcatPorCat()
{
    
    var id_cat = document.getElementById('id_categoria').value;
//       alert(id_cat);
//      exit();
    $("#divSubCategoria").load("../Controles/Registro/CActividad.php", 
      {
          hidden_actividad: "cargarSubcatPorCat",
          hidden_cat: id_cat
          
      }, function(){
      }
      );

}

function nobackbutton(){
   window.location.hash="no-back-button";
   window.location.hash="Again-No-back-button" //chrome
   window.onhashchange=function(){window.location.hash="no-back-button";}
	
}