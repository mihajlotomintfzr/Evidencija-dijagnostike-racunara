<?php
session_start();
require_once 'klase/tehnoloskeKlase/BaznaKonekcija.php';
require_once 'klase/tehnoloskeKlase/BaznaTabela.php';

$konekcijaObjekat = new Konekcija("klase/tehnoloskeKlase/BaznaParametriKonekcije.xml");
$konekcijaObjekat->konektujSe();

$akcija = isset($_GET['akcija']) ? $_GET['akcija'] : 'prikaz';


if (!isset($_SESSION['korisnikEmail']) && $akcija != 'prijava' && $akcija != 'prijavaProces') {
    $akcija = 'prijava';
}

switch ($akcija) {
    case 'prijava':
        require_once 'pogledi/prijava.php';
        break;
        
    case 'prijavaProces':
        require_once 'kontroleri/KorisnikKontroler.php';
        $kontroler = new KorisnikKontroler($konekcijaObjekat);
        $kontroler->priјаviSe($_POST['email'], $_POST['lozinka']);
        break;
        
    case 'odjava':
        require_once 'kontroleri/KorisnikKontroler.php';
        $kontroler = new KorisnikKontroler($konekcijaObjekat);
        $kontroler->odjaviSe();
        break;

    case 'prikaz':
        require_once 'klase/repozitorijumi/IzvestajRepo.php';
        $repo = new IzvestajRepo($konekcijaObjekat, "Izvestaj");
        $filter = isset($_GET['filter']) ? $_GET['filter'] : "";
        $repo->FiltrirajIzveštaje($filter);
        require_once 'pogledi/nalogPrikaz.php';
        break;

    case 'dodaj':
        require_once 'klase/repozitorijumi/ZaposleniRepo.php';
        $zaposleniRepo = new ZaposleniRepo($konekcijaObjekat, "Zaposleni");
        $zaposleniRepo->DohvatiSveZaposlene();
        
        require_once 'klase/repozitorijumi/PostupakRepo.php';
        $postupakRepo = new PostupakRepo($konekcijaObjekat, "Postupak");
        $postupakRepo->DohvatiSvePostupke();
        
        require_once 'pogledi/nalogUnos.php';
        break;

    case 'snimi':
        require_once 'kontroleri/NalogKontroler.php';
        $kontroler = new NalogKontroler($konekcijaObjekat);
        $kontroler->snimiNalog($_POST);
        break;

    case 'obrisi':
        require_once 'kontroleri/NalogKontroler.php';
        $kontroler = new NalogKontroler($konekcijaObjekat);
        $kontroler->obrisi($_GET['id']);
        break;

    case 'stampa':
        require_once 'klase/repozitorijumi/IzvestajRepo.php';
        $repo = new IzvestajRepo($konekcijaObjekat, "Izvestaj");
        $repo->DohvatiIzvestajPoId($_GET['id']);
        $repoStavke = new IzvestajRepo($konekcijaObjekat, "StavkaIzvestaja");
        $repoStavke->DohvatiStavkePoIdIzvestaja($_GET['id']);
        require_once 'pogledi/nalogStampa.php';
        break;

   
    case 'api-postupci':
        require_once 'kontroleri/ApiKontroler.php';
        $kontroler = new ApiKontroler($konekcijaObjekat);
        $kontroler->ucitajPostupke();
        break;

    default:
        echo "<h1>404 Страница није пронађена</h1>";
        break;

case 'izmeni':
        require_once 'klase/repozitorijumi/ZaposleniRepo.php';
        $zaposleniRepo = new ZaposleniRepo($konekcijaObjekat, "Zaposleni");
        $zaposleniRepo->DohvatiSveZaposlene();
        
        require_once 'klase/repozitorijumi/PostupakRepo.php';
        $postupakRepo = new PostupakRepo($konekcijaObjekat, "Postupak");
        $postupakRepo->DohvatiSvePostupke();

        require_once 'klase/repozitorijumi/IzvestajRepo.php';
        $repo = new IzvestajRepo($konekcijaObjekat, "Izvestaj");
        $repo->DohvatiIzvestajPoId($_GET['id']);
        
        $repoStavke = new IzvestajRepo($konekcijaObjekat, "StavkaIzvestaja");
        $repoStavke->DohvatiStavkePoIdIzvestaja($_GET['id']);
        
        require_once 'pogledi/nalogIzmeni.php';
        break;

    case 'azuriraj':
        require_once 'kontroleri/NalogKontroler.php';
        $kontroler = new NalogKontroler($konekcijaObjekat);
        $kontroler->azurirajNalog($_POST);
        break;

        case 'detalji':
        require_once 'klase/repozitorijumi/IzvestajRepo.php';
        $repo = new IzvestajRepo($konekcijaObjekat, "Izvestaj");
        $repo->DohvatiIzvestajPoId($_GET['id']);
        
        $repoStavke = new IzvestajRepo($konekcijaObjekat, "StavkaIzvestaja");
        $repoStavke->DohvatiStavkePoIdIzvestaja($_GET['id']);
        
        require_once 'pogledi/nalogDetalji.php';
        break;

    case 'stampa-spiska':
        require_once 'klase/repozitorijumi/IzvestajRepo.php';
        $repo = new IzvestajRepo($konekcijaObjekat, "Izvestaj");
        
        if (isset($_GET['filter']) && !empty($_GET['filter'])) {
            $repo->DohvatiFiltriraneIzvestaje($_GET['filter']);
        } else {
            $repo->DohvatiSveIzvestaje();
        }
        require_once 'pogledi/nalogStampaSpiska.php';
        break;

}
?>