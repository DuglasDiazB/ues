<?php 
class ModeloLogin{
    private $db;

    public function __construct(){
        $this->db = new Sql;
    }

    public function login($user, $pass){
        
        $this->db->query('SELECT * FROM usuarios WHERE username= :user and password = :pass and estadousuario = 1');
        $this->db->bind(':user', $user);
        $this->db->bind(':pass', $pass);
        
        return $this->db->register();
    }

    
}


?>