
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
            http_response_code(200);
        }
        else {
            
            http_response_code(404);            
            

        }



        return [$campo => $valor[$campo], 'r'.$campo => $mensajeError['r'.$campo], 'error' => $error];
    }
    
    function validaNumero($numero, $min = 0, $max = 100){
        
        $error = FALSE;

        $mensajeError = '';
        
        if ($numero == '' || NULL) {

            $error = 'error';
            $mensajeError = 'Este campo es requerido';
            
        }elseif (is_numeric($numero)) {
            
            
            if($numero < $min){
    
                $error = 'error';
                $mensajeError = 'Se necesita mínimo '.(string)$min;
    
            }else if($numero > $max){
    
                $error = 'error';
                $mensajeError = 'No debe exceder los '.(string)$max;
    
            }
        }else{
            $error = 'error';
            $mensajeError = 'Este campo debe ser un numero';
        }
        
        
        if($error == FALSE &&  $mensajeError == ''){
            $error = 'success';
            $numero = validaText($numero);
            
        }
        return ['form-control' => $error, 'text' => $numero, 'small' => $mensajeError];
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
            http_response_code(200);
        }else{
            http_response_code(404);
            
        }



        return [$campo => $valor[$campo], 'r'.$campo => $mensajeError['r'.$campo], 'error' => $error];
    }

    function validaNombre($text, $min = 3, $max = 50){
        
        //quita los caracteres especiales del texto
        $text = preg_replace('([^A-Za-z ])', '', $text);
        $error = FALSE;

        $mensajeError = '';
        
        if ($text == '' || NULL) {
            
            $error = 'error';
            $mensajeError = 'Este campo es requerido';
            
        }else if(strlen($text) < $min){

            $error = 'error';
            $mensajeError = 'Se necesita mínimo '.(string)$min.' caracteres';

        }else if(strlen($text) > $max){

            $error = 'error';
            $mensajeError = 'No debe exceder los '.(string)$max.' caracteres';

        }else if(is_numeric($text)){
            $error = 'error';
            $mensajeError = 'No se admiten números en este campo';
        }
        
        
        if($error == FALSE &&  $mensajeError == ''){
            $error = 'success';
            $text = validaText($text);
            
        }
        //se envia campo del formulario, mensaje de error y error (True - False)
        return ['form-control' => $error, 'text' => $text, 'small' => $mensajeError];

    }

    function validaStr($text, $min = 3, $max = 50, $model = null){
            
        
        $mensajeError = "";
        $error =  FALSE;

        if ($model != null && $model > 0) {

            $error = 'error';
            $mensajeError = 'El usuario ya existe';

        }else if ($text == '' || NULL) {

            $error = 'error';
            $mensajeError = 'Este campo es requerido';
            
        }else if(strlen($text) < $min){

            $error = 'error';
            $mensajeError = 'Se necesita mínimo '.(string)$min.' caracteres';

        }else if(strlen($text) > $max){

            $error = 'error';
            $mensajeError = 'No debe exceder los '.(string)$max.' caracteres';

        }else if(is_numeric($text)){
            $error = 'error';
            $mensajeError = 'No se admiten números en este campo';
        }
        

        if($error == FALSE && $mensajeError == ''){
            
            $error = 'success';
            $text = validaText(ucwords(strtolower($text)));
            
        }

        return ['form-control' => $error, 'text' => $text, 'small' => $mensajeError];

    }

    function validafecha($fecha){

        
        $mensajeError = '';
        $error = FALSE;

        if($fecha == '' || NULL){

            $error = 'error';
            $mensajeError = 'Este campo es requerido';

        }

        if($error == FALSE && $mensajeError == ''){
            $error = 'success';
            $fecha = validaText($fecha);
            
        }

        return ['form-control' => $error, 'text' => $fecha, 'small' => $mensajeError];
       
    }
    
    function validatelefono($telefono){

        $mensajeError = "";
        $error = FALSE;

        if($telefono == '' || NULL){

            $error = 'error';
            $mensajeError = 'Este campo es requerido';
            
        }else if (!preg_match('/^([0-9]{4}\-[0-9]{4})$/', $telefono)){

            $error = 'error';
            $mensajeError = 'El formato de debe ser 7777-7777';

        } 
        
        if($error == FALSE && $mensajeError == ''){
            
            $error = 'success';
            $telefono = validaText($telefono);
            
        }

        return ['form-control' => $error, 'text' => $telefono, 'small' => $mensajeError];
       
    }

    function validaDui($dui, $model = null){

        $mensajeError = "";
        $error = FALSE;
        if ($model != null && $model > 0) {

            $error = 'error';
            $mensajeError = 'El DUI ya existe';

        }
        if($dui == '' || NULL){
            $error = 'error';
            $mensajeError = 'Este campo es requerido';
        }else if (!preg_match('/^([0-9]{8}\-[0-9]{1})$/', validaText($dui))){

            $error = 'error';
            $mensajeError = 'El formato debe ser 12345678-0';
            
        } 
        
        if($error == FALSE && $mensajeError == ''){
            
            $error = 'success';
            $dui = validaText($dui);
            
        }

        return ['form-control' => $error, 'text' => $dui, 'small' => $mensajeError];
       
    }

    function validaPassword($pass = null, $pass2 = null){

        
        $mensajeError = "";
        $error = FALSE;
        
        if ($pass == '' || $pass == null) {
            $error = 'error';
            $mensajeError = 'Este campo es requerido';
        }

        elseif ($pass2 == '' || $pass2 == null) {
            $error = 'error';
            $mensajeError = 'Repita contraseña';
        }

        elseif ($pass != $pass2) {
            $error = 'error';
            $mensajeError = 'Las Contraseñas no coinciden';
        }

        
        if($error == FALSE && $mensajeError == ""){

            $error = 'success';
            
        }

        return ['form-control' => $error, 'text' => $pass, 'small' => $mensajeError];

    }

    //************************notificaciones *********************** */
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

        // echo $result;  
        // die();
    }
    // ****************************************************************/
?>