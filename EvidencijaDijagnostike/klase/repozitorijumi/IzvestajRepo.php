<?php
class IzvestajRepo extends Tabela {
    
    public function DodajIzvestaj(IzvestajEntitet $i) {
        $db = $this->OtvorenaKonekcija->konekcijaDB;
        $upit = "INSERT INTO Izvestaj (brojIzvestaja, datumPocetka, vremePocetka, datumZavrsetka, vremeZavrsetka, 
                 klijentImePrezime, klijentTelefon, klijentEmail, tipUredjaja, markaModel, serijskiBroj, 
                 operativniSistem, konfiguracija, zakljucak, preporuka, napomena, zaposleniId) 
                 VALUES (
                    '" . mysqli_real_escape_string($db, $i->getBrojIzvestaja()) . "',
                    '" . mysqli_real_escape_string($db, $i->getDatumPocetka()) . "',
                    '" . mysqli_real_escape_string($db, $i->getVremePocetka()) . "',
                    " . ($i->getDatumZavrsetka() ? "'" . mysqli_real_escape_string($db, $i->getDatumZavrsetka()) . "'" : "NULL") . ",
                    " . ($i->getVremeZavrsetka() ? "'" . mysqli_real_escape_string($db, $i->getVremeZavrsetka()) . "'" : "NULL") . ",
                    '" . mysqli_real_escape_string($db, $i->getKlijentImePrezime()) . "',
                    '" . mysqli_real_escape_string($db, $i->getKlijentTelefon()) . "',
                    '" . mysqli_real_escape_string($db, $i->getKlijentEmail()) . "',
                    '" . mysqli_real_escape_string($db, $i->getTipUredjaja()) . "',
                    '" . mysqli_real_escape_string($db, $i->getMarkaModel()) . "',
                    '" . mysqli_real_escape_string($db, $i->getSerijskiBroj()) . "',
                    '" . mysqli_real_escape_string($db, $i->getOperativniSistem()) . "',
                    '" . mysqli_real_escape_string($db, $i->getKonfiguracija()) . "',
                    '" . mysqli_real_escape_string($db, $i->getZakljucak()) . "',
                    '" . mysqli_real_escape_string($db, $i->getPreporuka()) . "',
                    '" . mysqli_real_escape_string($db, $i->getNapomena()) . "',
                    " . intval($i->getZaposleni()->getZaposleniId()) . "
                 )";
        return $this->IzvrsiAktivanSQLUpit($upit);
    }

    public function DohvatiPoslednjiId() {
        return mysqli_insert_id($this->OtvorenaKonekcija->konekcijaDB);
    }

    public function DodajStavkuPrekoProcedure($izvestajId, $postupakId, $alat, $rezultat, $problem) {
        $db = $this->OtvorenaKonekcija->konekcijaDB;
        
        $alatEsc = mysqli_real_escape_string($db, $alat);
        $rezultatEsc = mysqli_real_escape_string($db, $rezultat);
        $problemEsc = mysqli_real_escape_string($db, $problem);
        
        $upit = "CALL spStavkaIzvestajaUnos($izvestajId, $postupakId, '$alatEsc', '$rezultatEsc', '$problemEsc')";
        return mysqli_query($db, $upit);
    }

    public function FiltrirajIzveštaje($filter = "") {
        $db = $this->OtvorenaKonekcija->konekcijaDB;
        $upit = "SELECT i.*, z.ime AS imeS, z.prezime AS prezimeS FROM Izvestaj i 
                 INNER JOIN Zaposleni z ON i.zaposleniId = z.zaposleniId";
        if ($filter != "") {
            $upit .= " WHERE i.klijentImePrezime LIKE '%" . mysqli_real_escape_string($db, $filter) . "%' 
                       OR i.brojIzvestaja LIKE '%" . mysqli_real_escape_string($db, $filter) . "%'";
        }
        $upit .= " ORDER BY i.izvestajId DESC";
        $this->UcitajSvePoUpitu($upit);
    }

    public function DohvatiIzvestajPoId($id) {
        $upit = "SELECT i.*, z.ime AS imeS, z.prezime AS prezimeS FROM Izvestaj i 
                 INNER JOIN Zaposleni z ON i.zaposleniId = z.zaposleniId 
                 WHERE i.izvestajId = " . intval($id);
        $this->UcitajSvePoUpitu($upit);
    }

    public function DohvatiStavkePoIdIzvestaja($id) {
        // Коришћење захтеваног погледа (VIEW) из базе
        $upit = "SELECT * FROM vwStavkeIzvestajaDetalji WHERE izvestajId = " . intval($id);
        $this->UcitajSvePoUpitu($upit);
    }

    public function ObrisiIzvestaj($id) {
        $upit = "DELETE FROM Izvestaj WHERE izvestajId = " . intval($id);
        return $this->IzvrsiAktivanSQLUpit($upit);
    }


