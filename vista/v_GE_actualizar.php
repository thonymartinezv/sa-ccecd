<?php
session_start();
/**
 * Verificar si se ha iniciado sesión o en tal caso permiso.
 */
if (!isset($_SESSION['email_otic']) || ($_SESSION['pri_otic'] == 0) || !isset($_POST['email_usu'])) {
	header("Location: v_R.html");
	die();
} else {
	/**
	 * Clase Modelo de CRUD Empleado
	 * Configuración de fecha y hora
	 */
	require_once("../modelo/m_Empleado.php");
	require_once("../config/config_fh.php");
	$emp = new Empleado();
	$emp->setEmail($_POST['email_usu']); //contiene el email del empleado a actualizar
	$perfil = $emp->consultar_perfil_emp();
?>
 <!DOCTYPE html>
 <html lang="es">
 <head>
  <title>Actualizar empleado - CCECD </title>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="../css/z_GE_crear.css">
  <?php
    /**
     * Verificar privilegio
     * Se podra ejecutar un javascript diferente para DG y SAO
    */
    if ($_SESSION['pri_otic'] == 2) 
    {
        $src = "../js/GE_actualizar_DG.js";  
  ?>
  <?php 
    } else {
        $src = "../js/GE_actualizar_SAO.js";
    }
  ?>
 <script type="text/javascript" language="javascript" src="<?php echo $src; ?>"></script>
</head>
<body>
<img src="../img/MPPCT_OTIC_CCECD.png" height="10%" width="100%">
<div align="center">
<h1> Administrador formulario actualizar empleado -  CCECD</h1>
 <?php
 	/**
 	 * Incluir la configuración fecha y hora del sistema.
 	 * Es un arreglo con los siguientes valores:
 	 * 0-> fecha, 1-> hora, 2-> numero dia semana, 3-> nombre dia semana, 4-> dia del año, 5-> numero semana del año
 	 */
	$hoy = zh_vzla(); 
	echo "<p>Bienvenid@ <b>". $_SESSION['email_otic'] 
		."</b> al Sistema de Bitácora del CCECD. " . $hoy[3]. ", <b>". $hoy[0] . ' | '. $hoy[1] 
			."</b> | Semana del año: <b>". $hoy[5] 
				."</b> | Día del año: <b>". $hoy[4] ."</b> </p>";
 ?>
 </div>
    <!-- 
     -- Formulario permite actualizar el empelado seleccionado
    --->
 <form name="FGEA" id="formA" method="POST" autocomplete="off" action="../controlador/c_GE_actualizar.php" onsubmit="return forms_submit()">
 <p>
    Cada nombre deberá tener como mínimo <b>tres</b> (3), y, máximo <b>doce</b> (12) caracteres. <br>
    <!-- 
     -- Solicitar primer nombre
    --->
    <label for="p_nomb">Primer nombre:</label>
	<input type="text" name="p_nomb" id="p_nomb" placeholder="primer nombre" size="15" onclick="forms_reset(false,this.name,this)" 
		pattern="[A-Za-z]{3,12}" required name="p_nomb" value="<?php echo $perfil[0][0]['p_nomb'];?>"> <br>
    <!-- 
     -- Solicitar segundo nombre
    --->
    <label for="s_nomb">Segundo nombre:</label>
	<input type="text" name="s_nomb" id="s_nomb" placeholder="segundo nombre" size="15" onclick="forms_reset(false,this.name,this)" 
		pattern="[A-Za-z]{3,12}" value="<?php echo $perfil[0][0]['s_nomb']?>">
 </p>
 <p>
     Cada apellido deberá tener como mínimo <b>tres</b> (3), y, máximo <b>doce</b> (12) caracteres. <br>
    <!-- 
     -- Solicitar primer apellido
    --->
    <label for="p_apel">Primer apellido:</label>
	<input type="text" name="p_apel" id="p_apel" placeholder="primer apellido" size="15" onclick="forms_reset(false,this.name,this)" 
		pattern="[A-Za-z]{3,12}" required value="<?php echo $perfil[0][0]['p_apel']?>"> <br>
    <!-- 
     -- Solicitar segundo apellido
    --->    
    <label for="s_apel">Segundo apellido:</label>
	<input type="text" name="s_apel" id="s_apel" placeholder="segundo apellido" size="16" onclick="forms_reset(false,this.name,this)" 
		pattern="[A-Za-z]{3,12}" value="<?php echo $perfil[0][0]['s_apel']?>">
 </p>
 <p>
     La cédula de identidad es el número de registro a nivel nacional en Venezuela. <br>
     Como mínimo <b>siete</b> (7) y máximo <b>ocho</b> (8) dígitos. <br>
    <!-- 
     -- Solicitar cédula de identidad
    --->
    <label for="ci_emp"> Cédula de Identidad: </label>
	<input type="text" name="ci_emp" id="ci_emp" placeholder="ci" size="15" onclick="forms_reset(false,this.name,this)" 
		pattern="[0-9]{7,8}" required value="<?php echo $perfil[0][0]['ci_emp']?>">
 </p>
 <p>
     Un usuario de red siempre está formado por la letra inicial del primer nombre y cinco letras del primer apellido, además de un número.
     <b> Por ejemplo: </b> <input type="text" readonly placeholder="fguerr31" maxlength="8" size="8"><br>
     Como mínimo <b>cuatro</b> (4), y, máximo <b>siete </b> (7) caracteres. A su vez, <b>cero</b> (0) y máximo <b>dos</b> (2) dígitos. <br>
    <!-- 
     -- Solicitar usuario de red
    --->    
    <label for="email_emp"> Usuario de red: </label>
	<input type="text" name="email_emp" id="email_emp" placeholder="usuario de red" maxlength="15" size="10" onclick="forms_reset(false,this.name,this)" 
		pattern="[a-z]{4,7}[0-9]{0,2}" required value="<?php echo $perfil[0][0]['email_emp']?>">
 </p>
 <p>
     Fecha de ingreso del MPPCT. La creación del MPPCT fue el 30 de agosto de 1999 bajo la Gaceta Oficial Nro. 36.775 de ese mismo año. <br>
     Fecha mínima: <b>30/08/1999</b>, y, máxima hoy: <?php echo "<b>". $hoy[0]." </b>"; ?> <br>
    <!-- 
     -- Solicitar fecha de ingreso
    --->    
    <label for="fcha_ing">Fecha de ingreso: </label>
	<input type="date" name="fcha_ing" id="fcha_ing" min="1999-08-30" max="<?php echo $hoy[6]; ?>" onclick="forms_reset(false,this.name)" 
		required value="<?php echo $perfil[0][0]['fcha_ing']?>">
 </p>
    <!-- 
     -- Mantener usuario de red viejo (anterior al cambio)
    --->
	<input type="hidden" name="email_usu" value="<?php echo $_POST['email_usu']?>">
 <?php
 	/**
 	 * Bajo esta condición se determina el privilegio del Administrador.
 	 * Si es DG puede cambiar privilegio, SAO no puede.
 	 */
 if ($_SESSION['pri_otic'] == 2)
 	{
 ?>
	<p>
	 	Debe seleccionar un cargo que corresponda a su función de la OTIC. <br>
    <!-- 
     -- Solicitar privilegio (opcional)
    --->
	<select name="pri_usu" id="pri_usu" required>
 <?php
 	/**
 	 * Mediante este switch se despliega la selección del privilegio
 	 * Tomando en cuenta, el privilegio del usuario que se va a actualizar
 	 */
	switch ($perfil[1][0]["pri_usu"])
	{
		case 2:
			echo "<option value='2' autofocus> Director General (DG) </option> <br>";
			echo "<option value='1'> Superbitácora con Acceso a OTIC (SAO) </option>";
			echo "<option value='0'> Dirección de Infraestructura y Servidores (DIS) </option>";
		break;
		case 1:
			echo "<option value='1' autofocus> Superbitácora con Acceso a OTIC (SAO) </option>";
			echo "<option value='2'> Director General (DG) </option>";
			echo "<option value='0'> Dirección de Infraestructura y Servidores (DIS) </option>";
		break;
		case 0:
			echo "<option value='0' autofocus> Dirección de Infraestructura y Servidores (DIS) </option>";
			echo "<option value='2'> Director General (DG) </option>";
			echo "<option value='1'> Superbitácora con Acceso a OTIC (SAO) </option>";
		break;
	}
 ?>
	</select> 
	</p>
	<p>
	Debe seleccionar un Estado:
    <!-- 
     -- Solicitar estado de usuario (opcional)
    --->
 <?php
 	/**
 	 * Mediante este switch se despliega la selección del estado de usuario
 	 */
	switch ($perfil[1][0]["estado_usu"]) {
		case 2:
			echo "<br><label for='ab'>Actualmente Bloqueado</label> [<input type='radio' id='ab' name='est_usu' value='2' autofocus required>] <br>";
			echo "<label for='aa'>Activo</label> <input type='radio' id='aa' name='est_usu' value='1' required> <br>";
			echo "<label for='ai'>Inactivo</label> <input type='radio' id='ai' name='est_usu' value='0' required> <br>";
			break;
		case 1:
			echo "<br><label for='aa'>Actualmente Activo </label> [<input type='radio' id='aa' name='est_usu' value='1' autofocus required>] <br>";
			echo "<label for='ai'>Inactivo</label> <input type='radio' id='ai' name='est_usu' value='0' required> <br>";
			echo "<label for='ab'>Bloqueado</label> <input type='radio' id='ab' name='est_usu' value='2' required> <br>";
			break;
		case 0:
			echo "<br><label for='ai'>Actualmente Inactivo</label> [<input type='radio' id='ai' name='est_usu' value='0' autofocus required>] <br>";
			echo "<label for='aa'>Activo</label> <input type='radio' id='aa' name='est_usu' value='1' required> <br>";
			echo "<label for='ab'>Bloqueado</label> <input type='radio' id='ab' name='est_usu' value='2' required> <br>";
			break;
		}
	}
 ?>
 </p>
 </form>
    <!-- 
     -- Formulario que permite regresar a seleccionar un empleado
    --->
 <form name='GECA' id="GECA" method='POST' action='v_GE_consultar.php'>
    <!-- 
     -- Se mantiene un input oculto porque contiene el valor de regreso a la página para seleccionar un empleado
    --->
	<input type='hidden' name='ele' value='A'>
 </form>
 <div align='center'>
 <p>
	<!--Como se puede visualizar los dos input type=submit están fuera de sus respectivos formularios-->
	<!--Utilizando 'ID' en el formulario,y, en el input el atributo 'form' Se consiga mantener su relación-->
	<input form="formA" type="submit" name="act_emp" value="Actualizar" onclick="procesar(this.value)">
	<input form="formA" type="button" name="limpiar" value="Restablecer" onclick="forms_reset(true,this.name)">
	<input form="GECA" type='submit' name='submit' value='Volver'>
 </p>
 </div>
 </body>
 </html>
<?php 
	}
?>