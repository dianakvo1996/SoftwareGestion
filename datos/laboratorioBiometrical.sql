--
-- PostgreSQL database dump
--

-- Dumped from database version 10.8
-- Dumped by pg_dump version 10.8

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: -
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: -
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: archivoextra; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.archivoextra (
    ide integer NOT NULL,
    nombre character varying(100) NOT NULL,
    archivo character varying(100) NOT NULL,
    tipo character varying(2) NOT NULL
);


--
-- Name: archivoextra_ide_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.archivoextra_ide_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: archivoextra_ide_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.archivoextra_ide_seq OWNED BY public.archivoextra.ide;


--
-- Name: archivosproceso; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.archivosproceso (
    codigo integer NOT NULL,
    nombre character varying(100) NOT NULL,
    ruta character varying(100) NOT NULL,
    tipo character varying(5) NOT NULL,
    ideproceso integer NOT NULL
);


--
-- Name: archivosproceso_codigo_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.archivosproceso_codigo_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: archivosproceso_codigo_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.archivosproceso_codigo_seq OWNED BY public.archivosproceso.codigo;


--
-- Name: caracterizacionproceso; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.caracterizacionproceso (
    codigo integer NOT NULL,
    nombre character varying(100) NOT NULL,
    ruta character varying(100) NOT NULL,
    tipo character varying(10) NOT NULL,
    ideproceso integer NOT NULL
);


--
-- Name: caracterizacionproceso_codigo_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.caracterizacionproceso_codigo_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: caracterizacionproceso_codigo_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.caracterizacionproceso_codigo_seq OWNED BY public.caracterizacionproceso.codigo;


--
-- Name: cliente; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.cliente (
    nit character varying(15) NOT NULL,
    nombre character varying(100) NOT NULL,
    direccion character varying(100) NOT NULL,
    responsable character varying(100) NOT NULL,
    telefono character varying(15) NOT NULL,
    sede character varying(2) NOT NULL,
    usuario character varying(100) NOT NULL
);


--
-- Name: cronograma; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.cronograma (
    ide integer NOT NULL,
    idesede integer,
    nitcliente character varying(15),
    mes integer NOT NULL,
    perioricidad integer NOT NULL
);


--
-- Name: cronograma_ide_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.cronograma_ide_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: cronograma_ide_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.cronograma_ide_seq OWNED BY public.cronograma.ide;


--
-- Name: datosnumeroreporte; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.datosnumeroreporte (
    ide integer NOT NULL,
    anioactual character varying(2) NOT NULL
);


--
-- Name: datosnumeroreporte_ide_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.datosnumeroreporte_ide_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: datosnumeroreporte_ide_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.datosnumeroreporte_ide_seq OWNED BY public.datosnumeroreporte.ide;


--
-- Name: equipo; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.equipo (
    ide integer NOT NULL,
    marca character varying(100) NOT NULL,
    modelo character varying(100) NOT NULL,
    serial character varying(100) NOT NULL,
    activofijo character varying(100) NOT NULL,
    ubicacion character varying(100) NOT NULL,
    idesede integer,
    nitcliente character varying(15),
    nombreequipo character varying(200) NOT NULL
);


--
-- Name: equipo_ide_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.equipo_ide_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: equipo_ide_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.equipo_ide_seq OWNED BY public.equipo.ide;


--
-- Name: equipodebaja; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.equipodebaja (
    ide integer NOT NULL,
    nombreequipo character varying(100) NOT NULL,
    marca character varying(100) NOT NULL,
    modelo character varying(100) NOT NULL,
    serial character varying(100) NOT NULL,
    activofijo character varying(100) NOT NULL,
    ubicacion character varying(100) NOT NULL,
    fecharealizacion timestamp without time zone NOT NULL,
    idesede integer,
    nitcliente character varying(15),
    justificacion character varying(1000) NOT NULL,
    fechasistema timestamp without time zone NOT NULL
);


--
-- Name: equipodebaja_ide_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.equipodebaja_ide_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: equipodebaja_ide_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.equipodebaja_ide_seq OWNED BY public.equipodebaja.ide;


--
-- Name: formatosproceso; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.formatosproceso (
    codigo integer NOT NULL,
    nombre character varying(100) NOT NULL,
    ruta character varying(100) NOT NULL,
    tipo character varying(5) NOT NULL,
    ideopcionesproceso integer NOT NULL
);


--
-- Name: formatosproceso_codigo_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.formatosproceso_codigo_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: formatosproceso_codigo_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.formatosproceso_codigo_seq OWNED BY public.formatosproceso.codigo;


--
-- Name: guiasproceso; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.guiasproceso (
    codigo integer NOT NULL,
    nombre character varying(100) NOT NULL,
    ruta character varying(100) NOT NULL,
    tipo character varying(5) NOT NULL,
    ideopcionesproceso integer NOT NULL
);


--
-- Name: guiasproceso_codigo_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.guiasproceso_codigo_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: guiasproceso_codigo_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.guiasproceso_codigo_seq OWNED BY public.guiasproceso.codigo;


--
-- Name: instructivosproceso; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.instructivosproceso (
    codigo integer NOT NULL,
    nombre character varying(100) NOT NULL,
    ruta character varying(100) NOT NULL,
    tipo character varying(5) NOT NULL,
    ideopcionesproceso integer NOT NULL
);


--
-- Name: instructivosproceso_codigo_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.instructivosproceso_codigo_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: instructivosproceso_codigo_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.instructivosproceso_codigo_seq OWNED BY public.instructivosproceso.codigo;


--
-- Name: mantenimientopreventivo; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.mantenimientopreventivo (
    ide integer NOT NULL,
    fecha timestamp without time zone NOT NULL,
    nitcliente character varying(15),
    idesede integer
);


--
-- Name: mantenimientopreventivo_ide_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.mantenimientopreventivo_ide_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: mantenimientopreventivo_ide_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.mantenimientopreventivo_ide_seq OWNED BY public.mantenimientopreventivo.ide;


--
-- Name: manualesproceso; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.manualesproceso (
    codigo integer NOT NULL,
    nombre character varying(100) NOT NULL,
    ruta character varying(100) NOT NULL,
    tipo character varying(10) NOT NULL,
    ideopcionesproceso integer NOT NULL
);


--
-- Name: manualesproceso_codigo_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.manualesproceso_codigo_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: manualesproceso_codigo_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.manualesproceso_codigo_seq OWNED BY public.manualesproceso.codigo;


--
-- Name: membrete; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.membrete (
    codigo integer NOT NULL,
    nombre character varying(100) NOT NULL,
    archivo character varying(100) NOT NULL,
    tipo character varying(5) NOT NULL
);


--
-- Name: membrete_codigo_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.membrete_codigo_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: membrete_codigo_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.membrete_codigo_seq OWNED BY public.membrete.codigo;


--
-- Name: mes; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.mes (
    ide integer NOT NULL,
    nombre character varying(100) NOT NULL
);


--
-- Name: mes_ide_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.mes_ide_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: mes_ide_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.mes_ide_seq OWNED BY public.mes.ide;


--
-- Name: opcionesproceso; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.opcionesproceso (
    ide integer NOT NULL,
    nombre character varying(100) NOT NULL,
    ideproceso integer
);


--
-- Name: opcionesproceso_ide_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.opcionesproceso_ide_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: opcionesproceso_ide_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.opcionesproceso_ide_seq OWNED BY public.opcionesproceso.ide;


--
-- Name: permiso; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.permiso (
    ide integer NOT NULL,
    usuario character varying(100) NOT NULL,
    ideproceso integer NOT NULL,
    permiso character varying(2) NOT NULL
);


