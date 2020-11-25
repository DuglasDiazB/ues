<?php

/*
    CREATE TABLE `logs` (
	`id` INT(11) NOT NULL AUTO_INCREMENT, //
    `uri` VARCHAR(255) NOT NULL,          // [REDIRECT_QUERY_STRING] => url
    `method` VARCHAR(6) NOT NULL,         //[REQUEST_METHOD]
    `params` TEXT DEFAULT NULL,
    `api_key` VARCHAR(40) NOT NULL,
    `ip_adress` VARCHAR(45) NOT NULL,     //[REMOTE_ADDR]
    `time` INT(11) NOT NULL,              //1590365166
    `rtime` FLOAT DEFAULT NULL,
    `authorized` VARCHAR(1) NOT NULL,
    `response_code` SMALLINT(3) DEFAULT '0', // http_response_code();
    PRIMARY KEY (`id`)
)ENGINE=INNODB DEFAULT CHARSET=utf8;

*/

class Clientes extends MainController
{
	
	function __construct()
	{
        $this->clientesModel = $this->model('ClientesModel');
        header("Access-Control-Allow-Origin: *");
        header('Content-Type: aplication/json');
        
	}
    
    //la rutina del delete es muy simila a delete
    //informacion de un cliente
	public function cliente_get($id = null){
        
        
        if ($id == null) {
            
            $respuesta = array(
                'error' => TRUE,
                'mensaje' => 'Es necesario el id del cliente',
                
            );
            
            http_response_code(405);
            
            $this->clientesModel->logs($_SERVER, http_response_code(405));
            echo json_encode($respuesta);
            return;
        }

        $cliente = $this->clientesModel->getCliente($id);
        
        if ($cliente) {

            //borrar un elemento de la tabla que no queremos que apareza
            //tambien se puede poner en el select de la consulta
            unset($cliente->edad);

            $respuesta = array(
                'error' => FALSE,
                'mensaje' => 'Registro cargado correctamente',
                'cliente' => $cliente
            );
            $this->clientesModel->logs($_SERVER);    
            echo json_encode($respuesta);
            return;
        }else{

            $respuesta = array(
                'error' => FALSE,
                'mensaje' => 'El registro con id: ' .$id. ', no existe',
                'cliente'=> null
            );
            
            http_response_code(404);
            $this->clientesModel->logs($_SERVER, http_response_code(404));
            echo json_encode($respuesta);
            return;

        }
        
    }

    //eliminar cliente
    public function cliente_delete($id = null){
        
        if ($id == null) {
            
            $respuesta = array(
                'error' => TRUE,
                'mensaje' => 'Es necesario el id del cliente',

            );
            
            http_response_code(405);
            echo json_encode($respuesta);
            return;
        }

        $cliente = $this->clientesModel->getCliente($id);
        
        if (!$cliente) {
            
            $respuesta = array(
                'error' => FALSE,
                'mensaje' => 'El registro con id: ' .$id. ', no existe',
                'cliente'=> null
            );
            
            http_response_code(404);
            echo json_encode($respuesta);
            return;

        }
        
        //borrar un elemento de la tabla
        $this->clientesModel->deleteCliente($cliente);

        $respuesta = array(
            'error' => FALSE,
            'mensaje' => 'El registro con id: ' .$id. ', fue removido',
            
        );
        
        echo json_encode($respuesta);

        
        
    }


    //paginacion
    public function paginar($pagina = 1, $pos_pagina = 5){
        
        // print_r($_SERVER['SERVER_ADDR']);
        //Total de registros
        $cuantos = $this->clientesModel->getRows();

        //devuelve un arreglo "totalPaginas": 4,
        // "pagina_actual"
        // "pagina_siguiente"
        // "pagina_anterior"
        // "desde" ====> que seria el limite de registro o hasta donde 
        //  traera los registros 
        $respuesta  = paginar_todo($cuantos , $pagina, $pos_pagina);

        $clientes = $this->clientesModel->AllClientesLimit($pos_pagina, $respuesta['desde']);

        //eliminando un campo de la respuesta
        unset($respuesta['desde']);
        $respuesta['clientes'] = $clientes;
        echo json_encode($respuesta);
    }

     //estas peticiones se puede hacer o solo con put o solo con post
    //actulizar o insertar

