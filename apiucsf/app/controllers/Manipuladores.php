<?php

class Manipuladores extends MainController{

    function __construct(){

        $this->modeloManipuladores = $this->model('ManipuladoresModel');
        
        header("Access-Control-Allow-Origin: *");
        header('Content-Type: aplication/json');
        header("Accept-application/json");

    }
    
    public function loguot(){
                  
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //obteniendo datos de manipulador de alimentos y el establecimiento al que pertenece
            $manipulador = $this->modeloManipuladores->getManipulador(trim($_POST['duiManip']));
            $this->modeloManipuladores->saveTokenManipulador($manipulador, trim($_POST['token']));
            $respuesta = array(
                'error' => TRUE,
                'mensaje' => 'logOut',
                'manipulador' => []
            );
            http_response_code(200);
            echo json_encode($respuesta);
            return;
        }


    }
    //Metodo que verifica la existencia del manipulador en la base de datos
    // solo recibe el duiManip = Numero de dui y el token
    public function checkManipulador(){

        //verificamos si se ha enviado algo con el metodo post
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            
            if(!isset($_POST['token'])){

                $respuesta = array(
                    'error' => TRUE,
                    'mensaje' => 'No es posible obtener el token',
                    'manipulador' => []
                );
                http_response_code(200);
                echo json_encode($respuesta);
                return;

            }
            
            //obteniendo datos de manipulador de alimentos y el establecimiento al que pertenece
            $manipulador = $this->modeloManipuladores->getManipulador(trim($_POST['duiManip']));
            //1.0 necesitamos saber que el manipulador existe
            if ($manipulador) {
                                        
                //verificando si existe el token en la base de datos
                if($manipulador->token == null){
                     
                    //Guardamos el token                    
                    $this->modeloManipuladores->saveTokenManipulador($manipulador, trim($_POST['token']));
                
                //verificamos si el token enviado es diferente
                }elseif ($manipulador->token != trim($_POST['token'])) {

                    //guardamos nuevo token
                    $this->modeloManipuladores->saveTokenManipulador($manipulador, trim($_POST['token']));

                }
                                                              
                //obtenemos datos de la credencial correspondiente al id del manipulador
                $credencial = $this->modeloManipuladores->getCredencial( $manipulador->id_manip );
                
                //obteniendo examen del manipulador
                $examen = $this->modeloManipuladores->examenManipulador($manipulador->id_manip);
                
                
                //obtenemos la fecha actual
                $fechaActual = $this->modeloManipuladores->ahora()->hoy;
                

                //restando 7 dias a la fecha de fecha_exped_exam            
                $fechaExpedExam7 = $this->modeloManipuladores->restandoFecha($fechaExpedExam = $examen->fecha_exped_exam, 7)->fecha_rest;
                
                // obteniendo fecha de expiracion de examen
                $fechaExpedExam = $examen->fecha_exped_exam;                                                                
               
                 //**************************************************************************************************/
                 //-------------------------------EXAMENES DE MANIPULADORES DE ALIMENTOS----------------------------*/

                 //1.0 verificamos si estado_exam = 'Acto'

                if($examen->estado_exam == 'Acto'){

                    
                    //fecha expedicion                         
                    $date1 = new DateTime($fechaExpedExam);

                    //fecha actual 
                    $date2 = new DateTime($fechaActual);

                    //restando fecha expedicion - fecha actual
                    $diff = $date1->diff($date2)->days;

                    //verificamos si ya expiro el examen de manipulador de alimentos
                    if ($fechaActual > $fechaExpedExam) {
                        
                        $infoExamen = 'Su examen de manipulador de alimentos ya expiro, Se le exige cumplir con la normativa de entrega de exámenes';
                        
                        //desactivamos la credencial
                        $this->modeloManipuladores->desactivarCredencial($credencial);
                        
                        //pasamos a no acto los examenes
                        $this->modeloManipuladores->desactivarExamen($examen->id_exam, $examen->id_manip);

                        //recargamos el examen y la credencial
                        $examen = $this->modeloManipuladores->examenManipulador($manipulador->id_manip);

                    // 1.1 verificamos si fechaActual llego a fechaExpedExam7 = fechaExpedExam - 7 dias
                    }elseif ($fechaActual >= $fechaExpedExam7) {


                        // 1.1.1 verificamos si se ha llegado a la fecha de expedicion
                        if ($diff == 0) {

                            $infoExamen = 'Hoy expiran sus exámenes de manipulador de alimentos';


                        }else{

                            $infoExamen = 'Faltan '.$diff.' días para que su examen de manipulador de alimentos expire';
                        
                        }
                       
                        ////////////////////1.2 este apartado no va en las pushNotifications/////////////////////////////////
                    }else{

                        $infoExamen = 'Faltan '.$diff.' días para que su examen de manipulador de alimentos expire';

                    }
                }else{
                    
                    $infoExamen = 'Se le exige cumplir con la normativa de entrega de exámenes, para la obtención la credencial de manipulador de alimentos';
                    $examen->estado_exam = 'No acto';
                }
                /////////////////////////////////////////////////////////////////////////////////////////////////////
                
                //verificando cuando se entrega el primerExamen de SO
                if ($examen->fecha_entrega_so != null && $examen->fecha_entrega_so2 == null) {

                    if ($examen->exam_s == 'DN') {
                        $exam_s = 'Dentro de norma';
                    }elseif($examen->exam_s == 'FN'){
                        $exam_s = 'Fuera de norma';
                    }
                    if ($examen->exam_o == 'DN') {
                        $exam_o = 'Dentro de norma';
                    }elseif($examen->exam_o == 'FN'){
                        $exam_o = 'Fuera de norma';
                    }
                                    
                //Verificando que ya se a entregado el SO y el SO2
                }elseif ($examen->fecha_entrega_so != null && $examen->fecha_entrega_so2 != null) {
                    
                    if ($examen->exam_s2 == 'DN') {
                        $exam_s = 'Dentro de norma';
                    }elseif($examen->exam_s2 == 'FN'){
                        $exam_s = 'Fuera de norma';
                    }
                    if ($examen->exam_o2 == 'DN') {
                        $exam_o = 'Dentro de norma';
                    }elseif($examen->exam_o2 == 'FN'){
                        $exam_o = 'Fuera de norma';
                    }                    

                }

                //**************************************************************************************************/
                //-------------------------------------------------------------------------------------------------*/
  
                //************************************CAPACITACIONES******************************************************//

                //obteniendo la fecha de inicio y final de las capacitaciones
                $fechaCapacitaciones = $this->modeloManipuladores->getFechaCapacitaciones();
                
                $capacitaciones = $this->modeloManipuladores->getFechaCapacSinFormato();
                //verificando si se ha establecido fecha para las capacitaciones                
                if ($capacitaciones->fecha_inicio_capacit != 'No establecida' AND
                    $capacitaciones->fecha_fin_capacit != 'No establecida' AND 
                    $fechaActual <= $capacitaciones->fecha_fin_capacit) {                    

                    //verificando si la fecha de hoy es igual a la fecha de capacitaciones 
                    if ($fechaActual ==  $capacitaciones->fecha_inicio_capacit) {
                        
                        $infoCapacit = 'Las capacitaciones inician este día';

                    ////////////////////////ESTA CONDICION NO SE INCLUYE EN EL PUSHNOTIFICATION///////////////////////////
                    }elseif ( $fechaActual >  $capacitaciones->fecha_inicio_capacit AND
                              $fechaActual < $capacitaciones->fecha_fin_capacit) {

                        $infoCapacit = 'Estamos en periodo de capacitaciones';
                    /////////////////////////////////////////////////////////////////////////////////////////////////////
                    }elseif ($fechaActual == $capacitaciones->fecha_fin_capacit) {
                        
                        $infoCapacit = 'Hoy finaliza el periodo de capacitaciones, por lo cual sino ha asistido se le recomienda hacer acto de presencia';
                    
                    }else{
                            //fecha expedicion                         
                        $date1 = new DateTime($capacitaciones->fecha_inicio_capacit);

                        //fecha actual 
                        $date2 = new DateTime($fechaActual);

                        //restando fecha expedicion - fecha actual
                        $diff = $date1->diff($date2)->days;

                        $infoCapacit = 'Faltan '.$diff.' días para que inicien las capacitaciones';

                    }
                }else{

                    $infoCapacit = 'Ya no estamos en periodo de capacitaciones';

                }

                //******************************CREDENCIAL DE MANIPULADOR*******************************************/
                

                //obtenemos la fecha de expedicion del manipulador en formato Y-M-D
                $fechaExpedicion = $this->modeloManipuladores->fechaExpedicion( $manipulador->id_manip );
                
                //Verificamos que retorna una fecha y no es null
                //Importante los campos de la tabla tblcredenciales seran
                //estado_creden = Inactivo, fecha_emis_creden = null, fecha_exped_creden = null  
                
                //fecha de ultima comprovacion de estado
                $hoyConFormato = $this->modeloManipuladores->ahoraConformato();            
                
                //obteniendo asistencias 
                $asistencia = $this->modeloManipuladores->obtenerAsistencia1($examen->id_manip);                                

                if (  $examen->estado_exam == 'No acto' OR $asistencia->asistencia == 'No') { 
                   
                    //desactivamos la credencial
                    $this->modeloManipuladores->desactivarCredencial($credencial);
                } 

                $credencial = $this->modeloManipuladores->getCredencial( $manipulador->id_manip );

                if($credencial->estado_creden == 'Inactivo'){

                    $infoCreden = 'El estado de su credencial de manipulador de alimentos es inactivo, por lo cual se le exige la asistencia a capacitaciones y entregar los exámenes clínicos correspondientes, para obtener su renovación';

                }else{

                    $infoCreden = 'El estado de su credencial de manipulador de alimentos es activo';
                }

                $fechaExpedExam = $this->modeloManipuladores->fechaConformato($examen->fecha_exped_exam);
                    
                                        
                $manip = [

                    'estadoExam' => $examen->estado_exam,
                    'fechaExpedExam' => ($examen->fecha_exped_exam == null) ? 'Sin fecha' : $fechaExpedExam->fecha_con_formato,
                    'infoExamen' => $infoExamen, 
                    'idManip' => $manipulador->id_manip,
                    'duiManip'=> $manipulador->dui_manip,
                    'nombreManip' => $manipulador->nombre_manip,
                    'apellidoManip' => $manipulador->apellido_manip,
                    'puestoManip' => $manipulador->puesto_manip,
                    'nombreEstab' => $manipulador->nombre_estab,
                    'infoCapacit' => $infoCapacit,
                    'fechaInicioCapacit' => $fechaCapacitaciones->fecha_inicio_capacit,
                    'fechaFinCapacit' => $fechaCapacitaciones->fecha_fin_capacit,
                    'estadoCreden' => $credencial->estado_creden,
                    'asistencia' => $asistencia->asistencia,
                    // 'fechaExpedicion' => ($credencial->fecha_exped == null) ? 'sin fecha' : $credencial->fecha_exped,
                    'informacion' => $infoCreden,
                    'comprobacion' => 'Ultima comprobación '.$hoyConFormato->hoy_con_formato,
                    
                ];
                                  
                    //preparando la respuesta
                $respuesta = array(
                    'error' => FALSE,
                    'mensaje' => 'Cargado correctamente',
                    'manipulador' => $manip,                        
                );
                http_response_code(200);
                echo json_encode($respuesta);
                return;
               
            //cuando no existe el manipulador de alimentos                                        
            }else{
                $respuesta = array(
                    'error' => TRUE,
                    'mensaje' => 'No se encuentra el DUI: '. $_POST['duiManip'],
                    'manipulador' => []
                );
                http_response_code(200);
                echo json_encode($respuesta);
                return;
            }
        }

    }


    public function preprandoNotificacion(){

        //obteniendo todos los manipuladores de alimentos
        $manipuladores = $this->modeloManipuladores->getAllManipuladores();

        //obteniendo la fecha actual
        $fechaActual = $this->modeloManipuladores->ahora()->hoy;        

        for ($i=0; $i < count($manipuladores); $i++) { 
            
            $manipulador =  $this->modeloManipuladores->getManipulador($manipuladores[$i]->dui_manip);
            //obtenemos la credencial del manipulador
            $credencial = $this->modeloManipuladores->getCredencial( $manipulador->id_manip );

            //obteniendo el examen correspondiente al manipulador
            $examen = $this->modeloManipuladores->examenManipulador($manipulador->id_manip);

            if($examen->fecha_exped_exam != NULL){

                //restando 7 dias a la fecha de fecha_exped_exam            
                $fechaExpedExam7 = $this->modeloManipuladores->restandoFecha($examen->fecha_exped_exam, 7)->fecha_rest;
            }else{
                $fechaExpedExam7 = 'sin fecha';
            }
            
            //obteniendo la fecha de inicio y final de las capacitaciones
            $fechaCapacitaciones = $this->modeloManipuladores->getFechaCapacitaciones();
            
            $capacitaciones = $this->modeloManipuladores->getFechaCapacSinFormato();
            // obteniendo fecha de expiracion de examen

            //obteniendo asistencias 
            $asistencia = $this->modeloManipuladores->obtenerAsistencia1($examen->id_manip);

            $fechaExpedExam = $examen->fecha_exped_exam;
            
            if(($examen->estado_exam == 'Acto' AND ($fechaActual >= $fechaExpedExam7  AND $fechaActual <= $fechaExpedExam)) 
                OR ($fechaActual ==  $capacitaciones->fecha_inicio_capacit OR $fechaActual == $capacitaciones->fecha_fin_capacit)){
                    
                //fecha expedicion                         
                $date1 = new DateTime($fechaExpedExam);

                //fecha actual 
                $date2 = new DateTime($fechaActual);

                //restando fecha expedicion - fecha actual
                $diff = $date1->diff($date2)->days;

                //verificamos si ya expiro el examen de manipulador de alimentos
                if ($fechaActual >= $fechaExpedExam7) {


                    // 1.1.1 verificamos si se ha llegado a la fecha de expedicion
                    if ($diff == 0) {

                        $infoExamen = 'Hoy expiran sus exámenes de manipulador de alimentos';


                    }else{

                        $infoExamen = 'Faltan '.$diff.' días para que su examen de manipulador de alimentos expire';
                    
                    }
                                       
                }else{

                    $infoExamen = 'Faltan '.$diff.' días para que su examen de manipulador de alimentos expire';

                }

                //verificando cuando se entrega el primerExamen de SO
                if ($examen->fecha_entrega_so != null && $examen->fecha_entrega_so2 == null) {
    
                    if ($examen->exam_s == 'DN') {
                        $exam_s = 'Dentro de norma';
                    }elseif($examen->exam_s == 'FN'){
                        $exam_s = 'Fuera de norma';
                    }
                    if ($examen->exam_o == 'DN') {
                        $exam_o = 'Dentro de norma';
                    }elseif($examen->exam_o == 'FN'){
                        $exam_o = 'Fuera de norma';
                    }
                                    
                //Verificando que ya se a entregado el SO y el SO2
                }elseif ($examen->fecha_entrega_so != null && $examen->fecha_entrega_so2 != null) {
                    
                    if ($examen->exam_s2 == 'DN') {
                        $exam_s = 'Dentro de norma';
                    }elseif($examen->exam_s2 == 'FN'){
                        $exam_s = 'Fuera de norma';
                    }
                    if ($examen->exam_o2 == 'DN') {
                        $exam_o = 'Dentro de norma';
                    }elseif($examen->exam_o2 == 'FN'){
                        $exam_o = 'Fuera de norma';
                    }                    
    
                }              

                //verificando si se ha establecido fecha para las capacitaciones                
                if ($capacitaciones->fecha_inicio_capacit != 'No establecida' AND
                    $capacitaciones->fecha_fin_capacit != 'No establecida' AND 
                    $fechaActual <= $capacitaciones->fecha_fin_capacit) {
    
                    
                    //verificando si la fecha de hoy es igual a la fecha de capacitaciones 
                    if ($fechaActual ==  $capacitaciones->fecha_inicio_capacit) {
                        
                        $infoCapacit = 'Las capacitaciones inician este día';

                        if ($asistencia->fecha_asist_capacit < $capacitaciones->fecha_inicio_capacit) {
                            
                            $this->modeloManipuladores->actualizarAsistencia($asistencia->id_exam, $asistencia->id_asistencia);
                            $asistencia = $this->modeloManipuladores->obtenerAsistencia1($examen->id_manip);

                        }

                    ////////////////////////ESTA CONDICION NO SE INCLUYE EN EL PUSHNOTIFICATION///////////////////////////
                    }elseif ( $fechaActual >  $capacitaciones->fecha_inicio_capacit AND
                              $fechaActual < $capacitaciones->fecha_fin_capacit) {
    
                        $infoCapacit = 'Estamos en periodo de capacitaciones';
                    /////////////////////////////////////////////////////////////////////////////////////////////////////
                    }elseif ($fechaActual == $capacitaciones->fecha_fin_capacit) {
                        
                        $infoCapacit = 'Hoy finaliza el periodo de capacitaciones, por lo cual sino ha asistido se le recomienda hacer acto de presencia';
                    
                    }else{

                        //fecha expedicion                         
                        $date1 = new DateTime($capacitaciones->fecha_inicio_capacit);

                        //fecha actual 
                        $date2 = new DateTime($fechaActual);

                        //restando fecha expedicion - fecha actual
                        $diff = $date1->diff($date2)->days;

                        $infoCapacit = 'Faltan '.$diff.' días para que inicien las capacitaciones';

                    }

                    
                }else{
                    
                    $infoCapacit = 'Ya no estamos en periodo de capacitaciones';
                    
                } 
                                
                
                $notification = [
                    "title" => "Unidad Comunitaria de Salud Familiar",
                    "body" => 'Examen: '.$infoExamen .'.  Capacitaciones: '.$infoCapacit,
                ];
                              
                //obtenemos la fecha de expedicion del manipulador en formato Y-M-D
                $fechaExpedicion = $this->modeloManipuladores->fechaExpedicion( $manipulador->id_manip );
                
                //Verificamos que retorna una fecha y no es null
                //Importante los campos de la tabla tblcredenciales seran
                //estado_creden = Inactivo, fecha_emis_creden = null, fecha_exped_creden = null  
                
                //fecha de ultima comprovacion de estado
                $hoyConFormato = $this->modeloManipuladores->ahoraConformato();            
                    
    
                if (  $examen->estado_exam == 'No acto' OR $asistencia->asistencia == 'No') { 
                   
                    //desactivamos la credencial
                    $this->modeloManipuladores->desactivarCredencial($credencial);
                } 
    
                $credencial = $this->modeloManipuladores->getCredencial( $manipulador->id_manip );
    
                if($credencial->estado_creden == 'Inactivo'){
    
                    $infoCreden = 'El estado de su credencial de manipulador de alimentos es inactivo, por lo cual se le exige la asistencia a capacitaciones y entregar los exámenes clínicos correspondientes, para obtener su renovación';
    
                }else{
    
                    $infoCreden = 'El estado de su credencial de manipulador de alimentos es activo';
                }
    
                $fechaExpedExam = $this->modeloManipuladores->fechaConformato($examen->fecha_exped_exam);

                $manip = [
    
                    'estadoExam' => $examen->estado_exam,
                    'fechaExpedExam' => ($examen->fecha_exped_exam == null) ? 'Sin fecha' : $fechaExpedExam->fecha_con_formato,
                    'infoExamen' => $infoExamen, 
                    'idManip' => $manipulador->id_manip,
                    'duiManip'=> $manipulador->dui_manip,
                    'nombreManip' => $manipulador->nombre_manip,
                    'apellidoManip' => $manipulador->apellido_manip,
                    'puestoManip' => $manipulador->puesto_manip,
                    'nombreEstab' => $manipulador->nombre_estab,
                    'infoCapacit' => $infoCapacit,
                    'fechaInicioCapacit' => $fechaCapacitaciones->fecha_inicio_capacit,
                    'fechaFinCapacit' => $fechaCapacitaciones->fecha_fin_capacit,
                    'estadoCreden' => $credencial->estado_creden,
                    'asistencia' => $asistencia->asistencia,
                    // 'fechaExpedicion' => ($credencial->fecha_exped == null) ? 'sin fecha' : $credencial->fecha_exped,
                    'informacion' => $infoCreden,
                    'comprobacion' => 'Ultima comprobación '.$hoyConFormato->hoy_con_formato,
                    
                ];

                prepare($manipulador->token, $notification, $manip);
                                  
                    //preparando la respuesta
                $respuesta = array(
                    'error' => FALSE,
                    'mensaje' => 'Cargado correctamente',
                    'manipulador' => $manip,                        
                );
                http_response_code(200);
                echo json_encode($respuesta);
                return;
            }
                                             
        }
        
    }

    


    //Preparando la notificacion
    public function notificacionPrepare(){
                
        //obteniendo las credenciales de los manipuladores que aun no han expirado
        //en este caso todos los manipuladores que su fecha de expedicion exista y no sea null
        $manipuladores = $this->modeloManipuladores->getAllCredenciales();
        
        //obtenemos la fecha actual sin formato
        $fechaActual = $this->modeloManipuladores->ahora();

        //fecha de ultima comprovacion de estado 
        //es la fecha actual con formato
        $hoyConFormato = $this->modeloManipuladores->ahoraConformato();
        
        //creando la instancia a la clase
        $notificaciones = new Notificaciones();

        //recorriendo la lista de manipuladores y credenciales
        for ($i=0; $i < count($manipuladores); $i++) {
            
            //obteniendo el token            
            $token = $manipuladores[$i]->token;

            //obteniendo datos de manipulador de alimentos y el establecimiento al que pertenece
            $manipulador = $this->modeloManipuladores->getManipulador($manipuladores[$i]->dui_manip);
            
            //obtenemos datos de la credencial correspondiente al id del manipulador
            $credencial = $this->modeloManipuladores->getCredencial( $manipuladores[$i]->id_manip );
            
            //obtenemos la fecha de expedicion del manipulador en formato Y-M-D
            $fechaExpedicion = $this->modeloManipuladores->fechaExpedicion( $manipulador->id_manip );

            //obteniendo la fecha de expedicion restada 7 dias
            $fechaRest = $this->modeloManipuladores->restandoFecha($fechaExpedicion->fecha_exped_creden);
           
            //condicion que nos indica que la credencial a vencido
            if ($fechaActual->hoy > $fechaExpedicion->fecha_exped_creden) {
                                
                $manip = [
                    'idManip' => $manipulador->id_manip,
                    'duiManip'=> $manipulador->dui_manip,
                    'nombreManip' => $manipulador->nombre_manip,
                    'apellidoManip' => $manipulador->apellido_manip,
                    'puestoManip' => $manipulador->puesto_manip,
                    'nombreEstab' => $manipulador->nombre_estab,                        
                ];
                
                $creden = [
                    'estadoCreden' => 'Inactivo',
                    'fechaExpedicion' => $credencial->fecha_exped,
                    'informacion' => 'Su credencial esta inactiva, es muy importante, que cumpla con las normativas para obtener su rennovacion',
                    'comprobacion' => 'Ultima comprobación '.$hoyConFormato->hoy_con_formato,                        
                ];

                //desactivamos la credencial
                $this->modeloManipuladores->desactivarCredencial($credencial);
                
                //preparando la respuesta
               
                //**************************************************** */
                //preparando la notificacion
                // *****************************************************/
                $notification = [
                    "title" => "Unidad Comunitaria de Salud Familiar",
                    "body" => "Su credencial ya vencio",
                ];

                $notificaciones->prepare($token, $notification, $manip, $creden); 

                //verificamos que la fecha actual es menor a la fecha de expedicion
                //indica que aun falta un rango de 7 dias para que la credencial expire
            }elseif ( $fechaActual->hoy >= $fechaRest->fecha_rest ) {

                 //fecha expedicion
                 $date1 = new DateTime($fechaExpedicion->fecha_exped_creden);

                 //fecha actual 
                 $date2 = new DateTime($fechaActual->hoy);

                 //restando fecha expedicion - fecha actual
                 $diff = $date1->diff($date2);
                 
                 //retorna cuantos dias faltan para que se cumpla la fecha de expedicion
                 //igual a cero indica que este dia a expirado                        
                 if($diff->days == 0){

                     $informacion = 'Hoy expira su credencial de manipulador de alimentos por lo que se le recomienda acudir a la unidad de salud para su renovacion';
                     
                     //cuantos dias faltan para que se cumpla la fecha de expiracion
                 }else{

                     $informacion = 'Faltan '.$diff->days.' dias para que su credencial de manipulador de alimentos expire';
                 }

                 $manip = [
                     'idManip' => $manipulador->id_manip,
                     'duiManip'=> $manipulador->dui_manip,
                     'nombreManip' => $manipulador->nombre_manip,
                     'apellidoManip' => $manipulador->apellido_manip,
                     'puestoManip' => $manipulador->puesto_manip,
                     'nombreEstab' => $manipulador->nombre_estab,                        
                 ];
                 
                 $creden = [
                     'estadoCreden' => $credencial->estado_creden,
                     'fechaExpedicion' => $credencial->fecha_exped,
                     'informacion' => $informacion,
                     'comprobacion' => 'Ultima comprobación '.$hoyConFormato->hoy_con_formato,                        
                 ];
                 
                 $notification = [
                    "title" => "Unidad Comunitaria de Salud Familiar",
                    "body" => "Su credencial esta a pocos dias de vencer",
                ];

                $notificaciones->prepare($token, $notification, $manip, $creden);

            }                                            
            
        }

    }

}

