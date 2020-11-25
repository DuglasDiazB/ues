<!-- Llamando el header -->
<?php require_once('../app/views/inc/header.php'); ?>
<p> <a href="<?php echo $parameters['regresar']?>"><i class="fas fa-arrow-circle-left" style=" color: #1236da;"></i>Regresar</a></p>    
<p><?php echo $parameters['mensaje']?></p>
    <div class="caja">
        <div class="contact-wrapper animated bounceInUp">
            <div class="contact-form">
                <div class="encabezado">
                    <h3>Actualizar inspección</h3>
                    <i class="fas fa-user-secret" aria-hidden="true"></i>
                </div>

                <form action="<?php echo ROUTE_URL?>/inspecciones/actualizarInspeccion/<?php echo $parameters['inspecciones']?>" method= "post" id="form-inspeccion" class="form">

                <div class="form-control" style="display: none">
                        <label for="pagina"></label> 
                        <input type="text" name="pagina" value="<?php echo $parameters['pagina']?>"> 
                        <i class="fas fa-check-circle"></i>
                        <i class="fas fa-exclamation-circle"></i>
                        <small></small>
                    </div>

                    <div class="form-control" style="display: none">
                        <label for="busqueda"></label> 
                        <input type="text" name="busqueda" value="<?php echo $parameters['busqueda']?>"> 
                        <i class="fas fa-check-circle"></i>
                        <i class="fas fa-exclamation-circle"></i>
                        <small></small>
                    </div>

                    <div class="extender">
                        <div class="form-control <?php echo $var = (isset($parameters['errores']['establecimiento']['form-control']))?$parameters['errores']['establecimiento']['form-control']:''?>">
                            <label for="establecimiento">Establecimiento</label>
                            <input  onkeypress = " return soloLetras(event)" disabled type="text" id="establecimiento" name="establecimiento" value="<?php echo $var = (isset($parameters['inspeccion']))?$parameters['inspeccion']->nombre_estab:''?>">
                            <i class="fas fa-check-circle"></i>
                            <i class="fas fa-exclamation-circle"></i>
                            <?php if ($parameters['errores']): ?>
                                <small><?php echo $var = (isset($parameters['errores']['establecimiento']['small']))?$parameters['errores']['establecimiento']['small']:''?></small>
                            <?php endif;?>
                                <small></small>
                        </div>
                    </div>

                    <div class="extender" style = "display: none">
                        <div class="form-control <?php echo $var = (isset($parameters['errores']['establecimiento']['form-control']))?$parameters['errores']['establecimiento']['form-control']:''?>">
                            <label for="establecimiento">Establecimiento</label>
                            <input  onkeypress = " return soloLetras(event)" type="text" id="establecimiento" name="establecimiento" value="<?php echo $var = (isset($parameters['inspeccion']))?$parameters['inspeccion']->nombre_estab:''?>">
                            <i class="fas fa-check-circle"></i>
                            <i class="fas fa-exclamation-circle"></i>
                            <?php if ($parameters['errores']): ?>
                                <small><?php echo $var = (isset($parameters['errores']['establecimiento']['small']))?$parameters['errores']['establecimiento']['small']:''?></small>
                            <?php endif;?>
                                <small></small>
                                
                        </div>
                    </div>

                    <div class="extender" style = "display: none">
                        <div class="form-control <?php echo $var = (isset($parameters['errores']['establecimiento']['form-control']))?$parameters['errores']['establecimiento']['form-control']:''?> " >
                            <label for="idestablecimiento">Establecimiento</label>
                            <input onkeypress = " return soloLetras(event)" type="text" id="idestablecimiento" name="idestablecimiento" value="<?php echo $var = (isset($parameters['inspeccion']))?$parameters['inspeccion']->id_estab:''?>">
                            <i class="fas fa-check-circle"></i>
                            <i class="fas fa-exclamation-circle"></i>
                            <small></small>
                                
                        </div>
                    </div>

                    <div class="extender" style = "display: none">
                        <div class="form-control <?php echo $var = (isset($parameters['errores']['establecimiento']['form-control']))?$parameters['errores']['establecimiento']['form-control']:''?>">
                            <label for="idinspeccion">Establecimiento</label>
                            <input  onkeypress = " return soloLetras(event)" type="text" id="idinspeccion" name="idinspeccion" value="<?php echo $var = (isset($parameters['inspeccion']))?$parameters['inspeccion']->id_inspec:''?>">
                            <i class="fas fa-check-circle"></i>
                            <i class="fas fa-exclamation-circle"></i>
                            <small></small>
                                
                        </div>
                    </div>
    
                    <div class="form-control <?php echo $var = (isset($parameters['errores']['objetoVisita']['form-control']))?$parameters['errores']['objetoVisita']['form-control']:''?>">
                        <label for="objetoVisita">Objeto Visita</label> 
                        <select id="objetoVisita" name="objetoVisita"> 
                            <option value="Tramite de permiso"  <?php if($parameters['errores'] != []){echo $var = ($parameters['errores']['objetoVisita'] == "Tramite de permiso")? 'selected': '';}?>>Tramite de permiso</option> 
                            <option value="Inspección de control"  <?php if($parameters['errores'] != []){echo $var = ($parameters['errores']['objetoVisita'] == "Inspección de control")? 'selected': '';}?>>Inspección de control</option> 
                            <option value="Denuncia"  <?php if($parameters['errores'] != []){echo $var = ($parameters['errores']['objetoVisita'] == "Denuncia")? 'selected': '';}?>>Denuncia</option>
                        </select>
                    </div>
    
                    <div class="extender" >
                        <div class="form-control <?php echo $var = (isset($parameters['errores']['nombreInspector']['form-control']))?$parameters['errores']['nombreInspector']['form-control']:''?>">
                            <label for="nombreInspector">Nombre Inspector</label>
                            <input onkeypress = " return soloLetras(event)" disabled type="text" id="nombreInspector" name="nombreInspector" value="<?php echo $_SESSION['user']->nombreusuario.' '.$_SESSION['user']->apellidousuario?>">
                            <i class="fas fa-check-circle"></i>
                            <i class="fas fa-exclamation-circle"></i>
                            <?php if ($parameters['errores']): ?>
                                <small><?php echo $var = (isset($parameters['errores']['nombreInspector']['small']))?$parameters['errores']['nombreInspector']['small']:''?></small>
                            <?php endif;?>
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
                            <?php endif;?>
                                <small></small>
                        </div>
                    </div>
    
                    <div class="form-control <?php echo $var = (isset($parameters['errores']['inspeccionPara']['form-control']))?$parameters['errores']['inspeccionPara']['form-control']:''?>">
                        <label for="inspeccionPara">Inspección Para</label> 
                        <select id="inspeccionPara" name="inspeccionPara"> 
                            <option value="Autorización nueva"  <?php if($parameters['errores'] != []){echo $var = ($parameters['errores']['inspeccionPara'] == "Autorización nueva")? 'selected': '';}?>>Autorización nueva</option> 
                            <option value="Renovación"  <?php if($parameters['errores'] != []){echo $var = ($parameters['errores']['inspeccionPara'] == "Renovación")? 'selected': '';}?>>Renovación</option> 
                            <option value="Control"  <?php if($parameters['errores'] != []){echo $var = ($parameters['errores']['inspeccionPara'] == "Control")? 'selected': '';}?>>Control</option>
                        </select>
                    </div>
    
                    

                    <div class="form-control <?php echo $var = (isset($parameters['errores']['fechaInspeccion']['form-control']))?$parameters['errores']['fechaInspeccion']['form-control']:''?>">
                        <label for="fechaInspeccion">Fecha Inspeccion</label>
                        <?php if ($parameters['errores']['notaPinspeccion']['text'] < 100 AND $parameters['errores']['notaPinspeccion']['text'] != NULL):?>
                        <input disabled type="date" id="fechaInspeccion" name='fechaInspeccion' value="<?php echo $var = (isset($parameters['errores']['fechaInspeccion']['text']))?$parameters['errores']['fechaInspeccion']['text']:''?>">
                        <?php else:?>
                        <input  type="date" id="fechaInspeccion" name='fechaInspeccion' value="<?php echo $var = (isset($parameters['errores']['fechaInspeccion']['text']))?$parameters['errores']['fechaInspeccion']['text']:''?>">
                        <?php endif;?>
                        <i class="fas fa-check-circle"></i>
                        <i class="fas fa-exclamation-circle"></i>
                        <?php if ($parameters['errores']): ?>
                            <small><?php echo $var = (isset($parameters['errores']['fechaInspeccion']['small']))?$parameters['errores']['fechaInspeccion']['small']:''?></small>
                        <?php endif;?>
                            <small></small>
                    </div>
                       
                    <div class="form-control <?php echo $var = (isset($parameters['errores']['notaPinspeccion']['form-control']))?$parameters['errores']['notaPinspeccion']['form-control']:''?>">
                        <label for="notaPinspeccion">Nota 1° Inspeccion</label>
                        <?php if ($parameters['errores']['notaPinspeccion']['text'] < 100 AND $parameters['errores']['notaPinspeccion']['text'] != NULL):?>
                        <input disabled type="text" id="notaPinspeccion" name="notaPinspeccion" value="<?php echo $var = (isset($parameters['errores']['notaPinspeccion']['text']))?$parameters['errores']['notaPinspeccion']['text']:''?>">
                        <?php else:?>
                        <input type="text" id="notaPinspeccion" name="notaPinspeccion" value="<?php echo $var = (isset($parameters['errores']['notaPinspeccion']['text']))?$parameters['errores']['notaPinspeccion']['text']:''?>">
                        <?php endif;?>
                        <i class="fas fa-check-circle"></i>
                        <i class="fas fa-exclamation-circle"></i>
                        <?php if ($parameters['errores']): ?>
                            <small><?php echo $var = (isset($parameters['errores']['notaPinspeccion']['small']))?$parameters['errores']['notaPinspeccion']['small']:''?></small>
                        <?php endif;?>
                            <small></small>
                    </div>
                     
                    <?php if (isset($parameters['segunda']) AND $parameters['segunda'] != TRUE):?>

                    <?php if ($parameters['errores']['notaPinspeccion']['text'] != NULL || $parameters['errores']['notaPinspeccion']['text'] != ''):?>                       
                    <div class="form-control <?php echo $var = (isset($parameters['errores']['pReinspecfecha']['form-control']))?$parameters['errores']['pReinspecfecha']['form-control']:''?>">
                        <label for="pReinspecfecha">1° Reinspec Fecha</label>
                        <?php if($parameters['errores']['sReinspecnota']['text'] != '' AND $parameters['errores']['sReinspecnota']['text'] < 100):?>
                        <input disabled type="date" id="pReinspecfecha" name="pReinspecfecha" value="<?php echo $var = (isset($parameters['errores']['pReinspecfecha']['text']))?$parameters['errores']['pReinspecfecha']['text']:''?>"> 
                        <?php elseif ($parameters['errores']['notaPinspeccion']['text'] < 100 || $parameters['errores']['sReinspecfecha']['text'] == ''):?>
                        <input type="date" id="pReinspecfecha" name="pReinspecfecha" value="<?php echo $var = (isset($parameters['errores']['pReinspecfecha']['text']))?$parameters['errores']['pReinspecfecha']['text']:''?>">
                        <?php else:?>
                        <input disabled type="date" id="pReinspecfecha" name="pReinspecfecha" value="<?php echo $var = (isset($parameters['errores']['pReinspecfecha']['text']))?$parameters['errores']['pReinspecfecha']['text']:''?>">
                        <?php endif;?>
                        <i class="fas fa-check-circle"></i>
                        <i class="fas fa-exclamation-circle"></i>
                        <?php if ($parameters['errores']): ?>
                            <small><?php echo $var = (isset($parameters['errores']['pReinspecfecha']['small']))?$parameters['errores']['pReinspecfecha']['small']:''?></small>
                        <?php endif;?>
                            <small></small>
                            
                    </div>
    
                    <div class="form-control <?php echo $var = (isset($parameters['errores']['pReinspecnota']['form-control']))?$parameters['errores']['pReinspecnota']['form-control']:''?>">
                        <label for="pReinspecnota">1° Reinspec Nota</label>
                        <?php if($parameters['errores']['sReinspecnota']['text'] != '' AND $parameters['errores']['sReinspecnota']['text'] < 100):?>
                        <input disabled type="text" id="pReinspecnota" name="pReinspecnota" value="<?php echo $var = (isset($parameters['errores']['pReinspecnota']['text']))?$parameters['errores']['pReinspecnota']['text']:''?>">
                        <?php elseif ($parameters['errores']['notaPinspeccion']['text'] < 100 || $parameters['errores']['sReinspecfecha']['text'] == ''):?>
                        <input  type="text" id="pReinspecnota" name="pReinspecnota" value="<?php echo $var = (isset($parameters['errores']['pReinspecnota']['text']))?$parameters['errores']['pReinspecnota']['text']:''?>">
                        <?php else:?>
                        <input disabled type="text" id="pReinspecnota" name="pReinspecnota" value="<?php echo $var = (isset($parameters['errores']['pReinspecnota']['text']))?$parameters['errores']['pReinspecnota']['text']:''?>">
                        <?php endif;?>
                        <i class="fas fa-check-circle"></i>
                        <i class="fas fa-exclamation-circle"></i>
                        <?php if ($parameters['errores']): ?>
                            <small><?php echo $var = (isset($parameters['errores']['pReinspecnota']['small']))?$parameters['errores']['pReinspecnota']['small']:''?></small>
                        <?php endif;?>
                            <small></small>
                    </div>

                    <?php endif;?>
                    <?php endif;?>

                    <?php if (isset($parameters['tercera']) AND $parameters['tercera'] != TRUE):?>
                    <?php if (($parameters['errores']['notaPinspeccion']['text'] != NULL) AND 
                              ($parameters['errores']['pReinspecnota']['text'] != NULL)):?>
                    <div class="form-control <?php echo $var = (isset($parameters['errores']['sReinspecfecha']['form-control']))?$parameters['errores']['sReinspecfecha']['form-control']:''?>">
                        <label for="sReinspecfecha">2° Reinspec Fecha</label>
                        <?php if($parameters['errores']['sReinspecnota']['text'] != '' AND $parameters['errores']['sReinspecnota']['text'] < 100):?>
                        <input disabled type="date" id="sReinspecfecha" name="sReinspecfecha" value="<?php echo $var = (isset($parameters['errores']['sReinspecfecha']['text']))?$parameters['errores']['sReinspecfecha']['text']:''?>">
                        <?php elseif ($parameters['errores']['pReinspecnota']['text'] == '' AND $parameters['errores']['notaPinspeccion']['text'] < 100):?>
                        <input disabled type="date" id="sReinspecfecha" name="sReinspecfecha" value="<?php echo $var = (isset($parameters['errores']['sReinspecfecha']['text']))?$parameters['errores']['sReinspecfecha']['text']:''?>">
                        <?php else:?>
                        <input  type="date" id="sReinspecfecha" name="sReinspecfecha" value="<?php echo $var = (isset($parameters['errores']['sReinspecfecha']['text']))?$parameters['errores']['sReinspecfecha']['text']:''?>">
                        <?php endif;?> 
                        <i class="fas fa-check-circle"></i>
                        <i class="fas fa-exclamation-circle"></i>
                        <?php if ($parameters['errores']): ?>
                            <small><?php echo $var = (isset($parameters['errores']['sReinspecfecha']['small']))?$parameters['errores']['sReinspecfecha']['small']:''?></small>
                        <?php endif;?>
                            <small></small>
                    </div>
    
                    <div class="form-control <?php echo $var = (isset($parameters['errores']['sReinspecnota']['form-control']))?$parameters['errores']['sReinspecnota']['form-control']:''?>">
                        <label for="sReinspecnota">2° Reinspec Nota</label>
                        <?php if($parameters['errores']['sReinspecnota']['text'] != '' AND $parameters['errores']['sReinspecnota']['text'] < 100):?>
                            <input disabled type="text" id="sReinspecnota" name="sReinspecnota" value="<?php echo $var = (isset($parameters['errores']['sReinspecnota']['text']))?$parameters['errores']['sReinspecnota']['text']:''?>">
                        <?php elseif ($parameters['errores']['pReinspecnota']['text'] == '' AND $parameters['errores']['notaPinspeccion']['text'] < 100):?>
                        <input disabled type="text" id="sReinspecnota" name="sReinspecnota" value="<?php echo $var = (isset($parameters['errores']['sReinspecnota']['text']))?$parameters['errores']['sReinspecnota']['text']:''?>">
                        <?php else:?>
                        <input type="text" id="sReinspecnota" name="sReinspecnota" value="<?php echo $var = (isset($parameters['errores']['sReinspecnota']['text']))?$parameters['errores']['sReinspecnota']['text']:''?>">
                        <?php endif;?>
                        <i class="fas fa-check-circle"></i>
                        <i class="fas fa-exclamation-circle"></i>
                        <?php if ($parameters['errores']): ?>
                            <small><?php echo $var = (isset($parameters['errores']['sReinspecnota']['small']))?$parameters['errores']['sReinspecnota']['small']:''?></small>
                        <?php endif;?>
                            <small></small>
                    </div>
                    <?php endif;?>
                    <?php endif;?>
                    <br>
                    <div class="boton"> 
                    <?php if($parameters['errores']['sReinspecnota']['text'] != '' AND $parameters['errores']['sReinspecnota']['text'] < 100):?> 
                        <br>
                    <?php else:?>
                        <input style="display:block; position: relative" id="submit" type="submit" name="submit" value="Actualizar"> 
                    <?php endif;?>
                    </div>
                    
                </form>  
            </div>
        </div>
    </div> 
<!-- Llamando el footer -->
<?php require_once('../app/views/inc/footer.php'); ?>