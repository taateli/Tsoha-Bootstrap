INSERT INTO Taskmaster (name, password) VALUES ('Tatu', 'Tatu123'); -- Koska id-sarakkeen tietotyyppi on SERIAL, se asetetaan automaattisesti
INSERT INTO Taskmaster (name, password) VALUES ('Harri', 'Harri123');-- Lisää INSERT INTO lauseet tähän tiedostoon

INSERT INTO Task (taskmaster_id, name, description, deadline, place) VALUES ('1', 'TSOHA', 'PAKKO', '2016-08-31', 'HY');