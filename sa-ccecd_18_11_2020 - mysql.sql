# Converted with pg2mysql-1.9
# Converted on Sat, 06 Feb 2021 15:19:07 -0500
# Lightbox Technologies Inc. http://www.lightbox.ca

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone="+00:00";

CREATE TABLE acceso (
    id_acc int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    ci_mon int(11) NOT NULL,
    ci_adm int(11) NOT NULL,
    motivo varchar(255) NOT NULL,
    estado_acc int(11) NOT NULL,
    prioridad int(11) NOT NULL,
    fcha_inicio timestamp,
    fcha_final timestamp,
    avance varchar(255) NOT NULL,
    reporte varchar(255) NOT NULL
);

CREATE TABLE institution (
    id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nombre varchar(255) NOT NULL
);

CREATE TABLE empleado (
    email_emp varchar(50) NOT NULL,
    ci_emp int(11) NOT NULL,
    p_nomb varchar(255) NOT NULL,
    s_nomb varchar(255),
    p_apel varchar(255) NOT NULL,
    s_apel varchar(255),
    id_institution int(11) NOT NULL,
    fcha_ing date NOT NULL,
    tlf varchar(11) NOT NULL
);

CREATE TABLE usuario (
    email_usu varchar(255) NOT NULL,
    clave_usu varchar(255) NOT NULL,
    pri_usu int(11) NOT NULL,
    estado_usu int(11) NOT NULL
);

INSERT INTO acceso (id_acc, ci_mon, ci_adm, motivo, estado_acc, prioridad, fcha_inicio, fcha_final, avance,reporte) VALUES
(35,12345678,26902302,'Inventario',1,0,'2020-11-17 16:03:40','2020-11-30 16:04:35','2020-11-30 16:04:04 lguerr10: asdasd','Finalizado correctamente'),
(36,12345678,26902302,'Corte de FO',1,2,'2020-10-01 00:31:27','2020-11-18 00:32:06','2020-10-01 00:31:27 lguerr10: Fase I en progreso','Finalizado correctamente'),
(37,21071155,24134197,'Prueba de servidores',2,1,'2020-11-18 00:37:39','2020-11-18 03:18:04','Prueba de servidores','No se pudo entrar al cuarto'),
(38,12345678,26902302,'Pruebas',2,0,'2020-11-18 00:41:59','2020-12-01 00:42:34','Prueba de servidores','Se suspendió el acceso por cambio de turno'),
(39,12345678,26902302,'Prueba menor',0,0,'2020-11-18 01:11:57','2020-11-18 01:12:06','Prueba de mantenimiento','');

INSERT INTO institution (id , nombre) VALUES
(1,'MPPCT');

INSERT INTO empleado (email_emp, ci_emp, p_nomb, p_apel, fcha_ing,id_institution, tlf) VALUES
('jreina@mppct.gob.ve','12345678','Jesus','Reina','2020-08-14', 1 ,'02129999999'),
('cguagn@mppct.gob.ve','21071155','Chessary','Guagnoni','2016-08-17', 1 ,'02129999999'),
('fmonti@mppct.gob.ve','22777333','Francisco','Montilla','2020-08-01', 1 ,'02129999999'),
('parmao@mppct.gob.ve','26454382','Peter','Armao','2019-07-03', 1 ,'02129999999'),
('amarti@mppct.gob.ve','24134197','Anthony','Martinez','2020-08-02', 1 ,'02129999999'),
('arondo@mppct.gob.ve','20758909','Adonai','Rondon','2012-10-16', 1 ,'02129999999'),
('jgarci@mppct.gob.ve','27309195','Juan','Garcia','2020-07-01', 1 ,'02129999999'),
('lguerr@mppct.gob.ve','26902302','Leonardo','Guerra','2020-07-31', 1 ,'02129999999');

INSERT INTO usuario(email_usu, clave_usu, pri_usu, estado_usu) VALUES 
('cguagn@mppct.gob.ve' , '81dc9bdb52d04dc20036dbd8313ed055' , 2 , 0),
('fmonti@mppct.gob.ve' , '81dc9bdb52d04dc20036dbd8313ed055' , 2 , 1),
('amarti@mppct.gob.ve' , '81dc9bdb52d04dc20036dbd8313ed055' , 1 , 1),
('parmao@mppct.gob.ve' , '81dc9bdb52d04dc20036dbd8313ed055' , 1 , 1),
('jreina@mppct.gob.ve' , '81dc9bdb52d04dc20036dbd8313ed055' , 1 , 1),
('arondo@mppct.gob.ve' , '81dc9bdb52d04dc20036dbd8313ed055' , 0 , 0),
('jgarci@mppct.gob.ve' , '81dc9bdb52d04dc20036dbd8313ed055' , 0 , 1),
('lguerr@mppct.gob.ve' , '81dc9bdb52d04dc20036dbd8313ed055' , 2 , 1);
ALTER TABLE empleado
    ADD CONSTRAINT email_emp_pk PRIMARY KEY (email_emp);