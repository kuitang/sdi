-- SQL for sqlite3

DROP TABLE IF EXISTS "ci_sessions";
CREATE TABLE "ci_sessions" (
  session_id VARCHAR PRIMARY KEY DEFAULT "0" NOT NULL, 
  ip_address VARCHAR NOT NULL DEFAULT "0",
  user_agent VARCHAR NOT NULL,
  last_activity INTEGER NOT NULL DEFAULT "0",
  user_data text
);

DROP TABLE IF EXISTS "users";
CREATE TABLE "users" (
  uni       CHAR(7) PRIMARY KEY NOT NULL,
  full_name VARCHAR NOT NULL,
  major     VARCHAR NOT NULL,
  year      INTEGER NOT NULL,
  password  CHAR(40) NOT NULL,
  admin     BOOLEAN DEFAULT FALSE NOT NULL,
  public_profile BOOLEAN DEFAULT TRUE NOT NULL,
  bio       TEXT,
  contact   TEXT
);

