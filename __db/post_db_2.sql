--
-- PostgreSQL database dump
--

-- Dumped from database version 11.2
-- Dumped by pg_dump version 11.2

-- Started on 2019-03-21 16:38:29

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET client_min_messages = warning;
SET row_security = off;

--
-- TOC entry 2885 (class 1262 OID 16393)
-- Name: pos; Type: DATABASE; Schema: -; Owner: postgres
--

CREATE DATABASE pos WITH TEMPLATE = template0 ENCODING = 'UTF8' LC_COLLATE = 'English_United States.1252' LC_CTYPE = 'English_United States.1252';


ALTER DATABASE pos OWNER TO postgres;

\connect pos

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET client_min_messages = warning;
SET row_security = off;

--
-- TOC entry 2886 (class 0 OID 0)
-- Dependencies: 2885
-- Name: DATABASE pos; Type: COMMENT; Schema: -; Owner: postgres
--

COMMENT ON DATABASE pos IS 'table apliaksi point of sales';


--
-- TOC entry 205 (class 1259 OID 16464)
-- Name: category_id; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.category_id
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.category_id OWNER TO postgres;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- TOC entry 198 (class 1259 OID 16422)
-- Name: category; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.category (
    id integer DEFAULT nextval('public.category_id'::regclass) NOT NULL,
    name character varying(255) NOT NULL,
    description character varying(255)
);


ALTER TABLE public.category OWNER TO postgres;

--
-- TOC entry 206 (class 1259 OID 16466)
-- Name: order_id; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.order_id
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.order_id OWNER TO postgres;

--
-- TOC entry 200 (class 1259 OID 16440)
-- Name: order; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public."order" (
    id integer DEFAULT nextval('public.order_id'::regclass) NOT NULL,
    invoice character varying NOT NULL,
    "user" integer NOT NULL,
    total integer,
    created_date timestamp without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL,
    updated_date timestamp without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL,
    status integer DEFAULT 1 NOT NULL
);


ALTER TABLE public."order" OWNER TO postgres;

--
-- TOC entry 207 (class 1259 OID 16468)
-- Name: orderdetail_id; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.orderdetail_id
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.orderdetail_id OWNER TO postgres;

--
-- TOC entry 201 (class 1259 OID 16450)
-- Name: order_detail; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.order_detail (
    id integer DEFAULT nextval('public.orderdetail_id'::regclass) NOT NULL,
    "order" integer NOT NULL,
    product integer NOT NULL,
    qty integer NOT NULL,
    price integer NOT NULL,
    created_date timestamp without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL,
    updated_date timestamp without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL,
    status integer DEFAULT 1 NOT NULL
);


ALTER TABLE public.order_detail OWNER TO postgres;

--
-- TOC entry 204 (class 1259 OID 16462)
-- Name: product_id; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.product_id
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.product_id OWNER TO postgres;

--
-- TOC entry 199 (class 1259 OID 16430)
-- Name: product; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.product (
    id integer DEFAULT nextval('public.product_id'::regclass) NOT NULL,
    name character varying(255) NOT NULL,
    description character varying(255),
    price integer NOT NULL,
    stock integer NOT NULL,
    created_date timestamp without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL,
    updated_date timestamp without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL,
    category integer NOT NULL
);


ALTER TABLE public.product OWNER TO postgres;

--
-- TOC entry 203 (class 1259 OID 16460)
-- Name: user_id; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.user_id
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.user_id OWNER TO postgres;

--
-- TOC entry 196 (class 1259 OID 16405)
-- Name: user; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public."user" (
    id integer DEFAULT nextval('public.user_id'::regclass) NOT NULL,
    usergroup integer NOT NULL,
    username character varying(50) NOT NULL,
    password character varying(255),
    full_name character varying(255),
    status bit(1) DEFAULT (1)::bit(1) NOT NULL
);


ALTER TABLE public."user" OWNER TO postgres;

--
-- TOC entry 202 (class 1259 OID 16457)
-- Name: usergroup_id; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.usergroup_id
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.usergroup_id OWNER TO postgres;

--
-- TOC entry 197 (class 1259 OID 16414)
-- Name: usergroup; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.usergroup (
    id integer DEFAULT nextval('public.usergroup_id'::regclass) NOT NULL,
    name character varying(255) NOT NULL,
    description character varying(255)
);


ALTER TABLE public.usergroup OWNER TO postgres;

--
-- TOC entry 2870 (class 0 OID 16422)
-- Dependencies: 198
-- Data for Name: category; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.category VALUES (1, 'Snack', 'kategori makanan ringan');
INSERT INTO public.category VALUES (2, 'Minuman ringan', 'kategori minuman ringan');
INSERT INTO public.category VALUES (3, 'Peralatan rumah tangga', 'kategori peralatan rumah tangga');
INSERT INTO public.category VALUES (4, 'Obat-obatan', 'kategori obat - obatan');
INSERT INTO public.category VALUES (5, 'Fresh food', 'kategori makanan segar');


