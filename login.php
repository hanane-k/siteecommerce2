<?php
//On charge le fichier avec les fonctions qui renvoient nos données
require "Model/BDD.php";
$reponse = $bdd->query('SELECT * FROM users');
$donnees = $reponse->fetchall();
//On vérifie si le formulaire a été rempli
if(!empty($_POST)) {
  //On nettoie les entrées du formulaire
  foreach ($_POST as $key => $value) {
    $_POST[$key] = htmlspecialchars($value);
  }
  //On récupère les utilisateurs stockés sur le site (ici pour l'exercice ils sont stockés dans une fonction)

  //On vérifie si on trouve une correspondance avec les infromations du formulaire
  foreach ($donnees as $key => $user) {
    if($user["Name"] === $_POST["user_name"] && password_verify($_POST["user_password"], $user["Password"])) {
      //Si c'est le cas on démarre une session pour y stocker les informations de l'utilisateur
      session_start();
      $_SESSION["user"] = $user;
      $_SESSION["basket"] = [];
      $_SESSION["basketAmount"] = 0;
      header("Location: products.php");
      //On met un exit pour arrêter l'execution du script, autrement la redirection n'aura pas le temps de se faire
      exit;
    }
  }
  header("Location: index.php?message=Nous n'avons aucun utilisateur avec ce nom ou ce mot de passe");
  exit;
}
//Si le formulaire n'est pas rempli on renvoie l'utilisateur sur la page de login avce un message
else {
  header("Location: index.php?message=Vous devez remplir les champs du formulaire");
  exit;
}

 ?>
