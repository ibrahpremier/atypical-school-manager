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
                        <h1>Liste des étudiants <?php echo $nom_equipe ?></h1>
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

                <a class="btn btn-primary btn-sm" href="form_etudiant.php?eq=<?php if (isset($_GET['eq'])) echo $_GET['eq']; ?>"><i class="fa fa-plus"></i>&nbsp;Ajouter un nouvel étudiant</a>
              </div>
              <div class="col-md-6">
                  <div id="alert"></div>
                  <div id="spinner"></div>
              </div>
            </div>
              <hr>
      <table id="bootstrap-data-table" class="table table-striped table-bordered">
        <thead>
          <tr>
            <!--<th>
              <div class="form-check-inline form-check center">
                <label for="inline-checkbox1" class="form-check-label ">
                  <input type="checkbox" id="inline-checkbox1" name="inline-checkbox1" value="option1" class="form-check-input">
                </label>                                
              </div>
            </th>-->
            <th>N°</th>
            <th>Nom</th>
            <th>Prénoms</th>
            <th>Présence</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
<?php 
  $req="select * from etudiant where equipe_actu='$id_equipe' order by nom asc";
$result = $bdd->query($req) or die(print_r($bdd->errorInfo()));
$a=1;
while($donnees = $result->fetch(PDO::FETCH_ASSOC)){ 
  $id_etudiant=$donnees['id_etudiant'];
?>     
        <tr>
         <!-- <td>
            <div class="form-check-inline form-check center">
              <label for="inline-checkbox1" class="form-check-label ">
                <input type="checkbox" id="inline-checkbox1" name="inline-checkbox1" value="option1" class="form-check-input">
              </label>                                
            </div>
          </td>-->
          <td><?php echo $a++; ?></td>
          <td><a href="profil_etudiant.php?et=<?php echo $donnees['id_etudiant'] ?>" class=" btn btn-link" title="Voir le profil"><?php echo $donnees['nom'] ?></a></td>
          <td><?php echo $donnees['prenom'] ?></td>
          <td>
            <div class="">
              
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
          </td>
          <td>
            <div class="">
              <a href="profil_etudiant.php?et=<?php echo $donnees['id_etudiant'] ?>" class=" btn btn-link" title="Voir le profil"><i class="fa fa-user" ></i></a>
              <a href="form_etudiant.php?et=<?php echo $donnees['id_etudiant'] ?>" class=" btn btn-link" title="Modifier"><i class="fa fa-edit" ></i></a>
              <a href="" class=" btn btn-link" data-toggle="modal" data-target="#modal_restaurer_etudiant" onclick="modal_restaurer_et(<?php echo $donnees['id_etudiant'] ?>)" title="Basculer dans une autre equipe"><i class="fa fa-random"></i></a>
              <a href="" class=" btn btn-link" data-toggle="modal" data-target="#modal_archiver_etudiant" onclick="modal_archiver_et(<?php echo $donnees['id_etudiant'] ?>)" title="Archiver"><i class="fa fa-trash"></i></a>
            </div>
          </td>
        </tr>
<?php } ?>
      </tbody>
  </table>
  <hr>


          </div><!-- .animated -->
        </div><!-- .content --> 

    </div><!-- /#right-panel -->
    <!-- Right Panel -->

            
<!-- Modals3 archivage -->
<div class="modal fade" id="modal_archiver_etudiant" tabindex="-1" role="dialog" aria-labelledby="scrollmodalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="scrollmodalLabel">Archivage</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" >
                <!-- contenu  -->
                  <form name="frm_arch_et" action="">
                <div class="row">
                  <div class="col-sm-12 text-center">
                    <h5>Archiver</h5> <h4 id="titre_modal_arch"></h4>
                  </div>
                  <br><br><br><br>
                      <textarea class="col-md-10 ml-3" name="commentaire" id="commentaire" rows="4" placeholder="Facultatif: Vous pouvez saisir un commentaire ici..."></textarea>
                   
                        
                </div>
                <br><br>
                <div class="row">
                    <div class="col-sm-12 text-center">
                        <button type="button" class="btn btn-info btn-sm col-sm-3" data-dismiss="modal">Annuler</button>
                        <button type="button" id="btn_arch_et" class="btn btn-danger btn-sm col-sm-3" data-dismiss="modal">Archiver</button>
                    </div>
                </div>
                  </form>
            <!-- /#contenu  -->
            
            </div>

        </div>
    </div>
</div>
<!-- Modals part -->


            
<!-- Modals3 basculer equipe -->
<div class="modal fade" id="modal_restaurer_etudiant" tabindex="-1" role="dialog" aria-labelledby="scrollmodalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="scrollmodalLabel">Basculer d'equipe</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" >
                <!-- contenu  -->
                <form name="frm_res_et" action="">
                <div class="row">
                    <div class="col-sm-12 text-center">
                        <h5>Basculer</h5> <h4 id="titre_modal_arch"></h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 text-center">
                        <form name="frm_res_et" action="">
                            <br>
                            <div class="row">
                            <select class="form-control col-md-10 ml-3" name="equipe" id="equipe">
                                <option value="null" selected disabled>Equipe de destination</option>
<?php 
$req="select * from equipe where id_equipe!=10 and id_equipe!='$id_equipe'";
$result = $bdd->query($req) or die(print_r($bdd->errorInfo()));
while($donnees = $result->fetch(PDO::FETCH_ASSOC)){ ?>
<option value="<?php echo $donnees['id_equipe']  ?>"><?php echo $donnees['nom_equipe']  ?></option>
<?php } ?>
                            </select>
                                <br><br>
                            </div>
                            <div class="row">
                                    <textarea class="col-md-10 ml-3" name="commentaire" id="commentaire" rows="4" placeholder="Facultatif: Vous pouvez saisir un commentaire ici..."></textarea>
                            </div>
                        </form>
                    </div>
                </div>
                <br><br>
                <div class="row">
                    <div class="col-sm-12 text-center">
                        <button type="button" class="btn btn-info btn-sm col-sm-3" data-dismiss="modal">Annuler</button>
                        <button type="button" id="btn_restaurer_et" class="btn btn-danger btn-sm col-sm-3" data-dismiss="modal">Basculer</button>
                    </div>
                </div>
                    </form>
            <!-- /#contenu  -->
            
            </div>

        </div>
    </div>
</div>
<!-- Modals part -->

    <!-- script -->
    <?php include "link_script.php"; ?>
    <!-- /#script -->

    <script src="../nan/js/all.js"></script>
    <script src="../nan/js/etudiants.js"></script>


    <script type="text/javascript">
        $(document).ready(function() {
            
        } );
    </script>


</body>
</html>
