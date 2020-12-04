<!-- Llamando el header -->
<?php require_once('../app/views/inc/header.php'); ?>
<!-- Agregar boton regresar y mensaje-->
<p><a href="<?php echo $parameters['regresar']?>"><i class="fas fa-arrow-circle-left" style=" color: #1236da;"></i> Regresar</a></p>    
<br>
<p><?php echo $parameters['mensaje']?></p>
    <div class="caja">
        <div class="contact-wrapper animated bounceInUp">
            <div  class="contact-form">
                <div class="encabezado">
                    <h3>Actualizar Establecimiento</h3>
                    <i class="fas fa-store"></i>
                </div>
                
                <form action="<?php echo ROUTE_URL?>/establecimientos/actualizarEstablecimiento/<?php echo $parameters['establecimiento']?>" method= "post" id="form-establecimiento" class="form">



                      <div class="form-control" style="display: none">
                        <label for="regresar"></label> 
                        <input type="text" name="regresar" value="<?php echo $var = (isset($parameters['regresar']))?$parameters['regresar']:''?>"> 
                        <i class="fas fa-check-circle"></i>
                        <i class="fas fa-exclamation-circle"></i>
                        <small></small>
                    </div>



                     <div class="form-control <?php echo $var = (isset($parameters['errores']['nombre_estab']['form-control']))?$parameters['errores']['nombre_estab']['form-control']:''?>">
                    <label for="nombre_estab">Establecimiento</label>
                    <input onkeypress = " return soloLetras(event)" type="text" id="nombre_estab" name="nombre_estab" value="<?php echo $var = (isset($parameters['errores']['nombre_estab']['text']))?$parameters['errores']['nombre_estab']['text']:''?>">
                    <i class="fas fa-check-circle"></i>
                    <i class="fas fa-exclamation-circle"></i>
                    <?php if ($parameters['errores']): ?>
                        <small><?php echo $var = (isset($parameters['errores']['nombre_estab']['small']))?$parameters['errores']['nombre_estab']['small']:''?></small>
                    <?php endif ?>
                    <small></small>
                </div>



                <div class="form-control <?php echo $var = (isset($parameters['errores']['nombre_prop']['form-control']))?$parameters['errores']['nombre_prop']['form-control']:''?>">
                    <label for="nombre_prop">Nombre Propietario</label>
                    <input onkeypress = " return soloLetras(event)" type="text" id="nombre_prop" name="nombre_prop" value="<?php echo $var = (isset($parameters['errores']['nombre_prop']['text']))?$parameters['errores']['nombre_prop']['text']:''?>">
                    <i class="fas fa-check-circle"></i>
                    <i class="fas fa-exclamation-circle"></i>
                    <?php if ($parameters['errores']): ?>
                        <small><?php echo $var = (isset($parameters['errores']['nombre_prop']['small']))?$parameters['errores']['nombre_prop']['small']:''?></small>
                    <?php endif ?>
                    <small></small>
                </div>



                <div class="form-control <?php echo $var = (isset($parameters['errores']['apellido_prop']['form-control']))?$parameters['errores']['apellido_prop']['form-control']:''?>">
                    <label for="apellido_prop">Apellido Prop</label>
                    <input onkeypress = " return soloLetras(event)" type="text" id="apellido_prop" name="apellido_prop" value="<?php echo $var = (isset($parameters['errores']['apellido_prop']['text']))?$parameters['errores']['apellido_prop']['text']:''?>">
                    <i class="fas fa-check-circle"></i>
                    <i class="fas fa-exclamation-circle"></i>
                    <?php if ($parameters['errores']): ?>
                        <small><?php echo $var = (isset($parameters['errores']['apellido_prop']['small']))?$parameters['errores']['apellido_prop']['small']:''?></small>
                    <?php endif ?>
                    <small></small>
                </div>




                <div class="form-control <?php echo $var = (isset($parameters['errores']['dui_prop']['form-control']))?$parameters['errores']['dui_prop']['form-control']:''?>">
                    <label for="dui_prop">DUI</label>
                    <input onkeypress = " return soloLetras(event)" type="text" id="dui_prop" name="dui_prop" value="<?php echo $var = (isset($parameters['errores']['dui_prop']['text']))?$parameters['errores']['dui_prop']['text']:''?>">
                    <i class="fas fa-check-circle"></i>
                    <i class="fas fa-exclamation-circle"></i>
                    <?php if ($parameters['errores']): ?>
                        <small><?php echo $var = (isset($parameters['errores']['dui_prop']['small']))?$parameters['errores']['dui_prop']['small']:''?></small>
                    <?php endif ?>
                    <small></small>
                </div>



                <div class="form-control <?php echo $var = (isset($parameters['errores']['direccion_estab']['form-control']))?$parameters['errores']['direccion_estab']['form-control']:''?>">
                    <label for="direccion_estab">Direccion</label>
                    <input onkeypress = " return soloLetras(event)" type="text" id="direccion_estab" name="direccion_estab" value="<?php echo $var = (isset($parameters['errores']['direccion_estab']['text']))?$parameters['errores']['direccion_estab']['text']:''?>">
                    <i class="fas fa-check-circle"></i>
                    <i class="fas fa-exclamation-circle"></i>
                    <?php if ($parameters['errores']): ?>
                        <small><?php echo $var = (isset($parameters['errores']['direccion_estab']['small']))?$parameters['errores']['direccion_estab']['small']:''?></small>
                    <?php endif ?>
                    <small></small>
                </div>




                <div class="form-control <?php echo $var = (isset($parameters['errores']['cat_estab']['form-control']))?$parameters['errores']['cat_estab']['form-control']:''?>">
                    <label for="cat_estab">Categoria</label>
                    <input onkeypress = " return soloLetras(event)" type="text" id="cat_estab" name="cat_estab" value="<?php echo $var = (isset($parameters['errores']['cat_estab']['text']))?$parameters['errores']['cat_estab']['text']:''?>">
                    <i class="fas fa-check-circle"></i>
                    <i class="fas fa-exclamation-circle"></i>
                    <?php if ($parameters['errores']): ?>
                        <small><?php echo $var = (isset($parameters['errores']['cat_estab']['small']))?$parameters['errores']['cat_estab']['small']:''?></small>
                    <?php endif ?>
                    <small></small>
                </div>


                <div class="form-control">
                    <!-- crear CheckBox -->
                    <label for="tipo_estab">Tipo</label> 
                    <select id="tipo_estab" name="tipo_estab"> 
                        <option value="Formal" <?php if($parameters['errores'] != []){echo $var = ($parameters['errores']['tipo_estab'] == "Formal")? 'selected': '';}?>>Formal</option> 
                        <option value="Informal" <?php if($parameters['errores'] != []){echo $var = ($parameters['errores']['tipo_estab'] == "Informal")? 'selected': '';}?>>Informal</option> 
                    </select>
                </div>





               <div class="form-control">
                    <!-- crear CheckBox -->
                    <label for="apartado_especifico">Aprtado esp</label> 
                    <select id="apartado_especifico" name="apartado_especifico"> 
                        <option value="A" <?php if($parameters['errores'] != []){echo $var = ($parameters['errores']['apartado_especifico'] == "A")? 'selected': '';}?>>A</option> 
                        <option value="B" <?php if($parameters['errores'] != []){echo $var = ($parameters['errores']['apartado_especifico'] == "B")? 'selected': '';}?>>B</option> 

                          <option value="C" <?php if($parameters['errores'] != []){echo $var = ($parameters['errores']['apartado_especifico'] == "C")? 'selected': '';}?>>C</option> 

                                <option value="D" <?php if($parameters['errores'] != []){echo $var = ($parameters['errores']['apartado_especifico'] == "D")? 'selected': '';}?>>D</option> 
                    </select>
                </div>





                <div class="form-control <?php echo $var = (isset($parameters['errores']['telefono_estab']['form-control']))?$parameters['errores']['telefono_estab']['form-control']:''?>">
                    <label for="telefono_estab">Telefono</label>
                    <input onkeypress = " return soloLetras(event)" type="text" id="telefono_estab" name="telefono_estab" value="<?php echo $var = (isset($parameters['errores']['telefono_estab']['text']))?$parameters['errores']['telefono_estab']['text']:''?>">
                    <i class="fas fa-check-circle"></i>
                    <i class="fas fa-exclamation-circle"></i>
                    <?php if ($parameters['errores']): ?>
                        <small><?php echo $var = (isset($parameters['errores']['telefono_estab']['small']))?$parameters['errores']['telefono_estab']['small']:''?></small>
                    <?php endif ?>
                    <small></small>
                </div>



                <div class="form-control <?php echo $var = (isset($parameters['errores']['municipio_estab']['form-control']))?$parameters['errores']['municipio_estab']['form-control']:''?>">
                    <label for="municipio_estab">Municipio</label>
                    <input onkeypress = " return soloLetras(event)" type="text" id="municipio_estab" name="municipio_estab" value="<?php echo $var = (isset($parameters['errores']['municipio_estab']['text']))?$parameters['errores']['municipio_estab']['text']:''?>">
                    <i class="fas fa-check-circle"></i>
                    <i class="fas fa-exclamation-circle"></i>
                    <?php if ($parameters['errores']): ?>
                        <small><?php echo $var = (isset($parameters['errores']['municipio_estab']['small']))?$parameters['errores']['municipio_estab']['small']:''?></small>
                    <?php endif ?>
                    <small></small>
                </div>




                <div class="form-control <?php echo $var = (isset($parameters['errores']['departamento_estab']['form-control']))?$parameters['errores']['departamento_estab']['form-control']:''?>">
                    <label for="departamento_estab">Departamento</label>
                    <input onkeypress = " return soloLetras(event)" type="text" id="departamento_estab" name="departamento_estab" value="<?php echo $var = (isset($parameters['errores']['departamento_estab']['text']))?$parameters['errores']['departamento_estab']['text']:''?>">
                    <i class="fas fa-check-circle"></i>
                    <i class="fas fa-exclamation-circle"></i>
                    <?php if ($parameters['errores']): ?>
                        <small><?php echo $var = (isset($parameters['errores']['departamento_estab']['small']))?$parameters['errores']['departamento_estab']['small']:''?></small>
                    <?php endif ?>
                    <small></small>
                </div>





 

                    <div class="boton"> 
                        <!-- Boton de guardar --> 
                        <input id="submit" type="submit" name="submit" value="Actualizar"> 
                    </div>
                </form> 
            </div>
        </div>
    </div> 
       
<!-- Llamando el footer -->
<?php require_once('../app/views/inc/footer.php'); ?>