<?php require_once 'pogledi/delovi/zaglavlje.php'; ?>
<?php
if($repo->BrojZapisa == 1) {
    $brojIzvestaja = $repo->DajVrednostPoRednomBrojuZapisaPoRBPolja($repo->Kolekcija, 0, 1);
    $datumPocetka = $repo->DajVrednostPoRednomBrojuZapisaPoRBPolja($repo->Kolekcija, 0, 2);
    $vremePocetka = $repo->DajVrednostPoRednomBrojuZapisaPoRBPolja($repo->Kolekcija, 0, 3);
    $klijent = $repo->DajVrednostPoRednomBrojuZapisaPoRBPolja($repo->Kolekcija, 0, 6);
    $tipUredjaja = $repo->DajVrednostPoRednomBrojuZapisaPoRBPolja($repo->Kolekcija, 0, 9);
    $markaModel = $repo->DajVrednostPoRednomBrojuZapisaPoRBPolja($repo->Kolekcija, 0, 10);
    $konfiguracija = $repo->DajVrednostPoRednomBrojuZapisaPoRBPolja($repo->Kolekcija, 0, 13);
    $zakljucak = $repo->DajVrednostPoRednomBrojuZapisaPoRBPolja($repo->Kolekcija, 0, 14);
    $preporuka = $repo->DajVrednostPoRednomBrojuZapisaPoRBPolja($repo->Kolekcija, 0, 15);
}
?>
<main class="sadrzaj">
    <section class="forma-sekcija" style="max-width:900px; margin: 0 auto;">
        <h2>Pregled izveštaja: <?php echo $brojIzvestaja; ?></h2>
        <hr style="border: 1px solid #e0e0e0; margin-bottom: 20px;">
        
        <p><strong>Datum i vreme:</strong> <?php echo $datumPocetka . " u " . $vremePocetka; ?></p>
        <p><strong>Klijent:</strong> <?php echo $klijent; ?></p>
        <p><strong>Uređaj:</strong> <?php echo $tipUredjaja . " - " . $markaModel; ?></p>
        <p><strong>Konfiguracija:</strong> <?php echo nl2br($konfiguracija); ?></p>
        
        <h3 style="margin-top:30px; color:#0d47a1;">Stavke dijagnostike</h3>
        <table class="tabela" style="margin-bottom: 20px;">
            <thead>
                <tr>
                    <th>R.b.</th>
                    <th>Postupak</th>
                    <th>Alat</th>
                    <th>Rezultat</th>
                    <th>Problem</th>
                </tr>
            </thead>
            <tbody>
                <?php
                for($j=0; $j<$repoStavke->BrojZapisa; $j++) {
                    echo "<tr>";
                    echo "<td>" . ($j+1) . "</td>";
                    echo "<td>" . $repoStavke->DajVrednostPoRednomBrojuZapisaPoRBPolja($repoStavke->Kolekcija, $j, 4) . "</td>";
                    echo "<td>" . $repoStavke->DajVrednostPoRednomBrojuZapisaPoRBPolja($repoStavke->Kolekcija, $j, 5) . "</td>";
                    echo "<td>" . $repoStavke->DajVrednostPoRednomBrojuZapisaPoRBPolja($repoStavke->Kolekcija, $j, 6) . "</td>";
                    echo "<td>" . $repoStavke->DajVrednostPoRednomBrojuZapisaPoRBPolja($repoStavke->Kolekcija, $j, 7) . "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
        
        <p><strong>Zaključak:</strong> <?php echo nl2br($zakljucak); ?></p>
        <p><strong>Preporuka:</strong> <?php echo nl2br($preporuka); ?></p>
        
        <a href="index.php?akcija=prikaz" class="btn-sve" style="display:inline-block; margin-top:20px;">Nazad na listu</a>
    </section>
</main>
<?php require_once 'pogledi/delovi/podnozje.php'; ?>