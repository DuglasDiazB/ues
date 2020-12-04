<?php require_once('../app/views/inc/header.php'); ?>

            <table>
	            <thead>
			        <tr>
				    <!-- colspan="Numero de columnas que tendra la tabla" -->
                        <th colspan="8">
                        <div class="title">
                            <p>No asistidos a capacitaciones, se <?php echo $var = ($parameters['respuesta']['cuantos'] > 1)?'encontraron ':' encontro '?>
                            <?php echo $parameters['respuesta']['cuantos']. $var = ($parameters['respuesta']['cuantos'] > 1)?' registros':' registro'?>
                            </p>

                             <p>
                                <?php if ($parameters['busqueda'] != null):?>
                                <a href="<?php echo ROUTE_URL?>/asistencias" class="btn-editar"><i
                                    class="fas fa-redo"></i>Recargar</a>
                                    <?php endif?>
                                <a href="<?php echo ROUTE_URL?>/asistencias" class="btn-ver"><i class="fas fa-check"></i>
                                <!-- <i class="far fa-plus-square"></i> -->
                                    Asistidos</a>
                            </p>
                        </div>
   	 		        </tr>

			        <tr style= "background: #dbdfe4;">
				        <!-- Se debe ajustar el ancho de las tablas -->
				        <th width="6">#</th>
                        <th>Manipulador</th>
                        <th>DUI</th>
                        <th>Establecimiento</th>
                        <th>Tipo Establecimiento</th>
                        <th>Asistencia</th>
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
                            No hay registros...
                        </td>
                
                    </tr>
                    <!-- si se encuentran registros -->
                    <?php else:?>
			        <?php for($i = 0; $i < count($parameters['asistencias']); $i ++):?>
                    <tr>
                        <td data-label="#">
                            <?php echo $parameters['respuesta']['numIds'][$i] + 1?> 
                        </td>

                        <td data-label="Manipulador">
                        <?php echo $parameters['asistencias'][$i]->nombre_manip.' '.$parameters['asistencias'][$i]->apellido_manip?>
                        </td>

                        <td data-label="DUI">
                            <?php echo $parameters['asistencias'][$i]->dui_manip?>
                        </td>

                        <td data-label="Establecimiento">
                            <?php echo $parameters['asistencias'][$i]->nombre_estab?>
                        </td>

                        <td data-label="Tipo Establecimiento">
                            <?php echo $parameters['asistencias'][$i]->tipo_estab?>
                        </td>

                        <td data-label="Asistencia">
                            <?php echo $parameters['asistencias'][$i]->asistencia?>
                        </td>

                        <td data-label="Opciones">
                        <a href="<?php echo ROUTE_URL?>/asistencias/verAsistencia<?php echo $var=(isset($parameters['asistencias']))? '/'.$parameters['asistencias'][$i]->id_asistencia.'/No/'.$parameters['respuesta']['pagina_actual'].'/'.$parameters['busqueda']:''?>"
                         class="btn-ver"><i class="fas fa-eye"></i></a>

                         <a href="<?php echo ROUTE_URL?>/asistencias/actualizarAsistencia<?php echo $var=(isset($parameters['asistencias']))? '/'.$parameters['asistencias'][$i]->id_asistencia.'/No/'.$parameters['respuesta']['pagina_actual'].'/'.$parameters['busqueda']:''?>"
                         class="btn-editar"><i class="fas fa-edit"></i></a>
                                
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
                    href="<?php echo ROUTE_URL.'/asistencias'?>/<?php echo $parameters['respuesta']['pagina_anterior']?><?php echo $var = ($parameters['busqueda'] != null)?'/'.str_replace(' ', '_',$parameters['busqueda']): ''?>">&laquo;</a>
                    <?php endif;?> 

                    <!-- Estableciendo numero de paginas -->

                    <?php for ($i=1; $i <= $parameters['respuesta']['totalPaginas']; $i++):?>

                    <?php if ($parameters['respuesta']['pagina_actual'] == $i):?>

                    <li class="Active">
                    <a href="<?php echo ROUTE_URL.'/asistencias'?>/<?php echo $i?><?php echo $var = ($parameters['busqueda'] != null)?'/'.str_replace(' ', '_',$parameters['busqueda']): ''?>"><?php echo $i?></a>
                    <!-- controlador, metodo, parametros  -->
                    </li>
                    <?php else:?>

                    <li>
                        <a href="<?php echo ROUTE_URL.'/asistencias'?>/<?php echo $i?><?php echo $var = ($parameters['busqueda'] != null)?'/'.str_replace(' ', '_',$parameters['busqueda']): ''?>"><?php echo $i?></a>
                    </li>

                    <?php endif?>

                    <?php endfor;?>
                    <!-- bloqueando el boton de siguiente cuando se llega a la ultima pagina -->
                    <?php if ($parameters['respuesta']['pagina_actual'] ==  $parameters['respuesta']['totalPaginas'] || $parameters['respuesta']['error'] == 1) :?>
                    <li class="disabled">&raquo;</li>
                    <?php elseif ($parameters['respuesta']['pagina_actual'] <  $parameters['respuesta']['totalPaginas'] || $parameters['respuesta']['error'] == null):?>
                    <a class="fin"
                        href="<?php echo ROUTE_URL.'/asistencias'?>/<?php echo $parameters['respuesta']['pagina_siguiente']?>/<?php echo $var = ($parameters['busqueda'] != null)?'/'.str_replace(' ', '_',$parameters['busqueda']): ''?>">&raquo;</a>
                    <?php endif;?>  
		        </ul> 
	        </section>
        </main>
    </div>
</div>

<!-- llamar archivo js -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"
    integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="<?php echo ROUTE_URL?>/js/menu.js"></script>
	        

    </body>
</html>