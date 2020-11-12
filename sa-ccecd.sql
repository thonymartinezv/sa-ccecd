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
-- Name: empleado; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.empleado (
    email_emp character varying NOT NULL,
    ci_emp integer NOT NULL,
    p_nomb character varying NOT NULL,
    s_nomb character varying,
    p_apel character varying NOT NULL,
    s_apel character varying,
    fcha_ing date NOT NULL
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
-- Data for Name: empleado; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.empleado (email_emp, ci_emp, p_nomb, p_apel, fcha_ing) VALUES
('cguagn','21071155','Chessary','Guagnoni','2016-08-17'),
('fmonti','22777333','Francisco','Montilla','2020-08-01'),
('parmao','26454382','Peter','Armao','2019-07-03'),
('amarti','24134197','Anthony','Martinez','2020-08-02'),
('arondo','20758909','Adonai','Rondon','2012-10-16'),
('jgarci','27309195','Juan','Garcia','2020-07-01'),
('lguerr','26902302','Leonardo','Guerra','2020-07-31');


--
-- Data for Name: usuario; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.usuario(email_usu, clave_usu, pri_usu, estado_usu) VALUES 
('cguagn' , 'CHch123.' , 2 , 0),
('fmonti' , 'FMfm123.' , 2 , 1),
('amarti' , 'AMam123.' , 1 , 1),
('parmao' , 'PApa123.' , 1 , 1),
('arondo' , 'ARar123.' , 0 , 0),
('jgarci' , 'JGjg123.' , 0 , 1),
('lguerr' , 'LGlg123.' , 2 , 1);

--
-- Name: empleado email_emp_pk; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.empleado
    ADD CONSTRAINT email_emp_pk PRIMARY KEY (email_emp);


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

