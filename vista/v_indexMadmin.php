<?php // Menú administrador
  include_once("config/config_fh.php");
?>
<!DOCTYPE html>
<html lang="es">
  <head>
  <title>CCECD - Menú Administrador</title>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="css/z3_indexAdmin.css">
     <script type="text/javascript">
      
      /** Se determina a qué página o función elige el usuario */
      function elegir(valor)
      {
        if (valor == "R") {
          document.cae.action = "?r=GE_crear";
        } else {
          document.cae.action = "?r=GE_consultar";
        }

        if (valor == "CE") {
          document.cae.ele.value = "CE";
        }

        if (valor == "CP") {
          document.cae.ele.value = "CP";
        }

        if (valor == "A") {
          document.cae.ele.value = "A";
        }

        if (valor == "E") {
          document.cae.ele.value = "E";
        }
        document.cae.method= 'POST';
        document.cae.submit();
      }

      function CS(valor) {
        if (valor == "CS") {
          document.link.action = "?c=CS";
          document.link.method= 'POST';
          document.link.submit();
        }
      }
     </script>
  </head>
  <body>
  <div class="img" align="center">
  <img src="img/MPPCT_OTIC_CCECD.png" height="10%" width="100%">
  </div>
  <h1 align="center">Administrador</h1>
  <?php
    $hoy = zh_vzla(); //0-> fecha, 1-> hora, 2-> numero dia semana, 3-> nombre dia semana, 4-> dia del año, 5-> numero semana del año
    echo "<p align='center'>Bienvenid@ <b>". $_SESSION['email_otic'] ."</b> al Sistema de Bitácora del CCECD. " . $hoy[3]. ", <b>". $hoy[0] . ' | '. 
    $hoy[1] ."</b> | Semana del año: <b>". $hoy[5] ."</b> | Día del año: <b>". $hoy[4] ."</b> </p>";
  ?>
  <!--Formulario con input oculto que representa una página hacia donde quiera ir el usuario-->
  <form name="cae"> <input type="hidden" name="ele"></form>

  <!--Formulario cerrar sesión oculto -->
  <form name="link" type="hidden"></form>

  <div class="contenid" align="center">
      <ul class="menu">
            <li class="lip"> <button>Gestionar empleado</button>
                <ul>
                <li><button name="GE" value="R" onclick="elegir(this.value)">Crear empleado</button></li>
                <li><button name="GE" value="CE" onclick="elegir(this.value)">Consultar empleados</button></li>
                <li><button name="GE" value="CP" onclick="elegir(this.value)">Consultar perfil de empleado</button></li>
                <li><button name="GE" value="A" onclick="elegir(this.value)">Actualizar empleado</button></li>
                <li><button name="GE" value="E" onclick="elegir(this.value)">Eliminar empleado</button></li>
                </ul>
            </li>

            <li class="lip"> <button href="#" >Gestionar acceso</button>
                <ul>
                <li><button>Crear acceso</button></li>
                <li><button>Consultar accesos</button></li>
                <li><button>Actualizar acceso</button></li>
                <li><button>Eliminar acceso</button></li>
                </ul>
            </li> 

            <li class="lip"><button  id="GET">Gestionar estadística</button></li> 
            <li class="lip"><button name="CS" id="CS" value="CS" onclick="CS(this.value)">Cerrar sesión</button></li> 
      </ul>
  </div>
 </body>
</html>