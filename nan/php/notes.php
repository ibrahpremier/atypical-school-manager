<?php
    require '../database/connexion_bd.php';

// charger les compo dans le formulaire note
if (isset($_GET['charg_compo'])){
    $json[]=array();
    $id_type_compo=$_GET['charg_compo'];
    $requete="select * from composition where id_type_composition='$id_type_compo'";
    $resultat = $bdd->query($requete) or die(print_r($bdd->errorInfo()));
    while($donnees = $resultat->fetch(PDO::FETCH_ASSOC)){
    $json[]=["id"=>$donnees['id_composition'],"libelle"=>$donnees['libelle_composition']];
    }
    echo (json_encode($json));
}




// Noter une compo
if (isset($_GET['noter_compo'])){
    $id_compo=$_GET['noter_compo'];
    $id_equipe=$_POST['equipe'];
    
    $ok=$echec=0;
    $code=1;
    //selection de tout les etudiants de l'equipe concerné
    $requete="select * from etudiant where equipe_actu='$id_equipe' order by nom asc";
    $resultat = $bdd->query($requete) or die(print_r($bdd->errorInfo()));
    while($donnees = $resultat->fetch(PDO::FETCH_ASSOC)){
        $id_etudiant=$donnees['id_etudiant'];

        //verification de l'existance d'une note pour la meme evaluation
        $requete2="select * from noter_composition where id_etudiant='$id_etudiant' and id_composition='$id_compo'";
        $resultat2 = $bdd->query($requete2) or die(print_r($bdd->errorInfo()));
        $i=0;
            while($donnees2 = $resultat2->fetch(PDO::FETCH_ASSOC)){
                $i++;
            }
    if($i==0){

            $txt_note='note_et_'.$id_etudiant;
            $note=$_POST[$txt_note];
            if(!empty($note)){
                $enreg=$bdd->prepare("INSERT INTO noter_composition VALUES (?, ?, ?, ?)");
                $req=$enreg->execute(array(NULL,$id_etudiant,$id_compo,$note));
                if($req){
                    $ok++;
                }else{
                    $echec++;
                    
                }
            }

        }
    }
            if($echec>0) $code=0;
        echo (json_encode(array('code'=>$code,'message'=>$ok.' enregistrements effectués<br> ')));
    }





// charger les notes 
if (isset($_GET['charger_note'])){
    $id_compo=$_GET['charger_note'];
    $id_equipe=$_POST['equipe'];

    //selection de tout les etudiants de l'equipe concerné
    $requete="select * from etudiant where equipe_actu='$id_equipe' order by nom asc";
    $resultat = $bdd->query($requete) or die(print_r($bdd->errorInfo()));
    while($donnees = $resultat->fetch(PDO::FETCH_ASSOC)){

        $id_etudiant=$donnees['id_etudiant'];
        //recherche de notes existente
        $requete2="select * from noter_composition where id_etudiant='$id_etudiant' and id_composition='$id_compo'";
        $resultat2 = $bdd->query($requete2) or die(print_r($bdd->errorInfo()));
        $note=-1;
        $id_noter='';
        while($donnees2 = $resultat2->fetch(PDO::FETCH_ASSOC)){
            $note=$donnees2['note'];
            $id_noter=$donnees2['id_noter_composition'];
        }

        $json[]=array('etu'=>$id_etudiant,'id_noter'=>$id_noter,'note'=>$note); 

    }
        echo (json_encode($json));
}
    



// charger une localisation dans le modal pour modification
if(isset($_GET["info_modal_maj_note"])) {
    $id_noter=$_GET["info_modal_maj_note"];
    $req="select * from noter_composition where id_noter_composition='$id_noter'";
    $result = $bdd->query($req) or die(print_r($bdd->errorInfo()));
    while($donnees = $result->fetch(PDO::FETCH_ASSOC)){
        $note=$donnees['note'];
    }
    echo (json_encode(array("note"=>$note)));		
    }


// mis a jour du nom d'une localisation
if(isset($_GET["maj_note"])) {
    $id_noter=$_GET["maj_note"];
    $new_note=$_POST['txt_mod_note'];
    $req="update noter_composition set note='$new_note' where id_noter_composition='$id_noter'";
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
    

// charger les notes dans le chart pour la page display_note.php
if (isset($_GET['display_notes_chart'])){
    $id_compo=$_GET['display_notes_chart'];
    $id_equipe=$_GET['eq'];

    //selection de tout les etudiants de l'equipe concerné
    $requete="select * from etudiant where equipe_actu='$id_equipe' order by nom asc";
    $resultat = $bdd->query($requete) or die(print_r($bdd->errorInfo()));
    $ia=1;
    while($donnees = $resultat->fetch(PDO::FETCH_ASSOC)){

        $id_etudiant=$donnees['id_etudiant'];
        //recherche de notes existente
        $requete2="select * from noter_composition where id_etudiant='$id_etudiant' and id_composition='$id_compo'";
        $resultat2 = $bdd->query($requete2) or die(print_r($bdd->errorInfo()));
        $note='';
            while($donnees2 = $resultat2->fetch(PDO::FETCH_ASSOC)){
                $note=$donnees2['note'];
                $id_noter=$donnees2['id_noter_composition'];
            }
            $json[]=[
                "nom"=>$donnees['nom']." ".$donnees['prenom'],
                "note"=>$note,
            ];
        }       
        echo (json_encode($json));
}
    

// charger les notes dans le datatable pour la page display_note.php
if (isset($_GET['display_notes_datatable'])){
    $id_compo=$_GET['display_notes_datatable'];
    $id_equipe=$_GET['eq'];

    //selection de tout les etudiants de l'equipe concerné
    $requete="select * from etudiant where equipe_actu='$id_equipe' order by nom asc";
    $resultat = $bdd->query($requete) or die(print_r($bdd->errorInfo()));
    $ia=1;
    while($donnees = $resultat->fetch(PDO::FETCH_ASSOC)){

        $id_etudiant=$donnees['id_etudiant'];
        //recherche de notes existente
        $requete2="select * from noter_composition where id_etudiant='$id_etudiant' and id_composition='$id_compo'";
        $resultat2 = $bdd->query($requete2) or die(print_r($bdd->errorInfo()));
        $note='';
            while($donnees2 = $resultat2->fetch(PDO::FETCH_ASSOC)){
                $note=$donnees2['note'];
                $id_noter=$donnees2['id_noter_composition'];
            }
            $aaData[]=[
                $ia++,
                $donnees['nom'],
                $donnees['prenom'],
                $note,
            ];
        }
        $sOutput['aaData'] = $aaData;        
        echo (json_encode($sOutput));
}



// charger les compo dans le formulaire note
if (isset($_GET['nom_compo'])){
    $id_compo=$_GET['nom_compo'];
    $requete="select * from composition where id_composition='$id_compo'";
    $resultat = $bdd->query($requete) or die(print_r($bdd->errorInfo()));
    while($donnees = $resultat->fetch(PDO::FETCH_ASSOC)){
        $json=$donnees['libelle_composition'];
    }
    echo (json_encode($json));
}



?>