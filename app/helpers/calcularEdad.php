<?php
    function formatoEdad($usuarios){

        for($i = 0; $i < count($usuarios); $i++){

			$edad = caldularEdad1($usuarios[$i]->fechanacimientousuario);
            $usuarios[$i]->fechanacimientousuario = $edad;
            
        }
        
        return $usuarios;
    }
    function calcularEdad($fechaNacimiento){
       list($ano,$mes,$dia) = explode("-",$fechaNacimiento);
       $ano_diferencia = date("Y") - $ano;
       $mes_diferencia = date("m") - $mes;
       $dia_diferencia = date("d") - $dia;
       if ($dia_diferencia < 0 || $mes_diferencia < 0)
       $ano_diferencia--;
       return $ano_diferencia;
    }

    function caldularEdad1($fechaNacimiento){
        $fecha_nacimiento = new DateTime($fechaNacimiento);
        $hoy = new DateTime();
        $edad = $hoy->diff($fecha_nacimiento);
        return $edad->y;
    }

?>