CREATE DATABASE IF NOT EXISTS EvidencijaDijagnostike CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE EvidencijaDijagnostike;


CREATE TABLE TipKorisnika (
    tipId INT AUTO_INCREMENT PRIMARY KEY,
    naziv VARCHAR(50) NOT NULL UNIQUE
);

CREATE TABLE Korisnik (
    korisnikId INT AUTO_INCREMENT PRIMARY KEY,
    ime VARCHAR(50) NOT NULL,
    prezime VARCHAR(50) NOT NULL,
    email VARCHAR(50) UNIQUE NOT NULL,
    lozinkaHash VARCHAR(255) NOT NULL,
    tipId INT NOT NULL,
    CONSTRAINT fkKorisnikTip 
        FOREIGN KEY (tipId) REFERENCES TipKorisnika(tipId) 
        ON DELETE RESTRICT ON UPDATE CASCADE
);


CREATE TABLE Zaposleni (
    zaposleniId INT AUTO_INCREMENT PRIMARY KEY,
    ime VARCHAR(50) NOT NULL,
    prezime VARCHAR(50) NOT NULL,
    jmbg CHAR(13) UNIQUE NOT NULL
);


CREATE TABLE Postupak (
    postupakId INT AUTO_INCREMENT PRIMARY KEY,
    nazivPostupka VARCHAR(100) NOT NULL UNIQUE,
    opis VARCHAR(255)
);


CREATE TABLE Izvestaj (
    izvestajId INT AUTO_INCREMENT PRIMARY KEY,
    brojIzvestaja VARCHAR(50) UNIQUE NOT NULL,
    datumPocetka DATE NOT NULL,
    vremePocetka TIME NOT NULL,
    datumZavrsetka DATE,
    vremeZavrsetka TIME,
    
    -- Podaci o klijentu
    klijentImePrezime VARCHAR(100) NOT NULL,
    klijentTelefon VARCHAR(30),
    klijentEmail VARCHAR(50),
    
    
    tipUredjaja VARCHAR(30) NOT NULL, 
    markaModel VARCHAR(100) NOT NULL,
    serijskiBroj VARCHAR(50),
    operativniSistem VARCHAR(50),
    konfiguracija TEXT,
    
    zakljucak TEXT,
    preporuka TEXT,
    napomena TEXT,
    
    
    zaposleniId INT NOT NULL,
    CONSTRAINT fkIzvestajZaposleni 
        FOREIGN KEY (zaposleniId) REFERENCES Zaposleni(zaposleniId) 
        ON DELETE RESTRICT ON UPDATE CASCADE
);


CREATE TABLE StavkaIzvestaja (
    stavkaId INT AUTO_INCREMENT PRIMARY KEY,
    izvestajId INT NOT NULL,
    redniBroj INT NOT NULL,
    
    postupakId INT NOT NULL,
    

    korisceniAlat VARCHAR(100) NOT NULL,
    rezultatAnalize TEXT NOT NULL,
    detektovanProblem TEXT NOT NULL,
    
    CONSTRAINT fkStavkaIzvestaj 
        FOREIGN KEY (izvestajId) REFERENCES Izvestaj(izvestajId) 
        ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT fkStavkaPostupak 
        FOREIGN KEY (postupakId) REFERENCES Postupak(postupakId) 
        ON DELETE RESTRICT ON UPDATE CASCADE,
    CONSTRAINT uqIzvestajRedni UNIQUE (izvestajId, redniBroj)
);


CREATE VIEW vwStavkeIzvestajaDetalji AS
SELECT 
    si.stavkaId,
    si.izvestajId,
    si.redniBroj,
    si.postupakId,
    p.nazivPostupka,
    si.korisceniAlat,
    si.rezultatAnalize,
    si.detektovanProblem
FROM StavkaIzvestaja si
JOIN Postupak p ON si.postupakId = p.postupakId
ORDER BY si.redniBroj;


DELIMITER //
CREATE PROCEDURE spStavkaIzvestajaUnos(
    IN pIzvestajId INT,
    IN pPostupakId INT,
    IN pKorisceniAlat VARCHAR(100),
    IN pRezultatAnalize TEXT,
    IN pDetektovanProblem TEXT
)
BEGIN
    DECLARE vRedniBroj INT;

   
    SELECT IFNULL(MAX(redniBroj), 0) + 1 INTO vRedniBroj
    FROM StavkaIzvestaja WHERE izvestajId = pIzvestajId;


    INSERT INTO StavkaIzvestaja (
        izvestajId, redniBroj, postupakId, korisceniAlat, rezultatAnalize, detektovanProblem
    )
    VALUES (
        pIzvestajId, vRedniBroj, pPostupakId, pKorisceniAlat, pRezultatAnalize, pDetektovanProblem
    );
END //
DELIMITER ;