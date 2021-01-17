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
  <style>
    .content-accesos{
      font-size:x-small!important;
    }
    .display-4{
      font-size:xx-large!important;
      font-weight:inherit;
    }
  </style>
</head>

<body>

  <div class="d-flex" id="wrapper">

    <?php 
      $activo="acceso";
      include_once("vista/sidebar.php");
    ?>

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
          <ul class="navbar-nav ml-4">
            <li class="nav-item active">
              <a class="nav-link" 
                type="button" 
                data-toggle="modal" 
                data-target="#crearAcceso">
                Crear acceso
              </a>
            </li>
          </ul>
          <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
            <li class="nav-item">
              <a class="nav-link" href="?c=CS">Cerrar Sesión <span class="sr-only">(current)</span></a>
            </li>
          </ul>
        </div>
      </nav>

    <div class="content-accesos">
        <div class="pt-3">
          <div class="container-fluid px-5">
            <?php if(isset($_GET["ms"])){ ?>
              <div class="alert alert-success alert-dismissible fade show sticky-top mt-2 col-7 mx-auto" role="alert">
                <strong>Mensaje:</strong> <?=$_GET["ms"]?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            <?php } else if(isset($_GET["mf"])){?>
              <div class="alert alert-danger alert-dismissible fade show sticky-top mt-2 col-7 mx-auto" role="alert">
                <strong>Mensaje:</strong> <?=$_GET["mf"]?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            <?php }?>
            <p class="display-4">Accesos en proceso</p>
          </div>
          <div class="container-fluid mt-2 overflow-auto">
          <table class="table table-striped mt-4">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Empleado</th>
                    <th scope="col">Administrador</th>
                    <th scope="col">C.I Empleado</th>
                    <th scope="col">C.I Administrador</th>
                    <th scope="col">Prioridad</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Motivo</th>
                    <th class="text-center" scope="col">Finalizar</th>
                    <th class="text-center" scope="col">Cancelar</th>
                </tr>
            </thead>
            <tbody>
              <?php for ($i=0; $i < count($accesos); $i++) { ?>
                  <tr>
                      <td><?=$accesos[$i]["mon_nombre"]?></td>
                      <td><?=$accesos[$i]["adm_nombre"]?></td>
                      <td><?=$accesos[$i]["ci_mon"]?></td>
                      <td><?=$accesos[$i]["ci_adm"]?></td>
                      <td><?=$accesos[$i]["prioridad"]>0?($accesos[$i]["prioridad"]>1?"Alta":"Moderada"):"Baja"?></td>
                      <td><?=$accesos[$i]["fcha_inicio"]?></td>
                      <td><?=$accesos[$i]["motivo"]?></td>
                      <td class="text-center">
                        <button 
                          class="btn btn-info" 
                          type="button" 
                          data-toggle="modal" 
                          data-target="#finalizarAcceso<?=$accesos[$i]["id_acc"]?>">
                          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16"><path fill-rule="evenodd" fill="white" d="M13.78 4.22a.75.75 0 010 1.06l-7.25 7.25a.75.75 0 01-1.06 0L2.22 9.28a.75.75 0 011.06-1.06L6 10.94l6.72-6.72a.75.75 0 011.06 0z"></path></svg>
                        </button>
                      </td>
                      <td class="text-center">
                        <button 
                          class="btn btn-danger"
                          type="button" 
                          data-toggle="modal" 
                          data-target="#cancelarAcceso<?=$accesos[$i]["id_acc"]?>"
                        >
                          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16"><path fill-rule="evenodd" fill="white" d="M3.72 3.72a.75.75 0 011.06 0L8 6.94l3.22-3.22a.75.75 0 111.06 1.06L9.06 8l3.22 3.22a.75.75 0 11-1.06 1.06L8 9.06l-3.22 3.22a.75.75 0 01-1.06-1.06L6.94 8 3.72 4.78a.75.75 0 010-1.06z"></path></svg>
                        </button>
                      </td>

                  </tr>
                  <!-- Modal finalizar acceso-->
                  <div class="modal fade" id="finalizarAcceso<?=$accesos[$i]["id_acc"]?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Finalizar acceso</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <div class="d-flex justify-content-center my-5 py-5">
                            <p class="h5">¿Seguro que desea finalizar el acceso?</strong></p>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                          <button type="button" value="<?=$accesos[$i]["id_acc"]?>" onClick="finalizar(this.value)" class="btn btn-info">Finalizar</button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- Modal finalizar acceso-->
                  <div class="modal fade" id="cancelarAcceso<?=$accesos[$i]["id_acc"]?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Cancelar acceso</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <div class="d-flex justify-content-center my-5 py-5">
                            <p class="h5">¿Seguro que desea cancelar el acceso?</strong></p>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Volver</button>
                          <button type="button" value="<?=$accesos[$i]["id_acc"]?>" onClick="cancelar(this.value)" class="btn btn-danger">Cancelar acceso</button>
                        </div>
                      </div>
                    </div>
                  </div>
              <?php } ?>
              <?php if(count($accesos) < 1){ ?>
                <tr>
                    <td class="text-center" colspan="9"> <h5>No hay accesos en proceso</h5> </td>
                </tr>
              <?php } ?>
            </tbody>
        </table>
          </div>
        </div>
    </div>
    <!-- /#page-content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <!-- modal crear acceso -->
  <div class="modal fade" id="crearAcceso" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Crear acceso</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <form id="crear_acceso" >
                    <div class="modal-body">
                      <ul class="list-group">
                        <li class="list-group-item">
                          <div class="form-group">
                            <label for="exampleInputEmail1"><strong>Cédula de empleado:</strong></label> 
                            <input 
                              type="text" 
                              class="form-control" 
                              value=""
                              name="ci_emp"
                            >
                          </div>
                        </li>
                        <li class="list-group-item">
                          <div class="form-group">
                            <label for="exampleInputEmail1"><strong>Motivo:</strong></label> 
                            <input 
                              type="text" 
                              class="form-control" 
                              value=""
                              name="motivo"
                            >
                          </div>
                        </li>
                        <li class="list-group-item">
                          <div class="form-group">
                            <label for="exampleInputEmail1"><strong>Descripción:</strong></label> 
                            <textarea class="form-control" name="avance" rows="3"></textarea>
                          </div>
                        </li>
                        <li class="list-group-item">
                          <label for="exampleInputEmail1"><strong>Prioridad de acceso:</strong></label>
                          <div class="form-check">
                            <input 
                              class="form-check-input" 
                              type="radio" 
                              name="prioridad_acceso" 
                              value="0"
                              checked
                            >
                            <label class="form-check-label" for="exampleRadios1">
                              Baja
                            </label>
                          </div>
                          <div class="form-check">
                            <input 
                              class="form-check-input" 
                              type="radio" 
                              name="prioridad_acceso" 
                              value="1"
                            >
                            <label class="form-check-label" for="exampleRadios2">
                              Moderada
                            </label>
                          </div>
                          <div class="form-check">
                            <input 
                              class="form-check-input" 
                              type="radio" 
                              name="prioridad_acceso" 
                              value="2"
                            >
                            <label class="form-check-label" for="exampleRadios2">
                              Alta
                            </label>
                          </div>
                        </li>
                      </ul>
                    </div>
                    </form>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                      <button type="button" onClick="crear()" class="btn btn-success">Crear</button>
                    </div>
                  </div>
                </div>
              </div>

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
    function finalizar(id_acceso) {
      window.location.href="./?c=finalizar_acceso&id="+id_acceso
    }
    function cancelar(id_acceso) {
      window.location.href="./?c=cancelar_acceso&id="+id_acceso
    }
    function crear() 
    {
      let form = document.getElementById("crear_acceso")
      /** Condición que permite conocer si los campos se encuentras vacíos o no **/
      var empty = false
      for (let input of form.elements) {
        if (input.value == "") {
          empty = true
        }
      }
      if (empty) {
          alert('No puede deja campos vacíos');
      /** Si los campos no están vacíos, se envía los datos al controlador para constatar que el usuario existe en la BD **/
      } else {
          form.action="?c=crear_acceso";
          form.method= 'POST';
          form.submit();
      }
    }
  </script>

</body>

</html>