<?php require_once('../app/views/inc/header.php'); ?>
    <p> <a href="<?php echo $parameters['regresar']?>"><i class="fas fa-arrow-circle-left" style=" color: #1236da;"></i>Regresar</a></p>
    <br>
    <p><?php echo  $parameters['mensaje']?></p>
    <br>
    <p><?php echo  $parameters['examen']->fechamod .' por el usuario'. $parameters['examen']->usermod ?></p>
    <div class="caja">
        <div class="contact-wrapper animated bounceInUp">
            <div class="contact-form">
                <div class="encabezado">
                    <h3>Ver examen</h3>
                    <i class="fas fa-file-medical"></i>
                </div>
                
                <form action="" id="form-usuario" class="form">
                    <div class="form-control">
                        <label for="dui">DUI</label>
                        <input disabled type="text" id="dui" name="dui" value="<?php echo $var = (isset($parameters['examen']->dui_manip))?$parameters['examen']->dui_manip:''?>">
                        <i class="fas fa-check-circle"></i>
                        <i class="fas fa-exclamation-circle"></i>
                    </div>

                    <div class="form-control">
                        <label for="nombre">Nombre</label>
                        <input disabled type="text" id="nombre" name='nombre' value="<?php echo $var = (isset($parameters['examen']->nombre_manip))?$parameters['examen']->nombre_manip:''?>"> 
                        <i class="fas fa-check-circle"></i>
                        <i class="fas fa-exclamation-circle"></i>
                    </div>

                    <div class="form-control">
                        <label for="Apellido">Apellido</label>
                        <input disabled type="text" id="apellido" name='apellido' value="<?php echo $var = (isset($parameters['examen']->apellido_manip))?$parameters['examen']->apellido_manip:''?>"> 
                        <i class="fas fa-check-circle"></i>
                        <i class="fas fa-exclamation-circle"></i>
                    </div>

                    <div class="extender">
                    <div class="form-control extender">
                        <label for="establecimiento">Trabaja en</label> 
                        <input disabled id="establecimiento" type="text" name="establecimiento" value="<?php echo $var = (isset($parameters['examen']->nombre_estab))?$parameters['examen']->nombre_estab:''?>"> 
                        <i class="fas fa-check-circle"></i>
                        <i class="fas fa-exclamation-circle"></i>
                    </div>
                    </div>   

                    <div class="form-control">
                        <label for="puesto">Puesto</label> 
                        <input disabled id="puesto" type="text" name="puesto" value="<?php echo $var = (isset($parameters['examen']->puesto_manip))?$parameters['examen']->puesto_manip:''?>"> 
                        <i class="fas fa-check-circle"></i>
                        <i class="fas fa-exclamation-circle"></i>
                    </div>                                          

                    <div class="extender">
                        <div class="form-control extender">
                            <label for="direccion">Dirección establecimiento</label> 
                            <input disabled id="direccion" type="text" name="direccion" value="<?php echo $var = (isset($parameters['examen']->direccion_estab))?$parameters['examen']->direccion_estab:''?>"> 
                            <i class="fas fa-check-circle"></i>
                            <i class="fas fa-exclamation-circle"></i>
                        </div>  
                    </div>

                    <div class="form-control">
                        <label for="estadoExamenes">Estado Examenes</label> 
                        <select disabled id="estadoExamen" name="estadoExamen"> 
                            <option value="Acto" <?php echo $var = ($parameters['examen']->estado_exam == 'Acto')? 'selected': ''?>>Apto</option> 
                            <option value="No Acto" <?php echo $var = ($parameters['examen']->estado_exam == 'No acto')? 'selected': ''?>>No apto</option> 
                        </select>
                    </div>

                    <div class="form-control">
                        <label for="fechaSO">fecha entrega SO</label> 
                        <input disabled id="fechaSO" type="text" name="fechaSO" value="<?php echo $var = (isset($parameters['examen']->fecha_entrega_so))?$parameters['examen']->fecha_entrega_so:''?>"> 
                        <i class="fas fa-check-circle"></i>
                        <i class="fas fa-exclamation-circle"></i>
                    </div>

                    <div class="form-control">
                        <label for="examenS">Examen S</label> 
                        <input disabled id="examenS" type="text" name="examenS" value="<?php echo $var = (isset($parameters['examen']->exam_s))?$parameters['examen']->exam_s:''?>"> 
                        <i class="fas fa-check-circle"></i>
                        <i class="fas fa-exclamation-circle"></i>
                    </div>

                    <div class="form-control">
                        <label for="examenO">Examen O</label> 
                        <input disabled id="examenO" type="text" name="examenO" value="<?php echo $var = (isset($parameters['examen']->exam_o))?$parameters['examen']->exam_o:''?>"> 
                        <i class="fas fa-check-circle"></i>
                        <i class="fas fa-exclamation-circle"></i>
                    </div>

                    <div class="form-control">
                        <label for="fechaSO2">fecha entrega SO2</label> 
                        <input disabled id="fechaSO2" type="text" name="fechaSO2" value="<?php echo $var = (isset($parameters['examen']->fecha_entrega_so2))?$parameters['examen']->fecha_entrega_so2:''?>"> 
                        <i class="fas fa-check-circle"></i>
                        <i class="fas fa-exclamation-circle"></i>
                    </div>

                    <div class="form-control">
                        <label for="examenS2">Examen S2</label> 
                        <input disabled id="examenS2" type="text" name="examenS2" value="<?php echo $var = (isset($parameters['examen']->exam_s2))?$parameters['examen']->exam_s2:''?>"> 
                        <i class="fas fa-check-circle"></i>
                        <i class="fas fa-exclamation-circle"></i>
                    </div>

                    <div class="form-control">
                        <label for="examenO2">Examen O2</label> 
                        <input disabled id="examenO2" type="text" name="examenO2" value="<?php echo $var = (isset($parameters['examen']->exam_o2))?$parameters['examen']->exam_o2:''?>"> 
                        <i class="fas fa-check-circle"></i>
                        <i class="fas fa-exclamation-circle"></i>
                    </div>
                    
                 </form>
            </div>
        </div>
    </div> 
 
<?php require_once('../app/views/inc/footer.php'); ?>