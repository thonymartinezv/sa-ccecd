<?php
    function redondear($val)
    {
        if ($val == intval($val)+0.5) {
            return $val;
        }
        return round($val);
    }
?>

<div class="px-5 pt-4">
    <form action="?c=gestionar_estadisticas" method="POST" >
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
    <div class="row">
        <div class="cuadro-graficos row align-items-end col-12">
            <div class="barra-medir row col-2">
                <div class="barra-num col-6 row align-items-end">
                    <div class="content-medida col-12">
                        <?php for ($i=10; $i >= 1; $i--){ ?>
                            <div class="item-medida row justify-content-end">
                                <div class="div-medida col-9">
                                    <p class=""><?= $i*10 ?></p>
                                </div>
                            </div>
                        <?php }?>
                    </div>
                </div>
                <div class="barra-line col-6" style="height: 500px;">
                    <div class="line" style="height: 500px;"></div>
                </div>
            </div>
            <div class="col-2 mr-auto">
                <p class="titulo-barra text-center">En proceso</p>
                <div class="barra-proceso row align-items-center justify-content-center" style="height: <?=redondear($proceso*100/$total)*5>24?redondear($proceso*100/$total)*5:25?>px;">
                    <p class="text-barra">Cantidad: <?=$proceso?> / <?=redondear($proceso*100/$total)?>%</p>
                </div>
            </div>
            <div class="col-2 mr-auto">
                <p class="titulo-barra text-center">Finalizado</p>
                <div class="barra-finalizado row align-items-center justify-content-center" style="height: <?=redondear($finalizado*100/$total)*5>24?redondear($finalizado*100/$total)*5:25?>px;">
                    <p class="text-barra">Cantidad: <?=$finalizado?> / <?=redondear($finalizado*100/$total)?>%</p>
                </div>
            </div>
            <div class="col-2 mr-auto">
                <p class="titulo-barra text-center">Cancelado</p>
                <div class="barra-cancelado row align-items-center justify-content-center" style="height: <?=redondear($cancelado*100/$total)*5>24?redondear($cancelado*100/$total)*5:25?>px;">
                    <p class="text-barra">Cantidad: <?=$cancelado?> / <?=redondear($cancelado*100/$total)?>%</p>
                </div>
            </div>
            <div class="col-2 mr-auto">
                <p class="titulo-barra text-center">Total</p>
                <div class="barra-total row align-items-center justify-content-center" style="height:500px;">
                    <p class="text-barra">Cantidad: <?=$total?> / 100%</p>
                </div>
            </div>
        <div>
    <div>
</div>