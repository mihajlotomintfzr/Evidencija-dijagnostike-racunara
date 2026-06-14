<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="UTF-8">
    <title>Štampa svih izveštaja</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 30px; color: #333; }
        h2 { text-align: center; margin-bottom: 5px; }
        p.podnaslov { text-align: center; color: #666; margin-bottom: 30px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #999; padding: 12px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body onload="window.print();">

    <h2>IT Servis - Evidencija Dijagnostike</h2>
    <p class="podnaslov">Izveštaj o realizovanim dijagnostikama (Grupni pregled)</p>

    <table>
        <thead>
            <tr>
                <th>Broj izveštaja</th>
                <th>Datum</th>
                <th>Klijent</th>
                <th>Uređaj</th>
                <th>Marka i Model</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if($repo->BrojZapisa > 0) {
                for($i=0; $i<$repo->BrojZapisa; $i++) {
                    echo "<tr>";
                    echo "<td><strong>" . $repo->DajVrednostPoRednomBrojuZapisaPoRBPolja($repo->Kolekcija, $i, 1) . "</strong></td>";
                    echo "<td>" . $repo->DajVrednostPoRednomBrojuZapisaPoRBPolja($repo->Kolekcija, $i, 2) . "</td>";
                    echo "<td>" . $repo->DajVrednostPoRednomBrojuZapisaPoRBPolja($repo->Kolekcija, $i, 6) . "</td>";
                    echo "<td>" . $repo->DajVrednostPoRednomBrojuZapisaPoRBPolja($repo->Kolekcija, $i, 9) . "</td>";
                    echo "<td>" . $repo->DajVrednostPoRednomBrojuZapisaPoRBPolja($repo->Kolekcija, $i, 10) . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>Nema zapisa.</td></tr>";
            }
            ?>
        </tbody>
    </table>

</body>
</html>