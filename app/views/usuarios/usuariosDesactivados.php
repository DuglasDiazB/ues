<?php require_once('../app/views/inc/header.php'); ?>

<table>
	    <thead>
			<tr>
				<!-- colspan="Numero de columnas que tendra la tabla" -->
                <th colspan="8">
                <div class="title">
                <p>Lista de usuarios activos, se <?php echo $var = ($parameters['respuesta']['cuantos'] > 1)?'encontraron ':' encontro '?>
                    <?php echo $parameters['respuesta']['cuantos']. $var = ($parameters['respuesta']['cuantos'] > 1)?' registros':' registro'?>
                
                </p>
                <p>
                    <?php if ($parameters['busqueda'] != null):?>
                        <a href="<?php echo ROUTE_URL?>/usuarios/usuariosDesactivados" class="btn-editar"><i
                                class="fas fa-redo"></i>Recargar</a>
                    <?php endif?>
                        <!-- <a href="<?php echo ROUTE_URL?>/usuarios/nuevoUsuario" class="btn-ver"><i
                                class="far fa-plus-square"></i>
                            Nuevo
                            usuario</a> -->
                        <a href="<?php echo ROUTE_URL?>/usuarios/index" class="btn-editar"><i class="fas fa-user-check"></i>Activos</a>

                </p>
                </div>
   	 		</tr>
			<tr>
				<!-- Se debe ajustar el ancho de las tablas -->
				<th width="5">#</th>
                <th>Nombre</th>
                <th>Telefono</th>
                <th>DUI</th>
                <th>Edad</th>
                <th>Tipo Usuario</th>
                <th>Estado</th>
                <th>Opciones</th>
				
			</tr>
		</thead>
		<tbody>
        <?php if( $parameters['respuesta']['error']):?>
        <tr>
            <td data-label="error">
                -
            </td>
            <td data-label="error">
                ---
            </td>
            <td data-label="error">
                ---
            </td>
            <td data-label="error">
                ---
            </td>
            <td data-label="error">
                ---
            </td>
            <td data-label="error">
                ---
            </td>
            <td data-label="error">
                ---
            </td>
            <td data-label="error">
                No hay registros...
            </td>
        </tr>
        <!-- si se encuentran registros -->
        <?php else:?>
			<?php for($i = 0; $i < count($parameters['usuarios']); $i ++):?>
        <tr>
            <td data-label="#">
                <?php echo $parameters['respuesta']['numIds'][$i] + 1?>
            </td>
            <td data-label="Nombre">
                <?php echo $parameters['usuarios'][$i]->nombreusuario.' '.$parameters['usuarios'][$i]->apellidousuario?>
            </td>
            <td data-label="Telefono">
                <?php echo $parameters['usuarios'][$i]->telefonousuario?>
            </td>
            <td data-label="DUI">
                <?php echo $parameters['usuarios'][$i]->duiusuario?>
            </td>
            <td data-label="Edad">
                <?php echo $parameters['usuarios'][$i]->fechanacimientousuario?>
            </td>
            <td data-label="Tipo Usuario">
                <?php echo $var = ($parameters['usuarios'][$i]->idtipousuario == 1)? 'Administrador': 'Estandar'?>
            </td>
            <td data-label="Estado">
                <?php echo $var = ($parameters['usuarios'][$i]->estadousuario == 1)? 'Activado': 'Desactivado'?>
            </td>
            <td data-label="Opciones">
                <!-- <a href="javascript:editarUsu()" class="btn-nuevo"><i class="far fa-edit"></i></a> -->
                <a href="<?php echo ROUTE_URL?>/usuarios/verUsuario<?php echo $var=(isset($parameters['usuarios']))? '/'.$parameters['usuarios'][$i]->idusuario:''?>/2"
                    class="btn-ver"><i class="fas fa-eye"></i></a>
                <!-- <a href="<?php echo ROUTE_URL?>/usuarios/index/?editar=<?php echo $parameters['usuarios'][$i]->idusuario?>&pagina=<?php echo $parameters['pagina']?>&busqueda=<?php echo $var = (isset($parameters['busqueda']))? $parameters['busqueda'] : ''?>"
                    class="btn-editar"><i class="far fa-edit"></i></a> -->
                <a href="<?php echo ROUTE_URL.'/usuarios/usuariosDesactivados'?>/<?php echo $parameters['respuesta']['pagina_actual']?><?php echo $var=(isset($parameters['usuarios']))? '/'.$parameters['usuarios'][$i]->idusuario:''?>/<?php echo 0?><?php echo $var = ($parameters['busqueda'] != null)?'/'.str_replace(' ', '_',$parameters['busqueda']): ''?>"
                    class="btn-editar"><i class="fas fa-check-circle"></i></a>

            </td>
        </tr>
        <?php endfor?>
        <?php endif;?>
	    </tbody>
	</table>
	<!-- Paginacion -->
	<section class="paginacion">

		<ul>
    
            <?php if ($parameters['respuesta']['pagina_actual'] ==  1 || $parameters['respuesta']['error'] == 1) :?>
                <li class="disabled">&laquo;</li>
            <?php elseif ($parameters['respuesta']['pagina_actual'] >  1 || $parameters['respuesta']['error'] == null):?>
            <a class="inicio"
                href="<?php echo ROUTE_URL.'/usuarios'?>/usuariosDesactivados/<?php echo $parameters['respuesta']['pagina_anterior']?>/<?php echo 0?>/<?php echo 0?><?php echo $var = ($parameters['busqueda'] != null)?'/'.$parameters['busqueda']: ''?>">&laquo;</a>
            <?php endif;?> 

        <!-- Estableciendo numero de paginas -->


        <?php for ($i=1; $i <= $parameters['respuesta']['totalPaginas']; $i++):?>

        <?php if ($parameters['respuesta']['pagina_actual'] == $i):?>

        <li class="Active">
            <a href="<?php echo ROUTE_URL.'/usuarios'?>/usuariosDesactivados/<?php echo $i?>/<?php echo 0?>/<?php echo 0?><?php echo $var = ($parameters['busqueda'] != null)?'/'.$parameters['busqueda']: ''?>"><?php echo $i?></a>
        </li>


        <?php else:?>

        <li>
            <a href="<?php echo ROUTE_URL.'/usuarios'?>/usuariosDesactivados/<?php echo $i?>/<?php echo 0?>/<?php echo 0?><?php echo $var = ($parameters['busqueda'] != null)?'/'.$parameters['busqueda']: ''?>"><?php echo $i?></a>
        </li>

        
        <?php endif?>

        <?php endfor;?>
          <!-- bloqueando el boton de siguiente cuando se llega a la ultima pagina -->
            <?php if ($parameters['respuesta']['pagina_actual'] ==  $parameters['respuesta']['totalPaginas'] || $parameters['respuesta']['error'] == 1) :?>
                <li class="disabled">&raquo;</li>
            <?php elseif ($parameters['respuesta']['pagina_actual'] <  $parameters['respuesta']['totalPaginas'] || $parameters['respuesta']['error'] == null):?>
            <a class="fin"
                href="<?php echo ROUTE_URL.'/usuarios'?>/usuariosDesactivados/<?php echo $parameters['respuesta']['pagina_siguiente']?>/<?php echo 0?>/<?php echo 0?><?php echo $var = ($parameters['busqueda'] != null)?'/'.$parameters['busqueda']: ''?>">&raquo;</a>
            <?php endif;?> 
		</ul>

                
	</section>
    </main>

