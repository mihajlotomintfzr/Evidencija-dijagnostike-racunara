<?php require_once 'pogledi/delovi/zaglavlje.php'; ?>
<main class="sadrzaj">
    <section class="hero">
        <h2>Izveštaji o realizovanim dijagnostikama računara</h2>
        <p>Pretražujte izveštaje, štampajte pojedinačne dokumente i upravljajte podacima servisa.</p>
    </section>

    <form method="GET" action="index.php" class="filter-forma">
        <input type="hidden" name="akcija" value="prikaz">
        <input type="text" name="filter" class="filter-input" placeholder="Unesite ime klijenta ili broj izveštaja..." value="<?php echo isset($_GET['filter']) ? $_GET['filter'] : ''; ?>">
        <div class="filter-dugmad">
            <button type="submit" class="btn-filter">Filtriraj</button>
            <a href="index.php?akcija=prikaz" class="btn-sve">Svi izveštaji</a>
            <a target="_blank" href="index.php?akcija=stampa-spiska<?php echo isset($_GET['filter']) ? '&filter='.urlencode($_GET['filter']) : ''; ?>" class="btn-primary" style="background-color:#455a64;">Štampaj spisak</a>
        </div>
    </form>

    <section class="tabela-sekcija">
        <table class="tabela">
            <thead>
                <tr>
                    <th>Broj izveštaja</th>
                    <th>Datum</th>
                    <th>Klijent</th>
                    <th>Uređaj</th>
                    <th>Marka i Model</th>
                    <th>Serviser</th>
                    <th>KONTROLE</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if($repo->BrojZapisa > 0) {
                    for($i=0; $i<$repo->BrojZapisa; $i++) {
                        $id = $repo->DajVrednostPoRednomBrojuZapisaPoRBPolja($repo->Kolekcija, $i, 0);
                        $broj = $repo->DajVrednostPoRednomBrojuZapisaPoRBPolja($repo->Kolekcija, $i, 1);
                        $datum = $repo->DajVrednostPoRednomBrojuZapisaPoRBPolja($repo->Kolekcija, $i, 2);
                        $klijent = $repo->DajVrednostPoRednomBrojuZapisaPoRBPolja($repo->Kolekcija, $i, 6);
                        $tip = $repo->DajVrednostPoRednomBrojuZapisaPoRBPolja($repo->Kolekcija, $i, 9);
                        $model = $repo->DajVrednostPoRednomBrojuZapisaPoRBPolja($repo->Kolekcija, $i, 10);
                        $serviserIme = $repo->DajVrednostPoRednomBrojuZapisaPoRBPolja($repo->Kolekcija, $i, 17);
                        $serviserPrezime = $repo->DajVrednostPoRednomBrojuZapisaPoRBPolja($repo->Kolekcija, $i, 18);

                        echo "<tr>";
                        echo "<td><strong>$broj</strong></td>";
                        echo "<td>$datum</td>";
                        echo "<td>$klijent</td>";
                        echo "<td>$tip</td>";
                        echo "<td>$model</td>";
                        echo "<td>$serviserPrezime $serviserIme</td>";
                        echo "<td class='akcije'>
                                <a class='btn-prikazi-vise' href='index.php?akcija=detalji&id=$id'>Detalji</a>
                                <a class='btn-prikazi-vise' style='background-color:#0277bd;' target='_blank' href='index.php?akcija=stampa&id=$id'>Štampa</a>
                                <a class='btn-izmeni' href='index.php?akcija=izmeni&id=$id'>Izmeni</a>
                                <a class='btn-obrisi' href='index.php?akcija=obrisi&id=$id' onclick=\"return confirm('Da li ste sigurni da želite brisanje?');\">Obriši</a>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>Nema evidentiranih izveštaja za traženi kriterijum.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </section>
</main>
<?php require_once 'pogledi/delovi/podnozje.php'; ?>