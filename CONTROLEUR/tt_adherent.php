<?php
session_start();
include ('../Class/autoload.php');
require_once ('../MODELE/AdherentModele.class.php');

$login= $_POST['idU'];
$mdp = $_POST['mdpU'];

$Adherent = new AdherentModele();
$countA= $Adherent->getVerifConnexion($login, $mdp);

if (isset($_SESSION ['mode']) ) {
	/* Dans ce cas, on detruit la session SUR LE SERVEUR */
	$_SESSION = array (); /* on vide le contenu de session sur le serveur */
	// Dans ce cas, on detruit aussi l'identifiant de SESSION en recreant le cookie de SESSION avec une dateHeure perimee (time() -42000)
	if (ini_get ( "session.use_cookies" )) {
		$params = session_get_cookie_params ();
		setcookie ( session_name (), '', time () - 42000, $params ["path"], $params ["domain"], $params ["secure"] );
	}
	// on detruit la session sur le serveur
	session_destroy ();
	?> <script type="text/javascript"> alert('session detruite');</script> <?php

	// affichage du msg 
    header ('Location:../VUE/verifSessionOK.php?error=SUCCESS : Vous venez d\'être déconnecté !');
}

else{
    // SI MODE ADMIN
    if (($_POST ['idU'] === "AS") && ($_POST ['mdpU'] === "AS")) {

        $_SESSION ['mode'] = "serviceTechnique";
            
        // on appelle la nouvelle classe Page_sécurisée :  page avec un menu specifique
        $page = new PageSecuriseeService ( "VELIBERTE - Mode SERVICE" );
        header ('Location:../VUE/index.php');		
    } 
    
    // SI la requete retourne 1 donc que le login et mdp sont dans la BDD
    else if ($countA == 1){

        $_SESSION ['mode'] = "adherent";
    
        $page = new PageAdherent( "VELIBERTE - Mode Connecté" );
        header ('Location:../VUE/index.php');	
    }
    
    else{
        // les identifiants de connexion existe mais ne sont pas VALABLES
            header ('Location:../VUE/verifSessionOK.php?error=ERREUR : Login ou mot de passe non valide !');
    }
}


?>