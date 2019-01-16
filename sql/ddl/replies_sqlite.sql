

--
-- Replies table
--
DROP TABLE IF EXISTS Replies;
CREATE TABLE Replies (
    "id" INTEGER PRIMARY KEY NOT NULL,
    "responseTo" INT NOT NULL,
    "reply" TEXT,
    "replierId" INTEGER NOT NULL,
    "created" TIMESTAMP
);
