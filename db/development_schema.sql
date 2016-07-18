-- DB user
-- DROP USER IF EXISTS 'cmsc198user';
-- CREATE USER 'cmsc198user' IDENTIFIED BY 'ZNBhSKChnoTds';

-- APPLICATION DATABASE
DROP DATABASE IF EXISTS cmsc198db;
CREATE DATABASE cmsc198db;

-- GRANTS ALL PRIVILEGE ON APPLICATION DATABASE TO DB USER
GRANT ALL ON cmsc198db.* TO 'cmsc198user';
FLUSH PRIVILEGES;

USE cmsc198db;

-- 'OFFICE' Table
DROP TABLE IF EXISTS office;
CREATE TABLE office(
	officeID INT NOT NULL AUTO_INCREMENT,
	officeAbbr VARCHAR(128) NOT NULL,
	officeName VARCHAR(128) NOT NULL,
	officeEmail VARCHAR(128) NOT NULL,
	telephoneNumber INT NOT NULL,
	faxNumber INT NOT NULL,
	voip INT NOT NULL,
	parentUnit INT NOT NULL,
	officeType VARCHAR(128) NOT NULL,
	favorite INT NOT NULL DEFAULT '0',
	priority INT NOT NULL DEFAULT '5',
	dateCreated DATE DEFAULT NULL,
	createdBy INT DEFAULT NULL,
	active INT NOT NULL DEFAULT '1',
	head VARCHAR(128) NOT NULL,
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
    dateCreated DATE DEFAULT NULL,
	createdBy INT DEFAULT NULL,
	active INT NOT NULL DEFAULT '1',
    FOREIGN KEY(officeId) REFERENCES office(officeID),
    PRIMARY KEY(clientID)
);

-- 'ADMINACC' Table
DROP TABLE IF EXISTS adminAcc;
CREATE TABLE adminAcc(
	adminID INT NOT NULL AUTO_INCREMENT,
    username VARCHAR(32) NOT NULL UNIQUE,
    password VARCHAR(256) NOT NULL,
    givenName VARCHAR(64) NOT NULL,
    lastName VARCHAR(64) NOT NULL,
    isTechnician INT NOT NULL,
    dateCreated DATE DEFAULT NULL,
	createdBy INT DEFAULT NULL,
	active INT NOT NULL DEFAULT '1',
    PRIMARY KEY(adminID)
);

-- 'SUPERADMIN' Table
DROP TABLE IF EXISTS superAdmin;
CREATE TABLE superAdmin(
	superAdminID INT NOT NULL AUTO_INCREMENT,
    username VARCHAR(32) NOT NULL UNIQUE,
    password VARCHAR(256) NOT NULL,
    givenName VARCHAR(64) NOT NULL,
    lastName VARCHAR(64) NOT NULL,
    dateCreated DATE DEFAULT NULL,
	createdBy INT DEFAULT NULL,
	active INT NOT NULL DEFAULT '1',
    PRIMARY KEY(superAdminID)
);

-- 'JOB' Table
DROP TABLE IF EXISTS job;
CREATE TABLE job(
	jobID INT NOT NULL AUTO_INCREMENT,
	jobDescription VARCHAR(1024) NOT NULL,
	startDate DATE NULL,
	finishDate DATE NULL,
	jobStatus VARCHAR(10) DEFAULT 'PENDING',
	clientID INT NOT NULL,
	adminID INT NULL,
	dateCreated DATE NOT NULL,
	createdBy INT DEFAULT NULL,
	createdByType VARCHAR(10) NOT NULL,
	active INT NOT NULL DEFAULT '1',
	FOREIGN KEY(clientID) REFERENCES client(clientID),
	FOREIGN KEY(adminID) REFERENCES adminAcc(adminID),
	PRIMARY KEY(jobID)
);

-- 'WORK' Table
DROP TABLE IF EXISTS work;
CREATE TABLE work(
	workID INT NOT NULL AUTO_INCREMENT,
	workDescription VARCHAR(1024) NOT NULL,
  workCost DOUBLE NOT NULL,
	dateCreated DATE NOT NULL,
  createdBy INT DEFAULT NULL,
	createdByType VARCHAR(10) NOT NULL,
	active INT NOT NULL DEFAULT '1',
	PRIMARY KEY(workID)
);

