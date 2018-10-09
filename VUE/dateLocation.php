<?php
session_start();

require_once ('../Class/autoload.php');
require_once ('../CONTROLEUR/controleur.php');

$sessionService= false;
if (isset($_SESSION ['mode']) && $_SESSION ['mode']=="serviceTechnique") {
	$pageLocationVelos = new PageSecuriseeService ("Consulter les vélos disponibles...");
	$sessionService= true;

} 

else if(isset($_SESSION ['mode']) && $_SESSION ['mode']=="adherent"){
	$pageLocationVelos = new PageAdherent ("Consulter les vélos disponibles...");
    $listeVELOc = listeVelosClassiquesDisponibles();
    $listeVELOe = listeVelosElectriqueDisponibles();
}

else {
	//si on est pas connecté en tant que serviceTechnique, on ne voit que les vélos DISPONIBLES
	$pageLocationVelos = new PageBase ("Consulter les vélos disponibles...");
}

$pageLocationVelos->contenu = "<form action='..\CONTROLEUR\tt_location.php' method='POST'>
    <input type='hidden' name='numVelo' value='".$_POST['num']."'>
    <input type='datetime-local' name='dateLocation' >
    <input type='submit' name='Louer' value='confirmer la location'>
</form>"
;

$pageLocationVelos->afficher();