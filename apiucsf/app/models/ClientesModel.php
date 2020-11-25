<?php

    class ClientesModel{
        
        private $db;
        public $id;
        public $nombre;
        public $apellido;
        public $edad;

        public function __construct(){

            $this->db = new Sql;
        }

        public function logs($server, $code = 200){

            $server['QUERY_STRING'] = substr($server['QUERY_STRING'], 4);

            $this->db->query(
                'INSERT INTO logs(uri, method, ip_adress, time, rtime, response_code) 
                 VALUES(:uri, :method, :ip_adress, :time, :rtime, :response_code)');
            
                $this->db->bind(':uri', $server['QUERY_STRING'] );
                $this->db->bind(':method', $server['REQUEST_METHOD']);
                $this->db->bind(':ip_adress', $server['REMOTE_ADDR'] );
                $this->db->bind(':time', (int)$server['REQUEST_TIME']);
                $this->db->bind(':rtime', (int)$server['REQUEST_TIME_FLOAT']);
                $this->db->bind(':response_code', $code );
                
                if ($this->db->execute()) {
                    return TRUE;
                } else {
                    return FALSE;
                }

        }

        //Guarda la informacion proporsionada por el usuario
        //en cada una de las propiedades de esta clase
        public function set_datos($data_cruda){
            // print_r($data_cruda);
            foreach ($data_cruda as $nombre_campo => $valor_campo) {
                
                if (property_exists('ClientesModel', $nombre_campo)) {
                    // echo $valor_campo;
                    $this->$nombre_campo = $valor_campo;
                }
            }

            // Estos son valores que no se envian pero que son necesarios
            // si un valor viene vacio le podemos asignar un valor por defecto

            // if ($this->activo == null) {
                
            //     $this->activo = 1
            // }


            return $this;
        }

        public function getCliente($id){
            $this->db->query("SELECT id, nombre, apellido, edad  FROM personas WHERE id = :id and status = 'activo'");
            $this->db->bind(':id', $id);

            $row  = $this->db->register();

            if ($row) {
                //transformando los valores a entero
                $row->id = (int)$row->id;
                $row->edad = (int)$row->edad;
            }

            return $row;
        }

        public function getUsersMaxValue(){

            $this->db->query('SELECT MAX(id) AS idmax FROM personas ');
            return $this->db->register();
        }

        public function saveCliente($cliente){

            
            $this->db->query(
                'INSERT INTO personas(nombre,apellido,edad) 
                 VALUES(:nombre, :apellido, :edad)');
            
                $this->db->bind(':nombre', $cliente->nombre );
                $this->db->bind(':apellido', $cliente->apellido);
                $this->db->bind(':edad', $cliente->edad );
                
                if ($this->db->execute()) {
                    return TRUE;
                } else {
                    return FALSE;
                }

        }

        public function getClienteRep($cliente){
            
            $this->db->query("SELECT * FROM personas WHERE edad = :edad");
            $this->db->bind(':edad', $cliente->edad);


            return $this->db->rowCount();
        }

        public function updateCliente($cliente){
             
            $this->db->query(
                "UPDATE personas 
                SET nombre = :nombre, 
                    apellido = :apellido,
                    edad = :edad,
                WHERE id = :id");
            
            $this->db->bind(':nombre', $cliente->nombre);
            $this->db->bind(':apellido', $cliente->apellido);
            $this->db->bind(':edad', $cliente->edad);
            $this->db->bind(':id', $cliente->id);

            if ($this->db->execute()) {
                
                return TRUE;
            } else {
                return FALSE;
            }
            
        }

        public function deleteCliente($cliente){
             
            $this->db->query(
                "UPDATE personas 
                SET nombre = :nombre, 
                    apellido = :apellido,
                    edad = :edad,
                    status = :status 
                WHERE id = :id");
            
            $this->db->bind(':nombre', $cliente->nombre);
            $this->db->bind(':apellido', $cliente->apellido);
            $this->db->bind(':edad', $cliente->edad);
            $this->db->bind(':status', 'borrado');
            $this->db->bind(':id', $cliente->id);

            if ($this->db->execute()) {
                
                return TRUE;
            } else {
                return FALSE;
            }
            
        }

        public function getRows(){

            $this->db->query("SELECT id FROM personas");
            return $this->db->rowCount();

        }

        public function AllClientesLimit($pos_pagina, $desde){

            $this->db->query("SELECT * FROM personas LIMIT $desde, $pos_pagina");
            
            $rows  = $this->db->registers();
            
            if ($rows) {

                //transformando los valores a entero
                    for ($i = 0; $i < count($rows) ; $i++) { 
                        
                        $rows[$i]->id = (int)$rows[$i]->id;
                        $rows[$i]->edad = (int)$rows[$i]->edad;
                    }
            }


            return $rows;

        }

    }
?>