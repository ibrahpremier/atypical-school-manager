<?php
   include 'verif_connexion.php';
?>
<?php
date_default_timezone_set('UTC');
// --- La setlocale() fonctionnne pour strftime mais pas pour DateTime->format()
setlocale(LC_TIME, 'fr_FR.utf8','fra');// OK
// strftime("jourEnLettres jour moisEnLettres annee") de la date courante
// echo "Date du jour : ", strftime("%A %d %B %Y");
?>
<!doctype html>
<html class="no-js" lang="fr-FR"> 
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>NaN Admin - Etudiant</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="../apple-icon.png">
    <link rel="shortcut icon" href="../favicon.ico">

    <link rel="stylesheet" href="../assets/css/normalize.css">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/css/themify-icons.css">
    <link rel="stylesheet" href="../assets/css/flag-icon.min.css">
    <link rel="stylesheet" href="../assets/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="../assets/css/lib/datatable/dataTables.bootstrap.min.css">
    <!-- <link rel="stylesheet" href="../assets/css/bootstrap-select.less"> -->
    <link rel="stylesheet" href="../assets/scss/style.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

    <!-- <script type="text/javascript" src="../https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->

</head>
<body>
<!-- Left Panel -->
<?php include "menu.php"; ?>
<!-- /#Left Panel -->

    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">
        <!-- Header-->
            <?php include "header.php"; ?>
        <!-- /header -->
        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Profil</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="../#">Etudiant</a></li>
                            <li class="active">Profil</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content mt-3">

<?php 
if(isset($_GET['et'])&& $_GET['et']!=0){

    $id_etudiant=$_GET["et"];
    $req="select * from etudiant, sexe, equipe, localite where etudiant.id_sexe=sexe.id_sexe and etudiant.equipe_actu=equipe.id_equipe and etudiant.id_localite=localite.id_localite and id_etudiant='$id_etudiant'";
    $result = $bdd->query($req) or die(print_r($bdd->errorInfo()));
    while($donnees = $result->fetch(PDO::FETCH_ASSOC)){
    $nom=$donnees['nom']." ".$donnees['prenom'];
    $prenom=$donnees['prenom'];
    $sexe=$donnees['libelle_sexe'];
    $tel=$donnees['telephone'];
    $email=$donnees['email'];
    $localite=$donnees['libelle_localite'];
    $id_equipe=$donnees['id_equipe'];
    $equipe=$donnees['nom_equipe'];
    $bonnus=$donnees['bonus'];
    $activite=$donnees['activite'];
    $commentaire=$donnees['commentaire'];
    $date_inscription=$donnees['date_inscription'];
    $like=$donnees['liked'];
    }

}



$req2="SELECT * FROM equipe, appartenir_equipe WHERE equipe.id_equipe=appartenir_equipe.id_equipe and id_etudiant='$id_etudiant' order by date_ajout_equipe asc";
$result2 = $bdd->query($req2) or die(print_r($bdd->errorInfo()));
$text="";
while($donnees2 = $result2->fetch(PDO::FETCH_ASSOC)){
 $text.="* Ajouté à ".$donnees2['nom_equipe']." le ".date('d/m/Y',strtotime($donnees2['date_ajout_equipe']));
 if(!empty($donnees2['commentaire']))
 $text.="<br>Raison: ".$donnees2['commentaire']."<br> ";
 else
 $text.="<br>";
}
?>




<?php 
$fa1="";
$fa2="";
if($like==1){
    $fa1="text-info";
} elseif($like==-1){
    $fa2="text-danger";
}
?>



          <div class="animated fadeIn">
            <div class="row">
                <div class="col-md-4">
                    <section class="card">
                        <div class="twt-feed blue-bg">
                            <div class="corner-ribon black-ribon">
                                <a href="#"><i class="fa fa-pencil"></i></a>
                            </div>
                            <div class=""></div>
                            <div class="media">
                                <div class="">
                                    <i class="fa fa-user fa-5x"></i>&nbsp;&nbsp;&nbsp;&nbsp;
                                    <!-- <img class="align-self-center rounded-circle mr-3" style="width:100px; height:100px;" alt="" src="../images/admin.jpg"> -->
                                </div>
                                <div class="media-body">
                                    <h3 class="text-white display-6"><?php echo $nom; ?></h3>
                                    <p class="text-light">Geek 3.0</p>
                                </div>
                            </div>
                        </div>
                        <div class="weather-category">
                            <ul>
                                <li class="active">
                                    <h5></h5>
                                    like / Dislike
                                </li>
                                <li>
                                    <h5><?php echo $bonnus; ?></h5>
                                    Bonus/Malus
                                </li>
                                <li>
                                    <h5>000</h5>
                                    Moyenne
                                </li>
                            </ul>
                            <div class="card-text text-sm-center row">
                                <div class="col-md-4">
                                    <a href="#" title="Like" onclick="like(<?php echo $id_etudiant ?>,1)"><i class="fa fa-thumbs-up fa-1x <?php echo $fa1 ?>"></i></a>
                                    &nbsp;
                                    <a href="#" title="Dislike" onclick="like(<?php echo $id_etudiant ?>,-1)"><i class="fa fa-thumbs-down fa-1x <?php echo $fa2 ?>"></i></a>
                                </div>
                                <div class="col-md-4">
                                    <a href="#" title="" onclick="bonus(<?php echo $id_etudiant ?>,1)"><i class="fa fa-plus-circle fa-1x"></i>&nbsp;1</a>
                                    &nbsp;
                                    <a href="#" title="" onclick="bonus(<?php echo $id_etudiant ?>,-1)"><i class="fa fa-minus-circle fa-1x"></i>&nbsp;1</a>
                                </div>
                                <div class="col-md-4 tex">
