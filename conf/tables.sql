CREATE TABLE users(id VARCHAR(300) PRIMARY KEY,username VARCHAR(50) NOT NULL,email VARCHAR(50) NOT NULL UNIQUE,password VARCHAR(50) NOT NULL,verified INT);
CREATE TABLE events(id VARCHAR(100) PRIMARY KEY,name VARCHAR(100) NOT NULL,start VARCHAR(50),end VARCHAR(50), paid INT, price INT,tags VARCHAR(50),description VARCHAR(1000),owner VARCHAR(100),location VARCHAR(500) );
CREATE TABLE participants(event_id VARCHAR(100),user_id VARCHAR(100),access INT);
CREATE TABLE id_store(id VARCHAR(100) PRIMARY KEY,kind VARCHAR(20));