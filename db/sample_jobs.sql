-- use database created in development_schema.sql
USE cmsc198db;

-- insert pending jobs that are not yet accepted
INSERT INTO job (jobDescription, startDate, clientID, dateCreated, createdBy, createdByType) values ("Broken switch.",NULL,1,CURDATE(),1,'client');
INSERT INTO job (jobDescription, startDate, clientID, dateCreated, createdBy, createdByType) values ("No internet.",NULL,1,CURDATE(),1,'client');
INSERT INTO job (jobDescription, startDate, clientID, dateCreated, createdBy, createdByType) values ("Internal Server Errors in uplb.edu.ph",NULL,1,CURDATE(),1,'client');
INSERT INTO job (jobDescription, startDate, clientID, dateCreated, createdBy, createdByType) values ("Liham does not work",NULL,1,CURDATE(),1,'client');
INSERT INTO job (jobDescription, startDate, clientID, dateCreated, createdBy, createdByType) values ("VoIP does not work",NULL,2,'20160619',2,'client');
INSERT INTO job (jobDescription, startDate, clientID, dateCreated, createdBy, createdByType) values ("Windows can not connect",NULL,2,'20160619',2,'client');
INSERT INTO job (jobDescription, startDate, clientID, dateCreated, createdBy, createdByType) values ("High pings on Overwatch",NULL,2,'20160619',2,'client');
INSERT INTO job (jobDescription, startDate, clientID, dateCreated, createdBy, createdByType) values ("Can not access YouTube",NULL,2,'20160619',2,'client');
