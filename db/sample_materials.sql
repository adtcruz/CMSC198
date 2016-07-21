-- use database created in development_schema.sql
USE cmsc198db;

-- Insert some materials for some job
INSERT INTO materials (materialName, materialDescription, materialCost, materialUnitMeasurement, dateCreated, createdBy, createdByType) VALUES ('LAN Cable', 'Cable used for network connections', 100, 'metre', CURDATE(), 1, 'superadmin');
INSERT INTO materials (materialName, materialDescription, materialCost, materialUnitMeasurement, dateCreated, createdBy, createdByType) VALUES ('Network Switch', 'Hardware that handles network connections', 100, 'piece', CURDATE(), 1, 'superadmin');
INSERT INTO materials (materialName, materialDescription, materialCost, materialUnitMeasurement, dateCreated, createdBy, createdByType) VALUES ('VoIP Phone', 'Hardware interface for Voice over IP', 100, 'piece', CURDATE(), 1, 'superadmin');
INSERT INTO materials (materialName, materialDescription, materialCost, materialUnitMeasurement, dateCreated, createdBy, createdByType) VALUES ('UPS', 'Uninterrupted Power Supply', 100, 'piece', CURDATE(), 1, 'superadmin');

INSERT INTO materials (materialName, materialDescription, materialCost, materialUnitMeasurement, dateCreated, createdBy, createdByType) VALUES ('LAN Cable', 'Cable used for network connections', 100, 'metre', '2016-07-13', 1, 'superadmin');
INSERT INTO materials (materialName, materialDescription, materialCost, materialUnitMeasurement, dateCreated, createdBy, createdByType) VALUES ('Network Switch', 'Hardware that handles network connections', 100, 'piece', '2016-07-13', 1, 'superadmin');
INSERT INTO materials (materialName, materialDescription, materialCost, materialUnitMeasurement, dateCreated, createdBy, createdByType) VALUES ('VoIP Phone', 'Hardware interface for Voice over IP', 100, 'piece', '2016-07-15', 1, 'superadmin');
INSERT INTO materials (materialName, materialDescription, materialCost, materialUnitMeasurement, dateCreated, createdBy, createdByType) VALUES ('UPS', 'Uninterrupted Power Supply', 100, 'piece', '2016-07-15', 1, 'superadmin');
