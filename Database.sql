/* Create database and tables */
CREATE DATABASE if NOT EXISTS inpact;
USE inpact;

CREATE TABLE if NOT EXISTS Classe(
	ID_classe INT PRIMARY KEY AUTO_INCREMENT,
	anno TINYINT(1),
	sezione VARCHAR(6)
);

CREATE TABLE if NOT EXISTS Persona(
	ID_persona INT(6) AUTO_INCREMENT PRIMARY KEY,
	nome VARCHAR(30),
	cognome VARCHAR(30),
	dataNascita DATE,
	sesso CHAR(1),
	tipo TINYINT(1) NOT NULL
);

CREATE TABLE if NOT EXISTS Studente(
    ID_studente INT(6) PRIMARY KEY,
    ID_classe INT,
    CONSTRAINT fk_pers_stud_IDstudente FOREIGN KEY(ID_studente) REFERENCES Persona(ID_persona) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT fk_class_stud_IDclasse FOREIGN KEY(ID_classe) REFERENCES Classe(ID_classe) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE if NOT EXISTS Account(
	nomeUtente VARCHAR(255) PRIMARY KEY,
	password VARCHAR(30),
    ID_persona INT(6),
	CONSTRAINT fk_pers_acc_IDpersona FOREIGN KEY (ID_persona) REFERENCES Persona(ID_persona) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE if NOT EXISTS Materia(
	ID_materia INT PRIMARY KEY AUTO_INCREMENT,
	nome VARCHAR(30)
);

CREATE TABLE if NOT EXISTS Insegna(
	ID_persona INT(6),
	ID_materia INT,
	ID_classe INT,
	PRIMARY KEY(ID_persona, ID_materia, ID_classe),
	CONSTRAINT fk_pers_inseg_IDpersona FOREIGN KEY(ID_persona) REFERENCES Persona(ID_persona) ON DELETE CASCADE ON UPDATE CASCADE,
	CONSTRAINT fk_mat_inseg_IDmateria FOREIGN KEY(ID_materia) REFERENCES Materia(ID_materia) ON DELETE CASCADE ON UPDATE CASCADE,
	CONSTRAINT fk_class_inseg_IDclasse FOREIGN KEY(ID_classe) REFERENCES Classe(ID_classe) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE if NOT EXISTS Badge(
	codBadge INT NOT NULL,
	nome VARCHAR(30),
	materia INT,
	livello TINYINT(1),
	PRIMARY KEY(codBadge, livello),
	CONSTRAINT fk_mat_badge_materia FOREIGN KEY (materia) REFERENCES Materia(ID_materia) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE if NOT EXISTS Assegna_Visualizza(
	ID_persona INT(6),
	codBadge INT,
	livello TINYINT(1),
	dataB date,
	PRIMARY KEY(ID_persona, codBadge, livello),
	CONSTRAINT fk_pers_ass_IDpersona FOREIGN KEY(ID_persona) REFERENCES Persona(ID_persona) ON DELETE CASCADE ON UPDATE CASCADE,
	CONSTRAINT fk_badge_ass_codbadge_livello FOREIGN KEY(codBadge, livello) REFERENCES Badge(codBadge, livello) ON DELETE CASCADE ON UPDATE CASCADE
);

/* Insert data in tables */
INSERT INTO Classe (anno, sezione)
VALUES 
	(5, "ci"),
	(4, "am"),
	(3, "di"),
	(2, "fst"),
	(1, "cst");

INSERT INTO Persona (nome, cognome, dataNascita, sesso, tipo)
VALUES 
	("Luigi Pino", "Mosto", "2000-10-01", "M", 1),
	("Mario", "Lungo", "1990-12-07", "M", 1),
	("Sonia", "Eticipia", "2006-03-23", "F", 1),
    ("Federico", "Dado", "2000-02-16", "M", 1),
	("Mauro", "Sarto", "1990-08-05", "M", 1),
	("Marta", "Canna", "2000-01-23", "F", 1),

	("Vanni", "Tirapelle", "1974-05-27", "M", 2),
	("Emil", "Ricci", "1978-10-01", "M", 2),
    ("Sara", "Previato", "1980-03-12", "F", 2);

INSERT INTO Studente (ID_studente, ID_classe)
VALUES 
	(1, 1),
	(2, 3),
	(3, 5),
	(4, 1),
	(5, 3),
    (6, 1);

INSERT INTO Account (nomeUtente, password, ID_persona)
VALUES 
	('ciao1@gmail.com', 'ciao1', 1),
	('ciao2@gmail.com', 'ciao2', 2),
    ('ciao3@gmail.com', 'ciao3', 3),
    ('ciao4@gmail.com', 'ciao4', 4),
    ('ciao5@gmail.com', 'ciao5', 5),
    ('ciao6@gmail.com', 'ciao6', 6),

    ('ciao7@gmail.it', 'ciao7', 7),
    ('ciao8@gmail.it', 'ciao8', 8),
    ('ciao9@gmail.it', 'ciao9', 9);

INSERT INTO Materia (nome)
VALUES 
    ("Italiano"),
	("Informatica"),
	("Tpsi"),
	("Sistemi e Reti");

INSERT INTO Insegna (ID_persona, ID_materia, ID_classe)
VALUES 
	(8, 1, 1),
	(7, 3, 1),
   	(7, 4, 1),
	(9, 2, 1),

    (8, 1, 4),
	(7, 3, 2),
   	(7, 4, 2),
	(9, 2, 3);
	
INSERT INTO Badge (codBadge, nome, materia, livello)
VALUES 
	(1, "C", 3, 1),
	(1, "C", 3, 2),
	(1, "C", 3, 3),
	
	(2, "Cisco", 4, 1),
	(2, "Cisco", 4, 2),
	(2, "Cisco", 4, 3),
	
	(3, "Crittografia", 4, 1),
	(3, "Crittografia", 4, 2),
	(3, "Crittografia", 4, 3),
	
	(4, "Css", 3, 1),
	(4, "Css", 3, 2),
	(4, "Css", 3, 3),
	
	(5, "Hardware", 4, 1),
	(5, "Hardware", 4, 2),
	(5, "Hardware", 4, 3),
	
	(6, "Html", 3, 1),
	(6, "Html", 3, 2),
	(6, "Html", 3, 3),
	
	(7, "Java", 2, 1),
	(7, "Java", 2, 2),
	(7, "Java", 2, 3),
	
	(8, "Javascript", 3, 1),
	(8, "Javascript", 3, 2),
	(8, "Javascript", 3, 3),
	
	(9, "Office", 2, 1),
	(9, "Office", 2, 2),
	(9, "Office", 2, 3),
	
	(10, "Php", 2, 1),
	(10, "Php", 2, 2),
	(10, "Php", 2, 3),
	
	(11, "Python", 2, 1),
	(11, "Python", 2, 2),
	(11, "Python", 2, 3),
	
	(12, "Reti", 4, 1),
	(12, "Reti", 4, 2),
	(12, "Reti", 4, 3),
	
	(13, "Software", 2, 1),
	(13, "Software", 2, 2),
	(13, "Software", 2, 3),
	
	(14, "Sql", 2, 1),
	(14, "Sql", 2, 2),
	(14, "Sql", 2, 3);

INSERT INTO Assegna_Visualizza (ID_persona, codBadge, livello, dataB)
VALUES 
	(1, 1, 2, "2022-05-28"),
	(2, 2, 3, "2022-02-05"),
	(2, 7, 3, "2021-11-03"),
	(3, 3, 1, "2022-07-13");
