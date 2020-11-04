<?php
    if (isset($_SESSION['email_otic'])){
        session_destroy(); /** Se procede a cerrar la sesión o lo que es lo mismo destruirla */
    }
    header("Location:./");  /** Se redirige a la página de iniciar sesión */
?>