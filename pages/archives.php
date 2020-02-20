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
                        <h1>Liste des étudiants archivés</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="../#">Gestion</a></li>
                            <li class="active">Etudiants archivés</li>
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
            <th>Date Archivage</th>
            <th>Commentaire</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
<?php 
  $req="select * from etudiant, appartenir_equipe where etudiant.id_etudiant=appartenir_equipe.id_etudiant and etudiant.equipe_actu=appartenir_equipe.id_equipe and equipe_actu=10 order by nom asc";
$result = $bdd->query($req) or die(print_r($bdd->errorInfo()));
$i=1;
while($donnees = $result->fetch(PDO::FETCH_ASSOC)){ ?>     
        <tr>
         <!-- <td>
            <div class="form-check-inline form-check center">
              <label for="inline-checkbox1" class="form-check-label ">
                <input type="checkbox" id="inline-checkbox1" name="inline-checkbox1" value="option1" class="form-check-input">
              </label>                                
            </div>
          </td>-->
          <td><?php echo $i++; ?></td>
          <td><a href="profil_etudiant.php?et=<?php echo $donnees['id_etudiant'] ?>" class=" btn btn-link" title="Voir le profil"><?php echo $donnees['nom'] ?></a></td>
          <td><?php echo $donnees['prenom'] ?></td>
          <td>
            <div class="">
            <?php echo date('d/m/Y',strtotime($donnees['date_ajout_equipe']));?>
            </div>
          </td>
          <td>
            <div class="">
            <?php echo $donnees['commentaire'];?>
            </div>
          </td>
          <td>
            <div class="">
              <a href="profil_etudiant.php?et=<?php echo $donnees['id_etudiant'] ?>" class=" btn btn-link" title="Voir le profil"><i class="fa fa-user" ></i></a>
              <a href="" class=" btn btn-link" data-toggle="modal" data-target="#modal_archiver_etudiant" onclick="modal_restaurer_et(<?php echo $donnees['id_etudiant'] ?>)" title="Restaurer"><i class="fa fa-recycle"></i></a>
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

            
<!-- Modals3 restaurer -->
<div class="modal fade" id="modal_archiver_etudiant" tabindex="-1" role="dialog" aria-labelledby="scrollmodalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="scrollmodalLabel">Restauration</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" >
                <!-- contenu  -->
                <form name="frm_res_et" action="">
                <div class="row">
                    <div class="col-sm-12 text-center">
                        <h5>Restaurer</h5> <h4 id="titre_modal_arch"></h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 text-center">
                        <form name="frm_res_et" action="">
                            <br>
                            <div class="row">
                                    <select class="form-control col-md-10 ml-3" name="equipe" id="equipe">
                                        <option value="null" selected disabled>Equipe de restauration</option>
<?php 
    $req="select * from equipe where id_equipe!=10";
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
                        <button type="submit" id="btn_restaurer_et" class="btn btn-danger btn-sm col-sm-3" data-dismiss="modal">Restaurer</button>
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
