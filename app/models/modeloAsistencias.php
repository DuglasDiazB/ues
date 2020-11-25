<?php

    class ModeloAsistencias{

        private $db;
        public $id_asistencia;
        public $id_exam;
        public $asistencia;
        public $fecha_asist_capacit;

        public function __construct(){

            $this->db = new Sql;
        }

        //Asignado valores del formulario a cada propiedad si esta existe
        public function set_datos($datos){
            
            foreach ($datos as $nombre_campo => $valor_campo) {
                
                if (property_exists('ModeloAsistencias', $nombre_campo)) {
                    
                    $this->$nombre_campo = $valor_campo;
                }
            }
            return $this;
        }

        //obtner la fecha actual
        public function obtenerFechaActual(){

            $this->db->query("SELECT CURDATE() as hoy");
            return $this->db->register();
        }

        public function obtenerCredencial($idManip){
            
            
            $this->db->query("SELECT *
                FROM tblcredenciales
                WHERE id_manip = $idManip
            ");
                                
            return $this->db->register();
            
        }

        public function obtenerExamen($idExam){
            
            
            $this->db->query("SELECT *
                FROM tblexamenes
                WHERE id_exam = $idExam
            ");
                                
            return $this->db->register();
            
        }

        //obtener fecha de inicio y fincalizacion de capacitaciones
        public function obtenerFechaCapacitaciones(){

            $this->db->query("SELECT  *  
                FROM tblfechacapacitaciones
                WHERE id_fechacapacit = 1    
            ");
            return $this->db->register();
        }

        //obtener todas las asistencias de la tabla asistencias que su estado asistencia = 'Si'

        public function obtenerTodasAsistencias(){
            $this->db->query("SELECT *
                FROM tblasistencias 
                WHERE asistencia = 'Si'
            ");
        
            return $this->db->registers();
        }
       
        //donde se crearan las consultas
        //************************************************************************************************************************************ */        
        //1-obtener la asistencia de la tabla de asistencia 
          public function obtenerAsistencias(){

            $this->db->query("SELECT id_asistencia, asistencia, fecha_asist_capacit, tblmanipuladores.nombre_manip, 
                        tblmanipuladores.apellido_manip, tblmanipuladores.dui_manip, tblmanipuladores.puesto_manip, tblexamenes.estado_exam, 
                        tblestablecimientos.nombre_estab, tblestablecimientos.tipo_estab, tblestablecimientos.cat_estab, tblestablecimientos.direccion_estab   
                        FROM tblasistencias  
                        INNER JOIN tblexamenes
                        ON tblasistencias.id_exam = tblexamenes.id_exam
                        INNER JOIN tblmanipuladores
                        ON tblmanipuladores.id_manip = tblexamenes.id_manip
                        INNER JOIN tblestablecimientos 
                        ON tblestablecimientos.id_estab = tblmanipuladores.id_estab
            ");
        
            return $this->db->registers();
        }

        //obteniendo total asistencias formales e informales
        public function asistenciasForInf($tipoEstab, $asistencia){

            $this->db->query(
                "SELECT id_asistencia, asistencia, fecha_asist_capacit, tblmanipuladores.nombre_manip, 
                tblmanipuladores.apellido_manip, tblmanipuladores.dui_manip,tblmanipuladores.puesto_manip, tblexamenes.estado_exam, 
                tblestablecimientos.nombre_estab, tblestablecimientos.tipo_estab, tblestablecimientos.cat_estab, tblestablecimientos.direccion_estab  
                FROM tblasistencias  
                INNER JOIN tblexamenes
                ON tblasistencias.id_exam = tblexamenes.id_exam
                INNER JOIN tblmanipuladores
                ON tblmanipuladores.id_manip = tblexamenes.id_manip
                INNER JOIN tblestablecimientos
                ON tblestablecimientos.id_estab = tblmanipuladores.id_estab 

                WHERE(                  
                    tipo_estab = '$tipoEstab'                   
                    )
                AND asistencia = '$asistencia' 
                
            ");
            return $this->db->rowCount();

        }
        
              
        //obtener el numero de registros
        public function numeroRegistros($busqueda = null, $asistencia = 'Si'){
          
            if ($busqueda != null && strpos($busqueda, ' ')) {
        
                $busquedaNombre = explode(' ', $busqueda);
                // agregando los %% a cada elemento del arreglo
                for($i = 0; $i < count($busquedaNombre); $i++){
                    $busquedaNombre[$i] = '%'.$busquedaNombre[$i].'%';
                }
                // convirtiendo el arreglo a str
                $busqueda = implode($busquedaNombre);
                $this->db->query(
                    "SELECT id_asistencia, asistencia, fecha_asist_capacit, tblmanipuladores.nombre_manip, 
                    tblmanipuladores.apellido_manip, tblmanipuladores.dui_manip,tblmanipuladores.puesto_manip, tblexamenes.estado_exam, 
                    tblestablecimientos.nombre_estab, tblestablecimientos.tipo_estab, tblestablecimientos.cat_estab, tblestablecimientos.direccion_estab  
                    FROM tblasistencias  
                    INNER JOIN tblexamenes
                    ON tblasistencias.id_exam = tblexamenes.id_exam
                    INNER JOIN tblmanipuladores
                    ON tblmanipuladores.id_manip = tblexamenes.id_manip
                    INNER JOIN tblestablecimientos
                    ON tblestablecimientos.id_estab = tblmanipuladores.id_estab 

                    WHERE(
                        LOWER(asistencia) LIKE '%$busqueda%' OR
                        LOWER(estado_exam) LIKE '%$busqueda%' OR
                        LOWER(fecha_asist_capacit) LIKE '%$busqueda%' OR
                        LOWER(dui_manip) LIKE '%$busqueda%' OR
                        LOWER(nombre_estab) LIKE '%$busqueda%' OR
                        LOWER(tipo_estab) LIKE '$busqueda%' OR
                        LOWER(puesto_manip) LIKE '%$busqueda%' OR
                        LOWER(cat_estab) LIKE '%$busqueda%' OR
                        LOWER(direccion_estab) LIKE '%$busqueda%' OR
                        LOWER(CONCAT(nombre_manip,apellido_manip)) LIKE '%$busqueda%' OR
                        LOWER(CONCAT(apellido_manip,' ',nombre_manip)) LIKE '%$busqueda%'
                        ) 
                        AND asistencia = '$asistencia' 
                ");
                return $this->db->rowCount();
                        
            }elseif ($busqueda != '' && !strpos($busqueda, ' ')) {
        
                $this->db->query(
                    "SELECT id_asistencia, asistencia, fecha_asist_capacit, tblmanipuladores.nombre_manip, 
                    tblmanipuladores.apellido_manip, tblmanipuladores.dui_manip, tblmanipuladores.puesto_manip, tblexamenes.estado_exam, 
                    tblestablecimientos.nombre_estab, tblestablecimientos.tipo_estab, tblestablecimientos.cat_estab, tblestablecimientos.direccion_estab  
                    FROM tblasistencias  
                    INNER JOIN tblexamenes
                    ON tblasistencias.id_exam = tblexamenes.id_exam
                    INNER JOIN tblmanipuladores
                    ON tblmanipuladores.id_manip = tblexamenes.id_manip
                    INNER JOIN tblestablecimientos
                    ON tblestablecimientos.id_estab = tblmanipuladores.id_estab 

                    WHERE(
                        LOWER(asistencia) LIKE '%$busqueda%' OR
                        LOWER(estado_exam) LIKE '%$busqueda%' OR
                        LOWER(fecha_asist_capacit) LIKE '%$busqueda%' OR
                        LOWER(dui_manip) LIKE '%$busqueda%' OR
                        LOWER(nombre_estab) LIKE '%$busqueda%' OR
                        LOWER(puesto_manip) LIKE '%$busqueda%' OR
                        LOWER(tipo_estab) LIKE '%$busqueda%' OR
                        LOWER(cat_estab) LIKE '%$busqueda%' OR
                        LOWER(direccion_estab) LIKE '%$busqueda%' OR
                        LOWER(nombre_manip) LIKE '%$busqueda%' OR
                        LOWER(apellido_manip) LIKE '%$busqueda%'
                        )
                        AND asistencia = '$asistencia'  "
                );
                return $this->db->rowCount();
        
            }else{
                $this->db->query("SELECT id_asistencia, asistencia, fecha_asist_capacit, tblmanipuladores.nombre_manip, 
                tblmanipuladores.apellido_manip, tblmanipuladores.dui_manip, tblmanipuladores.puesto_manip, tblexamenes.estado_exam, 
                tblestablecimientos.nombre_estab, tblestablecimientos.tipo_estab, tblestablecimientos.cat_estab, tblestablecimientos.direccion_estab  
                FROM tblasistencias  
                INNER JOIN tblexamenes
                ON tblasistencias.id_exam = tblexamenes.id_exam
                INNER JOIN tblmanipuladores
                ON tblmanipuladores.id_manip = tblexamenes.id_manip
                INNER JOIN tblestablecimientos
                ON tblestablecimientos.id_estab = tblmanipuladores.id_estab
                AND asistencia = '$asistencia'  ");
                
                return $this->db->rowCount();                
                }  
            }
        
            public function asistenciasPorLimite($pos_pagina, $desde, $busqueda = null, $asistencia = 'Si'){
                if ($busqueda != null && strpos($busqueda, ' ')) {
        
                    $busquedaNombre = explode(' ', $busqueda);
                    // agregando los %% a cada elemento del arreglo
                    for($i = 0; $i < count($busquedaNombre); $i++){
                        $busquedaNombre[$i] = '%'.$busquedaNombre[$i].'%';
                    }
                    // convirtiendo el arreglo a str
                    $busqueda = implode($busquedaNombre);
                        
                    $this->db->query(
                        "SELECT id_asistencia, asistencia, fecha_asist_capacit, tblmanipuladores.nombre_manip, 
                        tblmanipuladores.apellido_manip, tblmanipuladores.dui_manip, tblmanipuladores.puesto_manip, tblexamenes.estado_exam, 
                        tblestablecimientos.nombre_estab, tblestablecimientos.tipo_estab, tblestablecimientos.cat_estab, tblestablecimientos.direccion_estab  
                        FROM tblasistencias  
                        INNER JOIN tblexamenes
                        ON tblasistencias.id_exam = tblexamenes.id_exam
                        INNER JOIN tblmanipuladores
                        ON tblmanipuladores.id_manip = tblexamenes.id_manip
                        INNER JOIN tblestablecimientos
                        ON tblestablecimientos.id_estab = tblmanipuladores.id_estab
    
                        WHERE(
                            LOWER(asistencia) LIKE '%$busqueda%' OR
                            LOWER(estado_exam) LIKE '%$busqueda%' OR
                            LOWER(fecha_asist_capacit) LIKE '%$busqueda%' OR
                            LOWER(dui_manip) LIKE '%$busqueda%' OR
                            LOWER(nombre_estab) LIKE '%$busqueda%' OR
                            LOWER(puesto_manip) LIKE '%$busqueda%' OR
                            LOWER(tipo_estab) LIKE '%$busqueda%' OR
                            LOWER(cat_estab) LIKE '%$busqueda%' OR
                            LOWER(direccion_estab) LIKE '%$busqueda%' OR
                            LOWER(CONCAT(nombre_manip,apellido_manip)) LIKE '%$busqueda%' OR
                            LOWER(CONCAT(apellido_manip,' ',nombre_manip)) LIKE '%$busqueda%'
                            ) 
                            AND asistencia = '$asistencia' 
                            LIMIT $desde, $pos_pagina
                            -- ORDER BY nombreusuario DESC
                    ");
                    return $this->db->registers();
                        
                }elseif ($busqueda != '' && !strpos($busqueda, ' ')) {
                    
                    $this->db->query(
                        "SELECT SQL_CALC_FOUND_ROWS id_asistencia, asistencia, fecha_asist_capacit, tblmanipuladores.nombre_manip, 
                        tblmanipuladores.apellido_manip, tblmanipuladores.dui_manip, tblmanipuladores.puesto_manip, tblexamenes.estado_exam, 
                        tblestablecimientos.nombre_estab, tblestablecimientos.tipo_estab, tblestablecimientos.cat_estab, tblestablecimientos.direccion_estab  
                        FROM tblasistencias  
                        INNER JOIN tblexamenes
                        ON tblasistencias.id_exam = tblexamenes.id_exam
                        INNER JOIN tblmanipuladores
                        ON tblmanipuladores.id_manip = tblexamenes.id_manip
                        INNER JOIN tblestablecimientos
                        ON tblestablecimientos.id_estab = tblmanipuladores.id_estab 

                        WHERE(
                            LOWER(asistencia) LIKE '%$busqueda%' OR
                            LOWER(estado_exam) LIKE '%$busqueda%' OR
                            LOWER(fecha_asist_capacit) LIKE '%$busqueda%' OR
                            LOWER(dui_manip) LIKE '%$busqueda%' OR
                            LOWER(nombre_estab) LIKE '%$busqueda%' OR
                            LOWER(tipo_estab) LIKE '%$busqueda%' OR
                            LOWER(cat_estab) LIKE '%$busqueda%' OR
                            LOWER(direccion_estab) LIKE '%$busqueda%' OR
                            LOWER(puesto_manip) LIKE '%$busqueda%' OR
                            LOWER(nombre_manip) LIKE '%$busqueda%' OR
                            LOWER(apellido_manip) LIKE '%$busqueda%'
                        )
                            AND asistencia = '$asistencia' 
                            LIMIT $desde, $pos_pagina
                            -- ORDER BY nombreusuario DESC
                    ");
         
                        return $this->db->registers();
                }else{
        
                    $this->db->query(" SELECT id_asistencia, asistencia, fecha_asist_capacit, tblmanipuladores.nombre_manip, 
                    tblmanipuladores.apellido_manip, tblmanipuladores.dui_manip, tblmanipuladores.puesto_manip, tblexamenes.estado_exam, 
                    tblestablecimientos.nombre_estab, tblestablecimientos.tipo_estab, tblestablecimientos.cat_estab, tblestablecimientos.direccion_estab  
                    FROM tblasistencias  
                    INNER JOIN tblexamenes
                    ON tblasistencias.id_exam = tblexamenes.id_exam
                    INNER JOIN tblmanipuladores
                    ON tblmanipuladores.id_manip = tblexamenes.id_manip
                    INNER JOIN tblestablecimientos
                    ON tblestablecimientos.id_estab = tblmanipuladores.id_estab  
                    AND asistencia = '$asistencia' 
                    LIMIT $desde, $pos_pagina ");
                            
                    return $this->db->registers();
                }
        
            }

            //************************************************************************************************************************************ */        
            //2-para las opciones de la tabla ver asistencia
            public function obtenerAsistencia1($id, $asistencia = "Si"){
                $this->db->query("SET lc_time_names = 'es_ES'");
                $this->db->execute();

                $this->db->query("SELECT id_asistencia, tblexamenes.id_exam, asistencia, 
                 IFNULL( DATE_FORMAT(fechamodasistencia, '%W %d de %M del %Y'),'sin fecha' )as fechamodasistencia,
                 IFNULL( tblasistencias.usermod, 'sin usuario') as usermod,  
                    fecha_asist_capacit, tblmanipuladores.nombre_manip, 
                    tblmanipuladores.apellido_manip, tblmanipuladores.dui_manip, tblmanipuladores.puesto_manip, tblexamenes.estado_exam, 
                    tblestablecimientos.nombre_estab, tblestablecimientos.tipo_estab, tblestablecimientos.cat_estab, tblestablecimientos.direccion_estab
                    FROM tblasistencias  
                    INNER JOIN tblexamenes
                    ON tblasistencias.id_exam = tblexamenes.id_exam
                    INNER JOIN tblmanipuladores
                    ON tblmanipuladores.id_manip = tblexamenes.id_manip
                    INNER JOIN tblestablecimientos
                    ON tblestablecimientos.id_estab = tblmanipuladores.id_estab
                    WHERE id_asistencia = :id
                    AND asistencia = '$asistencia' 
                ");
                $this->db->bind(':id', $id);

                return $this->db->register();
            }
            
        //*********************************************************************************************************************** */
        //3-Mostrando opcion editar de la tabla asistencia
        public function actualizarAsistencia($idAsistencia, $idExamen, $asistencia, $fechacapacitacion, $usermod){
            $this->db->query(
                "UPDATE  tblasistencias
                SET id_exam = :id_exam,
                    fecha_asist_capacit = :fecha_asist_capacit,
                    asistencia = :asistencia,
                    usermod = :usermod,
                    fechamodasistencia = now() 
                    WHERE id_asistencia = :id");
                       
            $this->db->bind(':asistencia', $asistencia);
            $this->db->bind(':fecha_asist_capacit', $fechacapacitacion);
            $this->db->bind(':id_exam', $idExamen);     
            $this->db->bind(':usermod', $usermod);
            $this->db->bind(':id', $idAsistencia);

            if ($this->db->execute()) {
                
                return TRUE;
            } else {
                return FALSE;
            }
            
        }

        //4-Mostrando opcion editar de la tabla fechaasistencia
        public function actualizarFechaCapacitacion($fechainiciocapacit, $fechafincapacit, $usermod, $ejecutado = 'No'){
            $this->db->query(
                "UPDATE  tblfechacapacitaciones
                SET fecha_inicio_capacit = :fecha_inicio_capacit,
                    fecha_fin_capacit = :fecha_fin_capacit, 
                    ejecutado = :ejecutado,
                    fechamodcapacit = now(),
                    usermod = :usermod
                    WHERE id_fechacapacit = :id");
                       
            $this->db->bind(':fecha_inicio_capacit', $fechainiciocapacit);
            $this->db->bind(':fecha_fin_capacit', $fechafincapacit);
            $this->db->bind(':ejecutado', 'No');  
            $this->db->bind(':usermod', $usermod);    
            $this->db->bind(':id', 1);

            if ($this->db->execute()) {
                
                return TRUE;
            } else {
                return FALSE;
            }
            
        }

        public function actualizarFechaCapacitacion1($fechainiciocapacit, $fechafincapacit, $usermod, $fechamodcapacit){
            $this->db->query(
                "UPDATE  tblfechacapacitaciones
                SET fecha_inicio_capacit = :fecha_inicio_capacit,
                    fecha_fin_capacit = :fecha_fin_capacit, 
                    ejecutado = 'Si',
                    fechamodcapacit = :fechamodcapacit,
                    usermod = :usermod
                    WHERE id_fechacapacit = :id");
                       
            $this->db->bind(':fecha_inicio_capacit', $fechainiciocapacit);
            $this->db->bind(':fecha_fin_capacit', $fechafincapacit);            
            $this->db->bind(':fechamodcapacit', $fechamodcapacit);
            $this->db->bind(':usermod', $usermod);    
            $this->db->bind(':id', 1);

            if ($this->db->execute()) {
                
                return TRUE;
            } else {
                return FALSE;
            }
            
        }

        
 
 
    }


?>