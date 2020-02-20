<?php
   include 'verif_connexion.php';
?>
<!doctype html>
<html class="no-js" lang="fr"> 
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>NaN Admin - Equipes</title>
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

    <!--link rel="stylesheet" type="text/css" href="sty.css"-->
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
                        <h1>Liste des équipes</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="#">Gestion</a></li>
                            <li class="active">Equipes</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
            <div class="content mt-3">
              <div class=" animated fadeIn">
                <div class="row">
                    <div class="card-content col-md-6">
                    <br>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#nan_modal_add_equipe"><i class="fa fa-plus"></i>&nbsp;Creer une nouvelle équipe</button>
                    <hr>
                    </div>
                    <div class="col-md-6">
                    <div id="alert_equipe"></div>
                    <div id="spinner_equipe"></div>
                    </div>
                </div>
              </div>
            </div>

<!-- Modals1 part -->
<div class="modal fade" id="nan_modal_add_equipe" tabindex="-1" role="dialog" aria-labelledby="scrollmodalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="scrollmodalLabel">Ajouter une équipe</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form name="frm_eq">
            <div class="modal-body">

                        <div class="row form-group">
                            <div class="col-8">
                            <div class="form-group">
                                <label for="city" class=" form-control-label">Nom de l'equipe</label>
                                <input type="text" id="txt_equipe"  name="txt_equipe"  placeholder="" class="form-control">
                            </div>
                            </div>
                        </div>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" data-dismiss="modal" onclick="add_equipe()" >Ajouter</button>
            </div>
        </form>
        </div>
    </div>
</div>
<!-- Modals part -->

<!-- Modals2 part -->
<div class="modal fade" id="modal_modifier_equipe" tabindex="-1" role="dialog" aria-labelledby="scrollmodalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="scrollmodalLabel">Modifier une équipe</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form name="frm_eq_m">
            <div class="modal-body">

                        <div class="row form-group">
                            <div class="col-8">
                            <div class="form-group">
                                <label for="city" class=" form-control-label">Nom de l'equipe</label>
                                <input type="text" id="txt_mod_equipe" name="txt_mod_equipe" placeholder="" class="form-control">
                            </div>
                            </div>
                        </div>

            </div>
            <div class="modal-footer">
                <!-- <div id="alert_frm_equipe_m"></div>
                <div id="spinner_frm_equipe_m"></div> -->
                <button id="btn_maj_eq" type="button" class="btn btn-primary" data-dismiss="modal" >Modifier</button>
            </div>
        </form>

        </div>
    </div>
</div>
<!-- Modals part -->

<!-- Modals3 part -->
<div class="modal fade" id="modal_supprimer_equipe" tabindex="-1" role="dialog" aria-labelledby="scrollmodalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="scrollmodalLabel">Suppression Equipe</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body"  id="content_modal_supp_equipe">
                <!-- contenu  -->
                <div class="row">
                    <div class="col-sm-12 text-center">
                        <h4 id="titre_modal_supp" ></h4>
                    </div>
                </div>
                <br><br>
                <div class="row">
                    <div class="col-sm-12 text-center">
                        <button type="button" class="btn btn-info btn-lg col-sm-3" data-dismiss="modal">Non</button>
                        <button type="button" id="btn_supp_eq" class="btn btn-danger btn-lg col-sm-3" data-dismiss="modal">Oui</button>
                    </div>
                </div>
            <!-- /#contenu  -->
            
            </div>

        </div>
    </div>
</div>
<!-- Modals part -->


            <div class="content mt-3">
            <div class="animated fadeIn">

                <div class="row" id="contentEquipe">
                    
                    <!-- liste des equipes generé ici via ajax -->
                    
                </div><!-- .row -->


            </div><!-- .animated -->
        </div><!-- .content -->

    <!-- script -->
    <?php include "link_script.php"; ?>
    <!-- /#script -->


    <script src="../assets/js/widgets.js"></script>
    <script src="../assets/js/lib/chart-js/Chart.bundle.js"></script>
    
    <!-- Personnel -->
    <script src="../nan/js/all.js"></script>
    <script src="../nan/js/equipe.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#bootstrap-data-table-export').DataTable();
                infoEquipe();
            } );
        </script>


</body>
</html>
