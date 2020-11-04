<!DOCTYPE html>
<html lang="es">
 <head>
    <title> Cerrar sesión sistema del CCECD </title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="../css/z3_IS.css">
 </head>
 <body> 
    <section>
     <article>
        <div align="center">
          <img src="../img/UNEXCA_MPPCT.png" height="10%" width="100%">
        </div>
     </article>
     <h1 align="center"> Cerrar sesión - CCECD </h1> 
      <?php
        session_start();
        /** Si el arreglo de sesión se encuentra vacía se redirecciona a la pagina principal */
        if (!isset($_SESSION['email_otic'])){
          header("Location: v_indexIS.html");  /** Se redirige a la página de iniciar sesión */
          die(); /** Dejamos de ejecutar el código */
        } else {
          session_destroy(); /** Se procede a cerrar la sesión o lo que es lo mismo destruirla */
          echo "<p> Ha cerrado exitosamente la sesión </p>";
          echo "<div align='center'> <p><a href=v_indexIS.html> Haga click aquí para iniciar sesión </a></p> <div>";
        }
      ?>
    </section>
 </body>
</html>