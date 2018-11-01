<?php
    header('Content-Type: text/html;charset=UTF-8');
    require_once ('../MODELE/VehiculeModele.class.php');
    require_once ('../MODELE/VeloElectriqueModele.class.php');

    $monModele = new VehiculeModele ();
    $monvelo= new VeloElectriqueModele();
    $etat='';
    $numB= $_GET['numB'];
    $numV= $_GET['num'];

    //On recupere la borne du velo que l'on met à reparer
    $borneReparer= $monvelo->getUnVelosElectrique($numV);
    foreach($borneReparer as $b){
        $numBReparer= $b->numB;
    }

    if (isset($_GET['num'])&& isset($_GET['etat'])){
    //numéro du vélo passé dans l'URL lors de l'appel de la page
        try{
            $etat='D';
            if ($_GET['etat']== "REPARER"){ //test de la valeur du bouton
                $etat='R';
                // Quand etat à reparer : ajouter une place à la borne
                $nbPlaces= $monvelo->placeBorne($numBReparer);
                foreach($nbPlaces as $b){
                    $place= $b->nbPlaces + 1;
                }
                $monvelo->modifPlace($numBReparer,$place);
                $monvelo->modifBorne(0,$_GET['num']); 
            }

            else{
                $etat='D';
                $monvelo->modifBorne($numB, $_GET['num']);

                //Quand état à disponible, enlever une place à la borne
                $nbPlaces= $monvelo->placeBorne($numB);
                foreach($nbPlaces as $b){
                    $place= $b->nbPlaces - 1;
                }
                $monvelo->modifPlace($numB,$place);
            }

            $monModele->changeEtat($etat,$_GET['num']);

            //requete presente dans le modele qui met à jour l'etat du vélo
            header('location:../VUE/consultationVelosElectriquesDipos.php?error="SUCCESS le changement d état du vélo a été effectué "');

        } catch ( PDOException $pdoe ) {
            header('location:../VUE/consultationVelosElectriquesDipos.php?error="ERREUR dans le changement d état du vélo"');
        }
    }
?>