<?php
    require_once ('../Class/autoload.php');

    $num=$_GET['num'];
    $etat= $_GET['etat'];
    $pageConsultationVelos = new PageSecuriseeService ("Consulter les vélos disponibles...");



$pageConsultationVelos->contenu = 
    '<form action="../CONTROLEUR/tt_majVelo.php" method="GET">
        <input type="hidden" name="num" value='.$num.'>
        <input type="hidden" name="etat" value='.$etat.'>
        <input type="text" name="latitude" id="latitude" required="">
        <input type="text" name="longitude" id="longitude" required="">
        <input type="submit" name="submit">
    </form>';

$pageConsultationVelos->afficher();
?>