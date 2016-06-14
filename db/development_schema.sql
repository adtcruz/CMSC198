-- DB user
DROP USER IF EXISTS 'cmsc198user';
CREATE USER 'cmsc198user'@'localhost' IDENTIFIED BY 'ZNBhSKChnoTds';

-- APPLICATION DATABASE
DROP DATABASE IF EXISTS cmsc198db;
CREATE DATABASE cmsc198db;

-- GRANTS ALL PRIVILEGE ON APPLICATION DATABASE TO DB USER
GRANT ALL ON cmsc198db.* TO 'cmsc198user'@'localhost';
FLUSH PRIVILEGES;

USE cmsc198db;

-- 'OFFICE' Table
DROP TABLE IF EXISTS office;
CREATE TABLE office(
	officeID INT NOT NULL AUTO_INCREMENT,
	officeName VARCHAR(128) NOT NULL,
	officeEmail VARCHAR(128) NOT NULL,
	telephoneNumber INT NOT NULL,
	PRIMARY KEY(officeID)
);

-- 'CLIENT' Table
DROP TABLE IF EXISTS client;
CREATE TABLE client(
	clientID INT NOT NULL AUTO_INCREMENT,
    username VARCHAR(32) NOT NULL UNIQUE,
    password VARCHAR(256) NOT NULL,
    givenName VARCHAR(64) NOT NULL,
    lastName VARCHAR(64) NOT NULL,
    designation VARCHAR(20) NOT NULL,
    officeId INT NOT NULL,
    FOREIGN KEY(officeId) REFERENCES office(officeID),
    PRIMARY KEY(clientID)
);

-- 'TECHNICIAN' Table
DROP TABLE IF EXISTS technician;
CREATE TABLE technician(
	technicianID INT NOT NULL AUTO_INCREMENT,
    username VARCHAR(32) NOT NULL UNIQUE,
    password VARCHAR(256) NOT NULL,
    givenName VARCHAR(64) NOT NULL,
    lastName VARCHAR(64) NOT NULL,
    PRIMARY KEY(technicianID)
);

-- 'JOB' Table
DROP TABLE IF EXISTS job;
CREATE TABLE job(
	jobID INT NOT NULL AUTO_INCREMENT,
	startDate TIMESTAMP,
	finishDate TIMESTAMP NULL,
	jobStatus VARCHAR(10) DEFAULT 'PENDING',
	assignedTechnician INT NULL,
	FOREIGN KEY(assignedTechnician) REFERENCES technician(technicianID),
	PRIMARY KEY(jobID)
);

-- 'MATERIALS' Table
DROP TABLE IF EXISTS materials;
CREATE TABLE materials(
	materialID INT NOT NULL AUTO_INCREMENT,
	materialName VARCHAR(32) NOT NULL,
	materialDescription VARCHAR(256) NOT NULL,
	materialCost INT NOT NULL,
	jobId INT NOT NULL,
	FOREIGN KEY(jobId) REFERENCES job(jobID), 
	PRIMARY KEY(materialID)
);