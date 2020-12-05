
<?php

class Login extends MainController{

    function __construct(){

        $this->modeloLogin = $this->model('ModeloLogin');
        header("Access-Control-Allow-Origin: *");
        header('Content-Type: aplication/json');

    }

    public function usuario_get($user = '', $pass = ''){

        //resiviendo usuario y password a traves del metodo get
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        
            $respuesta = [];
            //no se envio nada 
            if($user == '' || $pass == ''){
                $respuesta = array(
                    'error' => TRUE,
                    'mensaje' => 'Deben llenarse todos los campos',
                    'usuario' => ''
                );
                http_response_code(405);
                echo json_encode($respuesta);
                return;
            }

            //convirtiendo a minuscula el usuario
            $user = ucwords($user);

            //encriptando password
            $pass = validaText(hash('sha512', $pass));

            //obteniendo usuario
            $usuario = $this->modeloLogin->login($user, $pass);

            //se encontro el usuario 
            if ($usuario) {
                $respuesta = array(
                    'error' => FALSE,
                    'mensaje' => 'Datos cargados correctamente',
                    'usuario' => $usuario

                );
                http_response_code(200);
                echo json_encode($respuesta);
                return;
                //usuario o password incorrectos
            }else{
                $respuesta = array(

                    'error' => TRUE,
                    'mensaje' => '¡Usuario o Password incorrectos!',
                    'usuario' => ''

                );
                http_response_code(405);
                echo json_encode($respuesta);
                return;
            }
        }




    }
}


?>
