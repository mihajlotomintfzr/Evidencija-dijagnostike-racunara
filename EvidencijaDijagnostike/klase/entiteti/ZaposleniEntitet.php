<?php
class ZaposleniEntitet {
    private $zaposleniId;
    private $ime;
    private $prezime;
    private $jmbg;

    public function __construct($zaposleniId = null, $ime = null, $prezime = null, $jmbg = null) {
        $this->zaposleniId = $zaposleniId;
        $this->ime = $ime;
        $this->prezime = $prezime;
        $this->jmbg = $jmbg;
    }

    public function getZaposleniId() { return $this->zaposleniId; }
    public function getIme() { return $this->ime; }
    public function getPrezime() { return $this->prezime; }
    public function getJmbg() { return $this->jmbg; }

    public function setZaposleniId($id) { $this->zaposleniId = $id; }
    public function setIme($ime) { $this->ime = $ime; }
    public function setPrezime($prezime) { $this->prezime = $prezime; }
    public function setJmbg($jmbg) { $this->jmbg = $jmbg; }
}
?>