<?php
class PostupakRepo extends Tabela {
    public function DohvatiSvePostupke() {
        $upit = "SELECT * FROM Postupak ORDER BY nazivPostupka";
        $this->UcitajSvePoUpitu($upit);
    }
}
?>