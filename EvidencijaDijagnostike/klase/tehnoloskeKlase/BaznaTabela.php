<?php
class Tabela{
    public $OtvorenaKonekcija;
    public $NazivBazePodataka;
    public $NazivTabele;
    public $TipMYSQL;
    public $Kolekcija;
    public $BrojZapisa;
    public $PrviRedZapisa;

    public function __construct($NovaOtvorenaKonekcija, $NoviNazivTabele){
        $this->OtvorenaKonekcija = $NovaOtvorenaKonekcija;
        $this->NazivBazePodataka = $NovaOtvorenaKonekcija->KompletanNazivBazePodataka;
        $this->NazivTabele = $NoviNazivTabele;
        $this->TipMYSQL = $NovaOtvorenaKonekcija->VerzijaMYSQLNaredbi;
    }

    public function UcitajSvePoUpitu($SQL){
        if ($this->TipMYSQL=="mysqli"){
            $this->Kolekcija = mysqli_query($this->OtvorenaKonekcija->konekcijaDB, $SQL);
            if($this->Kolekcija){
                $this->BrojZapisa = mysqli_num_rows($this->Kolekcija);
            } else {
                $this->BrojZapisa = 0;
            }
        } else {
            $this->Kolekcija = mysql_query($SQL);
            if($this->Kolekcija){
                $this->BrojZapisa = mysql_num_rows($this->Kolekcija);
            } else {
                $this->BrojZapisa = 0;
            }
        }
        return $this->BrojZapisa;
    }

    public function IzvrsiAktivanSQLUpit($AktivanSQLUpit) {
        if ($this->TipMYSQL=="mysqli"){
            $uspeh = mysqli_query($this->OtvorenaKonekcija->konekcijaDB, $AktivanSQLUpit);
        } else {
            $uspeh = mysql_query($AktivanSQLUpit);
        }
        return $uspeh;
    }

    public function DajVrednostPoRednomBrojuZapisaPoRBPolja($KolekcijaPodataka, $RedniBrojZapisa, $RedniBrojPolja){
        $VrednostPolja = "";
        if ($this->TipMYSQL=="mysqli"){
            mysqli_data_seek($KolekcijaPodataka, $RedniBrojZapisa);
            $Zapis = mysqli_fetch_array($KolekcijaPodataka);
            $VrednostPolja = $Zapis[$RedniBrojPolja];
        } else {
            $VrednostPolja = mysql_result($KolekcijaPodataka, $RedniBrojZapisa, $RedniBrojPolja);
        }
        return $VrednostPolja;
    }
}
?>