--
-- Name: permiso_ide_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.permiso_ide_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: permiso_ide_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.permiso_ide_seq OWNED BY public.permiso.ide;


--
-- Name: persona; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.persona (
    identificacion character varying(15) NOT NULL,
    nombres character varying(100) NOT NULL,
    apellidos character varying(100) NOT NULL,
    cargo character varying(100) NOT NULL,
    usuario character varying(100) NOT NULL
);


--
-- Name: politicaoperativaproceso; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.politicaoperativaproceso (
    codigo integer NOT NULL,
    nombre character varying(100) NOT NULL,
    ruta character varying(100) NOT NULL,
    tipo character varying(10) NOT NULL,
    ideproceso integer NOT NULL
);


--
-- Name: politicaoperativaproceso_codigo_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.politicaoperativaproceso_codigo_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: politicaoperativaproceso_codigo_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.politicaoperativaproceso_codigo_seq OWNED BY public.politicaoperativaproceso.codigo;


--
-- Name: presentacion; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.presentacion (
    codigo integer NOT NULL,
    nombre character varying(100),
    presentacion character varying(100)
);


--
-- Name: presentacion_codigo_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.presentacion_codigo_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: presentacion_codigo_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.presentacion_codigo_seq OWNED BY public.presentacion.codigo;


--
-- Name: procedimientosproceso; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.procedimientosproceso (
    codigo integer NOT NULL,
    nombre character varying(100) NOT NULL,
    ruta character varying(100) NOT NULL,
    tipo character varying(5) NOT NULL,
    ideopcionesproceso integer NOT NULL
);


--
-- Name: procedimientosproceso_codigo_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.procedimientosproceso_codigo_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: procedimientosproceso_codigo_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.procedimientosproceso_codigo_seq OWNED BY public.procedimientosproceso.codigo;


--
-- Name: proceso; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.proceso (
    ide integer NOT NULL,
    nombre character varying(100) NOT NULL,
    imagen character varying(100) NOT NULL
);


--
-- Name: proceso_ide_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.proceso_ide_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: proceso_ide_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.proceso_ide_seq OWNED BY public.proceso.ide;


--
-- Name: protocolosproceso; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.protocolosproceso (
    codigo integer NOT NULL,
    nombre character varying(100) NOT NULL,
    ruta character varying(100) NOT NULL,
    tipo character varying(5) NOT NULL,
    ideopcionesproceso integer NOT NULL
);


--
-- Name: protocolosproceso_codigo_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.protocolosproceso_codigo_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: protocolosproceso_codigo_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.protocolosproceso_codigo_seq OWNED BY public.protocolosproceso.codigo;


--
-- Name: registroactividad; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.registroactividad (
    ide integer NOT NULL,
    tabla character varying(100) NOT NULL,
    accion character varying(20) NOT NULL,
    registroanterior character varying(3000),
    registronuevo character varying(3000),
    usuario character varying(100) NOT NULL,
    fecharealizacion timestamp without time zone NOT NULL,
    ideproceso integer,
    ideopcion integer
);


--
-- Name: registroactividad_ide_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.registroactividad_ide_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: registroactividad_ide_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.registroactividad_ide_seq OWNED BY public.registroactividad.ide;


--
-- Name: reportecorrectivo; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.reportecorrectivo (
    numeroreporte character varying(20) NOT NULL,
    consecutivo integer NOT NULL,
    ciudad character varying(200) NOT NULL,
    tipofalla character varying(5) NOT NULL,
    otrafalla character varying(100),
    idepersona character varying(15) NOT NULL,
    ideequipo integer NOT NULL,
    problemapresentado character varying(500),
    funcionamiento character varying(2) NOT NULL,
    observaciones character varying(100),
    aspectofisico character varying(2) NOT NULL,
    condicionambiental character varying(2) NOT NULL,
    limpiezainterna character varying(2) NOT NULL,
    limpiezaexterna character varying(2) NOT NULL,
    pruebasfuncionamiento character varying(2) NOT NULL,
    lubricacionpartes character varying(2) NOT NULL,
    pruebainicial character varying(2) NOT NULL,
    sistemaelectronico character varying(2) NOT NULL,
    sistemahidraulico character varying(2) NOT NULL,
    sistemaneumatico character varying(2) NOT NULL,
    sistemamecanico character varying(2) NOT NULL,
    sistemaelectrico character varying(2) NOT NULL,
    sistemaoptico character varying(2) NOT NULL,
    sistemaoperativo character varying(2) NOT NULL,
    sistemaelectromecanico character varying(2) NOT NULL,
    sistemavapor character varying(2) NOT NULL,
    fecha timestamp without time zone NOT NULL
);


--
-- Name: reportecorrectivo_consecutivo_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.reportecorrectivo_consecutivo_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: reportecorrectivo_consecutivo_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.reportecorrectivo_consecutivo_seq OWNED BY public.reportecorrectivo.consecutivo;


--
-- Name: reportepreventivo; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.reportepreventivo (
    numeroreporte character varying(20) NOT NULL,
    consecutivo integer NOT NULL,
    ciudad character varying(200) NOT NULL,
    tipofalla character varying(5) NOT NULL,
    otrafalla character varying(100),
    idepersona character varying(15) NOT NULL,
    idemantenimientopreventivo integer NOT NULL,
    ideequipo integer NOT NULL,
    problemapresentado character varying(500),
    funcionamiento character varying(2) NOT NULL,
    observaciones character varying(100),
    aspectofisico character varying(2) NOT NULL,
    condicionambiental character varying(2) NOT NULL,
    limpiezainterna character varying(2) NOT NULL,
    limpiezaexterna character varying(2) NOT NULL,
    pruebasfuncionamiento character varying(2) NOT NULL,
    lubricacionpartes character varying(2) NOT NULL,
    pruebainicial character varying(2) NOT NULL,
    sistemaelectronico character varying(2) NOT NULL,
    sistemahidraulico character varying(2) NOT NULL,
    sistemaneumatico character varying(2) NOT NULL,
    sistemamecanico character varying(2) NOT NULL,
    sistemaelectrico character varying(2) NOT NULL,
    sistemaoptico character varying(2) NOT NULL,
    sistemaoperativo character varying(2) NOT NULL,
    sistemaelectromecanico character varying(2) NOT NULL,
    sistemavapor character varying(2) NOT NULL,
    fecha timestamp without time zone NOT NULL
);


--
-- Name: reportepreventivo_consecutivo_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.reportepreventivo_consecutivo_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: reportepreventivo_consecutivo_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.reportepreventivo_consecutivo_seq OWNED BY public.reportepreventivo.consecutivo;


--
-- Name: repuesto; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.repuesto (
    ide integer NOT NULL,
    detalle character varying(300) NOT NULL,
    referencia character varying(300) NOT NULL,
    cantidad integer NOT NULL,
    numeroreporte character varying(20) NOT NULL
);


--
-- Name: repuesto_ide_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.repuesto_ide_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: repuesto_ide_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.repuesto_ide_seq OWNED BY public.repuesto.ide;


--
-- Name: rutinaequipo; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.rutinaequipo (
    ide integer NOT NULL,
    descripcion character varying(1000) NOT NULL,
    idetipoequipo integer NOT NULL
);


--
-- Name: rutinaequipo_ide_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.rutinaequipo_ide_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: rutinaequipo_ide_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.rutinaequipo_ide_seq OWNED BY public.rutinaequipo.ide;


--
-- Name: sede; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.sede (
    ide integer NOT NULL,
    nombre character varying(100) NOT NULL,
    nitcliente character varying(15) NOT NULL
);


--
-- Name: sede_ide_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.sede_ide_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: sede_ide_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.sede_ide_seq OWNED BY public.sede.ide;


