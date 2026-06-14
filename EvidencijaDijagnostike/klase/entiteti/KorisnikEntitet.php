<?php
class KorisnikEntitet {
    private $korisnikId;
    private $ime;
    private $prezime;
    private $email;
    private $lozinkaHash;
    private $tipId;

    public function __construct($id=null, $ime=null, $prezime=null, $email=null, $hash=null, $tipId=null) {
        $this->korisnikId = $id;
        $this->ime = $ime;
        $this->prezime = $prezime;
        $this->email = $email;
        $this->lozinkaHash = $hash;
        $this->tipId = $tipId;
    }

    public function getKorisnikId() { return $this->korisnikId; }
    public function getIme() { return $this->ime; }
    public function getPrezime() { return $this->prezime; }
    public function getEmail() { return $this->email; }
    public function getLozinkaHash() { return $this->lozinkaHash; }
    public function getTipId() { return $this->tipId; }

    public function setKorisnikId($id) { $this->korisnikId = $id; }
    public function setEmail($email) { $this->email = $email; }
    public function setLozinkaHash($hash) { $this->lozinkaHash = $hash; }
    public function setTipId($tipId) { $this->tipId = $tipId; }
}
?>