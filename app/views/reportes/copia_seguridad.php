<!-- Llamando el header -->
<?php require_once('../app/views/inc/header.php'); ?>
<p> <a href="<?php echo $parameters['regresar']?>"><i class="fas fa-arrow-circle-left" style=" color: #1236da;"></i>Regresar</a></p>    
<br>
<p><?php echo  $parameters['mensaje']?></p> 
    <div class="caja">
        <div class="contact-wrapper animated bounceInUp">
            <div  class="contact-form">
                <div class="encabezado">
                    <h3>Copia de seguridad</h3>
                    <i class="fas fa-save"></i>
                </div>
                
                <form action="<?php echo ROUTE_URL?>/Reports/copiaSeguridad/" method= "post" id="form-usuario" class="form">
                    

                    <div class="extender">
                        <div class="form-control extender <?php echo $var = (isset($parameters['errores']['password']['form-control']))?$parameters['errores']['password']['form-control']:''?>">
                            <label for="password">Digite su contraseña</label> 
                            
                            <input id="password" type="password" name="password" value="<?php echo $var = (isset($parameters['errores']['password']['text']))?$parameters['errores']['password']['text']:''?>"> 
                            <i class="fas fa-check-circle"></i>
                            <i class="fas fa-exclamation-circle"></i>
                            <?php if ($parameters['errores']): ?>
                                <small><?php echo $var = (isset($parameters['errores']['password']['small']))?$parameters['errores']['password']['small']:''?></small>
                            <?php endif ?>
                                <small></small>
                        </div>  
                    </div> 
                   

                    <div class="boton"> 
                        <!-- Boton de guardar --> 
                        <input id="submit" type="submit" name="submit" value="Descargar"> 
                    </div>
                </form> 
            </div>
        </div>
    </div> 
       
<!-- Llamando el footer -->
<?php require_once('../app/views/inc/footer.php'); ?>