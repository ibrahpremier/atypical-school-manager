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
            <strong> <i class="fa fa-plus"></i><?php if(isset($_GET["et"])) echo " MODIFICATION SUR ETUDIANT"; else echo " NOUVEL ETUDIANT"; ?></strong>
          </div>
          <form id="form" name="frm_et">
            <div class="card-body card-block">
                
<div class="row">
              <div class="form-group  col-md-4">
                <label for="Nom" class=" form-control-label">Nom</label>
                <input type="text" name="nom" id="Nom" value="<?php if(isset($nom)) echo $nom; ?>" placeholder="Veillez entrer votre nom" class="form-control">
              </div>
              <div class="form-group col-md-7">
                <label for="Prénom" class=" form-control-label">Prénom(s)</label>
                <input type="text" name="prenom" id="prenom" value="<?php if(isset($prenom)) echo $prenom; ?>" placeholder="Veillez entrer votre Prénom" class="form-control">
              </div>
              <input type="hidden" name="equipe" value="<?php if(isset($equipe)) echo $equipe; elseif (isset($_GET['eq'])) echo $_GET['eq']; ?>">
</div>
<div class="row">
              <div class="form-group  col-md-8">
                <label for="" class=" form-control-label">Sexe</label>
                <select name="sexe" id="sexe" value="" class="form-control">
                  <option value="0" selected >Choisir le sexe</option>
                  <option value="1">Homme</option>
                  <option value="2">Femme</option>
                </select>
              </div>

</div>
<div class="row">
              <div class="form-group col-md-4">
                <label for="Prénom" class=" form-control-label">Téléphone</label>
                <input type="number" name="tel" id="tel"value="<?php if(isset($tel)) echo $tel; ?>" placeholder="numero de telephone" class="form-control">
              </div>
              <div class="form-group col-md-7">
                <label for="Email" class=" form-control-label">Email</label>
                <input type="Email" name="email" id="email" value="<?php if(isset($email)) echo $email; ?>" placeholder="Veillez entrer votre Email" class="form-control">
              </div>
</div>

<div class="form-group">
<div class="form-group row">
    <div class="col-sm-8">
    <label for="art" class="form-control-label">Localisation 
        <!-- <span style="color:red;">*</span> -->
    </label>
    <div id="sel_loca">

    <select class="form-control selectpicker" data-live-search="true">
        <option value="null"> ------</option>
        </select>

    </div>
    </div>
    <div class="col-sm-2 mt-4">
    <!-- <a class="btn circle btn-default "  data-toggle="modal" href="#static1"><i class="fa fa-plus "></i> </a> -->
    </div>
</div>
</div>
<div class="row">
    <div style="width:100%;margin:0 auto">
        <div class="form-group" style="margin-bottom:5px;">
            <div class="fileinput fileinput-new" data-provides="fileinput">
                    <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width:130px;height:130px;margin:0;">
                    </div>
                <div>
                    <span class="btn btn-default btn-file" style="width:130px;">
                        <span class="fileinput-new">
                            <span class="glyphicon glyphicon-folder-open"></span>&nbsp;&nbsp;Pochette <span style="color:red;">*</span>
                        </span>
                        <input type="hidden" name="MAX_FILE_SIZE" value="5097152" />
                        <input type="file" name="image_son" id="image_son" accept="image/*" />
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
            <div class="row">
                <div id="alert" class="col-md-8"></div>
                <div id="spinner" class="col-md-3"></div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-12 text-center">
                    <button type="submit" class="btn btn-success" onclick="add_etudiant()">Enregister
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
    <script src="../nan/js/etudiants.js"></script>
    <script src="../assets/js/bootstrap-select.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
        
            $('.selectpicker').selectpicker();    
            liste_loca();
        } );
    </script>


</body>
</html>
