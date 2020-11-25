<?php

    class ModeloCredenciales{

        private $db;
        public $id_creden;
        public $id_manip;
        public $estado_creden;
        public $fecha_emis_creden;
        public $fecha_exped_creden;

        public function __construct(){

            $this->db = new Sql;
        }

        //Asignado valores del formulario a cada propiedad si esta existe
        public function set_datos($datos){
            
            foreach ($datos as $nombre_campo => $valor_campo) {
                
                if (property_exists('ModeloCredenciales', $nombre_campo)) {
                    
                    $this->$nombre_campo = $valor_campo;
                }
            }
            return $this;
        }

        public function obtenerFechaActual(){

            $this->db->query("SELECT CURDATE() as hoy");
            return $this->db->register();
        }

        //obtenemos la fecha actual sumada un anio
        public function sumarYear(){

            $this->db->query("SELECT DATE(DATE_ADD(now(), INTERVAL 1 YEAR)) as expedicion");
            return $this->db->register();
        }

        //actualizando tablacredendial
        public function actualizarCredencial($idCredencial, $idManipulador, $fechaExpiracion, $estadoCreden = 'Activo', $emision){
            $this->db->query(
                "UPDATE tblcredenciales 
                SET id_manip = :id_manip, 
                estado_creden = :estado_creden, 
                fecha_emis_creden = :fecha_emis_creden, 
                fecha_exped_creden = :fecha_exped_creden                                 
                WHERE id_creden = :id_creden");
              $this->db->bind(':id_manip', $idManipulador);
              $this->db->bind(':estado_creden', $estadoCreden);
              $this->db->bind(':fecha_emis_creden', $emision);               
              $this->db->bind(':fecha_exped_creden', $fechaExpiracion);
              $this->db->bind(':id_creden', $idCredencial);
            
            if ($this->db->execute()) {                
                return TRUE;
            } else {
                return FALSE;
            }
        }

        //donde se crearan las consultas
        //************************************************************************************************************************************ */        
        //1-obtener las credenciales actas de la tabla de credencial 
        public function obtenerCredenciales(){
            
            $this->db->query("SELECT id_creden, t2.id_manip, DATE_FORMAT(fecha_emis_creden, '%d/%m/%Y') as fecha_emis_creden,  DATE_FORMAT(fecha_exped_creden, '%d/%m/%Y') as fecha_exped_creden,                                         
                                        nombre_manip, genero_manip, 
                                        apellido_manip, dui_manip, puesto_manip,
                                        estado_exam,
                                        asistencia, fecha_asist_capacit
                                    FROM tblcredenciales
                                    INNER JOIN tblmanipuladores t2
                                    ON tblcredenciales.id_manip = t2.id_manip
                                    INNER JOIN tblexamenes
                                    ON tblexamenes.id_manip = t2.id_manip
                                    INNER JOIN tblasistencias 
                                    ON tblasistencias.id_exam = tblexamenes.id_exam 
                                    ");
                            
                    return $this->db->registers();
        }

         //obteniendo total credenciales formales e informales
         public function credencialesForInf($tipoEstab, $estadoCreden){
            
            $this->db->query(
                "SELECT tblcredenciales.id_creden, DATE_FORMAT(fecha_emis_creden, '%d/%m/%Y') as fecha_emis_creden,  DATE_FORMAT(fecha_exped_creden, '%d/%m/%Y') as fecha_exped_creden,
                tblcredenciales.estado_creden,
                tblmanipuladores.nombre_manip, tblmanipuladores.genero_manip, 
                tblmanipuladores.apellido_manip, tblmanipuladores.dui_manip, tblmanipuladores.puesto_manip,
                tblexamenes.estado_exam,  tblestablecimientos.tipo_estab,
                tblasistencias.asistencia, tblasistencias.fecha_asist_capacit
                FROM tblcredenciales
                INNER JOIN tblmanipuladores
                ON tblcredenciales.id_manip = tblmanipuladores.id_manip
                INNER JOIN tblexamenes
                ON tblexamenes.id_manip = tblmanipuladores.id_manip
                INNER JOIN tblasistencias 
                ON tblasistencias.id_exam = tblexamenes.id_exam
                INNER JOIN tblestablecimientos 
                ON tblmanipuladores.id_estab = tblestablecimientos.id_estab 

                WHERE(                  
                    tipo_estab = '$tipoEstab'                   
                    )
                    AND estado_creden = '$estadoCreden'
                
            ");
            return $this->db->rowCount();

        }

        //obtener el numero de registros
        public function numeroRegistros($busqueda = null, $estadoCreden = 'Activo'){
            
            if ($busqueda != null && strpos($busqueda, ' ')) {
        
                $busquedaNombre = explode(' ', $busqueda);
                // agregando los %% a cada elemento del arreglo
                for($i = 0; $i < count($busquedaNombre); $i++){
                    $busquedaNombre[$i] = '%'.$busquedaNombre[$i].'%';
                }
                // convirtiendo el arreglo a str
                $busqueda = implode($busquedaNombre);
        
                $this->db->query(
                    "SELECT tblcredenciales.id_creden, DATE_FORMAT(fecha_emis_creden, '%d/%m/%Y') as fecha_emis_creden,  DATE_FORMAT(fecha_exped_creden, '%d/%m/%Y') as fecha_exped_creden,
                            tblcredenciales.estado_creden,
                            tblmanipuladores.nombre_manip, tblmanipuladores.genero_manip, 
                            tblmanipuladores.apellido_manip, tblmanipuladores.dui_manip, tblmanipuladores.puesto_manip,
                            tblexamenes.estado_exam,  tblestablecimientos.tipo_estab,
                            tblasistencias.asistencia, tblasistencias.fecha_asist_capacit
                    FROM tblcredenciales
                    INNER JOIN tblmanipuladores
                    ON tblcredenciales.id_manip = tblmanipuladores.id_manip
                    INNER JOIN tblexamenes
                    ON tblexamenes.id_manip = tblmanipuladores.id_manip
                    INNER JOIN tblasistencias 
                    ON tblasistencias.id_exam = tblexamenes.id_exam
                    INNER JOIN tblestablecimientos 
                    ON tblmanipuladores.id_estab = tblestablecimientos.id_estab

                    WHERE(
                        LOWER(asistencia) LIKE '%$busqueda%' OR
                        LOWER(estado_exam) LIKE '%$busqueda%' OR
                        LOWER(fecha_asist_capacit) LIKE '%$busqueda%' OR
                        LOWER(dui_manip) LIKE '%$busqueda%' OR
                        LOWER(puesto_manip) LIKE '%$busqueda%' OR
                        LOWER(tipo_estab) LIKE '%$busqueda%' OR
                        LOWER(CONCAT(nombre_manip,apellido_manip)) LIKE '%$busqueda%' OR
                        LOWER(CONCAT(apellido_manip,' ',nombre_manip)) LIKE '%$busqueda%'
                        ) 
                        AND estado_creden = '$estadoCreden'                        
                ");
                return $this->db->rowCount();
                        
            }elseif ($busqueda != '' && !strpos($busqueda, ' ')) {
        
                $this->db->query(
                    "SELECT tblcredenciales.id_creden, DATE_FORMAT(fecha_emis_creden, '%d/%m/%Y') as fecha_emis_creden,  DATE_FORMAT(fecha_exped_creden, '%d/%m/%Y') as fecha_exped_creden,
                            tblcredenciales.estado_creden,
                            tblmanipuladores.nombre_manip, tblmanipuladores.genero_manip, 
                            tblmanipuladores.apellido_manip, tblmanipuladores.dui_manip, tblmanipuladores.puesto_manip,
                            tblexamenes.estado_exam, tblestablecimientos.tipo_estab,
                            tblasistencias.asistencia, tblasistencias.fecha_asist_capacit
                    FROM tblcredenciales
                    INNER JOIN tblmanipuladores
                    ON tblcredenciales.id_manip = tblmanipuladores.id_manip
                    INNER JOIN tblexamenes
                    ON tblexamenes.id_manip = tblmanipuladores.id_manip
                    INNER JOIN tblasistencias 
                    ON tblasistencias.id_exam = tblexamenes.id_exam
                    INNER JOIN tblestablecimientos 
                    ON tblmanipuladores.id_estab = tblestablecimientos.id_estab

                    WHERE(
                        LOWER(asistencia) LIKE '%$busqueda%' OR
                        LOWER(estado_exam) LIKE '%$busqueda%' OR
                        LOWER(fecha_asist_capacit) LIKE '%$busqueda%' OR
                        LOWER(dui_manip) LIKE '%$busqueda%' OR
                        LOWER(puesto_manip) LIKE '%$busqueda%' OR
                        LOWER(tipo_estab) LIKE '%$busqueda%' OR
                        LOWER(nombre_manip) LIKE '%$busqueda%' OR
                        LOWER(apellido_manip) LIKE '%$busqueda%'
                        )
                        AND estado_creden = '$estadoCreden'
                        ");
                return $this->db->rowCount();
        
            }else{
                $this->db->query("SELECT tblcredenciales.id_creden, DATE_FORMAT(fecha_emis_creden, '%d/%m/%Y') as fecha_emis_creden,  DATE_FORMAT(fecha_exped_creden, '%d/%m/%Y') as fecha_exped_creden,
                                        tblcredenciales.estado_creden,
                                        tblmanipuladores.nombre_manip, tblmanipuladores.genero_manip, 
                                        tblmanipuladores.apellido_manip, tblmanipuladores.dui_manip, tblmanipuladores.puesto_manip,
                                        tblexamenes.estado_exam, tblestablecimientos.tipo_estab,
                                        tblasistencias.asistencia, tblasistencias.fecha_asist_capacit
                                FROM tblcredenciales
                                INNER JOIN tblmanipuladores
                                ON tblcredenciales.id_manip = tblmanipuladores.id_manip
                                INNER JOIN tblexamenes
                                ON tblexamenes.id_manip = tblmanipuladores.id_manip
                                INNER JOIN tblasistencias 
                                ON tblasistencias.id_exam = tblexamenes.id_exam
                                INNER JOIN tblestablecimientos 
                                ON tblmanipuladores.id_estab = tblestablecimientos.id_estab
                                AND estado_creden = '$estadoCreden'
                                ");
                
                return $this->db->rowCount();                
                }  
            }

            public function credencialesPorLimite($pos_pagina, $desde, $busqueda = null, $estadoCreden = 'Activo'){
                                                       
                if ($busqueda != null && strpos($busqueda, ' ')) {
        
                    $busquedaNombre = explode(' ', $busqueda);
                    // agregando los %% a cada elemento del arreglo
                    for($i = 0; $i < count($busquedaNombre); $i++){
                        $busquedaNombre[$i] = '%'.$busquedaNombre[$i].'%';
                    }
                    // convirtiendo el arreglo a str
                    $busqueda = implode($busquedaNombre);
                        
                    $this->db->query(
                        "SELECT tblcredenciales.id_creden, DATE_FORMAT(fecha_emis_creden, '%d/%m/%Y') as fecha_emis_creden,  DATE_FORMAT(fecha_exped_creden, '%d/%m/%Y') as fecha_exped_creden,
                                tblcredenciales.estado_creden,
                                tblmanipuladores.nombre_manip, tblmanipuladores.genero_manip, 
                                tblmanipuladores.apellido_manip, tblmanipuladores.dui_manip, tblmanipuladores.puesto_manip,
                                tblexamenes.estado_exam, tblestablecimientos.tipo_estab,
                                tblasistencias.asistencia, tblasistencias.fecha_asist_capacit
                        FROM tblcredenciales
                        INNER JOIN tblmanipuladores
                        ON tblcredenciales.id_manip = tblmanipuladores.id_manip
                        INNER JOIN tblexamenes
                        ON tblexamenes.id_manip = tblmanipuladores.id_manip
                        INNER JOIN tblasistencias 
                        ON tblasistencias.id_exam = tblexamenes.id_exam
                        INNER JOIN tblestablecimientos 
                        ON tblmanipuladores.id_estab = tblestablecimientos.id_estab
    
                        WHERE(
                            LOWER(asistencia) LIKE '%$busqueda%' OR
                            LOWER(estado_exam) LIKE '%$busqueda%' OR
                            LOWER(fecha_asist_capacit) LIKE '%$busqueda%' OR
                            LOWER(dui_manip) LIKE '%$busqueda%' OR
                            LOWER(puesto_manip) LIKE '%$busqueda%' OR
                            LOWER(tipo_estab) LIKE '%$busqueda%' OR
                            LOWER(CONCAT(nombre_manip,apellido_manip)) LIKE '%$busqueda%' OR
                            LOWER(CONCAT(apellido_manip,' ',nombre_manip)) LIKE '%$busqueda%'
                            ) 
                            AND estado_creden = '$estadoCreden' 
                            LIMIT $desde, $pos_pagina
                            -- ORDER BY nombreusuario DESC
                    ");
                    return $this->db->registers();
                        
                }elseif ($busqueda != '' && !strpos($busqueda, ' ')) {
                    
                    $this->db->query(
                        "SELECT SQL_CALC_FOUND_ROWS tblcredenciales.id_creden, DATE_FORMAT(fecha_emis_creden, '%d/%m/%Y') as fecha_emis_creden,  DATE_FORMAT(fecha_exped_creden, '%d/%m/%Y') as fecha_exped_creden,
                                tblcredenciales.estado_creden,
                                tblmanipuladores.nombre_manip, tblmanipuladores.genero_manip, 
                                tblmanipuladores.apellido_manip, tblmanipuladores.dui_manip, tblmanipuladores.puesto_manip,
                                tblexamenes.estado_exam, tblestablecimientos.tipo_estab,
                                tblasistencias.asistencia, tblasistencias.fecha_asist_capacit
                        FROM tblcredenciales
                        INNER JOIN tblmanipuladores
                        ON tblcredenciales.id_manip = tblmanipuladores.id_manip
                        INNER JOIN tblexamenes
                        ON tblexamenes.id_manip = tblmanipuladores.id_manip
                        INNER JOIN tblasistencias 
                        ON tblasistencias.id_exam = tblexamenes.id_exam
                        INNER JOIN tblestablecimientos 
                        ON tblmanipuladores.id_estab = tblestablecimientos.id_estab

                        WHERE(
                            LOWER(asistencia) LIKE '%$busqueda%' OR
                            LOWER(estado_exam) LIKE '%$busqueda%' OR
                            LOWER(fecha_asist_capacit) LIKE '%$busqueda%' OR
                            LOWER(dui_manip) LIKE '%$busqueda%' OR
                            LOWER(puesto_manip) LIKE '%$busqueda%' OR
                            LOWER(tipo_estab) LIKE '%$busqueda%' OR
                            LOWER(nombre_manip) LIKE '%$busqueda%' OR
                            LOWER(apellido_manip) LIKE '%$busqueda%'
                        )
                        AND estado_creden = '$estadoCreden' 
                            LIMIT $desde, $pos_pagina
                            -- ORDER BY nombreusuario DESC
                    ");
         
                        return $this->db->registers();
                }else{
        
                    $this->db->query("SELECT tblcredenciales.id_creden,DATE_FORMAT(fecha_emis_creden, '%d/%m/%Y') as fecha_emis_creden,  DATE_FORMAT(fecha_exped_creden, '%d/%m/%Y') as fecha_exped_creden,
                                        tblcredenciales.estado_creden,
                                        tblmanipuladores.nombre_manip, tblmanipuladores.genero_manip, 
                                        tblmanipuladores.apellido_manip, tblmanipuladores.dui_manip, tblmanipuladores.puesto_manip,
                                        tblexamenes.estado_exam, tblestablecimientos.tipo_estab,
                                        tblasistencias.asistencia, tblasistencias.fecha_asist_capacit
                                    FROM tblcredenciales
                                    INNER JOIN tblmanipuladores
                                    ON tblcredenciales.id_manip = tblmanipuladores.id_manip
                                    INNER JOIN tblexamenes
                                    ON tblexamenes.id_manip = tblmanipuladores.id_manip
                                    INNER JOIN tblasistencias 
                                    ON tblasistencias.id_exam = tblexamenes.id_exam 
                                    INNER JOIN tblestablecimientos 
                                    ON tblmanipuladores.id_estab = tblestablecimientos.id_estab
                                    AND estado_creden = '$estadoCreden'  
                                    LIMIT $desde, $pos_pagina ");
                            
                    return $this->db->registers();
                }
    
            }
        //************************************************************************************************************************************ */        
        //2-para las opciones de la tabla ver asistencia
        public function obtenerCredencial1($id, $estadoCreden = 'Activo'){
            $this->db->query("SET lc_time_names = 'es_ES'");
            $this->db->execute();

            $this->db->query("SELECT tblcredenciales.id_creden, DATE_FORMAT(fecha_emis_creden, '%d/%m/%Y') as fecha_emis_creden,  DATE_FORMAT(fecha_exped_creden, '%d/%m/%Y') as fecha_exped_creden,
                                    tblcredenciales.estado_creden,
                                    tblmanipuladores.nombre_manip, tblmanipuladores.genero_manip, 
                                    tblmanipuladores.apellido_manip, tblmanipuladores.dui_manip, tblmanipuladores.puesto_manip,
                                    tblexamenes.estado_exam,
                                    tblasistencias.asistencia, tblasistencias.fecha_asist_capacit
                            FROM tblcredenciales
                            INNER JOIN tblmanipuladores
                            ON tblcredenciales.id_manip = tblmanipuladores.id_manip
                            INNER JOIN tblexamenes
                            ON tblexamenes.id_manip = tblmanipuladores.id_manip
                            INNER JOIN tblasistencias 
                            ON tblasistencias.id_exam = tblexamenes.id_exam 
                            WHERE id_creden = :id
                            AND estado_creden = '$estadoCreden' 
                ");
            $this->db->bind(':id', $id);

            return $this->db->register();
        } 
 
    }


?>