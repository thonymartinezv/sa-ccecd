<html>
    <head>
      <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Sistema de control de acceso al CCECD</title>
        <link rel="icon" href="img/bandera.png">
        
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        
        <script type="text/javascript">
                function Iniciar(valor) 
                {
                    /** Condición que valida si el boton submit ha sido oprimido **/
                    if (valor == "Iniciar sesión"){
                        
                        /** Condición que permite conocer si los campos se encuentras vacíos o no **/
                        if ((document.form1.usu_otic.value == "" || document.form1.clv_otic.value == "")) {
                            alert('No puede iniciar sesión con los campos vacíos');		
                        
                        /** Si los campos no están vacíos, se envía los datos al controlador para constatar que el usuario existe en la BD **/
                        } else {
                            document.form1.action="?c=IS";
                            document.form1.method= 'POST';
                            document.form1.submit();
                        }
                    }
                }
        </script>
        <style>
            .btn-primary {
                background-color: #343a40 !important;
                border-color: #343a40 !important;
            }
            .btn-primary:hover,
            .btn-primary:active,
            .btn-primary:visited,
            .btn-primary:focus {
                background-color: #343a40 !important;
                border-color: #343a40 !important;
            }
            .btn-link{
                color:#343a40 !important;
            }
            .title-form{
                text-align: center;
                font-size:medium!important;
            }
            .title-navbar{
                line-height:0px;
                padding-left: 10px;
                padding-top: 10px;
                color: white;
            }
            .title-small {
                font-size:small!important;
            }
            .line-vertical{
                width: 1px;
                height: 40px;
                background-color: rgba(255, 255, 255, 0.75);
                margin-top: -2.5px;
                margin-left: 5px;
                margin-right: 5px;
            }
            .title-small strong{
                font-weight: bold;
            }
        </style>
    </head>
    <body style="background-color:f9f9f9;">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <img src="img/bandera.png" width="30" height="30" class="d-inline-block align-top" alt="" loading="lazy">
            <div class="title-navbar">
                <p class="lead title-small">Gobierno Bolivariano</p><br>
                <p class="lead title-small">de Venezuela</p>
            </div>
            <div class="line-vertical"></div>
            <div class="title-navbar">
                <p class="lead title-small">Ministerio del Poder Popular</p><br>
                <p class="lead title-small">para <strong>Ciencia y Tecnología</strong></p>
            </div>
        </nav>
        <?php 
            if (isset($_GET['error'])) {
                echo 
                '
                    <div class="container pt-4">
                        <div class="alert alert-danger" role="alert">
                            Usuario o contraseña incorrectos, por favor verifique los datos ingresados al formulario.
                        </div>
                    </div>
                '
                ;
            }else{
                echo '<div class="container pt-3"></div>';
            }
        ?>
        <div class="row col-xl-12 d-flex justify-content-center">
            <div class="card-body card col-xl-3 col-sm-12 col-lg-4 col-md-3 mt-2">
                <div class="col-12 d-flex justify-content-center pb-1 mt-2">
                    <img class="thumbnail" src="img/logo2.png" width="70" height="70">
                </div>
                <div class="col-12 d-flex justify-content-center mt-3">
                    <p class="lead title-form">
                        Sistema de Acceso al Cuarto de Cableado Estructucado y Centro de Datos
                    </p>
                </div>
                <form id="form1" name="form1" autocomplete="off">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nombre de Usuario</label>
                        <input type="text" class="form-control" placeholder="Usuario" name="usu_otic">
                        <small class="form-text text-muted">No incluir caracteres especiales.</small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Contraseña</label>
                        <input type="password" class="form-control" placeholder="Contraseña" name="clv_otic">
                    </div>
                    <div class="form-group">
                        <a type="button" class="btn btn-link btn-sm">Si olvidó su contraseña debe contactar con soporte de OTIC</a>
                    </div>
                    <button type="button" onClick="Iniciar(this.value)" value="Iniciar sesión" class="btn btn-primary">Entrar</button>
                </form>
            </div>
        </div>
    </body>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</html>