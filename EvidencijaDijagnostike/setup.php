<?php
require_once 'klase/tehnoloskeKlase/BaznaKonekcija.php';

$konekcijaObjekat = new Konekcija("klase/tehnoloskeKlase/BaznaParametriKonekcije.xml");
$konekcijaObjekat->konektujSe();
$db = $konekcijaObjekat->konekcijaDB;

mysqli_query($db, "INSERT IGNORE INTO TipKorisnika (tipId, naziv) VALUES (1, 'Admin')");


$hash = password_hash('admin123', PASSWORD_DEFAULT);
$upit = "INSERT IGNORE INTO Korisnik (ime, prezime, email, lozinkaHash, tipId) 
         VALUES ('Glavni', 'Serviser', 'admin@servis.rs', '$hash', 1)";

if(mysqli_query($db, $upit)){
    echo "<h1>Sistem je spreman!</h1>";
    echo "<p>Korisnik je uspesno kreiran.</p>";
    echo "<p><b>Email:</b> admin@servis.rs</p>";
    echo "<p><b>Lozinka:</b> admin123</p>";
    echo "<a href='index.php'>Klikni ovde da se prijavis</a>";
} else {
    echo "Doslo je do greske: " . mysqli_error($db);
}
?>