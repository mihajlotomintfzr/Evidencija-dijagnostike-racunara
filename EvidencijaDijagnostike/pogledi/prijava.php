<?php require_once 'pogledi/delovi/zaglavlje.php'; ?>
<main class="sadrzaj">
    <section class="forma-sekcija">
        <h2>Prijava na sistem za dijagnostiku</h2>
        <?php if(isset($_GET['greska'])): ?>
            <p style="color:red; font-weight:bold;">Neispravni podaci za prijavu!</p>
        <?php endif; ?>
        <form class="forma" action="index.php?akcija=prijavaProces" method="POST">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="lozinka">Lozinka:</label>
            <input type="password" id="lozinka" name="lozinka" required>

            <button type="submit">Prijavi se</button>
        </form>
    </section>
</main>
<?php require_once 'pogledi/delovi/podnozje.php'; ?>