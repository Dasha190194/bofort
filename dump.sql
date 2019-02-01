--
-- PostgreSQL database dump
--

-- Dumped from database version 9.5.14
-- Dumped by pg_dump version 9.5.14

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET client_min_messages = warning;
SET row_security = off;

DROP DATABASE IF EXISTS bofort;
--
-- Name: bofort; Type: DATABASE; Schema: -; Owner: postgres
--

CREATE DATABASE bofort WITH TEMPLATE = template0 ENCODING = 'UTF8' LC_COLLATE = 'ru_RU.UTF-8' LC_CTYPE = 'ru_RU.UTF-8';


ALTER DATABASE bofort OWNER TO postgres;

\connect bofort

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
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
-- Name: actions; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.actions (
    id integer NOT NULL,
    price integer,
    datetime timestamp without time zone,
    name character varying(255)
);


ALTER TABLE public.actions OWNER TO admin;

--
-- Name: actions_id_seq; Type: SEQUENCE; Schema: public; Owner: admin
--

CREATE SEQUENCE public.actions_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.actions_id_seq OWNER TO admin;

--
-- Name: actions_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: admin
--

ALTER SEQUENCE public.actions_id_seq OWNED BY public.actions.id;


--
-- Name: boat_actions; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.boat_actions (
    boat_id integer,
    action_id integer
);


ALTER TABLE public.boat_actions OWNER TO admin;

--
-- Name: boat_services; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.boat_services (
    boat_id integer,
    service_id integer
);


ALTER TABLE public.boat_services OWNER TO admin;

--
-- Name: boats; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.boats (
    id integer NOT NULL,
    name character varying(50),
    description text,
    price integer,
    engine_power character varying(50),
    spaciousness integer,
    certificate character varying(50),
    location character varying(50),
    short_description text
);


ALTER TABLE public.boats OWNER TO admin;

--
-- Name: boats_id_seq; Type: SEQUENCE; Schema: public; Owner: admin
--

CREATE SEQUENCE public.boats_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.boats_id_seq OWNER TO admin;

--
-- Name: boats_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: admin
--

ALTER SEQUENCE public.boats_id_seq OWNED BY public.boats.id;


--
-- Name: cards; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.cards (
    id integer NOT NULL,
    number character varying(50),
    type character varying(50),
    state smallint,
    user_id integer
);


ALTER TABLE public.cards OWNER TO admin;

--
-- Name: cards_id_seq; Type: SEQUENCE; Schema: public; Owner: admin
--

CREATE SEQUENCE public.cards_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.cards_id_seq OWNER TO admin;

--
-- Name: cards_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: admin
--

ALTER SEQUENCE public.cards_id_seq OWNED BY public.cards.id;


--
-- Name: images; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.images (
    id integer NOT NULL,
    path character varying(255),
    boat_id integer
);


ALTER TABLE public.images OWNER TO admin;

--
-- Name: images_id_seq; Type: SEQUENCE; Schema: public; Owner: admin
--

CREATE SEQUENCE public.images_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.images_id_seq OWNER TO admin;

--
-- Name: images_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: admin
--

ALTER SEQUENCE public.images_id_seq OWNED BY public.images.id;


--
-- Name: migration; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.migration (
    version character varying(180) NOT NULL,
    apply_time integer
);


ALTER TABLE public.migration OWNER TO admin;

--
-- Name: notifications; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.notifications (
    id integer NOT NULL,
    text text,
    is_open integer DEFAULT 0,
    user_id integer
);


ALTER TABLE public.notifications OWNER TO admin;

--
-- Name: notifications_id_seq; Type: SEQUENCE; Schema: public; Owner: admin
--

CREATE SEQUENCE public.notifications_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.notifications_id_seq OWNER TO admin;

--
-- Name: notifications_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: admin
--

ALTER SEQUENCE public.notifications_id_seq OWNED BY public.notifications.id;


--
-- Name: order_services; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.order_services (
    order_id integer,
    service_id integer
);


ALTER TABLE public.order_services OWNER TO admin;