--
-- Name: submenuproceso; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.submenuproceso (
    ide integer NOT NULL,
    ideopcion integer NOT NULL,
    menu character varying(3) NOT NULL
);


--
-- Name: submenuproceso_ide_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.submenuproceso_ide_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: submenuproceso_ide_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.submenuproceso_ide_seq OWNED BY public.submenuproceso.ide;


--
-- Name: tipoequipo; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.tipoequipo (
    ide integer NOT NULL,
    nombre character varying(200) NOT NULL,
    calibrable character varying(1) NOT NULL,
    rutina character varying(1000),
    tipo character varying(3) NOT NULL,
    otro character varying(100)
);


--
-- Name: tipoequipo_ide_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.tipoequipo_ide_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: tipoequipo_ide_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.tipoequipo_ide_seq OWNED BY public.tipoequipo.ide;


--
-- Name: unidadmedida; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.unidadmedida (
    ide integer NOT NULL,
    unidad character varying(100) NOT NULL,
    simbolo character varying(50) NOT NULL
);


--
-- Name: unidadmedida_ide_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.unidadmedida_ide_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: unidadmedida_ide_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.unidadmedida_ide_seq OWNED BY public.unidadmedida.ide;


--
-- Name: usuario; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.usuario (
    usuario character varying(100) NOT NULL,
    clave character varying(50) NOT NULL,
    tipo character varying(1) NOT NULL
);


--
-- Name: verificacionmetrologica; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.verificacionmetrologica (
    ide integer NOT NULL,
    valornominal double precision NOT NULL,
    valormedido double precision NOT NULL,
    ideunidadmedida integer NOT NULL,
    numeroreporte character varying(20) NOT NULL
);


--
-- Name: verificacionmetrologica_ide_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.verificacionmetrologica_ide_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: verificacionmetrologica_ide_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.verificacionmetrologica_ide_seq OWNED BY public.verificacionmetrologica.ide;


--
-- Name: archivoextra ide; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.archivoextra ALTER COLUMN ide SET DEFAULT nextval('public.archivoextra_ide_seq'::regclass);


--
-- Name: archivosproceso codigo; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.archivosproceso ALTER COLUMN codigo SET DEFAULT nextval('public.archivosproceso_codigo_seq'::regclass);


--
-- Name: caracterizacionproceso codigo; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.caracterizacionproceso ALTER COLUMN codigo SET DEFAULT nextval('public.caracterizacionproceso_codigo_seq'::regclass);


--
-- Name: cronograma ide; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.cronograma ALTER COLUMN ide SET DEFAULT nextval('public.cronograma_ide_seq'::regclass);


--
-- Name: datosnumeroreporte ide; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.datosnumeroreporte ALTER COLUMN ide SET DEFAULT nextval('public.datosnumeroreporte_ide_seq'::regclass);


--
-- Name: equipo ide; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.equipo ALTER COLUMN ide SET DEFAULT nextval('public.equipo_ide_seq'::regclass);


--
-- Name: equipodebaja ide; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.equipodebaja ALTER COLUMN ide SET DEFAULT nextval('public.equipodebaja_ide_seq'::regclass);


--
-- Name: formatosproceso codigo; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.formatosproceso ALTER COLUMN codigo SET DEFAULT nextval('public.formatosproceso_codigo_seq'::regclass);


--
-- Name: guiasproceso codigo; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.guiasproceso ALTER COLUMN codigo SET DEFAULT nextval('public.guiasproceso_codigo_seq'::regclass);


--
-- Name: instructivosproceso codigo; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.instructivosproceso ALTER COLUMN codigo SET DEFAULT nextval('public.instructivosproceso_codigo_seq'::regclass);


--
-- Name: mantenimientopreventivo ide; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.mantenimientopreventivo ALTER COLUMN ide SET DEFAULT nextval('public.mantenimientopreventivo_ide_seq'::regclass);


--
-- Name: manualesproceso codigo; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.manualesproceso ALTER COLUMN codigo SET DEFAULT nextval('public.manualesproceso_codigo_seq'::regclass);


--
-- Name: membrete codigo; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.membrete ALTER COLUMN codigo SET DEFAULT nextval('public.membrete_codigo_seq'::regclass);


--
-- Name: mes ide; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.mes ALTER COLUMN ide SET DEFAULT nextval('public.mes_ide_seq'::regclass);


--
-- Name: opcionesproceso ide; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.opcionesproceso ALTER COLUMN ide SET DEFAULT nextval('public.opcionesproceso_ide_seq'::regclass);


--
-- Name: permiso ide; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.permiso ALTER COLUMN ide SET DEFAULT nextval('public.permiso_ide_seq'::regclass);


--
-- Name: politicaoperativaproceso codigo; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.politicaoperativaproceso ALTER COLUMN codigo SET DEFAULT nextval('public.politicaoperativaproceso_codigo_seq'::regclass);


--
-- Name: presentacion codigo; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.presentacion ALTER COLUMN codigo SET DEFAULT nextval('public.presentacion_codigo_seq'::regclass);


--
-- Name: procedimientosproceso codigo; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.procedimientosproceso ALTER COLUMN codigo SET DEFAULT nextval('public.procedimientosproceso_codigo_seq'::regclass);


--
-- Name: proceso ide; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.proceso ALTER COLUMN ide SET DEFAULT nextval('public.proceso_ide_seq'::regclass);


--
-- Name: protocolosproceso codigo; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.protocolosproceso ALTER COLUMN codigo SET DEFAULT nextval('public.protocolosproceso_codigo_seq'::regclass);


--
-- Name: registroactividad ide; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.registroactividad ALTER COLUMN ide SET DEFAULT nextval('public.registroactividad_ide_seq'::regclass);


--
-- Name: reportecorrectivo consecutivo; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.reportecorrectivo ALTER COLUMN consecutivo SET DEFAULT nextval('public.reportecorrectivo_consecutivo_seq'::regclass);


--
-- Name: reportepreventivo consecutivo; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.reportepreventivo ALTER COLUMN consecutivo SET DEFAULT nextval('public.reportepreventivo_consecutivo_seq'::regclass);


--
-- Name: repuesto ide; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.repuesto ALTER COLUMN ide SET DEFAULT nextval('public.repuesto_ide_seq'::regclass);


--
-- Name: rutinaequipo ide; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.rutinaequipo ALTER COLUMN ide SET DEFAULT nextval('public.rutinaequipo_ide_seq'::regclass);


--
-- Name: sede ide; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.sede ALTER COLUMN ide SET DEFAULT nextval('public.sede_ide_seq'::regclass);


--
-- Name: submenuproceso ide; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.submenuproceso ALTER COLUMN ide SET DEFAULT nextval('public.submenuproceso_ide_seq'::regclass);


--
-- Name: tipoequipo ide; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.tipoequipo ALTER COLUMN ide SET DEFAULT nextval('public.tipoequipo_ide_seq'::regclass);


--
-- Name: unidadmedida ide; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.unidadmedida ALTER COLUMN ide SET DEFAULT nextval('public.unidadmedida_ide_seq'::regclass);


--
-- Name: verificacionmetrologica ide; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.verificacionmetrologica ALTER COLUMN ide SET DEFAULT nextval('public.verificacionmetrologica_ide_seq'::regclass);


--
-- Data for Name: archivoextra; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.archivoextra (ide, nombre, archivo, tipo) FROM stdin;
1	Plataforma Estrategica	Plataforma_Estrategica.pdf	PE
5	CLIENTES Y PARTES INTERESADAS	CLIENTES Y PARTES INTERESADAS.pdf	CI
6	Piramide_Documental - 2	Piramide_Documental - 2.pdf	PD
3	Rese¤a_Historica	HISTORICA.pdf	RH
4	DIRECCIONAMIENTO ESTRATEGICO	DIRECCIONAMIENTO ESTRATEGICO.pdf	DE
2	GESTION DE CALIDAD	GESTION DE CALIDAD.pdf	GC
\.