public function AzurirajIzvestaj(IzvestajEntitet $i) {
        $db = $this->OtvorenaKonekcija->konekcijaDB;
        $upit = "UPDATE Izvestaj SET 
                    brojIzvestaja = '" . mysqli_real_escape_string($db, $i->getBrojIzvestaja()) . "',
                    datumPocetka = '" . mysqli_real_escape_string($db, $i->getDatumPocetka()) . "',
                    vremePocetka = '" . mysqli_real_escape_string($db, $i->getVremePocetka()) . "',
                    datumZavrsetka = " . ($i->getDatumZavrsetka() ? "'" . mysqli_real_escape_string($db, $i->getDatumZavrsetka()) . "'" : "NULL") . ",
                    vremeZavrsetka = " . ($i->getVremeZavrsetka() ? "'" . mysqli_real_escape_string($db, $i->getVremeZavrsetka()) . "'" : "NULL") . ",
                    klijentImePrezime = '" . mysqli_real_escape_string($db, $i->getKlijentImePrezime()) . "',
                    klijentTelefon = '" . mysqli_real_escape_string($db, $i->getKlijentTelefon()) . "',
                    klijentEmail = '" . mysqli_real_escape_string($db, $i->getKlijentEmail()) . "',
                    tipUredjaja = '" . mysqli_real_escape_string($db, $i->getTipUredjaja()) . "',
                    markaModel = '" . mysqli_real_escape_string($db, $i->getMarkaModel()) . "',
                    serijskiBroj = '" . mysqli_real_escape_string($db, $i->getSerijskiBroj()) . "',
                    operativniSistem = '" . mysqli_real_escape_string($db, $i->getOperativniSistem()) . "',
                    konfiguracija = '" . mysqli_real_escape_string($db, $i->getKonfiguracija()) . "',
                    zakljucak = '" . mysqli_real_escape_string($db, $i->getZakljucak()) . "',
                    preporuka = '" . mysqli_real_escape_string($db, $i->getPreporuka()) . "',
                    napomena = '" . mysqli_real_escape_string($db, $i->getNapomena()) . "',
                    zaposleniId = " . intval($i->getZaposleni()->getZaposleniId()) . "
                 WHERE izvestajId = " . intval($i->getIzvestajId());
        return $this->IzvrsiAktivanSQLUpit($upit);
    }

    public function ObrisiStavkeIzvestaja($izvestajId) {
        $upit = "DELETE FROM StavkaIzvestaja WHERE izvestajId = " . intval($izvestajId);
        return $this->IzvrsiAktivanSQLUpit($upit);
    }
    public function DohvatiSveIzvestaje() {
        $db = $this->OtvorenaKonekcija->konekcijaDB;
        $upit = "SELECT i.izvestajId, i.brojIzvestaja, i.datumPocetka, i.vremePocetka, i.datumZavrsetka, i.vremeZavrsetka, 
                        i.klijentImePrezime, i.klijentTelefon, i.klijentEmail, i.tipUredjaja, i.markaModel, i.serijskiBroj, 
                        i.operativniSistem, i.konfiguracija, i.zakljucak, i.preporuka, i.napomena, 
                        z.ime, z.prezime 
                 FROM Izvestaj i 
                 JOIN Zaposleni z ON i.zaposleniId = z.zaposleniId 
                 ORDER BY i.izvestajId DESC";
        
        $this->Kolekcija = mysqli_query($db, $upit);
        $this->BrojZapisa = mysqli_num_rows($this->Kolekcija);
    }

    public function DohvatiFiltriraneIzvestaje($filter) {
        $db = $this->OtvorenaKonekcija->konekcijaDB;
        $f = mysqli_real_escape_string($db, $filter);
        $upit = "SELECT i.izvestajId, i.brojIzvestaja, i.datumPocetka, i.vremePocetka, i.datumZavrsetka, i.vremeZavrsetka, 
                        i.klijentImePrezime, i.klijentTelefon, i.klijentEmail, i.tipUredjaja, i.markaModel, i.serijskiBroj, 
                        i.operativniSistem, i.konfiguracija, i.zakljucak, i.preporuka, i.napomena, 
                        z.ime, z.prezime 
                 FROM Izvestaj i 
                 JOIN Zaposleni z ON i.zaposleniId = z.zaposleniId 
                 WHERE i.klijentImePrezime LIKE '%$f%' OR i.brojIzvestaja LIKE '%$f%'
                 ORDER BY i.izvestajId DESC";
                 
        $this->Kolekcija = mysqli_query($db, $upit);
        $this->BrojZapisa = mysqli_num_rows($this->Kolekcija);
    }

}

?>