<?php
   include 'verif_connexion.php';
?>

<?php
date_default_timezone_set('Europe/Paris');
// --- La setlocale() fonctionnne pour strftime mais pas pour DateTime->format()
setlocale(LC_TIME, 'fr_FR.utf8','fra');// OK
// strftime("jourEnLettres jour moisEnLettres annee") de la date courante
//echo "Date du jour : ", strftime("%A %d %B %Y");
?>
<!doctype html>
<html class="no-js" lang="FR-fr"> 
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Nan Admin - Presence</title>
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
                        <h1>Liste des Presence <?php echo $nom_equipe ?></h1>
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
              
      <div class="card">
      <div class="card-header">
        <div class="col-md-12"><h1 id="titre_presence"></h1></div>
      </div>
        <div class="card-body card-block">
          <form action="" method="post" name="frm_sel_note">
            <div class="col-md-12">
              <div class="form-group  col-md-4">
                                           
              </div>
              <div class="form-group col-md-6" id="select_presence">
                <label for="" class="">Selectionner la date:</label><br>
                <select name="datep" id="datep" onchange="charg_list_date()" class="form-control">
<?php 
$text3="";
$req3="SELECT DISTINCT date_presence from presence order by date_presence desc";
$result3 = $bdd->query($req3) or die(print_r($bdd->errorInfo()));
while($donnees3 = $result3->fetch(PDO::FETCH_ASSOC)){ 
?>
<option value="<?php echo $donnees3['date_presence'] ?>" >
<?php echo strftime("%A %d %B %Y",strtotime($donnees3['date_presence']))  ?></option>
<?php } ?>

                </select>
              </div>
              <div class="col-md-4">
                  <!-- <a href="" class="btn btn-info" >Modifier les notes</a> -->
                  <div id="spinner"></div>
              </div>
            </div>
          </form>
        </div>
      </div>
            <div class="row">
              <div class="col-md-6">

              </div>
              <div class="col-md-6">
                  <div id="alert"></div>
                  <div id="spinner"></div>
              </div>
            </div>
              <hr>
              <input type="hidden" id="txt_equipe">
      <table id="bootstrap-data-table-presence" class="table table-striped table-bordered">
        <thead>
          <tr>
            <th>N°</th>
            <th>Nom</th>
            <th>Prénoms</th>
            <th>Présence</th>
          </tr>
        </thead>
        <tbody>
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
    <script src="../nan/js/t_presence.js"></script>


    <script type="text/javascript">
        $(document).ready(function() {
            charg_list_date();
        } );
    </script>


</body>
</html>
