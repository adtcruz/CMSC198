-- use database created in development_schema.sql
USE cmsc198db;

-- Insert some materials for some job
INSERT INTO materials (materialName, materialDescription, materialCost, materialUnit, materialUnitMeasurement, dateCreated, createdBy) VALUES ('LAN Cable', 'Cable used for network connections', 100 ,10.0, 'Meters', CURDATE(), 1);
INSERT INTO materials (materialName, materialDescription, materialCost, materialUnit, materialUnitMeasurement, dateCreated, createdBy) VALUES ('Network Switch', 'Hardware that handles network connections', 100, 1, 'Piece/s', CURDATE(), 1);
INSERT INTO materials (materialName, materialDescription, materialCost, materialUnit, materialUnitMeasurement, dateCreated, createdBy) VALUES ('VoIP Phone', 'Hardware interface for Voice over IP', 100, 3, 'Piece/s', CURDATE(), 1);
INSERT INTO materials (materialName, materialDescription, materialCost, materialUnit, materialUnitMeasurement, dateCreated, createdBy) VALUES ('UPS', 'Uninterrupted Power Supply', 100, 1, 'Piece/s', CURDATE(), 1);