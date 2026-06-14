<?php
class Konekcija{
    public $konekcijaMYSQL;
    public $konekcijaDB;
    public $KompletanNazivBazePodataka;
    public $VerzijaMYSQLNaredbi;
    private $PutanjaNazivFajlaXMLParametriKonekcije;
    private $host;
    private $korisnik;
    private $sifra;
    private $prefiks_baze_podataka;
    private $naziv_baze_podataka;

    private function UcitajVerzijuMYSQLNaredbi(){
        $VerzijaPHP = phpversion();
        if ($VerzijaPHP<'7.0.0') { $this->VerzijaMYSQLNaredbi="mysql"; }
        else { $this->VerzijaMYSQLNaredbi="mysqli"; }
    }

    private function UcitajParametreKonekcije($PutanjaNazivFajlaXMLParametriKonekcije){
        $xml=simplexml_load_file($PutanjaNazivFajlaXMLParametriKonekcije);
        $this->host = $xml->host;
        $this->korisnik = $xml->korisnik;
        $this->sifra = $xml->sifra;
        $this->prefiks_baze_podataka = $xml->prefiks_baze_podataka;
        $this->naziv_baze_podataka = $xml->naziv_baze_podataka;
        $this->KompletanNazivBazePodataka = $this->prefiks_baze_podataka . $this->naziv_baze_podataka;
    }

    public function __construct($NovaPutanjaNazivFajlaXMLParametriKonekcije){
        $this->PutanjaNazivFajlaXMLParametriKonekcije=$NovaPutanjaNazivFajlaXMLParametriKonekcije; 
        $this->UcitajVerzijuMYSQLNaredbi();
        $this->UcitajParametreKonekcije($NovaPutanjaNazivFajlaXMLParametriKonekcije);
    }

    public function konektujSe(){
        if ($this->VerzijaMYSQLNaredbi=="mysqli"){
            $this->konekcijaDB = mysqli_connect($this->host, $this->korisnik, $this->sifra, $this->KompletanNazivBazePodataka);
        } else {
            $this->konekcijaMYSQL = mysql_connect($this->host, $this->korisnik, $this->sifra);
            $this->konekcijaDB = mysql_select_db($this->KompletanNazivBazePodataka, $this->konekcijaMYSQL);
        }
        if ($this->konekcijaDB){
           if ($this->VerzijaMYSQLNaredbi=="mysqli") { mysqli_set_charset($this->konekcijaDB,"utf8"); }
        }
    }

    public function diskonektujSe(){
        if ($this->VerzijaMYSQLNaredbi=="mysqli"){ mysqli_close($this->konekcijaDB); }
        else { mysql_close($this->konekcijaMYSQL); }
    }
}
?>