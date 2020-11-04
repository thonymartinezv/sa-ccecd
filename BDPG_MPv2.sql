PGDMP                         x            MPv2    10.10    10.10     �
           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                       false            �
           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                       false            �
           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                       false            �
           1262    24592    MPv2    DATABASE     �   CREATE DATABASE "MPv2" WITH TEMPLATE = template0 ENCODING = 'UTF8' LC_COLLATE = 'Spanish_Bolivarian Republic of Venezuela.1252' LC_CTYPE = 'Spanish_Bolivarian Republic of Venezuela.1252';
    DROP DATABASE "MPv2";
             postgres    false                        2615    2200    public    SCHEMA        CREATE SCHEMA public;
    DROP SCHEMA public;
             postgres    false            �
           0    0    SCHEMA public    COMMENT     6   COMMENT ON SCHEMA public IS 'standard public schema';
                  postgres    false    3                        3079    12924    plpgsql 	   EXTENSION     ?   CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;
    DROP EXTENSION plpgsql;
                  false            �
           0    0    EXTENSION plpgsql    COMMENT     @   COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';
                       false    1            �            1259    24678    empleado    TABLE       CREATE TABLE public.empleado (
    email_emp character varying NOT NULL,
    ci_emp integer NOT NULL,
    p_nomb character varying NOT NULL,
    s_nomb character varying,
    p_apel character varying NOT NULL,
    s_apel character varying,
    fcha_ing date NOT NULL
);
    DROP TABLE public.empleado;
       public         postgres    false    3            �            1259    24686    usuario    TABLE     �   CREATE TABLE public.usuario (
    email_usu character varying NOT NULL,
    clave_usu character varying NOT NULL,
    pri_usu integer NOT NULL,
    estado_usu integer NOT NULL
);
    DROP TABLE public.usuario;
       public         postgres    false    3            �
          0    24678    empleado 
   TABLE DATA               _   COPY public.empleado (email_emp, ci_emp, p_nomb, s_nomb, p_apel, s_apel, fcha_ing) FROM stdin;
    public       postgres    false    196   �       �
          0    24686    usuario 
   TABLE DATA               L   COPY public.usuario (email_usu, clave_usu, pri_usu, estado_usu) FROM stdin;
    public       postgres    false    197   �       s
           2606    24685    empleado email_emp_pk 
   CONSTRAINT     Z   ALTER TABLE ONLY public.empleado
    ADD CONSTRAINT email_emp_pk PRIMARY KEY (email_emp);
 ?   ALTER TABLE ONLY public.empleado DROP CONSTRAINT email_emp_pk;
       public         postgres    false    196            t
           1259    24697    fki_email_usu_fk    INDEX     I   CREATE INDEX fki_email_usu_fk ON public.usuario USING btree (email_usu);
 $   DROP INDEX public.fki_email_usu_fk;
       public         postgres    false    197            u
           2606    24692    usuario email_usu_fk    FK CONSTRAINT     �   ALTER TABLE ONLY public.usuario
    ADD CONSTRAINT email_usu_fk FOREIGN KEY (email_usu) REFERENCES public.empleado(email_emp) ON UPDATE CASCADE ON DELETE CASCADE NOT VALID;
 >   ALTER TABLE ONLY public.usuario DROP CONSTRAINT email_usu_fk;
       public       postgres    false    196    2675    197            �
   �   x�M��j�0�ϫwqٕl�:�@��Pz�eqT��^�u|h��R(����ƝGK艚S�6�o�c1�� ����ț�5�mk���9xV�aކp*βp�[,y$�źr��M�:�x�
�y�8.�?����B	�
�ᕵPjr5�ܦ$yө���ְ&�d����$�<����o+ZsY��C��a����ΒW]4��x�,��/��˸GUʭ6�uh�5f�fh��+ˣ]2g��U��'c���aZ      �
   u   x�=�1�0�����H�.]C��R�tv�H�U1�����>��]��.���TQM����2е��n�b��ߤ�����3�����_��\�
��ѽuW�I׏�8z4���b��#%�     