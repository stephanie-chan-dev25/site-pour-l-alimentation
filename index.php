<?php include("page/connexion.php");?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil - Ever</title>
    <link rel="stylesheet" href="assets/css/recette.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="assets/js/script.js" defer=""></script>
</head>
<body>
<nav>
    <img src="assets/img/logo.svg" alt="Ever">
    <img class="black-hamburger" src="assets/icon/bars-solid-full.svg" alt="menu hamburger">
    <img class="green-hamburger" src="assets/icon/hamburger-vert.svg" alt="menu hamburger">
        <ul>
            <li><a href="#">HOME</a></li>
            <li><a href="page/recette.php">RECIPES</a></li>
            <li><a href="page/panier.php">BASKET</a></li>
            <li><a href="#contact">CONTACTS</a></li>
        </ul>
</nav>
    <header>
        <div>
            <h1>Eat healthy and spend less</h1>
            <p>Choose a food to see its nutritional values ans price</p>
            <button onclick="document.getElementById('down').scrollIntoView({behavior: 'smooth'});">FILL THE BASKET</button>
        </div>
    </header>
    <main id="down">
    <form method="GET">
        <input type="text" name="aliment" placeholder="Search for food">
        <input type="submit" value="Valider">
    </form>
        <div class="content-aliment-card">
            <?php
            if (isset($_GET["aliment"])) {
                $nom = $_GET["aliment"];
                $sql2 = $conn->prepare("SELECT * FROM aliment WHERE nom = ?");
                $sql2->bind_param("s", $nom);
                $sql2->execute();    
                $result2 = $sql2->get_result();
                if ($result2->num_rows > 0) {
                    while ($rows2 = $result2->fetch_assoc()) {
                        ?>
                        <div href class="aliment-card">
                            <a href="page/fiche.php?id=<?php echo $rows2["id"];?>"><img class="aliment-img" src="assets/img/<?php echo $rows2["id"];?>.png" alt="<?php echo $rows2["nom"];?>"></a>
                            <p class="aliment-card-name"><?php echo $rows2["nom"];?></p>
                            <p><?php echo $rows2["qtt"];?> kg</p>
                            <div class="bag-content">
                                <p><?php echo $rows2["prix"];?> MGA</p>
                                <a href="page/ajout.php?id=<?php echo $rows2["id"];?>"><img src="assets/img/sac-de-courses.png" alt="sac"></a>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    echo "⚠ Aucun résultat.";
                }
            }
            else {
                $sql = "SELECT * FROM aliment";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    $rows = $result->fetch_all(MYSQLI_ASSOC);
                    foreach ($rows as $row) {
            ?>
            <div href class="aliment-card">
                <a href="page/fiche.php?id=<?php echo $row["id"];?>"><img class="aliment-img" src="assets/img/<?php echo $row["id"];?>.png" alt="<?php echo $row["nom"];?>"></a>
                <p class="aliment-card-name"><?php echo $row["nom"];?></p>
                <p><?php echo $row["qtt"];?> kg</p>
                <div class="bag-content">
                    <p><?php echo $row["prix"];?> MGA</p>
                    <a href="page/ajout.php?id=<?php echo $row["id"];?>"><img src="assets/img/sac-de-courses.png" alt="sac"></a>
                </div>
            </div>
            <?php
                    }
                } else {
                    echo "⚠ Aucun résultat.";
                }
            }
            $conn->close();
            ?>
        </div>
    </main>
    <footer id="contact">
        <div>
            <div>
                <img src="assets/icon/envelope-solid-full.svg" alt="">
                <a href="">stephanie.chan.dev@gmail.com</a>
            </div>
            <div>
                <img src="" alt="">
                <p>(+261) 38 72 735 86</p>
            </div>
            <div>
                <a href=""><img src="" alt=""></a>
            </div>
        </div>
        <hr>
        <p>Copyright © 2025 Stéphanie</p>
    </footer>
</body>
</html>