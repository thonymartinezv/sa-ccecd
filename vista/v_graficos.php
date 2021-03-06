<?php
    function redondear($val)
    {
        if ($val == intval($val)+0.5) {
            return $val;
        }
        return round($val);
    }
    $escala = 2;
    $min = 20;
?>

<div class="px-5 pt-4 container-estadisticas">
    <form action="?c=gestionar_estadisticas" method="POST" >
    <div class="form-row">
            <div class="form-group col-md-4">
                <label for="inputState">Administrador:</label>
                <input name="administrador" value="<?=isset($_POST["administrador"])?$_POST["administrador"]:""?>" onkeyup="validarLongitud(this,8)"
                    type="number" class="form-control" />
            </div>
            <div class="form-group col-md-4">
                <label for="inputState">Usuario:</label>
                <input name="empleado" value="<?=isset($_POST["empleado"])?$_POST["empleado"]:""?>" type="number" onkeyup="validarLongitud(this,8)"
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
                <label for="inputState">Prioridad</label>
                <select name="prioridad" id="inputState" class="form-control">
                    <option value="-1" <?=isset($_POST["prioridad"])?($_POST["prioridad"]=="-1"?"selected":""):"selected"?>>Ninguna</option>
                    <option value="0" <?=isset($_POST["prioridad"])?($_POST["prioridad"]=="0"?"selected":""):""?>>Baja</option>
                    <option value="1" <?=isset($_POST["prioridad"])?($_POST["prioridad"]=="1"?"selected":""):""?>>Moderada</option>
                    <option value="2" <?=isset($_POST["prioridad"])?($_POST["prioridad"]=="2"?"selected":""):""?>>Alta</option>
                </select>
            </div>
            <div class="form-group col-md-4">
                <label for="exampleInputEmail1"><strong>Institución:</strong></label>
                <select name="institution" class="form-control" id="exampleFormControlSelect1">
                    <option value="">Ninguna</option>
                    <?php for ($i=0; $i < count($inst); $i++) { ?>
                        <option 
                            value="<?=$inst[$i]["id"]?>"
                            <?=isset($_POST["institution"])?($_POST["institution"]==$inst[$i]["id"]?"selected":""):""?>
                        >
                            <?=$inst[$i]["nombre"]?>
                        </option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Aplicar</button>
    </form>
    <div class="row" style="">
        <div class="cuadro-graficos row align-items-end col-12">
            <div class="barra-medir row col-xl-2 col-4">
                <div style="position:absolute;margin-top:-1.125rem;"><p style="font-weight:bold;white-space: nowrap;">Porcentaje de accesos</p></div>
                <div class="barra-num col-11 row align-items-end" style="overflow-y: hidden;">
                    <div class="content-medida col-12">
                        <?php for ($i=10; $i >= 1; $i--){ ?>
                            <div class="item-medida row justify-content-end">
                                <div class="div-medida col-9">
                                    <p class=""><?= $i*10 ?>%</p>
                                </div>
                            </div>
                        <?php }?>
                    </div>
                </div>
                <div class="barra-line col-1" style="height: <?=$escala*100?>px;">
                    <div class="line" style="height: <?=$escala*100?>px;"></div>
                </div>
            </div>
            <div class="col-2 mr-auto">
                <div class="row"><p class="titulo-barra mx-auto my-auto">Proceso</p></div>
                <div class="barra-proceso row align-items-center justify-content-center pt-1" style="height: <?=redondear($proceso*100/$total)*$escala>$min?redondear($proceso*100/$total)*$escala:$min?>px;">
                    <p class="text-barra text-center"><?=$proceso?> / <?=redondear($proceso*100/$total)?>%</p>
                </div>
            </div>
            <div class="col-2 mr-auto">
                <div class="row"><p class="titulo-barra mx-auto my-auto">Finalizado</p></div>
                <div class="barra-finalizado row align-items-center justify-content-center pt-1" style="height: <?=redondear($finalizado*100/$total)*$escala>$min?redondear($finalizado*100/$total)*$escala:$min?>px;">
                    <p class="text-barra text-center"><?=$finalizado?> / <?=redondear($finalizado*100/$total)?>%</p>
                </div>
            </div>
            <div class="col-2 mr-auto">
                <div class="row"><p class="titulo-barra mx-auto my-auto">Cancelado</p></div>
                <div class="barra-cancelado row align-items-center justify-content-center pt-1" style="height: <?=redondear($cancelado*100/$total)*$escala>$min?redondear($cancelado*100/$total)*$escala:$min?>px;">
                    <p class="text-barra text-center"><?=$cancelado?> / <?=redondear($cancelado*100/$total)?>%</p>
                </div>
            </div>
            <div class="col-2 mr-auto">
                <div class="row"><p class="titulo-barra mx-auto my-auto">Total</p></div>
                <div class="barra-total row align-items-center justify-content-center pt-1" style="height:<?=$escala*100?>px;">
                    <p class="text-barra text-center"><?=$total?> / 100%</p>
                </div>
            </div>
        <div>
    <div>
</div>
</div>
</div>
    <div class="mx-auto mt-2"><p style="font-weight:bold;white-space: nowrap;font-size:0.75rem;">Estatus de accesos</p></div>
</div>
<script>
    function validarLongitud(input,maxlength) {
        if (input.value.length > maxlength) {
            input.value = input.value.substring(0, maxlength)
        }
    }
</script>