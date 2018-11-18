<?php
try 

    {

        // On se connecte à MySQL
        $bdd = new PDO('mysql:host=localhost;dbname=eCommerce;charset=utf8', 'phpmyadmin', 'hanane');
    }

catch(Exception $e)
    {
         // En cas d'erreur, on affiche un message et on arrête tout
        die('Erreur : '.$e->getMessage());
    }
?>