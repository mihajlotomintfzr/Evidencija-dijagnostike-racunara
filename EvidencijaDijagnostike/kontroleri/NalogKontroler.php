<?php
class NalogKontroler {
    private $konekcija;

    public function __construct($konekcija) {
        $this->konekcija = $konekcija;
    }

    public function snimiNalog($podaci) {
        require_once 'klase/entiteti/ZaposleniEntitet.php';
        require_once 'klase/entiteti/IzvestajEntitet.php';
        require_once 'klase/entiteti/StavkaIzvestajaEntitet.php';
        require_once 'klase/repozitorijumi/IzvestajRepo.php';
        require_once 'klase/tehnoloskeKlase/BaznaTransakcija.php';

        $izvestaj = new IzvestajEntitet();
        $izvestaj->setBrojIzvestaja($podaci['brojIzvestaja']);
        $izvestaj->setDatumPocetka($podaci['datumPocetka']);
        $izvestaj->setVremePocetka($podaci['vremePocetka']);
        $izvestaj->setDatumZavrsetka(!empty($podaci['datumZavrsetka']) ? $podaci['datumZavrsetka'] : null);
        $izvestaj->setVremeZavrsetka(!empty($podaci['vremeZavrsetka']) ? $podaci['vremeZavrsetka'] : null);
        $izvestaj->setKlijentImePrezime($podaci['klijentImePrezime']);
        $izvestaj->setKlijentTelefon($podaci['klijentTelefon']);
        $izvestaj->setKlijentEmail($podaci['klijentEmail']);
        $izvestaj->setTipUredjaja($podaci['tipUredjaja']);
        $izvestaj->setMarkaModel($podaci['markaModel']);
        $izvestaj->setSerijskiBroj($podaci['serijskiBroj']);
        $izvestaj->setOperativniSistem($podaci['operativniSistem']);
        $izvestaj->setKonfiguracija($podaci['konfiguracija']);
        $izvestaj->setZakljucak($podaci['zakljucak']);
        $izvestaj->setPreporuka($podaci['preporuka']);
        $izvestaj->setNapomena($podaci['napomena']);
        
        $serviser = new ZaposleniEntitet();
        $serviser->setZaposleniId($podaci['zaposleniId']);
        $izvestaj->setZaposleni($serviser);

     
        $transakcija = new Transakcija($this->konekcija);
        $transakcija->ZapocniTransakciju();

        $repo = new IzvestajRepo($this->konekcija, "Izvestaj");
        $uspeh = $repo->DodajIzvestaj($izvestaj);
        
        if($uspeh) {
            $izvestajId = $repo->DohvatiPoslednjiId();
            
            
            if(isset($podaci['postupakId']) && is_array($podaci['postupakId'])) {
                for($idx = 0; $idx < count($podaci['postupakId']); $idx++) {
                    $postupakId = intval($podaci['postupakId'][$idx]);
                    $alat = $podaci['korisceniAlat'][$idx];
                    $rezultat = $podaci['rezultatAnalize'][$idx];
                    $problem = $podaci['detektovanProblem'][$idx];
                    
                    $uspehStavka = $repo->DodajStavkuPrekoProcedure($izvestajId, $postupakId, $alat, $rezultat, $problem);
                    if(!$uspehStavka) {
                        $uspeh = false;
                        break;
                    }
                }
            }
        }

        // Сачувај све ако је у реду, поништи све ако је пукло (COMMIT / ROLLBACK)
        $greska = $transakcija->ProveriGresku();
        $transakcija->ZavrsiTransakciju($greska);

        header("Location: index.php?akcija=prikaz");
    }

    public function obrisi($id) {
        require_once 'klase/repozitorijumi/IzvestajRepo.php';
        $repo = new IzvestajRepo($this->konekcija, "Izvestaj");
        $repo->ObrisiIzvestaj($id);
        header("Location: index.php?akcija=prikaz");
    }

public function azurirajNalog($podaci) {
        require_once 'klase/entiteti/ZaposleniEntitet.php';
        require_once 'klase/entiteti/IzvestajEntitet.php';
        require_once 'klase/repozitorijumi/IzvestajRepo.php';
        require_once 'klase/tehnoloskeKlase/BaznaTransakcija.php';

        $izvestajId = intval($podaci['izvestajId']);

        $izvestaj = new IzvestajEntitet();
        $izvestaj->setIzvestajId($izvestajId);
        $izvestaj->setBrojIzvestaja($podaci['brojIzvestaja']);
        $izvestaj->setDatumPocetka($podaci['datumPocetka']);
        $izvestaj->setVremePocetka($podaci['vremePocetka']);
        $izvestaj->setDatumZavrsetka(!empty($podaci['datumZavrsetka']) ? $podaci['datumZavrsetka'] : null);
        $izvestaj->setVremeZavrsetka(!empty($podaci['vremeZavrsetka']) ? $podaci['vremeZavrsetka'] : null);
        $izvestaj->setKlijentImePrezime($podaci['klijentImePrezime']);
        $izvestaj->setKlijentTelefon($podaci['klijentTelefon']);
        $izvestaj->setKlijentEmail($podaci['klijentEmail']);
        $izvestaj->setTipUredjaja($podaci['tipUredjaja']);
        $izvestaj->setMarkaModel($podaci['markaModel']);
        $izvestaj->setSerijskiBroj($podaci['serijskiBroj']);
        $izvestaj->setOperativniSistem($podaci['operativniSistem']);
        $izvestaj->setKonfiguracija($podaci['konfiguracija']);
        $izvestaj->setZakljucak($podaci['zakljucak']);
        $izvestaj->setPreporuka($podaci['preporuka']);
        $izvestaj->setNapomena($podaci['napomena']);
        
        $serviser = new ZaposleniEntitet();
        $serviser->setZaposleniId($podaci['zaposleniId']);
        $izvestaj->setZaposleni($serviser);

        $transakcija = new Transakcija($this->konekcija);
        $transakcija->ZapocniTransakciju();

        $repo = new IzvestajRepo($this->konekcija, "Izvestaj");
        $uspeh = $repo->AzurirajIzvestaj($izvestaj);
        
        if($uspeh) {
            $uspehObrisi = $repo->ObrisiStavkeIzvestaja($izvestajId);
            
            if($uspehObrisi && isset($podaci['postupakId']) && is_array($podaci['postupakId'])) {
                for($idx = 0; $idx < count($podaci['postupakId']); $idx++) {
                    $postupakId = intval($podaci['postupakId'][$idx]);
                    $alat = $podaci['korisceniAlat'][$idx];
                    $rezultat = $podaci['rezultatAnalize'][$idx];
                    $problem = $podaci['detektovanProblem'][$idx];
                    
                    $uspehStavka = $repo->DodajStavkuPrekoProcedure($izvestajId, $postupakId, $alat, $rezultat, $problem);
                    if(!$uspehStavka) {
                        $uspeh = false;
                        break;
                    }
                }
            } else if (!$uspehObrisi) {
                $uspeh = false;
            }
        }

        $greska = $transakcija->ProveriGresku();
        $transakcija->ZavrsiTransakciju($greska);

        header("Location: index.php?akcija=prikaz");
    }

}
?>