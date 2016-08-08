CREATE TABLE Taskmaster(
  id SERIAL PRIMARY KEY, -- SERIAL tyyppinen pääavain pitää huolen, että tauluun lisätyllä rivillä on aina uniikki pääavain. Kätevää!
  name varchar(50) NOT NULL, -- Muista erottaa sarakkeiden määrittelyt pilkulla!
  password varchar(50) NOT NULL,
  joined DATE
);


CREATE TABLE Task(
  id SERIAL PRIMARY KEY,
  taskmaster_id INTEGER REFERENCES Taskmaster(id), -- Viiteavain Player-tauluun
  name varchar(50) NOT NULL,
  status boolean DEFAULT FALSE,
  description varchar(400),
  deadline DATE,
  place varchar(50),
  added DATE
);

CREATE TABLE Tasktype(
  id SERIAL PRIMARY KEY,
  name varchar(30),
  description varchar(400),
  added DATE
);

CREATE TABLE Tasksntypes(
  id SERIAL PRIMARY KEY,
  idtasktype INTEGER REFERENCES Tasktype(id),
  idtask INTEGER REFERENCES Task(id)
);
