<?php
class Transakcija{
    private $OtvorenaKonekcija;
    private $VerzijaMySQLNaredbi;

    public function __construct($NovaOtvorenaKonekcija){
        $this->OtvorenaKonekcija=$NovaOtvorenaKonekcija;
        $this->VerzijaMySQLNaredbi=$NovaOtvorenaKonekcija->VerzijaMYSQLNaredbi;
    }

    public function ZapocniTransakciju(){
        if ($this->VerzijaMySQLNaredbi=="mysqli"){
            mysqli_query($this->OtvorenaKonekcija->konekcijaDB,"SET AUTOCOMMIT=0");
            mysqli_query($this->OtvorenaKonekcija->konekcijaDB,"START TRANSACTION");
        } else {
            mysql_query("SET AUTOCOMMIT=0");
            mysql_query("START TRANSACTION");
        }
    }

    public function ProveriGresku(){
        if ($this->VerzijaMySQLNaredbi=="mysqli"){
            $greska = mysqli_error($this->OtvorenaKonekcija->konekcijaDB);	
        } else {
            $greska = mysql_error();	
        }
        return $greska;
    }

    public function PonistiTransakciju(){
        if ($this->VerzijaMySQLNaredbi=="mysqli"){
            mysqli_query($this->OtvorenaKonekcija->konekcijaDB,"ROLLBACK");
        } else {
            mysql_query("ROLLBACK");
        }
    }

    public function ZavrsiTransakciju($UtvrdjenaGreska){
        if (strlen($UtvrdjenaGreska)>0){
            $this->PonistiTransakciju();
        } else {
            if ($this->VerzijaMySQLNaredbi=="mysqli"){
                mysqli_query($this->OtvorenaKonekcija->konekcijaDB,"COMMIT");
            } else {
                mysql_query("COMMIT");
            }
        }
        if ($this->VerzijaMySQLNaredbi=="mysqli"){
            mysqli_query($this->OtvorenaKonekcija->konekcijaDB,"SET AUTOCOMMIT=1");
        } else {
            mysql_query("SET AUTOCOMMIT=1");
        }
    }
}
?>