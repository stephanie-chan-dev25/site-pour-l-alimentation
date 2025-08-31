<?php include("connexion.php");?>
<?php
$id = $_GET["id"];
$sql = $conn->prepare("SELECT * FROM aliment WHERE id = ?");
$sql->bind_param("i", $id);
$sql->execute();
$result = $sql->get_result();
$row = $result->fetch_assoc();
session_start();
if (!isset($_SESSION["ids"])) {
    $_SESSION["ids"] = array();
}
$_SESSION["ids"][] = $id;
if (!isset($_SESSION["noms"])) {
    $_SESSION["noms"] = array();
}
$_SESSION["noms"][] = $row["nom"];
if (!isset($_SESSION["qtts"])) {
    $_SESSION["qtts"] = array();
}
$_SESSION["qtts"][] = $row["qtt"];
if (!isset($_SESSION["prix"])) {
    $_SESSION["prix"] = array();
    $_SESSION["total"] = 0;
}
$_SESSION["prix"][] = $row["prix"];
$_SESSION["total"] += $row["prix"];
header("Location: panier.php");
exit();
?>