-- use database created in development_schema.sql
USE cmsc198db;

-- insert pending jobs that are not yet accepted
INSERT INTO job (startDate, clientID, dateCreated, createdBy, createdByType) values (NULL,1, CURDATE(), 1, 'client');
INSERT INTO job (startDate, clientID, dateCreated, createdBy, createdByType) values (NULL,1, CURDATE(), 1, 'client');
INSERT INTO job (startDate, clientID, dateCreated, createdBy, createdByType) values (NULL,1, CURDATE(), 1, 'client');
INSERT INTO job (startDate, clientID, dateCreated, createdBy, createdByType) values (NULL,1, CURDATE(), 1, 'client');
INSERT INTO job (startDate, clientID, dateCreated, createdBy, createdByType) values (NULL,2, '20160619', 2, 'client');
INSERT INTO job (startDate, clientID, dateCreated, createdBy, createdByType) values (NULL,2, '20160619', 2, 'client');
INSERT INTO job (startDate, clientID, dateCreated, createdBy, createdByType) values (NULL,2, '20160619', 2, 'client');
INSERT INTO job (startDate, clientID, dateCreated, createdBy, createdByType) values (NULL,2, '20160619', 2, 'client');