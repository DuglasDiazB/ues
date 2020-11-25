<!-- Llamando el header -->
<?php require_once('../app/views/inc/header.php'); ?>
<p> <a href="<?php echo $parameters['regresar']?>"><i class="fas fa-arrow-circle-left" style=" color: #1236da;"></i>Regresar</a></p>   
<p>No se admite editar inspección</p>
<p><?php echo $parameters['mensaje'] ?></p>

        <div class="contact-wrapper animated bounceInUp">
            <div class="contact-form">
                <div class="encabezado">
                    <h3>Ver Inspección</h3>
                    <i class="fas fa-user-secret" aria-hidden="true"></i>
                </div>
            
                <form action="" method= "post" id="form-inspeccion" class="form">
                    <div class="extender">
                        <div class="form-control">
                            <label for="establecimiento">Establecimiento</label>
                            <input disabled type="text" id="establecimiento" name="establecimiento" value="<?php echo $var = (isset($parameters['inspeccion']->nombre_estab))?$parameters['inspeccion']->nombre_estab:''?>">
                        </div>
                    </div>

                    <div class="form-control">
                        <label for="objetoVisita">Objeto Visita</label> 
                        <select disabled id="objetoVisita" name="objetoVisita"> 
                            <option value="Tramite de permiso" <?php echo $var = ($parameters['inspeccion']->objeto_visita == 'Tramite de permiso')? 'selected': ''?>>Tramite de permiso</option> 
                            <option value="Inspección de control" <?php echo $var = ($parameters['inspeccion']->objeto_visita == 'Inspección de control')? 'selected': ''?>>Inspección de control</option> 
                            <option value="Denuncia" <?php echo $var = ($parameters['inspeccion']->objeto_visita == 'Denuncia')? 'selected': ''?>>Denuncia</option>
                        </select>
                    </div>

                    <div class="extender">
                        <div class="form-control">
                            <label for="inspector">Nombre Inspector</label>
                            <input  disabled type="text" id="nombreInspector" name="nombreInspector" value="<?php echo $var = (isset($parameters['inspeccion']->nombre_inspector))?$parameters['inspeccion']->nombre_inspector:''?>">
                        </div>
                    </div>

                    <div class="form-control">
                        <label for="inspeccionPara">Inspección Para</label> 
                        <select disabled id="inspeccionPara" name="inspeccionPara"> 
                            <option value="Autorización nueva" <?php echo $var = ($parameters['inspeccion']->inspec_para == 'Autorización nueva')? 'selected': ''?>>Autorización nueva</option> 
                            <option value="Renovación" <?php echo $var = ($parameters['inspeccion']->inspec_para == 'Renovación')? 'selected': ''?>>Renovación</option> 
                            <option value="Control" <?php echo $var = ($parameters['inspeccion']->inspec_para == 'Control')? 'selected': ''?>>Control</option>
                        </select>
                    </div>

                    <div class="form-control">
                        <label for="fechaInspeccion">Fecha Inspeccion</label>
                        <input disabled type="date" id="fechaInspeccion" name='fechaInspeccion' value="<?php echo $var = (isset($parameters['inspeccion']->fecha_inspec))?$parameters['inspeccion']->fecha_inspec:''?>">
                    </div>
                   
                    <div class="form-control">
                        <label for="notaPinspeccion">Nota 1° Inspeccion</label>
                        <input disabled type="text" id="notaPinspeccion" name="notaPinspeccion" value="<?php echo $var = (isset($parameters['inspeccion']->cal_primer_inspec))?$parameters['inspeccion']->cal_primer_inspec:''?>">
                    </div>

                    <?php if ($parameters['inspeccion']->primer_reinspec_cal != NULL):?>

                    <div class="form-control">
                        <label for="pReinspecfecha">1° Reinspec Fecha</label>
                        <input disabled type="date" id="pReinspecfecha" name="pReinspecfecha" value="<?php echo $var = (isset($parameters['inspeccion']->primer_reinspec_fecha))?$parameters['inspeccion']->primer_reinspec_fecha:''?>">
                    </div>

                    <div class="form-control">
                        <label for="pReinspecnota">1° Reinspec Nota</label>
                        <input disabled type="text" id="pReinspecnota" name="pReinspecnota" value="<?php echo $var = (isset($parameters['inspeccion']->primer_reinspec_cal))?$parameters['inspeccion']->primer_reinspec_cal:''?>">
                    </div>

                    <?php endif;?>
                    
                    <?php if ($parameters['inspeccion']->segunda_reinspec_fecha != NULL):?>

                    <div class="form-control">
                        <label for="sReinspecfecha">2° Reinspec Fecha</label>
                        <input disabled type="date" id="sReinspecfecha" name="sReinspecfecha" value="<?php echo $var = (isset($parameters['inspeccion']->segunda_reinspec_fecha))?$parameters['inspeccion']->segunda_reinspec_fecha:''?>">
                    </div>

                    <div class="form-control">
                        <label for="sReinspecnota">2° Reinspec Nota</label>
                        <input disabled type="text" id="sReinspecnota" name="sReinspecnota" value="<?php echo $var = (isset($parameters['inspeccion']->segunda_reinspec_cal))?$parameters['inspeccion']->segunda_reinspec_cal:''?>">
                    </div>

                    <?php endif;?>
                </form>
            </div>
        </div>
    </div> 
<!-- Llamando el footer -->
<?php require_once('../app/views/inc/footer.php'); ?>