<?php

    class ModeloBitacoras{

        private $db;

        public $id_log;
        public $uri;
        public $metodo;
        public $direccion_ip;
        public $usuario_log;
        public $fecha_log; 
        public $respuesta_log;
   

        public function __construct(){

            $this->db = new Sql;
        }

        //Asignado valores del formulario a cada propiedad si esta existe
        public function set_datos($datos){
            
            foreach ($datos as $nombre_campo => $valor_campo) {
                
                if (property_exists('ModeloBitacoras', $nombre_campo)) {
                    
                    $this->$nombre_campo = $valor_campo;
                }
            }
            return $this;
        }

        //donde se crearan las consultas
        

        // 3-obteniendo todos los registros para la tabla
        public function obtenerBitacoras(){

            $this->db->query("SELECT  id_log, uri, metodo, direccion_ip, usuario_log,
                                DATE_FORMAT(fecha_log, '%d/%m/%Y %H:%i') as fecha_log,
                                respuesta_log FROM tbllog");

            return $this->db->registers();
        }

      
        //obtener el numero de registros
        public function numeroRegistros($busqueda = null){

            if ($busqueda != null && strpos($busqueda, ' ')) {

                $busquedaNombre = explode(' ', $busqueda);
                // agregando los %% a cada elemento del arreglo
				for($i = 0; $i < count($busquedaNombre); $i++){
					$busquedaNombre[$i] = '%'.$busquedaNombre[$i].'%';
				}
		        // convirtiendo el arreglo a str
                $busqueda = implode($busquedaNombre);

                $this->db->query(
                    "SELECT  id_log, uri, metodo, direccion_ip, usuario_log,
                                DATE_FORMAT(fecha_log, '%d/%m/%Y %H:%i') as fecha_log,
                                respuesta_log FROM tbllog  
                        WHERE(
                         LOWER(metodo) LIKE '%$busqueda%' OR
                         LOWER(usuario_log) LIKE '%$busqueda%' OR
                         LOWER(respuesta_log) LIKE '%$busqueda%'
                        ) 
                    ");
                return $this->db->rowCount();
                
            }elseif ($busqueda != '' && !strpos($busqueda, ' ')) {

                $this->db->query(
                    "SELECT  id_log, uri, metodo, direccion_ip, usuario_log,
                                DATE_FORMAT(fecha_log, '%d/%m/%Y %H:%i') as fecha_log,
                                respuesta_log FROM tbllog 
                     WHERE(
                        LOWER(metodo) LIKE '%$busqueda%' OR
                         LOWER(usuario_log) LIKE '%$busqueda%' OR
                         LOWER(respuesta_log) LIKE '%$busqueda%'

                        )"
                    );
                return $this->db->rowCount();

            }else{
                $this->db->query("SELECT  id_log, uri, metodo, direccion_ip, usuario_log,
                                    DATE_FORMAT(fecha_log, '%d/%m/%Y %H:%i') as fecha_log,
                                    respuesta_log FROM tbllog");
                return $this->db->rowCount();                
            }  
        }

        public function bitacorasPorLimite($pos_pagina, $desde, $busqueda = null){
            if ($busqueda != null && strpos($busqueda, ' ')) {

                $busquedaNombre = explode(' ', $busqueda);
                // agregando los %% a cada elemento del arreglo
				for($i = 0; $i < count($busquedaNombre); $i++){
					$busquedaNombre[$i] = '%'.$busquedaNombre[$i].'%';
				}
		        // convirtiendo el arreglo a str
                $busqueda = implode($busquedaNombre);
                
                $this->db->query(
                    "SELECT  id_log, uri, metodo, direccion_ip, usuario_log,
                            DATE_FORMAT(fecha_log, '%d/%m/%Y %H:%i') as fecha_log,
                            respuesta_log FROM tbllog  
                             WHERE(
                                LOWER(metodo) LIKE '%$busqueda%' OR
                                LOWER(usuario_log) LIKE '%$busqueda%' OR
                                LOWER(respuesta_log) LIKE '%$busqueda%'
                             )  
                             LIMIT $desde, $pos_pagina
                            -- ORDER BY nombreusuario DESC
                    ");
                return $this->db->registers();
                
            }elseif ($busqueda != '' && !strpos($busqueda, ' ')) {
            
                $this->db->query(
                    "SELECT SQL_CALC_FOUND_ROWS id_log, uri, metodo, direccion_ip, usuario_log,
                                DATE_FORMAT(fecha_log, '%d/%m/%Y %H:%i') as fecha_log,
                                respuesta_log   FROM tbllog  
                     WHERE(
                         LOWER(metodo) LIKE '%$busqueda%' OR
                         LOWER(usuario_log) LIKE '%$busqueda%' OR
                         LOWER(respuesta_log) LIKE '%$busqueda%'
                        )
                        LIMIT $desde, $pos_pagina
                        -- ORDER BY nombreusuario DESC
                        ");
 
                    return $this->db->registers();
            }else{

                $this->db->query(" SELECT  id_log, uri, metodo, direccion_ip, usuario_log,
                                DATE_FORMAT(fecha_log, '%d/%m/%Y %H:%i') as fecha_log,
                                respuesta_log   FROM tbllog  
                                LIMIT $desde, $pos_pagina ");
                    
                return $this->db->registers();
            }

        }

        public function insertBitacora ($server, $respuesta){

            //subtrayendo caracteres del URI
            // echo $server['REQUEST_URI'].'</br>';
            $uri = substr($server['REQUEST_URI'], 5);
            
            $this->db->query("INSERT INTO 
                            tbllog ( uri, metodo, direccion_ip, usuario_log, fecha_log, respuesta_log) 
                            VALUES ( :uri, :metodo, :direccion_ip, :usuario_log, now(), :respuesta_log)"
                        );
                    
            $this->db->bind(':uri', $uri);
            $this->db->bind(':metodo', $server['REQUEST_METHOD']);
            $this->db->bind(':direccion_ip', $server['REMOTE_ADDR']);
            $this->db->bind(':usuario_log', $_SESSION['user']->username);
            $this->db->bind(':respuesta_log', $respuesta);

            if ($this->db->execute()) {
                return true;
            } else {
                return false;
            }
            
        }
    }


?>