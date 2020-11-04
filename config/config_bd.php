<?php 
/* Sobre PDO:

(1) PDO: Ésta clase PDO se encarga de mantener la 'conexión a la BD' y 'otro tipo de conexiones específicas' como transacciones, además de crear instancias de la clase PDOStatement

(2) PDOStatement: Es ésta clase, La que maneja las sentencias SQL y devuelve los resultados

(3) La clase PDOException se utiliza para manejar los errores */

//Constantes Postqgresql. 
define("SRV", "localhost");
define("USR", "postgres");
define("PAS", "0000");
define("BDN", "MPv2");

/* Maneras de declarar las constantes:

Sintaxis 1: define ("Nombre_Constante", "valor"); La separación con "," es equivalente al operador "=" Es obligatorio colocar nombre y valor con comillas

Sintaxis 2: const Nombre_Constante = "valor"; */

?>