<?php require_once('../app/views/inc/header.php'); ?>
    <div class="grid-inicio">
        <div class="grid-encabezado">
            <h2>Unidad Comunitaria de Salud Familiar</h2>
        </div>

        <div class="grid-cajas">
            <a href="<?php echo ROUTE_URL?>/manipuladores"><i class="fas fa-hand-paper"></i>Manipuladores <?php echo $parameters['manipuladores']?> <br> Formal:<?php echo $parameters['manipuladoresFormal']?>  Informal:<?php echo $parameters['manipuladoresInformal']?> </a>

            <a href="<?php echo ROUTE_URL?>/establecimientos" ><i class="fas fa-store"></i>Establecimientos <?php echo $parameters['establecimientos']?> <br>Formal:<?php echo $parameters['establecimientosFormal']?>  Informal:<?php echo $parameters['establecimientosInformal']?> </a>

            <a href="<?php echo ROUTE_URL?>/inspecciones" ><i class="fas fa-user-secret"></i>Inspecciones <?php echo $parameters['inspecciones']?></a>

            <a href="<?php echo ROUTE_URL?>/credenciales" ><i class="fas fa-address-card"></i>Credenciales <?php echo $parameters['credenciales']?> <br>Formal: <?php echo $parameters['credencialesformal']?>  Informal: <?php echo $parameters['credencialesinformal']?> </a>

            <a href="<?php echo ROUTE_URL?>/examenes" ><i class="fas fa-file-medical"></i>Examenes Aptos <?php echo $parameters['examenesActos']?> <br>Formal: <?php echo $parameters['actosFormal']?>  Informal: <?php echo $parameters['actosInformal']?> </a>
            <a href="<?php echo ROUTE_URL?>/examenes/examenesNoActos" ><i class="fas fa-file-medical-alt"></i>Examenes No Aptos <?php echo $parameters['examenesNoactos']?> <br>Formal: <?php echo $parameters['noactosFormal']?>  Informal: <?php echo $parameters['noactosInformal']?> </a>

            <a href="<?php echo ROUTE_URL?>/asistencias" ><i class="fas fa-clipboard-list"></i>Asistencias <?php echo $parameters['asistencias']?> <br>Formal: <?php echo $parameters['asistenciasFormal']?> Informal: <?php echo $parameters['asistenciasInformal']?></a>
            <a href="<?php echo ROUTE_URL?>/asistencias/noAsistidos" ><i class="fas fa-clipboard-list"></i>Inasistencias <?php echo $parameters['inasistencias']?> <br>Formal: <?php echo $parameters['inasistenciasFormal']?>  Informal: <?php echo $parameters['inasistenciasInformal']?></a>
            
            <a href="<?php echo ROUTE_URL?>/usuarios" ><i class="fas fa-users-cog"></i>Usuarios <?php echo $parameters['usuarios']?> <br> Admin: <?php echo $parameters['usuarioAdmin']?>  Estandar: <?php echo $parameters['usuarioEstand']?> </a> 

        </div>
    </div>

<!-- Llamando el footer -->
<?php require_once('../app/views/inc/footer.php'); ?>