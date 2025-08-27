<?php
$host = "localhost";
$user = "root";
$pass = "2032";
$dbname = "my_db";

// Connexion
$conn = new mysqli($host, $user, $pass, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("❌ Connexion échouée : " . $conn->connect_error);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
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
        // Exemple de requête
        $sql = "SELECT * FROM aliment";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
        // Transformer le résultat en tableau
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        // Utiliser foreach
        foreach ($rows as $row) {
        ?>
        <div class="aliment-card">
            <img src="<?php echo $row["id"];?>" alt="">
            <p><?php echo $row["nom"];?></p>
            <p><?php echo $row["qtt"];?></p>
            <div>
                <p><?php echo $row["prix"];?></p>
                <a href=""></a>
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