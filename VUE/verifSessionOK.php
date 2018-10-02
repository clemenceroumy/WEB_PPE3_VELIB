<?php
include ('../Class/autoload.php');

$page= new PageBase ( "VELIBERTE - Se Connecter" );


$page->contenu = "<h3>Veuillez vous connecter... </h3>";
		// action # car on reste sur la meme page
$page->contenu .= '	<form class="form-inline" id="formInscriptionAdmin" method="POST" action="../CONTROLEUR/tt_adherent.php">
  					<div class="form-group">
    					<input type="text" class="form-control" name="idU" id="idU"size="15" maxlength="15" placeholder="Identifiant" autofocus required >
    					<input type="password" class="form-control" name="mdpU" id="mdpU" size="15" maxlength="15" placeholder="Mot de passe" required>
  					</div>
 					<button type="submit" class="btn btn-default">Valider</button>
	 		 		<button type="reset" class="btn btn-default">Recommencer</button>
			</form>';
	

// TRAITEMENT DE L'ERREUR
if (isset($_GET['error']) && !empty($_GET['error'])) {
	$err = $_GET['error'];
	$page->zoneErreur = '<div id="infoERREUR" class="alert alert-success fade in"><strong>INFO : </strong><a href="#" onclick="cacher();" class="close" data-dismiss="alert">&times;</a></div>';	
	$verif = preg_match("/ERREUR/",$err); //verifie s'il y a le mot erreur dans le message retourné
	if ( $verif == TRUE ){
		$class ="alert alert-danger fade in";
	}
	else {
		$class ="alert alert-success fade in";
	}
	$page->scriptExec = "changerCouleurZoneErreur('".$class."');";	//ajout dans le tableau scriptExec du script à executer
	$page->scriptExec = "montrer('".$err."');"; //ajout dans le tableau scriptExec du script à executer
}
$page->afficher();
		

?>
  		