<?php 
$date=date('Y-m-d');
    $sreq="select * from presence where id_etudiant='$id_etudiant' and date_presence='$date'";
    $sresult = $bdd->query($sreq) or die(print_r($bdd->errorInfo()));
    $i=0;
    while($donnees2 = $sresult->fetch(PDO::FETCH_ASSOC)){
    $i++;
    $presence=$donnees2['type_presence'];
    }
    if($i==0)echo '<a href="presence.php?eq='.$id_equipe.'" class="btn btn-default btn-sm"> faire l\'appel</a>';
    else{
      if($presence=='present') echo '<i class="fa fa-circle text-success"></i>&nbsp;Présent';
      else echo '<i class="fa fa-circle text-danger"></i>&nbsp;Absent';
    }
?>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body row">
                            <div class="col-md-4">
                                <h6>Sexe</h6>
                                <p><?php echo $sexe; ?></p>
                            </div>
                            <div class="col-md-4">
                                <h6>Activité</h6>
                                <p><?php echo $activite; ?></p>
                            </div>
                            <div class="col-md-4">
                                <h6>Localité</h6>
                                <p><?php echo $localite; ?></p>      
                            </div>
                            <div class="col-md-4">
                                <h6>Contact</h6>
                                <p>
                                    <a href="tel:<?php echo $tel ?>"><?php echo $tel ?></a><br>
                                    <a href="mailto:<?php echo $email ?>"><?php echo $email ?></a></p>
                            </div>
                            <div class="col-md-4">
                                <h6>Equipe actuelle</h6>
                                <p><b><?php echo $equipe ?></b><br><small>Historique: <br><i><?php echo $text; ?></i></small></p>
                            </div>
                            <div class="col-md-4">
                                <h6>A NaN depuis le</h6>
                                <p>	<?php echo date('d/m/Y',strtotime($date_inscription))?></p>
                            </div>
                            <div class="col-md-12">
                                <h6>Commentaire</h6>
                                <p><?php echo $commentaire; ?></p>        
                            </div>
                        </div>
                        
                    </div>
                </div>

                
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
<?php ?>
                            <h5>Cette semaine</h5>
                            <hr>
                            <table id="" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                    <th>Date</th>
                                    <th>Etat</th>
                                    </tr>
                                </thead>
                                <tbody> 

<?php 
    //Ajouter des jours a une date
    $date=date('Y-m-d');
    // $newdate = date('Y-m-d', strtotime($date.' - 6 days'));
    $dernier_lundi = date("j", time() - ( date("N") -1) *86400 );
    $date_lundi=date('Y-m-d', strtotime(date('Y').'-'.date('m').'-'.$dernier_lundi));
    

$req="SELECT * from presence WHERE id_etudiant='$id_etudiant' AND date_presence >= '$date_lundi'  order by date_presence asc";
$result = $bdd->query($req) or die(print_r($bdd->errorInfo()));
while($donnees = $result->fetch(PDO::FETCH_ASSOC)){ 


    if($donnees['type_presence']=='present') $etat='<i class="text-success fa fa-circle"></i>';
    else $etat='<i class="text-danger fa fa-circle"></i>';
    ?> 
   

                                    <tr>
                                    <td><?php echo strftime("%A %d",strtotime($donnees['date_presence'])) ?></td>
                                    <td><?php echo $etat.' '.$donnees['type_presence'] ?></td>
                                    </tr>
<?php } ?>                                     
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-body">
                             <h5>Evaluations </h5>
                            <hr>
                            <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                    <th>N°</th>
                                    <th>Compositions</th>
                                    <th>Date</th>
                                    <th>Notes (%)</th>
                                    </tr>
                                </thead>
                                <tbody>
<?php 
  $req="SELECT * from etudiant, noter_composition, composition where etudiant.id_etudiant=noter_composition.id_etudiant AND composition.id_composition=noter_composition.id_composition AND equipe_actu='$id_equipe' AND etudiant.id_etudiant='$id_etudiant' order by date_composition desc";
$result = $bdd->query($req) or die(print_r($bdd->errorInfo()));
$a=1;
while($donnees = $result->fetch(PDO::FETCH_ASSOC)){ ?> 
   

                                    <tr>
                                    <td><?php echo $a++; ?></td>
                                    <td><a href="display_notes.php?compo=<?php echo $donnees['id_composition'] ?>"><?php echo $donnees['libelle_composition'] ?></a></td>
                                    <td><?php echo date('d/m/Y',strtotime($donnees['date_composition'])) ?></td>
                                    <td><?php echo $donnees['note'] ?></td>
                                    </tr>
<?php } ?>                                     
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


            </div>
          </div><!-- .animated -->
        </div><!-- .content -->
    </div><!-- /#right-panel -->
    <!-- Right Panel -->


    <!-- script -->
    <?php include "link_script.php"; ?>
    <!-- /#script -->

    <script src="../nan/js/all.js"></script>
    <script src="../nan/js/etudiants.js"></script>


    <script type="text/javascript">
        $(document).ready(function() {
          $('#bootstrap-data-table-export').DataTable();
        } );
    </script>


</body>
</html>
