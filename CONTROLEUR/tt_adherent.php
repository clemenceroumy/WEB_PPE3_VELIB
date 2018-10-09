<?php
session_start();
include ('../Class/autoload.php');
require_once ('../MODELE/AdherentModele.class.php');

$login= $_POST['idU'];
$mdp = $_POST['mdpU'];

$Adherent = new AdherentModele();
$countAdherent= $Adherent->getVerifConnexion($login, $mdp);
$idAdherent= $Adherent->getAdherent($login, $mdp);

    // SI MODE ADMIN
    if (($_POST ['idU'] === "AS") && ($_POST ['mdpU'] === "AS")) {

        $_SESSION ['mode'] = "serviceTechnique";
            
        // on appelle la nouvelle classe Page_sécurisée :  page avec un menu specifique
        $page = new PageSecuriseeService ( "VELIBERTE - Mode SERVICE" );
        header ('Location:../VUE/index.php');		
    } 
    
    // SI la requete retourne 1 donc que le login et mdp sont dans la BDD
    else if ($countAdherent == 1){

        $_SESSION ['mode'] = "adherent";
        //$_SESSION['idAdherent']= $idAdherent;
        $page = new PageAdherent( "VELIBERTE - Mode Connecté" );
        header ('Location:../VUE/index.php');	
    }
    
    else{
        // les identifiants de connexion existe mais ne sont pas VALABLES
            header ('Location:../VUE/verifSessionOK.php?error=ERREUR : Login ou mot de passe non valide !');
    }



?>