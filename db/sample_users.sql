-- use database created in development_schema.sql
USE cmsc198db;

-- insert sample technicians
INSERT INTO adminAcc (username, password, givenName, lastName, isTechnician, active) VALUES
('user1',SHA1('useruser'),'User','User1',0,1),
('user2',SHA1('useruser'),'User','User2',1,1),
('user3',SHA1('useruser'),'User','User3',1,0);

-- insert sample clients
INSERT INTO client (username, password, givenName, lastName, designation, officeId) VALUES
('adtcruz', SHA1('password'), 'Anton', 'Cruz', 'On-the-Job Trainee', 46),
('clstia', SHA1('clstia'), 'Ellis', 'Eurolfan', 'On-the-Job Trainee', 46);