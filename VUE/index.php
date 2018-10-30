<?php
session_start ();

require_once ('../Class/PageBase.class.php');
require_once ('../Class/PageSecuriseeService.class.php');
require_once ('../Class/PageAdherent.class.php');

if (isset ( $_SESSION ['mode'] ) && $_SESSION ['mode']=="serviceTechnique" ) {
	$pageIndex = new PageSecuriseeService ( "Bienvenue sur VELIBERTE..." );
} 

else if(isset ( $_SESSION ['mode'] ) && $_SESSION ['mode']=="adherent" ){
	$pageIndex = new PageAdherent( "Bienvenue sur VELIBERTE..." );
	//$pageIndex->menu .= <li><a href="veloLouer.php">Mes velos</a></>	verifier sir l'adherent à des velos en location
}

else {
	$pageIndex = new PageBase ( "Bienvenue sur VELIBERTE..." );
}

$pageIndex->contenu = '<section>
		<article>
		<h2>
			SERVICE de LOCATION  de <ul>
			<li>vélos classiques géolocalisables avec leurs coordonnées GPS</li>
			 <li>vélos électriques en rechargement à différentes bornes dans la ville</li>
			 <li>et tous les bénéfices de la pratique du vélo ...</li>
			 </ul></h2>
			 
			<img src="./Image/velobenef.jpg" alt="benefices de la pratique du vélo"> 
		</article>	
	</section>';
				

$pageIndex->afficher ();

?>


