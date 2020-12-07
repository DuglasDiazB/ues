<!-- Llamando el header -->
<?php require_once('../app/views/inc/header.php'); ?>

<a href="<?php echo ROUTE_URL?>/reports/copiaSeguridad" class="btn-ver"><i
                        class="far fa-plus-square"></i>
                    Copia de seguridad</a>
<div class="navegacion">
    <ul class="menu-reporte">

 
            
                <li> <a href="#">
                    Usuarios</a>
                    <ul class="submenu">
                        <li>
                            <a href="<?php echo ROUTE_URL?>/reports/reporteUsuarios ?>">General</a>
                        </li>


                        <li>
                            <a href="<?php echo ROUTE_URL?>/reports/reporteUsuariosActivos ?>">Activos</a>
                        </li>

                        <li>
                            <a href="<?php echo ROUTE_URL?>/reports/reporteUsuariosInactivos ?>">Inactivos</a>
                        </li>


                   
                        
                    </ul>
                    </li>
                
                <li><a href="#">
                    Manipuladores</a>
                    <ul class="submenu">
                    <li><a href="<?php echo ROUTE_URL?>/reports/reporteManipuladores">
                    General</a></li>

                    <li><a href="<?php echo ROUTE_URL?>/reports/reporteManipuladoresActivos">
                    Activos</a></li>

                    <li><a href="<?php echo ROUTE_URL?>/reports/reporteManipuladoresInactivos" >
                    Inactivos</a></li>


                    <li><a href="<?php echo ROUTE_URL?>/reports/reporteManipuladoresFormales" >
                    Formales</a></li>


                    <li><a href="<?php echo ROUTE_URL?>/reports/reporteManipuladoresInformales" >
                    Informales</a></li>

					</ul>
                </li>





                
                <li> <a href="">
                    Inspecciones</a>

                    <ul class="submenu">
                        <li><a href="<?php echo ROUTE_URL?>/reports/reporteInspecciones">General</a></li>
                    </ul>

                </li>






                    <li> <a href="">
                    Examenes</a></li>

                    <li> <a href="">
                    Asistencias</a></li>

                    <li> <a href="">
                    Credenciales</a></li>



                    <li><a href="">
                    Establecimientos</a>
                    <ul class="submenu">
                         <li><a href="<?php echo ROUTE_URL?>/reports/reporteEstablecimientos">
                    General</a></li>

                      <li><a href="<?php echo ROUTE_URL?>/reports/reporteEstablecimientosActivos">
                    Activos</a></li>

                      <li><a href="<?php echo ROUTE_URL?>/reports/reporteEstablecimientosInactivos">
                    Inactivos</a></li>

                      <li><a href="<?php echo ROUTE_URL?>/reports/reporteEstablecimientosA">
                    Apartado A</a></li>

                    <li><a href="<?php echo ROUTE_URL?>/reports/reporteEstablecimientosB">
                    Apartado B</a></li>

                    <li><a href="<?php echo ROUTE_URL?>/reports/reporteEstablecimientosC">
                    Apartado C</a></li>

                    <li><a href="<?php echo ROUTE_URL?>/reports/reporteEstablecimientosD">
                    Apartado D</a></li>

                    </ul>


                    </li>

                    


            </ul>
</div>

<a href="#" ><img src="<?php echo ROUTE_URL?>/img/logominsal.png" alt="UCSF" style=" margin-left:200px; width: 750px;
    height: 350px;"></a>
     
<!-- Llamando el footer -->
<?php require_once('../app/views/inc/footer.php'); ?>