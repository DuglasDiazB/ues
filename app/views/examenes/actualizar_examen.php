<!-- Llamando el header -->
<?php require_once('../app/views/inc/header.php'); ?>
    <p> <a href="<?php echo $parameters['regresar']?>"><i class="fas fa-arrow-circle-left" style=" color: #1236da;"></i>Regresar</a></p>
    <br>
    <p><?php echo  $parameters['mensaje']?></p>
    <div class="caja">
        <div class="contact-wrapper animated bounceInUp">
            <div class="contact-form">
                <div class="encabezado">
                    <h3>Actualizar examen</h3>
                    <i class="fas fa-file-medical"></i>
                </div>
                
                <form action="<?php echo ROUTE_URL?>/examenes/actualizarExamen/"  method= "post" id="form-usuario" class="form">
                 
                    <div class="form-control" style="display: none">
                        <label for="id"></label> 
                        <input type="text" name="id" value="<?php echo $var = (isset($parameters['errores']['id']['text']))?$parameters['errores']['id']['text']:''?>"> 
                        <i class="fas fa-check-circle"></i>
                        <i class="fas fa-exclamation-circle"></i>
                        <small></small>
                    </div>

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

                    <div class="form-control" style="display: none">
                        <label for="id_manip"></label> 
                        <input type="text" name="id_manip" value="<?php echo $var = (isset($parameters['errores']['id_manip']['text']))?$parameters['errores']['id_manip']['text']:''?>"> 
                        <i class="fas fa-check-circle"></i>
                        <i class="fas fa-exclamation-circle"></i>
                        <small></small>
                    </div>

                    <div class="form-control <?php echo $var = (isset($parameters['errores']['dui_manip']['form-control']))?$parameters['errores']['dui_manip']['form-control']:''?>">
                        <label for="dui_manip">DUI</label>
                        <input disabled type="text" id="dui_manip" name="duiManip" value="<?php echo $var = (isset($parameters['errores']['dui_manip']['text']))?$parameters['errores']['dui_manip']['text']:''?>">
                        <i class="fas fa-check-circle"></i>
                        <i class="fas fa-exclamation-circle"></i>
                        <?php if ($parameters['errores']): ?>
                            <small><?php echo $var = (isset($parameters['errores']['dui_manip']['small']))?$parameters['errores']['dui_manip']['small']:''?></small>
                        <?php endif ?>
                    </div>

                    <div class="form-control <?php echo $var = (isset($parameters['errores']['nombre_manip']['form-control']))?$parameters['errores']['nombre_manip']['form-control']:''?>">
                        <label for="nombre_manip">Nombre</label>
                        <input disabled type="text" id="nombre_manip" name='nombre_manip' value="<?php echo $var = (isset($parameters['errores']['nombre_manip']['text']))?$parameters['errores']['nombre_manip']['text']:''?>"> 
                        <i class="fas fa-check-circle"></i>
                        <i class="fas fa-exclamation-circle"></i>
                        <?php if ($parameters['errores']): ?>
                            <small><?php echo $var = (isset($parameters['errores']['nombre_manip']['small']))?$parameters['errores']['nombre_manip']['small']:''?></small>
                        <?php endif ?>
                    </div>

                    <div class="form-control <?php echo $var = (isset($parameters['errores']['apellido_manip']['form-control']))?$parameters['errores']['apellido_manip']['form-control']:''?>">
                        <label for="apellido_manip">Apellido</label>
                        <input disabled type="text" id="apellido_manip" name='apellido_manip' value="<?php echo $var = (isset($parameters['errores']['apellido_manip']['text']))?$parameters['errores']['apellido_manip']['text']:''?>"> 
                        <i class="fas fa-check-circle"></i>
                        <i class="fas fa-exclamation-circle"></i>
                        <?php if ($parameters['errores']): ?>
                            <small><?php echo $var = (isset($parameters['errores']['apellido_manip']['small']))?$parameters['errores']['apellido_manip']['small']:''?></small>
                        <?php endif ?>
                    </div>

                    <div class="extender <?php echo $var = (isset($parameters['errores']['nombre_estab']['form-control']))?$parameters['errores']['nombre_estab']['form-control']:''?>">
                    <div class="form-control extender">
                        <label for="nombre_estab">Trabaja en</label> 
                        <input disabled id="nombre_estab" type="text" name="nombre_estab" value="<?php echo $var = (isset($parameters['errores']['nombre_estab']['text']))?$parameters['errores']['nombre_estab']['text']:''?>"> 
                        <i class="fas fa-check-circle"></i>
                        <i class="fas fa-exclamation-circle"></i>
                        <?php if ($parameters['errores']): ?>
                            <small><?php echo $var = (isset($parameters['errores']['nombre_estab']['small']))?$parameters['errores']['nombre_estab']['small']:''?></small>
                        <?php endif ?>
                    </div>
                    </div>   

                    <div class="form-control <?php echo $var = (isset($parameters['errores']['puesto_manip']['form-control']))?$parameters['errores']['puesto_manip']['form-control']:''?>">
                        <label for="puesto_manip">Puesto</label> 
                        <input disabled id="puesto_manip" type="text" name="puesto_manip" value="<?php echo $var = (isset($parameters['errores']['puesto_manip']['text']))?$parameters['errores']['puesto_manip']['text']:''?>"> 
                        <i class="fas fa-check-circle"></i>
                        <i class="fas fa-exclamation-circle"></i>
                        <?php if ($parameters['errores']): ?>
                            <small><?php echo $var = (isset($parameters['errores']['puesto_manip']['small']))?$parameters['errores']['puesto_manip']['small']:''?></small>
                        <?php endif ?>
                    </div>                                          

                    <div class="extender">
                        <div class="form-control <?php echo $var = (isset($parameters['errores']['direccion_estab']['form-control']))?$parameters['errores']['direccion_estab']['form-control']:''?>">
                            <label for="direccion_estab">Dirección establecimiento</label> 
                            <input disabled id="direccion_estab" type="text" name="direccion_estab" value="<?php echo $var = (isset($parameters['errores']['direccion_estab']['text']))?$parameters['errores']['direccion_estab']['text']:''?>"> 
                            <i class="fas fa-check-circle"></i>
                            <i class="fas fa-exclamation-circle"></i>
                            <?php if ($parameters['errores']): ?>
                                <small><?php echo $var = (isset($parameters['errores']['direccion_estab']['small']))?$parameters['errores']['direccion_estab']['small']:''?></small>
                            <?php endif ?>
                        </div>  
                    </div>

                    <div class="form-control <?php echo $var = (isset($parameters['errores']['estado_exam']['form-control']))?$parameters['errores']['estado_exam']['form-control']:''?>">
                        <label for="estado_exam">Estado del examen</label> 
                        <input disabled id="estado_exam" type="text" name="estado_exam" value="<?php echo $var = (isset($parameters['errores']['estado_exam']['text']) AND $parameters['errores']['estado_exam']['text'] == 'Acto')?'Apto':'No apto'?>"> 
                        <i class="fas fa-check-circle"></i>
                        <i class="fas fa-exclamation-circle"></i>
                        <?php if ($parameters['errores']): ?>
                            <small><?php echo $var = (isset($parameters['errores']['estado_exam']['small']))?$parameters['errores']['estado_exam']['small']:''?></small>
                        <?php endif ?>
                    </div> 

                    <div class="form-control">
                        <label for="fecha_entrega_so">fecha entrega SO</label> 
                        <input id="fecha_entrega_so" type="date" name="fecha_entrega_so" value="<?php echo $var = (isset($parameters['errores']['fecha_entrega_so']))?$parameters['errores']['fecha_entrega_so']:''?>"> 
                        <i class="fas fa-check-circle"></i>
                        <i class="fas fa-exclamation-circle"></i>
                    </div>

                    <div class="form-control">                        
                        <label for="exam_s">Examen S</label> 
                        <select id="exam_s" name="exam_s"> 
                            <option value="No entregado" <?php if($parameters['errores'] != []){echo $var = ($parameters['errores']['exam_s'] == 'No entregado')? 'selected': '';}?>>No entregado</option> 
                            <option value="DN" <?php if($parameters['errores'] != []){echo $var = ($parameters['errores']['exam_s'] == 'DN')? 'selected': '';}?>>DN</option> 
                            <option value="FN" <?php if($parameters['errores'] != []){echo $var = ($parameters['errores']['exam_s'] == 'FN')? 'selected': '';}?>>FN</option> 
                        </select>
                    </div>

                    <div class="form-control">                        
                        <label for="exam_o">Examen O</label> 
                        <select id="exam_o" name="exam_o"> 
                            <option value="No entregado" <?php if($parameters['errores'] != []){echo $var = ($parameters['errores']['exam_o'] == 'No entregado')? 'selected': '';}?>>No entregado</option> 
                            <option value="DN" <?php if($parameters['errores'] != []){echo $var = ($parameters['errores']['exam_o'] == 'DN')? 'selected': '';}?>>DN</option> 
                            <option value="FN" <?php if($parameters['errores'] != []){echo $var = ($parameters['errores']['exam_o'] == 'FN')? 'selected': '';}?>>FN</option> 
                        </select>
                    </div>
                    
                    <?php if($parameters['errores']['fecha_entrega_so2'] != ''):?>
                    
                    <div class="form-control">
                        <label for="fecha_entrega_so2">fecha entrega SO2</label> 
                        <input id="fecha_entrega_so2" type="date" name="fecha_entrega_so2" value="<?php echo $var = (isset($parameters['errores']['fecha_entrega_so2']))?$parameters['errores']['fecha_entrega_so2']:''?>"> 
                        <i class="fas fa-check-circle"></i>
                        <i class="fas fa-exclamation-circle"></i>
                    </div>

                    <div class="form-control">                        
                        <label for="exam_s2">Examen S2</label> 
                        <select id="exam_s2" name="exam_s2"> 
                            <option value="No entregado" <?php if($parameters['errores'] != []){echo $var = ($parameters['errores']['exam_s2'] == 'No entregado')? 'selected': '';}?>>No entregado</option> 
                            <option value="DN" <?php if($parameters['errores'] != []){echo $var = ($parameters['errores']['exam_s2'] == 'DN')? 'selected': '';}?>>DN</option> 
                            <option value="FN" <?php if($parameters['errores'] != []){echo $var = ($parameters['errores']['exam_s2'] == 'FN')? 'selected': '';}?>>FN</option> 
                        </select>
                    </div>

                    <div class="form-control">                        
                        <label for="exam_o2">Examen O2</label> 
                        <select id="exam_o2" name="exam_o2"> 
                            <option value="No entregado" <?php if($parameters['errores'] != []){echo $var = ($parameters['errores']['exam_o2'] == 'No entregado')? 'selected': '';}?>>No entregado</option> 
                            <option value="DN" <?php if($parameters['errores'] != []){echo $var = ($parameters['errores']['exam_o2'] == 'DN')? 'selected': '';}?>>DN</option> 
                            <option value="FN" <?php if($parameters['errores'] != []){echo $var = ($parameters['errores']['exam_o2'] == 'FN')? 'selected': '';}?>>FN</option> 
                        </select>
                    </div>

                    <?php else:?>
                        <div class="form-control" style="display: none;">
                        <label for="fecha_entrega_so2">fecha entrega SO2</label> 
                        <input id="fecha_entrega_so2" type="date" name="fecha_entrega_so2" value="<?php echo $var = (isset($parameters['errores']['fecha_entrega_so2']))?$parameters['errores']['fecha_entrega_so2']:''?>"> 
                        <i class="fas fa-check-circle"></i>
                        <i class="fas fa-exclamation-circle"></i>
                    </div>

                    <div class="form-control" style="display: none;">                        
                        <label for="exam_s2">Examen S2</label> 
                        <select id="exam_s2" name="exam_s2"> 
                            <option value="No entregado" <?php if($parameters['errores'] != []){echo $var = ($parameters['errores']['exam_s2'] == 'No entregado')? 'selected': '';}?>>No entregado</option> 
                            <option value="DN" <?php if($parameters['errores'] != []){echo $var = ($parameters['errores']['exam_s2'] == 'DN')? 'selected': '';}?>>DN</option> 
                            <option value="FN" <?php if($parameters['errores'] != []){echo $var = ($parameters['errores']['exam_s2'] == 'FN')? 'selected': '';}?>>FN</option> 
                        </select>
                    </div>

                    <div class="form-control" style="display: none;">                        
                        <label for="exam_o2">Examen O2</label> 
                        <select id="exam_o2" name="exam_o2"> 
                            <option value="No entregado" <?php if($parameters['errores'] != []){echo $var = ($parameters['errores']['exam_o2'] == 'No entregado')? 'selected': '';}?>>No entregado</option> 
                            <option value="DN" <?php if($parameters['errores'] != []){echo $var = ($parameters['errores']['exam_o2'] == 'DN')? 'selected': '';}?>>DN</option> 
                            <option value="FN" <?php if($parameters['errores'] != []){echo $var = ($parameters['errores']['exam_o2'] == 'FN')? 'selected': '';}?>>FN</option> 
                        </select>
                    </div>
                    <?php endif;?>

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