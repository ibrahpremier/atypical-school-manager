<?php 
    require '../database/connexion_bd.php';

// Ajouter une compo
if (isset($_GET['add_compo'])){

$nom_compo=$_POST['nom_compo'];
$nbr_question=$_POST['nbr_question'];
$quota=$_POST['quota'];
$date_compo=$_POST['date_compo'];
$sujet=$_POST['sujet'];
$type_compo=$_POST['type_compo'];
$enreg=$bdd->prepare("INSERT INTO composition VALUES (?, ?, ?, ?, ?, ?, ?)");
$req=$enreg->execute(array(NULL,$nom_compo,$date_compo,$nbr_question,$quota,$sujet,$type_compo));
if($req){
    $code=1;
    $message='enregistré';
}
    else{
        $code=0;
        $message='echec enregistrement';

    }
    echo (json_encode(array('code'=>$code,'message'=>$message)));
}
?>