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
                    <div class="page-title">
                        <h1>Liste des localisations</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="#">Gestion</a></li>
                            <li class="active">Localisations</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content mt-3">
          <div class=" animated fadeIn">

          <div class="row">
              <div class="card-content col-md-6">
                <button class="btn btn-primary" data-toggle="modal" data-target="#modal_add_localisation"><i class="fa fa-plus"></i>&nbsp;Nouvelle localisation</button>
                <hr>
            </div>
              <div class="col-md-6">
                  <div id="alert_localisation"></div>
                  <div id="spinner_localisation"></div>
              </div>
          </div>
            <div class="row card">
                <div class="card-content col-md-12">
                <table id="table_lo" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>Localisations</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                </table>
                <br>
                </div>
            </div>
            </div>
          </div><!-- .animated -->
        </div><!-- .content -->
    </div><!-- /#right-panel -->
    <!-- Right Panel -->



<!-- Modals1 ajouter -->
<div class="modal fade" id="modal_add_localisation" tabindex="-1" role="dialog" aria-labelledby="scrollmodalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <form name="frm_lo">
            <div class="modal-header">
                <h5 class="modal-title" id="scrollmodalLabel">Ajouter une localisation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row form-group">
                    <div class="col-8">
                    <div class="form-group">
                        <label for="txt_localite" class=" form-control-label">Nom de la zone</label>
                        <input type="text" id="txt_localite" name="txt_localite" placeholder="" class="form-control" required>
                    </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary"data-dismiss="modal" onclick="add_localisation()">Ajouter</button>
            </div>
        </form>
        </div>
    </div>
</div>
<!-- Modals part -->


<!-- Modals2 modifier -->
<div class="modal fade" id="modal_mod_localisation" tabindex="-1" role="dialog" aria-labelledby="scrollmodalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="scrollmodalLabel">Modifier une équipe</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form name="frm_lo_m">
            <div class="modal-body">

                        <div class="row form-group">
                            <div class="col-8">
                            <div class="form-group">
                                <label for="city" class=" form-control-label">Nom de localisation</label>
                                <input type="text" id="txt_mod_localisation" name="txt_mod_localisation" placeholder="" class="form-control">
                            </div>
                            </div>
                        </div>

            </div>
            <div class="modal-footer">
                <button id="btn_maj_localisation" type="submit" class="btn btn-primary" data-dismiss="modal" >Modifier</button>
            </div>
        </form>

        </div>
    </div>
</div>
<!-- Modals part -->

            
<!-- Modals3 supprimer -->
<div class="modal fade" id="modal_supp_localisation" tabindex="-1" role="dialog" aria-labelledby="scrollmodalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="scrollmodalLabel">Suppression localisation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body"  id="content_modal_supp_localisation">
                <!-- contenu  -->
                <div class="row">
                    <div class="col-sm-12 text-center">
                        <h5 id="titre_modal_supp" ></h5>
                    </div>
                </div>
                <br><br>
                <div class="row">
                    <div class="col-sm-12 text-center">
                        <button type="button" class="btn btn-info btn-lg col-sm-3" data-dismiss="modal">Non</button>
                        <button type="submit" id="btn_supp_localisation" class="btn btn-danger btn-lg col-sm-3" data-dismiss="modal">Oui</button>
                    </div>
                </div>
            <!-- /#contenu  -->
            
            </div>

        </div>
    </div>
</div>
<!-- Modals part -->



    <!-- script -->
    <?php include "link_script.php"; ?>
    <!-- /#script -->
    
    <!-- perso -->
    <script src="../nan/js/all.js"></script>
    <script src="../nan/js/params.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            
        } );
    </script>


</body>
</html>