--
-- Name: orders; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.orders (
    id integer NOT NULL,
    user_id integer NOT NULL,
    boat_id integer NOT NULL,
    datetime_create timestamp without time zone DEFAULT now() NOT NULL,
    is_paid smallint DEFAULT 0,
    is_book smallint DEFAULT 0,
    price double precision DEFAULT 0,
    card_id integer,
    offer_processing smallint DEFAULT 0,
    promo_id integer DEFAULT 0,
    discount double precision DEFAULT 0,
    datetime_from timestamp without time zone,
    datetime_to timestamp without time zone,
    state smallint DEFAULT 0
);


ALTER TABLE public.orders OWNER TO admin;

--
-- Name: orders_id_seq; Type: SEQUENCE; Schema: public; Owner: admin
--

CREATE SEQUENCE public.orders_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.orders_id_seq OWNER TO admin;

--
-- Name: orders_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: admin
--

ALTER SEQUENCE public.orders_id_seq OWNED BY public.orders.id;


--
-- Name: profile; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.profile (
    id integer NOT NULL,
    user_id integer NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    full_name character varying(255),
    timezone character varying(255)
);


ALTER TABLE public.profile OWNER TO admin;

--
-- Name: profile_id_seq; Type: SEQUENCE; Schema: public; Owner: admin
--

CREATE SEQUENCE public.profile_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.profile_id_seq OWNER TO admin;

--
-- Name: profile_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: admin
--

ALTER SEQUENCE public.profile_id_seq OWNED BY public.profile.id;


--
-- Name: promo; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.promo (
    id integer NOT NULL,
    word character varying(50),
    count integer,
    count_to_use smallint,
    type smallint,
    is_active smallint DEFAULT 1
);


ALTER TABLE public.promo OWNER TO admin;

--
-- Name: promo_history; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.promo_history (
    promo_id integer,
    datetime timestamp without time zone DEFAULT now(),
    user_id integer,
    order_id integer
);


ALTER TABLE public.promo_history OWNER TO admin;

--
-- Name: promo_id_seq; Type: SEQUENCE; Schema: public; Owner: admin
--

CREATE SEQUENCE public.promo_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.promo_id_seq OWNER TO admin;

--
-- Name: promo_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: admin
--

ALTER SEQUENCE public.promo_id_seq OWNED BY public.promo.id;


--
-- Name: role; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.role (
    id integer NOT NULL,
    name character varying(255) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    can_admin smallint DEFAULT 0 NOT NULL
);


ALTER TABLE public.role OWNER TO admin;

--
-- Name: role_id_seq; Type: SEQUENCE; Schema: public; Owner: admin
--

CREATE SEQUENCE public.role_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.role_id_seq OWNER TO admin;

--
-- Name: role_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: admin
--

ALTER SEQUENCE public.role_id_seq OWNED BY public.role.id;


--
-- Name: services; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.services (
    id integer NOT NULL,
    name character varying(50),
    price integer
);


ALTER TABLE public.services OWNER TO admin;

--
-- Name: services_id_seq; Type: SEQUENCE; Schema: public; Owner: admin
--

CREATE SEQUENCE public.services_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.services_id_seq OWNER TO admin;

--
-- Name: services_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: admin
--

ALTER SEQUENCE public.services_id_seq OWNED BY public.services.id;


--
-- Name: transactions; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.transactions (
    id integer NOT NULL,
    card_id integer,
    datetime_create timestamp without time zone DEFAULT now(),
    state smallint DEFAULT 0,
    order_id integer,
    user_id integer,
    total_price integer DEFAULT 0
);


ALTER TABLE public.transactions OWNER TO admin;

--
-- Name: transactions_id_seq; Type: SEQUENCE; Schema: public; Owner: admin
--

CREATE SEQUENCE public.transactions_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.transactions_id_seq OWNER TO admin;

--
-- Name: transactions_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: admin
--

ALTER SEQUENCE public.transactions_id_seq OWNED BY public.transactions.id;


