<?php require_once('../app/views/inc/header.php'); ?>

<table>
	    <thead>
			<tr>
				<!-- colspan="Numero de columnas que tendra la tabla" -->
      			<th colspan="11">
                    <div class="title">
                        <p>
                           Examenes aptos, se <?php echo $var = ($parameters['respuesta']['cuantos'] > 1)?'encontraron ':' encontro '?>
                            <?php echo $parameters['respuesta']['cuantos']. $var = ($parameters['respuesta']['cuantos'] > 1)?' registros':' registro'?>
                        </p>
                        <p>
                            <?php if ($parameters['busqueda'] != null):?>
                                <a href="<?php echo ROUTE_URL?>/examenes/index" class="btn-editar"><i
                                    class="fas fa-redo"></i>Recargar</a>
                            <?php endif?>
                            <a href="<?php echo ROUTE_URL?>/examenes/examenesNoActos" class="btn-desactivar"><i 
                                    class="fas fa-file-medical-alt"></i> No Aptos</a>
                        </p>
                    </div> 
                </th>
   	 		</tr>
			<tr style="background: #dbdfe4;">
				<!-- Se debe ajustar el ancho de las tablas -->
				<th width="5">#</th>
                <th width="95">DUI</th>
				<th>Nombre manipulador</th>
                <th>Examen S</th>
                <th>Examen O</th>                
                <th>Examen S2</th>
                <th>Examen O2</th>
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
                        No hay registros...
                    </td>
                </tr>
            <?php else:?>
                <?php for ($i = 0; $i < count($parameters['examenes']); $i++):?>
			    <tr>
				    <td data-label="#">
                        <?php echo $parameters['respuesta']['numIds'][$i] + 1?>
                    </td>
				    <td data-label="DUI">
                        <?php echo $parameters['examenes'][$i]->dui_manip?>
                    </td>
				    <td data-label="Nombre">
                        <?php echo $parameters['examenes'][$i]->nombre_manip . ' ' . $parameters['examenes'][$i]->apellido_manip?>
                    </td>			
                    <td data-label="S">
                        <?php echo $parameters['examenes'][$i]->exam_s?>
                    </td>
                    <td data-label="O">
                        <?php echo $parameters['examenes'][$i]->exam_o?>
                    </td>                
                    <td data-label="S2">
                        <?php echo $parameters['examenes'][$i]->exam_s2?>
                    </td>
                    <td data-label="O2">
                        <?php echo $parameters['examenes'][$i]->exam_o2?>
                    </td>
                
				    <td data-label="Opciones">					
                    <a href="<?php echo ROUTE_URL?>/examenes/verExamen<?php echo $var=(isset($parameters['examenes']))? '/'.$parameters['examenes'][$i]->id_exam.'/'.$parameters['respuesta']['pagina_actual'] . '/' . $parameters['busqueda']:''?>"
                        class="btn-ver"><i class="fas fa-eye"></i></a>
                    <!-- <a href="<?php echo ROUTE_URL?>/examenes/actualizarExamen<?php echo $var=(isset($parameters['examenes']))? '/'.$parameters['examenes'][$i]->id_exam:''?>"
                        class="btn-editar"><i class="far fa-edit"></i></a> -->
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
                <a class="inicio" href="<?php echo ROUTE_URL.'/examenes'?>/<?php echo $parameters['respuesta']['pagina_anterior']?><?php echo $var = ($parameters['busqueda'] != null)?'/'.str_replace(' ', '_',$parameters['busqueda']): ''?>">&laquo;</a>
            <?php endif;?>
            <?php for ($i = 1; $i <= $parameters['respuesta']['totalPaginas']; $i++):?>
                <?php if ($parameters['respuesta']['pagina_actual'] == $i):?>
			        <li class="Active">
                        <a href="<?php echo ROUTE_URL.'/examenes'?>/<?php echo $i?><?php echo $var = ($parameters['busqueda'] != null)?'/'.str_replace(' ', '_',$parameters['busqueda']): ''?>"><?php echo $i?></a>
                    </li>
                <?php else:?> 
                    <li>
                        <a href="<?php echo ROUTE_URL.'/examenes'?>/<?php echo $i?><?php echo $var = ($parameters['busqueda'] != null)?'/'.str_replace(' ', '_',$parameters['busqueda']): ''?>"><?php echo $i?></a>
                    </li>
                <?php endif?>
            <?php endfor;?>
            <?php if ($parameters['respuesta']['pagina_actual'] ==  $parameters['respuesta']['totalPaginas'] || $parameters['respuesta']['error'] == 1) :?>
                <li class="disabled">&raquo;</li>
            <?php elseif ($parameters['respuesta']['pagina_actual'] <  $parameters['respuesta']['totalPaginas'] || $parameters['respuesta']['error'] == null):?>
                <a class="fin" href="<?php echo ROUTE_URL.'/examenes'?>/<?php echo $parameters['respuesta']['pagina_siguiente']?><?php echo $var = ($parameters['busqueda'] != null)?'/'.str_replace(' ', '_',$parameters['busqueda']): ''?>">&raquo;</a>
            <?php endif;?> 
		</ul>
	</section>    

<?php require_once('../app/views/inc/footer.php'); ?>