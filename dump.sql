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

SET default_tablespace = '';

SET default_with_oids = false;

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
-- Name: migration; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.migration (
    version character varying(180) NOT NULL,
    apply_time integer
);


ALTER TABLE public.migration OWNER TO admin;

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
    datetime_to timestamp without time zone
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
    count integer
);


ALTER TABLE public.promo OWNER TO admin;

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

ALTER TABLE ONLY public.boats ALTER COLUMN id SET DEFAULT nextval('public.boats_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.cards ALTER COLUMN id SET DEFAULT nextval('public.cards_id_seq'::regclass);


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
-- Data for Name: boats; Type: TABLE DATA; Schema: public; Owner: admin
--

INSERT INTO public.boats (id, name, description, price, engine_power, spaciousness, certificate, location, short_description) VALUES (4, 'Ark Venture', 'Ark Venture – одно из самых новых приобретений мальдивского флота. Яхта была спущена на воду в конце 2011 г. и приступила к коммерческой деятельности в 2012 г. Яхта позиционируется, как лакшери. Красивые интерьеры и качественная отделка, а также статус новой яхты позволяют ее включить в список самых лучших коммерческих кораблей Мальдив. С 2013 г. сроком на 2 года яхта была включена в флот Canstellation под новым именем Virgo. Английский менеджмент в управлении дает гарантию хорошего сервиса и обслуживания яхты. Можно оценить яхту на 5*.', 1250, '500 лс', 13, 'паспорт единорога', 'Нагатинский затон', 'Последние несколько лет стали для России и ее граждан тяжелым испытанием.
                        Падение цен на нефть, международные санкции и разрыв экономических связей с развитыми странами Запада
                        сильно ударили по экспортно-ориентированной экономике нашей страны.');
INSERT INTO public.boats (id, name, description, price, engine_power, spaciousness, certificate, location, short_description) VALUES (3, 'Ark Venture', 'Ark Venture – одно из самых новых приобретений мальдивского флота. Яхта была спущена на воду в конце 2011 г. и приступила к коммерческой деятельности в 2012 г. Яхта позиционируется, как лакшери. Красивые интерьеры и качественная отделка, а также статус новой яхты позволяют ее включить в список самых лучших коммерческих кораблей Мальдив. С 2013 г. сроком на 2 года яхта была включена в флот Canstellation под новым именем Virgo. Английский менеджмент в управлении дает гарантию хорошего сервиса и обслуживания яхты. Можно оценить яхту на 5*.', 1250, '500 лс', 13, 'паспорт единорога', 'Нагатинский затон', 'Последние несколько лет стали для России и ее граждан тяжелым испытанием.
                        Падение цен на нефть, международные санкции и разрыв экономических связей с развитыми странами Запада
                        сильно ударили по экспортно-ориентированной экономике нашей страны.');
INSERT INTO public.boats (id, name, description, price, engine_power, spaciousness, certificate, location, short_description) VALUES (2, 'Ark Venture', 'Ark Venture – одно из самых новых приобретений мальдивского флота. Яхта была спущена на воду в конце 2011 г. и приступила к коммерческой деятельности в 2012 г. Яхта позиционируется, как лакшери. Красивые интерьеры и качественная отделка, а также статус новой яхты позволяют ее включить в список самых лучших коммерческих кораблей Мальдив. С 2013 г. сроком на 2 года яхта была включена в флот Canstellation под новым именем Virgo. Английский менеджмент в управлении дает гарантию хорошего сервиса и обслуживания яхты. Можно оценить яхту на 5*.', 1250, '500 лс', 13, 'паспорт единорога', 'Нагатинский затон', 'Последние несколько лет стали для России и ее граждан тяжелым испытанием.
                        Падение цен на нефть, международные санкции и разрыв экономических связей с развитыми странами Запада
                        сильно ударили по экспортно-ориентированной экономике нашей страны.');
INSERT INTO public.boats (id, name, description, price, engine_power, spaciousness, certificate, location, short_description) VALUES (1, 'Ark Venture', 'Ark Venture – одно из самых новых приобретений мальдивского флота. Яхта была спущена на воду в конце 2011 г. и приступила к коммерческой деятельности в 2012 г. Яхта позиционируется, как лакшери. Красивые интерьеры и качественная отделка, а также статус новой яхты позволяют ее включить в список самых лучших коммерческих кораблей Мальдив. С 2013 г. сроком на 2 года яхта была включена в флот Canstellation под новым именем Virgo. Английский менеджмент в управлении дает гарантию хорошего сервиса и обслуживания яхты. Можно оценить яхту на 5*.', 1250, '500 лс', 13, 'паспорт единорога', 'Нагатинский затон', 'Последние несколько лет стали для России и ее граждан тяжелым испытанием.
                        Падение цен на нефть, международные санкции и разрыв экономических связей с развитыми странами Запада
                        сильно ударили по экспортно-ориентированной экономике нашей страны.');


--
-- Name: boats_id_seq; Type: SEQUENCE SET; Schema: public; Owner: admin
--

SELECT pg_catalog.setval('public.boats_id_seq', 4, true);


--
-- Data for Name: cards; Type: TABLE DATA; Schema: public; Owner: admin
--

INSERT INTO public.cards (id, number, type, state, user_id) VALUES (1, '****1234', 'MASTERCARD', 0, 1);
INSERT INTO public.cards (id, number, type, state, user_id) VALUES (2, '****4567', 'VISA', 1, 1);


--
-- Name: cards_id_seq; Type: SEQUENCE SET; Schema: public; Owner: admin
--

SELECT pg_catalog.setval('public.cards_id_seq', 2, true);


--
-- Data for Name: migration; Type: TABLE DATA; Schema: public; Owner: admin
--

INSERT INTO public.migration (version, apply_time) VALUES ('m000000_000000_base', 1545400250);
INSERT INTO public.migration (version, apply_time) VALUES ('m150214_044831_init_user', 1545400254);


--
-- Data for Name: order_services; Type: TABLE DATA; Schema: public; Owner: admin
--

INSERT INTO public.order_services (order_id, service_id) VALUES (NULL, NULL);
INSERT INTO public.order_services (order_id, service_id) VALUES (NULL, NULL);
INSERT INTO public.order_services (order_id, service_id) VALUES (NULL, NULL);
INSERT INTO public.order_services (order_id, service_id) VALUES (NULL, NULL);
INSERT INTO public.order_services (order_id, service_id) VALUES (NULL, NULL);
INSERT INTO public.order_services (order_id, service_id) VALUES (NULL, NULL);
INSERT INTO public.order_services (order_id, service_id) VALUES (NULL, NULL);
INSERT INTO public.order_services (order_id, service_id) VALUES (NULL, NULL);
INSERT INTO public.order_services (order_id, service_id) VALUES (NULL, NULL);
INSERT INTO public.order_services (order_id, service_id) VALUES (NULL, NULL);
INSERT INTO public.order_services (order_id, service_id) VALUES (NULL, NULL);
INSERT INTO public.order_services (order_id, service_id) VALUES (NULL, NULL);
INSERT INTO public.order_services (order_id, service_id) VALUES (NULL, NULL);
INSERT INTO public.order_services (order_id, service_id) VALUES (NULL, NULL);
INSERT INTO public.order_services (order_id, service_id) VALUES (NULL, NULL);
INSERT INTO public.order_services (order_id, service_id) VALUES (NULL, NULL);
INSERT INTO public.order_services (order_id, service_id) VALUES (NULL, NULL);
INSERT INTO public.order_services (order_id, service_id) VALUES (NULL, NULL);
INSERT INTO public.order_services (order_id, service_id) VALUES (NULL, NULL);
INSERT INTO public.order_services (order_id, service_id) VALUES (NULL, NULL);
INSERT INTO public.order_services (order_id, service_id) VALUES (NULL, NULL);
INSERT INTO public.order_services (order_id, service_id) VALUES (NULL, NULL);
INSERT INTO public.order_services (order_id, service_id) VALUES (NULL, NULL);
INSERT INTO public.order_services (order_id, service_id) VALUES (NULL, NULL);
INSERT INTO public.order_services (order_id, service_id) VALUES (NULL, NULL);
INSERT INTO public.order_services (order_id, service_id) VALUES (NULL, NULL);
INSERT INTO public.order_services (order_id, service_id) VALUES (NULL, NULL);
INSERT INTO public.order_services (order_id, service_id) VALUES (NULL, NULL);
INSERT INTO public.order_services (order_id, service_id) VALUES (5, 1);
INSERT INTO public.order_services (order_id, service_id) VALUES (5, 5);
INSERT INTO public.order_services (order_id, service_id) VALUES (5, 4);
INSERT INTO public.order_services (order_id, service_id) VALUES (6, 1);
INSERT INTO public.order_services (order_id, service_id) VALUES (6, 3);
INSERT INTO public.order_services (order_id, service_id) VALUES (10, 1);
INSERT INTO public.order_services (order_id, service_id) VALUES (10, 3);


--
-- Data for Name: orders; Type: TABLE DATA; Schema: public; Owner: admin
--

INSERT INTO public.orders (id, user_id, boat_id, datetime_create, is_paid, is_book, price, card_id, offer_processing, promo_id, discount, datetime_from, datetime_to) VALUES (1, 1, 1, '2018-12-21 15:25:00.180242', 1, 0, 50000, NULL, 0, 0, 0, NULL, NULL);
INSERT INTO public.orders (id, user_id, boat_id, datetime_create, is_paid, is_book, price, card_id, offer_processing, promo_id, discount, datetime_from, datetime_to) VALUES (2, 1, 1, '2018-12-22 04:29:31.578482', 0, 1, 23456, NULL, 0, 0, 0, NULL, NULL);
INSERT INTO public.orders (id, user_id, boat_id, datetime_create, is_paid, is_book, price, card_id, offer_processing, promo_id, discount, datetime_from, datetime_to) VALUES (4, 1, 1, '2018-12-31 20:21:27.237777', 0, 0, 1250, NULL, 0, 0, 0, NULL, NULL);
INSERT INTO public.orders (id, user_id, boat_id, datetime_create, is_paid, is_book, price, card_id, offer_processing, promo_id, discount, datetime_from, datetime_to) VALUES (3, 1, 1, '2018-12-30 18:27:16.849654', 0, 0, 1250, NULL, 0, 0, 0, NULL, NULL);
INSERT INTO public.orders (id, user_id, boat_id, datetime_create, is_paid, is_book, price, card_id, offer_processing, promo_id, discount, datetime_from, datetime_to) VALUES (5, 1, 1, '2019-01-01 15:12:00.727471', 0, 0, 12000, NULL, 0, 1, 100, NULL, NULL);
INSERT INTO public.orders (id, user_id, boat_id, datetime_create, is_paid, is_book, price, card_id, offer_processing, promo_id, discount, datetime_from, datetime_to) VALUES (6, 1, 4, '2019-01-04 16:26:46.201306', 0, 0, 0, NULL, 0, 0, 0, NULL, NULL);
INSERT INTO public.orders (id, user_id, boat_id, datetime_create, is_paid, is_book, price, card_id, offer_processing, promo_id, discount, datetime_from, datetime_to) VALUES (7, 1, 4, '2019-01-05 08:16:49.214822', 0, 0, 0, NULL, 0, 0, 0, NULL, NULL);
INSERT INTO public.orders (id, user_id, boat_id, datetime_create, is_paid, is_book, price, card_id, offer_processing, promo_id, discount, datetime_from, datetime_to) VALUES (8, 1, 3, '2019-01-05 08:21:38.637592', 0, 0, 0, NULL, 0, 0, 0, NULL, NULL);
INSERT INTO public.orders (id, user_id, boat_id, datetime_create, is_paid, is_book, price, card_id, offer_processing, promo_id, discount, datetime_from, datetime_to) VALUES (9, 1, 3, '2019-01-08 08:44:33.983584', 0, 0, 0, NULL, 0, 0, 0, NULL, NULL);
INSERT INTO public.orders (id, user_id, boat_id, datetime_create, is_paid, is_book, price, card_id, offer_processing, promo_id, discount, datetime_from, datetime_to) VALUES (10, 1, 4, '2019-01-09 18:40:13.265901', 0, 0, 0, NULL, 0, 1, 100, NULL, NULL);
INSERT INTO public.orders (id, user_id, boat_id, datetime_create, is_paid, is_book, price, card_id, offer_processing, promo_id, discount, datetime_from, datetime_to) VALUES (11, 1, 4, '2019-01-09 19:07:51.019485', 0, 0, 0, NULL, 0, 0, 0, NULL, NULL);
INSERT INTO public.orders (id, user_id, boat_id, datetime_create, is_paid, is_book, price, card_id, offer_processing, promo_id, discount, datetime_from, datetime_to) VALUES (12, 1, 4, '2019-01-09 19:10:03.247317', 0, 0, 0, NULL, 0, 0, 0, NULL, NULL);
INSERT INTO public.orders (id, user_id, boat_id, datetime_create, is_paid, is_book, price, card_id, offer_processing, promo_id, discount, datetime_from, datetime_to) VALUES (13, 1, 4, '2019-01-09 19:10:31.147896', 0, 0, 2500, NULL, 0, 0, 0, '2019-01-11 11:01:00', '2019-01-11 13:01:00');


--
-- Name: orders_id_seq; Type: SEQUENCE SET; Schema: public; Owner: admin
--

SELECT pg_catalog.setval('public.orders_id_seq', 13, true);


--
-- Data for Name: profile; Type: TABLE DATA; Schema: public; Owner: admin
--

INSERT INTO public.profile (id, user_id, created_at, updated_at, full_name, timezone) VALUES (1, 1, '2018-12-21 13:50:54', NULL, 'the one', NULL);
INSERT INTO public.profile (id, user_id, created_at, updated_at, full_name, timezone) VALUES (2, 2, '2018-12-23 13:28:31', '2018-12-23 13:28:31', NULL, NULL);
INSERT INTO public.profile (id, user_id, created_at, updated_at, full_name, timezone) VALUES (3, 3, '2018-12-23 13:37:52', '2018-12-23 13:37:52', NULL, NULL);
INSERT INTO public.profile (id, user_id, created_at, updated_at, full_name, timezone) VALUES (4, 4, '2018-12-23 13:41:14', '2018-12-23 13:41:14', NULL, NULL);
INSERT INTO public.profile (id, user_id, created_at, updated_at, full_name, timezone) VALUES (5, 5, '2018-12-23 14:53:24', '2018-12-23 14:53:24', NULL, NULL);
INSERT INTO public.profile (id, user_id, created_at, updated_at, full_name, timezone) VALUES (6, 6, '2018-12-23 15:01:30', '2018-12-23 15:01:30', NULL, NULL);


--
-- Name: profile_id_seq; Type: SEQUENCE SET; Schema: public; Owner: admin
--

SELECT pg_catalog.setval('public.profile_id_seq', 6, true);


--
-- Data for Name: promo; Type: TABLE DATA; Schema: public; Owner: admin
--

INSERT INTO public.promo (id, word, count) VALUES (1, '123', 100);


--
-- Name: promo_id_seq; Type: SEQUENCE SET; Schema: public; Owner: admin
--

SELECT pg_catalog.setval('public.promo_id_seq', 1, true);


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

INSERT INTO public.transactions (id, card_id, datetime_create, state, order_id, user_id, total_price) VALUES (2, 2, '2018-12-22 15:13:17.491839', 1, 1, 1, 0);
INSERT INTO public.transactions (id, card_id, datetime_create, state, order_id, user_id, total_price) VALUES (1, 1, '2018-12-22 15:13:07.327306', -1, 1, 1, 0);
INSERT INTO public.transactions (id, card_id, datetime_create, state, order_id, user_id, total_price) VALUES (3, NULL, '2019-01-04 13:48:09.608434', 0, 5, 1, 1014900);
INSERT INTO public.transactions (id, card_id, datetime_create, state, order_id, user_id, total_price) VALUES (4, NULL, '2019-01-04 13:48:11.197604', 0, 5, 1, 1014900);
INSERT INTO public.transactions (id, card_id, datetime_create, state, order_id, user_id, total_price) VALUES (5, NULL, '2019-01-04 13:50:51.584173', 0, 5, 1, 1014900);
INSERT INTO public.transactions (id, card_id, datetime_create, state, order_id, user_id, total_price) VALUES (6, NULL, '2019-01-04 13:50:56.929691', 0, 5, 1, 1014900);
INSERT INTO public.transactions (id, card_id, datetime_create, state, order_id, user_id, total_price) VALUES (7, NULL, '2019-01-04 13:50:58.624827', 0, 5, 1, 1014900);
INSERT INTO public.transactions (id, card_id, datetime_create, state, order_id, user_id, total_price) VALUES (8, NULL, '2019-01-04 13:51:10.08154', 0, 5, 1, 1014900);
INSERT INTO public.transactions (id, card_id, datetime_create, state, order_id, user_id, total_price) VALUES (9, NULL, '2019-01-04 13:51:13.893464', 0, 5, 1, 1014900);
INSERT INTO public.transactions (id, card_id, datetime_create, state, order_id, user_id, total_price) VALUES (10, NULL, '2019-01-04 13:51:21.732497', 0, 5, 1, 1014900);
INSERT INTO public.transactions (id, card_id, datetime_create, state, order_id, user_id, total_price) VALUES (11, NULL, '2019-01-04 13:51:47.274204', 0, 5, 1, 1014900);
INSERT INTO public.transactions (id, card_id, datetime_create, state, order_id, user_id, total_price) VALUES (12, NULL, '2019-01-04 13:51:48.190532', 0, 5, 1, 1014900);
INSERT INTO public.transactions (id, card_id, datetime_create, state, order_id, user_id, total_price) VALUES (13, NULL, '2019-01-04 13:51:48.271826', 0, 5, 1, 1014900);
INSERT INTO public.transactions (id, card_id, datetime_create, state, order_id, user_id, total_price) VALUES (14, NULL, '2019-01-05 08:16:41.029014', 0, 6, 1, 2700);
INSERT INTO public.transactions (id, card_id, datetime_create, state, order_id, user_id, total_price) VALUES (15, NULL, '2019-01-05 08:16:41.904962', 0, 6, 1, 2700);
INSERT INTO public.transactions (id, card_id, datetime_create, state, order_id, user_id, total_price) VALUES (16, NULL, '2019-01-05 08:16:41.953567', 0, 6, 1, 2700);
INSERT INTO public.transactions (id, card_id, datetime_create, state, order_id, user_id, total_price) VALUES (17, NULL, '2019-01-05 08:22:35.862847', 0, 8, 1, 0);
INSERT INTO public.transactions (id, card_id, datetime_create, state, order_id, user_id, total_price) VALUES (18, NULL, '2019-01-09 18:59:47.933004', 0, 10, 1, 2600);
INSERT INTO public.transactions (id, card_id, datetime_create, state, order_id, user_id, total_price) VALUES (19, NULL, '2019-01-09 18:59:49.085821', 0, 10, 1, 2600);
INSERT INTO public.transactions (id, card_id, datetime_create, state, order_id, user_id, total_price) VALUES (20, NULL, '2019-01-09 18:59:49.140061', 0, 10, 1, 2600);


--
-- Name: transactions_id_seq; Type: SEQUENCE SET; Schema: public; Owner: admin
--

SELECT pg_catalog.setval('public.transactions_id_seq', 20, true);


--
-- Data for Name: user; Type: TABLE DATA; Schema: public; Owner: admin
--

INSERT INTO public."user" (id, role_id, status, email, username, password, auth_key, access_token, logged_in_ip, logged_in_at, created_ip, created_at, updated_at, banned_at, banned_reason, phone, mailing, personal_data_processing) VALUES (2, 2, 0, 'dasha@mail.ru', 'dasha', '$2y$13$z7k5RWVkRvqMAnSCn2zRce.KoqNKGeHyR0ACeMnvk7PL3Ex83uKbe', 'ocoLVtgNM5kXWfNlnHn54bQabboYgmmf', 'kXZrXPiJzYVfoxGKabZ4LxT9veWrlU6r', NULL, NULL, '127.0.0.1', '2018-12-23 13:28:31', '2018-12-23 13:28:31', NULL, NULL, NULL, 0, 0);
INSERT INTO public."user" (id, role_id, status, email, username, password, auth_key, access_token, logged_in_ip, logged_in_at, created_ip, created_at, updated_at, banned_at, banned_reason, phone, mailing, personal_data_processing) VALUES (3, 2, 0, 'dasha1@mail.ru', 'dasha1', '$2y$13$yoo2UmqoSPQ0qiIw8dMFh.aKw2s8MI.BMGRY0NLDuAigzUvoSbAgS', 'B8MDokeQ6pUMUBvtxhUGe7XljouaPHDC', 'FS6CD3g7bssuP5uwnK-XXgq084SwDay-', NULL, NULL, '127.0.0.1', '2018-12-23 13:37:52', '2018-12-23 13:37:52', NULL, NULL, NULL, 0, 0);
INSERT INTO public."user" (id, role_id, status, email, username, password, auth_key, access_token, logged_in_ip, logged_in_at, created_ip, created_at, updated_at, banned_at, banned_reason, phone, mailing, personal_data_processing) VALUES (4, 2, 0, 'dasha2@mail.ru', 'dasha2', '$2y$13$asBOijDHbKX69qmFPqJy/u6plWaoIilnRCQGlJY4DS7MNQKr2IX..', '3fcvy_4bkOClUkdbaC9lo4ThCaLIqyrN', 'c6VelzbS7mbG7xbxZOWXMCs_0qjz1KWe', '127.0.0.1', '2018-12-23 14:44:02', '127.0.0.1', '2018-12-23 13:41:14', '2018-12-23 13:41:14', NULL, NULL, NULL, 0, 0);
INSERT INTO public."user" (id, role_id, status, email, username, password, auth_key, access_token, logged_in_ip, logged_in_at, created_ip, created_at, updated_at, banned_at, banned_reason, phone, mailing, personal_data_processing) VALUES (5, 2, 0, 'ccccc@dd.er', 'ccc', '$2y$13$t1XCO8GvsVsPNmWVDttgDeHGfR3Cl23EqF9yWjkvb/gaKOsy9FVK.', '-18gRl2yLo5LDvq9GMJHKzoWLg7NfD7t', 'iVUYBfyhBy9MTt-XO0hWnNnn11GPyT8b', '127.0.0.1', '2018-12-23 14:53:24', '127.0.0.1', '2018-12-23 14:53:24', '2018-12-23 14:53:24', NULL, NULL, NULL, 0, 0);
INSERT INTO public."user" (id, role_id, status, email, username, password, auth_key, access_token, logged_in_ip, logged_in_at, created_ip, created_at, updated_at, banned_at, banned_reason, phone, mailing, personal_data_processing) VALUES (6, 2, 0, 'cccc@dd.ty', 'xccc', '$2y$13$xvFfluyDBm6IvWbFe8un3u0hD6prvjMHAmN0CEYl8guhkfHTxqsKa', 'YBbi3eWSEIiTahrKlYYXUhE3YmYyKkUs', 'dOG0XVHZrXUl0MIULVdUIKCzK7VjgUFY', '127.0.0.1', '2018-12-24 17:16:28', '127.0.0.1', '2018-12-23 15:01:30', '2018-12-23 15:01:30', NULL, NULL, NULL, 1, 1);
INSERT INTO public."user" (id, role_id, status, email, username, password, auth_key, access_token, logged_in_ip, logged_in_at, created_ip, created_at, updated_at, banned_at, banned_reason, phone, mailing, personal_data_processing) VALUES (1, 1, 1, 'neo@neo.com', 'neo', '$2y$13$dyVw4WkZGkABf2UrGWrhHO4ZmVBv.K4puhOL59Y9jQhIdj63TlV.O', 'XBGFwbF8aEFpxVcR6m7jNs1WXBJ0IzWj', 'Hr_Lh07b8WLnlhWcYa6DZkzdAdvnKiWK', '127.0.0.1', '2019-01-09 15:37:51', NULL, '2018-12-21 13:50:54', NULL, NULL, NULL, NULL, 0, 0);


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

SELECT pg_catalog.setval('public.user_id_seq', 6, true);


--
-- Data for Name: user_token; Type: TABLE DATA; Schema: public; Owner: admin
--

INSERT INTO public.user_token (id, user_id, type, token, data, created_at, expired_at) VALUES (1, 2, 1, 'VbCzFUVeofcbBMfmWwIWetVXaMTzXNkO', NULL, '2018-12-23 13:28:31', NULL);
INSERT INTO public.user_token (id, user_id, type, token, data, created_at, expired_at) VALUES (2, 3, 1, '8h94rK00UEPBM0dC1uok2hq1ZohGCgl-', NULL, '2018-12-23 13:37:52', NULL);


--
-- Name: user_token_id_seq; Type: SEQUENCE SET; Schema: public; Owner: admin
--

SELECT pg_catalog.setval('public.user_token_id_seq', 2, true);


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
-- Name: migration_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.migration
    ADD CONSTRAINT migration_pkey PRIMARY KEY (version);


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
-- PostgreSQL database dump complete
--

