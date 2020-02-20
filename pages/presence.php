<?php
   include 'verif_connexion.php';
?>
<!doctype html>
<html class="no-js" lang=""> 
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sufee Admin - HTML5 Admin Template</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="../apple-icon.png">
    <link rel="shortcut icon" href="../favicon.ico">

    <!-- stylesheet -->
    <?php include "stylesheet.php"; ?>
    <!-- /#stylesheet -->

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
<?php 
if(isset($_GET['eq'])){
  $id_equipe=$_GET["eq"];
  $req0="select * from equipe where id_equipe='$id_equipe'";
  $result0 = $bdd->query($req0) or die(print_r($bdd->errorInfo()));
  while($donnees0 = $result0->fetch(PDO::FETCH_ASSOC)){
    $nom_equipe=$donnees0['nom_equipe'];
  } 
}
 ?>

                    <div class="page-title">
                        <h1>Faire l'appel -  <?php echo $nom_equipe ?></h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="../#">Gestion</a></li>
                            <li class="active">Etudiants -  <?php echo $nom_equipe ?></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content mt-3">
          <div class="animated fadeIn">
            <div class="row">
              <div class="col-md-6">

              </div>
              <div class="col-md-6">
                  <div id="alert"></div>
                  <div id="spinner"></div>
              </div>
            </div>
              <hr>
<form action="" name="frm_presence">
      <table id="bootstrap-data-table" class="table table-striped table-bordered">
        <thead>
          <tr>
            <th>N°</th>
            <th>Nom</th>
            <th>Prénoms</th>
            <th>Présence</th>
          </tr>
        </thead>
        <tbody>
<?php 
  $req="select * from etudiant where equipe_actu='$id_equipe' order by nom asc";
$result = $bdd->query($req) or die(print_r($bdd->errorInfo()));
$a=1;
while($donnees = $result->fetch(PDO::FETCH_ASSOC)){ 

$id_etudiant=$donnees['id_etudiant'];

$date=date('Y-m-d');
$ad='';
    $sreq="select * from presence where id_etudiant='$id_etudiant' and date_presence='$date'";
    $sresult = $bdd->query($sreq) or die(print_r($bdd->errorInfo()));
    $i=0;
    while($donnees2 = $sresult->fetch(PDO::FETCH_ASSOC)){
    $i++;
    $presence=$donnees2['type_presence'];
    }
    if(($i==1)&&($presence=='present')) $ad='checked';
?>



        <tr>
          <td><?php echo $a++; ?></td>
          <td><a href="profil_etudiant.php?et=<?php echo $donnees['id_etudiant'] ?>" class=" btn btn-link" title="Voir le profil"><?php echo $donnees['nom'] ?></a></td>
          <td><?php echo $donnees['prenom'] ?></td>
          <td>
            <div class="">
                Abs
            <label class="switch switch-3d switch-success mr-3">
              <input type="checkbox" id="presence<?php echo $donnees['id_etudiant'] ?>" class="switch-input check_box" onchange="enreg_presence(<?php echo $donnees['id_etudiant'] ?>)" <?php echo $ad ?>>
              <span class="switch-label"></span> <span class="switch-handle"></span>
            </label>Présent
            </div>
          </td>
        </tr>
<?php } ?>
      </tbody>
  </table>
  <br>
  <div class="row">
      <div class="col-md-6"></div>
      <div class="col-md-6">
          <button type="submit" class="btn btn-primary" onclick="enreg_absence(<?php echo $id_equipe ?>)">Enregistrer les présences</button>
        </div>
    </div>
</form>
  <hr>


          </div><!-- .animated -->
        </div><!-- .content --> 

    </div><!-- /#right-panel -->
    <!-- Right Panel -->

            

    <!-- script -->
    <?php include "link_script.php"; ?>
    <!-- /#script -->

    <script src="../nan/js/all.js"></script>
    <script src="../nan/js/t_presence.js"></script>


    <script type="text/javascript">
        $(document).ready(function() {

        } );
    </script>


</body>
</html>
