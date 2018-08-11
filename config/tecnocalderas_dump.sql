--
-- PostgreSQL database dump
--

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: actividades; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE actividades (
    id_act integer NOT NULL,
    nombre_act character varying(100) NOT NULL,
    descripcion character varying(500)
);


ALTER TABLE actividades OWNER TO postgres;

--
-- Name: actividades_id_act_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE actividades_id_act_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE actividades_id_act_seq OWNER TO postgres;

--
-- Name: actividades_id_act_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE actividades_id_act_seq OWNED BY actividades.id_act;


--
-- Name: alimentacion; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE alimentacion (
    id_alimentacion integer NOT NULL,
    nom_alim character varying(50) NOT NULL
);


ALTER TABLE alimentacion OWNER TO postgres;

--
-- Name: alimentacion_id_alimentacion_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE alimentacion_id_alimentacion_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE alimentacion_id_alimentacion_seq OWNER TO postgres;

--
-- Name: alimentacion_id_alimentacion_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE alimentacion_id_alimentacion_seq OWNED BY alimentacion.id_alimentacion;


--
-- Name: asignacion; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE asignacion (
    email character varying(100) NOT NULL,
    id_caldera integer NOT NULL
);


ALTER TABLE asignacion OWNER TO postgres;

--
-- Name: caldera; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE caldera (
    id_caldera integer NOT NULL,
    nombre_tipo character varying(50) NOT NULL,
    id_tipo integer NOT NULL,
    id_comuna integer NOT NULL,
    id_marca integer NOT NULL,
    id_inst numeric NOT NULL,
    id_alimentacion integer NOT NULL,
    nom_alim character varying(50) NOT NULL,
    ano numeric NOT NULL,
    pasos numeric,
    latitud character varying(256) NOT NULL,
    longitud character varying(256) NOT NULL,
    vertical boolean NOT NULL,
    seca boolean,
    pirotubular boolean,
    acuotubular boolean,
    igneotubular boolean
);


ALTER TABLE caldera OWNER TO postgres;

--
-- Name: caldera_id_caldera_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE caldera_id_caldera_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE caldera_id_caldera_seq OWNER TO postgres;

--
-- Name: caldera_id_caldera_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE caldera_id_caldera_seq OWNED BY caldera.id_caldera;


--
-- Name: comuna; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE comuna (
    id_comuna integer NOT NULL,
    nombre_comuna character varying(256) NOT NULL
);


ALTER TABLE comuna OWNER TO postgres;

--
-- Name: comuna_id_comuna_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE comuna_id_comuna_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE comuna_id_comuna_seq OWNER TO postgres;

--
-- Name: comuna_id_comuna_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE comuna_id_comuna_seq OWNED BY comuna.id_comuna;


--
-- Name: detalle_mantenciones; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE detalle_mantenciones (
    id_act integer NOT NULL,
    id_mantencion integer NOT NULL
);


ALTER TABLE detalle_mantenciones OWNER TO postgres;

--
-- Name: institucion; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE institucion (
    id_inst numeric NOT NULL,
    nom_inst character varying(256) NOT NULL,
    rut_inst character varying(30) NOT NULL,
    direccion character varying(256)
);


ALTER TABLE institucion OWNER TO postgres;

--
-- Name: mantenciones; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE mantenciones (
    id_mantencion integer NOT NULL,
    id_caldera integer NOT NULL,
    fecha_mant date NOT NULL
);


ALTER TABLE mantenciones OWNER TO postgres;

--
-- Name: mantenciones_id_mantencion_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE mantenciones_id_mantencion_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE mantenciones_id_mantencion_seq OWNER TO postgres;

--
-- Name: mantenciones_id_mantencion_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE mantenciones_id_mantencion_seq OWNED BY mantenciones.id_mantencion;


--
-- Name: marca; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE marca (
    nom_marca character varying(100) NOT NULL,
    id_marca integer NOT NULL
);


ALTER TABLE marca OWNER TO postgres;

--
-- Name: marca_id_marca_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE marca_id_marca_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE marca_id_marca_seq OWNER TO postgres;

--
-- Name: marca_id_marca_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE marca_id_marca_seq OWNED BY marca.id_marca;


--
-- Name: perfil; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE perfil (
    id_perfil numeric NOT NULL,
    nom_perfil character varying(25) NOT NULL
);


ALTER TABLE perfil OWNER TO postgres;

--
-- Name: tipo; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tipo (
    nombre_tipo character varying(50) NOT NULL,
    id_tipo integer NOT NULL,
    gal_hora character varying(10),
    libr_hora character varying(10),
    pasos numeric
);


ALTER TABLE tipo OWNER TO postgres;

