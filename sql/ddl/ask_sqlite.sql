--
-- Creating a sample table.
--



--
-- Table Ask
--
DROP TABLE IF EXISTS Ask;
CREATE TABLE Ask (
    "id" INTEGER PRIMARY KEY NOT NULL,
    "title" TEXT NOT NULL,
    "question" TEXT,
    "askerId" INTEGER NOT NULL,
    "created" TIMESTAMP
);

DROP TABLE IF EXISTS Response;
CREATE TABLE Response(
    "id" INTEGER PRIMARY KEY NOT NULL,
    "ResponderId" INTEGER NOT NULL,
    "AskId" INTEGER NOT NULL,
    "Resopnse" TEXT
);

DROP TABLE IF EXISTS Tags;
CREATE TABLE Tags(
    "id" INTEGER PRIMARY KEY NOT NULL,
    "PostId" INTEGER NOT NULL,
    "TagName" TEXT
);

DROP TABLE IF EXISTS TagBinding;
CREATE TABLE TagBinding(
    "TagId" INTEGER,
    "PostId" INTEGER
);
