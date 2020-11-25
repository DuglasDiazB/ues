<?php require_once('../app/views/inc/header.php'); ?>

            <table>
	            <thead>
			        <tr>
				    <!-- colspan="Numero de columnas que tendra la tabla" -->
                        <th colspan="8">
                        <div class="title">
                            <p>Lista de bitacoras, se <?php echo $var = ($parameters['respuesta']['cuantos'] > 1)?'encontraron ':' encontro '?>
                            <?php echo $parameters['respuesta']['cuantos']. $var = ($parameters['respuesta']['cuantos'] > 1)?' registros':' registro'?>
                            </p>

                             <p>
                                <?php if ($parameters['busqueda'] != null):?>
                                <a href="<?php echo ROUTE_URL?>/bitacoras" class="btn-editar"><i
                                    class="fas fa-redo"></i>Recargar</a>
                                    <?php endif?>
                            </p>
                        </div>
   	 		        </tr>

			        <tr style= "background: #dbdfe4;">
				        <!-- Se debe ajustar el ancho de las tablas -->
				        <th width="5">#</th>
                        <th>Uri</th>
                        <th>Metodo</th>
                        <th>Direccion_ip</th>
                        <th>Usuario</th>
                        <th>Fecha</th>
                        <th>Respuesta</th>
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
                
                    </tr>
                    <!-- si se encuentran registros -->
                    <?php else:?>
			        <?php for($i = 0; $i < count($parameters['bitacoras']); $i ++):?>
                    <tr>
                        <td data-label="#">
                            <?php echo $parameters['respuesta']['numIds'][$i] + 1?> 
                        </td>

                        <td data-label="Uri">
                            <?php echo $parameters['bitacoras'][$i]->uri?>
                        </td>

                        <td data-label="Metodo">
                            <?php echo $parameters['bitacoras'][$i]->metodo?>
                        </td>

                        <td data-label="Direccion_ip">
                            <?php echo $parameters['bitacoras'][$i]->direccion_ip?>
                        </td>

                        <td data-label="Usuario">
                            <?php echo $parameters['bitacoras'][$i]->usuario_log?>
                        </td>
                        

                        <td data-label="Fecha">
                            <?php echo $parameters['bitacoras'][$i]->fecha_log?>
                        </td>

                        <td data-label="Respuesta">
                            <?php echo $parameters['bitacoras'][$i]->respuesta_log?>
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
                    href="<?php echo ROUTE_URL.'/bitacoras'?>/<?php echo $parameters['respuesta']['pagina_anterior']?><?php echo $var = ($parameters['busqueda'] != null)?'/'.str_replace(' ', '_',$parameters['busqueda']): ''?>">&laquo;</a>
                    <?php endif;?> 

                    <!-- Estableciendo numero de paginas -->


                    <?php for ($i=1; $i <= $parameters['respuesta']['totalPaginas']; $i++):?>

                    <?php if ($parameters['respuesta']['pagina_actual'] == $i):?>

                    <li class="Active">
                    <a href="<?php echo ROUTE_URL.'/bitacoras'?>/<?php echo $i?><?php echo $var = ($parameters['busqueda'] != null)?'/'.str_replace(' ', '_',$parameters['busqueda']): ''?>"><?php echo $i?></a>
                    <!-- controlador, metodo, parametros  -->
                    </li>
                    <?php else:?>

                    <li>
                        <a href="<?php echo ROUTE_URL.'/bitacoras'?>/<?php echo $i?><?php echo $var = ($parameters['busqueda'] != null)?'/'.str_replace(' ', '_',$parameters['busqueda']): ''?>"><?php echo $i?></a>
                    </li>

        
                    <?php endif?>

                    <?php endfor;?>
                    <!-- bloqueando el boton de siguiente cuando se llega a la ultima pagina -->
                    <?php if ($parameters['respuesta']['pagina_actual'] ==  $parameters['respuesta']['totalPaginas'] || $parameters['respuesta']['error'] == 1) :?>
                    <li class="disabled">&raquo;</li>
                    <?php elseif ($parameters['respuesta']['pagina_actual'] <  $parameters['respuesta']['totalPaginas'] || $parameters['respuesta']['error'] == null):?>
                    <a class="fin"
                        href="<?php echo ROUTE_URL.'/bitacoras'?>/<?php echo $parameters['respuesta']['pagina_siguiente']?>/<?php echo $var = ($parameters['busqueda'] != null)?'/'.str_replace(' ', '_',$parameters['busqueda']): ''?>">&raquo;</a>
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