--
-- Name: tipo_contacto; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tipo_contacto (
    id_cargo numeric NOT NULL,
    nombre_cargo character varying(100) NOT NULL
);


ALTER TABLE tipo_contacto OWNER TO postgres;

--
-- Name: tipo_id_tipo_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tipo_id_tipo_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE tipo_id_tipo_seq OWNER TO postgres;

--
-- Name: tipo_id_tipo_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tipo_id_tipo_seq OWNED BY tipo.id_tipo;


--
-- Name: usuario; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE usuario (
    rut character varying(9) NOT NULL,
    password character varying(512) NOT NULL,
    admin boolean NOT NULL,
    nombres character varying(100) NOT NULL,
    apellidos character varying(100) NOT NULL,
    email character varying(100) NOT NULL,
    id_inst numeric,
    id_cargo numeric,
    id_perfil numeric NOT NULL,
    celular character varying(12) NOT NULL,
    direccion character varying(256),
    id_usuario integer NOT NULL
);


ALTER TABLE usuario OWNER TO postgres;

--
-- Name: usuario_id_usuario_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE usuario_id_usuario_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE usuario_id_usuario_seq OWNER TO postgres;

--
-- Name: usuario_id_usuario_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE usuario_id_usuario_seq OWNED BY usuario.id_usuario;


--
-- Name: id_act; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY actividades ALTER COLUMN id_act SET DEFAULT nextval('actividades_id_act_seq'::regclass);


--
-- Name: id_alimentacion; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY alimentacion ALTER COLUMN id_alimentacion SET DEFAULT nextval('alimentacion_id_alimentacion_seq'::regclass);


--
-- Name: id_caldera; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY caldera ALTER COLUMN id_caldera SET DEFAULT nextval('caldera_id_caldera_seq'::regclass);


--
-- Name: id_comuna; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY comuna ALTER COLUMN id_comuna SET DEFAULT nextval('comuna_id_comuna_seq'::regclass);


--
-- Name: id_mantencion; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY mantenciones ALTER COLUMN id_mantencion SET DEFAULT nextval('mantenciones_id_mantencion_seq'::regclass);


--
-- Name: id_marca; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY marca ALTER COLUMN id_marca SET DEFAULT nextval('marca_id_marca_seq'::regclass);


--
-- Name: id_tipo; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tipo ALTER COLUMN id_tipo SET DEFAULT nextval('tipo_id_tipo_seq'::regclass);


--
-- Name: id_usuario; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY usuario ALTER COLUMN id_usuario SET DEFAULT nextval('usuario_id_usuario_seq'::regclass);


--
-- Data for Name: actividades; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY actividades (id_act, nombre_act, descripcion) FROM stdin;
\.


--
-- Name: actividades_id_act_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('actividades_id_act_seq', 1, false);


--
-- Data for Name: alimentacion; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY alimentacion (id_alimentacion, nom_alim) FROM stdin;
1	Aceite
2	Vapor
3	Agua
\.


--
-- Name: alimentacion_id_alimentacion_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('alimentacion_id_alimentacion_seq', 1, false);


--
-- Data for Name: asignacion; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY asignacion (email, id_caldera) FROM stdin;
\.


--
-- Data for Name: caldera; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY caldera (id_caldera, nombre_tipo, id_tipo, id_comuna, id_marca, id_inst, id_alimentacion, nom_alim, ano, pasos, latitud, longitud, vertical, seca, pirotubular, acuotubular, igneotubular) FROM stdin;
\.


--
-- Name: caldera_id_caldera_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('caldera_id_caldera_seq', 1, false);


--
-- Data for Name: comuna; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY comuna (id_comuna, nombre_comuna) FROM stdin;
2	Cauquenes
3	Chanco
4	Pelluhue
5	Curicó
6	Hualañe
7	Licantén
8	Molina
9	Romeral
10	Ranco
11	Sagrada Familia
12	Teno
13	Vichuquen
14	Linares
15	Colbún
16	Longaví
17	Parral
18	Retiro
19	San Javier
20	Villa Alegre
21	Yerbas Buenas
22	Talca
23	Constitución
24	Curepto
25	Empedrado
26	Maule
27	Pelarco
28	Pencahue
29	Rio Claro
30	San Clemente
31	San Rafael
\.


--
-- Name: comuna_id_comuna_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('comuna_id_comuna_seq', 31, true);


--
-- Data for Name: detalle_mantenciones; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY detalle_mantenciones (id_act, id_mantencion) FROM stdin;
\.


--
-- Data for Name: institucion; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY institucion (id_inst, nom_inst, rut_inst, direccion) FROM stdin;
1	Hospital	1111111	dir 1
\.