--
-- Data for Name: archivosproceso; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.archivosproceso (codigo, nombre, ruta, tipo, ideproceso) FROM stdin;
5	Humanizacion	HUMANIZACIÓN.pdf	pdf	5
1	Liderazgo	LIDERAZGO.pdf	pdf	1
2	Evaluación y control	EVALUACION Y CONTROL.pdf	pdf	2
3	MEJORA CONTINUA	MEJORA CONTINUA.pdf	pdf	3
4	Enfoque en procesos	ENFOQUE EN PROCESOS.pdf	pdf	4
\.


--
-- Data for Name: caracterizacionproceso; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.caracterizacionproceso (codigo, nombre, ruta, tipo, ideproceso) FROM stdin;
1	CARACTERIZACION DEL PROCESO	CARACTERIZACION DEL PROCESO.pdf	pdf	6
2	CARACTERIZACION DEL PROCESO	CARACTERIZACION DEL PROCESO.pdf	pdf	7
3	CARACTERIZACION DEL PROCESO	CARACTERIZACION DEL PROCESO.pdf	pdf	8
4	CARACTERIZACION DEL PROCESO	CARACTERIZACION DEL PROCESO.pdf	pdf	9
5	CARACTERIZACION DEL PROCESO	CARACTERIZACION DEL PROCESO.pdf	pdf	10
7	CARACTERIZACION DEL PROCESO	CARACTERIZACION DEL PROCESO.pdf	pdf	12
8	CARACTERIZACION DEL PROCESO	CARACTERIZACION DEL PROCESO.pdf	pdf	13
9	CARACTERIZACION DEL PROCESO	CARACTERIZACION DEL PROCESO.pdf	pdf	14
10	CARACTERIZACION DEL PROCESO	CARACTERIZACION DEL PROCESO.pdf	pdf	15
6	CARACTERIZACIÓN DEL PROCESO	CARACTERIZACION DEL PROCESO.pdf	pdf	11
\.


--
-- Data for Name: cliente; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.cliente (nit, nombre, direccion, responsable, telefono, sede, usuario) FROM stdin;
789456123321456	Politica	Carrera 35 NO. 15-34	Maria Perez	3174331197	S	Politica
108524698	Odontopilar	Carrera 40 # 19-00	Ana Perez	0327458759	N	Odontopilar
\.


--
-- Data for Name: cronograma; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.cronograma (ide, idesede, nitcliente, mes, perioricidad) FROM stdin;
15	\N	108524698	2	4
16	14	\N	1	3
17	15	\N	2	2
\.


--
-- Data for Name: datosnumeroreporte; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.datosnumeroreporte (ide, anioactual) FROM stdin;
1	19
\.


--
-- Data for Name: equipo; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.equipo (ide, marca, modelo, serial, activofijo, ubicacion, idesede, nitcliente, nombreequipo) FROM stdin;
133	LITTMANN	 NO REGISTRA	 I1NI3572	 0403367	CONSULTORIO MEDICO 3	\N	108524698	FONENDOSCOPIO
144	SOEHNLE	 61317	 NO REGISTRA	 0402467	CONSULTORIO MEDICO 1	\N	108524698	BASCULA MECANICA
145	DETECTO	 ACS-20B-YE	 BD10021753	 0403960	CONSULTORIO MEDICO 8	\N	108524698	BASCULA NEONATAL
146	SCHULZ	 MSV-6	 2564389	 041747	CUARTO DE COMPRESORES	\N	108524698	COMPRESOR DE AIRE
147	WELCH ALLYN	 NO REGISTRA	 NO REGISTRA	 0402474	CONSULTORIO MEDICO 2	\N	108524698	EQUIPO DE ORGANOS
148	LITTMANN	 NO REGISTRA	 I1NI3572	 0403367	CONSULTORIO MEDICO 3	\N	108524698	FONENDOSCOPIO
149	PRODIGY	 AUTOCODE	 51850-02319I8	 NO REGISTRA	CONSULTORIO MEDICO 4	\N	108524698	GLUCOMETRO
150	PRODIGY	 AUTOCODE	 51850-0425718	 NO REGISTRA	ENFERMERIA	\N	108524698	GLUCOMETRO
151	ESTANDAR	 2011	 NO REGISTRA	 0402598	CONSULTORIO MEDICO 5	\N	108524698	LAMPARA CUELLO DE CISNE
152	NO REGISTRA	 NO REGISTRA	 NO REGISTRA	 0404270	CONSULTORIO MEDICO 6	\N	108524698	NEGATOSCOPIO
153	KRAMER	 NO REGISTRA	 NO REGISTRA	 0402598	CONSULTORIO MEDICO 7	\N	108524698	NEGATOSCOPIO
154	NSK	 PANA AIR II	 CB060798	 NO REGISTRA	ODONTOLOGIA 1	\N	108524698	PIEZA DE ALTA VELOCIDAD
155	NSK	 NO REGISTRA	 EX630K1004009	 NO REGISTRA	ODONTOLOGIA 1	\N	108524698	PUNTA RECTA
156	WELCH ALLYN	 OSZ-4	 7052-33/201225405	 0403393	CONSULTORIO MEDICO 10	\N	108524698	TENSIOMETRO DIGITAL
157	WELCH ALLYN	 C60297	 70830105113	 0402466	CONSULTORIO MEDICO 9	\N	108524698	TENSIOMETRO RUEDAS
158	HEALTH O METER	 160KG	 1620001823	 0404037	CONSULTORIO MEDICO 11	\N	108524698	BASCULA
159	NO REGISTRA	NO REGISTRA	NO REGISTRA	NO REGISTRA	CONSULTORIO MEDICO 1	\N	108524698	AGITADOR DE MAZINI
160	NO REGISTRA	NO REGISTRA	NO REGISTRA	NO REGISTRA	CONSULTORIO MEDICO 2	15	\N	AMALGAMADOR
\.


--
-- Data for Name: equipodebaja; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.equipodebaja (ide, nombreequipo, marca, modelo, serial, activofijo, ubicacion, fecharealizacion, idesede, nitcliente, justificacion, fechasistema) FROM stdin;
\.


--
-- Data for Name: formatosproceso; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.formatosproceso (codigo, nombre, ruta, tipo, ideopcionesproceso) FROM stdin;
\.


--
-- Data for Name: guiasproceso; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.guiasproceso (codigo, nombre, ruta, tipo, ideopcionesproceso) FROM stdin;
\.


--
-- Data for Name: instructivosproceso; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.instructivosproceso (codigo, nombre, ruta, tipo, ideopcionesproceso) FROM stdin;
\.


--
-- Data for Name: mantenimientopreventivo; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.mantenimientopreventivo (ide, fecha, nitcliente, idesede) FROM stdin;
25	2019-04-09 00:00:00	108524698	\N
26	2019-10-08 00:00:00	108524698	\N
27	2019-10-16 00:00:00	\N	14
28	2019-10-01 00:00:00	\N	15
\.


--
-- Data for Name: manualesproceso; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.manualesproceso (codigo, nombre, ruta, tipo, ideopcionesproceso) FROM stdin;
\.


--
-- Data for Name: membrete; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.membrete (codigo, nombre, archivo, tipo) FROM stdin;
5	LOGO_BIOMETRICAL	LOGO_BIOMETRICAL.jpg	jpg
\.


--
-- Data for Name: mes; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.mes (ide, nombre) FROM stdin;
1	Enero
2	Febrero
3	Marzo
4	Abril
5	Mayo
6	Junio
7	Julio
8	Agosto
9	Septiembre
10	Octubre
11	Noviembre
12	Diciembre
\.


