<?php
    $monitor = $_SESSION['pri_otic']  < 1;
?>
<!-- Sidebar -->
<div class="bg-dark border-right" id="sidebar-wrapper">
    <div class="sidebar-heading">
        <div class="row">
            <img src="img/bandera.png" width="27" height="32" class="d-inline-block align-top" alt="" loading="lazy">
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
        <a href="./" class="list-group-item list-group-item-action bg-dark <?=$activo=='empleado'?'activo':''?>"
            style="padding-bottom: 0!important;">
            <div class="row ml-2">
                <div class="mr-2" style="margin-top: -3px!important;">
                    <svg width="1.25em" height="1.25em" viewBox="0 0 16 16" class="bi bi-person-fill" fill="currentColor"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                    </svg>
                </div>
                <p class="text-muted" style="color:#bbbbbb!important;">Gestionar Usuario</p>
            </div>
        </a>
        <<?=$monitor?"button disabled":"a"?> href="?c=gestionar_acceso"
            class="list-group-item list-group-item-action bg-dark <?=$activo=='acceso'?'activo':''?>"
            style="padding-bottom: 0!important;">
            <div class="row ml-2">
                <div class="mr-2" style="margin-top: -3px!important;">
                    <svg width="1.25em" height="1.25em" viewBox="0 0 16 16" class="bi bi-arrow-down-right-circle-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.879 5.172a.5.5 0 0 0-.707.707l4.096 4.096H6.5a.5.5 0 1 0 0 1h3.975a.5.5 0 0 0 .5-.5V6.5a.5.5 0 0 0-1 0v2.768L5.879 5.172z"/>
                      </svg>
                </div>
                <p class="text-muted" style="color:#bbbbbb!important;">Gestionar Acceso</p>
            </div>
        </<?=$monitor?"button":"a"?>>
        <<?=$monitor?"button disabled":"a"?> href="?c=gestionar_institucion"
            class="list-group-item list-group-item-action bg-dark <?=$activo=='institucion'?'activo':''?>"
            style="padding-bottom: 0!important;">
            <div class="row ml-2">
                <div class="mr-2" style="margin-top: -3px!important;">
                <svg xmlns="http://www.w3.org/2000/svg" width="1.25em" height="1.25em" fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
                    <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                    <path fill-rule="evenodd" d="M5.216 14A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216z"/>
                    <path d="M4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5z"/>
                </svg>
                </div>
                <p class="text-muted" style="color:#bbbbbb!important;">Gestionar Institución</p>
            </div>
        </<?=$monitor?"button":"a"?>>
        <a href="?c=gestionar_estadisticas"
            class="list-group-item list-group-item-action bg-dark <?=$activo=='estadistica'?'activo':''?>"
            style="padding-bottom: 0!important;">
            <div class="row ml-2">
                <div class="mr-2" style="margin-top: -3px!important;">
                    <svg width="1.25em" height="1.25em" viewBox="0 0 16 16" class="bi bi-bar-chart-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <rect width="4" height="5" x="1" y="10" rx="1"/>
                        <rect width="4" height="9" x="6" y="6" rx="1"/>
                        <rect width="4" height="14" x="11" y="1" rx="1"/>
                      </svg>
                </div>
                <p class="text-muted" style="color:#bbbbbb!important;">Gestionar Estadística</p>
            </div>
        </a>
    </div>
</div>
<!-- /#sidebar-wrapper -->