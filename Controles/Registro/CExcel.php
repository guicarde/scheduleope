<?php
include_once '../../DAO/Conexion.php';
include_once '../../DAO/Registro/Periodo.php';
include_once '../../DAO/Registro/Periodo_Fecha.php';
include_once '../../Recursos/classes_excel/PHPExcel/IOFactory.php'; 
include_once '../../DAO/Registro/Actividad.php';
include_once '../../DAO/Registro/Actividad_Dia.php';
include_once '../../DAO/Registro/Actividad_Turno.php';


//if(isset($_SESSION))
//session_start();



$direccionInicio = "location:../../Vistas/index.php";
$direccionMantener = "location: ../../Vistas/MantenerPeriodo.php";
$direccionGuardar = "location: ../../Vistas/GuardarPeriodo.php";
 
if (isset($_POST['hidden_excel'])) {

    $accion = $_POST['hidden_excel'];
    
   
    if ($accion == 'save')
    {
        ini_set('max_execution_time', 300);
        ini_set('memory_limit', '-1');        
                
        $archivo = $_FILES["fileArchivo"]['name'];
        move_uploaded_file($_FILES['fileArchivo']['tmp_name'],$archivo);
        
        $inputFileType = PHPExcel_IOFactory::identify($archivo);
        $objReader = PHPExcel_IOFactory::createReader($inputFileType);
        $objPHPExcel = $objReader->load($archivo);
        
        //numero de pestaña
        $sheet = $objPHPExcel->getSheet(0);
     
        $ultima_fila = $sheet->getHighestRow();
        $ultima_columna = $sheet->getHighestColumn();
            
        
        $MaxArreglo=array();
        
        for ($row = 13; $row <= 2085; $row++)
        {
            //extraer fila
            $rowData = $sheet->rangeToArray('A' . $row . ':' . 'AE' . $row,NULL, TRUE, FALSE);
            
            $Arreglo=array();
            
            foreach($rowData as $r)
                {
                    if($r!=null)
                    {
                        // DIAS DE LA SEMANA
                        $dias=array();
                        if($r[4]!=null){ $dias[]=1; } //lun
                        if($r[5]!=null){ $dias[]=2; } //mar
                        if($r[6]!=null){ $dias[]=3; } //mie
                        if($r[7]!=null){ $dias[]=4; } //jue
                        if($r[8]!=null){ $dias[]=5; } //vie
                        if($r[9]!=null){ $dias[]=6; } //sab
                        if($r[10]!=null){ $dias[]=7; } //dom
                        
                        
                        
                        //Columna A
                        $A = $r[0]; if($A==null){ $A=''; }
                        //Columna B
                        $B = $r[1]; if($B==null){ $B=''; }
                        //Columna C
                        $C = $r[2]; if($C==null){ $C=''; }
                        //Columna D
                        $D = $r[3]; if($D==null){ $D=''; }
                       
                        //Columna L
                        $E = PHPExcel_Style_NumberFormat::toFormattedString($r[11], 'hh:mm:ss');;
                        //Columna M
                        $F = $r[12]; if($F==null){ $F=''; }
                        //Columna N 
                        $G = $r[13]; if($G==null){ $G=''; }
                        //Columna O
                        $H = trim(strtoupper($r[14])); if($H==null){ $H=''; }                        
                        //Columna P
                        $I = trim(strtoupper($r[15])); if($I==null){ $I=''; }                        
                        //Columna Q
                        $J = trim(strtoupper($r[16])); if($J==null){ $J=''; }                        
                        //Columna R
                        $K = PHPExcel_Style_NumberFormat::toFormattedString($r[17], 'hh:mm:ss');;
                        //Columna S
                        $L = PHPExcel_Style_NumberFormat::toFormattedString($r[18], 'hh:mm:ss');;
                        //Columna T
                        $M = $r[19]; if($M==null){ $M=''; }                                           
                        //Columna U
                        $N = $r[20]; if($N==null){ $N=''; }                        
                        //Columna V
                        $O = trim(strtoupper($r[21])); if($O==null){ $O=''; }                        
                        //Columna W
                        $P = trim(strtoupper($r[22])); if($P==null){ $P=''; }                                               
                        //Columna X
                        $Q = trim(strtoupper($r[23])); if($Q==null){ $Q=''; }
                        //Columna Y
                        $R = trim(strtoupper($r[24])); if($R==null){ $R=''; }                        
                        //Columna Z
                        $S = $r[25]; if($S==null){ $S=''; }
                        //Columna AA
                        $T = $r[26]; if($T==null){ $T=''; }
                        //Columna AB
                        $U = $r[27]; if($U==null){ $U=''; }
                        //Columna AC
                        if ($r[28]!= null){
                        $V = PHPExcel_Style_NumberFormat::toFormattedString($r[28], 'hh:mm:ss');;
                        }else {
                            $V=null;
                        }                        
                        //Columna AD
                        $W = $r[29]; if($W==null){ $W=''; }
                        //Columna AE
                        $Y = $r[30]; if($Y==null){ $Y=''; }
                        
                        $Arreglo = [$A,$B,$C,$D,$E,$F,$G,$H,$I,$J,$K,$L,$M,$N,$O,$P,$Q,$R,$S,$T,$U,$V,$W,$Y];
                        
                    }
                }
                
           $MaxArreglo[] = array($Arreglo,$dias);
        }
        
        
        //Grabar
        foreach($MaxArreglo AS $gordo)
            {
                $datos = $gordo[0];
                $dias  = $gordo[1];
                
                $ob = new Actividad();
                
                //guardar datos
                $id = $ob->grabarExcel( $datos[0],$datos[1],$datos[2],$datos[3],$datos[4],
                                  $datos[5],$datos[6],$datos[7],$datos[8],$datos[9],
                                  $datos[10],$datos[11],$datos[12],$datos[13],$datos[14],
                                  $datos[15],$datos[16],$datos[17],$datos[18],$datos[19],$datos[20],$datos[21],$datos[22],$datos[23]
                                );
               if($datos[0]!= ''){
               $ob_t=new Actividad_Turno();
               $ob_t->setIdactividad($id);
               $ob_t->setIdturno($datos[0]);
               $ob_t->grabar($ob_t);
               }
               if($datos[1]!= ''){
               $ob_t=new Actividad_Turno();
               $ob_t->setIdactividad($id);
               $ob_t->setIdturno($datos[1]);
               $ob_t->grabar($ob_t);
               }
               
                //guardar dias
                $ob = new Actividad_Dia();
                
                foreach($dias as $d)
                {
                    $ob->setIddia($d);
                    $ob->setIdactividad($id);
                    
                    $ob->grabar($ob);
                }
            }
            
            header("location: ../../Vistas/MantenerActividad.php");
    }  
    
   
 
} else {
    header("location: ../../Vistas/MantenerPeriodo.php");
}
