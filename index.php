<!doctype html>
<html>
    <head>
        <link rel="shortcut icon" href="#" />
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Inicio de sesion</title>
        <link rel="icon" href="img/user-solid.svg" type="image/svg+xml">
        
        <script src="https://kit.fontawesome.com/03a89292db.js" crossorigin="anonymous"></script>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="estilos.css">
        <link rel="stylesheet" href="plugins/sweetalert2/sweetalert2.min.css">        
        
        <link rel="stylesheet" type="text/css" href="fuentes/iconic/css/material-design-iconic-font.min.css">
        
    </head>
    
    <body>
    <h1>Inicio de sesion <br><span class="span1">(Solo personal autorizado)</span></h1>
    <div class="container">
        <div class="logo">
            <img class="logo_img" src="img/logo.svg" alt="">
        </div>
        <form action="" class="form" id="formLogin" method="post">
            <div class="form__usuario" data-validate = "Usuario incorrecto">
                <label for=""></label>
                <input type="text" class="usuario" id="usuario" name="usuario" placeholder="Usuario">
            </div>
            <div class="form__clave" data-validate="Password incorrecto">
                <label for=""></label>
                <input type="password" class="clave" id="password" name="password" placeholder="Password">
                <span id="ver" class="ver_clave"><i id="icono" class="fas fa-eye"></i></span>
            </div>
            <div class="form__boton">
                <div class="login-form-bgbtn"></div>
                <button type="submit" name="submit" class="boton">Ingresar</button>
            </div>
        </form>
    </div>
    
    <script src="main.js"></script>
        
     <script src="jquery/jquery-3.3.1.min.js"></script>    
     <script src="bootstrap/js/bootstrap.min.js"></script>    
     <script src="popper/popper.min.js"></script>    
        
     <script src="plugins/sweetalert2/sweetalert2.all.min.js"></script>    
     <script src="codigo.js"></script>    
    </body>
</html>