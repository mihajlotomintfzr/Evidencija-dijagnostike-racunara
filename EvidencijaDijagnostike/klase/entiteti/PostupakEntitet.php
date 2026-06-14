<?php
class PostupakEntitet {
    private $postupakId;
    private $nazivPostupka;
    private $opis;

    public function __construct($postupakId = null, $nazivPostupka = null, $opis = null) {
        $this->postupakId = $postupakId;
        $this->nazivPostupka = $nazivPostupka;
        $this->opis = $opis;
    }

    public function getPostupakId() { return $this->postupakId; }
    public function getNazivPostupka() { return $this->nazivPostupka; }
    public function getOpis() { return $this->opis; }

    public function setPostupakId($id) { $this->postupakId = $id; }
    public function setNazivPostupka($np) { $this->nazivPostupka = $np; }
    public function setOpis($opis) { $this->opis = $opis; }
}
?>