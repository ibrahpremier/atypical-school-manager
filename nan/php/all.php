<?php

// afficher la date dans le format francais
$date="2005-05-05";
$date_fr = date('d/m/Y',strtotime($date));


date_default_timezone_set('Europe/Paris');
// --- La setlocale() fonctionnne pour strftime mais pas pour DateTime->format()
setlocale(LC_TIME, 'fr_FR.utf8','fra');// OK
// strftime("jourEnLettres jour moisEnLettres annee") de la date courante
 $datef= strftime("%A %d %B %Y");
//ou alors
 $datef= strftime("%A %d %B %Y",strtotime('2010-05-05'));

 
// afficher la date du dernier lundi en php 
$dernier_lundi = date("j", time() - ( date("N") -1) *86400 );



?>