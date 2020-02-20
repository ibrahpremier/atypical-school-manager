<?php
    include '../database/connexion_bd.php';

    // Recupération de la liste des équipes
if(isset($_GET['loadequipe'])) {
        $list_equipe = array();            
        $resultat = $bdd->query("SELECT * FROM equipe where id_equipe!=10") or die(print_r($bdd->errorInfo()));
        
        while ($row = $resultat->fetch(PDO::FETCH_ASSOC)) {
            
            $id=$row["id_equipe"];
            $membres=0; 
            $mail='';          
            $res2=$bdd->query("SELECT * FROM etudiant where equipe_actu='$id'");
            while ($row2 = $res2->fetch(PDO::FETCH_ASSOC)){
                $membres++;
                $mail.=$row2["email"].';';
            }
            $list_equipe[] = array(
                "id_equipe" => $row["id_equipe"],
                "nom_equipe" => utf8_encode($row["nom_equipe"]),
                "date_creation_equipe" => utf8_encode($row["date_creation_equipe"]),
                "nbr_membre" => $membres,
                "email" => $mail
            );
        }
        echo json_encode($list_equipe);
}


// Ajouter une equipe
if (isset($_GET['add_eq'])){
$nom_equipe=$_POST['txt_equipe'];
$date=date('Y-m-d');
$enreg=$bdd->exec("INSERT INTO equipe VALUES (NULL,'$nom_equipe','$date')");
if($enreg){
    $code=1;
    $message='enregistré';
}
    else{
        $code=0;
        $message='echec enregistrement';

    }
    echo (json_encode(array('code'=>$code,'message'=>$message)));
}

// charger une equipe dans le modal pour modification
if(isset($_GET["info_modal_mod_eq"])) {
$id_equipe=$_GET["info_modal_mod_eq"];
$req="select * from equipe where id_equipe='$id_equipe'";
$result = $bdd->query($req) or die(print_r($bdd->errorInfo()));
while($donnees = $result->fetch(PDO::FETCH_ASSOC)){
    $nom=$donnees['nom_equipe'];
}
echo (json_encode(array("nom_equipe"=>$nom)));		
}

// mis a jour du nom d'une equipe
if(isset($_GET["maj_eq"])) {
$new_nom_equipe=$_POST['txt_mod_equipe'];
$id_equipe=$_GET["maj_eq"];
$req="update equipe set nom_equipe='$new_nom_equipe' where id_equipe='$id_equipe'";
$result = $bdd->query($req);
 if($result){
     $code=1;
     $message='Mis à jour effectué';
}else{
    $code=0;
    $message='Echec mis à jour';
}
echo (json_encode(array('code'=>$code,'message'=>$message)));
}



// charger une equipe dans le modal pour suppression
if(isset($_GET["info_modal_supp_eq"])) {
$id_equipe=$_GET["info_modal_supp_eq"];
$req="select * from equipe where id_equipe='$id_equipe'";
$result = $bdd->query($req) or die(print_r($bdd->errorInfo()));
while($donnees = $result->fetch(PDO::FETCH_ASSOC)){
    $nom=$donnees['nom_equipe'];
}
echo (json_encode(array("nom_equipe"=>$nom)));		
}


// supprimer une equipe
if(isset($_GET["supp_eq"])) {
$id_equipe=$_GET["supp_eq"];
$req="DELETE FROM equipe WHERE id_equipe='$id_equipe'";
$result = $bdd->query($req) or die(print_r($bdd->errorInfo()));
    if($result){
        $code=1;
        $message='Equipe supprimé';
    }else{
        $code=0;
        $message='Echec suppression';
    }
    echo (json_encode(array('code'=>$code,'message'=>$message)));
}


?>