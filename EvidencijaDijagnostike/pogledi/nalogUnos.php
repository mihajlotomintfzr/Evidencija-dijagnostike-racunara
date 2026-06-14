<?php require_once 'pogledi/delovi/zaglavlje.php'; ?>
<main class="sadrzaj">
    <section class="forma-sekcija" style="max-width:1000px;">
        <h2>Kreiranje novog izveštaja o dijagnostici (Master-Detail)</h2>
        <form class="forma" action="index.php?akcija=snimi" method="POST" id="izvestajForma">
            
            <div class="dvokolona" style="display:flex; gap:20px;">
                <div style="flex:1;">
                    <label>Broj izveštaja:</label>
                    <input type="text" name="brojIzvestaja" id="brojIzvestaja" required>

                    <label>Datum početka:</label>
                    <input type="date" name="datumPocetka" id="datumPocetka" value="<?php echo date('Y-m-d'); ?>" required>

                    <label>Vreme početka:</label>
                    <input type="time" name="vremePocetka" id="vremePocetka" value="<?php echo date('H:i'); ?>" required>
                    
                    <label>Datum završetka (Opciono):</label>
                    <input type="date" name="datumZavrsetka">

                    <label>Vreme završetka (Opciono):</label>
                    <input type="time" name="vremeZavrsetka">
                </div>
                
                <div style="flex:1;">
                    <label>Ime i prezime klijenta:</label>
                    <input type="text" name="klijentImePrezime" id="klijentImePrezime" required>

                    <label>Telefon klijenta:</label>
                    <input type="text" name="klijentTelefon">

                    <label>Email klijenta:</label>
                    <input type="email" name="klijentEmail">

                    <label>Serviser (Odgovorno lice):</label>
                    <select name="zaposleniId" required>
                        <?php
                        for($i=0; $i<$zaposleniRepo->BrojZapisa; $i++) {
                            $zId = $zaposleniRepo->DajVrednostPoRednomBrojuZapisaPoRBPolja($zaposleniRepo->Kolekcija, $i, 0);
                            $zIme = $zaposleniRepo->DajVrednostPoRednomBrojuZapisaPoRBPolja($zaposleniRepo->Kolekcija, $i, 1);
                            $zPrezime = $zaposleniRepo->DajVrednostPoRednomBrojuZapisaPoRBPolja($zaposleniRepo->Kolekcija, $i, 2);
                            echo "<option value='$zId'>$zPrezime $zIme</option>";
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
                        <option value="PC">PC</option>
                        <option value="Laptop">Laptop</option>
                    </select>

                    <label>Marka i model:</label>
                    <input type="text" name="markaModel" required>
                </div>
                <div style="flex:1;">
                    <label>Serijski broj:</label>
                    <input type="text" name="serijskiBroj">

                    <label>Operativni sistem:</label>
                    <input type="text" name="operativniSistem">
                </div>
            </div>
            
            <label>Konfiguracija (CPU, RAM, GPU, HDD/SSD):</label>
            <textarea name="konfiguracija" rows="3" required></textarea>

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
                    <tr>
                        <td>1</td>
                        <td>
                            <select name="postupakId[]">
                                <?php
                                for($i=0; $i<$postupakRepo->BrojZapisa; $i++) {
                                    $pId = $postupakRepo->DajVrednostPoRednomBrojuZapisaPoRBPolja($postupakRepo->Kolekcija, $i, 0);
                                    $pNaziv = $postupakRepo->DajVrednostPoRednomBrojuZapisaPoRBPolja($postupakRepo->Kolekcija, $i, 1);
                                    echo "<option value='$pId'>$pNaziv</option>";
                                }
                                ?>
                            </select>
                        </td>
                        <td><input type="text" name="korisceniAlat[]" required></td>
                        <td><input type="text" name="rezultatAnalize[]" required></td>
                        <td><input type="text" name="detektovanProblem[]" required></td>
                        <td><button type="button" class="btn-obrisi-stavku">X</button></td>
                    </tr>
                </tbody>
            </table>
            
            <button type="button" id="dodajStavku" class="btn-dodaj-stavku" style="margin-bottom:20px;">Dodaj novi postupak (Stavku)</button>

            <hr style="margin:25px 0;">
            <label>Zaključak dijagnostike:</label>
            <textarea name="zakljucak" rows="3" required></textarea>

            <label>Preporuka za popravku:</label>
            <textarea name="preporuka" rows="3" required></textarea>

            <label>Napomena:</label>
            <textarea name="napomena" rows="2"></textarea>

            <button type="submit" style="background-color:#27ae60;">SAČUVAJ KOMPLETAN IZVEŠTAJ</button>
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
        op.value = p.id;
        op.textContent = p.naziv;
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
        Array.from(tabela.rows).forEach((r, i) => r.cells[0].textContent = i + 1);
    });
    obrisiCelija.appendChild(btn);
});

document.getElementById('izvestajForma').addEventListener('submit', function(e) {
    const broj = document.getElementById('brojIzvestaja').value.trim();
    const klijent = document.getElementById('klijentImePrezime').value.trim();
    
    if(broj.length < 3) {
        alert('Broj izveštaja mora imati bar 3 karaktera!');
        e.preventDefault();
    }
    if(klijent.length < 4) {
        alert('Unesite kompletno ime i prezime klijenta!');
        e.preventDefault();
    }
});
</script>
<?php require_once 'pogledi/delovi/podnozje.php'; ?>