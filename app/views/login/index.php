<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $parameters['title']?></title>
    <link rel="icon" href="img/logominsal.png" type="logominsal/png" size="16x16">
    <link rel="stylesheet" href="<?php echo ROUTE_URL?>/fontawesome/css/all.css">
    <link rel="stylesheet" href="<?php echo ROUTE_URL?>/css/reset.css">
    <link rel="stylesheet" href="<?php echo ROUTE_URL?>/css/login.css">
</head>
<body>
    <div class="login-box">
        <div class="login-encabezado">
            <i class="fas fa-user-lock"></i>
            <h3>Login</h3>
        </div>
        <form action="<?php echo ROUTE_URL?>/login/index" method= "post" class="form">
            <div class="login-input <?php echo $parameters['valor1']?>" style="width: 80%">
                <label for="usuario">Usuario</label> 
                <input id="usuario" type="text" name="usuario" style="width: 100%" value="<?php echo $parameters['usuario']?>"> 
                <i class="fas fa-check-circle"></i>
                <i class="fas fa-exclamation-circle"></i>
                <small><?php echo $parameters['errores']['usuario']?></small>
            </div>

            <div class="login-input <?php echo $parameters['valor2']?>" style="width: 80%">
                <label for="password">Contraseña</label> 
                <input id="pass" type="password" name="pass" style="width: 100%"> 
                <i class="fas fa-check-circle"></i>
                <i class="fas fa-exclamation-circle"></i>
                 <small><?php echo $parameters['errores']['pass']?></small>
            </div>

            <div class="boton"> 
                <input id="submit" type="submit" name="submit" value="Ingresar" style="margin-left: 4px;"> 
            </div>
        </form>
    </div>
</body>
</html>