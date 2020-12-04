<?php

    class EstablecimientosModel{
        
        private $db;

        public function __construct(){

            $this->db = new Sql;
        }        

        //obteniendo lista de manipuladores de acuerdo al establecimiento que pertenecen
        public function getManipuladores($idEstablecimiento){

            $this->db->query("SELECT * FROM tblmanipuladores WHERE id_estab  = '$idEstablecimiento' AND estado_manip = 'Activo'");
            
            $total = $this->db->rowCount();

            $this->db->query("SELECT * FROM tblmanipuladores WHERE id_estab  = '$idEstablecimiento' AND genero_manip = 'Hombre' AND estado_manip = 'Activo'");
            
            $hombres = $this->db->rowCount();

            $this->db->query("SELECT * FROM tblmanipuladores WHERE id_estab  = '$idEstablecimiento' AND genero_manip = 'Mujer' AND estado_manip = 'Activo'");

            $mujeres = $this->db->rowCount();

            return array(

                'hombres' => $hombres,
                'mujeres' => $mujeres,
                'total' => $total
            );                 

        }
        public function getEstablecimientos($tipo){

            $this->db->query("SELECT id_estab FROM tblestablecimientos WHERE apartado_especifico = '$tipo' AND estado_estab = 'Activo'");
            
            return $this->db->rowCount();
        }

        public function AllEstablecimientosLimit($desde, $pos_pagina, $tipo){

            $this->db->query("SELECT * FROM tblestablecimientos WHERE apartado_especifico = '$tipo' AND estado_estab = 'Activo' LIMIT $desde, $pos_pagina");
            
            $rows  = $this->db->registers();
            
            return $rows;

        }

        public function searchEstablecimientos($tipo, $busqueda){
            
            $this->db->query("SELECT * FROM tblestablecimientos WHERE(UPPER(nombre_estab) LIKE UPPER('%$busqueda%') OR
                                                                      UPPER(nombre_estab) LIKE UPPER('$busqueda'))
                                                                      AND apartado_especifico = '$tipo'
                                                                      AND estado_estab = 'Activo'");
            $registers  = $this->db->registers();
            $rows = $this->db->rowCount();
            return [$rows, $registers];
        }

        public function desacEstab($estab){

            
            $this->db->query(
                "UPDATE tblestablecimientos 
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
                    estado_estab = 'Inactivo' 
                    WHERE id_estab = :id_estab");
            
            $this->db->bind(':nombre_estab', $estab->nombre_estab);
            $this->db->bind(':dui_prop', $estab->dui_prop);
            $this->db->bind(':nombre_prop', $estab->nombre_prop);
            $this->db->bind(':apellido_prop', $estab->apellido_prop);
            $this->db->bind(':direccion_estab', $estab->direccion_estab);
            $this->db->bind(':cat_estab', $estab->cat_estab);
            $this->db->bind(':tipo_estab', $estab->tipo_estab);
            $this->db->bind(':apartado_especifico', $estab->apartado_especifico);
            $this->db->bind(':telefono_estab', $estab->telefono_estab);
            $this->db->bind(':municipio_estab', $estab->municipio_estab);
            $this->db->bind(':departamento_estab', $estab->departamento_estab);
            $this->db->bind(':id_estab', $estab->id_estab);

            if ($this->db->execute()) {
                
                return TRUE;
            } else {
                return FALSE;
            }

        }

        //Actualizar registro de la tabla inspecciones
        public function updateInspecEstablecimiento($inspeccion){
             
            $this->db->query(
                "UPDATE tblinspecciones 
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
                WHERE id_inspec = :id_inspec");
            
            $this->db->bind(':inspec_para', $inspeccion->inspecPara);
            $this->db->bind(':fecha_inspec', $inspeccion->fechaInspec);
            $this->db->bind(':objeto_visita', $inspeccion->objetoVisita);
            $this->db->bind(':nombre_inspector', $inspeccion->nombreInspector);
            $this->db->bind(':cal_primer_inspec', $inspeccion->calPrimerInspec);
            $this->db->bind(':primer_reinspec_fecha', $inspeccion->primerReinspecFecha);
            $this->db->bind(':primer_reinspec_cal', $inspeccion->primerReinspecCal);
            $this->db->bind(':segunda_reinspec_fecha', $inspeccion->segundaReinspecFecha);
            $this->db->bind(':segunda_reinspec_cal', $inspeccion->segundaReinspecCal);
            $this->db->bind(':id_estab', $inspeccion->idEsta);
            $this->db->bind(':id_inspec', $inspeccion->idInspec);

            if ($this->db->execute()) {
                
                return TRUE;
            } else {
                return FALSE;
            }
            
        }
        
        //calculando la puntuacion en la primera inspeccion
        public function puntuacionesInspec($id){

            $this->db->query("SELECT * 
                              FROM tblinspecciones 
                              WHERE id_estab = $id");
            return $this->db->register();
        }

        //obtener establecimiento
        public function obtenerEstab($id){

            $this->db->query("SELECT * 
                              FROM tblestablecimientos 
                              WHERE id_estab = $id");
            return $this->db->register();

        }

        //guardando la Primera inspeccion
        public function primeraInspec($nuevo, $anterior){
        
            $this->db->query(
                "UPDATE tblinspecciones 
                 SET inspec_para = :inspec_para,
                     fecha_inspec = now(),
                     objeto_visita = :objeto_visita,
                     nombre_inspector = :nombre_inspector,
                     cal_primer_inspec = :cal_primer_inspec,
                     primer_reinspec_fecha = null,
                     primer_reinspec_cal = null,
                     segunda_reinspec_fecha = null,
                     segunda_reinspec_cal = null,
                     id_estab = :id_estab
                WHERE id_inspec = :id_inspec");

                $this->db->bind(':inspec_para', $nuevo['inspecPara']);
                $this->db->bind(':objeto_visita', $nuevo['objetoVisita']);
                $this->db->bind(':nombre_inspector', $nuevo['nombreInspector']);
                $this->db->bind(':cal_primer_inspec', $nuevo['calPrimerInspec']);
        
                $this->db->bind(':id_estab', $anterior->id_estab);
                $this->db->bind(':id_inspec', $anterior->id_inspec);

                if ($this->db->execute()) {
                    return TRUE;
                } else {
                    return FALSE;
                }
        }

        //guardando la segunda inspeccion
        public function segundaInspec($nuevo, $anterior){

            $this->db->query(
                "UPDATE tblinspecciones 
                 SET inspec_para = :inspec_para,
                     fecha_inspec = :fecha_inspec,
                     objeto_visita = :objeto_visita,
                     nombre_inspector = :nombre_inspector,
                     cal_primer_inspec = :cal_primer_inspec,
                     primer_reinspec_fecha = now(),
                     primer_reinspec_cal = :primer_reinspec_cal,
                    --  segunda_reinspec_fecha = :segunda_reinspec_fecha,
                    --  segunda_reinspec_cal = :segunda_reinspec_cal,
                     id_estab = :id_estab
                WHERE id_inspec = :id_inspec");

                $this->db->bind(':inspec_para', $nuevo['inspecPara']);
                $this->db->bind(':fecha_inspec', $anterior->fecha_inspec );
                $this->db->bind(':objeto_visita', $nuevo['objetoVisita']);
                $this->db->bind(':nombre_inspector', $nuevo['nombreInspector']);
                $this->db->bind(':cal_primer_inspec', $anterior->cal_primer_inspec);
                // $this->db->bind(':primer_reinspec_fecha', $inspeccion->primerReinspecFecha);
                $this->db->bind(':primer_reinspec_cal', $nuevo['calPrimerInspec']);
                // $this->db->bind(':segunda_reinspec_fecha', $inspeccion->segundaReinspecFecha);
                // $this->db->bind(':segunda_reinspec_cal', $inspeccion->segundaReinspecCal);
                $this->db->bind(':id_estab', $anterior->id_estab);
                $this->db->bind(':id_inspec', $anterior->id_inspec);

                if ($this->db->execute()) {
                    return TRUE;
                } else {
                    return FALSE;
                }
        }

                //guardando la tercera inspeccion
                public function TerceraInspec($nuevo, $anterior){
                    // print_r($nuevo);
                    // print_r($anterior);

                    $this->db->query(
                        "UPDATE tblinspecciones 
                         SET inspec_para = :inspec_para,
                             fecha_inspec = :fecha_inspec,
                             objeto_visita = :objeto_visita,
                             nombre_inspector = :nombre_inspector,
                             cal_primer_inspec = :cal_primer_inspec,
                             primer_reinspec_fecha = :primer_reinspec_fecha,
                             primer_reinspec_cal = :primer_reinspec_cal,
                             segunda_reinspec_fecha = now(),
                             segunda_reinspec_cal = :segunda_reinspec_cal,
                             id_estab = :id_estab
                        WHERE id_inspec = :id_inspec");
        
                        $this->db->bind(':inspec_para', $nuevo['inspecPara']);
                        $this->db->bind(':fecha_inspec', $anterior->fecha_inspec );
                        $this->db->bind(':objeto_visita', $nuevo['objetoVisita']);
                        $this->db->bind(':nombre_inspector', $nuevo['nombreInspector']);
                        $this->db->bind(':cal_primer_inspec', $anterior->cal_primer_inspec);
                        $this->db->bind(':primer_reinspec_fecha', $anterior->primer_reinspec_fecha);
                        $this->db->bind(':primer_reinspec_cal', $anterior->primer_reinspec_cal);
                        
                        $this->db->bind(':segunda_reinspec_cal', $nuevo['calPrimerInspec']);
                        $this->db->bind(':id_estab', $anterior->id_estab);
                        $this->db->bind(':id_inspec', $anterior->id_inspec);
        
                        if ($this->db->execute()) {
                            return TRUE;
                        } else {
                            return FALSE;
                        }
                }

        //Creando un nuevo registro de inspeccion
        public function InsertNuevaInspec($inspeccion){

            $this->db->query("INSERT INTO 
                            tblinspecciones(
                                            inspec_para, fecha_inspec,
                                            objeto_visita, nombre_inspector, cal_primer_inspec, 
                                            -- primer_reinspec_fecha, 
                                            -- primer_reinspec_cal, segunda_reinspec_fecha,
                                            -- segunda_reinspec_cal, 
                                            id_estab) 
                                    VALUES (
                                        :inspec_para,
                                        now(),
                                        :objeto_visita,
                                        :nombre_inspector,
                                        :cal_primer_inspec,
                                        -- :primer_reinspec_fecha,
                                        -- :primer_reinspec_cal,
                                        -- :segunda_reinspec_fecha,
                                        -- :segunda_reinspec_cal,
                                        :id_estab
                                        )");

            $this->db->bind(':inspec_para', $_POST['inspecPara']);
            $this->db->bind(':objeto_visita', $_POST['objetoVisita']);
            $this->db->bind(':nombre_inspector', $_POST['nombreInspector']);
            $this->db->bind(':cal_primer_inspec', $_POST['calPrimerInspec']);
            // $this->db->bind(':primer_reinspec_fecha', $_POST['primerReinspecFecha']);
            // $this->db->bind(':primer_reinspec_cal', $_POST['primerReinspecCal']);
            // $this->db->bind(':segunda_reinspec_fecha', $_POST['segundaReinspecFecha']);
            // $this->db->bind(':segunda_reinspec_cal', $_POST['segundaReinspecCal']);
            $this->db->bind(':id_estab', $_POST['idEstab']);
                                                  
            if ($this->db->execute()) {
                return TRUE;
            } else {
                return FALSE;
            }
        }
     //obteniendo el establecimiento
     public function getEstablecimiento($id){

        $this->db->query(
            "SELECT * FROM tblestablecimientos WHERE id_estab = $id AND  estado_estab = 'Activo'");
        
        return $this->db->registers();    
    }                     
    // public function getEstablecimientoNum($id){

    //     $this->db->query(
    //         "SELECT * FROM tblestablecimientos WHERE id_estab = $id AND  estado_estab = 'Activo'");
        
    //     if ($this->db->rowCount() > 0) {
            
    //         return TRUE;
    //     }else {
    //         return FALSE;
    //     }
    // }
    
    // public function getEstablecimiento($id){

    //     $this->db->query(
    //         "SELECT * FROM tblestablecimientos 
    //         WHERE id_estab = '$id' AND  estado_estab = 'Activo'");
        
    //     return $this->db->rowCount();
    // }
    
    public function getInspecciones($id){

        $this->db->query(
            "SELECT id_inspec,
                inspec_para,
                fecha_inspec,
                objeto_visita,
                nombre_inspector,
                cal_primer_inspec,
                primer_reinspec_fecha,
                primer_reinspec_cal,
                segunda_reinspec_fecha,
                segunda_reinspec_cal,
                id_estab
            FROM tblinspecciones 
            WHERE id_estab = '$id'");
        
        return $this->db->registers();
    }

    
    public function getfechaActual(){

        $this->db->query(
            "SELECT NOW() AS hoy");
        
        return $this->db->register();
    }

    public function saveInspeccion($inspecPara, $fechaInspec, $objetoVisita, $nombreInspector, 
                                  $calPrimerInspec, $primerReinspecFecha, $primerReinspecCal,
                                  $segundaReinspecFecha, $segundaReinspecCal, $idEstab){

        $this->db->query(
            "INSERT INTO 
            tblinspecciones(
                inspec_para, 
                fecha_inspec,
                objeto_visita, 
                nombre_inspector, 
                cal_primer_inspec,
                primer_reinspec_fecha,
                primer_reinspec_cal,
                segunda_reinspec_fecha,
                segunda_reinspec_cal,                                        
                id_estab    
            ) 
            VALUES (
                :inspec_para, 
                :fecha_inspec,
                :objeto_visita, 
                :nombre_inspector, 
                :cal_primer_inspec,
                :primer_reinspec_fecha,
                :primer_reinspec_cal,
                :segunda_reinspec_fecha,
                :segunda_reinspec_cal,                                        
                :id_estab  
            )");

        $this->db->bind(':inspec_para', $inspecPara);
        $this->db->bind(':fecha_inspec', $fechaInspec);
        $this->db->bind(':objeto_visita', $objetoVisita);
        $this->db->bind(':nombre_inspector', $nombreInspector);
        $this->db->bind(':cal_primer_inspec', $calPrimerInspec);
        $this->db->bind(':primer_reinspec_fecha', $primerReinspecFecha);
        $this->db->bind(':primer_reinspec_cal', $primerReinspecCal);
        $this->db->bind(':segunda_reinspec_fecha', $segundaReinspecFecha);
        $this->db->bind(':segunda_reinspec_cal', $segundaReinspecCal);
        $this->db->bind(':id_estab', $idEstab);
                                              
        if ($this->db->execute()) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function updateInspeccion($idInspec, $inspecPara, $fechaInspec, $objetoVisita, $nombreInspector, 
                                  $calPrimerInspec, $primerReinspecFecha, $primerReinspecCal,
                                  $segundaReinspecFecha, $segundaReinspecCal, $idEstab){

        $this->db->query(
            "UPDATE tblinspecciones 
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
           WHERE id_inspec = :id_inspec");

        $this->db->bind(':inspec_para', $inspecPara);
        $this->db->bind(':fecha_inspec', $fechaInspec);
        $this->db->bind(':objeto_visita', $objetoVisita);
        $this->db->bind(':nombre_inspector', $nombreInspector);
        $this->db->bind(':cal_primer_inspec', $calPrimerInspec);
        $this->db->bind(':primer_reinspec_fecha', $primerReinspecFecha);
        $this->db->bind(':primer_reinspec_cal', $primerReinspecCal);
        $this->db->bind(':segunda_reinspec_fecha', $segundaReinspecFecha);
        $this->db->bind(':segunda_reinspec_cal', $segundaReinspecCal);
        $this->db->bind(':id_estab', $idEstab);
        $this->db->bind(':id_inspec', $idInspec);
                                              
        if ($this->db->execute()) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    public function getInspecEstablecimientoNum($id){

        $this->db->query(
            "SELECT * FROM tblinspecciones 
            WHERE id_estab = '$id'");
        
        return $this->db->rowCount();
    }
    
    
}

?>