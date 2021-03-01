<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Sistema de control de acceso al CCECD</title>
  <link rel="icon" href="img/bandera.png">
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
      $activo="institucion";
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
                data-target="#crearInstitucion">
                Crear Institución
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
                <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="font-size:medium;">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            <?php } else if(isset($_GET["md"])){?>
              <div class="alert alert-danger alert-dismissible fade show sticky-top mt-2 col-7 mx-auto" role="alert">
                <strong>Mensaje:</strong> <?=$_GET["md"]?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="font-size:medium;">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            <?php }?>
            <p class="display-4">Instituciones registradas</p>
          </div>
          <div class="container-fluid mt-2 overflow-auto">
          <table class="table table-striped mt-4">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Nombre</th>
                    <th class="text-center" scope="col">Finalizar</th>
                    <th class="text-center" scope="col">Borrar</th>
                </tr>
            </thead>
            <tbody>
              <?php for ($i=0; $i < count($inst); $i++) { ?>
                  <tr>
                      <td><?=$inst[$i]["nombre"]?></td>
                      <td class="text-center">
                        <button 
                            class="btn btn-success" 
                            type="button" 
                            data-toggle="modal" 
                            data-target="#modificarInstitucion<?=$inst[$i]["id"]?>"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16">
                                <path fill-rule="evenodd" fill="white"
                                    d="M11.013 1.427a1.75 1.75 0 012.474 0l1.086 1.086a1.75 1.75 0 010 2.474l-8.61 8.61c-.21.21-.47.364-.756.445l-3.251.93a.75.75 0 01-.927-.928l.929-3.25a1.75 1.75 0 01.445-.758l8.61-8.61zm1.414 1.06a.25.25 0 00-.354 0L10.811 3.75l1.439 1.44 1.263-1.263a.25.25 0 000-.354l-1.086-1.086zM11.189 6.25L9.75 4.81l-6.286 6.287a.25.25 0 00-.064.108l-.558 1.953 1.953-.558a.249.249 0 00.108-.064l6.286-6.286z">
                                </path>
                            </svg>
                        </button>
                      </td>
                      <td class="text-center">
                        <button 
                            class="btn btn-danger"
                            type="button" 
                            data-toggle="modal" 
                            data-target="#eliminarInstitucion<?=$inst[$i]["id"]?>"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                            </svg>
                        </button>
                      </td>

                  </tr>
                  <!-- Modal modificar institución-->
                  <div class="modal fade" id="modificarInstitucion<?=$inst[$i]["id"]?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Modificar institución</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <form id="modificar_<?=$inst[$i]["id"]?>">
                            <input type="hidden" value="<?=$inst[$i]["id"]?>" name="id">
                            <div class="modal-body">
                                <ul class="list-group">
                                    <li class="list-group-item">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><strong>Nombre de la institución:</strong></label> 
                                        <input 
                                            type="text" 
                                            class="form-control" 
                                            value="<?=$inst[$i]["nombre"]?>"
                                            name="nombre"
                                        >
                                    </div>
                                    </li>
                                </ul>
                            </div>
                        </form>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                          <button type="button" value="<?=$inst[$i]["id"]?>" onClick="modificar(this.value)" class="btn btn-success">Guardar</button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- Modal eliminar institución-->
                  <div class="modal fade" id="eliminarInstitucion<?=$inst[$i]["id"]?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Eliminar institución</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <div class="d-flex justify-content-center my-5 py-5">
                            <p class="h5">¿Seguro que desea eliminar la institución?</strong></p>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">cancelar</button>
                          <button type="button" value="<?=$inst[$i]["id"]?>" onClick="eliminar(this.value)" class="btn btn-danger">Eliminar institución</button>
                        </div>
                      </div>
                    </div>
                  </div>
              <?php } ?>
              <?php if(count($inst) < 1){ ?>
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
  <div class="modal fade" id="crearInstitucion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Crear Institución</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <form id="crear_institucion">
                    <div class="modal-body">
                      <ul class="list-group">
                        <li class="list-group-item">
                          <div class="form-group">
                            <label for="exampleInputEmail1"><strong>Nombre de la institución:</strong></label> 
                            <input 
                              type="text" 
                              class="form-control" 
                              value=""
                              name="nombre"
                            >
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
    function modificar(id_inst) {
        let form = document.getElementById("modificar_"+id_inst)
        var empty = false
        for (let input of form.elements) {
            if (input.value == "") {
                empty = true
            }
        }
        if (empty) {
            alert('No puede dejar campos vacíos');
        /** Si los campos no están vacíos, se envía los datos al controlador para constatar que el usuario existe en la BD **/
        } else {
            form.action="?c=modificar_institucion";
            form.method= 'POST';
            form.submit();
        }
    }
    function eliminar(id) {
      window.location.href="./?c=eliminar_institucion&id="+id
    }
    function crear() 
    {
      let form = document.getElementById("crear_institucion")
      /** Condición que permite conocer si los campos se encuentras vacíos o no **/
      var empty = false
      for (let input of form.elements) {
        if (input.value == "") {
          empty = true
        }
      }
      if (empty) {
          alert('No puede dejar campos vacíos');
      /** Si los campos no están vacíos, se envía los datos al controlador para constatar que el usuario existe en la BD **/
      } else {
          form.action="?c=crear_institucion";
          form.method= 'POST';
          form.submit();
      }
    }
  </script>

</body>

</html>