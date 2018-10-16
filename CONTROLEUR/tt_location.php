<?php
session_start();
require_once('../MODELE/LocationModele.class.php');
require_once('../MODELE/VehiculeModele.class.php');

$idVelo= $_POST['numVelo'];
$idAdherent= $_SESSION['idAdherent'];
$dateLocation= $_POST['dateLocation'];

$Location= new LocationModele();
$Vehicule= new VehiculeModele();

try{
    $ajoutLocation= $Location->ajouterLocation($idVelo,$idAdherent,$dateLocation);
    $Vehicule->changeEtat('L',$idVelo); 
    
    header("location: ../VUE/locationVelo.php");

} 
catch (Exception $e){
    echo "Erreur lors de l'insertion de la location";
}







?>