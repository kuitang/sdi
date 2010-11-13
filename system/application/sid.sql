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

-- Very sqlite specific. MySQL handles full text much differently.
DROP TABLE IF EXISTS "projecttexts";

-- Use FTS3 http://www.sqlite.org/fts3.html#tokenizer for full text search.
CREATE VIRTUAL TABLE "projecttexts" USING fts3(
-- The Porter stemming algorithm should improve results of inflections. If that
-- doesn't work we could always switch back to simple.
  tokenize=porter,
  id            INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
  -- sqlite3 ignores the type for the second column 
  text          TEXT
);

DROP TABLE IF EXISTS "projecttexts_projects";
CREATE TABLE "projecttexts_projects" (
  id            INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
  project_id    INTEGER,
  projecttext_id INTEGER,
  FOREIGN KEY(project_id) REFERENCES projects(id),
  FOREIGN KEY(projecttext_id) REFERENCES projecttexts(id)
);

DROP TABLE IF EXISTS "users_projects";
CREATE TABLE "users_projects" (
  id            INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
  user_id       INTEGER NOT NULL,
  project_id    INTEGER NOT NULL,
  FOREIGN KEY(user_id) REFERENCES users(id),
  FOREIGN KEY(project_id) REFERENCES projects(id)
);

DROP TABLE IF EXISTS "tags";
CREATE TABLE "tags" (
  id            INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
  name          VARCHAR NOT NULL,
  category      VARCHAR
);
INSERT INTO "tags" (name, category) VALUES('kui', 'debug');
INSERT INTO "tags" (name, category) VALUES('o', 'debug');
DROP TABLE IF EXISTS "tags_projects";
CREATE TABLE "tags_projects" (
  id            INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
  tag_id        INTEGER,
  project_id    INTEGER,
  FOREIGN KEY(tag_id) REFERENCES tags(id),
  FOREIGN KEY(project_id) REFERENCES projects(id)
);



