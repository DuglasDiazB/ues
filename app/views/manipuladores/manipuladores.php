<?php require_once('../app/views/inc/header.php'); ?>

<table>
   <thead>
     <tr>
        <!-- colspan="Numero de columnas que tendra la tabla" -->
        <th colspan="8">
            <div class="title">
                <p>Manipuladores, se <?php echo $var = ($parameters['respuesta']['cuantos'] > 1)?'encontraron ':' encontro '?>
                <?php echo $parameters['respuesta']['cuantos']. $var = ($parameters['respuesta']['cuantos'] > 1)?' registros':' registro'?>
            </p>


          



            <p>
                <?php if ($parameters['busqueda'] != null):?>
                    <a href="<?php echo ROUTE_URL?>/manipuladores" class="btn-editar"><i
                        class="fas fa-redo"></i>Recargar</a>
                            <?php endif?>

                    <a href="<?php echo ROUTE_URL?>/manipuladores/nuevoManipulador" class="btn-ver"><i
                        class="far fa-plus-square"></i>
                    Nuevo</a>

                  

                    <a href="<?php echo ROUTE_URL?>/manipuladores/manipuladoresDesactivados" class="btn-desactivar">
                    <i class="fas fa-times"></i> Desactivados</a>

                </p>
            </div>
        </tr>

        <tr style= "background: #dbdfe4;">
            <!-- Se debe ajustar el ancho de las tablas -->
            <th width="5">#</th>
            <th>Nombre</th>
            <th>Dui</th>
            <th>Puesto</th>
            <th>Estado</th>
            <th>Establecimiento</th>
            <th>Sector</th>
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
             <?php for($i = 0; $i < count($parameters['manipuladores']); $i ++):?>
                <tr>
                    <td data-label="#">
                        <?php echo $parameters['respuesta']['numIds'][$i] + 1?> 
                    </td>

                    <td data-label="Nombre">
                        <?php echo $parameters['manipuladores'][$i]->nombre_manip.' '.$parameters['manipuladores'][$i]->apellido_manip?>
                    </td>

                    <td data-label="Dui">
                        <?php echo $parameters['manipuladores'][$i]->dui_manip?>
                    </td>

                    <td data-label="Puesto">
                        <?php echo $parameters['manipuladores'][$i]->puesto_manip?>
                    </td>

                    <td data-label="Estado">
                        <?php echo $parameters['manipuladores'][$i]->estado_manip?>
                    </td>

                     <td data-label="Establecimiento">
                        <?php echo $parameters['manipuladores'][$i]->nombre_estab?>
                    </td>

                    <td data-label="Establecimiento">
                        <?php echo $parameters['manipuladores'][$i]->tipo_estab?>
                    </td>

                    <td data-label="Opciones">
                        <!-- <a href="javascript:editarUsu()" class="btn-nuevo"><i class="far fa-edit"></i></a> -->
                        <!--controlador/metodo ... echo=si se envia parameters inspecciones hace una pleca -->
                        <!--<a href="<?php echo ROUTE_URL?>/manipuladores/verManipulador<?php echo $var=(isset($parameters['manipuladores']))? '/'.$parameters['manipuladores'][$i]->id_manip.'/'.$parameters['respuesta']['pagina_actual'] . '/' . $parameters['busqueda']:''?>"
                            class="btn-ver"><i class="fas fa-eye"></i></a>-->

                            <a href="<?php echo ROUTE_URL?>/manipuladores/verManipulador<?php echo $var=(isset($parameters['manipuladores']))? '/'.$parameters['manipuladores'][$i]->id_manip.'/'.$parameters['respuesta']['pagina_actual'] . '/' .'Activo/'.$parameters['busqueda']:''?>"
                                class="btn-ver"><i class="fas fa-eye"></i></a>

                            <a href="<?php echo ROUTE_URL?>/manipuladores/actualizarManipulador<?php echo $var=(isset($parameters['manipuladores']))? '/'.$parameters['manipuladores'][$i]->id_manip.'/'.$parameters['respuesta']['pagina_actual'] . '/' . $parameters['busqueda']:''?>"
                                class="btn-editar"><i class="far fa-edit"></i></a>



                                <a href="<?php echo ROUTE_URL.'/manipuladores/index'?>/<?php echo $parameters['respuesta']['pagina_actual']?><?php echo $var=(isset($parameters['manipuladores']))? '/'.$parameters['manipuladores'][$i]->id_manip:''?>/<?php echo 0?><?php echo $var = ($parameters['busqueda'] != null)?'/'.str_replace(' ', '_',$parameters['busqueda']): ''?>"
                                    class="btn-desactivar"><i class="far fa-trash-alt"></i></a>  




                     
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
                            href="<?php echo ROUTE_URL.'/manipuladores'?>/<?php echo $parameters['respuesta']['pagina_anterior']?>/<?php echo 0?>/<?php echo 0?><?php echo $var = ($parameters['busqueda'] != null)?'/'.str_replace(' ', '_',$parameters['busqueda']): ''?>">&laquo;</a>
                        <?php endif;?> 

                        <!-- Estableciendo numero de paginas -->


                        <?php for ($i=1; $i <= $parameters['respuesta']['totalPaginas']; $i++):?>

                            <?php if ($parameters['respuesta']['pagina_actual'] == $i):?>

                                <li class="Active">
                                    <a href="<?php echo ROUTE_URL.'/manipuladores'?>/<?php echo $i?>/<?php echo 0?>/<?php echo 0?><?php echo $var = ($parameters['busqueda'] != null)?'/'.str_replace(' ', '_',$parameters['busqueda']): ''?>"><?php echo $i?></a>
                                </li>


                                <?php else:?>

                                    <li>
                                        <a href="<?php echo ROUTE_URL.'/manipuladores'?>/<?php echo $i?>/<?php echo 0?>/<?php echo 0?><?php echo $var = ($parameters['busqueda'] != null)?'/'.str_replace(' ', '_',$parameters['busqueda']): ''?>"><?php echo $i?></a>
                                    </li>


                                <?php endif?>

                            <?php endfor;?>
                            <!-- bloqueando el boton de siguiente cuando se llega a la ultima pagina -->
                            <?php if ($parameters['respuesta']['pagina_actual'] ==  $parameters['respuesta']['totalPaginas'] || $parameters['respuesta']['error'] == 1) :?>
                                <li class="disabled">&raquo;</li>
                                <?php elseif ($parameters['respuesta']['pagina_actual'] <  $parameters['respuesta']['totalPaginas'] || $parameters['respuesta']['error'] == null):?>
                                    <a class="fin"
                                    href="<?php echo ROUTE_URL.'/manipuladores'?>/<?php echo $parameters['respuesta']['pagina_siguiente']?>/<?php echo 0?>/<?php echo 0?><?php echo $var = ($parameters['busqueda'] != null)?'/'.str_replace(' ', '_',$parameters['busqueda']): ''?>">&raquo;</a>
                                <?php endif;?> 
                            </ul>


                        </section>





                    </body>
                    </html>


             </main>

