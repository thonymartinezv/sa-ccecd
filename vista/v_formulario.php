<div class="px-5 pt-5">
    <form action="?c=gestionar_estadisticas_form" method="POST" >
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="inputState">Desde:</label>
                <div class='input-group date' id='datetimepicker1'>
                    <input name="fecha-inicio" type="date" class="form-control" />
                </div>
            </div>
            <div class="form-group col-md-4">
                <label for="inputState">Hasta:</label>
                <div class='input-group date' id='datetimepicker1'>
                    <input name="fecha-fin" type="date" class="form-control" />
                </div>
            </div>
            <div class="form-group col-md-4">
                <label for="inputState">Estado</label>
                <select name="estado" id="inputState" class="form-control">
                    <option value="-1" selected>Ninguno</option>
                    <option value="0">En proceso</option>
                    <option value="1">Finalizado</option>
                    <option value="2">Cancelado</option>
                </select>
            </div>
            <div class="form-group col-md-4">
                <label for="inputState">Prioridad</label>
                <select name="prioridad" id="inputState" class="form-control">
                    <option value="-1" selected>Ninguna</option>
                    <option value="0">Baja</option>
                    <option value="1">Moderada</option>
                    <option value="2">Alta</option>
                </select>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Aplicar</button>
    </form>
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
                    <td><?=$accesos[$i]["estado_acc"]>0?($accesos[$i]["estado_acc"]>1?"Cancelado":"Finalizado"):"En proceso"?></td>
                    <td><?=$accesos[$i]["fcha_inicio"]?><br><?=$accesos[$i]["fcha_final"]?></td>
                    <td><?=$accesos[$i]["motivo"]?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
<div>