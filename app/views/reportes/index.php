<!-- Llamando el header -->
<?php require_once('../app/views/inc/header.php'); ?>

<a href="<?php echo ROUTE_URL?>/reports/copiaSeguridad" class="btn-ver"><i
                        class="far fa-plus-square"></i>
                    Copia de seguridad</a>
<div class="navegacion">
    <ul class="menu-reporte">
                
                <li><a href="#">
                    Reporte General</a>
                    <ul class="submenu">
                    <li><a href="<?php echo ROUTE_URL?>/reports/reporteManipuladores">
                    Manipuladores</a></li>

                    <li><a href="<?php echo ROUTE_URL?>/reports/reporteManipuladoresActivos">
                    Manipuladores Activos</a></li>

                    <li><a href="<?php echo ROUTE_URL?>/reports/reporteManipuladoresInactivos" >
                    Manipuladores Inactivos</a></li>


                    <li><a href="<?php echo ROUTE_URL?>/reports/reporteManipuladoresFormales" >
                    Manipuladores Formales</a></li>


                    <li><a href="<?php echo ROUTE_URL?>/reports/reporteManipuladoresInformales" >
                    Manipuladores Informales</a></li>

					</ul>
                </li>
                
                <li> <a href="">
                    Inspecciones</a></li>

                    <li> <a href="">
                    Examenes</a></li>

                    <li> <a href="">
                    Asistencias</a></li>

                    <li> <a href="">
                    Credenciales</a></li>

                    <li><a href="">
                    Establecimientos</a></li>

                    <li> <a href="">
                    Usuarios</a></li>


            </ul>
</div>
     
<!-- Llamando el footer -->
<?php require_once('../app/views/inc/footer.php'); ?>