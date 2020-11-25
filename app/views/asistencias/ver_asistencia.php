<!-- Llamando el header -->
<?php require_once('../app/views/inc/header.php'); ?>
<p><a href="<?php echo $parameters['regresar']?>"><i class="fas fa-arrow-circle-left" style=" color: #1236da;"></i> Regresar</a></p>    
<p><?php echo $parameters['mensaje']?></p>
        <div class="contact-wrapper animated bounceInUp">
            <div class="contact-form">
                <div class="encabezado">
                    <h3>Ver Asistencia</h3>
                    <i class="fas fa-clipboard-list" aria-hidden="true"></i>
                </div>
            
                <form action="" method= "post" id="form-asistencia" class="form">
                    
                    <div class="form-control">
                        <label for="nombre">Nombre</label>
                        <input disabled type="text" id="nombre" name="nombre" value="<?php echo $var = (isset($parameters['asistencia']->nombre_manip))?$parameters['asistencia']->nombre_manip:''?>">
                    </div>
                   
                    <div class="form-control">
                        <label for="apellido">Apellido</label>
                        <input disabled type="text" id="apellido" name="apellido" value="<?php echo $var = (isset($parameters['asistencia']->apellido_manip))?$parameters['asistencia']->apellido_manip:''?>">
                    </div>

                    <div class="form-control">
                        <label for="dui">DUI</label> 
                        <input disabled id="dui" type="text" name="dui" value="<?php echo $var = (isset($parameters['asistencia']->dui_manip))?$parameters['asistencia']->dui_manip:''?>"> 
                        <i class="fas fa-check-circle"></i>
                        <i class="fas fa-exclamation-circle"></i>
                    </div>

                    <div class="form-control">
                        <label for="establecimiento">Establecimiento</label>
                        <input disabled type="text" id="establecimiento" name="establecimiento" value="<?php echo $var = (isset($parameters['asistencia']->nombre_estab))?$parameters['asistencia']->nombre_estab:''?>">
                    </div>

                    <div class="form-control">
                        <label for="tipoEstablecimiento">Tipo Establecimiento</label> 
                        <select disabled id="tipoEstablecimiento" name="tipoEstablecimiento"> 
                            <option value="Formal" <?php echo $var = ($parameters['asistencia']->tipo_estab == 'Formal')? 'selected': ''?>>Formal</option> 
                            <option value="Informal" <?php echo $var = ($parameters['asistencia']->tipo_estab == 'Informal')? 'selected': ''?>>Informal</option> 
                        </select>
                    </div>

                    <div class="form-control">
                        <label for="categoriaEstablecimiento">Categoria Establecimiento</label>
                        <input disabled type="text" id="categoriaEstablecimiento" name="categoriaEstablecimiento" value="<?php echo $var = (isset($parameters['asistencia']->cat_estab))?$parameters['asistencia']->cat_estab:''?>">
                    </div>

                    
                    <div class="extender">
                        <div class="form-control">
                            <label for="direccion">Direccion</label>
                            <input  disabled type="text" id="direccion" name="direccion" value="<?php echo $var = (isset($parameters['asistencia']->direccion_estab))?$parameters['asistencia']->direccion_estab:''?>">
                        </div>
                    </div>

                    <div class="form-control">
                        <label for="puestoManipulador">Puesto</label>
                        <input disabled type="text" id="puestoManipulador" name="puestoManipulador" value="<?php echo $var = (isset($parameters['asistencia']->puesto_manip))?$parameters['asistencia']->puesto_manip:''?>">
                    </div>

                    <div class="form-control">
                        <label for="fechacapacitacion">Fecha Capacitacion</label>
                        <input disabled type="date" id="fechacapacitacion" name='fechacapacitacion' value="<?php echo $var = (isset($parameters['asistencia']->fecha_asist_capacit))?$parameters['asistencia']->fecha_asist_capacit:''?>">
                    </div>

                    <div class="form-control">
                        <label for="asistencia">Asistencia</label> 
                        <select disabled id="asistencia" name="asistencia"> 
                            <option value="Si" <?php echo $var = ($parameters['asistencia']->asistencia == 'Si')? 'selected': ''?>>Si</option> 
                            <option value="No" <?php echo $var = ($parameters['asistencia']->asistencia == 'No')? 'selected': ''?>>No</option> 
                        </select>
                    </div>

                    <div class="form-control">
                        <label for="estadoExamenes">Estado Examenes</label> 
                        <select disabled id="estadoExamenes" name="estadoExamenes"> 
                            <option value="Acto" <?php echo $var = ($parameters['asistencia']->estado_exam == 'Acto')? 'selected': ''?>>Acto</option> 
                            <option value="No Acto" <?php echo $var = ($parameters['asistencia']->estado_exam == 'No acto')? 'selected': ''?>>No acto</option> 
                        </select>
                    </div>

                </form>
            </div>
        </div>
    </div> 
<!-- Llamando el footer -->
<?php require_once('../app/views/inc/footer.php'); ?>