<?php
    require_once ('../Class/autoload.php');

    $num=$_GET['num'];
    $etat= $_GET['etat'];
    $pageConsultationVelos = new PageSecuriseeService ("Consulter les vélos disponibles...");



$pageConsultationVelos->contenu = 
    '<h3>où deposer le velo ?</h3>
    <form action="../CONTROLEUR/tt_majVelo.php" method="GET">
        <input type="hidden" name="num" value='.$num.'>
        <input type="hidden" name="etat" value='.$etat.'>
        <input type="text" name="latitude" id="latitude" required="" placeholder="entrez la latitude" onkeypress="return bloque(event);">
        <input type="text" name="longitude" id="longitude" required="" placeholder="entrez la longitude" onkeypress="return bloque(event);">
        <input type="submit" name="submit">
    </form>';

$pageConsultationVelos->afficher();

?>
<script type="text/javascript" src="Script\verifCoordonnee.js"></script>