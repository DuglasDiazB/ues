<!-- Llamando el header -->
<?php require_once('../app/views/inc/header.php'); ?>
<p><a href="<?php echo $parameters['regresar']?>"><i class="fas fa-arrow-circle-left" style=" color: #1236da;"></i> Regresar</a></p>   
<br> 
<!-- <p><?php echo $parameters['mensaje']?></p> -->
    <form action="" method= "post" id="form-credencial" class="form-credencial">
         <div class="credencial">
            
           <div class="imagen-credencial">
               <a href="#" ><img src="<?php echo ROUTE_URL?>/img/logominsal.png" alt="UCSF" style="width: 85px;
    height: 40px;"></a>
                <a href="#" ><img src="<?php echo ROUTE_URL?>/img/logoalcaldia.jpeg" alt="Alcaldia" style="width: 40px;
    height: 45px;"></a>
            </div>

           <div class="label-credencial">
                <div class="img-credencial">
                    <a href="#" ><img src="<?php echo ROUTE_URL?>/img/alcaldia.jpeg" alt="alcaldia" style="width: 225px;
                height: 245px;"></a>
                </div>
                <div class="label-encabezado">
                    <label>EL MINISTERIO DE SALUD Y LA ALCALDIA MUNICIPAL DE SAN FRANCISCO GOTERA</label>
                </div>

                <div class="label-cuerpo">
                    <label for="nombre" >HACE CONSTAR QUE:</label>
                </div>

                <div class="label-nombre">
                    <label type="text" id="nombre" name="nombre" ><?php echo $var = (isset($parameters['credencial']->nombre_manip))?$parameters['credencial']->nombre_manip:''?> <?php echo $var = (isset($parameters['credencial']->apellido_manip))?$parameters['credencial']->apellido_manip:''?></label>
                </div>
            
                <div class="label-cuerpo">
                    <label for="">ES MANIPULADOR DE ALIMENTOS AUTORIZADO</label>
                </div>

                <div class="label-cuerpo">
                    <label for="">DUI: <?php echo $var = (isset($parameters['credencial']->dui_manip))?$parameters['credencial']->dui_manip:''?></label>
                </div>

                <div class="label-cuerpo">
                    <label for="">FECHA DE VENCIMIENTO: <?php echo $var = (isset($parameters['credencial']->fecha_exped_creden))?$parameters['credencial']->fecha_exped_creden:''?></label>
                </div>

                <div class="label-firma">
                    <label for="">F._____________________   F.__________________</label>
                    <br>
                    <label for="">DIRECTOR LOCAL MINSAL  ALCALDE MUNICIPAL</label>
                </div>
               

                <div class="label-cuerpo">
                    <label for="">DADO EN SAN FRANCISCO GOTERA</label>
                </div>
                <div class="label-cuerp">
                    <label for="">ESTE CARNET ES INTRANSFERIBLE</label>
                </div>
           </div>

       </div> 


    </form>
    </div> 
<!-- Llamando el footer -->
<?php require_once('../app/views/inc/footer.php'); ?>