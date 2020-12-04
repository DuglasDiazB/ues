<?php require_once('../app/views/inc/header.php'); ?>
<p> <a href="<?php echo $parameters['regresar']?>"><i class="fas fa-arrow-circle-left" style=" color: #1236da;"></i>Regresar</a></p>
<br>
<p><?php echo  $parameters['mensaje']?></p>
<br>
<p><?php echo  $parameters['usuario']->fecharegistro.'; '.$parameters['usuario']->fechamod .' por '. $parameters['usuario']->usermod ?></p>
    <div class="caja">
        <div class="contact-wrapper animated bounceInUp">
            <div class="contact-form">
                <div class="encabezado">
                    <h3>Ver usuario</h3>
                    <i class="fas fa-user"></i>
                </div>
                
                <form action="" id="form-usuario" class="form">
                    <div class="form-control">
                        <label for="nombre">Nombre</label>
                        <input disabled type="text" id="nombre" name="nombre" value="<?php echo $var = (isset($parameters['usuario']->nombreusuario))?$parameters['usuario']->nombreusuario:''?>">
                        <i class="fas fa-check-circle"></i>
                        <i class="fas fa-exclamation-circle"></i>
                    </div>

                    <div class="form-control">
                        <label for="Apellido">Apellido</label>
                        <input disabled type="text" id="apellido" name='apellido' value="<?php echo $var = (isset($parameters['usuario']->apellidousuario))?$parameters['usuario']->apellidousuario:''?>"> 
                        <i class="fas fa-check-circle"></i>
                        <i class="fas fa-exclamation-circle"></i>
                    </div>

                    <div class="form-control">
                        <label for="fechaNacimiento">Fecha de Nacimiento</label>
                        <input disabled type="date" id="fechaNacimiento" name='fechaNacimiento' value="<?php echo $var = (isset($parameters['usuario']->fechanacimientousuario))?$parameters['usuario']->fechanacimientousuario:''?>">
                        <i class="fas fa-check-circle"></i>
                        <i class="fas fa-exclamation-circle"></i>
                    </div>

                    <div class="form-control">
                        <label for="dui">DUI</label> 
                        <input disabled id="dui" type="text" name="dui" value="<?php echo $var = (isset($parameters['usuario']->duiusuario))?$parameters['usuario']->duiusuario:''?>"> 
                        <i class="fas fa-check-circle"></i>
                        <i class="fas fa-exclamation-circle"></i>
                    </div>

                    <div class="form-control">
                        <label for="telefono">Telefono</label> 
                        <input disabled id="telefono" type="text" name="telefono" value="<?php echo $var = (isset($parameters['usuario']->telefonousuario))?$parameters['usuario']->telefonousuario:''?>"> 
                        <i class="fas fa-check-circle"></i>
                        <i class="fas fa-exclamation-circle"></i>
                    </div>

                    <div class="form-control">
                        <!-- crear CheckBox -->
                        <label for="genero">Genero</label> 
                        <select disabled id="genero" name="genero"> 
                            <option value="1" <?php echo $var = ($parameters['usuario']->sexousuario == 1)? 'selected': ''?>>Hombre</option> 
                            <option value="2" <?php echo $var = ($parameters['usuario']->sexousuario == 2)? 'selected': ''?>>Mujer</option> 
                        </select>
                    </div>

                    <div class="extender">
                        <div class="form-control extender">
                            <label for="direccion">Dirección</label> 
                            <input disabled id="direccion" type="text" name="direccion" value="<?php echo $var = (isset($parameters['usuario']->direccionusuario))?$parameters['usuario']->direccionusuario:''?>"> 
                            <i class="fas fa-check-circle"></i>
                            <i class="fas fa-exclamation-circle"></i>
                        </div>  
                    </div>

                    <div class="form-control">
                        <!-- crear CheckBox -->
                        <label for="tipoUsario">Tipo de Usuario</label> 
                        <select disabled id="tipoUsuario" name="tipoUsario"> 
                            <option value="1" <?php echo $var = ($parameters['usuario']->idtipousuario == 1)? 'selected': ''?>>Administrador</option> 
                            <option value="2" <?php echo $var = ($parameters['usuario']->idtipousuario == 2)? 'selected': ''?>>Usuario</option> 
                        </select> 
                    </div>  

                    <div class="form-control">
                        <label for="usuario">Usuario</label> 
                        <input disabled id="usuario" type="text" name="usuario" value="<?php echo $var = (isset($parameters['usuario']->username))?$parameters['usuario']->username:''?>"> 
                        <i class="fas fa-check-circle"></i>
                        <i class="fas fa-exclamation-circle"></i>
                    </div>

                    <div class="form-control">
                        <!-- crear CheckBox -->
                        <label for="tipoUsario">Estado Usuario</label> 
                        <select disabled id="tipoUsuario" name="tipoUsario"> 
                            <option value="1" <?php echo $var = ($parameters['usuario']->estadousuario == 1)? 'selected': ''?>>Activado</option> 
                            <option value="2" <?php echo $var = ($parameters['usuario']->estadousuario == 2)? 'selected': ''?>>Desactivado</option> 
                        </select> 
                    </div>  
                 </form>
            </div>
        </div>
    </div> 
 
<?php require_once('../app/views/inc/footer.php'); ?>