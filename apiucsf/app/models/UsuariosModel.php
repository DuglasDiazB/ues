<?php

    class UsuariosModel{
        
        private $db;

        public function __construct(){

            $this->db = new Sql;
        }

        public function getUsers(){

            $this->db->query('SELECT * FROM personas');
            return $this->db->registers();
        }
        public function getUsersLimit(){

            $this->db->query('SELECT * FROM personas LIMIT 0,2');
            return $this->db->registers();
        }

        public function getUsersCount(){

            $this->db->query('SELECT * FROM personas ');
            return $this->db->rowCount();
        }

        public function getUsersMaxValue(){

            $this->db->query('SELECT MAX(id) AS idmax FROM personas ');
            return $this->db->register();
        }

        public function getUsersMinValue(){

            $this->db->query('SELECT MIN(id) AS idmin FROM personas ');
            return $this->db->register();
        }

        public function getUsersProm(){

            $this->db->query('SELECT AVG(id) AS promedio FROM personas ');
            return $this->db->register();
        }

        public function getUsersSum(){

            $this->db->query('SELECT SUM(id) AS suma FROM personas ');
            return $this->db->register();
        }

        public function getUser(){

            $this->db->query('SELECT * FROM personas WHERE id = 1');
            return $this->db->registers();
        }

        //DEVUELVE CUANTAS VECES SE REPITE UN VALOR EN UNA COLUMNA
        public function getUsersGroupByName(){
            $this->db->query(" SELECT nombre, count(*) As total FROM personas GROUP BY nombre");
            return $this->db->registers();

        }

        //devuelve solo los valores distintos 
        //es dicir devuelve un unico valor de la columna aunque se repita
        public function getUsersDistinctLimit(){
            $this->db->query(" SELECT DISTINCT nombre FROM personas ORDER BY nombre  DESC LIMIT 0, 5");
            return $this->db->registers();

        }

        public function getUsersDistinctAll(){
            $this->db->query(" SELECT DISTINCT nombre FROM personas ORDER BY nombre  DESC");
            return $this->db->rowCount();

        }

        public function addUser($user){

            $this->db->query(
                'INSERT INTO personas(nombre,apellido,edad) 
                 VALUES(:nombre, :apellido, :edad)');
            
                $this->db->bind(':nombre', $user['nombre'] );
                $this->db->bind(':apellido', $user['apellido']);
                $this->db->bind(':edad', $user['edad'] );
                
                if ($this->db->execute()) {
                    return TRUE;
                } else {
                    return FALSE;
                }
                
        }

        public function lastIdInsert(){
            $this->db->query('SELECT @@identity AS id');
            return $this->db->register();

        }

        public function updateUser($user, $id){
            $this->db->query(
                "UPDATE personas 
                SET nombre = :nombre,
                    apellido = :apellido,
                    edad = :edad
                    WHERE id = :id");
            $this->db->bind(':nombre', $user['nombre']);
            $this->db->bind(':apellido', $user['apellido']);
            $this->db->bind(':edad', $user['edad']);
            $this->db->bind(':id', $id);
            if ($this->db->execute()) {
                
                return TRUE;
            } else {
                return FALSE;
            }
            
        }

        public function delete($id){
            $this->db->query('DELETE FROM personas WHERE id = :id ');
            $this->db->bind(':id', $id);
            if ($this->db->execute()) {
                
                return TRUE;
            } else {
                return FALSE;
            }
        }

        


        
    }
?>