--
-- Data for Name: opcionesproceso; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.opcionesproceso (ide, nombre, ideproceso) FROM stdin;
6	Subproceso 1	11
8	prueba	12
\.


--
-- Data for Name: permiso; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.permiso (ide, usuario, ideproceso, permiso) FROM stdin;
61	otro.otro	1	SL
73	otro.otro	13	SL
62	otro.otro	2	SL
63	otro.otro	3	SL
64	otro.otro	4	SL
65	otro.otro	5	SL
66	otro.otro	6	SL
67	otro.otro	7	SL
68	otro.otro	8	SL
69	otro.otro	9	SL
70	otro.otro	10	SL
71	otro.otro	11	SL
72	otro.otro	12	SL
74	otro.otro	14	SL
75	otro.otro	15	SL
\.


--
-- Data for Name: persona; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.persona (identificacion, nombres, apellidos, cargo, usuario) FROM stdin;
123456789	admin	admin	admin	admin
147896325	Otro	Otro	Otro	otro.otro
1084226940	Diana Karolina	Valencia Ordoñez	Pasante	diana.valencia
\.


--
-- Data for Name: politicaoperativaproceso; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.politicaoperativaproceso (codigo, nombre, ruta, tipo, ideproceso) FROM stdin;
1	POLITICA OPERATIVA	POLITICA OPERATIVA.pdf	pdf	6
2	POLITICA OPERATIVA	POLITICA OPERATIVA.pdf	pdf	7
3	POLITICA OPERATIVA	POLITICA OPERATIVA.pdf	pdf	8
4	POLITICA OPERATIVA	POLITICA OPERATIVA.pdf	pdf	9
5	POLITICA OPERATIVA	POLITICA OPERATIVA.pdf	pdf	10
7	POLITICA OPERATIVA	POLITICA OPERATIVA.pdf	pdf	12
8	POLITICA OPERATIVA	POLITICA OPERATIVA.pdf	pdf	13
9	POLITICA OPERATIVA	POLITICA OPERATIVA.pdf	pdf	14
10	POLITICA OPERATIVA	POLITICA OPERATIVA.pdf	pdf	15
6	POLÍTICA OPERATIVA	POLITICA OPERATIVA.pdf	pdf	11
\.


--
-- Data for Name: presentacion; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.presentacion (codigo, nombre, presentacion) FROM stdin;
\.


--
-- Data for Name: procedimientosproceso; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.procedimientosproceso (codigo, nombre, ruta, tipo, ideopcionesproceso) FROM stdin;
5	PRO	constancia_TituladaPresencial.pdf	pdf	6
6	prueba	EVALUACION Y CONTROL.pdf	pdf	8
\.


--
-- Data for Name: proceso; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.proceso (ide, nombre, imagen) FROM stdin;
1	Liderazgo	Liderazgo.png
2	Evaluacion y Control	EvaluacionControl.png
3	Mejora Continua	MejoraContinua.png
4	Enfoque en Procesos	EnfoqueProcesos.png
5	Humanizacion	Humanizacion.png
6	Gestion Estrategica	GestionEstrategica.png
7	Gestion de Calidad	GestionCalidad.png
8	Seguridad y Salud en el Trabajo	SeguridadSalud.png
9	Atencion al Cliente	AtencionCliente.png
11	Apoyo Logistico	ApoyoLogistico.png
12	Talento Humano	TalentoHumano.png
13	Comercial	Comercial.png
14	Calibracion	Calibracion.png
15	Mantenimiento	Mantenimiento.png
10	Gestion Financiera	GestionFinanciera.png
\.


--
-- Data for Name: protocolosproceso; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.protocolosproceso (codigo, nombre, ruta, tipo, ideopcionesproceso) FROM stdin;
\.


--
-- Data for Name: registroactividad; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.registroactividad (ide, tabla, accion, registroanterior, registronuevo, usuario, fecharealizacion, ideproceso, ideopcion) FROM stdin;
33	Subproceso	Eliminar	formato prueba, y todas las opciones	\N	admin	2019-07-16 11:27:46	11	4
34	Procedimiento	Eliminar	3698:CARACTERIZACION DEL PROCESO.pdf	\N	admin	2019-07-16 17:39:05	\N	5
35	Procedimiento	Eliminar	96669:DIRECCIONAMIENTO ESTRATEGICO.pdf	\N	admin	2019-07-17 10:15:29	\N	5
36	Subproceso	Eliminar	2536, y todas las opciones	\N	admin	2019-07-17 10:15:58	12	5
37	Subproceso	Modificar	prueba	prueba:,G,F	admin	2019-07-18 09:54:57	11	6
38	Subproceso	Modificar	prueba	prueba:,PRO,G,I	admin	2019-08-01 10:08:33	11	7
39	Subproceso	Eliminar	prueba, y todas las opciones	\N	admin	2019-08-01 10:08:40	11	7
40	PoliticaOperativa	Modificar	POLITICA OPERATIVAs:POLITICA OPERATIVA.pdf	\N	admin	2019-08-01 10:19:28	11	\N
41	PoliticaOperativa	Modificar	POLÍTICA OPERATIVA:POLITICA OPERATIVA.pdf	\N	admin	2019-08-01 10:19:41	11	\N
42	Caracterizacion	Cambiar	CARACTERIZACIÓN DEL PROCESO:CARACTERIZACION DEL PROCESO.pdf	CARACTERIZACIÓN DEL PROCESO	admin	2019-08-01 10:26:19	11	\N
43	Subproceso	Modificar	prueba	prueba:,PRO,M,G,P,I,F	admin	2019-08-01 10:26:47	11	6
44	Procedimiento	Modificar	prueba:constancia_TituladaPresencial.pdf	pruebas;El archivo no se cambio	admin	2019-08-01 10:38:30	\N	6
45	Procedimiento	Eliminar	pruebas:constancia_TituladaPresencial.pdf	\N	admin	2019-08-01 10:38:36	\N	6
46	Manual	Modificar	prueba:constancia_constancia_escolaridad.pdf	pruebas: el archivo no se cambio	admin	2019-08-01 10:44:00	\N	6
47	Manuales	Eliminar	pruebas:constancia_constancia_escolaridad.pdf	\N	admin	2019-08-01 10:44:51	\N	6
48	Guias	Modificar	prueba:constancia_NotasAprendiz.pdf	pruebas: no se cambio el archivo	admin	2019-08-01 10:51:49	\N	6
49	Guias	Eliminar	pruebas:constancia_NotasAprendiz.pdf	\N	admin	2019-08-01 10:52:29	\N	6
50	Protocolo	Modificar	prueba:constancia_TituladaPresencial.pdf	pruebas: no se cambio el archivo	admin	2019-08-01 11:26:34	\N	6
51	Protocolo	Eliminar	pruebas:constancia_TituladaPresencial.pdf	\N	admin	2019-08-01 11:26:38	\N	6
52	Instructivo	Modificar	prueba:constancia_constancia_escolaridad.pdf	pruebak; no se cambio el archivo	admin	2019-08-01 11:32:08	\N	6
53	Instructivo	Eliminar	pruebak:constancia_constancia_escolaridad.pdf	\N	admin	2019-08-01 11:32:14	\N	6
54	Formatos	Modificar	prueba:Mapa de Procesos.pptx	pruebayy; no se cambio el archivo	admin	2019-08-01 11:42:15	\N	6
55	Formatos	Eliminar	prueba:NUEVA DICIEMBRE LISTA DE PRECIOS (1).xls	\N	admin	2019-08-01 11:42:21	\N	6
56	Formatos	Eliminar	pruebayy:Mapa de Procesos.pptx	\N	admin	2019-08-01 11:42:24	\N	6
57	Subproceso	Modificar	prueba	prueba:,PRO	admin	2019-08-01 11:42:37	11	6
58	Subproceso	Modificar	prueba	Subproceso 1:,PRO,M,G,P,I,F	admin	2019-08-01 14:36:54	11	6
59	Subproceso	Modificar	Subproceso 1	Subproceso 1:,M,P,F	admin	2019-08-01 15:44:11	11	6
60	Subproceso	Modificar	Subproceso 1	Subproceso 1:,PRO,M,G,P,I,F	admin	2019-08-01 15:44:18	11	6
\.


