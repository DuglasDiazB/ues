<?php require_once('../app/views/inc/header.php'); ?>

<p><?php echo  $parameters['mensaje']?></p>
<p><?php echo  $parameters['manipulador']->fecha_registro_manip.'; '.$parameters['manipulador']->fecha_mod_manip .' por '. $parameters['manipulador']->usermod ?></p>
<!--<p><?php echo $parameters['manipulador']->usermod ?></p>-->
<div class="caja">
    <div class="contact-wrapper animated bounceInUp">
        <div class="contact-form">
            <div class="encabezado">
                <h3>Ver manipulador</h3>
                <i class="fas fa-user"></i>
            </div>




            <form action="" id="form-manipulador" class="form">


              <div class="form-control">
                <label for="nombremanip">Nombre</label>
                <input disabled type="text" id="nombremanip" name="nombremanip" value="<?php echo $parameters['manipulador']->nombre_manip.' '.$parameters['manipulador']->nombre_manip ?>">
            </div>




             <div class="form-control">
                    <label for="nombre">Nombre</label>
                    <input disabled type="text" id="nombre" name="nombre" value="<?php echo $var = (isset($parameters['manipulador']->nombre_manip))?$parameters['manipulador']->apellido_manip:''?>">
                    <i class="fas fa-check-circle"></i>
                    <i class="fas fa-exclamation-circle"></i>
                </div>

       


       

         <div class="form-control">
             <label for="dui">Dui</label>
             <input disabled type="text" id="" name="dui" value="<?php echo $parameters['manipulador']->dui_manip?>">
         </div>

         <div class="form-control">
             <label for="puesto">Puesto</label>
             <input disabled type="text" id="" name="puesto" value="<?php echo $parameters['manipulador']->puesto_manip?>">
         </div>


         <div class="form-control">
             <label for="genero">Genero</label>
             <input disabled type="text" id="" name="genero" value="<?php echo $parameters['manipulador']->genero_manip?>">
         </div>

         <div class="form-control">
             <label for="Establecimiento">Establecimiento</label>
             <input disabled type="text" id="" name="establcimienti" value="<?php echo $parameters['manipulador']->nombre_estab?>">
         </div>


         <div class="form-control">
             <label for="sector">Sector</label>
             <input disabled type="text" id="" name="secotr" value="<?php echo $parameters['manipulador']->tipo_estab?>">
         </div>

         <div class="form-control">
             <label for="fecha_nacim_manip">Fecha de Nacimiento</label>
             <input disabled type="text" id="" name="fecha_nacim_manip" value="<?php echo $parameters['manipulador']->fecha_nacim_manip?>">
         </div>



























     </form>
 </div>
</div>
</div> 

<?php require_once('../app/views/inc/footer.php'); ?>