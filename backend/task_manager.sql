-- Adminer 4.17.1 PostgreSQL 14.5 dump

\connect "task_manager";

DROP TABLE IF EXISTS "migrations";
DROP SEQUENCE IF EXISTS migrations_id_seq;
CREATE SEQUENCE migrations_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "public"."migrations" (
    "id" integer DEFAULT nextval('migrations_id_seq') NOT NULL,
    "migration" character varying(255) NOT NULL,
    "batch" integer NOT NULL,
    CONSTRAINT "migrations_pkey" PRIMARY KEY ("id")
) WITH (oids = false);

INSERT INTO "migrations" ("id", "migration", "batch") VALUES
(4,	'0001_01_01_000000_create_users_table',	1),
(5,	'2025_03_21_142012_create_personal_access_tokens_table',	1),
(6,	'2025_03_21_143044_create_tasks_table',	1);

DROP TABLE IF EXISTS "personal_access_tokens";
DROP SEQUENCE IF EXISTS personal_access_tokens_id_seq;
CREATE SEQUENCE personal_access_tokens_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 9223372036854775807 CACHE 1;

CREATE TABLE "public"."personal_access_tokens" (
    "id" bigint DEFAULT nextval('personal_access_tokens_id_seq') NOT NULL,
    "tokenable_type" character varying(255) NOT NULL,
    "tokenable_id" bigint NOT NULL,
    "name" character varying(255) NOT NULL,
    "token" character varying(64) NOT NULL,
    "abilities" text,
    "last_used_at" timestamp(0),
    "expires_at" timestamp(0),
    "created_at" timestamp(0),
    "updated_at" timestamp(0),
    CONSTRAINT "personal_access_tokens_pkey" PRIMARY KEY ("id"),
    CONSTRAINT "personal_access_tokens_token_unique" UNIQUE ("token")
) WITH (oids = false);

CREATE INDEX "personal_access_tokens_tokenable_type_tokenable_id_index" ON "public"."personal_access_tokens" USING btree ("tokenable_type", "tokenable_id");

INSERT INTO "personal_access_tokens" ("id", "tokenable_type", "tokenable_id", "name", "token", "abilities", "last_used_at", "expires_at", "created_at", "updated_at") VALUES
(1,	 E'App\\Models\\User',	1,	'token',	'ffb1b0f5e3b666b6ceeadd81c3480bfacfd663c9513175f166cc3fdf856a377a',	'["*"]',	NULL,	NULL,	'2025-03-21 18:35:33',	'2025-03-21 18:35:33'),
(2,	 E'App\\Models\\User',	1,	'token',	'ad6c48c3f7f74ed1dec9a93410a6fea1ed22fd56a882694edc14b84c3fcbba89',	'["*"]',	NULL,	NULL,	'2025-03-22 01:49:44',	'2025-03-22 01:49:44'),
(3,	 E'App\\Models\\User',	1,	'token',	'9d72ed6678a921553396ca9ecc44d489d238ac60b22506c3b16e405774573b05',	'["*"]',	NULL,	NULL,	'2025-03-22 01:50:18',	'2025-03-22 01:50:18'),
(4,	 E'App\\Models\\User',	1,	'token',	'61ee5f163a893734783eadc2806a061f393ca6b4f8a0c9bf21826840715824fc',	'["*"]',	NULL,	NULL,	'2025-03-22 02:20:56',	'2025-03-22 02:20:56'),
(5,	 E'App\\Models\\User',	1,	'token',	'4adf5e45dd4b532414e6a6af97f2981eae053f0f6e38210db3fa9b599471052a',	'["*"]',	NULL,	NULL,	'2025-03-22 02:21:36',	'2025-03-22 02:21:36'),
(6,	 E'App\\Models\\User',	1,	'token',	'12222d04d50e20545bb727d5bb41405cd7fbd4dfe6754756bee72f87ed0c3e81',	'["*"]',	NULL,	NULL,	'2025-03-22 03:03:01',	'2025-03-22 03:03:01');

DROP TABLE IF EXISTS "tasks";
DROP SEQUENCE IF EXISTS tasks_id_seq;
CREATE SEQUENCE tasks_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 9223372036854775807 CACHE 1;

CREATE TABLE "public"."tasks" (
    "id" bigint DEFAULT nextval('tasks_id_seq') NOT NULL,
    "title" character varying(255) NOT NULL,
    "description" text,
    "priority" character varying(255) DEFAULT 'Low' NOT NULL,
    "status" character varying(255) DEFAULT 'Pending' NOT NULL,
    "due_date" date,
    "created_at" timestamp(0),
    "updated_at" timestamp(0),
    "deleted_at" timestamp(0),
    CONSTRAINT "tasks_pkey" PRIMARY KEY ("id"),
    CONSTRAINT "tasks_priority_check" CHECK (((priority)::text = ANY ((ARRAY['Low'::character varying, 'Medium'::character varying, 'High'::character varying])::text[]))),
    CONSTRAINT "tasks_status_check" CHECK (((status)::text = ANY ((ARRAY['Pending'::character varying, 'Completed'::character varying])::text[])))
) WITH (oids = false);

INSERT INTO "tasks" ("id", "title", "description", "priority", "status", "due_date", "created_at", "updated_at", "deleted_at") VALUES
(8,	'title',	'desc',	'Medium',	'Completed',	NULL,	'2025-03-21 17:41:13',	'2025-03-22 03:01:46',	NULL),
(10,	'titel',	'desc',	'Low',	'Pending',	NULL,	'2025-03-22 03:02:20',	'2025-03-22 03:02:20',	NULL),
(2,	'title',	'desc',	'High',	'Pending',	NULL,	NULL,	'2025-03-22 03:24:27',	NULL);

DROP TABLE IF EXISTS "users";
DROP SEQUENCE IF EXISTS users_id_seq;
CREATE SEQUENCE users_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 9223372036854775807 CACHE 1;

CREATE TABLE "public"."users" (
    "id" bigint DEFAULT nextval('users_id_seq') NOT NULL,
    "username" character varying(64) NOT NULL,
    "email" character varying(64) NOT NULL,
    "password" character varying(255) NOT NULL,
    "created_at" timestamp(0),
    "updated_at" timestamp(0),
    "deleted_at" timestamp(0),
    CONSTRAINT "users_pkey" PRIMARY KEY ("id")
) WITH (oids = false);

INSERT INTO "users" ("id", "username", "email", "password", "created_at", "updated_at", "deleted_at") VALUES
(1,	'admin',	'admin@gmail.com',	'$2y$12$6hJxVcjXK0JTOEKptlpl5O0HC3fIMqMC38kdNeZGted/x86.n7DNC',	'2025-03-21 18:35:32',	'2025-03-21 18:35:32',	NULL);

-- 2025-03-22 09:59:57.620312+06:30