--
-- Data for Name: reportecorrectivo; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.reportecorrectivo (numeroreporte, consecutivo, ciudad, tipofalla, otrafalla, idepersona, ideequipo, problemapresentado, funcionamiento, observaciones, aspectofisico, condicionambiental, limpiezainterna, limpiezaexterna, pruebasfuncionamiento, lubricacionpartes, pruebainicial, sistemaelectronico, sistemahidraulico, sistemaneumatico, sistemamecanico, sistemaelectrico, sistemaoptico, sistemaoperativo, sistemaelectromecanico, sistemavapor, fecha) FROM stdin;
\.


--
-- Data for Name: reportepreventivo; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.reportepreventivo (numeroreporte, consecutivo, ciudad, tipofalla, otrafalla, idepersona, idemantenimientopreventivo, ideequipo, problemapresentado, funcionamiento, observaciones, aspectofisico, condicionambiental, limpiezainterna, limpiezaexterna, pruebasfuncionamiento, lubricacionpartes, pruebainicial, sistemaelectronico, sistemahidraulico, sistemaneumatico, sistemamecanico, sistemaelectrico, sistemaoptico, sistemaoperativo, sistemaelectromecanico, sistemavapor, fecha) FROM stdin;
19001	3	Pasto	O		1084226940	26	159		on		S	S	S	N	N	N	S	S	S	S	S	S	N	N	N	N	2019-10-08 00:00:00
\.


--
-- Data for Name: repuesto; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.repuesto (ide, detalle, referencia, cantidad, numeroreporte) FROM stdin;
\.


--
-- Data for Name: rutinaequipo; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.rutinaequipo (ide, descripcion, idetipoequipo) FROM stdin;
\.


--
-- Data for Name: sede; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.sede (ide, nombre, nitcliente) FROM stdin;
14	prueba	789456123321456
15	Otra Sede	789456123321456
\.


--
-- Data for Name: submenuproceso; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.submenuproceso (ide, ideopcion, menu) FROM stdin;
50	6	PRO
51	6	M
52	6	G
53	6	P
54	6	I
55	6	F
56	8	PRO
57	8	P
\.


--
-- Data for Name: tipoequipo; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.tipoequipo (ide, nombre, calibrable, rutina, tipo, otro) FROM stdin;
124	FONENDOSCOPIO	S	»ACTIVIDAD 1\r\n»ACTIVIDAD 2\r\n»ACTIVIDAD 3\r\n»ACTIVIDAD 4\r\n»ACTIVIDAD 5\r\n»ACTIVIDAD 6\r\n»ACTIVIDAD 7	O	Otro
116	TENSIOMETRO	N	»ACTIVIDAD 1 »ACTIVIDAD 2 »ACTIVIDAD 3 »ACTIVIDAD 4 »ACTIVIDAD 5 »ACTIVIDAD 6 »ACTIVIDAD 7 »ACTIVIDAD 8	EB	
140	BASCULA MECANICA	N	\N	EB	\N
141	BASCULA NEONATAL	N	\N	EB	\N
142	COMPRESOR DE AIRE	N	\N	EB	\N
143	EQUIPO DE ORGANOS	N	\N	EB	\N
144	GLUCOMETRO	N	\N	EB	\N
145	LAMPARA CUELLO DE CISNE	N	\N	EB	\N
146	NEGATOSCOPIO	N	\N	EB	\N
147	PIEZA DE ALTA VELOCIDAD	N	\N	EB	\N
148	PUNTA RECTA	N	\N	EB	\N
149	TENSIOMETRO DIGITAL	N	\N	EB	\N
150	TENSIOMETRO RUEDAS	N	\N	EB	\N
151	AGITADOR DE MAZINI	S	»REVISION GENERAL DEL EQUIPO »REVISION PLATAFORMA,CABLE AC, SWITCH,MOTOR                         »LUBRICACION SISTEMA MECANICO »LIMPIEZA Y DESINFECCION GENERAL   »PRUEBAS DE FUNCIONAMINETO	EB	
152	AMALGAMADOR	N	»REVISION GENERAL DEL EQUIPO »LIMPIEZA Y DESINFECCION GENERAL »REVISION CABLE DE PODER, SWITCH,MOTOR                        »VERIFICACION DEL PANEL DE CONTROL             »PRUEBAS DE FUNCIONAMINETO	EB	
153	ANALIZADOR DE ELIZA	S	»REVISION GENERAL DEL EQUIPO »REVISION DE PANTALLA,CABLE AC, SWITCH DE ENCENDIDO         »VERIFICACION SISTEMA ELECTRICO »LIMPIEZA Y DESINFECCION GENERAL	EB	
139	BASCULA	N	»ACTIVIDAD 1\r\n»ACTIVIDAD 2\r\n»ACTIVIDAD 3\r\n»ACTIVIDAD 4\r\n»ACTIVIDAD 5	EB	
\.


--
-- Data for Name: unidadmedida; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.unidadmedida (ide, unidad, simbolo) FROM stdin;
1	kilogramos	Kg
2	Gramos	g
\.


--
-- Data for Name: usuario; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.usuario (usuario, clave, tipo) FROM stdin;
admin	1cf0b361bdfa933ca3f54c7ab110daa9	A
otro.otro	0f859c7e93543f5bc61b9ab8690231b6	O
diana.valencia	d23d8f21505a514a554e2a99e128525d	A
prueba	9dbcfadb50a39be6c77a185769ab612a	C
ffff	09a86cab9e60c5653c923142a8494091	C
Politica	cda0477a9a03011daaa556fd33e438b8	C
Odontopilar	2481506b7c982e8beefdda10fee5984d	C
\.


--
-- Data for Name: verificacionmetrologica; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.verificacionmetrologica (ide, valornominal, valormedido, ideunidadmedida, numeroreporte) FROM stdin;
\.


--
-- Name: archivoextra_ide_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.archivoextra_ide_seq', 6, true);


--
-- Name: archivosproceso_codigo_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.archivosproceso_codigo_seq', 5, true);


--
-- Name: caracterizacionproceso_codigo_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.caracterizacionproceso_codigo_seq', 10, true);


--
-- Name: cronograma_ide_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.cronograma_ide_seq', 17, true);


--
-- Name: datosnumeroreporte_ide_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.datosnumeroreporte_ide_seq', 1, true);


--
-- Name: equipo_ide_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.equipo_ide_seq', 160, true);


--
-- Name: equipodebaja_ide_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.equipodebaja_ide_seq', 52, true);


--
-- Name: formatosproceso_codigo_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.formatosproceso_codigo_seq', 3, true);


--
-- Name: guiasproceso_codigo_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.guiasproceso_codigo_seq', 2, true);


--
-- Name: instructivosproceso_codigo_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.instructivosproceso_codigo_seq', 1, true);


--
-- Name: mantenimientopreventivo_ide_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.mantenimientopreventivo_ide_seq', 28, true);


--
-- Name: manualesproceso_codigo_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.manualesproceso_codigo_seq', 2, true);


