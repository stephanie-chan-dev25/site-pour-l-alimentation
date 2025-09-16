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
            <input type="text" name="aliment" placeholder="Search for food" value="<?php echo isset($_GET['aliment']) ? htmlspecialchars($_GET['aliment']) : ''; ?>">
            <input type="submit" value="Valider">
        </form>
        <?php
        // --------- PARAMÈTRES GÉNÉRAUX ---------
        $limit = 1; // nombre d’éléments par page
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        if ($page < 1) $page = 1;
        $offset = ($page - 1) * $limit;

        if (isset($_GET["aliment"]) && $_GET["aliment"] !== "") {
            // --------- RECHERCHE AVEC PAGINATION ---------
            $nom = $_GET["aliment"];

            // Compter les résultats correspondants
            $sqlCount = $conn->prepare("SELECT COUNT(*) as total FROM aliment WHERE nom = ?");
            $sqlCount->bind_param("s", $nom);
            $sqlCount->execute();
            $countResult = $sqlCount->get_result();
            $countRow = $countResult->fetch_assoc();
            $total = (int)$countRow['total'];
            $totalPages = ceil($total / $limit);

            // Sélection des résultats paginés
            $sql2 = $conn->prepare("SELECT * FROM aliment WHERE nom = ? LIMIT ? OFFSET ?");
            $sql2->bind_param("sii", $nom, $limit, $offset);
            $sql2->execute();    
            $result2 = $sql2->get_result();
        ?>
        <div class="conteneur">
            <div class="content-aliment-card">
                <?php
                if ($result2->num_rows > 0) {
                    while ($rows2 = $result2->fetch_assoc()) {
                ?>
                <div class="aliment-card">
                    <a href="page/fiche.php?id=<?php echo $rows2["id"];?>">
                        <img class="aliment-img" src="assets/img/<?php echo $rows2["id"];?>.png" alt="<?php echo $rows2["nom"];?>">
                    </a>
                    <p class="aliment-card-name"><?php echo $rows2["nom"];?></p>
                    <p><?php echo $rows2["qtt"];?> kg</p>
                    <div class="bag-content">
                        <p><?php echo $rows2["prix"];?> MGA</p>
                        <a href="page/ajout.php?id=<?php echo $rows2["id"];?>"><img src="assets/img/sac-de-courses.png" alt="sac"></a>
                    </div>
                </div>
                <?php
                        }
                ?>
            </div>
            <?php
                    // Liens pagination pour recherche
                    if ($totalPages > 1) {
                        echo '<div class="pagination">';
                        if ($page > 1) {
                            echo '<a href="?aliment='.urlencode($nom).'&page='.($page-1).'">⬅ Précédent</a> ';
                        }
                        for ($i=1; $i<=$totalPages; $i++) {
                            if ($i == $page) {
                                echo "<strong>$i</strong> ";
                            } else {
                                echo '<a href="?aliment='.urlencode($nom).'&page='.$i.'">'.$i.'</a> ';
                            }
                        }
                        if ($page < $totalPages) {
                            echo '<a href="?aliment='.urlencode($nom).'&page='.($page+1).'">Suivant ➡</a>';
                        }
                        echo '</div>';
                    }
                } else {
                    echo "⚠ Aucun résultat.";
                }
            ?>
        </div>
        <?php
        }else {
            // --------- LISTE GÉNÉRALE AVEC PAGINATION ---------
            // Compter le total
            $totalResult = $conn->query("SELECT COUNT(*) as total FROM aliment");
            $totalRow = $totalResult->fetch_assoc();
            $total = (int)$totalRow['total'];
            $totalPages = ceil($total / $limit);

            // Sélection page courante
            $sql = "SELECT * FROM aliment LIMIT $limit OFFSET $offset";
            $result = $conn->query($sql);
        ?>
        <div class="conteneur">
            <div class="content-aliment-card">
            <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
            ?>
                <div class="aliment-card">
                    <a href="page/fiche.php?id=<?php echo $row["id"];?>">
                        <img class="aliment-img" src="assets/img/<?php echo $row["id"];?>.png" alt="<?php echo $row["nom"];?>">
                    </a>
                    <p class="aliment-card-name"><?php echo $row["nom"];?></p>
                    <p><?php echo $row["qtt"];?> kg</p>
                    <div class="bag-content">
                        <p><?php echo $row["prix"];?> MGA</p>
                        <a href="page/ajout.php?id=<?php echo $row["id"];?>"><img src="assets/img/sac-de-courses.png" alt="sac"></a>
                    </div>
                </div>
                <?php
                    }
                ?>
            </div>
    <?php
            
        } else {
            echo "⚠ Aucun résultat.";
        }

        // Liens pagination générale
        if ($totalPages > 1) {
            echo '<div class="pagination">';
            if ($page > 1) {
                echo '<a href="?page='.($page-1).'">⬅ Précédent</a> ';
            }
            for ($i=1; $i<=$totalPages; $i++) {
                if ($i == $page) {
                    echo "<strong>$i</strong> ";
                } else {
                    echo '<a href="?page='.$i.'">'.$i.'</a> ';
                }
            }
            if ($page < $totalPages) {
                echo '<a href="?page='.($page+1).'">Suivant ➡</a>';
            }
            echo '</div>';
        }
    }
    $conn->close();
    ?>
    </div>
    </main>
<footer id="contact">
    <div>
        <img src="assets/icon/mail.svg" alt="enveloppe">
        <p>stephanie.chan.dev@gmail.com</p>
    </div>
    <div>
        <img src="assets/icon/phone-solid-full.svg" alt="téléphone">
        <p>(+261) 38 72 735 86</p>
    </div>
    <div>
        <img src="assets/img/logo.svg" alt="Ever">
    </div>
</footer>
</body>
</html>
