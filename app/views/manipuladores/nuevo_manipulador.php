<!-- Llamando el header -->
<?php require_once('../app/views/inc/header.php'); ?>
<!-- Agregar boton regresar y mensaje-->
<p><a href="<?php echo $parameters['regresar']?>"><i class="fas fa-arrow-circle-left" style=" color: #1236da;"></i> Regresar</a></p>    
<br>
<p><?php echo $parameters['mensaje']?></p>
<div class="caja">
    <div class="contact-wrapper animated bounceInUp">
        <div class="contact-form">
            <div class="encabezado">
                <h3>Nuevo Manipulador</h3>
                <i class="fas fa-hand-paper" aria-hidden="true"></i>
            </div>
            
            <form action="<?php echo ROUTE_URL?>/manipuladores/nuevoManipulador" method= "post" id="form-manipulador" class="form">
                <!-- Clase que contiene tred div para ponerlos en una sola linea los tres  --> 





                <div class="form-control <?php echo $var = (isset($parameters['errores']['nombremanip']['form-control']))?$parameters['errores']['nombremanip']['form-control']:''?>">
                    <label for="nombremanip">Nombre</label>
                    <input onkeypress = " return soloLetras(event)" type="text" id="nombremanip" name="nombremanip" value="<?php echo $var = (isset($parameters['errores']['nombremanip']['text']))?$parameters['errores']['nombremanip']['text']:''?>">
                    <i class="fas fa-check-circle"></i>
                    <i class="fas fa-exclamation-circle"></i>
                    <?php if ($parameters['errores']): ?>
                        <small><?php echo $var = (isset($parameters['errores']['nombremanip']['small']))?$parameters['errores']['nombremanip']['small']:''?></small>
                    <?php endif ?>
                    <small></small>
                </div>






                <div class="form-control <?php echo $var = (isset($parameters['errores']['apellidomanip']['form-control']))?$parameters['errores']['apellidomanip']['form-control']:''?>">
                    <label for="apellidomanip">Apellido</label>
                    <input onkeypress = " return soloLetras(event)" type="text" id="apellidomanip" name='apellidomanip' value="<?php echo $var = (isset($parameters['errores']['apellidomanip']['text']))?$parameters['errores']['apellidomanip']['text']:''?>"> 
                    <i class="fas fa-check-circle"></i>
                    <i class="fas fa-exclamation-circle"></i>
                    <?php if ($parameters['errores']): ?>
                        <small><?php echo $var = (isset($parameters['errores']['apellidomanip']['small']))?$parameters['errores']['apellidomanip']['small']:''?></small>
                    <?php endif ?>
                    <small></small>
                </div>



                <div class="form-control <?php echo $var = (isset($parameters['errores']['duimanip']['form-control']))?$parameters['errores']['duimanip']['form-control']:''?>">
                    <label for="duimanip">DUI</label> 
                    <input id="duimanip" type="text" name="duimanip" value="<?php echo $var = (isset($parameters['errores']['duimanip']['text']))?$parameters['errores']['duimanip']['text']:''?>"> 
                    <i class="fas fa-check-circle"></i>
                    <i class="fas fa-exclamation-circle"></i>
                    <?php if ($parameters['errores']): ?>
                        <small><?php echo $var = (isset($parameters['errores']['duimanip']['small']))?$parameters['errores']['duimanip']['small']:''?></small>
                    <?php endif ?>
                    <small></small>
                </div>

                <div class="form-control <?php echo $var = (isset($parameters['errores']['puestomanip']['form-control']))?$parameters['errores']['puestomanip']['form-control']:''?>">
                    <label for="puestomanip">Puesto</label>
                    <input onkeypress = " return soloLetras(event)" type="text" id="apellidomanip" name='puestomanip' value="<?php echo $var = (isset($parameters['errores']['puestomanip']['text']))?$parameters['errores']['puestomanip']['text']:''?>"> 
                    <i class="fas fa-check-circle"></i>
                    <i class="fas fa-exclamation-circle"></i>
                    <?php if ($parameters['errores']): ?>
                        <small><?php echo $var = (isset($parameters['errores']['puestomanip']['small']))?$parameters['errores']['puestomanip']['small']:''?></small>
                    <?php endif ?>
                    <small></small>
                </div>




                <div class="form-control">
                    <!-- crear CheckBox -->
                    <label for="generomanip">Genero</label> 
                    <select id="generomanip" name="generomanip"> 
                        <option value="1" <?php if($parameters['errores'] != []){echo $var = ($parameters['errores']['generomanip'] == 1)? 'selected': '';}?>>Hombre</option> 
                        <option value="2" <?php if($parameters['errores'] != []){echo $var = ($parameters['errores']['generomanip'] == 2)? 'selected': '';}?>>Mujer</option> 
                    </select>
                </div>




                <div class="form-control" style="display: none">
                    <!-- crear CheckBox -->
                    <label for="asistencia_check">Asistencia</label> 
                    <select id="asistencia_check" displayname="asistencia_check"> 
                        <option value="Si" <?php if($parameters['errores'] != []){echo $var = ($parameters['errores']['asistencia_check'] == 1)? 'selected': '';}?>>Si</option> 
                        <option value="No" <?php if($parameters['errores'] != []){echo $var = ($parameters['errores']['asistencia_check'] == 2)? 'selected': '';}?>>No</option> 
                    </select>
                </div>


                <div class="form-control">
                    <!-- crear CheckBox -->
                    <label for="id_estab">Establecimiento</label> 
                    <select id="id_estab" name="id_estab"> 
                        <?php foreach ($parameters['establecimiento'] as $key => $establecimiento): ?>

                           <option value="<?php echo $establecimiento->id_estab?>">

                            <?php echo $establecimiento->nombre_estab.', '.$establecimiento->direccion_estab;?>

                        </option> 

                    <?php endforeach?>
                    
                </select>
            </div>






                <div class="form-control <?php echo $var = (isset($parameters['errores']['fechaNacimiento']['form-control']))?$parameters['errores']['fechaNacimiento']['form-control']:''?>">
                    <label for="fechaNacimiento">Fecha de Nacimiento</label>
                    <input type="date" id="fechaNacimiento" name='fechaNacimiento' value="<?php echo $var = (isset($parameters['errores']['fechaNacimiento']['text']))?$parameters['errores']['fechaNacimiento']['text']:''?>">
                    <i class="fas fa-check-circle"></i>
                    <i class="fas fa-exclamation-circle"></i>
                    <?php if ($parameters['errores']): ?>
                        <small><?php echo $var = (isset($parameters['errores']['fechaNacimiento']['small']))?$parameters['errores']['fechaNacimiento']['small']:''?></small>
                    <?php endif ?>
                    <small></small>
                </div>



          










                

                






                <br>

                <!--Clase boton para los estilos   --> 
                <div class="boton"> 
                    <!-- Boton de guardar --> 
                    <input id="submit" type="submit" name="submit" value="Guardar"> 
                </div>
            </form>
        </div>
    </div>
</div> 

<!-- Llamando el footer -->
<?php require_once('../app/views/inc/footer.php'); ?>