--
-- Name: membrete_codigo_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.membrete_codigo_seq', 5, true);


--
-- Name: mes_ide_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.mes_ide_seq', 12, true);


--
-- Name: opcionesproceso_ide_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.opcionesproceso_ide_seq', 8, true);


--
-- Name: permiso_ide_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.permiso_ide_seq', 105, true);


--
-- Name: politicaoperativaproceso_codigo_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.politicaoperativaproceso_codigo_seq', 10, true);


--
-- Name: presentacion_codigo_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.presentacion_codigo_seq', 2, true);


--
-- Name: procedimientosproceso_codigo_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.procedimientosproceso_codigo_seq', 6, true);


--
-- Name: proceso_ide_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.proceso_ide_seq', 15, true);


--
-- Name: protocolosproceso_codigo_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.protocolosproceso_codigo_seq', 2, true);


--
-- Name: registroactividad_ide_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.registroactividad_ide_seq', 60, true);


--
-- Name: reportecorrectivo_consecutivo_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.reportecorrectivo_consecutivo_seq', 1, false);


--
-- Name: reportepreventivo_consecutivo_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.reportepreventivo_consecutivo_seq', 3, true);


--
-- Name: repuesto_ide_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.repuesto_ide_seq', 1, false);


--
-- Name: rutinaequipo_ide_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.rutinaequipo_ide_seq', 7, true);


--
-- Name: sede_ide_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.sede_ide_seq', 15, true);


--
-- Name: submenuproceso_ide_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.submenuproceso_ide_seq', 57, true);


--
-- Name: tipoequipo_ide_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.tipoequipo_ide_seq', 154, true);


--
-- Name: unidadmedida_ide_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.unidadmedida_ide_seq', 2, true);


--
-- Name: verificacionmetrologica_ide_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.verificacionmetrologica_ide_seq', 1, false);


--
-- Name: archivoextra archivoextra_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.archivoextra
    ADD CONSTRAINT archivoextra_pkey PRIMARY KEY (ide);


--
-- Name: archivosproceso archivosproceso_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.archivosproceso
    ADD CONSTRAINT archivosproceso_pkey PRIMARY KEY (codigo);


--
-- Name: caracterizacionproceso caracterizacionproceso_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.caracterizacionproceso
    ADD CONSTRAINT caracterizacionproceso_pkey PRIMARY KEY (codigo);


--
-- Name: cliente cliente_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.cliente
    ADD CONSTRAINT cliente_pkey PRIMARY KEY (nit);


--
-- Name: cliente cliente_usuario_key; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.cliente
    ADD CONSTRAINT cliente_usuario_key UNIQUE (usuario);


--
-- Name: cronograma cronograma_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.cronograma
    ADD CONSTRAINT cronograma_pkey PRIMARY KEY (ide);


--
-- Name: datosnumeroreporte datosnumeroreporte_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.datosnumeroreporte
    ADD CONSTRAINT datosnumeroreporte_pkey PRIMARY KEY (ide);


--
-- Name: equipo equipo_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.equipo
    ADD CONSTRAINT equipo_pkey PRIMARY KEY (ide);


--
-- Name: equipodebaja equipodebaja_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.equipodebaja
    ADD CONSTRAINT equipodebaja_pkey PRIMARY KEY (ide);


--
-- Name: formatosproceso formatosproceso_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.formatosproceso
    ADD CONSTRAINT formatosproceso_pkey PRIMARY KEY (codigo);


--
-- Name: guiasproceso guiasproceso_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.guiasproceso
    ADD CONSTRAINT guiasproceso_pkey PRIMARY KEY (codigo);


--
-- Name: instructivosproceso instructivosproceso_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.instructivosproceso
    ADD CONSTRAINT instructivosproceso_pkey PRIMARY KEY (codigo);


--
-- Name: mantenimientopreventivo mantenimientopreventivo_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.mantenimientopreventivo
    ADD CONSTRAINT mantenimientopreventivo_pkey PRIMARY KEY (ide);


--
-- Name: manualesproceso manualesproceso_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.manualesproceso
    ADD CONSTRAINT manualesproceso_pkey PRIMARY KEY (codigo);


--
-- Name: membrete membrete_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.membrete
    ADD CONSTRAINT membrete_pkey PRIMARY KEY (codigo);


--
-- Name: mes mes_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.mes
    ADD CONSTRAINT mes_pkey PRIMARY KEY (ide);


--
-- Name: opcionesproceso opcionesproceso_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.opcionesproceso
    ADD CONSTRAINT opcionesproceso_pkey PRIMARY KEY (ide);


--
-- Name: permiso permiso_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.permiso
    ADD CONSTRAINT permiso_pkey PRIMARY KEY (ide);


--
-- Name: persona persona_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.persona
    ADD CONSTRAINT persona_pkey PRIMARY KEY (identificacion);


--
-- Name: politicaoperativaproceso politicaoperativaproceso_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.politicaoperativaproceso
    ADD CONSTRAINT politicaoperativaproceso_pkey PRIMARY KEY (codigo);


--
-- Name: presentacion presentacion_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.presentacion
    ADD CONSTRAINT presentacion_pkey PRIMARY KEY (codigo);


--
-- Name: procedimientosproceso procedimientosproceso_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.procedimientosproceso
    ADD CONSTRAINT procedimientosproceso_pkey PRIMARY KEY (codigo);


--
-- Name: proceso proceso_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.proceso
    ADD CONSTRAINT proceso_pkey PRIMARY KEY (ide);


--
-- Name: protocolosproceso protocolosproceso_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.protocolosproceso
    ADD CONSTRAINT protocolosproceso_pkey PRIMARY KEY (codigo);


--
-- Name: registroactividad registroactividad_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.registroactividad
    ADD CONSTRAINT registroactividad_pkey PRIMARY KEY (ide);


--
-- Name: reportecorrectivo reportecorrectivo_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.reportecorrectivo
    ADD CONSTRAINT reportecorrectivo_pkey PRIMARY KEY (numeroreporte);


--
-- Name: reportepreventivo reportepreventivo_consecutivo_key; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.reportepreventivo
    ADD CONSTRAINT reportepreventivo_consecutivo_key UNIQUE (consecutivo);


--
-- Name: reportepreventivo reportepreventivo_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.reportepreventivo
    ADD CONSTRAINT reportepreventivo_pkey PRIMARY KEY (numeroreporte);


--
-- Name: repuesto repuesto_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.repuesto
    ADD CONSTRAINT repuesto_pkey PRIMARY KEY (ide);


--
-- Name: rutinaequipo rutinaequipo_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.rutinaequipo
    ADD CONSTRAINT rutinaequipo_pkey PRIMARY KEY (ide);


--
-- Name: sede sede_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.sede
    ADD CONSTRAINT sede_pkey PRIMARY KEY (ide);


--
-- Name: submenuproceso submenuproceso_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.submenuproceso
    ADD CONSTRAINT submenuproceso_pkey PRIMARY KEY (ide);


--
-- Name: tipoequipo tipoequipo_nombre_key; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.tipoequipo
    ADD CONSTRAINT tipoequipo_nombre_key UNIQUE (nombre);


--
-- Name: tipoequipo tipoequipo_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.tipoequipo
    ADD CONSTRAINT tipoequipo_pkey PRIMARY KEY (ide);


--
-- Name: unidadmedida unidadmedida_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.unidadmedida
    ADD CONSTRAINT unidadmedida_pkey PRIMARY KEY (ide);


--
-- Name: usuario usuario_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.usuario
    ADD CONSTRAINT usuario_pkey PRIMARY KEY (usuario);


--
-- Name: verificacionmetrologica verificacionmetrologica_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.verificacionmetrologica
    ADD CONSTRAINT verificacionmetrologica_pkey PRIMARY KEY (ide);


