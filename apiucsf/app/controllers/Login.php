
<?php

class Login extends MainController{

    function __construct(){

        $this->modeloLogin = $this->model('modeloLogin');
        header("Access-Control-Allow-Origin: *");
        header('Content-Type: aplication/json');

    }

    public function usuario_get($user = '', $pass = ''){

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        
            $respuesta = [];
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

            $user = ucwords($user);
            $pass = validaText(hash('sha512', $pass));

            $usuario = $this->modeloLogin->login($user, $pass);

            if ($usuario) {
                $respuesta = array(
                    'error' => FALSE,
                    'mensaje' => 'Datos cargados correctamente',
                    'usuario' => $usuario

                );
                http_response_code(200);
                echo json_encode($respuesta);
                return;

            }else{
                $respuesta = array(

                    'error' => TRUE,
                    'mensaje' => 'Usuario o Password incorrectos',
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
