PGDMP         "            
    x            MPv2    10.10    10.10     �
           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                       false                        0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                       false                       0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                       false                       1262    24592    MPv2    DATABASE     �   CREATE DATABASE "MPv2" WITH TEMPLATE = template0 ENCODING = 'UTF8' LC_COLLATE = 'Spanish_Bolivarian Republic of Venezuela.1252' LC_CTYPE = 'Spanish_Bolivarian Republic of Venezuela.1252';
    DROP DATABASE "MPv2";
             postgres    false                        2615    2200    public    SCHEMA        CREATE SCHEMA public;
    DROP SCHEMA public;
             postgres    false                       0    0    SCHEMA public    COMMENT     6   COMMENT ON SCHEMA public IS 'standard public schema';
                  postgres    false    3                        3079    12924    plpgsql 	   EXTENSION     ?   CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;
    DROP EXTENSION plpgsql;
                  false                       0    0    EXTENSION plpgsql    COMMENT     @   COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';
                       false    1            �            1259    25264    acceso    TABLE     ^  CREATE TABLE public.acceso (
    id_acc integer NOT NULL,
    ci_mon integer NOT NULL,
    ci_adm integer NOT NULL,
    motivo character varying NOT NULL,
    estado_acc integer NOT NULL,
    prioridad integer NOT NULL,
    fcha_inicio timestamp without time zone,
    fcha_final timestamp without time zone,
    avance character varying NOT NULL
);
    DROP TABLE public.acceso;
       public         postgres    false    3            �            1259    25267    acceso_id_acc_seq    SEQUENCE     �   CREATE SEQUENCE public.acceso_id_acc_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 (   DROP SEQUENCE public.acceso_id_acc_seq;
       public       postgres    false    198    3                       0    0    acceso_id_acc_seq    SEQUENCE OWNED BY     G   ALTER SEQUENCE public.acceso_id_acc_seq OWNED BY public.acceso.id_acc;
            public       postgres    false    199            �            1259    24678    empleado    TABLE     e  CREATE TABLE public.empleado (
    email_emp character varying NOT NULL,
    ci_emp integer NOT NULL,
    p_nomb character varying NOT NULL,
    s_nomb character varying,
    p_apel character varying NOT NULL,
    s_apel character varying,
    fcha_ing date NOT NULL,
    tipo_sangre character varying(5) NOT NULL,
    tlf character varying(11) NOT NULL
);
    DROP TABLE public.empleado;
       public         postgres    false    3            �            1259    24686    usuario    TABLE     �   CREATE TABLE public.usuario (
    email_usu character varying NOT NULL,
    clave_usu character varying NOT NULL,
    pri_usu integer NOT NULL,
    estado_usu integer NOT NULL
);
    DROP TABLE public.usuario;
       public         postgres    false    3            y
           2604    25269    acceso id_acc    DEFAULT     n   ALTER TABLE ONLY public.acceso ALTER COLUMN id_acc SET DEFAULT nextval('public.acceso_id_acc_seq'::regclass);
 <   ALTER TABLE public.acceso ALTER COLUMN id_acc DROP DEFAULT;
       public       postgres    false    199    198            �
          0    25264    acceso 
   TABLE DATA               x   COPY public.acceso (id_acc, ci_mon, ci_adm, motivo, estado_acc, prioridad, fcha_inicio, fcha_final, avance) FROM stdin;
    public       postgres    false    198   W       �
          0    24678    empleado 
   TABLE DATA               q   COPY public.empleado (email_emp, ci_emp, p_nomb, s_nomb, p_apel, s_apel, fcha_ing, tipo_sangre, tlf) FROM stdin;
    public       postgres    false    196   c       �
          0    24686    usuario 
   TABLE DATA               L   COPY public.usuario (email_usu, clave_usu, pri_usu, estado_usu) FROM stdin;
    public       postgres    false    197   �                  0    0    acceso_id_acc_seq    SEQUENCE SET     @   SELECT pg_catalog.setval('public.acceso_id_acc_seq', 39, true);
            public       postgres    false    199            {
           2606    24685    empleado email_emp_pk 
   CONSTRAINT     Z   ALTER TABLE ONLY public.empleado
    ADD CONSTRAINT email_emp_pk PRIMARY KEY (email_emp);
 ?   ALTER TABLE ONLY public.empleado DROP CONSTRAINT email_emp_pk;
       public         postgres    false    196            ~
           2606    25277    acceso id_acc_pk 
   CONSTRAINT     R   ALTER TABLE ONLY public.acceso
    ADD CONSTRAINT id_acc_pk PRIMARY KEY (id_acc);
 :   ALTER TABLE ONLY public.acceso DROP CONSTRAINT id_acc_pk;
       public         postgres    false    198            |
           1259    24697    fki_email_usu_fk    INDEX     I   CREATE INDEX fki_email_usu_fk ON public.usuario USING btree (email_usu);
 $   DROP INDEX public.fki_email_usu_fk;
       public         postgres    false    197            
           2606    24692    usuario email_usu_fk    FK CONSTRAINT     �   ALTER TABLE ONLY public.usuario
    ADD CONSTRAINT email_usu_fk FOREIGN KEY (email_usu) REFERENCES public.empleado(email_emp) ON UPDATE CASCADE ON DELETE CASCADE NOT VALID;
 >   ALTER TABLE ONLY public.usuario DROP CONSTRAINT email_usu_fk;
       public       postgres    false    2683    197    196            �
   �   x�m�Kn�0���)|��a0����)�^��(�Ȥ�X�ЋRxXb5��͌9WHl���
��Թ�	���k�P�" �3t��f�
�)�i/�!F1~h����G��m��"�뽏�`�`Nc0Z�� ar�嬑@��'?s6�3��_bz�ej�۽�i�����M!h���(y�h� -	۔o_[s���� /p{m�v�[�j�ա��X�M���-�q�3:�j��`9>\�wh�����x��      �
   ;  x����j�0��ʫ��N��v(�J�q�5iBjoJs؞~v��аÌO�~�ק^\�	H颬Lk7N#�.�*̱Ω��P��������:>��;P邬�Ɵ��lRܻ��սxh''B�XT:4���$ l������v�փ"4De	OG7�,q�*%��ٶ�W���8����е��;;�M�?����/Ač������K���MY[����8v��~�f��b�L�㾑w���E�a��1�b#�i��oY�]��FK����>�R�a�t��h��`�T?�]�/q��V���S\;�E���,˾�6��      �
   �   x�M��
�0����ad�n�M��H�ປ���h����ۏ�?��E4ӵ�A�CE��B�<G�-�f������,�}!�A���6�gP�M �xdj�)eۚ�CޚCXf:_�G1.M�{�?��{�!w����J)��V6w     