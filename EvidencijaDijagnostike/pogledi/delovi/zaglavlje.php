<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="UTF-8">
    <title>Dijagnostika Računara</title>
    <link rel="stylesheet" href="css/stil.css">
</head>
<body>
    <header class="zaglavlje">
        <div class="logo">
            <h1>Servis IT</h1>
        </div>
        <nav class="meni">
            <ul>
                <?php if(isset($_SESSION['korisnikEmail'])): ?>
                    <li>Dobrodošli, <?php echo $_SESSION['korisnikIme'] . " (" . $_SESSION['korisnikTipNaziv'] . ")"; ?></li>
                    <li><a href="index.php?akcija=prikaz">Lista izveštaja</a></li>
                    <li><a href="index.php?akcija=dodaj">Novi izveštaj</a></li>
                    <li><a href="index.php?akcija=odjava">Odjavi se</a></li>
                <?php else: ?>
                    <li><a href="index.php?akcija=prijava">Prijava</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>