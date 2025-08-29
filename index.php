<?php include("page/connexion.php");?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site pour l'alimentation</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <nav>
        <h2>4ever</h2>
        <ul>
            <li><a href="">Accueil</a></li>
            <li><a href="panier.php">Panier</a></li>
            <li><a href="">Contact</a></li>
        </ul>
    </nav>
    <header>
        <div>
            <h1>Mangez sain et dépensez moins</h1>
            <p>Choisissez un aliment pour regarder ses valeurs nutritionnelles et son prix</p>
            <button onclick="document.getElementById('bas').scrollIntoView({behavior: 'smooth'});">Remplir le panier</button>
        </div>
    </header>
    <main id="bas">
        <?php
        $sql = "SELECT * FROM aliment";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
        // Transformer le résultat en tableau
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        foreach ($rows as $row) {
        ?>
        <div href class="aliment-card">
            <a href="page/fiche.php?id=<?php echo $row["id"];?>"><img class="aliment-img" src="assets/img/carotte.png" alt="aliment"></a>
            <p><?php echo $row["nom"];?></p>
            <p><?php echo $row["qtt"];?></p>
            <div class="bag-content">
                <p><?php echo $row["prix"];?></p>
                <a href=""><img src="assets/img/sac-de-courses.png" alt="sac"></a>
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
    <footer></footer>
</body>
</html>