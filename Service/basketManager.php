<?php
require_once "Model/BDD.php";
$req = $bdd->query("SELECT * FROM Product");
$product = $req->fetch(PDO::FETCH_ASSOC);
//Fonction qui parcours les produits du panier et calcule le montant total
function calculateBasket($add, $price) {
if($add) {
    $_SESSION["basketAmount"] += $price;
}
else {
    $_SESSION["basketAmount"] -= $price;
    
}
}
//Si l'action concerne un ajout au panier
function addProductBasket ($key) {    
        //On ajoute le produit dans l'entrée "basket" du tableau session
        array_push($_SESSION["basket"], $product);
        //On calcule le nouveau montant du panier
        calculateBasket(true, $product["Price"]);
        //On renvoie vers la page produit avec un message de succès pour confirmer l'ajout au panier
        header("Location: products.php?success=produits ajouté au panier");
}
//Si l'action concerne un retrait de produit
function removeProductBasket ($key) {
        //On calcule le nouveau montant du panier
        calculateBasket(false, $_SESSION["basket"][$key]["Price"]);
        //On retire ce produit du tableau
        unset($_SESSION["basket"][$key]);
        //On renvoie vers la page panier avec un message de succès pour confirmer le retrait du panier
        header("Location: basket.php?success=produits retiré du panier");
}
?>