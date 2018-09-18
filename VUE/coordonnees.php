<?php
    $num=$_GET['num'];
    $etat= $_GET['etat'];
?>

<form action="../CONTROLEUR/tt_majVelo.php" method="GET">
    <input type="hidden" name="num" value='<?php echo $num; ?>'>
    <input type="hidden" name="etat" value='<?php echo $etat; ?>'>
    <input type="text" name="latitude" id="latitude" required="">
    <input type="text" name="longitude" id="longitude" required="">
    <input type="submit" name="submit">
</form>