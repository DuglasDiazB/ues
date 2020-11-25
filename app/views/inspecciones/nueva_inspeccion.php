<!-- Llamando el header -->
<?php require_once('../app/views/inc/header.php'); ?>
<p> <a href="<?php echo $parameters['regresar']?>"><i class="fas fa-arrow-circle-left" style=" color: #1236da;"></i>Regresar</a></p>
<p><br></p>
<p><?php echo $parameters['mensaje']?></p>
    <div class="caja">
        <div class="contact-wrapper animated bounceInUp">
            <div class="contact-form">
                <div class="encabezado">
                    <h3>Nueva inspección</h3>
                    <i class="fas fa-user-secret" aria-hidden="true"></i>
                </div>
            
                <form action="<?php echo ROUTE_URL?>/inspecciones/nuevaInspeccion" method= "post" id="form-inspeccion" class="form">
                    <div class="extender">
                        <div class="form-control <?php echo $var = (isset($parameters['errores']['establecimiento']['form-control']))?$parameters['errores']['establecimiento']['form-control']:''?>">
                            <label for="establecimiento">Establecimiento</label>
                            <input onkeypress = " return soloLetras(event)" disabled type="text" id="establecimiento" name="establecimiento" value="<?php echo $var = (isset($parameters['establecimiento']))?$parameters['establecimiento']->nombre_estab:''?>">
                            <i class="fas fa-check-circle"></i>
                            <i class="fas fa-exclamation-circle"></i>
                            <?php if ($parameters['errores']): ?>
                                <small><?php echo $var = (isset($parameters['errores']['establecimiento']['small']))?$parameters['errores']['establecimiento']['small']:''?></small>
                            <?php endif ?>
                                <small></small>
                                
                        </div>
                    </div>

                    <div class="extender"  style = "display: none">
                        <div class="form-control <?php echo $var = (isset($parameters['errores']['establecimiento']['form-control']))?$parameters['errores']['establecimiento']['form-control']:''?>">
                            <label for="establecimiento">Establecimiento</label>
                            <input onkeypress = " return soloLetras(event)"  type="text" id="establecimiento" name="establecimiento" value="<?php echo $var = (isset($parameters['establecimiento']))?$parameters['establecimiento']->nombre_estab:''?>">
                            <i class="fas fa-check-circle"></i>
                            <i class="fas fa-exclamation-circle"></i>
                            <?php if ($parameters['errores']): ?>
                                <small><?php echo $var = (isset($parameters['errores']['establecimiento']['small']))?$parameters['errores']['establecimiento']['small']:''?></small>
                            <?php endif ?>
                                <small></small>
                                
                        </div>
                    </div>

                    <div class="extender" style = "display: none">
                        <div class="form-control <?php echo $var = (isset($parameters['errores']['establecimiento']['form-control']))?$parameters['errores']['establecimiento']['form-control']:''?>">
                            <label for="establecimiento">Establecimiento</label>
                            <input onkeypress = " return soloLetras(event)" type="text" id="establecimiento" name="idestablecimiento" value="<?php echo $var = (isset($parameters['establecimiento']))?$parameters['establecimiento']->id_estab:''?>">
                            <i class="fas fa-check-circle"></i>
                            <i class="fas fa-exclamation-circle"></i>
                            <small></small>
                                
                        </div>
                    </div>
    
                    <div class="form-control <?php echo $var = (isset($parameters['errores']['objetoVisita']['form-control']))?$parameters['errores']['objetoVisita']['form-control']:''?>">
                        <label for="objetoVisita">Objeto Visita</label> 
                        <select id="objetoVisita" name="objetoVisita"> 
                            <option value="Tramite de permiso" <?php if($parameters['errores'] != []){echo $var = ($parameters['errores']['objetoVisita'] == "Tramite de permiso")? 'selected': '';}?> >Tramite de permiso</option> 
                            <option value="Inspección de control" <?php if($parameters['errores'] != []){echo $var = ($parameters['errores']['objetoVisita'] == "Inspección de control")? 'selected': '';}?> >Inspección de control</option> 
                            <option value="Denuncia" <?php if($parameters['errores'] != []){echo $var = ($parameters['errores']['objetoVisita'] == "Denuncia")? 'selected': '';}?> >Denuncia</option>
                        </select>
                    </div>
    
                    <div class="extender">
                        <div class="form-control <?php echo $var = (isset($parameters['errores']['nombreInspector']['form-control']))?$parameters['errores']['nombreInspector']['form-control']:''?>">
                            <label for="nombreInspector">Nombre Inspector</label>
                            <input onkeypress = " return soloLetras(event)" disabled type="text" id="nombreInspector" name="nombreInspector" value="<?php echo $_SESSION['user']->nombreusuario.' '.$_SESSION['user']->apellidousuario?>">
                            <i class="fas fa-check-circle"></i>
                            <i class="fas fa-exclamation-circle"></i>
                            <?php if ($parameters['errores']): ?>
                                <small><?php echo $var = (isset($parameters['errores']['nombreInspector']['small']))?$parameters['errores']['nombreInspector']['small']:''?></small>
                            <?php endif ?>
                                <small></small>
                        </div>
                    </div>

                    <div class="extender" style = "display: none">
                        <div class="form-control <?php echo $var = (isset($parameters['errores']['nombreInspector']['form-control']))?$parameters['errores']['nombreInspector']['form-control']:''?>">
                            <label for="nombreInspector">Nombre Inspector</label>
                            <input onkeypress = " return soloLetras(event)" type="text" id="nombreInspector" name="nombreInspector" value="<?php echo $_SESSION['user']->nombreusuario.' '.$_SESSION['user']->apellidousuario?>">
                            <i class="fas fa-check-circle"></i>
                            <i class="fas fa-exclamation-circle"></i>
                            <?php if ($parameters['errores']): ?>
                                <small><?php echo $var = (isset($parameters['errores']['nombreInspector']['small']))?$parameters['errores']['nombreInspector']['small']:''?></small>
                            <?php endif ?>
                                <small></small>
                        </div>
                    </div>

                    <div class="form-control <?php echo $var = (isset($parameters['errores']['inspeccionPara']['form-control']))?$parameters['errores']['inspeccionPara']['form-control']:''?>">
                        <label for="inspeccionPara">Inspección Para</label> 
                        <select id="inspeccionPara" name="inspeccionPara"> 
                            <option value="Autorización nueva" <?php if($parameters['errores'] != []){echo $var = ($parameters['errores']['inspeccionPara'] == "Autorización nueva")? 'selected': '';}?> >Autorización nueva</option> 
                            <option value="Renovación" <?php if($parameters['errores'] != []){echo $var = ($parameters['errores']['inspeccionPara'] == "Renovación")? 'selected': '';}?> >Renovación</option> 
                            <option value="Control" <?php if($parameters['errores'] != []){echo $var = ($parameters['errores']['inspeccionPara'] == "Control")? 'selected': '';}?> >Control</option>
                        </select>
                    </div>
    
                    <div class="form-control <?php echo $var = (isset($parameters['errores']['fechaInspeccion']['form-control']))?$parameters['errores']['fechaInspeccion']['form-control']:''?>">
                        <label for="fechaInspeccion">Fecha Inspeccion</label>
                        <input type="date" id="fechaInspeccion" name='fechaInspeccion' value="<?php echo $var = (isset($parameters['errores']['fechaInspector']['text']))?$parameters['errores']['fechaInspector']['text']:''?>">
                        <i class="fas fa-check-circle"></i>
                        <i class="fas fa-exclamation-circle"></i>
                        <?php if ($parameters['errores']): ?>
                            <small><?php echo $var = (isset($parameters['errores']['fechaInspeccion']['small']))?$parameters['errores']['fechaInspeccion']['small']:''?></small>
                        <?php endif ?>
                            <small></small>
                    </div>
                       
                    <div class="form-control <?php echo $var = (isset($parameters['errores']['notaPinspeccion']['form-control']))?$parameters['errores']['notaPinspeccion']['form-control']:''?>">
                        <label for="notaPinspeccion">Nota 1° Inspeccion</label>
                        <input type="text" id="notaPinspeccion" name="notaPinspeccion" value="<?php echo $var = (isset($parameters['errores']['notaPinspeccion']['text']))?$parameters['errores']['notaPinspeccion']['text']:''?>">
                        <i class="fas fa-check-circle"></i>
                        <i class="fas fa-exclamation-circle"></i>
                        <?php if ($parameters['errores']): ?>
                            <small><?php echo $var = (isset($parameters['errores']['notaPinspeccion']['small']))?$parameters['errores']['notaPinspeccion']['small']:''?></small>
                        <?php endif ?>
                            <small></small>
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