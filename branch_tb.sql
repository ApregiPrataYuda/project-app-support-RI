PGDMP      &            	    |            support_app_postgresql    16.3    16.4     �           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false            �           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false            �           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false            �           1262    34279    support_app_postgresql    DATABASE     �   CREATE DATABASE support_app_postgresql WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE_PROVIDER = libc LOCALE = 'English_United States.1252';
 &   DROP DATABASE support_app_postgresql;
                postgres    false            �            1259    34286 	   branch_tb    TABLE     R  CREATE TABLE public.branch_tb (
    id_branch integer NOT NULL,
    name_branch character varying(100) NOT NULL,
    name_alias character varying(100),
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    deleted_at timestamp without time zone
);
    DROP TABLE public.branch_tb;
       public         heap    postgres    false            �            1259    34291    branch_tb_id_branch_seq    SEQUENCE     �   CREATE SEQUENCE public.branch_tb_id_branch_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 .   DROP SEQUENCE public.branch_tb_id_branch_seq;
       public          postgres    false    217            �           0    0    branch_tb_id_branch_seq    SEQUENCE OWNED BY     S   ALTER SEQUENCE public.branch_tb_id_branch_seq OWNED BY public.branch_tb.id_branch;
          public          postgres    false    218            U           2604    34447    branch_tb id_branch    DEFAULT     z   ALTER TABLE ONLY public.branch_tb ALTER COLUMN id_branch SET DEFAULT nextval('public.branch_tb_id_branch_seq'::regclass);
 B   ALTER TABLE public.branch_tb ALTER COLUMN id_branch DROP DEFAULT;
       public          postgres    false    218    217            �          0    34286 	   branch_tb 
   TABLE DATA           k   COPY public.branch_tb (id_branch, name_branch, name_alias, created_at, updated_at, deleted_at) FROM stdin;
    public          postgres    false    217   *       �           0    0    branch_tb_id_branch_seq    SEQUENCE SET     E   SELECT pg_catalog.setval('public.branch_tb_id_branch_seq', 3, true);
          public          postgres    false    218            Y           2606    34466    branch_tb branch_tb_pkey 
   CONSTRAINT     ]   ALTER TABLE ONLY public.branch_tb
    ADD CONSTRAINT branch_tb_pkey PRIMARY KEY (id_branch);
 B   ALTER TABLE ONLY public.branch_tb DROP CONSTRAINT branch_tb_pkey;
       public            postgres    false    217            �   X   x�3�t��p�t�4202�5��52U0��2��26ӳ0�4�0�'��e����������D�)Ɯ��.
�nn�ή������� n	*�     