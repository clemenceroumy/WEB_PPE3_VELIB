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

$pageLocationVelos->contenu = '<section>
                    <div class="col-md-6">
            <h1>Vélos Classiques Disponible</h1>
          <table class="table table-striped" class="table-responsive">
            <thead>	<tr><th>Numero du vélo</th><th>position GPS l</th><th>position GPS L</th><th></th></tr></thead><tbody>';
//parcours du résultat de la requete

foreach ($listeVELOc as $unVELO){
    $pageLocationVelos->contenu .= '<tr><td>'.$unVELO->numV.'</td><td>'.$unVELO->latitudeV.'</td><td>'.$unVELO->longitudeV.'</td>
    <td><form action="dateLocation.php" method="POST">
        <input type="hidden" name="num" value='.$unVELO->numV.'>
        <input type="submit" name="louer" value="LOUER" class="btn btn-success">
    </form></td>';
				
	}
$listeVELOc->closeCursor(); //pour liberer la memoire occupee par le resultat de la requete
$listeVELOc = null; //pour une autre execution avec cette variable

$pageLocationVelos->contenu .= '</tbody></table></div>';


$pageLocationVelos->contenu .= '<section>
                    <div class="col-md-6">
                    <h1>Vélos Electrique Disponible</h1>
          <table class="table table-striped" class="table-responsive">
            <thead>	<tr><th>Numero du vélo</th><th>borne</th><th></th></tr></thead><tbody>';
//parcours du résultat de la requete
foreach ($listeVELOe as $unVELO){
  $pageLocationVelos->contenu .= '<tr><td>'.$unVELO->numV.'</td><td>'.$unVELO->nomB.' , '.$unVELO->numRueB.' '.$unVELO->nomrueB.'</td>
  <td><form action="dateLocation.php" method="POST">
      <input type="hidden" name="num" value='.$unVELO->numV.'>
      <input type="submit" name="louer" value="LOUER" class="btn btn-success">
  </form></td>';
			
	}
$listeVELOe->closeCursor(); //pour liberer la memoire occupee par le resultat de la requete
$listeVELOe = null; //pour une autre execution avec cette variable

$pageLocationVelos->contenu .= '</tbody></table></div>';

$pageLocationVelos->afficher();

?>