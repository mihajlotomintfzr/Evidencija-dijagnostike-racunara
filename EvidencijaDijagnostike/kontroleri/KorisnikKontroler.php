<?php
class KorisnikKontroler {
    private $konekcija;

    public function __construct($konekcija) {
        $this->konekcija = $konekcija;
    }

    public function priјаviSe($email, $lozinka) {
        require_once 'klase/repozitorijumi/KorisnikRepo.php';
        $repo = new KorisnikRepo($this->konekcija, "Korisnik");
        $repo->DohvatiKorisnikaPoEmailu($email);

        if ($repo->BrojZapisa == 1) {
            $hash = $repo->DajVrednostPoRednomBrojuZapisaPoRBPolja($repo->Kolekcija, 0, 4);
            if (password_verify($lozinka, $hash)) {
                $_SESSION['korisnikEmail'] = $repo->DajVrednostPoRednomBrojuZapisaPoRBPolja($repo->Kolekcija, 0, 3);
                $_SESSION['korisnikIme'] = $repo->DajVrednostPoRednomBrojuZapisaPoRBPolja($repo->Kolekcija, 0, 1);
                $_SESSION['korisnikTipNaziv'] = $repo->DajVrednostPoRednomBrojuZapisaPoRBPolja($repo->Kolekcija, 0, 6);
                header("Location: index.php?akcija=prikaz");
                exit;
            }
        }
        header("Location: index.php?akcija=prijava&greska=1");
    }

    public function odjaviSe() {
        session_destroy();
        header("Location: index.php?akcija=prijava");
    }
}
?>