<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf8">
    <meta lang="es">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $parameters['title']?></title>
    <link rel="icon" href="<?php echo ROUTE_URL?>/img/logominsal.png" type="logominsal/png" size="16x16">
    <link rel="stylesheet" href="<?php echo ROUTE_URL?>/fontawesome/css/all.css">
    <link rel="stylesheet" href="<?php echo ROUTE_URL?>/css/reset.css">
    <link rel="stylesheet" href="<?php echo ROUTE_URL?>/css/menu.css">
    <link rel="stylesheet" href="<?php echo ROUTE_URL?>/css/tabla.css">
    <link rel="stylesheet" href="<?php echo ROUTE_URL?>/css/paginacion.css">
    <link rel="stylesheet" href="<?php echo ROUTE_URL?>/css/notificacion.css">
    <link rel="stylesheet" href="<?php echo ROUTE_URL?>/css/formularios.css">
    <link rel="stylesheet" href="<?php echo ROUTE_URL?>/css/inicio.css">
    <link rel="stylesheet" href="<?php echo ROUTE_URL?>/css/credencial.css">
    <link rel="stylesheet" href="<?php echo ROUTE_URL?>/css/capacitacion.css">
    <link rel="stylesheet" href="<?php echo ROUTE_URL?>/css/reporte.css">
    
    
    <!-- <link rel="stylesheet" href="<?php echo ROUTE_URL?>/css/formularios.css"> -->

</head>

<body>
    <div class="container" id="blur">
        <div class="contenedor active" id="contenedor">

            <!-- Trabajando con el encabezado del archivo menu -->
            <header class="header">
                <div class="contenedor-logo">
                    <button id="boton-menu" class="boton-menu"><span class="fas fa-bars"></span></button>
                    <a href="#" class="logominsal"><img src="<?php echo ROUTE_URL?>/img/minsal.png" alt="UCSF"></a>
                </div>

                <!-- dibujamos la barra de busqueda si estamos en usuarios -->
                <?php if (isset($parameters['rutaContrBusqueda'])):?>

                    <div class="barra-busqueda">
                        <form action="<?php echo $parameters['rutaContrBusqueda']?>" method="post" accept-charset="utf-8">
                            <input type="text" placeholder="Buscar" name="busqueda"
                                value="<?php echo $var = (isset($parameters['busqueda']))? $parameters['busqueda'] : ''?>">
                            <button type="submit" name="buscar" value="Consultar"><i class="fas fa-search"></i>
                        </form>
                    </div>

              <?php endif?>

                <div class="botones-header">
                <p class="menuCSS3"><a style="color: white; :hover{color : #000;}"href="<?php echo  ROUTE_URL?>/login/logout"><?php print_r($_SESSION['user']->username)?> <i class="fas fa-sign-out-alt" style="font-size: 150%;"></i></a></p>     
                </div>

            </header>

            <nav class="menu-lateral">
                <a href="<?php echo ROUTE_URL?>/index"
                    class="<?php echo $var = ($parameters['menu'] == 'Inicio')? 'active': ''?>"><i
                        class="fas fa-home"></i>Inicio</a>
                <a href="<?php echo ROUTE_URL?>/manipuladores" class="<?php echo $var=($parameters['menu'] == 'manipuladores')? 'active': ''?>" ><i class="fas fa-hand-paper"></i>Manipúlador</a>
                <a href="<?php echo ROUTE_URL?>/establecimientos" class="<?php echo $var=($parameters['menu'] == 'establecimientos')? 'active': ''?>" ><i class="fas fa-store"></i>Establecimientos</a>
                <a href="<?php echo ROUTE_URL?>/reports" class="<?php echo $var=($parameters['menu'] == 'reports')? 'active': ''?>"><i class="fas fa-list-alt"></i>Reporte</a>
                <a href="<?php echo ROUTE_URL?>/examenes" class="<?php echo $var=($parameters['menu'] == 'examenes')? 'active': ''?>" class=""><i class="fas fa-file-medical"></i>Examenes</a>
                <a href="<?php echo ROUTE_URL?>/credenciales" class="<?php echo $var=($parameters['menu'] == 'credenciales')? 'active': ''?>" ><i class="fas fa-address-card"></i>Credencial</a>
                <a href="<?php echo ROUTE_URL?>/asistencias" class="<?php echo $var=($parameters['menu'] == 'asistencias')? 'active': ''?>" ><i class="fas fa-clipboard-list"></i>Asistencia</a>
                <a href="<?php echo ROUTE_URL?>/inspecciones" class="<?php echo $var=($parameters['menu'] == 'inspecciones')? 'active': ''?>" ><i class="fas fa-user-secret"></i>Inspección</a>
                <!-- llamando al controlador -->
                <a href="<?php echo ROUTE_URL?>/usuarios" class="<?php echo $var=($parameters['menu'] == 'usuarios')? 'active': ''?>"><i class="fas fa-users-cog"></i>Usuario</a>
                <a href="<?php echo ROUTE_URL?>/bitacoras" class="<?php echo $var=($parameters['menu'] == 'bitacoras')? 'active': ''?>"><i class="fas fa-clipboard-check"></i>Bitacora</a>

            </nav>

            <main class="main">
            