-- 'WORKDONE' Table
DROP TABLE IF EXISTS workDone;
CREATE TABLE workDone(
  workDoneID INT NOT NULL AUTO_INCREMENT,
  workID INT NOT NULL,
  workDuration INT NOT NULL,
  jobID INT NOT NULL,
  dateCreated DATE NOT NULL,
  createdBy INT DEFAULT NULL,
	createdByType VARCHAR(10) NOT NULL,
	FOREIGN KEY(workID) REFERENCES work(workID),
  FOREIGN KEY(jobID) REFERENCES job(jobID),
  PRIMARY KEY(workDoneID)
);

-- 'MATERIALS' Table
DROP TABLE IF EXISTS materials;
CREATE TABLE materials(
	materialID INT NOT NULL AUTO_INCREMENT,
	materialName VARCHAR(32) NOT NULL,
	materialDescription VARCHAR(256) NOT NULL,
	materialCost DOUBLE NOT NULL,
	materialUnitMeasurement VARCHAR(64) NOT NULL,
	dateCreated DATE DEFAULT NULL,
	createdBy INT DEFAULT NULL,
	createdByType VARCHAR(10) NOT NULL,
	active INT NOT NULL DEFAULT '1',
	PRIMARY KEY(materialID)
);

-- 'MATERIALSUSED' Table
DROP TABLE IF EXISTS materialsUsed;
CREATE TABLE materialsUsed (
	materialsUsedID INT NOT NULL AUTO_INCREMENT,
	materialID INT NOT NULL,
	jobID INT NOT NULL,
	materialUnits DOUBLE NOT NULL,
	dateCreated DATE DEFAULT NULL,
	createdBy INT DEFAULT NULL,
	createdByType VARCHAR(10) NOT NULL,
	active INT NOT NULL DEFAULT '1',
	FOREIGN KEY(materialID) REFERENCES materials(materialID),
	FOREIGN KEY(jobID) REFERENCES job(jobID),
	PRIMARY KEY(materialsUsedID)
);

-- 'SCHEDULE' Table
DROP TABLE IF EXISTS schedule;
CREATE TABLE schedule (
	scheduleID INT NOT NULL AUTO_INCREMENT,
	priority INT NOT NULL,
	jobID INT NOT NULL,
	dateScheduled DATE NOT NULL,
	dateCreated DATE DEFAULT NULL,
	createdBy INT DEFAULT NULL,
	createdByType VARCHAR(10) NOT NULL,
	active INT NOT NULL DEFAULT '1',
	PRIMARY KEY(scheduleID),
	FOREIGN KEY(jobID) REFERENCES job(jobID)
);

-- 'USERLOGS' table
DROP TABLE IF EXISTS userLogs;
CREATE TABLE userLogs(
	logID INT NOT NULL AUTO_INCREMENT,
	logText VARCHAR(512) NOT NULL,
	logTimestamp TIMESTAMP NOT NULL,
	PRIMARY KEY(logID)
);

-- 'NOTIFICATIONS' table
DROP TABLE IF EXISTS notifications;
CREATE TABLE notifications(
    notifID INT NOT NULL AUTO_INCREMENT,
    notifText VARCHAR(128) NOT NULL,
    clientID INT NOT NULL,
    jobID INT NOT NULL,
    dateCreated DATE DEFAULT NULL,
    createdBy INT DEFAULT NULL,
    createdByType VARCHAR(10) NOT NULL,
    active INT NOT NULL DEFAULT '1',
    PRIMARY KEY(notifID),
    FOREIGN KEY(clientID) REFERENCES client(clientID),
    FOREIGN KEY(jobID) REFERENCES job(jobID)
);

-- 'NOTIFS_READ' table
DROP TABLE IF EXISTS notifsRead;
CREATE TABLE notifsRead(
    notifID INT NOT NULL,
    userID INT NOT NULL,
    userType VARCHAR(10) NOT NULL,
    dateCreated DATE DEFAULT NULL,
    active INT NOT NULL DEFAULT '1',
    FOREIGN KEY(notifID) REFERENCES notifications(notifID)
);

-- 'ANNOUNCEMENTS' table
DROP TABLE IF EXISTS announcements;
CREATE TABLE announcements(
    announcementID INT NOT NULL AUTO_INCREMENT,
    announcementText VARCHAR(1024) NOT NULL,
    announcementTitle VARCHAR(128) NOT NULL,
    dateCreated DATE DEFAULT NULL,
    createdBy INT DEFAULT NULL,
    createdByType VARCHAR(10) NOT NULL,
    active INT NOT NULL DEFAULT '1',
    PRIMARY KEY(announcementID)
);
