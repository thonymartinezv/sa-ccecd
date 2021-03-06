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
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
    integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

  <!-- Custom styles for this template -->
  <link href="css/simple-sidebar.css" rel="stylesheet">

  <style>
    .content-index {
      font-size: x-small !important;
    }

    .display-4 {
      font-size: xx-large !important;
      font-weight: inherit;
    }
  </style>

</head>

<body>

  <div class="d-flex" id="wrapper">

    <!-- Sidebar -->
    <?php 
      $activo="empleado";
      include_once("vista/sidebar.php");
    ?>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">

      <nav class="navbar navbar-expand-lg navbar-dark bg-dark border-bottom">
        <button class="navbar-toggler always-show" id="menu-toggle">
          <span class="navbar-toggler-icon"></span>
        </button>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-4">
            <li class="nav-item active">
              <a class="nav-link" type="button" data-target="#crearEmpleado" data-toggle="modal">Crear Usuario</a>
            </li>
          </ul>
          <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
            <li class="nav-item">
              <a class="nav-link" href="?c=CS">Cerrar Sesión <span class="sr-only">(current)</span></a>
            </li>
          </ul>
        </div>
      </nav>

      <div class="content-index">
        <div class="container-fluid">
          <div class="mt-4"></div>
          <?php if(isset($_GET["ms"])){ ?>
          <div class="alert alert-success alert-dismissible fade show sticky-top mt-2 col-7 mx-auto" role="alert">
            <strong>Mensaje:</strong>
            <?=$_GET["ms"]?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="font-size:medium;">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <?php } else if(isset($_GET["md"])){?>
          <div class="alert alert-danger alert-dismissible fade show sticky-top mt-2 col-7 mx-auto" role="alert">
            <strong>Mensaje:</strong>
            <?=$_GET["md"]?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="font-size:medium;">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <?php }?>
          <div class="row pb-2">
            <div class="col-md-4 mt-2 col-sm-12">
              <p class="display-4 text-center">Usuarios</p>
            </div>
            <div class="ml-auto col-md-7 col-sm-12">
              <form name="form_empleado">
                <div class="input-group input-group-sm mt-3">
                  <input type="text" value="<?=isset($_GET["search"])?$_GET["search"]:""?>" name="search"
                  placeholder="Correo o cédula" class="form-control" aria-label="Large"
                  aria-describedby="inputGroup-sizing-sm">
                  <div class="input-group-append">
                    <button type="submit" class="btn btn-dark" id="inputGroup-sizing-lg">
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="15" height="15">
                        <path fill-rule="evenodd" fill="white"
                          d="M14.53 15.59a8.25 8.25 0 111.06-1.06l5.69 5.69a.75.75 0 11-1.06 1.06l-5.69-5.69zM2.5 9.25a6.75 6.75 0 1111.74 4.547.746.746 0 00-.443.442A6.75 6.75 0 012.5 9.25z">
                        </path>
                      </svg>
                    </button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="container-fluid mt-2 overflow-auto">
          <table class="table table-striped">
            <thead class="thead-dark">
              <tr>
                <th scope="col">Correo Electrónico</th>
                <th scope="col">C.I</th>
                <th scope="col">Nombre</th>
                <th scope="col">Apellido</th>
                <th scope="col">Ver</th>
                <th scope="col">Editar</th>
                <th scope="col">Estatus</th>
                <th scope="col">Editar C.</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($empleados as $empleado){ ?>
              <tr>
                <td>
                  <?=$empleado["email_emp"]?>
                </td>
                <td>
                  <?=$empleado["ci_emp"]?>
                </td>
                <td>
                  <?=$empleado["p_nomb"]?>
                </td>
                <td>
                  <?=$empleado["p_apel"]?>
                </td>
                <td>
                  <button class="btn btn-primary" type="button" data-toggle="modal"
                    data-target="#verEmpleado<?=$empleado["ci_emp"]?>">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16">
                      <path fill-rule="evenodd" fill="white"
                        d="M1.679 7.932c.412-.621 1.242-1.75 2.366-2.717C5.175 4.242 6.527 3.5 8 3.5c1.473 0 2.824.742 3.955 1.715 1.124.967 1.954 2.096 2.366 2.717a.119.119 0 010 .136c-.412.621-1.242 1.75-2.366 2.717C10.825 11.758 9.473 12.5 8 12.5c-1.473 0-2.824-.742-3.955-1.715C2.92 9.818 2.09 8.69 1.679 8.068a.119.119 0 010-.136zM8 2c-1.981 0-3.67.992-4.933 2.078C1.797 5.169.88 6.423.43 7.1a1.619 1.619 0 000 1.798c.45.678 1.367 1.932 2.637 3.024C4.329 13.008 6.019 14 8 14c1.981 0 3.67-.992 4.933-2.078 1.27-1.091 2.187-2.345 2.637-3.023a1.619 1.619 0 000-1.798c-.45-.678-1.367-1.932-2.637-3.023C11.671 2.992 9.981 2 8 2zm0 8a2 2 0 100-4 2 2 0 000 4z">
                      </path>
                    </svg>
                  </button>
                </td>
                <td>
                  <button class="btn btn-success" type="button" data-toggle="modal"
                    data-target="#editarEmpleado<?=$empleado["ci_emp"]?>"
                    <?=$admin || ($empleado["email_emp"]==$_SESSION["email_otic"])?"":"disabled"?>
                    >
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16">
                      <path fill-rule="evenodd" fill="white"
                        d="M11.013 1.427a1.75 1.75 0 012.474 0l1.086 1.086a1.75 1.75 0 010 2.474l-8.61 8.61c-.21.21-.47.364-.756.445l-3.251.93a.75.75 0 01-.927-.928l.929-3.25a1.75 1.75 0 01.445-.758l8.61-8.61zm1.414 1.06a.25.25 0 00-.354 0L10.811 3.75l1.439 1.44 1.263-1.263a.25.25 0 000-.354l-1.086-1.086zM11.189 6.25L9.75 4.81l-6.286 6.287a.25.25 0 00-.064.108l-.558 1.953 1.953-.558a.249.249 0 00.108-.064l6.286-6.286z">
                      </path>
                    </svg>
                  </button>
                </td>
                <td>
                  <?php if($empleado["estado_usu"] > 0){ ?>
                  <button class="btn btn-info" type="button" data-toggle="modal"
                    data-target="#deshabilitarEmpleado<?=$empleado["ci_emp"]?>"
                    <?=!$admin || ($empleado["email_emp"]==$_SESSION["email_otic"])?"disabled":""?>
                    >
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16">
                      <path fill-rule="evenodd" fill="white"
                        d="M13.78 4.22a.75.75 0 010 1.06l-7.25 7.25a.75.75 0 01-1.06 0L2.22 9.28a.75.75 0 011.06-1.06L6 10.94l6.72-6.72a.75.75 0 011.06 0z">
                      </path>
                    </svg>
                  </button>
                  <?php }else{ ?>
                  <button class="btn btn-danger" type="button" data-toggle="modal"
                    data-target="#deshabilitarEmpleado<?=$empleado["ci_emp"]?>"
                    <?=!$admin || ($empleado["email_emp"]==$_SESSION["email_otic"])?"disabled":""?>
                    >
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16">
                      <path fill-rule="evenodd" fill="white"
                        d="M3.72 3.72a.75.75 0 011.06 0L8 6.94l3.22-3.22a.75.75 0 111.06 1.06L9.06 8l3.22 3.22a.75.75 0 11-1.06 1.06L8 9.06l-3.22 3.22a.75.75 0 01-1.06-1.06L6.94 8 3.72 4.78a.75.75 0 010-1.06z">
                      </path>
                    </svg>
                  </button>
                  <?php } ?>
                </td>
                <td>
                  <button class="btn btn-warning" type="button" data-toggle="modal"
                    data-target="#editarContraseña<?=$empleado["ci_emp"]?>"
                    <?=$admin || ($empleado["email_emp"]==$_SESSION["email_otic"])?"":"disabled"?>
                    >
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-key"
                      viewBox="0 0 16 16">
                      <path
                        d="M0 8a4 4 0 0 1 7.465-2H14a.5.5 0 0 1 .354.146l1.5 1.5a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0L13 9.207l-.646.647a.5.5 0 0 1-.708 0L11 9.207l-.646.647a.5.5 0 0 1-.708 0L9 9.207l-.646.647A.5.5 0 0 1 8 10h-.535A4 4 0 0 1 0 8zm4-3a3 3 0 1 0 2.712 4.285A.5.5 0 0 1 7.163 9h.63l.853-.854a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.793-.793-1-1h-6.63a.5.5 0 0 1-.451-.285A3 3 0 0 0 4 5z" />
                      <path d="M4 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
                    </svg>
                  </button>
                </td>
              </tr>
              <!-- Modal Ver empleado-->
              <div class="modal fade" id="verEmpleado<?=$empleado["ci_emp"]?>" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">
                        <?=$empleado["p_nomb"]?>
                        <?=$empleado["p_apel"]?>
                      </h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <ul class="list-group">
                        <li class="list-group-item">
                          <strong>Correo electrónico:</strong>
                          <?=$empleado["email_emp"]?>
                        </li>
                        <li class="list-group-item">
                          <strong>Cédula:</strong>
                          <?=$empleado["ci_emp"]?>
                        </li>
                        <li class="list-group-item">
                          <strong>Primer nombre:</strong>
                          <?=$empleado["p_nomb"]?>
                        </li>
                        <li class="list-group-item">
                          <strong>Segundo nombre:</strong>
                          <?=$empleado["s_nomb"]?>
                        </li>
                        <li class="list-group-item">
                          <strong>Primer apellido: </strong>
                          <?=$empleado["p_apel"]?>
                        </li>
                        <li class="list-group-item">
                          <strong>Segundo apellido:</strong>
                          <?=$empleado["s_apel"]?>
                        </li>
                        <li class="list-group-item">
                          <strong>Institución:</strong>
                          <?=$empleado["institution"]?>
                        </li>
                        <li class="list-group-item">
                          <strong>Teléfono:</strong>
                          <?=$empleado["tlf"]?>
                        </li>
                        <li class="list-group-item">
                          <strong>Prioridad de usuario:</strong>
                          <?php
                              switch ($empleado["pri_usu"]) {
                                case '2':
                                  echo "Administrador";
                                  break;
                                case '1':
                                  echo "Grupo de superbitácora";
                                    break;
                                case '0':
                                  echo "Grupo de monitoreo";
                                  break;
                              }
                            ?>
                        </li>
                        <li class="list-group-item">
                          <strong>Fecha de ingreso:</strong>
                          <?=$empleado["fcha_ing"]?>
                        </li>
                      </ul>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Modal editar empleado-->
              <div class="modal fade" id="editarEmpleado<?=$empleado["ci_emp"]?>" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">
                        <?=$empleado["p_nomb"]?>
                        <?=$empleado["p_apel"]?>
                      </h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <form id="<?=$empleado["email_emp"]?>">
                      <input type="hidden" name="id" value="<?=$empleado["email_emp"]?>">
                      <div class="modal-body">
                        <ul class="list-group">
                          <li class="list-group-item">
                            <div class="form-group">
                              <label for="exampleInputEmail1"><strong>Correo electrónico:</strong></label>
                              <div class="input-group">
                                <input type="text" class="form-control" value="<?=$empleado["email_emp"]?>"
                                name="email_emp"
                                <?=$_SESSION["pri_otic"]<1?"readonly":""?>>
                              </div>
                            </div>
                          </li>
                          <li class="list-group-item">
                            <div class="form-group">
                              <label for="exampleInputEmail1"><strong>Cédula:</strong></label>
                              <input type="number" onkeyup="validarLongitud(this,8)" class="form-control" value="<?=$empleado["ci_emp"]?>" name="ci_emp"
                                readonly
                              >
                            </div>
                          </li>
                          <li class="list-group-item">
                            <div class="form-group">
                              <label for="exampleInputEmail1"><strong>Primer nombre:</strong></label>
                              <input type="text" class="form-control" value="<?=$empleado["p_nomb"]?>" name="p_nomb">
                            </div>
                          </li>
                          <li class="list-group-item">
                            <div class="form-group">
                              <label for="exampleInputEmail1"><strong>Segundo nombre:</strong></label>
                              <input type="text" class="form-control" value="<?=$empleado["s_nomb"]?>" name="s_nomb">
                            </div>
                          </li>
                          <li class="list-group-item">
                            <div class="form-group">
                              <label for="exampleInputEmail1"><strong>Primer apellido:</strong></label>
                              <input type="text" class="form-control" value="<?=$empleado["p_apel"]?>" name="p_apel">
                            </div>
                          </li>
                          <li class="list-group-item">
                            <div class="form-group">
                              <label for="exampleInputEmail1"><strong>Segundo apellido:</strong></label>
                              <input type="text" class="form-control" value="<?=$empleado["s_apel"]?>" name="s_apel">
                            </div>
                          </li>
                          <li class="list-group-item">
                            <div class="form-group">
                              <label for="exampleInputEmail1"><strong>Institución:</strong></label>
                              <select name="institution" class="form-control" id="exampleFormControlSelect1">
                                <?php for ($i=0; $i < count($inst); $i++) { ?>
                                <option 
                                  value="<?=$inst[$i]["id"]?>"
                                  <?=$empleado["institution"]==$inst[$i]["nombre"]?"selected=\"selected\"":""?>
                                >
                                  <?=$inst[$i]["nombre"]?>
                                </option>
                                <?php } ?>
                              </select>
                            </div>
                          </li>
                          <li class="list-group-item">
                            <div class="form-group">
                              <label for="exampleInputEmail1"><strong>Teléfono:</strong></label>
                              <input type="number" onkeyup="validarLongitud(this,11)" class="form-control" value="<?=$empleado["tlf"]?>" name="tlf">
                            </div>
                          </li>
                          <li class="list-group-item">
                            <label for="exampleInputEmail1"><strong>Prioridad de usuario:</strong></label>
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="pri_usu" value="2"
                                <?=$empleado["pri_usu"]> 1?"checked":""?>
                              <?php if (
                                        ($empleado["email_emp"] == $_SESSION['email_otic'] || $_SESSION['pri_otic'] < 1) &&
                                        $empleado["pri_usu"] != 2
                                    ) {
                                  echo "disabled";
                                }?>>
                              <label class="form-check-label" for="exampleRadios1">
                                Administrador
                              </label>
                            </div>
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="pri_usu" value="1"
                                <?=$empleado["pri_usu"]==1?"checked":""?>
                              <?php if (
                                        ($empleado["email_emp"] == $_SESSION['email_otic'] || $_SESSION['pri_otic'] < 1) &&
                                        $empleado["pri_usu"] != 1
                                    ) {
                                  echo "disabled";
                                }?>>
                              <label class="form-check-label" for="exampleRadios2">
                                Grupo de super bitácora
                              </label>
                            </div>
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="pri_usu" value="0"
                                <?=$empleado["pri_usu"] < 1?"checked":""?>
                              <?php if (
                                        ($empleado["email_emp"] == $_SESSION['email_otic'] || $_SESSION['pri_otic'] < 1) &&
                                        $empleado["pri_usu"] != 0
                                    ) {
                                  echo "disabled";
                                }?>>
                              <label class="form-check-label" for="exampleRadios2">
                                Grupo de monitoreo
                              </label>
                            </div>
                          </li>
                          <li class="list-group-item">
                            <strong>Fecha de ingreso:</strong>
                            <?=$empleado["fcha_ing"]?>
                          </li>
                        </ul>
                      </div>
                    </form>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                      <button type="button" value="<?=$empleado["email_emp"]?>" onClick="editar(this.value)"
                        class="btn btn-success">Guardar</button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Modal Deshabilitar empleado-->
              <div class="modal fade" id="deshabilitarEmpleado<?=$empleado["ci_emp"]?>" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">
                        <?=$empleado["estado_usu"]>0?"Deshabilitar a":"Habilitar a"?>
                        <?=$empleado["p_nomb"]?>
                        <?=$empleado["p_apel"]?>
                      </h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div class="d-flex justify-content-center my-5 py-5">
                        <p class="h5">¿Seguro que desea
                          <?=$empleado["estado_usu"]>0?"deshabilitar":"habilitar"?> al
                          usuario <strong>
                            <?=$empleado["email_emp"]?>?
                          </strong>
                        </p>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                      <?php if($empleado["estado_usu"]>0){ ?>
                      <button type="button" value="<?=$empleado["email_emp"]?>" onClick="deshabilitar(this.value)"
                        class="btn btn-danger">Deshabilitar</button>
                      <?php }else{ ?>
                      <button type="button" value="<?=$empleado["email_emp"]?>" onClick="habilitar(this.value)"
                        class="btn btn-primary">Habilitar</button>
                      <?php }?>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Modal editar contraseña-->
              <div class="modal fade" id="editarContraseña<?=$empleado["ci_emp"]?>" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">
                        <?=$empleado["p_nomb"]?>
                        <?=$empleado["p_apel"]?>
                      </h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <form name="<?=$empleado["email_emp"]?>_pass">
                      <input type="hidden" name="id" value="<?=$empleado["email_emp"]?>">
                      <div class="modal-body">
                        <ul class="list-group">
                          <li class="list-group-item">
                            <div class="form-group">
                              <label for="exampleInputEmail1"><strong>Nueva contraseña:</strong></label>
                              <input type="password" class="form-control" value="" name="password">
                            </div>
                          </li>
                          <li class="list-group-item">
                            <div class="form-group">
                              <label for="exampleInputEmail1"><strong>Repetir contraseña:</strong></label>
                              <input type="password" class="form-control" value="" name="repeat_password">
                            </div>
                          </li>
                        </ul>
                      </div>
                    </form>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                      <button type="button" value="<?=$empleado["email_emp"]?>" onClick="editarPass(this.value)"
                        class="btn btn-success">Guardar</button>
                    </div>
                  </div>
                </div>
              </div>
              <?php } ?>
            </tbody>
          </table>
        </div>
        <div class="d-flex justify-content-center pt-4">
          <nav aria-label="Page navigation example">
            <ul class="pagination">
              <li class="page-item">
                <button class="page-link" onclick="enviar(<?=$pagina_anterior?>)" aria-label="Previous">
                  <span aria-hidden="true">&laquo;</span>
                </button>
              </li>
              <?php for ($i=1; $i <= $paginas; $i++) { ?>
              <li class="page-item <?=$pagina==$i?" active":""?>"><button class="page-link" onclick="enviar(<?=$i?>)">
                  <?=$i?>
                </button></li>
              <?php } ?>
              <li class="page-item">
                <button class="page-link" onclick="enviar(<?=$pagina_siguiente?>)" aria-label="Next">
                  <span aria-hidden="true">&raquo;</span>
                </button>
              </li>
              <li class="page-item">
                  <div class="form-group ml-4">
                    <div style="position:absolute;margin-top:-1.25rem;">
                      <p style="font-weight:bold;">
                        N° de Filas
                      </p>
                    </div>
                    <select class="form-control form-control-sm" id="exampleFormControlSelect1" onchange="filas(this.value)">
                      <?php for ($i=1; $i <= 10; $i++) {  ?>
                        <option value="<?=$i;?>" <?=$cantidad == $i?"selected":""?>><?=$i;?></option>
                      <?php } ?>
                    </select>
                    <script>
                      function filas(num) {
                        var url = "?c=admin_index&num="+num
                        window.open(url, "_self")
                      }
                    </script>
                  </div>
                </li>
            </ul>
          </nav>
        </div>
      </div>

      <!-- Modal crear usuario-->
      <div class="modal fade" id="crearEmpleado" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Crear Usuario</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form name="form_crear">
              <div class="modal-body">
                <ul class="list-group">
                  <li class="list-group-item">
                    <div class="form-group">
                      <label for="exampleInputEmail1"><strong>Correo electrónico:</strong></label>
                      <div class="input-group">
                        <input type="text" class="form-control" value="" name="email_emp">
                      </div>
                    </div>
                  </li>
                  <li class="list-group-item">
                    <div class="form-group">
                      <label for="exampleInputEmail1"><strong>Cédula:</strong></label>
                      <input type="number" onkeyup="validarLongitud(this,8)" class="form-control" value="" name="ci_emp">
                    </div>
                  </li>
                  <li class="list-group-item">
                    <div class="form-group">
                      <label for="exampleInputEmail1"><strong>Primer nombre:</strong></label>
                      <input type="text" class="form-control" value="" name="p_nomb">
                    </div>
                  </li>
                  <li class="list-group-item">
                    <div class="form-group">
                      <label for="exampleInputEmail1"><strong>Segundo nombre:</strong></label>
                      <input type="text" class="form-control" value="" name="s_nomb">
                    </div>
                  </li>
                  <li class="list-group-item">
                    <div class="form-group">
                      <label for="exampleInputEmail1"><strong>Primer apellido:</strong></label>
                      <input type="text" class="form-control" value="" name="p_apel">
                    </div>
                  </li>
                  <li class="list-group-item">
                    <div class="form-group">
                      <label for="exampleInputEmail1"><strong>Segundo apellido:</strong></label>
                      <input type="text" class="form-control" value="" name="s_apel">
                    </div>
                  </li>
                  <li class="list-group-item">
                    <div class="form-group">
                      <label for="exampleInputEmail1"><strong>Institución:</strong></label>
                      <select name="institution" class="form-control" id="exampleFormControlSelect1">
                        <?php for ($i=0; $i < count($inst); $i++) { ?>
                        <option value="<?=$inst[$i]["id"]?>"><?=$inst[$i]["nombre"]?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </li>
                  <li class="list-group-item">
                    <div class="form-group">
                      <label for="exampleInputEmail1"><strong>Teléfono:</strong></label>
                      <input type="number" onkeyup="validarLongitud(this,11)" class="form-control" value="" name="tlf">
                    </div>
                  </li>
                  <li class="list-group-item">
                    <div class="form-group">
                      <label for="exampleInputEmail1"><strong>Contraseña:</strong></label>
                      <input type="password" class="form-control" value="" name="clv_usu">
                    </div>
                  </li>
                  <li class="list-group-item">
                    <div class="form-group">
                      <label for="exampleInputEmail1"><strong>Repetir contraseña:</strong></label>
                      <input type="password" class="form-control" value="" name="clv_usu_r">
                    </div>
                  </li>
                  <li class="list-group-item">
                    <label for="exampleInputEmail1"><strong>Prioridad de usuario:</strong></label>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="pri_usu" value="2">
                      <label class="form-check-label" for="exampleRadios1">
                        Administrador
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="pri_usu" value="1">
                      <label class="form-check-label" for="exampleRadios2">
                        Grupo de super bitácora
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="pri_usu" value="0">
                      <label class="form-check-label" for="exampleRadios2">
                        Grupo de monitoreo
                      </label>
                    </div>
                  </li>
                </ul>
              </div>
            </form>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
              <button type="button" value="" onClick="crear()" class="btn btn-success">Guardar</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- /#page-content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <!-- Bootstrap core JavaScript -->

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
    integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
    integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV"
    crossorigin="anonymous"></script>


  <!-- Menu Toggle Script -->
  <script>
    $("#menu-toggle").click(function (e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });
    function enviar(pag) {
      if (pag && pag != "0") {
        var url = "?c=admin_index&pag=" + pag + "&num=" + <?= $cantidad ?>
          + "<?=( (isset($search) && $search) ?(" & search=".$search):"")?>"
      } else {
        var url = "?c=admin_index&num="
          + <?= $cantidad ?>
            + "<?=( (isset($search) && $search) ?(" & search=".$search):"")?>"
      }
      window.open(url, "_self")
    }

    function validarLongitud(input,maxlength) {
      if (input.value.length > maxlength) {
        input.value = input.value.substring(0, maxlength)
      }
    }

    function editar(id) {
      let form = document.getElementById(id)
      /** Condición que permite conocer si los campos se encuentras vacíos o no **/
      var empty = false
      for (let input of form.elements) {
        if (input.name != "s_nomb" && input.name != "s_apel" && input.value.replace(/\s/g, '') == "") {
          empty = true
        }
        if ((input.name == "p_nomb" || input.name == "s_nomb") && validarNombres(input.value) && input.value > 20) {
          alert('Los nombres no pueden contener números, caracteres especiales o tener una longitud mayor a 20 caracteres')
          return false
        }
        if ( (input.name == "p_apel" || input.name == "s_apel") && validarApellidos(input.value) && input.value > 20) {
          alert('Los apellidos no pueden contener números, caracteres especiales o tener una longitud mayor a 20 caracteres')
          return false
        }
        if (input.name == "email_emp" && validarEmail(input.value)) {
          alert('El correo electrónico no puede contener caracteres especiales (excepto: @ _ .)')
          return false
        }
        if (input.name == "tlf" && input.value.toString().length > 11) {
          alert('Longitud de teléfono no permitida')
          return false
        }
      }
      if (empty) {
        alert('No puede dejar campos vacíos');
        /** Si los campos no están vacíos, se envía los datos al controlador para constatar que el usuario existe en la BD **/
      } else {
        form.action = "?c=actualizar";
        form.method = 'POST';
        form.submit();
      }
    }
    function editarPass(id){
      let form = document[id+"_pass"]
      console.log(form.password.value);
      /** Condición que permite conocer si los campos se encuentras vacíos o no **/
      var empty = false
      for (let input of form.elements) {
        if (input.value.replace(/\s/g, '') == "") {
          empty = true
        }
      }
      if (empty) {
        alert('No puede dejar campos vacíos');
        /** Si los campos no están vacíos, se envía los datos al controlador para constatar que el usuario existe en la BD **/
      } else {
        if (form.password.value != form.repeat_password.value) {
          alert('Las contraseñas no coinciden');
        }else{
          form.action = "?c=actualizar&pass";
          form.method = 'POST';
          form.submit();
        }
      }
    }

    function crear() {
      let form = document.form_crear
      /** Condición que permite conocer si los campos se encuentras vacíos o no **/
      var empty = false
      if (form.ci_emp.value.toString().length > 8) {
        alert('Longitud de cédula no permitida')
        return false
      }
      if (
        validarNombres(form.p_nomb.value) || form.p_nomb.value.length > 20 ||
        validarNombres(form.s_nomb.value) || form.s_nomb.value.length > 20 ||
        validarApellidos(form.p_apel.value) || form.p_apel.value.length > 20 ||
        validarApellidos(form.s_apel.value) || form.s_apel.value.length > 20
      ) {
        alert('Los nombres y apellidos no pueden contener números, caracteres especiales, o tener una longitud mayor a 20 caracteres')
        return false
      }
      if (validarEmail(form.email_emp.value)) {
        alert('El correo electrónico no puede contener caracteres especiales (excepto: @ _ .)')
        return false
      }
      if (form.tlf.value.toString().length > 11) {
        alert('Longitud de teléfono no permitida')
        return false
      }
      for (let input of form.elements) {
        if (input.name != "s_nomb" && input.name != "s_apel" && input.value.replace(/\s/g, '') == "") {
          empty = true
        }
      }
      if (empty) {
        alert('No puede dejar campos vacíos')
        /** Si los campos no están vacíos, se envía los datos al controlador para constatar que el usuario existe en la BD **/
      } else {
        if (form.clv_usu.value != form.clv_usu_r.value) {
          alert('Las contraseñas no coinciden')
        } else {
          form.action = "?c=crear";
          form.method = 'POST';
          form.submit();
        }
      }
    }

    function validarNombres(text) {
      var texto = /[0123456789`!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?~]/
      return texto.test(text)
    }

    function validarApellidos(text) {
      var texto = /[0123456789`!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?~]/
      return texto.test(text)
    }

    function validarEmail(text) {
      var texto = /[ `!#$%^&*()+\-=\[\]{};':"\\|,<>\/?~]/
      return texto.test(text)
    }

    function deshabilitar(email_usu) {
      window.location.href = "./?c=deshabilitar&email_usu=" + email_usu
    }
    function habilitar(email_usu) {
      window.location.href = "./?c=habilitar&email_usu=" + email_usu
    }
  </script>

</body>

</html>