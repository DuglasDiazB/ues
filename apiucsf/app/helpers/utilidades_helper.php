
<?php
    function capitalizar_todo($data_cruda){

        return capitalizar_arreglo($data_cruda, array(), TRUE);
    }

    function capitalizar_arreglo($data_cruda, $campos_capitlizar = array(), $todos = FALSE){

        $data_lista = $data_cruda;

        foreach ($data_cruda as $nombre_campo => $valor_campo) {
            
            //Verifica si existe en el arreglo
            if ( in_array($nombre_campo, array_values($campos_capitlizar)) OR $todos) {
                $data_lista[$nombre_campo] = strtoupper($valor_campo);
            }

        }

        return $data_lista;
    }

    
    function validaText($text){

        return trim(filter_var($text, FILTER_SANITIZE_STRING));
    }

    function validaId($numero, $campo){
        
        $error = FALSE;
        $valor[$campo] = $numero;
        
        if ($numero == '' || NULL) {

            $error = TRUE;
            $mensajeError['r'.$campo] = ucwords($campo). ' es requerido';
            
        }elseif (!is_numeric($numero)) {
            
                $error = TRUE;
                $mensajeError['r'.$campo] = ucwords($campo) .' No es valido';
    

        }
        
        
        if(!$error){
            $mensajeError['r'.$campo] = '';
            $valor[$campo] = (int)validaText($numero);
        }
        else {
            
            http_response_code(404);            
            

        }



        return [$campo => $valor[$campo], 'r'.$campo => $mensajeError['r'.$campo]];
    }
    
    function validaNumero($numero, $campo, $min = 18, $max = 75){
        
        $error = FALSE;
        $valor[$campo] = $numero;
        
        if ($numero == '' || NULL) {

            $error = TRUE;
            $mensajeError['r'.$campo] = ucwords($campo). ' es requerido';
            
        }elseif (is_numeric($numero)) {
            
            
            if($numero < $min){
    
                $error = TRUE;
                $mensajeError['r'.$campo] = ucwords($campo) .' debe ser mayor a '.$min;
    
            }else if($numero > $max){
    
                $error = TRUE;
                $mensajeError['r'.$campo] = ucwords($campo) .' debe ser menor a '.$max;
    
            }
        }else{
            $error = TRUE;
            $mensajeError['r'.$campo] = ucwords($campo) .' debe ser un numero';
        }
        
        
        if(!$error){
            $mensajeError['r'.$campo] = '';
            $valor[$campo] = (int)validaText($numero);
        }
        else {
            
            http_response_code(404);            
            

        }



        return [$campo => $valor[$campo], 'r'.$campo => $mensajeError['r'.$campo]];
    }

    function validaCorreo($correo, $campo){
        
        $error = FALSE;
        
        $valor[$campo] = $correo;
        
        if ($correo == '' || NULL) {

            $error = TRUE;
            $mensajeError['r'.$campo] = 'El '. $campo. ' es requerido';
            
        }else if(!filter_var($correo, FILTER_VALIDATE_EMAIL)){

            $error = TRUE;
            $mensajeError['r'.$campo] = 'Formato de '. $campo .' no es correcto';

        }
        
        if(!$error){
         
            $mensajeError['r'.$campo] = '';
            $valor[$campo] = validaText($correo);

        }else{
            http_response_code(404);
            
        }



        return [$campo => $valor[$campo], 'r'.$campo => $mensajeError['r'.$campo]];
    }

    function validaStr($text, $campo, $min = 3, $max = 50){

        $error = FALSE;
        $valor[$campo] = $text;
        
        if ($text == '' || NULL) {

            $error = TRUE;
            $mensajeError['r'. $campo] = 'El '. $campo. ' es requerido';
            
        }else if(strlen($text) < $min){

            $error = TRUE;
            $mensajeError['r'. $campo] = 'El '. $campo .' debe tener un minimo de ' . (string)($min). ' caracteres';

        }else if(strlen($text) > $max){

            $error = TRUE;
            $mensajeError['r'. $campo] = 'El '. $campo .' debe tener un maximo de ' . $max . ' caracteres';

        }else if(is_numeric($text)){
            $error = TRUE;
            $mensajeError['r'. $campo] = 'El '. $campo .' debe ser una cadena de caracteres';
        }
        

        if(!$error){
            
            $mensajeError['r'. $campo] = '';
            $valor[$campo] = validaText($text);
            
        }else {
            
            http_response_code(404);
            

        }

        return [$campo => $valor[$campo], 'r'.$campo => $mensajeError['r'.$campo]];

    }
    
    function validatelefono($telefono, $campo){

        $error = FALSE;
        $valor[$campo] = $telefono;

        if($telefono == '' || NULL){
            $error = TRUE;
            $mensajeError['r'. $campo] = 'El '. $campo. ' es requerido';
        }else if (!preg_match('/^([1-9]{4}\-[1-9]{4})$/', $telefono)){

            $error = TRUE;
            $mensajeError['r'. $campo] = 'El formato de '. $campo .' debe ser 7777-7777';

        } 
        
        if(!$error){
            
            $mensajeError['r'. $campo] = '';
            $valor[$campo] = validaText($telefono);
            
        }else {
            
            http_response_code(404);
            
        }

        return [$campo => $valor[$campo], 'r'.$campo => $mensajeError['r'.$campo]];
       
    }

    function validaDui($dui, $campo){

        $error = FALSE;
        $valor[$campo] = $dui;

        if($dui == '' || NULL){
            $error = TRUE;
            $mensajeError['r'. $campo] = 'El '. $campo. ' es requerido';
        }else if (!preg_match('/^([1-9]{8}\-[1-9]{1})$/', $dui)){

            $error = TRUE;
            $mensajeError['r'. $campo] = 'El formato de '. $campo .' debe ser 12345678-0';

        } 
        
        if(!$error){
            
            $mensajeError['r'. $campo] = '';
            $valor[$campo] = validaText($dui);
            
        }else {
            
            http_response_code(404);
            
        }

        return [$campo => $valor[$campo], 'r'.$campo => $mensajeError['r'.$campo]];
       
    }

    function prepare($token, $notification, $manip){

        //obteniendo llave de acceso a la api
        // define('API_ACCESS_KEY', 'AAAAxU1v-Ls:APA91bHplegHp7tnkqgspdMpQ4MlYbu3Xe4fpxI6FAiT9GlZHlmm_Fjg6rfz0uRv_HC-d6c-c63Kz81XfHS1kQaOzNb-dh6-uhQYB6tUjZJviOet7U0WCATVmxBhccdhxdT9BrJxnNtn');
        $key = 'AAAAm7zkmpo:APA91bHX8S0fFqbFE-notVs7OeNZhvSd9tfe2tlcohFYTxXB5QEuLC9Wop-fZ085g9OVwWSynT_kOUeLb3O1zDOmGDYYpxLlQriu3sC36BxYI7VbT8XNjJROSZMw7i6DjhRrN3Fm4FJ-';
        //obteniendo la ruta de la api
        $fcmUrl = 'https://fcm.googleapis.com/fcm/send';
        
        //informacion que vamos a incluir en la notificacion esta aparece cuando precionamos
        //en la notificacion
        $data = [
            // "comida" => "Comida desde desde la clase",
            "manipulador" => $manip,                        
            "click_action" => "FLUTTER_NOTIFICATION_CLICK"
        ];

        //colocando los elemento necesarios para el mensaje
        $fcmNotification = [
            'to' => $token,
            'notification' => $notification,
            'data' => $data
        ];
        // print_r($fcmNotification);
        //creando los encabezados 
        $headers =[
            'Authorization: key=' . $key,
            'Content-Type: application/json'
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $fcmUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));

        $result = curl_exec($ch);

        curl_close($ch);

        echo $result;  
    }
?>