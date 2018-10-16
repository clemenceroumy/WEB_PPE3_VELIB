<?php
session_start();
require_once('../MODELE/LocationModele.class.php');

$idVelo= $_POST['numVelo'];
$idAdherent= $_SESSION['idAdherent'];
$dateLocation= $_POST['dateLocation'];

$Location= new LocationModele();

try{
    $ajoutLocation= $Location->ajouterLocation($idVelo,$idAdherent,$dateLocation);
    header("location: ../VUE/locationVelo.php");

} catch{
    echo "Erreur lors de l'insertion de la location";
}







?>