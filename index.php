<?php include("page/connexion.php");?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil - Ever</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="assets/js/script.js" defer=""></script>
</head>
<body>
<nav>
    <img src="assets/img/logo.svg" alt="Ever">
    <img class="hamburger" src="assets/icon/bars-solid-full.svg" alt="menu hamburger">
        <ul>
            <li><a href="#">Accueil</a></li>
            <li><a href="page/panier.php">Panier</a></li>
            <li><a href="#contact">Contact</a></li>
        </ul>
</nav>
    <header>
        <div>
            <h1>Mangez sain et dépensez moins</h1>
            <p>Choisissez un aliment pour regarder ses valeurs nutritionnelles et son prix</p>
            <button onclick="document.getElementById('down').scrollIntoView({behavior: 'smooth'});">Remplir le panier</button>
        </div>
    </header>
    <main id="down">
        <?php
        $sql = "SELECT * FROM aliment";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        foreach ($rows as $row) {
        ?>
        <div href class="aliment-card">
            <a href="page/fiche.php?id=<?php echo $row["id"];?>"><img class="aliment-img" src="assets/img/<?php echo $row["id"];?>.png" alt="<?php echo $row["nom"];?>"></a>
            <p><?php echo $row["nom"];?></p>
            <p><?php echo $row["qtt"];?> kg</p>
            <div class="bag-content">
                <p><?php echo $row["prix"];?> MGA</p>
                <a href="page/traitement.php?id=<?php echo $row["id"];?>"><img src="assets/img/sac-de-courses.png" alt="sac"></a>
            </div>
        </div>
        <?php
        }
} else {
    echo "⚠ Aucun résultat.";
}
$conn->close();
        ?>
    </main>
    <footer id="contact"></footer>
</body>
</html>