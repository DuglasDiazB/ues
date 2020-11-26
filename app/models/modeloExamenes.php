<?php

    class ModeloExamenes{

        private $db;

        public function __construct(){

            $this->db = new Sql;
        }

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
        
        //obteniendo asistencia
        public function obtenerAsistencia($id){
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
            ");
            $this->db->bind(':id', $id);

            return $this->db->register();
        }

        public function obtenerAsistencia2($id){
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
                WHERE tblexamenes.id_exam = :id                
            ");
            $this->db->bind(':id', $id);

            return $this->db->register();
        }
        

        public function sumarMeses($meses){

            $this->db->query("SELECT DATE(DATE_ADD(now(), INTERVAL $meses MONTH)) as expedicion");
            return $this->db->register();
        }

        public function obtenerExamen($id){
            $this->db->query("SET lc_time_names = 'es_ES'");
            $this->db->execute();
            $this->db->query(
                "SELECT 
                tblexamenes.id_exam, tblmanipuladores.id_manip,
                dui_manip, nombre_manip, apellido_manip, puesto_manip,
                nombre_estab, direccion_estab, tipo_estab,
                ifnull(fecha_entrega_so, 'sin fecha') as fecha_entrega_so, exam_s, exam_o, 
                ifnull(fecha_entrega_so2, 'sin fecha') as fecha_entrega_so2, exam_s2, exam_o2,
                estado_exam, fecha_exped_exam,
                tblexamenes.usermod,
                DATE_FORMAT(fechamodexamen, 'ultima modificación %W %d de %M del %Y a las %H:%i') as fechamod 
                FROM tblexamenes
                INNER JOIN tblmanipuladores 
                ON tblexamenes.id_manip = tblmanipuladores.id_manip
                INNER JOIN tblestablecimientos 
                ON tblmanipuladores.id_estab = tblestablecimientos.id_estab
                WHERE id_exam = $id            
                AND estado_manip = 'Activo'
                "
            );
            return $this->db->register();

        }

        //obteniendo total examenes formales e informales
        public function examenesForInf($tipoEstab, $examen){

            
            $this->db->query(
                "SELECT * FROM tblexamenes
                INNER JOIN tblmanipuladores
                ON tblexamenes.id_manip = tblmanipuladores.id_manip
                INNER JOIN tblestablecimientos 
                ON tblmanipuladores.id_estab = tblestablecimientos.id_estab
                
                WHERE(                  
                    tipo_estab = '$tipoEstab'                   
                    )
                AND estado_exam = '$examen'"
            );
            return $this->db->rowCount();


        }        
        //obteniendo el numero total de registros
        public function numeroRegistros($busqueda = null, $estadoExamen = "Acto"){

            //Busquedas con espacios
            if ($busqueda != null && strpos($busqueda,' ')){
                        
                $busquedaCompeta = explode(' ', $busqueda);
                
                for ($i = 0; $i < count($busquedaCompeta); $i++){

                    $busquedaCompeta[$i] = '%'.$busquedaCompeta[$i].'%';

                }

                $busqueda = implode($busquedaCompeta);

                $this->db->query(
                    "SELECT * FROM tblexamenes
                    INNER JOIN tblmanipuladores
                    ON tblexamenes.id_manip = tblmanipuladores.id_manip
                    WHERE(LOWER(CONCAT(nombre_manip, apellido_manip)) LIKE '$busqueda' OR
                    LOWER(CONCAT(apellido_manip, nombre_manip)) LIKE '$busqueda' OR
                    LOWER(tipo_estab) LIKE '%$busqueda%'
                    ) 
                    AND estado_manip = 'Activo'
                    AND estado_exam = '$estadoExamen'
                    "
                );
                return $this->db->rowCount();
            
            //Busquedas para palabras completas
            }elseif ($busqueda != '' && !strpos($busqueda, ' ')){
                $this->db->query(
                    "SELECT * FROM tblexamenes
                    INNER JOIN tblmanipuladores
                    ON tblexamenes.id_manip = tblmanipuladores.id_manip
                    INNER JOIN tblestablecimientos 
                    ON tblmanipuladores.id_estab = tblestablecimientos.id_estab
                    WHERE(                        
                        LOWER(dui_manip) LIKE '%$busqueda%' OR
                        LOWER(nombre_manip) LIKE '%$busqueda%' OR
                        LOWER(apellido_manip) LIKE '%$busqueda%' OR
                        LOWER(genero_manip) LIKE '%$busqueda%' OR
                        LOWER(puesto_manip) LIKE '%$busqueda%'  OR
                        LOWER(tipo_estab) LIKE '%$busqueda%'
                    ) 
                    AND estado_manip = 'Activo'
                    AND estado_exam = '$estadoExamen'
                    "
                );
                return $this->db->rowCount();
            }

            //devolver todos los registros inicial
            $this->db->query(
                "SELECT * 
                FROM tblexamenes
                WHERE estado_exam = '$estadoExamen'
            ");
                
            return $this->db->rowCount();

        }

        public function obtenerTodosExamenes(){
            $this->db->query(
                "SELECT * 
                FROM tblexamenes
                WHERE estado_exam = 'Acto'
            ");
                
            return $this->db->registers();
        }

        public function examenesPorLimite($postPagina, $desde, $busqueda = null, $estadoExamen = 'Acto'){

            if ($busqueda != null && strpos($busqueda,' ')){
                        
                $busquedaCompeta = explode(' ', $busqueda);
                
                for ($i = 0; $i < count($busquedaCompeta); $i++){

                    $busquedaCompeta[$i] = '%'.$busquedaCompeta[$i].'%';

                }

                $busqueda = implode($busquedaCompeta);

                $this->db->query(
                    "SELECT * FROM tblexamenes
                    INNER JOIN tblmanipuladores
                    ON tblexamenes.id_manip = tblmanipuladores.id_manip
                    WHERE(LOWER(CONCAT(nombre_manip, apellido_manip)) LIKE '$busqueda' OR
                    LOWER(CONCAT(apellido_manip, nombre_manip)) LIKE '$busqueda' OR
                    LOWER(tipo_estab) LIKE '%$busqueda%'
                    ) 
                    AND estado_manip = 'Activo'
                    AND estado_exam = '$estadoExamen'
                    LIMIT $desde, $postPagina
                    "
                );
                return $this->db->registers();
            }elseif ($busqueda != '' && !strpos($busqueda, ' ')){
                $this->db->query(
                    "SELECT * FROM tblexamenes
                    INNER JOIN tblmanipuladores
                    ON tblexamenes.id_manip = tblmanipuladores.id_manip
                    INNER JOIN tblestablecimientos 
                    ON tblmanipuladores.id_estab = tblestablecimientos.id_estab
                    WHERE(                        
                        LOWER(dui_manip) LIKE '%$busqueda%' OR
                        LOWER(nombre_manip) LIKE '%$busqueda%' OR
                        LOWER(apellido_manip) LIKE '%$busqueda%' OR
                        LOWER(genero_manip) LIKE '%$busqueda%' OR
                        LOWER(puesto_manip) LIKE '%$busqueda%' OR
                        LOWER(tipo_estab) LIKE '%$busqueda%'
                    ) 
                    AND estado_manip = 'Activo'
                    AND estado_exam = '$estadoExamen'
                    LIMIT $desde, $postPagina
                    "
                );
                return $this->db->registers();
            }

            $this->db->query("SELECT * FROM tblexamenes 
                            INNER JOIN tblmanipuladores
                            ON tblexamenes.id_manip = tblmanipuladores.id_manip
                            INNER JOIN tblestablecimientos 
                            ON tblmanipuladores.id_estab = tblestablecimientos.id_estab
                            WHERE estado_manip = 'Activo'
                            AND estado_exam = '$estadoExamen'
                            LIMIT $desde, $postPagina ");
                
            return $this->db->registers();
            
        }

        public function examenesUpdate($examen){
            
            $this->db->query(
                "UPDATE tblexamenes 
                SET id_manip = :id_manip, 
                fecha_entrega_so = :fecha_entrega_so, 
                exam_s = :exam_s, 
                exam_o = :exam_o,
                fecha_entrega_so2 = :fecha_entrega_so2, 
                exam_s2 = :exam_s2, 
                exam_o2 = :exam_o2, 
                estado_exam = :estado_exam,
                fecha_exped_exam = :fecha_exped_exam, 
                fechamodexamen = now(), 
                usermod = :usermod                   
                WHERE id_exam = :id_exam");
              $this->db->bind(':id_manip', $examen->id_manip);
              $this->db->bind(':fecha_entrega_so', $examen->fecha_entrega_so);
              $this->db->bind(':exam_s', $examen->exam_s);
              $this->db->bind(':exam_o', $examen->exam_o);
              $this->db->bind(':fecha_entrega_so2', $examen->fecha_entrega_so2);
              $this->db->bind(':exam_s2', $examen->exam_s2);
              $this->db->bind(':exam_o2', $examen->exam_o2);
              $this->db->bind(':estado_exam', $examen->estado_exam);
              $this->db->bind(':fecha_exped_exam', $examen->fecha_exped_exam);
              $this->db->bind(':usermod', $examen->usermod);
              $this->db->bind(':id_exam', $examen->id_exam);
              
            if ($this->db->execute()) {                
                return TRUE;
            } else {
                return FALSE;
            }
        }

        public function examenesUpdateNoActo($examen){
            
            $this->db->query(
                "UPDATE tblexamenes 
                SET id_manip = :id_manip, 
                fecha_entrega_so = NULL, 
                exam_s = 'No entregado', 
                exam_o = 'No entregado',
                fecha_entrega_so2 = NULL, 
                exam_s2 = 'No entregado', 
                exam_o2 = 'No entregado', 
                estado_exam = 'No acto',
                fecha_exped_exam = NULL, 
                fechamodexamen = :fechamodexamen, 
                usermod = :usermod                   
                WHERE id_exam = :id_exam");
                
              $this->db->bind(':id_manip', $examen->id_manip);
              $this->db->bind(':fechamodexamen', $examen->fechamodexamen);                                                      
              $this->db->bind(':usermod', $examen->usermod);
              $this->db->bind(':id_exam', $examen->id_exam);
              
            if ($this->db->execute()) {                
                return TRUE;
            } else {
                return FALSE;
            }
        }


    }

?>