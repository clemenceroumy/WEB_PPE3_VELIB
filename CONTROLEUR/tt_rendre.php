<?php
session_start();
require_once('../MODELE/LocationModele.class.php');
require_once('../MODELE/VehiculeModele.class.php');

$idVelo= $_POST['numvelo'];
$idAdherent= $_SESSION['idAdherent'];
$dateLocation= $_POST['dateheureLoc'];
$dateRetour= $_POST['dateRetour'];

$Location= new LocationModele();
$Vehicule= new VehiculeModele();

$getetat= $Vehicule->getEtatVehicule($idVelo);
foreach($getetat as $e){
    $etat= $e->etatV;
}

try{
    $supressionLocation= $Location->suppressionLocation($idVelo,$idAdherent,$dateLocation,$dateRetour);

    $velo=$Vehicule->getTypeVehicule($idVelo); // retourne 0 si c'est un velo electrique et 1 si c'est un velo
    foreach($velo as $t){
        $count= $t->compteur;
    }

    if($count != 0){ //velo classique
        header("location: ../VUE/coordonnees.php?num=".$idVelo."&etat=".$etat); 
    }

    else{// velo electrique
        header("location: ../VUE/borne.php?num=".$idVelo."&etat=".$etat);
    }

} 
catch (Exception $e){
    echo "Erreur lors de l'insertion de la location";
}

?>