--
-- Data for Name: mantenciones; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY mantenciones (id_mantencion, id_caldera, fecha_mant) FROM stdin;
\.


--
-- Name: mantenciones_id_mantencion_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('mantenciones_id_mantencion_seq', 1, false);


--
-- Data for Name: marca; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY marca (nom_marca, id_marca) FROM stdin;
\.


--
-- Name: marca_id_marca_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('marca_id_marca_seq', 1, false);


--
-- Data for Name: perfil; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY perfil (id_perfil, nom_perfil) FROM stdin;
1	Tecnico
2	Cliente
\.


--
-- Data for Name: tipo; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tipo (nombre_tipo, id_tipo, gal_hora, libr_hora, pasos) FROM stdin;
\.


--
-- Data for Name: tipo_contacto; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tipo_contacto (id_cargo, nombre_cargo) FROM stdin;
1	Encargado Caldera
2	Encargado Finanzas
3	Encargado Caldera/Finanzas
\.


--
-- Name: tipo_id_tipo_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tipo_id_tipo_seq', 1, false);


--
-- Data for Name: usuario; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY usuario (rut, password, admin, nombres, apellidos, email, id_inst, id_cargo, id_perfil, celular, direccion, id_usuario) FROM stdin;
18475962	cliente	f	Vale	ac	cliente@cliente.cl	1	1	1	976106514	dir2	1
17684798	21232f297a57a5a743894a0e4a801fc3	t	cata	ac	admin@admin.cl	\N	\N	1	984692108	dir1	2
\.


--
-- Name: usuario_id_usuario_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('usuario_id_usuario_seq', 2, true);


--
-- Name: pk_actividades; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY actividades
    ADD CONSTRAINT pk_actividades PRIMARY KEY (id_act);


--
-- Name: pk_alimentacion; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY alimentacion
    ADD CONSTRAINT pk_alimentacion PRIMARY KEY (id_alimentacion, nom_alim);


--
-- Name: pk_asignacion; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY asignacion
    ADD CONSTRAINT pk_asignacion PRIMARY KEY (email, id_caldera);


--
-- Name: pk_caldera; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY caldera
    ADD CONSTRAINT pk_caldera PRIMARY KEY (id_caldera);


--
-- Name: pk_comuna; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY comuna
    ADD CONSTRAINT pk_comuna PRIMARY KEY (id_comuna);


--
-- Name: pk_detalle_mantenciones; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY detalle_mantenciones
    ADD CONSTRAINT pk_detalle_mantenciones PRIMARY KEY (id_act, id_mantencion);


--
-- Name: pk_institucion; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY institucion
    ADD CONSTRAINT pk_institucion PRIMARY KEY (id_inst);


--
-- Name: pk_mantenciones; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY mantenciones
    ADD CONSTRAINT pk_mantenciones PRIMARY KEY (id_mantencion);


--
-- Name: pk_marca; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY marca
    ADD CONSTRAINT pk_marca PRIMARY KEY (id_marca);


--
-- Name: pk_perfil; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY perfil
    ADD CONSTRAINT pk_perfil PRIMARY KEY (id_perfil);


--
-- Name: pk_tipo; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tipo
    ADD CONSTRAINT pk_tipo PRIMARY KEY (nombre_tipo, id_tipo);


--
-- Name: pk_tipo_contacto; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tipo_contacto
    ADD CONSTRAINT pk_tipo_contacto PRIMARY KEY (id_cargo);


--
-- Name: pk_usuario; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY usuario
    ADD CONSTRAINT pk_usuario PRIMARY KEY (email);


--
-- Name: actividades_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX actividades_pk ON actividades USING btree (id_act);


--
-- Name: alimentacion_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX alimentacion_pk ON alimentacion USING btree (id_alimentacion, nom_alim);


--
-- Name: caldera_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX caldera_pk ON caldera USING btree (id_caldera);


--
-- Name: comuna_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX comuna_pk ON comuna USING btree (id_comuna);


--
-- Name: detalle_mantenciones2_fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX detalle_mantenciones2_fk ON detalle_mantenciones USING btree (id_mantencion);


--
-- Name: detalle_mantenciones_fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX detalle_mantenciones_fk ON detalle_mantenciones USING btree (id_act);


--
-- Name: detalle_mantenciones_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX detalle_mantenciones_pk ON detalle_mantenciones USING btree (id_act, id_mantencion);


--
-- Name: es_alimentada_fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX es_alimentada_fk ON caldera USING btree (id_alimentacion, nom_alim);


