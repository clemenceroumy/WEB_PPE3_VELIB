<?php
    require_once ('../Class/autoload.php');

    $num=$_GET['num'];
    $etat= $_GET['etat'];
    $pageConsultationVelos = new PageSecuriseeService ("Consulter les vélos disponibles...");



$pageConsultationVelos->contenu = 
    '<form action="../CONTROLEUR/tt_majVeloElectrique.php" method="GET">
        <input type="hidden" name="num" value='.$num.'>
        <input type="hidden" name="etat" value='.$etat.'>
        <input type="number" name="numB" id="numB" required="">
        <input type="submit" name="submit">
    </form>';

$pageConsultationVelos->afficher();
?>