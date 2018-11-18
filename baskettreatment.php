<?php
require_once "Model/BDD.php";
require_once "Service/basketManager.php";

//On démarre la session pour récupérer les informations stockées
session_start();

require_once "Service/basketManager.php";
if (isset ($_GET["key"])) {
  $key = intval(htmlspecialchars($_GET["key"]));
}
if($_GET["action"] === "add") {
  addProductBasket($key);
}

if($_GET["action"] === "remove") {
  removeProductBasket($key);
}

?>