class Notificaciones extends MainController{

    function __construct(){

        $this->modeloManipuladores = $this->model('ManipuladoresModel');
        
    }

    public function prepare($token, $notification, $manip, $creden){

        //obteniendo llave de acceso a la api
        // define('API_ACCESS_KEY', 'AAAAxU1v-Ls:APA91bHplegHp7tnkqgspdMpQ4MlYbu3Xe4fpxI6FAiT9GlZHlmm_Fjg6rfz0uRv_HC-d6c-c63Kz81XfHS1kQaOzNb-dh6-uhQYB6tUjZJviOet7U0WCATVmxBhccdhxdT9BrJxnNtn');
        $key = 'AAAAm7zkmpo:APA91bHX8S0fFqbFE-notVs7OeNZhvSd9tfe2tlcohFYTxXB5QEuLC9Wop-fZ085g9OVwWSynT_kOUeLb3O1zDOmGDYYpxLlQriu3sC36BxYI7VbT8XNjJROSZMw7i6DjhRrN3Fm4FJ-';
        //obteniendo la ruta de la api
        $fcmUrl = 'https://fcm.googleapis.com/fcm/send';
        
        //informacion que vamos a incluir en la notificacion esta aparece cuando precionamos
        //en la notificacion
        $data = [
            "comida" => "Comida desde desde la clase",
            "manipulador" => $manip,
            "credencial" => $creden,            
            "click_action" => "FLUTTER_NOTIFICATION_CLICK"
        ];

        //colocando los elemento necesarios para el mensaje
        $fcmNotification = [
            'to' => $token,
            'notification' => $notification,
            'data' => $data
        ];
        // print_r($fcmNotification);
        //creando los encabezados 
        $headers =[
            'Authorization: key=' . $key,
            'Content-Type: application/json'
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $fcmUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));

        $result = curl_exec($ch);

        curl_close($ch);

        echo $result;  
    }
    

   

}

?>