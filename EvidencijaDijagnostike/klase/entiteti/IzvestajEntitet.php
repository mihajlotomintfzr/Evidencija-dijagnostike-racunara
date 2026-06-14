<?php
class IzvestajEntitet {
    private $izvestajId;
    private $brojIzvestaja;
    private $datumPocetka;
    private $vremePocetka;
    private $datumZavrsetka;
    private $vremeZavrsetka;
    private $klijentImePrezime;
    private $klijentTelefon;
    private $klijentEmail;
    private $tipUredjaja;
    private $markaModel;
    private $serijskiBroj;
    private $operativniSistem;
    private $konfiguracija;
    private $zakljucak;
    private $preporuka;
    private $napomena;
    private ?ZaposleniEntitet $zaposleni; 
    private array $stavke = []; 

    public function __construct($izvestajId=null, $brojIzvestaja=null, $datumPocetka=null, $vremePocetka=null, ZaposleniEntitet $zaposleni=null) {
        $this->izvestajId = $izvestajId;
        $this->brojIzvestaja = $brojIzvestaja;
        $this->datumPocetka = $datumPocetka;
        $this->vremePocetka = $vremePocetka;
        $this->zaposleni = $zaposleni;
    }

    // Гетери и Сетери
    public function getIzvestajId() { return $this->izvestajId; }
    public function getBrojIzvestaja() { return $this->brojIzvestaja; }
    public function getDatumPocetka() { return $this->datumPocetka; }
    public function getVremePocetka() { return $this->vremePocetka; }
    public function getDatumZavrsetka() { return $this->datumZavrsetka; }
    public function getVremeZavrsetka() { return $this->vremeZavrsetka; }
    public function getKlijentImePrezime() { return $this->klijentImePrezime; }
    public function getKlijentTelefon() { return $this->klijentTelefon; }
    public function getKlijentEmail() { return $this->klijentEmail; }
    public function getTipUredjaja() { return $this->tipUredjaja; }
    public function getMarkaModel() { return $this->markaModel; }
    public function getSerijskiBroj() { return $this->serijskiBroj; }
    public function getOperativniSistem() { return $this->operativniSistem; }
    public function getKonfiguracija() { return $this->konfiguracija; }
    public function getZakljucak() { return $this->zakljucak; }
    public function getPreporuka() { return $this->preporuka; }
    public function getNapomena() { return $this->napomena; }
    public function getZaposleni(): ?ZaposleniEntitet { return $this->zaposleni; }
    public function getStavke(): array { return $this->stavke; }

    public function setIzvestajId($id) { $this->izvestajId = $id; }
    public function setBrojIzvestaja($bi) { $this->brojIzvestaja = $bi; }
    public function setDatumPocetka($d) { $this->datumPocetka = $d; }
    public function setVremePocetka($v) { $this->vremePocetka = $v; }
    public function setDatumZavrsetka($d) { $this->datumZavrsetka = $d; }
    public function setVremeZavrsetka($v) { $this->vremeZavrsetka = $v; }
    public function setKlijentImePrezime($kip) { $this->klijentImePrezime = $kip; }
    public function setKlijentTelefon($t) { $this->klijentTelefon = $t; }
    public function setKlijentEmail($e) { $this->klijentEmail = $e; }
    public function setTipUredjaja($tu) { $this->tipUredjaja = $tu; }
    public function setMarkaModel($mm) { $this->markaModel = $mm; }
    public function setSerijskiBroj($sb) { $this->serijskiBroj = $sb; }
    public function setOperativniSistem($os) { $this->operativniSistem = $os; }
    public function setKonfiguracija($k) { $this->konfiguracija = $k; }
    public function setZakljucak($z) { $this->zakljucak = $z; }
    public function setPreporuka($p) { $this->preporuka = $p; }
    public function setNapomena($n) { $this->napomena = $n; }
    public function setZaposleni(ZaposleniEntitet $z) { $this->zaposleni = $z; }
    public function setStavke(array $s) { $this->stavke = $s; }

    public function dodajStavku(StavkaIzvestajaEntitet $s) {
        $this->stavke[] = $s;
    }
}
?>