<?php
include('../database/connexion_bd.php');
    $date=date('Y-m-d');


if (isset($_GET['enreg_presence'])){

    $id_etudiant=$_GET['enreg_presence'];
    $type_presence='present'; //1=presence; 2=absence
 
    $req="select * from presence where id_etudiant='$id_etudiant' and date_presence='$date'";
    $result = $bdd->query($req) or die(print_r($bdd->errorInfo()));
    $i=0;
    while($donnees = $result->fetch(PDO::FETCH_ASSOC)){
        $i++;
    }   

    if($i==0){
        //requete
        $req = $bdd->prepare("INSERT INTO presence VALUES (?,?,?,?,?)");
        $enreg=$req->execute(array(NULL,$type_presence,$date,$id_etudiant,NULL));
        if($enreg){
            $code=1;
            $message='Presence enregistré';
        }
        else{
                $code=0;
                $message='echec enregistrement presence';

            }
        }
        else{
            $code=0;
            $message="existe deja";
        }
        echo (json_encode(array('code'=>$code,'message'=>$message)));
}



if (isset($_GET['enreg_absence'])){

    $id_equipe=$_GET['enreg_absence'];

    $type_presence='absent'; //1=presence; 2=absence
    $req="select * from etudiant where equipe_actu='$id_equipe'";
    $result = $bdd->query($req) or die(print_r($bdd->errorInfo()));
    $cp=$ca=0;
    while($donnees = $result->fetch(PDO::FETCH_ASSOC)){
        $id_etudiant=$donnees['id_etudiant'];
        $sreq="select * from presence where id_etudiant='$id_etudiant' and date_presence='$date'";
        $sresult = $bdd->query($sreq) or die(print_r($bdd->errorInfo()));
        $i=0;
        while($donnees2 = $sresult->fetch(PDO::FETCH_ASSOC)){
            $i++;
        }   

    if($i==0){
        //requete
        $req = $bdd->prepare("INSERT INTO presence VALUES (?,?,?,?,?)");
        $enreg=$req->execute(array(NULL,$type_presence,$date,$id_etudiant,NULL));
        if($enreg){
            $code=1;
            $message='Absence enregistré';
            $ca++;
        }
        else{
                $code=0;
                $message='echec enregistrement absence';

            }
        }
        else{
            $code=0;
            $message="existe deja";
            $cp++;
        }
    }
    echo (json_encode(array('code'=>1,'message'=>$ca.' Absent(s) et '.$cp.' Présent(s)enregistrés')));
}





if (isset($_GET['datep'])){
    $datep=$_GET['datep'];
   $json=date('d/m/Y',strtotime($datep));
   echo json_encode($json);

}


if (isset($_GET['display_presence_datatable'])){

    $datep=$_GET['display_presence_datatable'];
    $id_equipe=$_GET['eq'];
    
  $req="select * from etudiant where equipe_actu='$id_equipe' order by nom asc";
  $result = $bdd->query($req) or die(print_r($bdd->errorInfo()));
  $a=1;
  while($donnees = $result->fetch(PDO::FETCH_ASSOC)){
    $id_etudiant=$donnees['id_etudiant'];
     
    $sreq="select * from presence where id_etudiant='$id_etudiant' and date_presence='$datep'";
    $sresult = $bdd->query($sreq) or die(print_r($bdd->errorInfo()));
    $i=0;
    while($donnees2 = $sresult->fetch(PDO::FETCH_ASSOC)){
        $i++;
        $presence=$donnees2['type_presence'];
    }
        if($i==0){$fap='<i class="fa fa-circle text-warning"></i>&nbsp;Non disponible';}
        else{
        if($presence=='present') {$fap='<i class="fa fa-circle text-success"></i>&nbsp;Présent';}
        else {$fap='<i class="fa fa-circle text-danger"></i>&nbsp;Absent';}
        }
        
        $aaData[]=[
            $a++,
            '<a class="btn btn-link" href="profil_etudiant.php?et='.$donnees['id_etudiant'].'">'.$donnees['nom'].'</a>',
            $donnees['prenom'],
            $fap,
        ];
    }
    $sOutput['aaData'] = $aaData;        
    echo (json_encode($sOutput));

}




   ?>