</div>
</div>

<!-- Eliminar -->
<?php if($parameters['usuario']):?>
<div class="box" id="eliminar-usuario">

    <div class="encabezado">
    
        <h3 style='color:#3cd300; font-size: 20px;'><i class="fas fa-user-check"></i></i></h3>
    </div>

    <div class="cuerpo">
        <h4>¿Desea activar al usuario?</h4>
        <h3 style="color:white">
            <?php echo $parameters['usuario']->nombreusuario .' '.$parameters['usuario']->apellidousuario?></h3>

    </div>

    <div class="pie">

        <div class="aceptar">

            <a href="<?php echo ROUTE_URL.'/usuarios/usuariosDesactivados'?>/<?php echo $parameters['respuesta']['pagina_actual']?>/<?php echo $var=(isset($parameters['usuario']))? $parameters['usuario']->idusuario:''?>/<?php echo 1?><?php echo $var = ($parameters['busqueda'] != null)?'/'.str_replace(' ', '_',$parameters['busqueda']): ''?>"
                class="btn-editar"><i class="fas fa-check"></i></a>

        </div>

        <div class="aceptar">

            <a href="javascript:cerrar()" class="btn-desactivar"><i class="fas fa-times"></i></a>

        </div>

    </div>



</div>
<?php endif?>


<!-- llamar archivo js -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"
    integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="<?php echo ROUTE_URL?>/js/menu.js"></script>

<!-- Direcciones de javascrit incluye las validaciones de form-usuario -->
<script src="<?php echo ROUTE_URL?>/js/validaciones.js"></script>


<?php if($parameters['usuario']):?>
<script>
document.getElementById('eliminar-usuario').style.display = "block";
display = document.querySelector("#blur");
display.classList.toggle('active');
</script>
<?php endif?>


</body>

</html>