--
-- Name: user; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public."user" (
    id integer NOT NULL,
    role_id integer NOT NULL,
    status smallint NOT NULL,
    email character varying(255),
    username character varying(255),
    password character varying(255),
    auth_key character varying(255),
    access_token character varying(255),
    logged_in_ip character varying(255),
    logged_in_at timestamp(0) without time zone,
    created_ip character varying(255),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    banned_at timestamp(0) without time zone,
    banned_reason character varying(255),
    phone character varying(50),
    mailing smallint DEFAULT 0,
    personal_data_processing smallint DEFAULT 0
);


ALTER TABLE public."user" OWNER TO admin;

--
-- Name: user_auth; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.user_auth (
    id integer NOT NULL,
    user_id integer NOT NULL,
    provider character varying(255) NOT NULL,
    provider_id character varying(255) NOT NULL,
    provider_attributes text NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.user_auth OWNER TO admin;

--
-- Name: user_auth_id_seq; Type: SEQUENCE; Schema: public; Owner: admin
--

CREATE SEQUENCE public.user_auth_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.user_auth_id_seq OWNER TO admin;

--
-- Name: user_auth_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: admin
--

ALTER SEQUENCE public.user_auth_id_seq OWNED BY public.user_auth.id;


--
-- Name: user_id_seq; Type: SEQUENCE; Schema: public; Owner: admin
--

CREATE SEQUENCE public.user_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.user_id_seq OWNER TO admin;

--
-- Name: user_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: admin
--

ALTER SEQUENCE public.user_id_seq OWNED BY public."user".id;


--
-- Name: user_token; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.user_token (
    id integer NOT NULL,
    user_id integer,
    type smallint NOT NULL,
    token character varying(255) NOT NULL,
    data character varying(255),
    created_at timestamp(0) without time zone,
    expired_at timestamp(0) without time zone
);


ALTER TABLE public.user_token OWNER TO admin;

--
-- Name: user_token_id_seq; Type: SEQUENCE; Schema: public; Owner: admin
--

CREATE SEQUENCE public.user_token_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.user_token_id_seq OWNER TO admin;

--
-- Name: user_token_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: admin
--

ALTER SEQUENCE public.user_token_id_seq OWNED BY public.user_token.id;


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.actions ALTER COLUMN id SET DEFAULT nextval('public.actions_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.boats ALTER COLUMN id SET DEFAULT nextval('public.boats_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.cards ALTER COLUMN id SET DEFAULT nextval('public.cards_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.images ALTER COLUMN id SET DEFAULT nextval('public.images_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.notifications ALTER COLUMN id SET DEFAULT nextval('public.notifications_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.orders ALTER COLUMN id SET DEFAULT nextval('public.orders_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.profile ALTER COLUMN id SET DEFAULT nextval('public.profile_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.promo ALTER COLUMN id SET DEFAULT nextval('public.promo_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.role ALTER COLUMN id SET DEFAULT nextval('public.role_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.services ALTER COLUMN id SET DEFAULT nextval('public.services_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.transactions ALTER COLUMN id SET DEFAULT nextval('public.transactions_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public."user" ALTER COLUMN id SET DEFAULT nextval('public.user_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.user_auth ALTER COLUMN id SET DEFAULT nextval('public.user_auth_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.user_token ALTER COLUMN id SET DEFAULT nextval('public.user_token_id_seq'::regclass);


--
-- Data for Name: actions; Type: TABLE DATA; Schema: public; Owner: admin
--



--
-- Name: actions_id_seq; Type: SEQUENCE SET; Schema: public; Owner: admin
--

SELECT pg_catalog.setval('public.actions_id_seq', 11, true);


--
-- Data for Name: boat_actions; Type: TABLE DATA; Schema: public; Owner: admin
--



--
-- Data for Name: boat_services; Type: TABLE DATA; Schema: public; Owner: admin
--



--
-- Data for Name: boats; Type: TABLE DATA; Schema: public; Owner: admin
--

INSERT INTO public.boats (id, name, description, price, engine_power, spaciousness, certificate, location, short_description) VALUES (20, 'Riva Rivamare', 'Великолепная яхта Riva Rivamare - это поистинне икона итальянского 
яхтенного бренда Riva. Модель Rivamare  вновь и вновь переписала все каноны элегантости.
Это 40-футовая скоростная моторная яхта сочетает в себе стиль и очарование черт ставших легендарными моделями Aquariva Super и Aquarama, но с супер-современным оборудованием и девайсами в комплектации.
В базовой комплектации Rivamare оснащена двумя двигателями Volvo Penta D6 400
максимальная скорость составляет 40 узлов, при этом круизная скорость составляет 31 узел.', 2500, '2 x Volvo Penta D6 400 л.с.', 8, 'Паспорт единорога', 'Нагатинский затон', 'Великолепная яхта Riva Rivamare - это поистинне икона итальянского 
яхтенного бренда Riva. Модель Rivamare  вновь и вновь переписала все каноны элегантости.
Это 40-футовая скоростная моторная яхта сочетает в себе стиль и очарование черт ставших легендарными моделями Aquariva Super и Aquarama, но с супер-современным оборудованием и девайсами в комплектации.');
INSERT INTO public.boats (id, name, description, price, engine_power, spaciousness, certificate, location, short_description) VALUES (21, 'Ferretti Yachts 450 new', 'Новая модель Ferretti Yachts 450, премьера, которой прошла на Яхтенном фестивале в Каннах в сентябре 2016 года, стала номинантом премии за «Лучший дизайн среди моторных яхт» в категории «Яхты дневного плавания и круизеры», проводимого в рамках Nautic Paris Boat Show 2016.

Ferretti 450  - это самая маленькая яхта в размерном ряду верфи за последние несколько лет.  Будучи эталоном своего размера, Ferretti 450 есть чем гордиться: просторный флайбридж с удобным постом управления по левому борту, большая зона отдыха, удобный минибар, продуманная ложа для загара и тент от солнца - все предназначено для комфортного отдыха.

Внутри - легкий и просторный дизайн. Спокойные приятные тона и качество отделки – отличительная черта бренда Ferretti. Камбуз оборудован всем необходимым и так гармонично вписывается в оригинальный интерьер, что сразу ощущаешь себя словно внутри продуманного дома.

Доступно два варианта планировки нижней палубы – две или три каюты. Широкие глубокие кровати, ортопедические матрасы, в хорошо освещенных каютах создается ощущение спокойствия и отдыха во время путешествия. Не смотря на свои компактные размеры имеет просторный салон и очень удобную мастер-каюту, во всю ширину яхты, с высотой потолков 2 м.

Яхта может быть укомплектована двигателями 480 л.с., либо более мощными Cummins 550 л.с. С мощными двигателями яхта разгоняется до 31 узла, крейсерская скорость составляет 27 узлов, при этом запас хода - 230 морских миль.  ', 5000, '123', 12, 'Нет', 'Красная площадь', 'Новая модель Ferretti Yachts 450, премьера, которой прошла на Яхтенном фестивале в Каннах в сентябре 2016 года, стала номинантом премии за «Лучший дизайн среди моторных яхт» в категории «Яхты дневного плавания и круизеры», проводимого в рамках Nautic Paris Boat Show 2016.');
INSERT INTO public.boats (id, name, description, price, engine_power, spaciousness, certificate, location, short_description) VALUES (22, 'Ferretti Yachts 450 new', 'Новая модель Ferretti Yachts 450, премьера, которой прошла на Яхтенном фестивале в Каннах в сентябре 2016 года, стала номинантом премии за «Лучший дизайн среди моторных яхт» в категории «Яхты дневного плавания и круизеры», проводимого в рамках Nautic Paris Boat Show 2016.

Ferretti 450  - это самая маленькая яхта в размерном ряду верфи за последние несколько лет.  Будучи эталоном своего размера, Ferretti 450 есть чем гордиться: просторный флайбридж с удобным постом управления по левому борту, большая зона отдыха, удобный минибар, продуманная ложа для загара и тент от солнца - все предназначено для комфортного отдыха.

Внутри - легкий и просторный дизайн. Спокойные приятные тона и качество отделки – отличительная черта бренда Ferretti. Камбуз оборудован всем необходимым и так гармонично вписывается в оригинальный интерьер, что сразу ощущаешь себя словно внутри продуманного дома.

Доступно два варианта планировки нижней палубы – две или три каюты. Широкие глубокие кровати, ортопедические матрасы, в хорошо освещенных каютах создается ощущение спокойствия и отдыха во время путешествия. Не смотря на свои компактные размеры имеет просторный салон и очень удобную мастер-каюту, во всю ширину яхты, с высотой потолков 2 м.

Яхта может быть укомплектована двигателями 480 л.с., либо более мощными Cummins 550 л.с. С мощными двигателями яхта разгоняется до 31 узла, крейсерская скорость составляет 27 узлов, при этом запас хода - 230 морских миль.  ', 5000, '123', 12, 'Нет', 'Красная площадь', 'Новая модель Ferretti Yachts 450, премьера, которой прошла на Яхтенном фестивале в Каннах в сентябре 2016 года, стала номинантом премии за «Лучший дизайн среди моторных яхт» в категории «Яхты дневного плавания и круизеры», проводимого в рамках Nautic Paris Boat Show 2016.');


--
-- Name: boats_id_seq; Type: SEQUENCE SET; Schema: public; Owner: admin
--

SELECT pg_catalog.setval('public.boats_id_seq', 22, true);


--
-- Data for Name: cards; Type: TABLE DATA; Schema: public; Owner: admin
--



--
-- Name: cards_id_seq; Type: SEQUENCE SET; Schema: public; Owner: admin
--

SELECT pg_catalog.setval('public.cards_id_seq', 2, true);


--
-- Data for Name: images; Type: TABLE DATA; Schema: public; Owner: admin
--

INSERT INTO public.images (id, path, boat_id) VALUES (18, 'boat1.jpeg', 22);
INSERT INTO public.images (id, path, boat_id) VALUES (17, 'boat6.jpeg', 21);
INSERT INTO public.images (id, path, boat_id) VALUES (16, 'boat5.jpg', 21);
INSERT INTO public.images (id, path, boat_id) VALUES (15, 'boat2.jpg', 20);
INSERT INTO public.images (id, path, boat_id) VALUES (14, 'boat1.jpeg', 20);


--
-- Name: images_id_seq; Type: SEQUENCE SET; Schema: public; Owner: admin
--

SELECT pg_catalog.setval('public.images_id_seq', 18, true);


--
-- Data for Name: migration; Type: TABLE DATA; Schema: public; Owner: admin
--

INSERT INTO public.migration (version, apply_time) VALUES ('m000000_000000_base', 1545400250);
INSERT INTO public.migration (version, apply_time) VALUES ('m150214_044831_init_user', 1545400254);


--
-- Data for Name: notifications; Type: TABLE DATA; Schema: public; Owner: admin
--



--
-- Name: notifications_id_seq; Type: SEQUENCE SET; Schema: public; Owner: admin
--

SELECT pg_catalog.setval('public.notifications_id_seq', 6, true);


--
-- Data for Name: order_services; Type: TABLE DATA; Schema: public; Owner: admin
--



--
-- Data for Name: orders; Type: TABLE DATA; Schema: public; Owner: admin
--



--
-- Name: orders_id_seq; Type: SEQUENCE SET; Schema: public; Owner: admin
--

SELECT pg_catalog.setval('public.orders_id_seq', 21, true);


--
-- Data for Name: profile; Type: TABLE DATA; Schema: public; Owner: admin
--

INSERT INTO public.profile (id, user_id, created_at, updated_at, full_name, timezone) VALUES (1, 1, '2018-12-21 13:50:54', NULL, 'the one', NULL);
INSERT INTO public.profile (id, user_id, created_at, updated_at, full_name, timezone) VALUES (11, 11, '2019-01-30 09:08:49', '2019-01-30 09:08:49', NULL, NULL);


--
-- Name: profile_id_seq; Type: SEQUENCE SET; Schema: public; Owner: admin
--

SELECT pg_catalog.setval('public.profile_id_seq', 11, true);


--
-- Data for Name: promo; Type: TABLE DATA; Schema: public; Owner: admin
--



--
-- Data for Name: promo_history; Type: TABLE DATA; Schema: public; Owner: admin
--



--
-- Name: promo_id_seq; Type: SEQUENCE SET; Schema: public; Owner: admin
--

SELECT pg_catalog.setval('public.promo_id_seq', 2, true);


--
-- Data for Name: role; Type: TABLE DATA; Schema: public; Owner: admin
--

INSERT INTO public.role (id, name, created_at, updated_at, can_admin) VALUES (1, 'Admin', '2018-12-21 13:50:54', NULL, 1);
INSERT INTO public.role (id, name, created_at, updated_at, can_admin) VALUES (2, 'User', '2018-12-21 13:50:54', NULL, 0);


--
-- Name: role_id_seq; Type: SEQUENCE SET; Schema: public; Owner: admin
--

SELECT pg_catalog.setval('public.role_id_seq', 2, true);


--
-- Data for Name: services; Type: TABLE DATA; Schema: public; Owner: admin
--

INSERT INTO public.services (id, name, price) VALUES (1, 'Капитан с бородой и попугаем', 2500);
INSERT INTO public.services (id, name, price) VALUES (2, 'Полный трюм рома', 10000);
INSERT INTO public.services (id, name, price) VALUES (3, 'Чёрный флаг', 200);
INSERT INTO public.services (id, name, price) VALUES (4, 'Отсутствие пробоин', 1000000);
INSERT INTO public.services (id, name, price) VALUES (5, 'Право грабить испанские корабли', 500);


--
-- Name: services_id_seq; Type: SEQUENCE SET; Schema: public; Owner: admin
--

SELECT pg_catalog.setval('public.services_id_seq', 5, true);


--
-- Data for Name: transactions; Type: TABLE DATA; Schema: public; Owner: admin
--



--
-- Name: transactions_id_seq; Type: SEQUENCE SET; Schema: public; Owner: admin
--

SELECT pg_catalog.setval('public.transactions_id_seq', 23, true);


--
-- Data for Name: user; Type: TABLE DATA; Schema: public; Owner: admin
--

INSERT INTO public."user" (id, role_id, status, email, username, password, auth_key, access_token, logged_in_ip, logged_in_at, created_ip, created_at, updated_at, banned_at, banned_reason, phone, mailing, personal_data_processing) VALUES (1, 1, 1, 'neo@neo.com', 'neo', '$2y$13$dyVw4WkZGkABf2UrGWrhHO4ZmVBv.K4puhOL59Y9jQhIdj63TlV.O', 'XBGFwbF8aEFpxVcR6m7jNs1WXBJ0IzWj', 'Hr_Lh07b8WLnlhWcYa6DZkzdAdvnKiWK', '127.0.0.1', '2019-01-30 08:51:31', NULL, '2018-12-21 13:50:54', NULL, NULL, NULL, NULL, 0, 0);
INSERT INTO public."user" (id, role_id, status, email, username, password, auth_key, access_token, logged_in_ip, logged_in_at, created_ip, created_at, updated_at, banned_at, banned_reason, phone, mailing, personal_data_processing) VALUES (11, 2, 1, 'dariyogienko@gmail.com', 'Дарья', '$2y$13$KihQXj48tkEJi5xyIoOSduWQNBUCsdYYrl9gv/vSTwc64hr/xpnyi', 'PA9B-1oBaajNy1gbf6fjuBSJvTjQN-O_', 'fJO1aF_hjbyTnDV29raLSSM_vnN_Jmo7', '127.0.0.1', '2019-01-30 11:54:15', '127.0.0.1', '2019-01-30 09:08:49', '2019-01-30 11:54:02', NULL, NULL, NULL, 0, 1);


--
-- Data for Name: user_auth; Type: TABLE DATA; Schema: public; Owner: admin
--



--
-- Name: user_auth_id_seq; Type: SEQUENCE SET; Schema: public; Owner: admin
--

SELECT pg_catalog.setval('public.user_auth_id_seq', 1, false);


--
-- Name: user_id_seq; Type: SEQUENCE SET; Schema: public; Owner: admin
--

SELECT pg_catalog.setval('public.user_id_seq', 11, true);


--
-- Data for Name: user_token; Type: TABLE DATA; Schema: public; Owner: admin
--



--
-- Name: user_token_id_seq; Type: SEQUENCE SET; Schema: public; Owner: admin
--

SELECT pg_catalog.setval('public.user_token_id_seq', 6, true);


--
-- Name: actions_pk; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.actions
    ADD CONSTRAINT actions_pk PRIMARY KEY (id);


--
-- Name: boats_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.boats
    ADD CONSTRAINT boats_pkey PRIMARY KEY (id);


--
-- Name: cards_pk; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.cards
    ADD CONSTRAINT cards_pk PRIMARY KEY (id);


--
-- Name: images_pk; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.images
    ADD CONSTRAINT images_pk PRIMARY KEY (id);


--
-- Name: migration_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.migration
    ADD CONSTRAINT migration_pkey PRIMARY KEY (version);


--
-- Name: notifications_pk; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.notifications
    ADD CONSTRAINT notifications_pk PRIMARY KEY (id);


--
-- Name: orders_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.orders
    ADD CONSTRAINT orders_pkey PRIMARY KEY (id);


--
-- Name: profile_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.profile
    ADD CONSTRAINT profile_pkey PRIMARY KEY (id);


--
-- Name: promo_pk; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.promo
    ADD CONSTRAINT promo_pk PRIMARY KEY (id);


--
-- Name: role_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.role
    ADD CONSTRAINT role_pkey PRIMARY KEY (id);


--
-- Name: services_pk; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.services
    ADD CONSTRAINT services_pk PRIMARY KEY (id);


--
-- Name: transactions_pk; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.transactions
    ADD CONSTRAINT transactions_pk PRIMARY KEY (id);


--
-- Name: user_auth_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.user_auth
    ADD CONSTRAINT user_auth_pkey PRIMARY KEY (id);


--
-- Name: user_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public."user"
    ADD CONSTRAINT user_pkey PRIMARY KEY (id);


--
-- Name: user_token_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.user_token
    ADD CONSTRAINT user_token_pkey PRIMARY KEY (id);


--
-- Name: user_auth_provider_id; Type: INDEX; Schema: public; Owner: admin
--

CREATE INDEX user_auth_provider_id ON public.user_auth USING btree (provider_id);


--
-- Name: user_email; Type: INDEX; Schema: public; Owner: admin
--

CREATE UNIQUE INDEX user_email ON public."user" USING btree (email);


--
-- Name: user_token_token; Type: INDEX; Schema: public; Owner: admin
--

CREATE UNIQUE INDEX user_token_token ON public.user_token USING btree (token);


--
-- Name: user_username; Type: INDEX; Schema: public; Owner: admin
--

CREATE UNIQUE INDEX user_username ON public."user" USING btree (username);


--
-- Name: profile_user_id; Type: FK CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.profile
    ADD CONSTRAINT profile_user_id FOREIGN KEY (user_id) REFERENCES public."user"(id);


--
-- Name: user_auth_user_id; Type: FK CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.user_auth
    ADD CONSTRAINT user_auth_user_id FOREIGN KEY (user_id) REFERENCES public."user"(id);


--
-- Name: user_role_id; Type: FK CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public."user"
    ADD CONSTRAINT user_role_id FOREIGN KEY (role_id) REFERENCES public.role(id);


--
-- Name: user_token_user_id; Type: FK CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.user_token
    ADD CONSTRAINT user_token_user_id FOREIGN KEY (user_id) REFERENCES public."user"(id);


--
-- Name: SCHEMA public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- PostgreSQL database dump complete
--

