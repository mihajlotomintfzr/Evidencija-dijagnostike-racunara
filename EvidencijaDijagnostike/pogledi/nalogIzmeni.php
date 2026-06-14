<?php require_once 'pogledi/delovi/zaglavlje.php'; ?>
<?php
if($repo->BrojZapisa == 1) {
    $izvestajId = $repo->DajVrednostPoRednomBrojuZapisaPoRBPolja($repo->Kolekcija, 0, 0);
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
    $trenutniZaposleniId = $repo->DajVrednostPoRednomBrojuZapisaPoRBPolja($repo->Kolekcija, 0, 17);
}
?>

<main class="sadrzaj">
    <section class="forma-sekcija" style="max-width:1000px;">
        <h2>Ažuriranje izveštaja o dijagnostici (ID: #<?php echo $izvestajId; ?>)</h2>
        <form class="forma" action="index.php?akcija=azuriraj" method="POST" id="izvestajForma">
            
            <input type="hidden" name="izvestajId" value="<?php echo $izvestajId; ?>">

            <div class="dvokolona" style="display:flex; gap:20px;">
                <div style="flex:1;">
                    <label>Broj izveštaja:</label>
                    <input type="text" name="brojIzvestaja" id="brojIzvestaja" value="<?php echo $brojIzvestaja; ?>" required>

                    <label>Datum početka:</label>
                    <input type="date" name="datumPocetka" value="<?php echo $datumPocetka; ?>" required>

                    <label>Vreme početka:</label>
                    <input type="time" name="vremePocetka" value="<?php echo $vremePocetka; ?>" required>
                    
                    <label>Datum završetka:</label>
                    <input type="date" name="datumZavrsetka" value="<?php echo $datumZavrsetka; ?>">

                    <label>Vreme završetka:</label>
                    <input type="time" name="vremeZavrsetka" value="<?php echo $vremeZavrsetka; ?>">
                </div>
                
                <div style="flex:1;">
                    <label>Ime i prezime klijenta:</label>
                    <input type="text" name="klijentImePrezime" id="klijentImePrezime" value="<?php echo $klijent; ?>" required>

                    <label>Telefon klijenta:</label>
                    <input type="text" name="klijentTelefon" value="<?php echo $telefon; ?>">

                    <label>Email klijenta:</label>
                    <input type="email" name="klijentEmail" value="<?php echo $email; ?>">

                    <label>Serviser (Odgovorno lice):</label>
                    <select name="zaposleniId" required>
                        <?php
                        for($i=0; $i<$zaposleniRepo->BrojZapisa; $i++) {
                            $zId = $zaposleniRepo->DajVrednostPoRednomBrojuZapisaPoRBPolja($zaposleniRepo->Kolekcija, $i, 0);
                            $zIme = $zaposleniRepo->DajVrednostPoRednomBrojuZapisaPoRBPolja($zaposleniRepo->Kolekcija, $i, 1);
                            $zPrezime = $zaposleniRepo->DajVrednostPoRednomBrojuZapisaPoRBPolja($zaposleniRepo->Kolekcija, $i, 2);
                            $sel = ($zId == $trenutniZaposleniId) ? "selected" : "";
                            echo "<option value='$zId' $sel>$zPrezime $zIme</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>

            <hr style="margin:25px 0;">
            <h3>Podaci o računaru</h3>
            <div class="dvokolona" style="display:flex; gap:20px;">
                <div style="flex:1;">
                    <label>Tip uređaja:</label>
                    <select name="tipUredjaja">
                        <option value="PC" <?php if($tipUredjaja=='PC') echo 'selected'; ?>>PC</option>
                        <option value="Laptop" <?php if($tipUredjaja=='Laptop') echo 'selected'; ?>>Laptop</option>
                    </select>

                    <label>Marka i model:</label>
                    <input type="text" name="markaModel" value="<?php echo $markaModel; ?>" required>
                </div>
                <div style="flex:1;">
                    <label>Serijski broj:</label>
                    <input type="text" name="serijskiBroj" value="<?php echo $serijski; ?>">

                    <label>Operativni sistem:</label>
                    <input type="text" name="operativniSistem" value="<?php echo $os; ?>">
                </div>
            </div>
            
            <label>Konfiguracija:</label>
            <textarea name="konfiguracija" rows="3" required><?php echo $konfiguracija; ?></textarea>

            <hr style="margin:25px 0;">
            <h3>DETALJI DIJAGNOSTIKE (STAVKE DOKUMENTA)</h3>
            
            <table id="stavkeTabela" class="stavke-tabela" style="width:100%; margin-bottom:15px;">
                <thead>
                    <tr>
                        <th style="width:5%;">R.b.</th>
                        <th style="width:25%;">Dijagnostički postupak</th>
                        <th style="width:20%;">Korišćeni alat</th>
                        <th style="width:25%;">Rezultat analize</th>
                        <th style="width:20%;">Detektovan problem</th>
                        <th style="width:5%;">Ukloni</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if($repoStavke->BrojZapisa > 0) {
                        for($j=0; $j<$repoStavke->BrojZapisa; $j++) {
                            $stRB = $repoStavke->DajVrednostPoRednomBrojuZapisaPoRBPolja($repoStavke->Kolekcija, $j, 2);
                            $stPostupakId = $repoStavke->DajVrednostPoRednomBrojuZapisaPoRBPolja($repoStavke->Kolekcija, $j, 3);
                            $stAlat = $repoStavke->DajVrednostPoRednomBrojuZapisaPoRBPolja($repoStavke->Kolekcija, $j, 5);
                            $stRez = $repoStavke->DajVrednostPoRednomBrojuZapisaPoRBPolja($repoStavke->Kolekcija, $j, 6);
                            $stProb = $repoStavke->DajVrednostPoRednomBrojuZapisaPoRBPolja($repoStavke->Kolekcija, $j, 7);
                            
                            echo "<tr>";
                            echo "<td>$stRB</td>";
                            echo "<td><select name='postupakId[]'>";
                            for($k=0; $k<$postupakRepo->BrojZapisa; $k++) {
                                $pId = $postupakRepo->DajVrednostPoRednomBrojuZapisaPoRBPolja($postupakRepo->Kolekcija, $k, 0);
                                $pNaziv = $postupakRepo->DajVrednostPoRednomBrojuZapisaPoRBPolja($postupakRepo->Kolekcija, $k, 1);
                                $pSel = ($pId == $stPostupakId) ? "selected" : "";
                                echo "<option value='$pId' $pSel>$pNaziv</option>";
                            }
                            echo "</select></td>";
                            echo "<td><input type='text' name='korisceniAlat[]' value='$stAlat' required></td>";
                            echo "<td><input type='text' name='rezultatAnalize[]' value='$stRez' required></td>";
                            echo "<td><input type='text' name='detektovanProblem[]' value='$stProb' required></td>";
                            echo "<td><button type='button' class='btn-obrisi-stavku' onclick='this.closest(\"tr\").remove(); osveziRedneBrojeve();'>X</button></td>";
                            echo "</tr>";
                        }
                    }
                    ?>
                </tbody>
            </table>
            
            <button type="button" id="dodajStavku" class="btn-dodaj-stavku" style="margin-bottom:20px;">Dodaj novi postupak</button>

            <hr style="margin:25px 0;">
            <label>Zaključak dijagnostike:</label>
            <textarea name="zakljucak" rows="3" required><?php echo $zakljucak; ?></textarea>

            <label>Preporuka za popravku:</label>
            <textarea name="preporuka" rows="3" required><?php echo $preporuka; ?></textarea>

            <label>Napomena:</label>
            <textarea name="napomena" rows="2"><?php echo $napomena; ?></textarea>

            <button type="submit" style="background-color:#f39c12;">SAČUVAJ IZMENE IZVEŠTAJA</button>
        </form>
    </section>
</main>

<script>
const dostupniPostupci = [
    <?php
    for($i=0; $i<$postupakRepo->BrojZapisa; $i++) {
        echo "{ id: " . $postupakRepo->DajVrednostPoRednomBrojuZapisaPoRBPolja($postupakRepo->Kolekcija, $i, 0) . ", naziv: '" . $postupakRepo->DajVrednostPoRednomBrojuZapisaPoRBPolja($postupakRepo->Kolekcija, $i, 1) . "' },";
    }
    ?>
];

function osveziRedneBrojeve() {
    const tabela = document.querySelector('#stavkeTabela tbody');
    Array.from(tabela.rows).forEach((r, i) => r.cells[0].textContent = i + 1);
}

document.getElementById('dodajStavku').addEventListener('click', () => {
    const tabela = document.querySelector('#stavkeTabela tbody');
    const redovi = tabela.rows.length;
    const noviRed = tabela.insertRow();

    noviRed.insertCell().textContent = redovi + 1;

    const postupakCelija = noviRed.insertCell();
    const select = document.createElement('select');
    select.name = 'postupakId[]';
    dostupniPostupci.forEach(p => {
        const op = document.createElement('option');
        op.value = p.id; op.textContent = p.naziv;
        select.appendChild(op);
    });
    postupakCelija.appendChild(select);

    const alatCelija = noviRed.insertCell();
    const alatIn = document.createElement('input');
    alatIn.type = 'text'; alatIn.name = 'korisceniAlat[]'; alatIn.required = true;
    alatCelija.appendChild(alatIn);

    const rezCelija = noviRed.insertCell();
    const rezIn = document.createElement('input');
    rezIn.type = 'text'; rezIn.name = 'rezultatAnalize[]'; rezIn.required = true;
    rezCelija.appendChild(rezIn);

    const probCelija = noviRed.insertCell();
    const probIn = document.createElement('input');
    probIn.type = 'text'; probIn.name = 'detektovanProblem[]'; probIn.required = true;
    probCelija.appendChild(probIn);

    const obrisiCelija = noviRed.insertCell();
    const btn = document.createElement('button');
    btn.type = 'button'; btn.textContent = 'X'; btn.className = 'btn-obrisi-stavku';
    btn.addEventListener('click', () => {
        noviRed.remove();
        osveziRedneBrojeve();
    });
    obrisiCelija.appendChild(btn);
});
</script>
<?php require_once 'pogledi/delovi/podnozje.php'; ?>