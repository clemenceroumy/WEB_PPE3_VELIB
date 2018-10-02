<?php
    header('Content-Type: text/html;charset=UTF-8');
    require_once ('../MODELE/VehiculeModele.class.php');
    require_once ('../MODELE/VeloElectriqueModele.class.php');

    $monModele = new VehiculeModele ();
    $monvelo= new VeloElectriqueModele();
    $etat='';
    $numB= $_GET['numB'];

    if (isset($_GET['num'])&& isset($_GET['etat'])){
    //numéro du vélo passé dans l'URL lors de l'appel de la page
        try{
            $etat='D';
            if ($_GET['etat']== "REPARER"){ //test de la valeur du bouton
                $etat='R';
                $monvelo->modifBorne(0,$_GET['num']); // PB QUAND BORNE = NULL -> N'affiche plus le velo sur le site 
            }

            else{
                $etat='D';
                $monvelo->modifBorne($numB, $_GET['num']);
            }

            $monModele->changeEtat($etat,$_GET['num']);

            //requete presente dans le modele qui met à jour l'etat du vélo
            header('location:../VUE/consultationVelosElectriquesDipos.php?error="SUCCESS le changement d état du vélo a été effectué "');

        } catch ( PDOException $pdoe ) {
            header('location:../VUE/consultationVelosElectriquesDipos.php?error="ERREUR dans le changement d état du vélo"');
        }
    }
?>