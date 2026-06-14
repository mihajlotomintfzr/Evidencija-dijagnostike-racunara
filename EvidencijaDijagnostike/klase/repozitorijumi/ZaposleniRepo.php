<?php
class ZaposleniRepo extends Tabela {
    public function DohvatiSveZaposlene() {
        $upit = "SELECT * FROM Zaposleni ORDER BY prezime, ime";
        $this->UcitajSvePoUpitu($upit);
    }
}
?>