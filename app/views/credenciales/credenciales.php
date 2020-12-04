<?php require_once('../app/views/inc/header.php'); ?>

<table>
	    <thead>
			<tr>
				<!-- colspan="Numero de columnas que tendra la tabla" -->
      			<th colspan="9">
                    <div class="title">
                        <p>
                            Credenciales aptas, se <?php echo $var = ($parameters['respuesta']['cuantos'] > 1)?'encontraron ':' encontro '?>
                            <?php echo $parameters['respuesta']['cuantos']. $var = ($parameters['respuesta']['cuantos'] > 1)?' registros':' registro'?>
                        </p>
                        <p>
                            <?php if ($parameters['busqueda'] != null):?>
                                <a href="<?php echo ROUTE_URL?>/credenciales" class="btn-editar"><i
                                    class="fas fa-redo"></i>Recargar</a>
                            <?php endif?>
                            <a href="<?php echo ROUTE_URL?>/credenciales/noActos" class="btn-desactivar"><i class="fas fa-address-card"></i> No Aptos</a>
                        </p>
                    </div> 
                </th>
   	 		</tr>
			<tr style="background: #dbdfe4;">
				<!-- Se debe ajustar el ancho de las tablas -->
				<th width="5">#</th>
                <th width="95">DUI</th>
				<th>Nombre</th>
                <th>Puesto</th>  
                <th>Examenes</th>
                <th>Asistencia</th>
                <th>Emision</th>
                <th>Vencimiento</th>                
				<!-- <th>Estado</th> -->
				<th>Opciones</th>
				
			</tr>
		</thead>
        <tbody>
            <?php if ($parameters['respuesta']['error']):?>
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
                        ---
                    </td>
                   
                    <td data-label="error">
                        No hay registros...
                    </td>
                </tr>
            <?php else:?>
                <?php for ($i = 0; $i < count($parameters['credenciales']); $i++):?>
			    <tr>
				    <td data-label="#">
                        <?php echo $parameters['respuesta']['numIds'][$i] + 1?>
                    </td>
				    <td data-label="DUI">
                        <?php echo $parameters['credenciales'][$i]->dui_manip?>
                    </td>
				    <td data-label="Nombre">
                        <?php echo $parameters['credenciales'][$i]->nombre_manip . ' ' . $parameters['credenciales'][$i]->apellido_manip?>
                    </td>			
                    <td data-label="Puesto">
                        <?php echo $parameters['credenciales'][$i]->puesto_manip?>
                    </td>  
                    <td data-label="Examenes">
                        <?php echo ($parameters['credenciales'][$i]->estado_exam == 'Acto') ? 'Apto':'No Apto'?>
                    </td>
                    <td data-label="Asistencias">
                        <?php echo $parameters['credenciales'][$i]->asistencia?>
                    </td> 
                    <td data-label="Emision">
                        <?php echo $parameters['credenciales'][$i]->fecha_emis_creden?>
                    </td> 
                    <td data-label="Vencimiento">
                        <?php echo $parameters['credenciales'][$i]->fecha_exped_creden?>
                    </td>              
                
                    <td data-label="Opciones">
                        <a href="<?php echo ROUTE_URL?>/credenciales/verCredencial<?php echo $var=(isset($parameters['credenciales']))? '/'.$parameters['credenciales'][$i]->id_creden.'/Activo/'.$parameters['respuesta']['pagina_actual'].'/'.$parameters['busqueda']:''?>"
                         class="btn-ver"><i class="fas fa-eye"></i></a>
                            
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
                <a class="inicio" href="<?php echo ROUTE_URL.'/credenciales'?>/<?php echo $parameters['respuesta']['pagina_anterior']?><?php echo $var = ($parameters['busqueda'] != null)?'/'.str_replace(' ', '_',$parameters['busqueda']): ''?>">&laquo;</a>
            <?php endif;?>
            <?php for ($i = 1; $i <= $parameters['respuesta']['totalPaginas']; $i++):?>
                <?php if ($parameters['respuesta']['pagina_actual'] == $i):?>
			        <li class="Active">
                        <a href="<?php echo ROUTE_URL.'/credenciales'?>/<?php echo $i?><?php echo $var = ($parameters['busqueda'] != null)?'/'.str_replace(' ', '_',$parameters['busqueda']): ''?>"><?php echo $i?></a>
                    </li>
                <?php else:?> 
                    <li>
                        <a href="<?php echo ROUTE_URL.'/credenciales'?>/<?php echo $i?><?php echo $var = ($parameters['busqueda'] != null)?'/'.str_replace(' ', '_',$parameters['busqueda']): ''?>"><?php echo $i?></a>
                    </li>
                <?php endif?>
            <?php endfor;?>
            <?php if ($parameters['respuesta']['pagina_actual'] ==  $parameters['respuesta']['totalPaginas'] || $parameters['respuesta']['error'] == 1) :?>
                <li class="disabled">&raquo;</li>
            <?php elseif ($parameters['respuesta']['pagina_actual'] <  $parameters['respuesta']['totalPaginas'] || $parameters['respuesta']['error'] == null):?>
                <a class="fin" href="<?php echo ROUTE_URL.'/credenciales'?>/<?php echo $parameters['respuesta']['pagina_siguiente']?><?php echo $var = ($parameters['busqueda'] != null)?'/'.str_replace(' ', '_',$parameters['busqueda']): ''?>">&raquo;</a>
            <?php endif;?> 
		</ul>
	</section>    

<?php require_once('../app/views/inc/footer.php'); ?>