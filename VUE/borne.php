<?php
    require_once ('../Class/autoload.php');
    require_once ('../CONTROLEUR/controleur.php');

    $num=$_GET['num'];
    $etat= $_GET['etat'];
    $pageConsultationVelos = new PageSecuriseeService ("Consulter les vélos disponibles...");
    $listeBORNE = listeBorne();

$pageConsultationVelos->contenu = 
    '<form action="../CONTROLEUR/tt_majVeloElectrique.php" method="GET">
        <input type="hidden" name="num" value='.$num.'>
        <input type="hidden" name="etat" value='.$etat.'>
        <select name=numB>
            ';

            foreach($listeBORNE as $b){
                $pageConsultationVelos->contenu .= '<option value='.$b->codeB.'>'.$b->nomB." ".$b->numRueB." ".$b->nomrueB.'</option>';
            }

$pageConsultationVelos->contenu .=  ' </select>

        <input type="submit" name="submit">
    </form>';

$pageConsultationVelos->afficher();
?>