    //el PUT debe usarse para hacer insert
    public function cliente_put(){   

        //variable que contendra la respuesta PUT
        $_PUT = null;
        
            // Comprobando si se solicita un PUT
            if ( $_SERVER['REQUEST_METHOD'] == 'PUT') { 
                
               $respuesta = [];
                parse_str(file_get_contents('php://input'), $_PUT);
                
                if ($_PUT != []) {     // se envio algo    

                    $errores = [];

                    $errores['id'] = validaId(((isset($_PUT['id'])) ? $_PUT['id'] : null), 'id');
                                        
                    $errores['correo'] = validaCorreo(((isset($_PUT['correo'])) ? $_PUT['correo'] : null), 'correo');
         
                    $errores['nombre'] = validaStr(((isset($_PUT['nombre'])) ? $_PUT['nombre'] : null), 'nombre');
                    
                    $errores['edad'] = validaNumero(((isset($_PUT['edad'])) ? $_PUT['edad'] : null), 'edad');
                    
                    $errores['telefono'] = validatelefono(((isset($_PUT['telefono'])) ? $_PUT['telefono'] : null), 'telefono');
                    
                    $errores['dui'] = validaDui(((isset($_PUT['dui'])) ? $_PUT['dui'] : null), 'dui');

                    $errores['apellido'] = validaStr(((isset($_PUT['apellido'])) ? $_PUT['apellido'] : null), 'apellido');

                    if (http_response_code() == 404) {
                        
                        $respuesta = [

                            'error' => TRUE,
                            'mensaje' => 'Hay errores en el envio de informacion',
                            'errores' => [
                                'id' => $errores['id']['rid'],
                                'correo' => $errores['correo']['rcorreo'],
                                'nombre' => $errores['nombre']['rnombre'],
                                'edad' => $errores['edad']['redad'],
                                'telefono' => $errores['telefono']['rtelefono'],
                                'dui' => $errores['dui']['rdui'],
                                'apellido' => $errores['apellido']['rapellido'],

                            ],
                        ];
                        
                        echo json_encode($respuesta);
                        return;
                    }else {

                        
                        $data = $this->clientesModel->set_datos($_PUT);
                        //verificando si el redistro es repetido
                        $cliente_edad = $this->clientesModel->getClienteRep($data);
                        
                        $ultimo_registro = $this->clientesModel->getUsersMaxValue();
                        
                        if ($cliente_edad > 0) {

                            http_response_code(404);
                            $respuesta = [

                                'error' => TRUE,
                                'mensaje' => 'La edad ya existe en la base de datos',
                                'errores' => [
                                    
                                ],
                            ];
                            echo json_encode($respuesta);
                            return;

                        }
                        if(((int)$ultimo_registro->idmax) < ((int)$this->clientesModel->id)){

                            http_response_code(404);
                            $respuesta = [

                                'error' => TRUE,
                                'mensaje' => 'El id '.$this->clientesModel->id.' no existe',
                                'errores' => [
                                    
                                ],
                            ];
                            echo json_encode($respuesta);
                            return;

                        }

                        $cliente = $this->clientesModel->updateCliente($data);

                        if ($cliente) {

                            $respuesta = [

                                'error' => FALSE,
                                'mensaje' => 'Registro registrado correctamente',
                        
                            ];

                            echo json_encode($respuesta);
                            
                        }else{

                            $respuesta = [

                                'error' => TRUE,
                                'mensaje' => 'no se pudo guardar la informacion',
                                'errores' => $this->clientesModel->db->error
                            ];

                            http_response_code(500);
                            echo json_encode($respuesta);
                        }
                        
                    }
                  
                }else{

                    $respuesta = [
            
                        'error' => TRUE,
                        'mensaje' => 'No ha enviado nada',
                        'errores' => [
        
                            'nombre' => '',
                            'apellido' => '',
                            'edad' => '',
        
                        ],
                        
                    ];
            
                    http_response_code(403);
                    echo json_encode($respuesta);
                }
        
        }

    }

    // El post se usa para actualizar
    public function cliente_post(){   
        
        
        
            // Comprobando si se solicita un POST
            if ( $_SERVER['REQUEST_METHOD'] == 'POST') { 
                
               $respuesta = [];
                // parse_str(file_get_contents('php://input'), $_PUT);
                
                if ($_POST != []) {     // se envio algo    

                    $errores = [];
                                        
                    $errores['nombre'] = validaStr(((isset($_POST['nombre'])) ? $_POST['nombre'] : null), 'nombre');
                    
                    $errores['apellido'] = validaStr(((isset($_POST['apellido'])) ? $_POST['apellido'] : null), 'apellido');

                    $errores['edad'] = validaNumero(((isset($_POST['edad'])) ? $_POST['edad'] : null), 'edad');
                    
                    if (http_response_code() == 404) {
                        
                        $respuesta = [

                            'error' => TRUE,
                            'mensaje' => 'Hay errores en el envio de informacion',
                            'errores' => [
                                'nombre' => $errores['nombre']['rnombre'],
                                'apellido' => $errores['apellido']['rapellido'],
                                'edad' => $errores['edad']['redad'],
                            ],
                        ];
                        
                        echo json_encode($respuesta);
                        return;
                    }else {

                        //guardando $_POST en las propiedades
                        $data = $this->clientesModel->set_datos($_POST);
                        //verificando si el redistro es repetido
                        $cliente_edad = $this->clientesModel->getClienteRep($data);
                        
                        // $ultimo_registro = $this->clientesModel->getUsersMaxValue();
                        
                        if ($cliente_edad > 0) {

                            http_response_code(404);
                            $respuesta = [

                                'error' => TRUE,
                                'mensaje' => 'La edad ya existe en la base de datos',
                                'errores' => [
                                    
                                ],
                            ];
                            echo json_encode($respuesta);
                            return;

                        }
             
                        $cliente = $this->clientesModel->saveCliente($data);

                        if (!$cliente) {

                            
                            $respuesta = [

                                'error' => TRUE,
                                'mensaje' => 'no se pudo guardar la informacion',
                                'errores' => $this->clientesModel->db->error
                            ];

                            http_response_code(500);
                            echo json_encode($respuesta);
                            
                        }

                        $respuesta = [

                            'error' => FALSE,
                            'mensaje' => 'Se registro correctamente',
                    
                        ];
                        
                        echo json_encode($respuesta);

                        return;
                        
                    }
                  
                }else{

                    $respuesta = [
            
                        'error' => TRUE,
                        'mensaje' => 'No ha enviado nada',
                        'errores' => [
        
                            'nombre' => '',
                            'apellido' => '',
                            'edad' => '',
        
                        ],
                        
                    ];
            
                    http_response_code(403);
                    echo json_encode($respuesta);
                }
        
        }

    }

   
}
?>