<?php
    if (!isset($_SESSION['email_otic']) || $_SESSION['pri_otic'] == 0 || !isset($_POST['ele'])) {
    	include("vista/v_R.html");
    }else{
        include("vista/v_GE_consultar.php");
    }