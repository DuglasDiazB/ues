<?php

    class ModeloInspecciones{

        private $db;

        public $id_inspec;
        public $inspec_para;
        public $fecha_inspec;
        public $objeto_visita;
        public $nombre_inspector;
        public $cal_primer_inspec;
        public $primer_reinspec_fecha;
        public $primer_reinspec_cal;
        public $segunda_reinspec_fecha;
        public $segunda_reinspec_cal;
        public $id_estab;

        public function __construct(){

            $this->db = new Sql;
        }

        //Asignado valores del formulario a cada propiedad si esta existe
        public function set_datos($datos){
            
            foreach ($datos as $nombre_campo => $valor_campo) {
                
                if (property_exists('ModeloInspecciones', $nombre_campo)) {
                    
                    $this->$nombre_campo = $valor_campo;
                }
            }
            return $this;
        }

        //DONDE SE CREARAN LAS CONSULTAS
        
        //****************************************************************************************************************************** */
        //1-creando archivo index donde llevara la vista mostrando la tabla de inspecciones
        public function obtenerInspeccion(){

            $this->db->query("SELECT *                   
                            FROM tblinspecciones  
                            INNER JOIN tblestablecimientos 
                            ON tblinspecciones.id_estab = tblestablecimientos.id_estab
                            WHERE estado_estab = 'Activo'                            
                            ");

            return $this->db->registers();
        }

        //Haciendo las busquedas por el numero de registro
        public function numeroRegistros($busqueda = null, $estadoEstab = "Activo"){

            if ($busqueda != null && strpos($busqueda, ' ')) {

                $busquedaNombre = explode(' ', $busqueda);
                // agregando los %% a cada elemento del arreglo
				for($i = 0; $i < count($busquedaNombre); $i++){
					$busquedaNombre[$i] = '%'.$busquedaNombre[$i].'%';
				}
		        // convirtiendo el arreglo a str
                $busqueda = implode($busquedaNombre);

                $this->db->query(
                    "SELECT 
                            id_inspec,
                            inspec_para,
                            IFNULL(DATE_FORMAT(fecha_inspec, '%d/%m/%Y'), 'sin fecha') as fecha_inspec,
                            objeto_visita,
                            nombre_inspector,
                            cal_primer_inspec,
                            primer_reinspec_fecha,
                            primer_reinspec_cal,
                            segunda_reinspec_fecha,
                            segunda_reinspec_cal,
                            tblestablecimientos.nombre_estab,
                            tblestablecimientos.tipo_estab,
                            tblestablecimientos.id_estab
                            FROM tblinspecciones  
                            INNER JOIN tblestablecimientos 
                            ON tblinspecciones.id_estab = tblestablecimientos.id_estab 
                            WHERE(
                            LOWER(inspec_para) LIKE '%$busqueda%' OR
                            LOWER(objeto_visita) LIKE '%$busqueda%' OR
                            LOWER(nombre_inspector) LIKE '%$busqueda%' OR
                            LOWER(tipo_estab) LIKE '%$busqueda%' OR
                            LOWER(nombre_estab) LIKE '%$busqueda%'
                            )
                            AND estado_estab = '$estadoEstab'
                    ");
                return $this->db->rowCount();
                
            }elseif ($busqueda != '' && !strpos($busqueda, ' ')) {

                $this->db->query(
                    "SELECT id_inspec,
                    inspec_para,
                    IFNULL(DATE_FORMAT(fecha_inspec, '%d/%m/%Y'), 'sin fecha') as fecha_inspec,
                    objeto_visita,
                    nombre_inspector,
                    cal_primer_inspec,
                    primer_reinspec_fecha,
                    primer_reinspec_cal,
                    segunda_reinspec_fecha,
                    segunda_reinspec_cal,
                    tblestablecimientos.nombre_estab,
                    tblestablecimientos.tipo_estab,
                    tblestablecimientos.id_estab 
                    FROM tblinspecciones  
                    INNER JOIN tblestablecimientos 
                     ON tblinspecciones.id_estab = tblestablecimientos.id_estab 
                     WHERE(
                         LOWER(inspec_para) LIKE '%$busqueda%' OR
                         LOWER(objeto_visita) LIKE '%$busqueda%' OR
                         LOWER(nombre_inspector) LIKE '%$busqueda%' OR
                         LOWER(tipo_estab) LIKE '%$busqueda%' OR
                         LOWER(nombre_estab) LIKE '%$busqueda%'
                        )
                        AND estado_estab = '$estadoEstab'
                    "
                    );
                    // echo "nooo";
                return $this->db->rowCount();

            }else{

                $this->db->query("SELECT id_inspec,
                inspec_para,
                IFNULL(DATE_FORMAT(fecha_inspec, '%d/%m/%Y'), 'sin fecha') as fecha_inspec,
                objeto_visita,
                nombre_inspector,
                cal_primer_inspec,
                primer_reinspec_fecha,
                primer_reinspec_cal,
                segunda_reinspec_fecha,
                segunda_reinspec_cal,
                tblestablecimientos.nombre_estab,
                tblestablecimientos.tipo_estab,
                tblestablecimientos.id_estab 
                FROM tblinspecciones  
                            INNER JOIN tblestablecimientos 
                            ON tblinspecciones.id_estab = tblestablecimientos.id_estab
                            WHERE estado_estab = '$estadoEstab'
                        ");
                return $this->db->rowCount();
            }
        }

        //para la tabla inspecciones limite
        public function inspeccionesPorLimite($pos_pagina, $desde, $busqueda = null, $estadoEstab = "Activo"){
            if ($busqueda != null && strpos($busqueda, ' ')) {

                $busquedaNombre = explode(' ', $busqueda);
                // agregando los %% a cada elemento del arreglo
				for($i = 0; $i < count($busquedaNombre); $i++){
					$busquedaNombre[$i] = '%'.$busquedaNombre[$i].'%';
				}
		        // convirtiendo el arreglo a str
                $busqueda = implode($busquedaNombre);
                
                $this->db->query(
                    "SELECT id_inspec,
                    inspec_para,
                    IFNULL(DATE_FORMAT(fecha_inspec, '%d/%m/%Y'), 'sin fecha') as fecha_inspec,
                    objeto_visita,
                    nombre_inspector,
                    cal_primer_inspec,
                    primer_reinspec_fecha,
                    primer_reinspec_cal,
                    segunda_reinspec_fecha,
                    segunda_reinspec_cal,
                    tblestablecimientos.nombre_estab,
                    tblestablecimientos.tipo_estab,
                    tblestablecimientos.id_estab 
                    FROM tblinspecciones  
                            INNER JOIN tblestablecimientos 
                             ON tblinspecciones.id_estab = tblestablecimientos.id_estab 
                             WHERE(
                                LOWER(inspec_para) LIKE '%$busqueda%' OR
                                LOWER(objeto_visita) LIKE '%$busqueda%' OR
                                LOWER(nombre_inspector) LIKE '%$busqueda%' OR
                                LOWER(tipo_estab) LIKE '%$busqueda%' OR
                                LOWER(nombre_estab) LIKE '%$busqueda%'
                            )
                            AND estado_estab = '$estadoEstab'
                             LIMIT $desde, $pos_pagina
                            -- ORDER BY nombreusuario DESC
                    ");
                return $this->db->registers();
                
            }elseif ($busqueda != '' && !strpos($busqueda, ' ')) {
            
                $this->db->query(
                    "SELECT id_inspec,
                    inspec_para,
                    IFNULL(DATE_FORMAT(fecha_inspec, '%d/%m/%Y'), 'sin fecha') as fecha_inspec,
                    objeto_visita,
                    nombre_inspector,
                    cal_primer_inspec,
                    primer_reinspec_fecha,
                    primer_reinspec_cal,
                    segunda_reinspec_fecha,
                    segunda_reinspec_cal,
                    tblestablecimientos.nombre_estab,
                    tblestablecimientos.tipo_estab,
                    tblestablecimientos.id_estab  
                    FROM tblinspecciones  
                    INNER JOIN tblestablecimientos 
                     ON tblinspecciones.id_estab = tblestablecimientos.id_estab 
                     WHERE(                       
                        LOWER(inspec_para) LIKE '%$busqueda%' OR
                        LOWER(objeto_visita) LIKE '%$busqueda%' OR
                        LOWER(nombre_inspector) LIKE '%$busqueda%' OR
                        LOWER(tipo_estab) LIKE '%$busqueda%' OR
                        LOWER(nombre_estab) LIKE '%$busqueda%'
                        )
                        AND estado_estab = '$estadoEstab'
                        LIMIT $desde, $pos_pagina
                        -- ORDER BY nombreusuario DESC
                        ");
 
                    return $this->db->registers();
            }else{

                $this->db->query(
                    "SELECT id_inspec,
                    inspec_para,
                    IFNULL(DATE_FORMAT(fecha_inspec, '%d/%m/%Y'), 'sin fecha') as fecha_inspec,
                    objeto_visita,
                    nombre_inspector,
                    cal_primer_inspec,
                    primer_reinspec_fecha,
                    primer_reinspec_cal,
                    segunda_reinspec_fecha,
                    segunda_reinspec_cal,
                    tblestablecimientos.nombre_estab,
                    tblestablecimientos.tipo_estab,
                    tblestablecimientos.id_estab
                    FROM tblinspecciones  
                    INNER JOIN tblestablecimientos 
                    ON tblinspecciones.id_estab = tblestablecimientos.id_estab 
                    WHERE estado_estab = '$estadoEstab'
                    LIMIT $desde, $pos_pagina
                ");
                    
                return $this->db->registers();
            }
        }

        //************************************************************************************************************************************ */        
        //2-para las opciones de la tabla ver inspeccion
        public function obtenerInspeccion1($id){
            $this->db->query("SET lc_time_names = 'es_ES'");
            $this->db->execute();

            $this->db->query("SELECT * 
                            FROM tblinspecciones
                            INNER JOIN tblestablecimientos 
                            ON tblinspecciones.id_estab = tblestablecimientos.id_estab
                            WHERE id_inspec = :id
                            ");
                            $this->db->bind(':id', $id);
                            return $this->db->register();
        }

        //*********************************************************************************************************************** */
        //3-Mostrando opcion editar de la tabla inspecciones 
        public function actualizarInspeccion($id, $inspeccion, $idestablecimiento){
            $this->db->query(
                "UPDATE  tblinspecciones
                SET inspec_para = :inspec_para,
			        fecha_inspec = :fecha_inspec,
                    objeto_visita = :objeto_visita,
                    nombre_inspector = :nombre_inspector,
                    cal_primer_inspec = :cal_primer_inspec,
                    primer_reinspec_fecha = :primer_reinspec_fecha,
		            primer_reinspec_cal = :primer_reinspec_cal,
			        segunda_reinspec_fecha = :segunda_reinspec_fecha,
			        segunda_reinspec_cal = :segunda_reinspec_cal,
                    id_estab = :id_estab
                    WHERE id_inspec = :id");
           
            $this->db->bind(':inspec_para', $inspeccion['inspeccionPara'] );
            $this->db->bind(':fecha_inspec', $inspeccion['fechaInspeccion']['text'] );
            $this->db->bind(':objeto_visita', $inspeccion['objetoVisita'] );
            $this->db->bind(':nombre_inspector', $inspeccion['nombreInspector']['text'] );
            $this->db->bind(':cal_primer_inspec', $inspeccion['notaPinspeccion']['text'] );
            $this->db->bind(':primer_reinspec_fecha', $inspeccion['pReinspecfecha']['text'] );
            $this->db->bind(':primer_reinspec_cal', $inspeccion['pReinspecnota']['text'] );
            $this->db->bind(':segunda_reinspec_fecha', $inspeccion['sReinspecfecha']['text'] );
            $this->db->bind(':segunda_reinspec_cal', $inspeccion['sReinspecnota']['text'] );
            $this->db->bind(':id_estab', $idestablecimiento);     
            $this->db->bind(':id', $id);

            if ($this->db->execute()) {
                
                return TRUE;
            } else {
                return FALSE;
            }
            
        }
 
        //************************************************************************************************************************************ */
        //4-Mostrando la tabla de establecimiento de la inspeccion establecimiento
        public function inspeccionEstablecimientos(){

            $this->db->query("SELECT * FROM tblestablecimientos");

            return $this->db->registers();
        }

        //obtener el numero de registros para la tabla establecimientos de la inspeccion establecimiento
        public function numeroRegistrosE($busqueda = null){
            if ($busqueda != null && strpos($busqueda, ' ')) {
                 
                $busquedaNombre = explode(' ', $busqueda);
                // agregando los %% a cada elemento del arreglo
				for($i = 0; $i < count($busquedaNombre); $i++){
					$busquedaNombre[$i] = '%'.$busquedaNombre[$i].'%';
				}
		        // convirtiendo el arreglo a str
                $busqueda = implode($busquedaNombre);

                $this->db->query(
                    "SELECT *  FROM tblestablecimientos
                        WHERE(LOWER(CONCAT(nombre_prop,' ',apellido_prop)) LIKE '$busqueda' OR
                            LOWER(CONCAT(apellido_prop,' ',nombre_prop)) LIKE '$busqueda' OR
                            LOWER(CONCAT(nombre_estab)) LIKE '$busqueda' OR
                            LOWER(direccion_estab) LIKE '$busqueda' OR
                            LOWER(tipo_estab) LIKE '$busqueda'

                        )
                        AND NOT EXISTS
                        (SELECT * FROM tblinspecciones 
                        WHERE tblinspecciones.id_estab = tblestablecimientos.id_estab) 
                    ");
                return $this->db->rowCount();
                
            }elseif ($busqueda != '' && !strpos($busqueda, ' ')) {
                
                $this->db->query("SELECT *  FROM tblestablecimientos 
                    WHERE(
                        LOWER(nombre_estab) LIKE '%$busqueda%' OR
                        LOWER(nombre_prop) LIKE '$busqueda' OR
                        LOWER(apellido_prop) LIKE '$busqueda' OR
                        LOWER(direccion_estab) LIKE '$busqueda' OR
                        LOWER(tipo_estab) LIKE '$busqueda'
                    ) 
                    AND NOT EXISTS
                    (SELECT * FROM tblinspecciones 
                    WHERE tblinspecciones.id_estab = tblestablecimientos.id_estab)                     
                ");
                return $this->db->rowCount();

            }else{
                
                $this->db->query("SELECT * FROM tblestablecimientos 
                WHERE NOT EXISTS  
                (SELECT * FROM tblinspecciones 
                WHERE tblinspecciones.id_estab = tblestablecimientos.id_estab) 
                ");
                return $this->db->rowCount();
            }
        }
        
        //para la tabla establecimientos de la inspeccion establecimiento
        public function establecimientosPorLimite($pos_pagina, $desde, $busqueda = null){
            if ($busqueda != null && strpos($busqueda, ' ')) {

                $busquedaNombre = explode(' ', $busqueda);
                // agregando los %% a cada elemento del arreglo
				for($i = 0; $i < count($busquedaNombre); $i++){
					$busquedaNombre[$i] = '%'.$busquedaNombre[$i].'%';
				}
		        // convirtiendo el arreglo a str
                $busqueda = implode($busquedaNombre);
                
                $this->db->query(
                    "SELECT *  FROM tblestablecimientos
                        WHERE(LOWER(CONCAT(nombre_prop,' ',apellido_prop)) LIKE '$busqueda' OR
                            LOWER(CONCAT(apellido_prop,' ',nombre_prop)) LIKE '$busqueda' OR
                            LOWER(CONCAT(nombre_estab)) LIKE '$busqueda' OR
                            LOWER(direccion_estab) LIKE '$busqueda' OR
                            LOWER(tipo_estab) LIKE '$busqueda'
                        )
                        AND NOT EXISTS
                        (SELECT * FROM tblinspecciones 
                        WHERE tblinspecciones.id_estab = tblestablecimientos.id_estab)
                        LIMIT $desde, $pos_pagina
                            -- ORDER BY nombreusuario DESC
                    ");
                return $this->db->registers();
                
            }elseif ($busqueda != '' && !strpos($busqueda, ' ')) {
                // echo $busqueda;
                $this->db->query(
                    "SELECT *  FROM tblestablecimientos                    
                     WHERE(
                         LOWER(nombre_estab) LIKE '%$busqueda%' OR
                         LOWER(nombre_prop) LIKE '%$busqueda%' OR
                         LOWER(apellido_prop) LIKE '%$busqueda%' OR
                         LOWER(direccion_estab) LIKE '$busqueda' OR
                         LOWER(tipo_estab) LIKE '$busqueda'
                        )
                    AND NOT EXISTS
                        (SELECT * FROM tblinspecciones 
                        WHERE tblinspecciones.id_estab = tblestablecimientos.id_estab)
                    LIMIT $desde, $pos_pagina
                        -- ORDER BY nombreusuario DESC
                        ");
 
                    return $this->db->registers();
            }else{

                $this->db->query("SELECT * FROM tblestablecimientos 
                WHERE NOT EXISTS  
                (SELECT * FROM tblinspecciones 
                WHERE tblinspecciones.id_estab = tblestablecimientos.id_estab) 
                LIMIT $desde, $pos_pagina ");

                // $this->db->query("SELECT *  FROM tblestablecimientos LIMIT $desde, $pos_pagina ");
                    
                return $this->db->registers();
            }

        }
        //************************************************************************************************************************************ */
        //5-Agregando formulario de nueva inspeccion 

        //para obtener el establecimiento
        public function obtenerEstablecimiento1($id){
            $this->db->query("SET lc_time_names = 'es_ES'");
            $this->db->execute();

            $this->db->query("SELECT *  
                            FROM tblestablecimientos
                            WHERE id_estab = :id
                            ");
                            $this->db->bind(':id', $id);
                            return $this->db->register();
        }
        //agregar inspecciones
        public function nuevaInspeccion($inspeccion, $idestablecimiento){
            
            $this->db->query(

                'INSERT INTO tblinspecciones(inspec_para, fecha_inspec, objeto_visita, 
                            nombre_inspector, cal_primer_inspec, primer_reinspec_fecha, 
                            primer_reinspec_cal, segunda_reinspec_fecha, segunda_reinspec_cal, id_estab) 
                VALUES (:inspec_para, :fecha_inspec, :objeto_visita, 
                        :nombre_inspector, :cal_primer_inspec, :primer_reinspec_fecha, 
                        :primer_reinspec_cal, :segunda_reinspec_fecha, :segunda_reinspec_cal, :id_estab)');

                $this->db->bind(':inspec_para', $inspeccion['inspeccionPara'] );
                $this->db->bind(':fecha_inspec', $inspeccion['fechaInspeccion']['text'] );
                $this->db->bind(':objeto_visita', $inspeccion['objetoVisita'] );
                $this->db->bind(':nombre_inspector', $inspeccion['nombreInspector']['text'] );
                $this->db->bind(':cal_primer_inspec', $inspeccion['notaPinspeccion']['text'] );
                $this->db->bind(':primer_reinspec_fecha', $inspeccion['pReinspecfecha']['text'] );
                $this->db->bind(':primer_reinspec_cal', $inspeccion['pReinspecnota']['text'] );
                $this->db->bind(':segunda_reinspec_fecha', $inspeccion['sReinspecfecha']['text'] );
                $this->db->bind(':segunda_reinspec_cal', $inspeccion['sReinspecnota']['text'] );
                $this->db->bind(':id_estab', $idestablecimiento);

                if ($this->db->execute()) {

                    return TRUE;
                } else {
                    return FALSE;
                }  
        } 

        public function actualizarEstablecimiento($establecimiento, $estado){
         
            $this->db->query(
                "UPDATE  tblestablecimientos
                SET nombre_estab = :nombre_estab,
                    dui_prop = :dui_prop,
                    nombre_prop = :nombre_prop,
                    apellido_prop = :apellido_prop,
                    direccion_estab = :direccion_estab,
                    cat_estab = :cat_estab,
		            tipo_estab = :tipo_estab,
			        apartado_especifico = :apartado_especifico,
			        telefono_estab = :telefono_estab,
                    municipio_estab = :municipio_estab,
                    departamento_estab = :departamento_estab,
                    estado_estab = '$estado'
                    WHERE id_estab = :id_estab");
           
            $this->db->bind(':nombre_estab', $establecimiento->nombre_estab);
            $this->db->bind(':dui_prop', $establecimiento->dui_prop);
            $this->db->bind(':nombre_prop', $establecimiento->nombre_prop);
            $this->db->bind(':apellido_prop', $establecimiento->apellido_prop);
            $this->db->bind(':direccion_estab', $establecimiento->direccion_estab);
            $this->db->bind(':cat_estab', $establecimiento->cat_estab);
            $this->db->bind(':tipo_estab', $establecimiento->tipo_estab);
            $this->db->bind(':apartado_especifico', $establecimiento->apartado_especifico);
            $this->db->bind(':telefono_estab', $establecimiento->telefono_estab);
            $this->db->bind(':municipio_estab', $establecimiento->municipio_estab);
            $this->db->bind(':departamento_estab', $establecimiento->departamento_estab);                        
            $this->db->bind(':id_estab', $establecimiento->id_estab);

            if ($this->db->execute()) {
                
                return TRUE;

            } else {

                return FALSE;

            }

        }  

        //6-Agregando las busquedas a la barra de superior para buscar
      

} 

?>