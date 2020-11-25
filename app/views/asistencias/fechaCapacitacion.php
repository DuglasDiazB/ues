<!-- Llamando el header -->
<?php require_once('../app/views/inc/header.php'); ?>
<p><a href="<?php echo $parameters['regresar']?>"><i class="fas fa-arrow-circle-left" style=" color: #1236da;"></i> Regresar</a></p>    
<p><?php echo $parameters['mensaje']?></p>


<form action="<?php echo ROUTE_URL?>/asistencias/fechaCapacitacion" method= "post" id="form-fechaCapacitacion" class="form-fechaCapacitacion">
    <div class="encabezado">
        <h3>Ingresar Fecha</h3>
        <i class="fas fa-calendar" aria-hidden="true"></i>
    </div>

    <div class="form-control <?php echo $var = (isset($parameters['errores']['fechainiciocapacit']['form-control']))?$parameters['errores']['fechainiciocapacit']['form-control']:''?>">
        <label for="fechainiciocapacit">Fecha inicio de capacitacion</label>
        <input type="date" id="fechainiciocapacit" name='fechainiciocapacit' value="<?php echo $var = (isset($parameters['errores']['fechainiciocapacit']['text']))?$parameters['errores']['fechainiciocapacit']['text']:''?>">
        <i class="fas fa-check-circle"></i>
        <i class="fas fa-exclamation-circle"></i>
        <?php if ($parameters['errores']): ?>
            <small><?php echo $var = (isset($parameters['errores']['fechainiciocapacit']['small']))?$parameters['errores']['fechainiciocapacit']['small']:''?></small>
        <?php endif ?>
            <small></small>
    </div>

    <div class="form-control <?php echo $var = (isset($parameters['errores']['fechafincapacit']['form-control']))?$parameters['errores']['fechafincapacit']['form-control']:''?>">
        <label for="fechafincapacit">Fecha fin de capacitacion</label>
        <input type="date" id="fechafincapacit" name='fechafincapacit' value="<?php echo $var = (isset($parameters['errores']['fechafincapacit']['text']))?$parameters['errores']['fechafincapacit']['text']:''?>">
        <i class="fas fa-check-circle"></i>
        <i class="fas fa-exclamation-circle"></i>
        <?php if ($parameters['errores']): ?>
            <small><?php echo $var = (isset($parameters['errores']['fechafincapacit']['small']))?$parameters['errores']['fechafincapacit']['small']:''?></small>
        <?php endif ?>
            <small></small>
    </div>

    <!--Clase boton para los estilos   --> 
    <div class="boton">         
        <input id="submit" type="submit" name="submit" value="Guardar"> 
    </div>



</form>

        
<!-- Llamando el footer -->
<?php require_once('../app/views/inc/footer.php'); ?>