--
-- Name: es_de_fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX es_de_fk ON caldera USING btree (id_marca);


--
-- Name: es_de_tipo_fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX es_de_tipo_fk ON caldera USING btree (nombre_tipo, id_tipo);


--
-- Name: es_de_una_fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX es_de_una_fk ON caldera USING btree (id_inst);


--
-- Name: esta_en_fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX esta_en_fk ON caldera USING btree (id_comuna);


--
-- Name: institucion_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX institucion_pk ON institucion USING btree (id_inst);


--
-- Name: mantenciones_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX mantenciones_pk ON mantenciones USING btree (id_mantencion);


--
-- Name: marca_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX marca_pk ON marca USING btree (id_marca);


--
-- Name: perfil_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX perfil_pk ON perfil USING btree (id_perfil);


--
-- Name: pertenece_a_fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX pertenece_a_fk ON usuario USING btree (id_inst);


--
-- Name: relationship_15_fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX relationship_15_fk ON usuario USING btree (id_cargo);


--
-- Name: ti_fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX ti_fk ON mantenciones USING btree (id_caldera);


--
-- Name: tiene_un_fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX tiene_un_fk ON usuario USING btree (id_perfil);


--
-- Name: tiene_una2_fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX tiene_una2_fk ON asignacion USING btree (id_caldera);


--
-- Name: tiene_una_fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX tiene_una_fk ON asignacion USING btree (email);


--
-- Name: tiene_una_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX tiene_una_pk ON asignacion USING btree (email, id_caldera);


--
-- Name: tipo_contacto_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX tipo_contacto_pk ON tipo_contacto USING btree (id_cargo);


--
-- Name: tipo_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX tipo_pk ON tipo USING btree (nombre_tipo, id_tipo);


--
-- Name: usuario_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX usuario_pk ON usuario USING btree (email);


--
-- Name: fk_asignaci_asignacio_caldera; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY asignacion
    ADD CONSTRAINT fk_asignaci_asignacio_caldera FOREIGN KEY (id_caldera) REFERENCES caldera(id_caldera) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_asignaci_asignacio_usuario; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY asignacion
    ADD CONSTRAINT fk_asignaci_asignacio_usuario FOREIGN KEY (email) REFERENCES usuario(email) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_caldera_es_alimen_alimenta; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY caldera
    ADD CONSTRAINT fk_caldera_es_alimen_alimenta FOREIGN KEY (id_alimentacion, nom_alim) REFERENCES alimentacion(id_alimentacion, nom_alim) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_caldera_es_de_tip_tipo; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY caldera
    ADD CONSTRAINT fk_caldera_es_de_tip_tipo FOREIGN KEY (nombre_tipo, id_tipo) REFERENCES tipo(nombre_tipo, id_tipo) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_caldera_es_de_una_instituc; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY caldera
    ADD CONSTRAINT fk_caldera_es_de_una_instituc FOREIGN KEY (id_inst) REFERENCES institucion(id_inst) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_caldera_esta_en_comuna; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY caldera
    ADD CONSTRAINT fk_caldera_esta_en_comuna FOREIGN KEY (id_comuna) REFERENCES comuna(id_comuna) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_caldera_tieneuna_marca; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY caldera
    ADD CONSTRAINT fk_caldera_tieneuna_marca FOREIGN KEY (id_marca) REFERENCES marca(id_marca) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_detalle__detalle_m_activida; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY detalle_mantenciones
    ADD CONSTRAINT fk_detalle__detalle_m_activida FOREIGN KEY (id_act) REFERENCES actividades(id_act) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_detalle__detalle_m_mantenci; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY detalle_mantenciones
    ADD CONSTRAINT fk_detalle__detalle_m_mantenci FOREIGN KEY (id_mantencion) REFERENCES mantenciones(id_mantencion) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_mantenci_ti_caldera; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY mantenciones
    ADD CONSTRAINT fk_mantenci_ti_caldera FOREIGN KEY (id_caldera) REFERENCES caldera(id_caldera) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_usuario_pertenece_instituc; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY usuario
    ADD CONSTRAINT fk_usuario_pertenece_instituc FOREIGN KEY (id_inst) REFERENCES institucion(id_inst) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_usuario_relations_tipo_con; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY usuario
    ADD CONSTRAINT fk_usuario_relations_tipo_con FOREIGN KEY (id_cargo) REFERENCES tipo_contacto(id_cargo) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_usuario_tiene_un_perfil; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY usuario
    ADD CONSTRAINT fk_usuario_tiene_un_perfil FOREIGN KEY (id_perfil) REFERENCES perfil(id_perfil) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- PostgreSQL database dump complete
--

