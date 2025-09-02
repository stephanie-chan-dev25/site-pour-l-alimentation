<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recettes - Ever</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/recette.css">
    <script src="../assets/js/script.js" defer=""></script>
</head>
<body>
<nav>
    <img src="../assets/img/logo.svg" alt="Ever">
    <img class="black-hamburger" src="../assets/icon/bars-solid-full.svg" alt="menu hamburger">
    <img class="green-hamburger" src="../assets/icon/hamburger-vert.svg" alt="menu hamburger">
        <ul>
            <li><a href="../index.php">Accueil</a></li>
            <li><a href="#">Recettes</a></li>
            <li><a href="panier.php">Panier</a></li>
            <li><a href="../index.php#contact">Contacts</a></li>
        </ul>
</nav>
<main>
<form method="GET">
    <input type="text" name="aliment" placeholder="Rechercher un aliment">
    <input type="submit" value="Valider">
</form>
<div class="content-recipe-card">
    <?php
        include("dico.php");
        $results = [];
        if (isset($_GET['aliment'])) {
            $alimentFrancais = strtolower(trim($_GET['aliment']));
            if (isset($dictionnaire[$alimentFrancais])) {
                $alimentAnglais = $dictionnaire[$alimentFrancais];
                // Appel API
                $url = "https://www.themealdb.com/api/json/v1/1/filter.php?i=" . urlencode($alimentAnglais);
                $json = file_get_contents($url);
                $data = json_decode($json, true);
        
                if (isset($data['meals'])) {
                    $results = $data['meals'];
                }
            } else {
                ?>
                <p><?php echo "Aliment non reconnu";?></p>
                <?php
            }
        }
        ?>
        <?php
            foreach ($results as $meal) {
        ?>
        <div href class="aliment-card">
            <a href="#"><img class="aliment-img" src="<?php echo $meal['strMealThumb'];?>" alt="<?php echo $meal['strMeal'];?>"></a>
            <p><?php echo $meal['strMeal'];;?></p>
        </div>
        <?php
        }
        ?>
</div>
</main>
</body>
</html>