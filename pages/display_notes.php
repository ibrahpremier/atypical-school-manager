<?php
   include 'verif_connexion.php';
?>
<!doctype html>
<html class="no-js" lang=""> 
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin - Affichage de notes</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="../apple-icon.png">
    <link rel="shortcut icon" href="../favicon.ico">

    <!-- stylesheet -->
    <?php include "stylesheet.php"; ?>
    <!-- /#stylesheet -->
    <link rel="stylesheet" href="../assets/css/lib/chosen/chosen.min.css">

    <!-- <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'> -->

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
if(isset($_GET['compo'])){
  $id_compo=$_GET["compo"];
}
$sql1="SELECT *
FROM
composition, type_composition
WHERE composition.id_type_composition = type_composition.id_type_composition
AND id_composition='$id_compo'";
$stat1 = $bdd->query($sql1) or die(print_r($bdd->errorInfo()));
while($donnees1 = $stat1->fetch(PDO::FETCH_ASSOC)){ 
    $type_compo_get=$donnees1['id_type_composition'];
    $compo_get=$donnees1['id_composition'];
    $libelle_compo =$donnees1['libelle_composition'];
    } ?>
                    <div class="page-title">
                        <h1> <?php if(isset($_GET['eq'])) echo strtoupper('Notes '.$nom_equipe) ?></h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="../#">Gestion</a></li>
                            <li class="active">Etudiants </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>


        <div class="content mt-3">
          <div class="animated fadeIn">
      <div class="card">
      <div class="card-header">
        <div class="col-md-12"><h1 id="titre_compo"><?php echo $libelle_compo ?></h1></div>
      </div>
        <div class="card-body card-block">
          <form action="" method="post" name="frm_sel_note">
            <div class="col-md-12">
              <div class="form-group  col-md-4">
                <label for="" class="">Type de composition:</label><br>
                <select name="type_compo" id="type_compo" class="form-control" onchange="charg_compo('display')">
                  <option value="null" disabled>Sélectionner le type de composition</option>
<?php 
$text0="";
$req="select * from type_composition";
$result = $bdd->query($req) or die(print_r($bdd->errorInfo()));
while($donnees = $result->fetch(PDO::FETCH_ASSOC)){ 
if($donnees['id_type_composition']==$type_compo_get) $text0="selected";
else $text0="";
?>
<option value="<?php echo $donnees['id_type_composition']  ?>" <?php echo $text0 ?>><?php echo strtoupper($donnees['libelle_type_composition']) ?></option>
<?php } ?>
                </select>                            
              </div>

              
              <div class="form-group col-md-4" id="select_compo">
                <label for="" class="">Composition:</label><br>
                <select name="compo" id="compo" onchange="display_notes_datatable()" class="form-control">
<?php 
$text3="";
$req3="select * from composition where id_type_composition='$type_compo_get'";
$result3 = $bdd->query($req3) or die(print_r($bdd->errorInfo()));
while($donnees3 = $result3->fetch(PDO::FETCH_ASSOC)){ 
if($donnees3['id_composition']==$compo_get)$text3="selected";
else $text3="";
?>
<option value="<?php echo $donnees3['id_composition']  ?>" <?php echo $text3 ?>><?php echo strtoupper($donnees3['libelle_composition'])  ?></option>
<?php } ?>

                </select>
              </div>
              <div class="col-md-4" id="btn_afficher_note">
                  <a href="gestion_notes.php?eq=2&compo=<?php echo $donnees3['id_composition']  ?>" class="btn btn-info" >Modifier les notes</a>
                  <div id="spinner"></div>
              </div>
            </div>
          </form>
        </div>
      </div>


<input type="hidden" id="equipe_txt_hidden" value="<?php if(isset($_GET['eq'])) echo $id_equipe; else echo 2;  ?>">

<div class="row">
    <div class="col-lg-10">
        <div class="card">
            <div class="card-body">
                <h4 class="mb-3">Meilleur etudiant du mois</h4>
                <div id="canvas_div">
                    <canvas id="div_compo_chart"></canvas>
                </div>
            </div>
        </div>
    </div><!-- /# column -->
</div>
          <br>

      <table id="bootstrap-data-table-notes" class="table table-striped table-bordered">
        <thead>
          <tr>
            <th>N°</th>
            <th>Name</th>
            <th>Prénoms</th>
            <th>Note</th>
          </tr>
        </thead>
      </table>
      <hr>

          <br>
          <br>



          

          </div><!-- .animated -->
        </div><!-- .content --> 

    </div><!-- /#right-panel -->
    <!-- Right Panel -->

<!-- Modals2 modifier -->
<div class="modal fade" id="modal_modifier_note" tabindex="-1" role="dialog" aria-labelledby="scrollmodalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="scrollmodalLabel">Modifier une équipe</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form name="frm_m_note">
            <div class="modal-body">

                        <div class="row form-group">
                            <div class="col-8">
                            <div class="form-group">
                                <label for="city" class=" form-control-label">Note /100</label>
                                <input type="text" id="txt_mod_note" name="txt_mod_note" placeholder="" class="form-control">
                            </div>
                            </div>
                        </div>

            </div>
            <div class="modal-footer">
                <button id="btn_maj_note" type="submit" class="btn btn-primary" data-dismiss="modal" >Modifier</button>
            </div>
        </form>

        </div>
    </div>
</div>
<!-- Modals part -->



    <!-- script -->
    <?php include "link_script.php"; ?>
    <!-- /#script -->


    <script src="../assets/js/lib/data-table/buttons.print.min.js"></script>
    <script src="../assets/js/lib/data-table/pdfmake.min.js"></script>

    <script src="../nan/js/all.js"></script>
    <script src="../nan/js/notes.js"></script>


    <script type="text/javascript">
    
    $(document).ready(function() {
        display_notes_datatable();
    });
    </script>
        <!--  Chart js -->
<script src="../assets/js/lib/chart-js/Chart.bundle.js"></script>
<!-- <script src="../assets/js/lib/chosen/chosen.jquery.min.js"></script> -->



</body>
</html>
