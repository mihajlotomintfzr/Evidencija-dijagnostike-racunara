<?php
class ApiKontroler {
    private $konekcija;

    public function __construct($konekcija) {
        $this->konekcija = $konekcija;
    }

    // РЕСТ Сервис за динамичко учитавање поступака из форме
    public function ucitajPostupke() {
        header("Content-Type: application/json");
        require_once 'klase/repozitorijumi/PostupakRepo.php';
        $repo = new PostupakRepo($this->konekcija, "Postupak");
        $repo->DohvatiSvePostupke();
        
        $rezultat = [];
        if($repo->BrojZapisa > 0) {
            for($i=0; $i<$repo->BrojZapisa; $i++) {
                $rezultat[] = [
                    'id' => $repo->DajVrednostPoRednomBrojuZapisaPoRBPolja($repo->Kolekcija, $i, 0),
                    'naziv' => $repo->DajVrednostPoRednomBrojuZapisaPoRBPolja($repo->Kolekcija, $i, 1)
                ];
            }
        }
        echo json_encode($rezultat);
        exit;
    }
}
?>