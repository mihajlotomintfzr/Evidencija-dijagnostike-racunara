<?php
if($repo->BrojZapisa == 1) {
    $brojIzvestaja = $repo->DajVrednostPoRednomBrojuZapisaPoRBPolja($repo->Kolekcija, 0, 1);
    $datumPocetka = $repo->DajVrednostPoRednomBrojuZapisaPoRBPolja($repo->Kolekcija, 0, 2);
    $vremePocetka = $repo->DajVrednostPoRednomBrojuZapisaPoRBPolja($repo->Kolekcija, 0, 3);
    $datumZavrsetka = $repo->DajVrednostPoRednomBrojuZapisaPoRBPolja($repo->Kolekcija, 0, 4);
    $vremeZavrsetka = $repo->DajVrednostPoRednomBrojuZapisaPoRBPolja($repo->Kolekcija, 0, 5);
    $klijent = $repo->DajVrednostPoRednomBrojuZapisaPoRBPolja($repo->Kolekcija, 0, 6);
    $telefon = $repo->DajVrednostPoRednomBrojuZapisaPoRBPolja($repo->Kolekcija, 0, 7);
    $email = $repo->DajVrednostPoRednomBrojuZapisaPoRBPolja($repo->Kolekcija, 0, 8);
    $tipUredjaja = $repo->DajVrednostPoRednomBrojuZapisaPoRBPolja($repo->Kolekcija, 0, 9);
    $markaModel = $repo->DajVrednostPoRednomBrojuZapisaPoRBPolja($repo->Kolekcija, 0, 10);
    $serijski = $repo->DajVrednostPoRednomBrojuZapisaPoRBPolja($repo->Kolekcija, 0, 11);
    $os = $repo->DajVrednostPoRednomBrojuZapisaPoRBPolja($repo->Kolekcija, 0, 12);
    $konfiguracija = $repo->DajVrednostPoRednomBrojuZapisaPoRBPolja($repo->Kolekcija, 0, 13);
    $zakljucak = $repo->DajVrednostPoRednomBrojuZapisaPoRBPolja($repo->Kolekcija, 0, 14);
    $preporuka = $repo->DajVrednostPoRednomBrojuZapisaPoRBPolja($repo->Kolekcija, 0, 15);
    $napomena = $repo->DajVrednostPoRednomBrojuZapisaPoRBPolja($repo->Kolekcija, 0, 16);
    $serviserIme = $repo->DajVrednostPoRednomBrojuZapisaPoRBPolja($repo->Kolekcija, 0, 18);
    $serviserPrezime = $repo->DajVrednostPoRednomBrojuZapisaPoRBPolja($repo->Kolekcija, 0, 19);
}
?>
<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="UTF-8">
    <title>Štampa Izveštaja #<?php echo $brojIzvestaja; ?></title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; color: #000; line-height: 1.6; }
        .Naslov { text-align: center; text-transform: uppercase; margin-bottom: 30px; font-weight: bold; font-size: 18px; }
        .Sekcija { margin-top: 20px; font-weight: bold; text-decoration: underline; }
        .Podatak { margin-left: 10px; }
        .TabelaStavke { width: 100%; border-collapse: collapse; margin-top: 15px; }
        .TabelaStavke th, .TabelaStavke td { border: 1px solid #000; padding: 8px; text-align: left; font-size: 14px; }
        .TabelaStavke th { background-color: #f2f2f2; }
        .Potpisi { margin-top: 60px; display: flex; justify-content: space-between; }
        .Linija { border-top: 1px solid #000; width: 250px; text-align: center; margin-top: 40px; font-size: 13px; }
    </style>
</head>
<body onload="window.print()">

    <div style="font-size: 12px;">
        Univerzitet u Novom Sadu<br>
        Tehnički fakultet „Mihajlo Pupin“<br>
        Zrenjanin
    </div>
    
    <div class="Naslov"><br>Izveštaj o realizovanoj dijagnostici računara</div>

    <p>
        <strong>Broj izveštaja:</strong> <?php echo $brojIzvestaja; ?><br>
        <strong>Datum početka dijagnostike:</strong> <?php echo $datumPocetka; ?> &nbsp;&nbsp;&nbsp;&nbsp; <strong>Vreme početka:</strong> <?php echo $vremePocetka; ?><br>
        <strong>Datum završetka:</strong> <?php echo $datumZavrsetka; ?> &nbsp;&nbsp;&nbsp;&nbsp; <strong>Vreme završetka:</strong> <?php echo $vremeZavrsetka; ?>
    </p>

    <div class="Sekcija">Podaci o klijentu:</div>
    <ul>
        <li>Ime i prezime: <?php echo $klijent; ?></li>
        <li>Telefon: <?php echo $telefon; ?></li>
        <li>Email: <?php echo $email; ?></li>
    </ul>

    <div class="Sekcija">Podaci o računaru:</div>
    <ul>
        <li>Tip uređaja: <?php echo $tipUredjaja; ?></li>
        <li>Marka i model: <?php echo $markaModel; ?></li>
        <li>Serijski broj: <?php echo $serijski; ?></li>
        <li>Operativni sistem: <?php echo $os; ?></li>
        <li>Konfiguracija: <?php echo $konfiguracija; ?></li>
    </ul>

    <div class="Sekcija">DETALJI DIJAGNOSTIKE (STAVKE)</div>
    <table class="TabelaStavke">
        <thead>
            <tr>
                <th>R.b.</th>
                <th>Dijagnostički postupak</th>
                <th>Korišćeni alat</th>
                <th>Rezultat analize</th>
                <th>Detektovan problem</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if($repoStavke->BrojZapisa > 0) {
                for($j=0; $j<$repoStavke->BrojZapisa; $j++) {
                    $rb = $repoStavke->DajVrednostPoRednomBrojuZapisaPoRBPolja($repoStavke->Kolekcija, $j, 2);
                    $postupakNaziv = $repoStavke->DajVrednostPoRednomBrojuZapisaPoRBPolja($repoStavke->Kolekcija, $j, 4);
                    $alat = $repoStavke->DajVrednostPoRednomBrojuZapisaPoRBPolja($repoStavke->Kolekcija, $j, 5);
                    $rez = $repoStavke->DajVrednostPoRednomBrojuZapisaPoRBPolja($repoStavke->Kolekcija, $j, 6);
                    $prob = $repoStavke->DajVrednostPoRednomBrojuZapisaPoRBPolja($repoStavke->Kolekcija, $j, 7);
                    
                    echo "<tr>
                            <td>$rb</td>
                            <td>$postupakNaziv</td>
                            <td>$alat</td>
                            <td>$rez</td>
                            <td>$prob</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='5'>Nema stavki dijagnostike.</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <div class="Sekcija">Zaključak dijagnostike:</div>
    <p class="Podatak"><?php echo $zakljucak; ?></p>

    <div class="Sekcija">Preporuka za popravku:</div>
    <p class="Podatak"><?php echo $preporuka; ?></p>

    <div class="Sekcija">Napomena:</div>
    <p class="Podatak"><?php echo $napomena; ?></p>

    <div class="Potpisi">
        <div class="Linija">Potpis servisera<br>(<?php echo "$serviserPrezime $serviserIme"; ?>)</div>
        <div class="Linija">Potpis klijenta</div>
    </div>

</body>
</html>