<?php
session_start ();

require_once ('../Class/PageBase.class.php');
require_once ('../Class/PageSecuriseeService.class.php');
require_once ('../Class/PageAdherent.class.php');
require_once ('../CONTROLEUR/controleur.php');

if (isset ( $_SESSION ['mode'] ) && $_SESSION ['mode']=="serviceTechnique" ) {
	$pageLocation = new PageSecuriseeService ( "Bienvenue sur VELIBERTE..." );
} 

else if(isset ( $_SESSION ['mode'] ) && $_SESSION ['mode']=="adherent" ){
    $pageLocation = new PageAdherent( "Bienvenue sur VELIBERTE..." );
    $listeLOC= listeLocation($_SESSION['idAdherent']);
}

else {
	$pageLocation = new PageBase ( "Bienvenue sur VELIBERTE..." );
}

$pageLocation->contenu = '<div class="col-md-6">
<table class="table table-striped" class="table-responsive">
<thead><tr><th>Numero du vélo loué</th><th>Date de Location</th><th></th></tr></thead><tbody>';

foreach ($listeLOC as $uneLOC){
    $pageLocation->contenu .= '<tr><td>'.$uneLOC->numV.'</td><td>'.$uneLOC->dateheureLoc.'</td><td><form action="dateDepot.php" method="POST">
    <input type="hidden" name="numvelo" value='.$uneLOC->numV.'>
    <input type="hidden" name="dateheureLoc" value='.$uneLOC->dateheureLoc.'>
    <input type="submit" name="rendre" value="RENDRE" class="btn btn-danger">
</form></td>';
}

$pageLocation->contenu .= '</tbody></table></div>';			

$pageLocation->afficher ();

?>