--
-- Name: archivosproceso archivosproceso_ideproceso_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.archivosproceso
    ADD CONSTRAINT archivosproceso_ideproceso_fkey FOREIGN KEY (ideproceso) REFERENCES public.proceso(ide) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: caracterizacionproceso caracterizacionproceso_ideproceso_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.caracterizacionproceso
    ADD CONSTRAINT caracterizacionproceso_ideproceso_fkey FOREIGN KEY (ideproceso) REFERENCES public.proceso(ide) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: cliente cliente_usuario_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.cliente
    ADD CONSTRAINT cliente_usuario_fkey FOREIGN KEY (usuario) REFERENCES public.usuario(usuario) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: cronograma cronograma_idesede_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.cronograma
    ADD CONSTRAINT cronograma_idesede_fkey FOREIGN KEY (idesede) REFERENCES public.sede(ide) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: cronograma cronograma_nitcliente_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.cronograma
    ADD CONSTRAINT cronograma_nitcliente_fkey FOREIGN KEY (nitcliente) REFERENCES public.cliente(nit) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: equipo equipo_idesede_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.equipo
    ADD CONSTRAINT equipo_idesede_fkey FOREIGN KEY (idesede) REFERENCES public.sede(ide) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: equipo equipo_nitcliente_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.equipo
    ADD CONSTRAINT equipo_nitcliente_fkey FOREIGN KEY (nitcliente) REFERENCES public.cliente(nit) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: equipo equipo_nombreequipo_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.equipo
    ADD CONSTRAINT equipo_nombreequipo_fkey FOREIGN KEY (nombreequipo) REFERENCES public.tipoequipo(nombre) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: equipodebaja equipodebaja_idesede_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.equipodebaja
    ADD CONSTRAINT equipodebaja_idesede_fkey FOREIGN KEY (idesede) REFERENCES public.sede(ide) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: equipodebaja equipodebaja_nitcliente_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.equipodebaja
    ADD CONSTRAINT equipodebaja_nitcliente_fkey FOREIGN KEY (nitcliente) REFERENCES public.cliente(nit) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: equipodebaja equipodebaja_nombreequipo_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.equipodebaja
    ADD CONSTRAINT equipodebaja_nombreequipo_fkey FOREIGN KEY (nombreequipo) REFERENCES public.tipoequipo(nombre) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: formatosproceso formatosproceso_ideopcionesproceso_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.formatosproceso
    ADD CONSTRAINT formatosproceso_ideopcionesproceso_fkey FOREIGN KEY (ideopcionesproceso) REFERENCES public.opcionesproceso(ide) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: guiasproceso guiasproceso_ideopcionesproceso_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.guiasproceso
    ADD CONSTRAINT guiasproceso_ideopcionesproceso_fkey FOREIGN KEY (ideopcionesproceso) REFERENCES public.opcionesproceso(ide) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: instructivosproceso instructivosproceso_ideopcionesproceso_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.instructivosproceso
    ADD CONSTRAINT instructivosproceso_ideopcionesproceso_fkey FOREIGN KEY (ideopcionesproceso) REFERENCES public.opcionesproceso(ide) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: mantenimientopreventivo mantenimientopreventivo_idesede_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.mantenimientopreventivo
    ADD CONSTRAINT mantenimientopreventivo_idesede_fkey FOREIGN KEY (idesede) REFERENCES public.sede(ide) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: mantenimientopreventivo mantenimientopreventivo_nitcliente_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.mantenimientopreventivo
    ADD CONSTRAINT mantenimientopreventivo_nitcliente_fkey FOREIGN KEY (nitcliente) REFERENCES public.cliente(nit) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: manualesproceso manualesproceso_ideopcionesproceso_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.manualesproceso
    ADD CONSTRAINT manualesproceso_ideopcionesproceso_fkey FOREIGN KEY (ideopcionesproceso) REFERENCES public.opcionesproceso(ide) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: opcionesproceso opcionesproceso_ideproceso_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.opcionesproceso
    ADD CONSTRAINT opcionesproceso_ideproceso_fkey FOREIGN KEY (ideproceso) REFERENCES public.proceso(ide) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: permiso permiso_ideproceso_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.permiso
    ADD CONSTRAINT permiso_ideproceso_fkey FOREIGN KEY (ideproceso) REFERENCES public.proceso(ide) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: permiso permiso_usuario_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.permiso
    ADD CONSTRAINT permiso_usuario_fkey FOREIGN KEY (usuario) REFERENCES public.usuario(usuario) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: persona persona_usuario_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.persona
    ADD CONSTRAINT persona_usuario_fkey FOREIGN KEY (usuario) REFERENCES public.usuario(usuario) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: politicaoperativaproceso politicaoperativaproceso_ideproceso_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.politicaoperativaproceso
    ADD CONSTRAINT politicaoperativaproceso_ideproceso_fkey FOREIGN KEY (ideproceso) REFERENCES public.proceso(ide) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: procedimientosproceso procedimientosproceso_ideopcionesproceso_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.procedimientosproceso
    ADD CONSTRAINT procedimientosproceso_ideopcionesproceso_fkey FOREIGN KEY (ideopcionesproceso) REFERENCES public.opcionesproceso(ide) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: protocolosproceso protocolosproceso_ideopcionesproceso_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.protocolosproceso
    ADD CONSTRAINT protocolosproceso_ideopcionesproceso_fkey FOREIGN KEY (ideopcionesproceso) REFERENCES public.opcionesproceso(ide) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: reportecorrectivo reportecorrectivo_ideequipo_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.reportecorrectivo
    ADD CONSTRAINT reportecorrectivo_ideequipo_fkey FOREIGN KEY (ideequipo) REFERENCES public.equipo(ide) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: reportecorrectivo reportecorrectivo_idepersona_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.reportecorrectivo
    ADD CONSTRAINT reportecorrectivo_idepersona_fkey FOREIGN KEY (idepersona) REFERENCES public.persona(identificacion) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: reportepreventivo reportepreventivo_ideequipo_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.reportepreventivo
    ADD CONSTRAINT reportepreventivo_ideequipo_fkey FOREIGN KEY (ideequipo) REFERENCES public.equipo(ide) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: reportepreventivo reportepreventivo_idemantenimientopreventivo_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.reportepreventivo
    ADD CONSTRAINT reportepreventivo_idemantenimientopreventivo_fkey FOREIGN KEY (idemantenimientopreventivo) REFERENCES public.mantenimientopreventivo(ide) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: reportepreventivo reportepreventivo_idepersona_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.reportepreventivo
    ADD CONSTRAINT reportepreventivo_idepersona_fkey FOREIGN KEY (idepersona) REFERENCES public.persona(identificacion) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: rutinaequipo rutinaequipo_idetipoequipo_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.rutinaequipo
    ADD CONSTRAINT rutinaequipo_idetipoequipo_fkey FOREIGN KEY (idetipoequipo) REFERENCES public.tipoequipo(ide) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: sede sede_nitcliente_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.sede
    ADD CONSTRAINT sede_nitcliente_fkey FOREIGN KEY (nitcliente) REFERENCES public.cliente(nit) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: submenuproceso submenuproceso_ideopcion_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.submenuproceso
    ADD CONSTRAINT submenuproceso_ideopcion_fkey FOREIGN KEY (ideopcion) REFERENCES public.opcionesproceso(ide) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: verificacionmetrologica verificacionmetrologica_ideunidadmedida_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.verificacionmetrologica
    ADD CONSTRAINT verificacionmetrologica_ideunidadmedida_fkey FOREIGN KEY (ideunidadmedida) REFERENCES public.unidadmedida(ide) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- PostgreSQL database dump complete
--

