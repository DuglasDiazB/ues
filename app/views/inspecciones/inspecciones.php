<?php require_once('../app/views/inc/header.php'); ?>

<table>
    <thead>
        <tr>
                <!-- colspan="Numero de columnas que tendra la tabla" -->
            <th colspan="8">
                <div class="title">
                    <p>Lista de inspecciones, se <?php echo $var = ($parameters['respuesta']['cuantos'] > 1)?'encontraron ':' encontro '?>
                        <?php echo $parameters['respuesta']['cuantos']. $var = ($parameters['respuesta']['cuantos'] > 1)?' registros':' registro'?>
                    </p>
                    <p>
                        <?php if ($parameters['busqueda'] != null):?>
                            <a href="<?php echo ROUTE_URL?>/inspecciones" class="btn-editar"><i class="fas fa-redo"></i>Recargar</a>
                        <?php endif?>
                            <a href="<?php echo ROUTE_URL?>/inspecciones/establecimientosDesactivados" class="btn-desactivar">Desactivados</a>
                            <a href="<?php echo ROUTE_URL?>/inspecciones/inspeccionEstablecimiento" class="btn-ver"><i class="far fa-plus-square"></i>Establecimientos</a>
                    </p>
                </div>
            </tr>

        <tr style= "background: #dbdfe4;">
                    <!-- Se debe ajustar el ancho de las tablas -->
            <th width="5">#</th>
            <th>Establecimiento</th>
            <th>Inspeccion</th>
            <th>Fecha_insp</th>
            <th>Objeto</th>
            <th>Inspector</th>
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
            <?php for($i = 0; $i < count($parameters['inspecciones']); $i ++):?>
                <tr>
                    <td data-label="#">
                        <?php echo $parameters['respuesta']['numIds'][$i] + 1?> 
                    </td>

                    <td data-label="Establecimiento">
                        <?php echo $parameters['inspecciones'][$i]->nombre_estab?>
                    </td>

                    <td data-label="Inspeccion">
                        <?php echo $parameters['inspecciones'][$i]->inspec_para?>
                    </td>

                    <td data-label="Fecha_insp">
                        <?php echo $parameters['inspecciones'][$i]->fecha_inspec?>
                    </td>

                    <td data-label="Objeto">
                        <?php echo $parameters['inspecciones'][$i]->objeto_visita?>
                    </td>

                    <td data-label="Inspector">
                        <?php echo $parameters['inspecciones'][$i]->nombre_inspector?>
                    </td>
       
                    <td data-label="Opciones">
                        <!-- <a href="javascript:editarUsu()" class="btn-nuevo"><i class="far fa-edit"></i></a> -->
                        <!--controlador/metodo ... echo=si se envia parameters inspecciones hace una pleca -->
                        <a href="<?php echo ROUTE_URL?>/inspecciones/verInspeccion<?php echo $var=(isset($parameters['inspecciones']))? '/'.$parameters['inspecciones'][$i]->id_inspec.'/'.$parameters['respuesta']['pagina_actual']:''?><?php echo $var = ($parameters['busqueda'] != null)?'/'.str_replace(' ', '_',$parameters['busqueda']): ''?>"
                            class="btn-ver"><i class="fas fa-eye"></i></a>
                        
                            <a href="<?php echo ROUTE_URL?>/inspecciones/verInspeccion<?php echo $var=(isset($parameters['inspecciones']))? '/'.$parameters['inspecciones'][$i]->id_inspec.'/'.$parameters['respuesta']['pagina_actual']:''?><?php echo $var = ($parameters['busqueda'] != null)?'/'.str_replace(' ', '_',$parameters['busqueda']): ''?>"
                            class="btn-editar"><i class="far fa-edit"></i></a>
                        
                    </td>
                </tr>
            <?php endfor?>
        <?php endif;?>
    </tbody>
</table>

<section class="paginacion">
    <ul>
        <?php if ($parameters['respuesta']['pagina_actual'] ==  1 || $parameters['respuesta']['error'] == 1) :?>
            
            <li class="disabled">&laquo;</li>

        <?php elseif ($parameters['respuesta']['pagina_actual'] >  1 || $parameters['respuesta']['error'] == null):?>
            
            <a class="inicio" href="<?php echo ROUTE_URL.'/inspecciones'?>/<?php echo $parameters['respuesta']['pagina_anterior']?><?php echo $var = ($parameters['busqueda'] != null)?'/'.str_replace(' ', '_',$parameters['busqueda']): ''?>">&laquo;</a>
        
        <?php endif;?> 
                
        <?php for ($i=1; $i <= $parameters['respuesta']['totalPaginas']; $i++):?>

            <?php if ($parameters['respuesta']['pagina_actual'] == $i):?>

                <li class="Active">
                    <a href="<?php echo ROUTE_URL.'/inspecciones'?>/<?php echo $i?><?php echo $var = ($parameters['busqueda'] != null)?'/'.str_replace(' ', '_',$parameters['busqueda']): ''?>"><?php echo $i?></a>
                
                </li>
            <?php else:?>

                <li>
                    <a href="<?php echo ROUTE_URL.'/inspecciones'?>/<?php echo $i?><?php echo $var = ($parameters['busqueda'] != null)?'/'.str_replace(' ', '_',$parameters['busqueda']): ''?>"><?php echo $i?></a>
                </li>

            <?php endif?>

        <?php endfor;?>
                <!-- bloqueando el boton de siguiente cuando se llega a la ultima pagina -->
        <?php if ($parameters['respuesta']['pagina_actual'] ==  $parameters['respuesta']['totalPaginas'] || $parameters['respuesta']['error'] == 1) :?>
            <li class="disabled">&raquo;</li>
        <?php elseif ($parameters['respuesta']['pagina_actual'] <  $parameters['respuesta']['totalPaginas'] || $parameters['respuesta']['error'] == null):?>
            <a class="fin" href="<?php echo ROUTE_URL.'/inspecciones'?>/<?php echo $parameters['respuesta']['pagina_siguiente']?>/<?php echo $var = ($parameters['busqueda'] != null)?'/'.str_replace(' ', '_',$parameters['busqueda']): ''?>">&raquo;</a>
        
        <?php endif;?>  
    </ul> 
</section>
<?php require_once('../app/views/inc/footer.php'); ?>