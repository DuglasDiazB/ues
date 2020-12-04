<?php require_once('../app/views/inc/header.php'); ?>
<p> <a href="<?php echo $parameters['regresar']?>"><i class="fas fa-arrow-circle-left" style=" color: #1236da;"></i>Regresar</a></p>
            <table>
	            <thead>
			        <tr>
				    <!-- colspan="Numero de columnas que tendra la tabla" -->
                        <th colspan="8">
                        <div class="title">
                            <p>Establecimientos, se <?php echo $var = ($parameters['respuesta']['cuantos'] > 1)?'encontraron ':' encontro '?>
                            <?php echo $parameters['respuesta']['cuantos']. $var = ($parameters['respuesta']['cuantos'] > 1)?' registros':' registro'?>
                            </p>
                            <p>
                                <?php if ($parameters['busqueda'] != null):?>
                                    <a href="<?php echo ROUTE_URL?>/inspecciones/inspeccionEstablecimiento" class="btn-editar"><i
                                        class="fas fa-redo"></i>Recargar</a>
                                <?php endif?>
                            </p>
                        </div>
   	 		        </tr>

			        <tr style= "background: #dbdfe4;">
				        <!-- Se debe ajustar el ancho de las tablas -->
				        <th width="5">#</th>
                        <th>Establecimiento</th>
                        <th>Propietario</th>
                        <th>Telefono</th>
                        <th>Direccion</th>
                        <th>Tipo</th>
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
			        <?php for($i = 0; $i < count($parameters['establecimientos']); $i ++):?>
                    <tr>
                        <td data-label="#">
                            <?php echo $parameters['respuesta']['numIds'][$i] + 1?> 
                        </td>

                        <td data-label="Establecimiento">
                            <?php echo $parameters['establecimientos'][$i]->nombre_estab?>
                        </td>

                        <td data-label="Propietario">
                        <?php echo $parameters['establecimientos'][$i]->nombre_prop.' '.$parameters['establecimientos'][$i]->apellido_prop?>
                        </td>

                        <td data-label="Telefono">
                            <?php echo $parameters['establecimientos'][$i]->telefono_estab?>
                        </td>

                        <td data-label="Direccion">
                            <?php echo $parameters['establecimientos'][$i]->direccion_estab?>
                        </td>

                        <td data-label="Tipo">
                            <?php echo $parameters['establecimientos'][$i]->tipo_estab?>
                        </td>
           
                        <td data-label="Opciones">
                        <!-- <a href="javascript:editarUsu()" class="btn-nuevo"><i class="far fa-edit"></i></a> -->
                        <!--controlador/metodo ... echo=si se envia parameters usuarios hace una pleca -->
                            <a href="<?php echo ROUTE_URL?>/inspecciones/nuevaInspeccion<?php echo $var=(isset($parameters['establecimientos']))? '/'.$parameters['establecimientos'][$i]->id_estab:''?>" class="btn-ver"><i
                                class="far fa-plus-square"></i>
                                    agregar</a>
                            <!-- <a href="<?php echo ROUTE_URL?>/inspecciones/inspeccionesDesactivados" class="btn-desactivar"><i 
                                class="fas fa-store-slash"></i></a> -->
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
                    href="<?php echo ROUTE_URL.'/inspecciones/inspeccionEstablecimiento'?>/<?php echo $parameters['respuesta']['pagina_anterior']?>/<?php echo $var = ($parameters['busqueda'] != null)?'/'.$parameters['busqueda']: ''?>">&laquo;</a>
                    <?php endif;?> 

                    <!-- Estableciendo numero de paginas -->


                    <?php for ($i=1; $i <= $parameters['respuesta']['totalPaginas']; $i++):?>

                    <?php if ($parameters['respuesta']['pagina_actual'] == $i):?>

                    <li class="Active">
                    <a href="<?php echo ROUTE_URL.'/inspecciones/inspeccionEstablecimiento'?>/<?php echo $i?>"><?php echo $i?></a>
                    <!-- controlador, metodo, parametros  -->
                    </li>
                    <?php else:?>

                    <li>
                        <a href="<?php echo ROUTE_URL.'/inspecciones/inspeccionEstablecimiento'?>/<?php echo $i?>"><?php echo $i?></a>
                    </li>

        
                    <?php endif?>

                    <?php endfor;?>
                    <!-- bloqueando el boton de siguiente cuando se llega a la ultima pagina -->
                    <?php if ($parameters['respuesta']['pagina_actual'] ==  $parameters['respuesta']['totalPaginas'] || $parameters['respuesta']['error'] == 1) :?>
                    <li class="disabled">&raquo;</li>
                    <?php elseif ($parameters['respuesta']['pagina_actual'] <  $parameters['respuesta']['totalPaginas'] || $parameters['respuesta']['error'] == null):?>
                    <a class="fin"
                        href="<?php echo ROUTE_URL.'/inspecciones/inspeccionEstablecimiento'?>/<?php echo $parameters['respuesta']['pagina_siguiente']?>/<?php echo $var = ($parameters['busqueda'] != null)?'/'.$parameters['busqueda']: ''?>">&raquo;</a>
                    <?php endif;?>  
		        </ul> 
	        </section>
	        
<?php require_once('../app/views/inc/footer.php'); ?>