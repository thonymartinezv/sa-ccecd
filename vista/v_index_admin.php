<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Simple Sidebar - Start Bootstrap Template</title>

  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

  <!-- Custom styles for this template -->
  <link href="css/simple-sidebar.css" rel="stylesheet">

</head>

<body>

  <div class="d-flex" id="wrapper">

    <!-- Sidebar -->
    <div class="bg-dark border-right" id="sidebar-wrapper">
      <div class="sidebar-heading">
            <div class="row">
                <img src="img/bandera.png" width="30" height="30" class="d-inline-block align-top" alt="" loading="lazy">
                <div class="title-navbar">
                    <p class="lead title-small">Gobierno Bolivariano</p><br>
                    <p class="lead title-small">de Venezuela</p>
                </div>
                <div class="line-vertical"></div>
                <div class="title-navbar-2">
                    <p class="lead title-small">Ministerio del Poder Popular</p><br>
                    <p class="lead title-small">para <strong>Ciencia y Tecnología</strong></p>
                </div>
            </div>
      </div>
      <div class="list-group list-group-flush">
        <a href="" class="list-group-item list-group-item-action bg-dark activo">Gestionar Empleado</a>
        <a href="?c=gestionar_acceso" class="list-group-item list-group-item-action bg-dark">Gestionar Acceso</a>
        <a href="?c=gestionar_estadisticas" class="list-group-item list-group-item-action bg-dark">Gestionar Estadística</a>
      </div>
    </div>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">

      <nav class="navbar navbar-expand-lg navbar-dark bg-dark border-bottom">
        <button class="navbar-toggler always-show" id="menu-toggle">
            <span class="navbar-toggler-icon"></span>
        </button>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
            <li class="nav-item">
              <a class="nav-link" href="?c=CS">Cerrar Sesión <span class="sr-only">(current)</span></a>
            </li>
          </ul>
        </div>
      </nav>

      <div class="container-fluid">
        <nav class="mt-2">
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" data-toggle="tab" href="#nav-ce">Crear Empleado</a>
                <a class="nav-item nav-link" data-toggle="tab" href="#nav-cpe">Consultar Perfil de Empleado</a>
                <a class="nav-item nav-link" data-toggle="tab" href="#nav-ape">Actualizar Perfil Empleado</a>
                <a class="nav-item nav-link" data-toggle="tab" href="#nav-de">Deshabilitar Empleado</a>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-ce"><h1 class="display-4 mt-4 ml-4">Creación de empleado...</h1></div>
            <div class="tab-pane fade show" id="nav-cpe"><h1 class="display-4 mt-4 ml-4">Consulta de perfil de empleado...</h1></div>
            <div class="tab-pane fade show" id="nav-ape"><h1 class="display-4 mt-4 ml-4">Actualización de perfil de empleado...</h1></div>
            <div class="tab-pane fade show" id="nav-de"><h1 class="display-4 mt-4 ml-4">Deshabilitar empleado...</h1></div>
        </div> 
      </div>
    </div>
    <!-- /#page-content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <!-- Bootstrap core JavaScript -->

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>


  <!-- Menu Toggle Script -->
  <script>
    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });
  </script>

</body>

</html>