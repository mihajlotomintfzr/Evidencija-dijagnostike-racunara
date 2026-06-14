<?php
class KorisnikRepo extends Tabela {
    public function DohvatiKorisnikaPoEmailu($email) {
        $upit = "SELECT k.*, tk.naziv AS tipNaziv FROM Korisnik k 
                 INNER JOIN TipKorisnika tk ON k.tipId = tk.tipId 
                 WHERE k.email = '" . mysqli_real_escape_string($this->OtvorenaKonekcija->konekcijaDB, $email) . "'";
        $this->UcitajSvePoUpitu($upit);
    }
}
?>