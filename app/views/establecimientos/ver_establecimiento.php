<?php require_once('../app/views/inc/header.php'); ?>


<!-- Agregar boton regresar y mensaje-->
<p><a href="<?php echo $parameters['regresar']?>"><i class="fas fa-arrow-circle-left" style=" color: #1236da;"></i> Regresar</a></p>    
<br>
<p><?php echo $parameters['mensaje']?></p>
<br>
<p><?php echo  $parameters['establecimiento']->fecha_reg_estab.'; '.$parameters['establecimiento']->fecha_mod_estab .' Por '. $parameters['establecimiento']->usermod ?></p>
<div class="caja">
    <div class="contact-wrapper animated bounceInUp">
        <div class="contact-form">
            <div class="encabezado">
                <h3>Ver establecimiento</h3>
                <i class="fas fa-store"></i>
            </div>


            <form action="" id="form-estableciento" class="form">


              <div class="form-control">
                <label for="nombremanip">Establecimiento</label>
                <input disabled type="text" id="nombreestab" name="nombreestab" value="<?php echo $parameters['establecimiento']->nombre_estab?>">
            </div>

            <div class="form-control">
                <label for="nombre_prop">Propietario</label>
                <input disabled type="text" id="nombre_prop" name="nombre_prop" value="<?php echo $parameters['establecimiento']->nombre_prop.' '.$parameters['establecimiento']->apellido_prop ?>">
            </div>




            <div class="form-control">
             <label for="dui">Dui</label>
             <input disabled type="text" id="dui" name="dui_prop" value="<?php echo $parameters['establecimiento']->dui_prop?>">
         </div>

         <div class="form-control">
             <label for="dui">Categoria</label>
             <input disabled type="text" id="categoria" name="categoria" value="<?php echo $parameters['establecimiento']->cat_estab?>">
         </div>

         <div class="form-control">
             <label for="tipo">Tipo</label>
             <input disabled type="text" id="tipo" name="tipo" value="<?php echo $parameters['establecimiento']->tipo_estab?>">
         </div>

         <div class="form-control">
             <label for="apartado">Apartado especifico</label>
             <input disabled type="text" id="apartado" name="apartado" value="<?php echo $parameters['establecimiento']->apartado_especifico?>">
         </div>


         <div class="form-control">
            <label for="estado">Estado</label>
           <input disabled type="text" id="estado" name="estado" value="<?php echo $parameters['establecimiento']->estado_estab?>">
       </div>

            <div class="form-control">
             <label for="dui">Telefono</label>
             <input disabled type="text" id="categoria" name="categoria" value="<?php echo $parameters['establecimiento']->telefono_estab?>">
         </div>


              <div class="form-control">
             <label for="dui">Direccion</label>
             <input disabled type="text" id="categoria" name="categoria" value="<?php echo $parameters['establecimiento']->direccion_estab?>">
         </div>










 </form>
</div>
</div>
</div> 

<?php require_once('../app/views/inc/footer.php'); ?>