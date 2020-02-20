<?php
include('../database/connexion_bd.php');
    
    if (isset($_GET['add_lo'])){

    $libelle_localite=$_POST['txt_localite'];
    //requete
    $enreg=$bdd->exec("INSERT INTO localite VALUES (NULL,'$libelle_localite')");
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

    if (isset($_GET['aff_lo'])){
        $aaData = array();
        $requete="select * from localite order by libelle_localite asc";
        $resultat = $bdd->query($requete) or die(print_r($bdd->errorInfo()));
        $i=1;
        while($donnees = $resultat->fetch(PDO::FETCH_ASSOC)){
            $id=$donnees['id_localite'];
        $aaData[]=[
            $i,
            $donnees['libelle_localite'],
            '<a href="" class=" btn btn-link" data-toggle="modal" data-target="#modal_mod_localisation"  title="Modifier" onclick="modal_mod_localisation('.$id.')"><i class="fa fa-edit"></i></a>
            <a href="" class=" btn btn-link" data-toggle="modal" data-target="#modal_supp_localisation" onclick="modal_supp_localisation('.$id.')" title="Supprimer"><i class="fa fa-trash"></i></a>'
        ];
        $i++;
        }
        $sOutput['aaData'] = $aaData;        
        echo (json_encode($sOutput));
   }



// charger une localisation dans le modal pour modification
if(isset($_GET["info_modal_maj_localisation"])) {
    $id_localisation=$_GET["info_modal_maj_localisation"];
    $req="select * from localite where id_localite='$id_localisation'";
    $result = $bdd->query($req) or die(print_r($bdd->errorInfo()));
    while($donnees = $result->fetch(PDO::FETCH_ASSOC)){
        $nom=$donnees['libelle_localite'];
    }
    echo (json_encode(array("nom_localisation"=>$nom)));		
    }


// mis a jour du nom d'une localisation
if(isset($_GET["maj_loca"])) {
    $id_localisation=$_GET["maj_loca"];
    $new_nom_localisation=$_POST['txt_mod_localisation'];
    $req="update localite set libelle_localite='$new_nom_localisation' where id_localite='$id_localisation'";
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
if(isset($_GET["info_modal_supp_loca"])) {
    $id_loca=$_GET["info_modal_supp_loca"];
    $req="select * from localite where id_localite='$id_loca'";
    $result = $bdd->query($req) or die(print_r($bdd->errorInfo()));
    while($donnees = $result->fetch(PDO::FETCH_ASSOC)){
        $nom=$donnees['libelle_localite'];
    }
        echo (json_encode(array("nom_localite"=>$nom)));		
    }
    

// supprimer une localisation
if(isset($_GET["supp_loca"])) {
    $id_loca=$_GET["supp_loca"];
    $req="DELETE FROM localite WHERE id_localite='$id_loca'";
    $result = $bdd->query($req) or die(print_r($bdd->errorInfo()));
        if($result){
            $code=1;
            $message='Localité supprimé';
        }else{
            $code=0;
            $message='Echec suppression';
        }
        echo (json_encode(array('code'=>$code,'message'=>$message)));
    }
    
    


   ?>