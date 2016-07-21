-- use database created in development_schema.sql
USE cmsc198db;

-- insert sample admin and technician account
INSERT INTO adminAcc (username, password, givenName, lastName, isTechnician, active) VALUES
('adminUser',SHA1('useruser'),'Admin','User',0,1),
('technicianUser',SHA1('useruser'),'Technician','User',1,1);

-- insert sample clients
INSERT INTO client (username, password, givenName, lastName, designation, officeId) VALUES
('adtcruz', SHA1('password'), 'Anton', 'Cruz', 'On-the-Job Trainee', 46),
('clstia', SHA1('clstia'), 'Ellis', 'Eurolfan', 'On-the-Job Trainee', 46), 
('joencar', SHA1('joencar'), 'Joanne', 'Encarnacion', 'On-the-Job Trainee', 46), 
('ashaaa', SHA1('ashaaa'), 'Azha', 'de Belen', 'On-the-Job Trainee', 46);

-- insert sample superadmin account
INSERT INTO superAdmin (username, password, givenName, lastName) VALUES
('superAdmin',SHA1('superadmin'),'Super','Admin');
