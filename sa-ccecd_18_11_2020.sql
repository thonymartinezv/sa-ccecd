--
-- PostgreSQL database dump
--

-- Dumped from database version 10.10
-- Dumped by pg_dump version 10.10

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: acceso; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.acceso (
    id_acc integer NOT NULL,
    ci_mon integer NOT NULL,
    ci_adm integer NOT NULL,
    motivo character varying NOT NULL,
    estado_acc integer NOT NULL,
    prioridad integer NOT NULL,
    fcha_inicio timestamp without time zone,
    fcha_final timestamp without time zone,
    avance character varying NOT NULL,
    reporte character varying NOT NULL
);

CREATE TABLE public.institution (
    id integer NOT NULL,
    nombre character varying NOT NULL
);


ALTER TABLE public.acceso OWNER TO postgres;

--
-- Name: acceso_id_acc_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.acceso_id_acc_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.acceso_id_acc_seq OWNER TO postgres;

--
-- Name: acceso_id_acc_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.acceso_id_acc_seq OWNED BY public.acceso.id_acc;



CREATE SEQUENCE public.institution_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
ALTER TABLE public.institution_id_seq OWNER TO postgres;
ALTER SEQUENCE public.institution_id_seq OWNED BY public.institution.id;



--
-- Name: empleado; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.empleado (
    email_emp character varying NOT NULL,
    ci_emp integer NOT NULL,
    p_nomb character varying NOT NULL,
    s_nomb character varying,
    p_apel character varying NOT NULL,
    s_apel character varying,
    fcha_ing date NOT NULL,
    id_institution integer NOT NULL,
    tlf character varying(11) NOT NULL
);


ALTER TABLE public.empleado OWNER TO postgres;

--
-- Name: usuario; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.usuario (
    email_usu character varying NOT NULL,
    clave_usu character varying NOT NULL,
    pri_usu integer NOT NULL,
    estado_usu integer NOT NULL
);


ALTER TABLE public.usuario OWNER TO postgres;

--
-- Name: acceso id_acc; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.acceso ALTER COLUMN id_acc SET DEFAULT nextval('public.acceso_id_acc_seq'::regclass);


--
-- Data for Name: acceso; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.acceso (id_acc, ci_mon, ci_adm, motivo, estado_acc, prioridad, fcha_inicio, fcha_final, avance,reporte) VALUES
(35,12345678,26902302,'Inventario',1,0,'2020-11-17 16:03:40','2020-11-30 16:04:35','2020-11-30 16:04:04 lguerr10: asdasd','Finalizado correctamente'),
(36,12345678,26902302,'Corte de FO',1,2,'2020-10-01 00:31:27','2020-11-18 00:32:06','2020-10-01 00:31:27 lguerr10: Fase I en progreso','Finalizado correctamente'),
(37,21071155,24134197,'Prueba de servidores',2,1,'2020-11-18 00:37:39','2020-11-18 03:18:04','Prueba de servidores','No se pudo entrar al cuarto'),
(38,12345678,26902302,'Pruebas',2,0,'2020-11-18 00:41:59','2020-12-01 00:42:34','Prueba de servidores','Se suspendió el acceso por cambio de turno'),
(39,12345678,26902302,'Prueba menor',0,0,'2020-11-18 01:11:57','2020-11-18 01:12:06','Prueba de mantenimiento','');


--
-- Data for Name: empleado; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.institution (id , nombre) VALUES
(1,'MPPCT');

INSERT INTO public.empleado (email_emp, ci_emp, p_nomb, p_apel, fcha_ing,id_institution, tlf) VALUES
('jreina@mppct.gob.ve','12345678','Jesus','Reina','2020-08-14',1,'02129999999'),
('cguagn@mppct.gob.ve','21071155','Chessary','Guagnoni','2016-08-17',1,'02129999999'),
('fmonti@mppct.gob.ve','22777333','Francisco','Montilla','2020-08-01',1,'02129999999'),
('parmao@mppct.gob.ve','26454382','Peter','Armao','2019-07-03',1,'02129999999'),
('amarti@mppct.gob.ve','24134197','Anthony','Martinez','2020-08-02',1,'02129999999'),
('arondo@mppct.gob.ve','20758909','Adonai','Rondon','2012-10-16',1,'02129999999'),
('jgarci@mppct.gob.ve','27309195','Juan','Garcia','2020-07-01',1,'02129999999'),
('lguerr@mppct.gob.ve','26902302','Leonardo','Guerra','2020-07-31',1,'02129999999');



--
-- Data for Name: usuario; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.usuario(email_usu, clave_usu, pri_usu, estado_usu) VALUES 
('cguagn@mppct.gob.ve' , '81dc9bdb52d04dc20036dbd8313ed055' , 2 , 0),
('fmonti@mppct.gob.ve' , '81dc9bdb52d04dc20036dbd8313ed055' , 2 , 1),
('amarti@mppct.gob.ve' , '81dc9bdb52d04dc20036dbd8313ed055' , 1 , 1),
('parmao@mppct.gob.ve' , '81dc9bdb52d04dc20036dbd8313ed055' , 1 , 1),
('jreina@mppct.gob.ve' , '81dc9bdb52d04dc20036dbd8313ed055' , 1 , 1),
('arondo@mppct.gob.ve' , '81dc9bdb52d04dc20036dbd8313ed055' , 0 , 0),
('jgarci@mppct.gob.ve' , '81dc9bdb52d04dc20036dbd8313ed055' , 0 , 1),
('lguerr@mppct.gob.ve' , '81dc9bdb52d04dc20036dbd8313ed055' , 2 , 1);


--
-- Name: acceso_id_acc_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.acceso_id_acc_seq', 39, true);
SELECT pg_catalog.setval('public.institution_id_seq', 1, true);


--
-- Name: empleado email_emp_pk; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.empleado
    ADD CONSTRAINT email_emp_pk PRIMARY KEY (email_emp);



ALTER TABLE ONLY public.institution
    ADD CONSTRAINT id_institution_pk PRIMARY KEY (id);


--
-- Name: acceso id_acc_pk; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.acceso
    ADD CONSTRAINT id_acc_pk PRIMARY KEY (id_acc);


--
-- Name: fki_email_usu_fk; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX fki_email_usu_fk ON public.usuario USING btree (email_usu);


--
-- Name: usuario email_usu_fk; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.usuario
    ADD CONSTRAINT email_usu_fk FOREIGN KEY (email_usu) REFERENCES public.empleado(email_emp) ON UPDATE CASCADE ON DELETE CASCADE NOT VALID;


--
-- PostgreSQL database dump complete
--

