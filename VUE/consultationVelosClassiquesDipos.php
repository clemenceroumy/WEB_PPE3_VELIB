<?php
session_start();

require_once ('../Class/autoload.php');
require_once ('../CONTROLEUR/controleur.php');

$sessionService= false;
$sessionUtilisateur= false;
if (isset($_SESSION ['mode']) && $_SESSION ['mode']=="serviceTechnique") {
	$pageConsultationVelos = new PageSecuriseeService ("Consulter les vélos disponibles...");
	$sessionService= true;
	$listeVELO = listeVelosClassiques();//appel de la fonction dans le CONTROLEUR : page controleur.php
} 

else if(isset($_SESSION ['mode']) && $_SESSION ['mode']=="adherent"){
	$pageConsultationVelos = new PageAdherent ("Consulter les vélos disponibles...");
	$listeVELO = listeVelosClassiquesDisponibles();
}

else {
	//si on est pas connecté en tant que serviceTechnique, on ne voit que les vélos DISPONIBLES
	$sessionUtilisateur= true;
	$pageConsultationVelos = new PageBase ("Consulter les vélos disponibles...");
	$listeVELO = listeVelosClassiquesDisponibles();//appel de la fonction dans le CONTROLEUR : page controleur.php
	$listeCoordonnee= listeCoordonnee();
}

$pageConsultationVelos->contenu = '<section>
					<div class="col-md-6">
          <table class="table table-striped" class="table-responsive">
            <thead>	<tr><th>Numero du vélo</th><th>position GPS l</th><th>position GPS L</th><th>disponibilité</th><th></th></tr></thead><tbody>';
//parcours du résultat de la requete
foreach ($listeVELO as $unVELO){

		$pageConsultationVelos->contenu .= '<tr><td>'.$unVELO->numV.'</td><td>'.$unVELO->latitudeV.'</td><td>'.$unVELO->longitudeV.'</td><td>'.$unVELO->etatV.'</td>';
	

	if ($sessionService== true){// si on est connecté en tant que SERVICE
		$pageConsultationVelos->contenu .='<td><form class="form-inline" action="../CONTROLEUR/tt_majVelo.php" method="GET" >
			<input type="hidden" name="num" value='. $unVELO->numV.'>
			<input type="submit" class="btn btn-warning" name="etat" value="REPARER"/>
			</form></td>

			<td><form class="form-inline" action="coordonnees.php" method="GET" >
			<input type="hidden" name="num" value='. $unVELO->numV.'>
			<input type="submit" class="btn btn-success" name="etat" value="DISPONIBLE"/>
			</form></td></tr>';
		}			
	}
$listeVELO->closeCursor(); //pour liberer la memoire occupee par le resultat de la requete
$listeVELO = null; //pour une autre execution avec cette variable


//GOOGLE MAPS
$pageConsultationVelos->contenu .= '</tbody></table></div>';

if($sessionUtilisateur == true){
	$pageConsultationVelos->contenu .='<div class="col-md-6">
	<style>
	 #map {
	   width: 100%;
	   height: 400px;
	   background-color: grey;
	 }
	</style>
	<div id="map"></div>
	<script>
		function initMap() {
			var map = new google.maps.Map(document.getElementById("map"), {zoom: 1, center: {lat: 47.216962, lng: 2.895742}});';
	
		foreach($listeCoordonnee as $c){
			$pageConsultationVelos->contenu .= 'var marker= new google.maps.Marker({position: {lat:'.$c->latitudeV.' , lng: '.$c->longitudeV.'}, map: map});';
		}
	
	$pageConsultationVelos->contenu .= '
			}
		</script>
		<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBJrxMhfWA81RTtpfw1ZxBGQNezAiTOl0k&callback=initMap"></script>
	</div>';
}


// TRAITEMENT du RETOUR DE L'ERREUR par le controleur
if (isset($_GET['error']) && !empty($_GET['error'])) {
	$err = $_GET['error'];

	$pageConsultationVelos->zoneErreur = '<div id="infoERREUR" class="alert alert-success fade in">INFO :<a href="#" onclick="cacher();" class="close" data-dismiss="alert">&times;</a></div>';
	$verif = preg_match("/ERREUR/",$err); //verifie s'il y a le mot ERREUR dans le message retourné
	
	if ( $verif == TRUE ){
		$class ="alert alert-danger fade in";
	}
	else {
		$class ="alert alert-success fade in";
	}
	$pageConsultationVelos->scriptExec = "changerCouleurZoneErreur('".$class."');";	//ajout dans le tableau scriptExec du script à executer	
	$pageConsultationVelos->scriptExec = "montrer('.$err.');"; //ajout dans le tableau scriptExec du script à executer
}
$pageConsultationVelos->afficher();
?>