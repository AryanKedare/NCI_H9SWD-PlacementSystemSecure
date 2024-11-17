CREATE TABLE IF NOT EXISTS vacancy
(
    job_id SERIAL NOT NULL,
    company_name text COLLATE pg_catalog."default",
    job_title text COLLATE pg_catalog."default",
    salary integer,
    location text COLLATE pg_catalog."default",
    deadline date,
    bond integer,
    age_e integer,
    degree_e text COLLATE pg_catalog."default",
    cpi_e integer,
    year_e integer,
    twtp_e integer,
    tetp_e integer,
    CONSTRAINT vacancy_pkey PRIMARY KEY (job_id)
);


CREATE TABLE IF NOT EXISTS applications
(
    app_id SERIAL NOT NULL,
    s_mail character varying COLLATE pg_catalog."default",
    c_mail character varying COLLATE pg_catalog."default",
    status character varying COLLATE pg_catalog."default",
    job_id SERIAL NOT NULL,
    CONSTRAINT applications_pkey PRIMARY KEY (app_id),
    CONSTRAINT job_id FOREIGN KEY (job_id)
        REFERENCES public.vacancy (job_id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
        NOT VALID
);

CREATE TABLE IF NOT EXISTS companys
(
    name text COLLATE pg_catalog."default",
    email character varying(20) COLLATE pg_catalog."default" NOT NULL,
    pwd character varying(20) COLLATE pg_catalog."default",
    phone bigint,
    location text COLLATE pg_catalog."default",
    ceo text COLLATE pg_catalog."default",
    cto text COLLATE pg_catalog."default",
    hr text COLLATE pg_catalog."default",
    worth integer,
    found integer,
    founder text COLLATE pg_catalog."default",
    CONSTRAINT companys_pkey PRIMARY KEY (email)
);

CREATE TABLE IF NOT EXISTS students
(
    name text COLLATE pg_catalog."default" NOT NULL,
    email character varying COLLATE pg_catalog."default" NOT NULL,
    dob date,
    branch text COLLATE pg_catalog."default",
    year integer,
    cpi integer,
    twp integer,
    tenp integer,
    pwd text COLLATE pg_catalog."default",
    phone bigint,
    degree text COLLATE pg_catalog."default",
    CONSTRAINT students_pkey PRIMARY KEY (email)
);

CREATE TABLE IF NOT EXISTS admins
(
    name text COLLATE pg_catalog."default",
    pwd text COLLATE pg_catalog."default"
);

INSERT INTO admins values('admin@tpc.com', 'admin123');