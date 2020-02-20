<?php
    session_start();
    require '../nan/database/connexion_bd.php';
    
	if(!isset($_SESSION['id_user']) || empty($_SESSION['id_user'])){ 
        // echo 'non connecté';
        header('location:login.php');	
    }
//     else{
// // echo 'connecté';
//     $id_user=$_SESSION['id_user'];
//     $req="select * from etudiant where id_etudiant='$id_user'";
//     $result = $bdd->query($req) or die(print_r($bdd->errorInfo()));
//     while($donnees = $result->fetch(PDO::FETCH_ASSOC)){
//         $nom=$donnees['nom'];
//         $prenom=$donnees['prenom'];
//     }
// }

?>