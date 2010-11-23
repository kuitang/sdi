-- SQL for sqlite3. Syntax is not compatible with MySQL.

-- Session table for secure sessions.
DROP TABLE IF EXISTS "ci_sessions";
CREATE TABLE "ci_sessions" (
  session_id VARCHAR PRIMARY KEY DEFAULT "0" NOT NULL, 
  ip_address VARCHAR NOT NULL DEFAULT "0",
  user_agent VARCHAR NOT NULL,
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
  year      INTEGER NOT NULL,
  password  CHAR(40) NOT NULL,
  -- User must click this link in the email.
  verify_token VARCHAR,
  -- Administrator must activate the account.
  is_active BOOLEAN DEFAULT FALSE NOT NULL,
  is_admin  BOOLEAN DEFAULT FALSE NOT NULL,
  is_public BOOLEAN DEFAULT TRUE NOT NULL,
  bio       TEXT,
  contact   TEXT
);

-- The password is the hash of '12345678'.
INSERT INTO "users" VALUES(1, datetime('now', 'localtime'), datetime('now', 'localtime'), 'kt2384', 'Kui Tang', 'Computer Science', 2014, '0c484a9b6a5a872aa924bf0475749e16aad84253', NULL, 1, 1, 1, NULL, NULL);
INSERT INTO "users" VALUES(2, datetime('now', 'localtime'), datetime('now', 'localtime'), 'uu1000', 'Unprivileged User', 'Economics', 2012, '0c484a9b6a5a872aa924bf0475749e16aad84253', NULL, 1, 0, 1, NULL, NULL);

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
CREATE TABLE "projects" (
  id            INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
  created       INTEGER NOT NULL,
  updated       INTEGER NOT NULL,
  title         VARCHAR NOT NULL,
  start_date    DATETIME,
  end_date      DATETIME,
  location_lat  REAL NOT NULL,
  location_lon  REAL NOT NULL
);
INSERT INTO "projects" VALUES(1, datetime('now', 'localtime'), datetime('now', 'localtime'), "Project 1", NULL, NULL, 40.807524, -73.964231);
INSERT INTO "projects" VALUES(2, datetime('now', 'localtime'), datetime('now', 'localtime'), "Project 2", NULL, NULL, 40.75388918270174, -73.98163318634033);
-- Very sqlite specific. MySQL handles full text much differently.
DROP TABLE IF EXISTS "projecttexts";

-- Use FTS3 http://www.sqlite.org/fts3.html#tokenizer for full text search.
CREATE VIRTUAL TABLE "projecttexts" USING fts3(
-- The Porter stemming algorithm should improve results of inflections. If that
-- doesn't work we could always switch back to simple.
  tokenize=porter,
  id            INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
  -- sqlite3 ignores the type for the second column 
  text          TEXT NOT NULL;
);
INSERT INTO "projecttexts" VALUES(1, "A project about Columbia");
INSERT INTO "projecttexts" VALUES(2, "A project about NYU");

DROP TABLE IF EXISTS "projects_projecttexts";
CREATE TABLE "projects_projecttexts" (
  id            INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
  project_id    INTEGER,
  projecttext_id INTEGER,
  FOREIGN KEY(project_id) REFERENCES projects(id),
  FOREIGN KEY(projecttext_id) REFERENCES projecttexts(id)
);
INSERT INTO "projects_projecttexts" VALUES(1, 1, 1);
INSERT INTO "projects_projecttexts" VALUES(2, 2, 2);

DROP TABLE IF EXISTS "projects_users";
CREATE TABLE "projects_users" (
  id            INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
  user_id       INTEGER NOT NULL,
  project_id    INTEGER NOT NULL,
  FOREIGN KEY(user_id) REFERENCES users(id),
  FOREIGN KEY(project_id) REFERENCES projects(id)
);

INSERT INTO "projects_users" VALUES(1, 1, 1);
INSERT INTO "projects_users" VALUES(2, 2, 2);

DROP TABLE IF EXISTS "tags";
CREATE TABLE "tags" (
  id            INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
  name          VARCHAR NOT NULL,
  category      VARCHAR
);
INSERT INTO "tags" (id, name, category) VALUES(1, 'test', 'field');
INSERT INTO "tags" (id, name, category) VALUES(2, 'debug', 'type');
INSERT INTO "tags" (id, name, category) VALUES(3, 'nyc', 'location');

DROP TABLE IF EXISTS "projects_tags";
CREATE TABLE "projects_tags" (
  id            INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
  tag_id        INTEGER,
  project_id    INTEGER,
  FOREIGN KEY(tag_id) REFERENCES tags(id),
  FOREIGN KEY(project_id) REFERENCES projects(id)
);

INSERT INTO "projects_tags" VALUES(1, 1, 1);
INSERT INTO "projects_tags" VALUES(2, 1, 2);
INSERT INTO "projects_tags" VALUES(3, 2, 1);
INSERT INTO "projects_tags" VALUES(4, 2, 2);
INSERT INTO "projects_tags" VALUES(5, 3, 1);
INSERT INTO "projects_tags" VALUES(6, 3, 2);

