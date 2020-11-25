<!-- Llamando el header -->
<?php require_once('../app/views/inc/header.php'); ?>
<p> <a href="<?php echo $parameters['regresar']?>"><i class="fas fa-arrow-circle-left" style=" color: #1236da;"></i>Regresar</a></p>    
<p><?php echo $parameters['mensaje']?></p>
    <div class="caja">
        <div class="contact-wrapper animated bounceInUp">
            <div class="contact-form">
                <div class="encabezado">
                    <h3>Nuevo usuario</h3>
                    <i class="fa fa-user-plus" aria-hidden="true"></i>
                </div>
            
                <form action="<?php echo ROUTE_URL?>/usuarios/nuevoUsuario" method= "post" id="form-usuario" class="form">
                    <!-- Clase que contiene tred div para ponerlos en una sola linea los tres  --> 
                    <div class="form-control <?php echo $var = (isset($parameters['errores']['nombre']['form-control']))?$parameters['errores']['nombre']['form-control']:''?>">
                        <label for="nombre">Nombre</label>
                        <input onkeypress = " return soloLetras(event)" type="text" id="nombre" name="nombreusuario" value="<?php echo $var = (isset($parameters['errores']['nombre']['text']))?$parameters['errores']['nombre']['text']:''?>">
                        <i class="fas fa-check-circle"></i>
                        <i class="fas fa-exclamation-circle"></i>
                        <?php if ($parameters['errores']): ?>
                            <small><?php echo $var = (isset($parameters['errores']['nombre']['small']))?$parameters['errores']['nombre']['small']:''?></small>
                        <?php endif ?>
                            <small></small>
                    </div>

                    <div class="form-control <?php echo $var = (isset($parameters['errores']['apellido']['form-control']))?$parameters['errores']['apellido']['form-control']:''?>">
                        <label for="Apellido">Apellido</label>
                        <input onkeypress = " return soloLetras(event)" type="text" id="apellido" name='apellidousuario' value="<?php echo $var = (isset($parameters['errores']['apellido']['text']))?$parameters['errores']['apellido']['text']:''?>"> 
                        <i class="fas fa-check-circle"></i>
                        <i class="fas fa-exclamation-circle"></i>
                        <?php if ($parameters['errores']): ?>
                            <small><?php echo $var = (isset($parameters['errores']['apellido']['small']))?$parameters['errores']['apellido']['small']:''?></small>
                        <?php endif ?>
                        <small></small>
                    </div>

                    <div class="form-control <?php echo $var = (isset($parameters['errores']['fechaNacimiento']['form-control']))?$parameters['errores']['fechaNacimiento']['form-control']:''?>">
                        <label for="fechaNacimiento">Fecha de Nacimiento</label>
                        <input type="date" id="fechaNacimiento" name='fechanacimientousuario' value="<?php echo $var = (isset($parameters['errores']['fechaNacimiento']['text']))?$parameters['errores']['fechaNacimiento']['text']:''?>">
                        <i class="fas fa-check-circle"></i>
                        <i class="fas fa-exclamation-circle"></i>
                        <?php if ($parameters['errores']): ?>
                            <small><?php echo $var = (isset($parameters['errores']['fechaNacimiento']['small']))?$parameters['errores']['fechaNacimiento']['small']:''?></small>
                        <?php endif ?>
                        <small></small>
                    </div>
    
                    <div class="form-control <?php echo $var = (isset($parameters['errores']['dui']['form-control']))?$parameters['errores']['dui']['form-control']:''?>">
                        <label for="dui">DUI</label> 
                        <input id="dui" type="text" name="duiusuario" value="<?php echo $var = (isset($parameters['errores']['dui']['text']))?$parameters['errores']['dui']['text']:''?>"> 
                        <i class="fas fa-check-circle"></i>
                        <i class="fas fa-exclamation-circle"></i>
                        <?php if ($parameters['errores']): ?>
                            <small><?php echo $var = (isset($parameters['errores']['dui']['small']))?$parameters['errores']['dui']['small']:''?></small>
                        <?php endif ?>
                        <small></small>
                    </div>

                    <div class="form-control <?php echo $var = (isset($parameters['errores']['telefono']['form-control']))?$parameters['errores']['telefono']['form-control']:''?>">
                        <label for="telefono">Telefono</label> 
                        <input id="telefono" type="text" name="telefonousuario" value="<?php echo $var = (isset($parameters['errores']['telefono']['text']))?$parameters['errores']['telefono']['text']:''?>"> 
                        <i class="fas fa-check-circle"></i>
                        <i class="fas fa-exclamation-circle"></i>
                        <?php if ($parameters['errores']): ?>
                            <small><?php echo $var = (isset($parameters['errores']['telefono']['small']))?$parameters['errores']['telefono']['small']:''?></small>
                        <?php endif ?>
                        <small></small>
                    </div>

                    <div class="form-control">
                        <!-- crear CheckBox -->
                        <label for="genero">Genero</label> 
                        <select id="genero" name="sexousuario"> 
                            <option value="1" <?php if($parameters['errores'] != []){echo $var = ($parameters['errores']['sexo'] == 1)? 'selected': '';}?>>Hombre</option> 
                            <option value="2" <?php if($parameters['errores'] != []){echo $var = ($parameters['errores']['sexo'] == 2)? 'selected': '';}?>>Mujer</option> 
                        </select>
                    </div>

                    <div class="extender">
                        <div class="form-control <?php echo $var = (isset($parameters['errores']['direccion']['form-control']))?$parameters['errores']['direccion']['form-control']:''?>">
                            <label for="direccion">Dirección</label> 
                            <input id="direccion" type="text" name="direccionusuario" value="<?php echo $var = (isset($parameters['errores']['direccion']['text']))?$parameters['errores']['direccion']['text']:''?>"> 
                            <i class="fas fa-check-circle"></i>
                            <i class="fas fa-exclamation-circle"></i>
                            <?php if ($parameters['errores']): ?>
                                <small><?php echo $var = (isset($parameters['errores']['direccion']['small']))?$parameters['errores']['direccion']['small']:''?></small>
                            <?php endif ?>
                                <small></small>
                        </div>  
                    </div>

                    <div class="form-control">
                        <!-- crear CheckBox -->
                        <label for="tipoUsario">Tipo de Usuario</label> 
                        <select id="tipoUsuario" name="idtipousuario"> 
                            <option value="1" <?php if($parameters['errores'] != []){echo $var = ($parameters['errores']['tipo'] == 1)? 'selected': '';}?>>Administrador</option> 
                            <option value="2" <?php if($parameters['errores'] != []){echo $var = ($parameters['errores']['tipo'] == 2)? 'selected': '';}?>>Usuario</option> 
                        </select> 
                    </div>  

                    <div class="form-control <?php echo $var = (isset($parameters['errores']['usuario']['form-control']))?$parameters['errores']['usuario']['form-control']:''?>">
                        <label for="usuario">Usuario</label> 
                        <input onkeypress = " return soloLetras(event)" id="usuario" type="text" name="username" value="<?php echo $var = (isset($parameters['errores']['usuario']['text']))?$parameters['errores']['usuario']['text']:''?>"> 
                        <i class="fas fa-check-circle"></i>
                        <i class="fas fa-exclamation-circle"></i>
                        <?php if ($parameters['errores']): ?>
                            <small><?php echo $var = (isset($parameters['errores']['usuario']['small']))?$parameters['errores']['usuario']['small']:''?></small>
                        <?php endif ?>
                            <small></small>
                    </div>
                
                    <div class="form-control <?php echo $var = (isset($parameters['errores']['pass']['form-control']))?$parameters['errores']['pass']['form-control']:''?>">
                        <label for="password">Contraseña</label> 
                        <input id="password1" type="password" name="password" value="<?php echo $var = (isset($parameters['errores']['pass']['text']))?$parameters['errores']['pass']['text']:''?>"> 
                        <i class="fas fa-check-circle"></i>
                        <i class="fas fa-exclamation-circle"></i>
                        <?php if ($parameters['errores']): ?>
                            <small><?php echo $var = (isset($parameters['errores']['pass']['small']))?$parameters['errores']['pass']['small']:''?></small>
                        <?php endif ?>
                            <small></small>
                    </div>

                    <div class="form-control">
                        <label for="password2">Repita Contraseña</label> 
                        <input id="password2" type="password" name="password2"> 
                        <i class="fas fa-check-circle"></i>
                        <i class="fas fa-exclamation-circle"></i>
                        <small>Error Message</small>
                    </div> 
    
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
    
