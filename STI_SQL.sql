CREATE TABLE IF NOT EXISTS 'user' (
    'id_user' INTEGER UNIQUE,
    'username' VARCHAR(45) UNIQUE NOT NULL,
    'password' VARCHAR(255) NOT NULL,
    'role' INT(11) NOT NULL DEFAULT 0,
    'enabled' BOOLEAN NOT NULL DEFAULT 1,
    PRIMARY KEY ('id_user'));

CREATE TABLE IF NOT EXISTS 'message' (
    'id_message' INT(11) UNIQUE NOT NULL,
    'id_sender' INT(11) NOT NULL,
    'id_receiver' INT(11) NOT NULL,
    'subject' VARCHAR NOT NULL,
    'text' VARCHAR NOT NULL,
    'date' DATE NOT NULL,
    FOREIGN KEY ('id_sender') REFERENCES 'user' ('id_user'),
    FOREIGN KEY ('id_receiver') REFERENCES 'user' ('id_user'),
    PRIMARY KEY ('id_message'));