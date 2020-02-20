<?php 
    include '../database/connexion_bd.php';
    
    $date=date('Y-m-d');

// charger les localisation dans le formulaire etudiant
if (isset($_GET['liste_loca'])){
    $requete="select * from localite order by libelle_localite asc";
    $resultat = $bdd->query($requete) or die(print_r($bdd->errorInfo()));
    while($donnees = $resultat->fetch(PDO::FETCH_ASSOC)){
    $json[]=["id"=>$donnees['id_localite'],"nom"=>$donnees['libelle_localite']];
    }
    echo (json_encode($json));
}



// Ajouter un etudiant
if (isset($_GET['add_et'])){
    $nom=$_POST['nom'];
    $prenom=$_POST['prenom'];
    $email=$_POST['email'];
    $tel=$_POST['tel'];
    $sexe=$_POST['sexe'];
    $localite=$_POST['loca'];
    $equipe=$_POST['equipe'];
    $statut=1;
    
            //insertion user
        $enreg=$bdd->prepare("INSERT INTO etudiant(nom, prenom, email, telephone,id_localite,id_sexe,statut,equipe_actu,date_inscription) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $req=$enreg->execute(array($nom,$prenom,$email,$tel,$localite,$sexe,$statut,$equipe,$date));
                    
    if($req){
        $id_et=$bdd->lastInsertId();

        //insertion relation user equipe
    $enreg2=$bdd->prepare("INSERT INTO appartenir_equipe VALUES (?, ?, ?, ?, ?)");
    $req2=$enreg2->execute(array(NULL,$id_et,$equipe,$date,null));
        if($req2){
        $code=1;
        $message='Etudiant enregistré';
        }
        else{
            $code=0;
            $message='echec enregistrement';
        }
    }
        else{
            $code=0;
            $message='echec enregistrement';
        }
        echo (json_encode(array('code'=>$code,'message'=>$message)));
    }


// charger un etudiant dans le modal pour archiver
if(isset($_GET["info_modal_arch_et"])) {
    $id_etudiant=$_GET["info_modal_arch_et"];
    $req="select * from etudiant where id_etudiant='$id_etudiant'";
    $result = $bdd->query($req) or die(print_r($bdd->errorInfo()));
    while($donnees = $result->fetch(PDO::FETCH_ASSOC)){
        $nom=$donnees['nom'].' '.$donnees['prenom'];
    }
        echo (json_encode(array("nom_etudiant"=>$nom)));		
    }
    

// Archiver un etudiant
if(isset($_GET["arch_et"])) {
    $id_etudiant=$_GET["arch_et"];
    $equipe=10; // Id de l'equipe archive
    $commentaire=$_POST['commentaire'];
    $req="UPDATE etudiant SET equipe_actu=$equipe WHERE id_etudiant='$id_etudiant'";
    $result = $bdd->query($req) or die(print_r($bdd->errorInfo()));
        if($result){

            //insertion dans la relation user - equipe
                    $enreg2=$bdd->prepare("INSERT INTO appartenir_equipe VALUES (?, ?, ?, ?, ?)");
                    $req2=$enreg2->execute(array(NULL,$id_etudiant,$equipe,$date,$commentaire));
                    if($req2){
                    $code=1;
                    $message='Etudiant archivé';
                    }
                    else{
                        $code=0;
                        $message='echec archivage';
                    }

        }else{
            $code=0;
            $message='Echec Archivage';
        }
        echo (json_encode(array('code'=>$code,'message'=>$message)));
    }
    

// Archiver un etudiant
if(isset($_GET["restaurer_et"])) {
    $id_etudiant=$_GET["restaurer_et"];
    $equipe=$_POST['equipe'];
    $commentaire=$_POST['commentaire'];
    $req="UPDATE etudiant SET statut=1, equipe_actu='$equipe' WHERE id_etudiant='$id_etudiant'";
    $result = $bdd->query($req) or die(print_r($bdd->errorInfo()));
    if($result){
        //insertion dans la relation user - equipe
                $enreg2=$bdd->prepare("INSERT INTO appartenir_equipe VALUES (?, ?, ?, ?, ?)");
                $req2=$enreg2->execute(array(NULL,$id_etudiant,$equipe,$date,$commentaire));
                if($req2){
                $code=1;
                $message='Etudiant basculé';
                }
                else{
                    $code=0;
                    $message='echec';
                }
    }
    else{
            $code=0;
            $message='echec';
        }
        echo (json_encode(array('code'=>$code,'message'=>$message)));
    }


// Like
if(isset($_GET["like"])) {
    $id_etudiant=$_GET["id"];
    $val=$_GET["like"];
    $req="UPDATE etudiant SET liked='$val' WHERE id_etudiant='$id_etudiant'";
    $result = $bdd->query($req) or die(print_r($bdd->errorInfo()));
    if($result){
            $code=1;
            $message='Liké';
    }
    else{
            $code=0;
            $message='echec like';
        }
        echo (json_encode(array('code'=>$code,'message'=>$message)));
    }
    

// Bonus
if(isset($_GET["bonus"])&&isset($_GET["id"])) {
    $id_etudiant=$_GET["id"];
    $val=$_GET["bonus"];
    $req="UPDATE etudiant SET bonus= (bonus+ $val) WHERE id_etudiant='$id_etudiant'";
    $result = $bdd->query($req) or die(print_r($bdd->errorInfo()));
    if($result){
            $code=1;
            $message='Etudiant basculé';
    }
    else{
            $code=0;
            $message='echec';
        }
        echo (json_encode(array('code'=>$code,'message'=>$message)));
    }

    
    



?>