<div class="px-5 pt-5">
    <form name="form_estadisticas">
        <div class="form-row">
            <div class="form-group col-md-2">
                <label for="inputState">Administrador:</label>
                <input name="administrador" value="<?=isset($_POST["administrador"])?$_POST["administrador"]:""?>"
                    type="text" class="form-control" />
            </div>
            <div class="form-group col-md-2">
                <label for="inputState">Empleado:</label>
                <input name="empleado" value="<?=isset($_POST["empleado"])?$_POST["empleado"]:""?>" type="text"
                    class="form-control" />
            </div>
            <div class="form-group col-md-4">
                <label for="inputState">Desde:</label>
                <div class='input-group date' id='datetimepicker1'>
                    <input value="<?=isset($_POST["fecha-inicio"])?$_POST["fecha-inicio"]:""?>" name="fecha-inicio" type="date" class="form-control" />
                </div>
            </div>
            <div class="form-group col-md-4">
                <label for="inputState">Hasta:</label>
                <div class='input-group date' id='datetimepicker1'>
                    <input value="<?=isset($_POST["fecha-fin"])?$_POST["fecha-fin"]:""?>" name="fecha-fin" type="date" class="form-control" />
                </div>
            </div>
            <div class="form-group col-md-4">
                <label for="inputState">Estado</label>
                <select name="estado" id="inputState" class="form-control">
                    <option value="-1" <?=isset($_POST["estado"])?($_POST["estado"]=="-1"?"selected":""):"selected"?>>Ninguno</option>
                    <option value="0" <?=isset($_POST["estado"])?($_POST["estado"]=="0"?"selected":""):""?>>En proceso</option>
                    <option value="1" <?=isset($_POST["estado"])?($_POST["estado"]=="1"?"selected":""):""?>>Finalizado</option>
                    <option value="2" <?=isset($_POST["estado"])?($_POST["estado"]=="2"?"selected":""):""?>>Cancelado</option>
                </select>
            </div>
            <div class="form-group col-md-4">
                <label for="inputState">Prioridad</label>
                <select name="prioridad" id="inputState" class="form-control">
                    <option value="-1" <?=isset($_POST["prioridad"])?($_POST["prioridad"]=="-1"?"selected":""):"selected"?>>Ninguna</option>
                    <option value="0" <?=isset($_POST["prioridad"])?($_POST["prioridad"]=="0"?"selected":""):""?>>Baja</option>
                    <option value="1" <?=isset($_POST["prioridad"])?($_POST["prioridad"]=="1"?"selected":""):""?>>Moderada</option>
                    <option value="2" <?=isset($_POST["prioridad"])?($_POST["prioridad"]=="2"?"selected":""):""?>>Alta</option>
                </select>
            </div>
        </div>
        <button onclick="enviar()" class="btn btn-primary">Aplicar</button>
        <button onclick="pdf()" class="btn btn-info">Exportar resultados en PDF</button>
        <table class="table table-striped mt-4">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Empleado</th>
                    <th scope="col">Administrador</th>
                    <th scope="col">C.I Empleado</th>
                    <th scope="col">C.I Administrador</th>
                    <th scope="col">Prioridad</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Motivo</th>
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
                    <td><?=$accesos[$i]["estado_acc"]>0?($accesos[$i]["estado_acc"]>1?"Cancelado":"Finalizado"):"En proceso"?>
                    </td>
                    <td><?=$accesos[$i]["fcha_inicio"]?><br><?=$accesos[$i]["fcha_final"]?></td>
                    <td><?=$accesos[$i]["motivo"]?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item">
                        <button class="page-link" onclick="enviar(<?=$pagina_anterior?>)" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </button>
                    </li>
                    <?php for ($i=1; $i <= $paginas; $i++) { ?>
                        <li class="page-item <?=$pagina==$i?"active":""?>"><button class="page-link" onclick="enviar(<?=$i?>)"><?=$i?></button></li>
                    <?php } ?>
                    <li class="page-item">
                        <button class="page-link" onclick="enviar(<?=$pagina_siguiente?>)" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </button>
                    </li>
                </ul>
            </nav>
        </div>
    </form>

    <div>
    <script>
        function enviar(pag) {
            if (pag && pag != "0") {
                document.form_estadisticas.action="?c=gestionar_estadisticas_form&pag="+pag+"&num="+4;
            }else{
                document.form_estadisticas.action="?c=gestionar_estadisticas_form&num="+4;
            }
            document.form_estadisticas.method= 'POST';
            //document.form1.submit();
        }

        function pdf() {
            document.form_estadisticas.action="?c=pdf_estadisticas";
            document.form_estadisticas.method= 'POST';
            //document.form1.submit();
        }

    </script>