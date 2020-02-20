<?php
   include 'verif_connexion.php';
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
    <link rel="stylesheet" href="../assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/css/themify-icons.css">
    <link rel="stylesheet" href="../assets/css/flag-icon.min.css">
    <link rel="stylesheet" href="../assets/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="../assets/css/lib/datatable/dataTables.bootstrap.min.css">
    <!-- <link rel="stylesheet" href="../assets/css/bootstrap-select.less"> -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link href="../assets/css/bootstrap-select.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../assets/scss/style.css">

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
        <div class="content mt-3">
          <div class="animated fadeIn">
            <div class="row">

<?php 
if(isset($_GET['et'])&& $_GET['et']!=0){

    $id_etudiant=$_GET["et"];
    $req="select * from etudiant where id_etudiant='$id_etudiant'";
    $result = $bdd->query($req) or die(print_r($bdd->errorInfo()));
    while($donnees = $result->fetch(PDO::FETCH_ASSOC)){
    $nom=$donnees['nom'];
    $prenom=$donnees['prenom'];
    $sexe=$donnees['id_sexe'];
    $tel=$donnees['telephone'];
    $email=$donnees['email'];
    $localite=$donnees['id_localite'];
    $equipe=$donnees['equipe_actu'];
    }

}
?>


<!-- formulaire etudiant -->
<div class="col-md-1"></div>
<div class="card col-md-9">
          <div class="card-header">
            <strong> <i class="fa fa-plus"></i>NOUVELLE COMPO</strong>
          </div>
<form id="form" name="frm_compo">
            <div class="card-body card-block">
                
<div class="row">
              <div class="form-group  col-md-4">
                <label for="Nom" class=" form-control-label">Nom</label>
                <input type="" name="nom_compo" id="nom_compo" value="" placeholder="Veillez entrer votre nom" class="form-control" required>
              </div>
</div>
<div class="row">
              <div class="form-group  col-md-8">
                <label for="" class=" form-control-label">Type Compo</label>
                <select name="type_compo" id="type_compo" class="form-control" onchange="on_quiz()" required>
                  <option selected disabled >Choisir le type</option>
<?php 
$req="select * from type_composition";
$result = $bdd->query($req) or die(print_r($bdd->errorInfo()));
while($donnees = $result->fetch(PDO::FETCH_ASSOC)){ ?>
<option value="<?php echo $donnees['id_type_composition']  ?>"><?php echo $donnees['libelle_type_composition']  ?></option>
<?php } ?>
                </select>
              </div>

</div>
<div class="row" id="input_nbr_question">
              <div class="form-group col-md-4">
                <label for="" class=" form-control-label">Nombre question</label>
                <input type="number" name="nbr_question" id="nbr_question" placeholder="" class="form-control">
              </div>
</div>
<div class="row" id="input_quota">
              <div class="form-group col-md-4">
                <label for="Prénom" class=" form-control-label">Quota Succes (%)</label>
                <input type="number" name="quota" id="quota" placeholder="" class="form-control">
              </div>
</div>
<div class="row" id="input_sujet">
              <div class="form-group col-md-10">
                <label for="Prénom" class=" form-control-label">Sujet projet</label>
               <textarea name="sujet" id="sujet" placeholder="Facultatif: " class="form-control" rows="10"></textarea>
              </div>
</div>
<div class="row" id="">
              <div class="form-group col-md-4">
                <label for="" class=" form-control-label">Date</label>
                <input type="date" name="date_compo" id="date_compo" placeholder="" class="form-control" required>
              </div>
</div>

            <div class="row">
                <div id="alert" class="col-md-8"></div>
                <div id="spinner" class="col-md-3"></div>
            </div>
            <br>
    <div class="row">
        <div class="col-md-12 text-center">
            <button type="submit" class="btn btn-success" onclick="add_compo()">Enregister
            </button>
    </div>
</div>
</form>
            <br>
            <br>
            <br>
        </div>
<!-- /#formulaire etudiant -->

            </div>
          </div><!-- .animated -->
        </div><!-- .content -->

    </div><!-- /#right-panel -->
    <!-- Right Panel -->


    <!-- script -->
    <?php include "link_script.php"; ?>
    <!-- /#script -->
    
    <script src="../nan/js/all.js"></script>
    <script src="../nan/js/composition.js"></script> 

    <script type="text/javascript">
        $(document).ready(function() {
        
            $('#input_nbr_question').hide();    
            $('#input_quota').hide();    
            $('#input_sujet').hide();    

            $('.selectpicker').selectpicker();    
        } );
    </script>


</body>
</html>
