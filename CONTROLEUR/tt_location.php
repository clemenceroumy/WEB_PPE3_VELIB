<?php
session_start();
require_once('../MODELE/LocationModele.class.php');
require_once('../MODELE/VehiculeModele.class.php');
require_once('../MODELE/VeloModele.class.php');
require_once('../MODELE/VeloElectriqueModele.class.php');

$idVelo= $_POST['numvelo'];
$idAdherent= $_SESSION['idAdherent'];
$dateLocation= $_POST['dateLocation'];

$Location= new LocationModele();
$Vehicule= new VehiculeModele();

try{
    $ajoutLocation= $Location->ajouterLocation($idVelo,$idAdherent,$dateLocation);
    $Vehicule->changeEtat('L',$idVelo); 

    $velo=$Vehicule->getTypeVehicule($idVelo); // retourne 0 si c'est un velo electrique et 1 si c'est un velo
    foreach($velo as $t){
        $count= $t->compteur;
    }

    if($count != 0){ // velo classique
        $monvelo= new VeloModele();
        $monvelo->modifCoordonnée(0, 0, $idVelo); // si c'est un velo mettre les coordonnées à 0
    }

    else{ // velo electrique
        $monvelo= new VeloElectriqueModele();

        //On recupere la borne du velo que l'on met à reparer
        $borneReparer= $monvelo->getUnVelosElectrique($idVelo);
        foreach($borneReparer as $b){
            $numBReparer= $b->numB;
        }

        // Pour la borne du velo, quand celui-ci est loué, on ajoute une place à la borne
        $nbPlaces= $monvelo->placeBorne($numBReparer);
            foreach($nbPlaces as $b){
                $place= $b->nbPlaces + 1;
            }
        $monvelo->modifPlace($numBReparer,$place);
        
        $monvelo->modifBorne(0,$idVelo); // si c'est un velo electrique, mettre la borne à 0
    }
    
    
    header("location: ../VUE/locationVelo.php");

} 

catch (Exception $e){
    echo "Erreur lors de l'insertion de la location".$e;
}

?>