</div>
</div>

<!-- Eliminar -->
<?php if($parameters['manipulador']):?>
<div class="box" id="eliminar-manipulador">

    <div class="encabezado">

        <h3 style='color:#f50b0b; font-size: 20px;'><i class="fas fa-user-slash"></i></h3>
    </div>

    <div class="cuerpo">
        <h4>¿Desea desactivar el manipulador?</h4>
        <h3 style="color:white">
            <?php echo $parameters['manipulador']->nombre_manip .' '.$parameters['manipulador']->apellido_manip?></h3>

    </div>

    <div class="pie">

        <div class="aceptar">

            <a href="<?php echo ROUTE_URL.'/manipuladores/index'?>/<?php echo $parameters['respuesta']['pagina_actual']?>/<?php echo $var=(isset($parameters['manipulador']))? $parameters['manipulador']->id_manip:''?>/<?php echo 1?><?php echo $var = ($parameters['busqueda'] != null)?'/'.str_replace(' ', '_',$parameters['busqueda']): ''?>"
                class="btn-editar"><i class="fas fa-check"></i></a>

        </div>

        <div class="aceptar">

            <a href="javascript:cerrarManipulador()" class="btn-desactivar"><i class="fas fa-times"></i></a>

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


<?php if($parameters['manipulador']):?>
<script>
document.getElementById('eliminar-manipulador').style.display = "block";
display = document.querySelector("#blur");
display.classList.toggle('active');
</script>
<?php endif?>  


</body>

</html>      