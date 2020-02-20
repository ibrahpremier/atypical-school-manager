<?php
   include 'verif_connexion.php';
?>
<!doctype html>
<html class="no-js" lang=""> 
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>NAN Admin - Notes </title>
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
if(isset($_GET['compo'])){
  $id_compo=$_GET["compo"];

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
    } 
}
    ?>
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
      <div class="col-md-12"><h1 id="titre_compo"><?php if(isset($_GET['compo'])) echo $libelle_compo ?></h1></div>
    </div>
      <div class="card-body card-block">
        <form action="" method="post" name="frm_sel_note">
          <div class="col-md-12">
            <div class="form-group  col-md-4">
              <label for="" class="">Type de composition:</label><br>
              <select name="type_compo" id="type_compo" class="form-control" onchange="charg_compo('gestion')">
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
              <select name="compo" id="compo" onchange="charger_notes()" class="form-control">
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
            <div class="col-md-4" id="btn_mod_note">
                <a href="gestion_notes.php?eq=2" class="btn btn-info" >Afficher les notes</a>
                <div id="spinner"></div>
            </div>
          </div>
        </form>
      </div>
    </div>


    
    <form action="" name="frm_note">
<input type="hidden" name="equipe" value="<?php echo $id_equipe  ?>">
      <table id="bootstrap-data-table" class="table table-striped table-bordered">
        <thead>
          <tr>
            <th>N°</th>
            <th>Name</th>
            <th>Prénoms</th>
            <th>Note</th>
          </tr>
        </thead>
        <tbody>


<?php 
  $req="select * from etudiant where equipe_actu='$id_equipe' order by nom asc";
$result = $bdd->query($req) or die(print_r($bdd->errorInfo()));
$a=1;
while($donnees = $result->fetch(PDO::FETCH_ASSOC)){ ?>
  
    
          <tr>
            <td><?php echo $a++; ?></td>
            <td><?php echo $donnees['nom']; ?> </td>
            <td><?php echo $donnees['prenom']; ?></td>
            <td id="td_note_<?php echo $donnees['id_etudiant']; ?>">
              <input type="number" id="note_et_<?php echo $donnees['id_etudiant']; ?>" name="note_et_<?php echo $donnees['id_etudiant']; ?>" placeholder="Entrer une note" class="form-control form-control-sm">
            </td>
          </tr>
<?php } ?> 
        </tbody>
      </table>
      <hr>
<div class="row">
    <div class="col-md-6">
        <div id="spinner"></div>
        <div id="alert"></div>
    </div>
    <div class="col-md-6">
        <button class="btn btn-success float-right mr-5" onclick="enreg_notes()"><i class="fa fa-check"></i>&nbsp;Enregistrer les notes</button>
    </div>
</div>

</form>
          <br>
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



    <script src="../nan/js/all.js"></script>
    <script src="../nan/js/notes.js"></script>


    <script type="text/javascript">
    
    $(document).ready(function() {
        charger_notes()

} );
    </script>


</body>
</html>
