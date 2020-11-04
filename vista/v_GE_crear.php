<?php
     include_once("config/config_fh.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
<title>GE crear empleado - CCECD</title>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="css/z_GE_crear.css">
<script type="text/javascript" language="javascript" src="js/GE_crear.js"></script>
</head>
<body oncopy="return false" onpaste="return false"> <!-- No se permite copiar ni pegar datos al formulario-->
     <div class="img" align="center">
     <img src="img/MPPCT_OTIC_CCECD.png" height="10%" width="100%">
     <h1 > Administrador formulario crear empleado -  CCECD</h1>
     <?php
          $hoy = zh_vzla(); 
          echo "<p>Bienvenid@ <b>". $_SESSION['email_otic'] ."</b> al Sistema de Bitácora del CCECD. " . $hoy[3]. ", <b>". $hoy[0] . ' | '. 
          $hoy[1] ."</b> | Semana del año: <b>". $hoy[5] ."</b> | Día del año: <b>". $hoy[4] ."</b> </p>";
     ?>
</div>


<!-- Se establece nombre: Formulario Gestionar Empleado Creación -->
<!-- El formulario con el atributo autocomplete en off no permite desplegar información de los usuarios anteriores-->
<!-- Se establece dos eventos: Restablecer campos y validar envío del formulario (Importante el return) -->
<form name="FGEC" action="../controlador/c_GE_crear.php" method="POST" autocomplete="off" onsubmit="return forms_submit()">
     <p>
          Un usuario de red siempre está formado por la letra inicial del primer nombre y cinco letras del primer apellido, además de un número.
          <b> Por ejemplo: </b> <input type="text" readonly placeholder="fguerr31" maxlength="8" size="8"><br>
          Como mínimo <b>cuatro</b> (4), y, máximo <b>siete </b> (7) caracteres. A su vez, <b>cero</b> (0) y máximo <b>dos</b> (2) dígitos. <br>
          <label for="email_emp"> Usuario de red: </label>
     <input type="text" name="email_emp" id="email_emp" placeholder="usuario de red" maxlength="9" size="15" onclick="forms_reset(false,this.name,this)" pattern="[a-z]{4,7}[0-9]{0,2}" required>
     </p>
     <p>
          La cédula de identidad es el número de registro a nivel nacional en Venezuela. <br>
          Como mínimo <b>siete</b> (7) y máximo <b>ocho</b> (8) dígitos. <br>
     <label for="ci_emp"> Cédula de Identidad: </label>
<input type="text" name="ci_emp" id="ci_emp" placeholder="ci" size="15" maxlength="8" onclick="forms_reset(false,this.name,this)" pattern="[0-9]{7,8}" required>
</p>
<p>
     Cada nombre deberá tener como mínimo <b>tres</b> (3), y, máximo <b>doce</b> (12) caracteres. <br>
     <label for="p_nomb">Primer nombre:</label>
     <input type="text" name="p_nomb" id="p_nomb" placeholder="primer nombre" maxlength="12" size="15" onclick="forms_reset(false,this.name,this)" pattern="[A-Za-z]{3,12}" required> <br>
     <label for="s_nomb">Segundo nombre:</label>
<input type="text" name="s_nomb" id="s_nomb" placeholder="segundo nombre" maxlength="12" size="15" onclick="forms_reset(false,this.name,this)" pattern="[A-Za-z]{3,12}">
</p>
<p>
     Cada apellido deberá tener como mínimo <b>tres</b> (3), y, máximo <b>doce</b> (12) caracteres. <br>
     <label for="p_apel">Primer apellido:</label>
<input type="text" name="p_apel" id="p_apel" placeholder="primer apellido" maxlength="12" size="15" onclick="forms_reset(false,this.name,this)" pattern="[A-Za-z]{3,12}" required> <br>
     <label for="s_apel">Segundo apellido:</label>
<input type="text" name="s_apel" id="s_apel" placeholder="segundo apellido" maxlength="12" size="16" onclick="forms_reset(false,this.name,this)" pattern="[A-Za-z]{3,12}">
</p>

<p>
     Fecha de ingreso del MPPCT. La creación del MPPCT fue el 30 de agosto de 1999 bajo la Gaceta Oficial Nro. 36.775 de ese mismo año. <br>
     Fecha mínima: <b>30/08/1999</b>, y, máxima hoy: <?php echo "<b>". $hoy[0]." </b>"; ?> <br>
     <label for="fcha_ing">Fecha de ingreso: </label>
<input type="date" name="fcha_ing" id="fcha_ing" min="1999-08-30" max="<?php echo $hoy[6]; ?>" onclick="forms_reset(false,this.name)" required>
</p>

<p>
	Debe seleccionar un cargo que corresponda a su función de la OTIC. <br>
<?php 
	   if ($_SESSION['pri_otic'] == 2) { ?> 
		<select name="pri_usu" id="pri_usu" required>
		<option value=""> Seleccione </option>
		<option value="2"> Director General (DG) </option>
		<option value="1"> Superbitácora con Acceso a OTIC (SAO) </option>
		<option value="0"> Dirección de Infraestructura y Servidores (DIS) </option>
		</select>
<?php } elseif ($_SESSION['pri_otic'] == 1) { ?> 
		<select name="pri_usu" id="pri_usu" required>
		<option value=""> Seleccione </option>
		<option value="1"> Superbitácora con Acceso a OTIC (SAO) </option>
		<option value="0"> Dirección de Infraestructura y Servidores (DIS) </option>
		</select>
<?php } ?>
</p>
<p>
     La contraseña es su seguridad en el acceso al sistema del CCECD. <br>
     Debe contener un mínimo de <b>ocho</b> (8), y, un máximo de <b>dieciocho</b> (18) caracteres. <br>
     Debe contener minúsculas. <br>
     Debe contener mayúsculas. <br>		
     Debe contener números. <br>
     Debe contener al menos uno de los siguientes caracteres: [ . ] [ , ] [ - ] [ / ] [ * ] [ + ] <br>
     <label for="clv_usu"> Contraseña: </label>
<input type="password" name="clv_usu" id="clv_usu" placeholder="contraseña" minlength="8" maxlength="18" onclick="forms_reset(false,this.name,this)" required>
</p>
     <!-- El estado del nuevo empleado será activo automática por su creación. Por tal razón se oculta al usuario -->
<input type="hidden" name="est_usu" value="1">
<div align="center">
<p>
     <input type="submit" name="reg_emp" value="Registrar" onclick="procesar(this.value)">
     <input type="button" name="limpiar" value="Restablecer" onclick="forms_reset(true,this.name)">
     <a href="v_indexMadmin.php"><input type="button" name="GE" value="Volver"></a>
</p>
</div>
</form>
</body>
</html>