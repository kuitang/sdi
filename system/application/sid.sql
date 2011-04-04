-- SQL for sqlite3. Syntax is not compatible with MySQL.

-- Session table for secure sessions.
DROP TABLE IF EXISTS "ci_sessions";
CREATE TABLE "ci_sessions" (
  session_id VARCHAR PRIMARY KEY DEFAULT "0" NOT NULL, 
  ip_address VARCHAR NOT NULL DEFAULT "0", user_agent VARCHAR NOT NULL,
  last_activity INTEGER NOT NULL DEFAULT "0",
  user_data text
);

-- All model tables must follow DataMapper rules at
-- http://stensi.com/datamapper/pages/database.html.
-- In particular, all relationships must be specified in join tables.
DROP TABLE IF EXISTS "users";
CREATE TABLE "users" (
  id        INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
  -- We store timestamps as Unix timestamps, as sqlite3 does not support
  -- the DATETIME type.
  created   INTEGER NOT NULL,
  updated   INTEGER NOT NULL,
  uni       CHAR(7) UNIQUE NOT NULL,
  full_name VARCHAR NOT NULL,
  major     VARCHAR NOT NULL,
  scholar   VARCHAR NOT NULL,
  year      INTEGER NOT NULL,
  password  CHAR(40) NOT NULL,
  -- User must click this link in the email.
  verify_token VARCHAR,
  -- Administrator must activate the account.
  is_active BOOLEAN DEFAULT 0 NOT NULL,
  is_admin  BOOLEAN DEFAULT 0 NOT NULL,
  is_public BOOLEAN DEFAULT 1 NOT NULL,
  bio       TEXT,
  contact   TEXT
);

-- The password is the hash of '12345678'.
INSERT INTO "users" VALUES(1, datetime('now', 'localtime'), datetime('now', 'localtime'), 'kt2384', 'Kui Tang', 'Computer Science', 'Egleston', 2014, '0c484a9b6a5a872aa924bf0475749e16aad84253', NULL, 1, 1, 1, NULL, NULL);
INSERT INTO "users" VALUES(2, datetime('now', 'localtime'), datetime('now', 'localtime'), 'uu1000', 'Unprivileged User', 'Economics', 'C. Prescott Davis', 2012, '0c484a9b6a5a872aa924bf0475749e16aad84253', NULL, 1, 0, 1, NULL, NULL);

DROP TABLE IF EXISTS "approvedunis";
CREATE TABLE "approvedunis" (
  id        INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
  uni       CHAR(7) UNIQUE NOT NULL
);
INSERT INTO "approvedunis" VALUES(1, 'kt2384');
INSERT INTO "approvedunis" VALUES(2, 'uu1000');
INSERT INTO "approvedunis" VALUES(3, 'aa1000');
INSERT INTO "approvedunis" VALUES(4, 'bb1000');

DROP TABLE IF EXISTS "projects";
-- Use FTS3 http://www.sqlite.org/fts3.html#tokenizer for full text search.
-- Very sqlite specific. MySQL handles full text much differently.
-- projects have a rowid.
-- EDIT: Removed FTS3 support due to primary key fail. TODO: Refactor to use
-- a project_texts table. Or just copy to another table for searches.
CREATE TABLE "projects" (
  id            INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
  created       INTEGER NOT NULL, 
  updated       INTEGER NOT NULL, 
  title         VARCHAR NOT NULL,
  start_date    DATETIME,
  end_date      DATETIME,
  text          TEXT NOT NULL,
  show_contact  BOOLEAN NOT NULL DEFAULT 0,
  user_id       INTEGER
);
INSERT INTO "projects" VALUES(1, strftime('%s','now'), strftime('%s','now'), "Project 1", NULL, NULL, "A project about Columbia", 1, 1);
INSERT INTO "projects" VALUES(2, strftime('%s','now'), strftime('%s','now'), "Project 2", NULL, NULL, "A project about NYU", 0, 2);

DROP TABLE IF EXISTS "tags";
CREATE TABLE "tags" (
  id            INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
  name          VARCHAR NOT NULL,
  category      VARCHAR
);
INSERT INTO "tags" (id, name, category) VALUES(1, 'Computer Science', 'field');
INSERT INTO "tags" (id, name, category) VALUES(2, 'Internship', 'type');
INSERT INTO "tags" (id, name, category) VALUES(3, 'New York City', 'location');

INSERT INTO "tags" (name, category) VALUES('Medicine', 'field');
INSERT INTO "tags" (name, category) VALUES('Law', 'field');
INSERT INTO "tags" (name, category) VALUES('Business', 'field');
INSERT INTO "tags" (name, category) VALUES('Research', 'type');
INSERT INTO "tags" (name, category) VALUES('Travel', 'type');
-- INSERT INTO "tags" (name, category) VALUES('New York City', 'location');
INSERT INTO "tags" (name, category) VALUES('San Francisco', 'location');
INSERT INTO "tags" (name, category) VALUES('Beijing', 'location');

DROP TABLE IF EXISTS "projects_tags";
CREATE TABLE "projects_tags" (
  id            INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
  project_id    INTEGER,
  tag_id        INTEGER,
  FOREIGN KEY(tag_id) REFERENCES tags(id),
  FOREIGN KEY(project_id) REFERENCES projects(id)
);

INSERT INTO "projects_tags" VALUES(1, 1, 1);
INSERT INTO "projects_tags" VALUES(2, 1, 2);
INSERT INTO "projects_tags" VALUES(3, 2, 1);
INSERT INTO "projects_tags" VALUES(4, 2, 2);
INSERT INTO "projects_tags" VALUES(5, 3, 1);
INSERT INTO "projects_tags" VALUES(6, 3, 2);

