-- use database created in development_schema.sql
USE cmsc198db;

-- Insert some materials for some job
INSERT INTO materials (materialName, materialDescription, materialCost, materialUnit, materialUnitMeasurement, jobID, dateCreated, createdBy) VALUES ('LAN Cable', 'Cable used for network connections', 10.0, 'Meters', 1, CURDATE(), 1);
INSERT INTO materials (materialName, materialDescription, materialCost, materialUnit, materialUnitMeasurement, jobID, dateCreated, createdBy) VALUES ('Network Switch', 'Hardware that handles network connections', 1, 'Piece/s', 1, CURDATE(), 1);
INSERT INTO materials (materialName, materialDescription, materialCost, materialUnit, materialUnitMeasurement, jobID, dateCreated, createdBy) VALUES ('VoIP Phone', 'Hardware interface for Voice over IP', 3, 'Piece/s', 1, CURDATE(), 1);
INSERT INTO materials (materialName, materialDescription, materialCost, materialUnit, materialUnitMeasurement, jobID, dateCreated, createdBy) VALUES ('UPS', 'Uninterrupted Power Supply', 1, 'Piece/s', 1, CURDATE(), 1);