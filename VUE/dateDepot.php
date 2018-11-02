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
}

else {
	//si on est pas connecté en tant que serviceTechnique, on ne voit que les vélos DISPONIBLES
	$pageLocationVelos = new PageBase ("Consulter les vélos disponibles...");
}

$pageLocationVelos->contenu = "
<h3>à quelle date deposer le velo ?</h3>
<form action='../CONTROLEUR/tt_rendre.php' method='POST'>
    <input type='hidden' name='numVelo' value='".$_POST['numvelo']."'>
    <input type='hidden' name='dateheureLoc' value='".$_POST['dateheureLoc']."'>
    <input type='datetime-local' name='dateRetour' placeholder='YYYY-MM-DD HH:MM:SS''>
    <input type='submit' name='Louer' value='confirmer le depôt'>
</form>";

$pageLocationVelos->afficher();