--
-- TOC entry 2872 (class 0 OID 16440)
-- Dependencies: 200
-- Data for Name: order; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2873 (class 0 OID 16450)
-- Dependencies: 201
-- Data for Name: order_detail; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2871 (class 0 OID 16430)
-- Dependencies: 199
-- Data for Name: product; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.product VALUES (1, 'Product 1', 'This product 1 is updated from category 1', 1000, 99, '2019-03-21 14:51:55.594149', '2019-03-21 14:51:55.594149', 1);
INSERT INTO public.product VALUES (2, 'Product 2', 'This product 2 is updated from category 1', 1000, 99, '2019-03-21 14:51:55.621875', '2019-03-21 14:51:55.621875', 1);
INSERT INTO public.product VALUES (3, 'Product 1', 'This product 1 is updated from category 2', 1000, 99, '2019-03-21 14:51:55.622608', '2019-03-21 14:51:55.622608', 2);
INSERT INTO public.product VALUES (4, 'Product 2', 'This product 2 is updated from category 2', 1000, 99, '2019-03-21 14:51:55.623264', '2019-03-21 14:51:55.623264', 2);
INSERT INTO public.product VALUES (5, 'Product 1', 'This product 1 is updated from category 3', 1000, 99, '2019-03-21 14:51:55.62393', '2019-03-21 14:51:55.62393', 3);
INSERT INTO public.product VALUES (6, 'Product 2', 'This product 2 is updated from category 3', 1000, 99, '2019-03-21 14:51:55.624696', '2019-03-21 14:51:55.624696', 3);
INSERT INTO public.product VALUES (7, 'Product 1', 'This product 1 is updated from category 4', 1000, 99, '2019-03-21 14:51:55.625516', '2019-03-21 14:51:55.625516', 4);
INSERT INTO public.product VALUES (8, 'Product 2', 'This product 2 is updated from category 4', 1000, 99, '2019-03-21 14:51:55.62636', '2019-03-21 14:51:55.62636', 4);
INSERT INTO public.product VALUES (9, 'Product 1', 'This product 1 is updated from category 5', 1000, 99, '2019-03-21 14:51:55.627059', '2019-03-21 14:51:55.627059', 5);
INSERT INTO public.product VALUES (10, 'Product 2', 'This product 2 is updated from category 5', 1000, 99, '2019-03-21 14:51:55.627707', '2019-03-21 14:51:55.627707', 5);


--
-- TOC entry 2868 (class 0 OID 16405)
-- Dependencies: 196
-- Data for Name: user; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public."user" VALUES (1, 2, 'vano20', 'Rahasia', 'Savano miatama', B'1');
INSERT INTO public."user" VALUES (7, 2, 'fatimah', 'rhinoMilo', 'Fatimah Humaira', B'1');


--
-- TOC entry 2869 (class 0 OID 16414)
-- Dependencies: 197
-- Data for Name: usergroup; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.usergroup VALUES (2, 'administrator', 'Usergroup Administrator');


--
-- TOC entry 2887 (class 0 OID 0)
-- Dependencies: 205
-- Name: category_id; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.category_id', 6, true);


--
-- TOC entry 2888 (class 0 OID 0)
-- Dependencies: 206
-- Name: order_id; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.order_id', 1, false);


--
-- TOC entry 2889 (class 0 OID 0)
-- Dependencies: 207
-- Name: orderdetail_id; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.orderdetail_id', 1, false);


--
-- TOC entry 2890 (class 0 OID 0)
-- Dependencies: 204
-- Name: product_id; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.product_id', 10, true);


--
-- TOC entry 2891 (class 0 OID 0)
-- Dependencies: 203
-- Name: user_id; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.user_id', 9, true);


--
-- TOC entry 2892 (class 0 OID 0)
-- Dependencies: 202
-- Name: usergroup_id; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.usergroup_id', 2, true);


--
-- TOC entry 2740 (class 2606 OID 16429)
-- Name: category category_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.category
    ADD CONSTRAINT category_pkey PRIMARY KEY (id);


--
-- TOC entry 2746 (class 2606 OID 16454)
-- Name: order_detail order_detail_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.order_detail
    ADD CONSTRAINT order_detail_pkey PRIMARY KEY (id);


--
-- TOC entry 2744 (class 2606 OID 16449)
-- Name: order order_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."order"
    ADD CONSTRAINT order_pkey PRIMARY KEY (id);


--
-- TOC entry 2742 (class 2606 OID 16439)
-- Name: product product_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.product
    ADD CONSTRAINT product_pkey PRIMARY KEY (id);


--
-- TOC entry 2736 (class 2606 OID 16413)
-- Name: user user_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."user"
    ADD CONSTRAINT user_pkey PRIMARY KEY (id);


--
-- TOC entry 2738 (class 2606 OID 16421)
-- Name: usergroup usergroup_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.usergroup
    ADD CONSTRAINT usergroup_pkey PRIMARY KEY (id);


-- Completed on 2019-03-21 16:38:29

--
-- PostgreSQL database dump complete
--

