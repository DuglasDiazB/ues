

<?php

    function paginar_todo($cuantos, $pagina, $pos_pagina){

        $totalPaginas = ceil($cuantos/ $pos_pagina);

        if($pagina > $totalPaginas){

            $pagina = $totalPaginas;

        }

        $pagina -= 1;

        $desde = $pagina * $pos_pagina;

        if ($pagina >= $totalPaginas -1) {
            
            $pagina_siguiente = 1;

        }else{

            $pagina_siguiente = $pagina + 2;

        }

        if ($pagina < 1 ) {
            
            $pagina_anterior = $totalPaginas;

        }else{

            $pagina_anterior = $pagina;

        }

        
        $respuesta = array(
            'error' => FALSE,
            'cuantos' => $cuantos,
            'totalPaginas' => $totalPaginas,
            'pagina_actual' => ($pagina + 1),
            'pagina_siguiente' => $pagina_siguiente,
            'pagina_anterior' => $pagina_anterior,
            'desde' => $desde

        );

        return $respuesta;
    }
?>