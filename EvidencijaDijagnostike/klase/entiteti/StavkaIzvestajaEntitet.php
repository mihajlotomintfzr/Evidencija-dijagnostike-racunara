<?php
class StavkaIzvestajaEntitet {
    private $stavkaId;
    private $izvestajId;
    private $redniBroj;
    private ?PostupakEntitet $postupak; // Асоцијација
    private $korisceniAlat;
    private $rezultatAnalize;
    private $detektovanProblem;

    public function __construct($stavkaId=null, $izvestajId=null, $redniBroj=null, PostupakEntitet $postupak=null, $korisceniAlat=null, $rezultatAnalize=null, $detektovanProblem=null) {
        $this->stavkaId = $stavkaId;
        $this->izvestajId = $izvestajId;
        $this->redniBroj = $redniBroj;
        $this->postupak = $postupak;
        $this->korisceniAlat = $korisceniAlat;
        $this->rezultatAnalize = $rezultatAnalize;
        $this->detektovanProblem = $detektovanProblem;
    }

    public function getStavkaId() { return $this->stavkaId; }
    public function getIzvestajId() { return $this->izvestajId; }
    public function getRedniBroj() { return $this->redniBroj; }
    public function getPostupak(): ?PostupakEntitet { return $this->postupak; }
    public function getKorisceniAlat() { return $this->korisceniAlat; }
    public function getRezultatAnalize() { return $this->rezultatAnalize; }
    public function getDetektovanProblem() { return $this->detektovanProblem; }

    public function setStavkaId($id) { $this->stavkaId = $id; }
    public function setIzvestajId($id) { $this->izvestajId = $id; }
    public function setRedniBroj($rb) { $this->redniBroj = $rb; }
    public function setPostupak(PostupakEntitet $p) { $this->postupak = $p; }
    public function setKorisceniAlat($ka) { $this->korisceniAlat = $ka; }
    public function setRezultatAnalize($ra) { $this->rezultatAnalize = $ra; }
    public function setDetektovanProblem($dp) { $this->detektovanProblem = $dp; }
}
?>