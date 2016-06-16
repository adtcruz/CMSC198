-- use database created in development_schema.sql
USE cmsc198db;

-- insert sample technicians
INSERT INTO technician (username, password, givenName, lastName) VALUES
('user1',SHA1('useruser'),'User','User1'),
('user2',SHA1('useruser'),'User','User2'),
('user3',SHA1('useruser'),'User','User3');

-- insert sample clients
INSERT INTO client (username, password, givenName, lastName, designation, officeId) VALUES
('adtcruz', SHA1('password'), 'Anton', 'Cruz', 'On-the-Job Trainee', 46),
('clstia', SHA1('clstia'), 'Ellis', 'Eurolfan', 'On-the-Job Trainee', 46);