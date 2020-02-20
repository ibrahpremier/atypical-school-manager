<?php
   include 'verif_connexion.php';
?>
<!doctype html>
<html class="no-js" lang=""> 
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>NaN Admin - Groupes</title>
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

    <link rel="stylesheet" type="text/css" href="sty.css">
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
                        <h1>Liste des groupes</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="#">Groupes</a></li>
                            
                        </ol>
                    </div>
                </div>
            </div>
        </div>

            <div class="content mt-3">
              <div class=" animated fadeIn">
                <div class="row">
                    <div class="card-content col-md-12">
                        <br>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#nan_modal_add_group"><i class="fa fa-plus"></i>&nbsp;Ajouter un groupe</button>
                        <hr>
                    </div>
                </div>
              </div>
            </div>



                        <!-- Modals part -->
                         <div class="modal fade" id="nan_modal_add_group" tabindex="-1" role="dialog" aria-labelledby="scrollmodalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-md" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="scrollmodalLabel">Ajouter un groupe</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
    
                                                    <div class="row form-group">
                                                      <div class="col-8">
                                                        <div class="form-group">
                                                            <label for="city" class=" form-control-label">Nom du groupe</label>
                                                            <input type="text" id="city" placeholder="" class="form-control">
                                                        </div>
                                                      </div>
                                                    </div>
    
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                            <button type="button" class="btn btn-primary">Ajouter</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
            <!-- Group part -->
            <div class="col-lg-4 col-md-6">
                <section class="card">
                    <div class="twt-feed blue-bg">
                        <div class="corner-ribon black-ribon">
                    <a href="#"><i class="fa fa-pencil"></i></a>
                    </div>
                    <div class=""></div>
                    <div class="media">
                        <img class="align-self-center rounded-circle mr-3" style="width:85px; height:85px;" alt="" src="images/admin.jpg">
                        <div class="media-body nom_groupe">
                            <h2><a href="profil_groupe.html">Geek 3.0</a></h2>
                            <hr>
                            <h4 class="text-white display-4">Ange</h4>
                            <small class="text-light">(Porte parole)</small>
                        </div>
                    </div>
                    </div>
                    <div class="weather-category">
                        <ul>
                            <li class="active">
                                <h5>5</h5>
                                Hommes
                            </li>
                            <li>
                                <h5>2</h5>
                                Femmes
                            </li>
                            <li>
                                <h5>7</h5>
                                Total
                            </li>
                        </ul>
                    </div>
                    <div class="twt-write col-sm-12">
                        <button type="submit" class="btn btn-outline-secondary btn-sm btn-block">Envoyer un mail</button>
                        
                    </div>
                    <footer class="twt-footer">
                        <a href="" class=" btn btn-default btn-lg " id="btn-like"><i class="fa fa-thumbs-up" title="Like"></i></a>

                        <a href="" class=" btn btn-default btn-lg" id="btn-dislike"><i class="fa fa-thumbs-down" title="Dislike"></i></a>
                        
                        <a href="" class=" btn btn-default btn-lg" id="btn-bonus"><i class="fa fa-plus" title="Bonus +1"></i></a>
                        
                        <a href="" class=" btn btn-default btn-lg" id="btn-malus"><i class="fa fa-minus" title="Malus -1"></i></a>
                        
                        <a href="" class=" btn btn-default btn-lg" id="btn-comment"><i class="fa fa-comments" title="Commentaire"></i></a>
                        
                        <span class="pull-right">
                            <p>Bonus: <span>300</span></p>
                        </span>
                    </footer>
                </section>
            </div>
            
            <div class="col-lg-4 col-md-6">
                <section class="card">
                    <div class="twt-feed blue-bg">
                        <div class="corner-ribon black-ribon">
                    <a href="#"><i class="fa fa-pencil"></i></a>
                    </div>
                    <div class=""></div>
                    <div class="media">
                        <img class="align-self-center rounded-circle mr-3" style="width:85px; height:85px;" alt="" src="images/admin.jpg">
                        <div class="media-body nom_groupe">
                                <h2><a href="profil_groupe.html" >Avion NAN</a></h2>
                            <hr>
                            <h4 class="text-white display-4">KONE HAMED </h4>
                            <small class="text-light">(Porte parole)</small>
                        </div>
                    </div>
                    </div>
                    <div class="weather-category">
                        <ul>
                            <li class="active">
                                <h5>5</h5>
                                Hommes
                            </li>
                            <li>
                                <h5>2</h5>
                                Femmes
                            </li>
                            <li>
                                <h5>7</h5>
                                Total
                            </li>
                        </ul>
                    </div>
                    <div class="twt-write col-sm-12">
                        <button type="submit" class="btn btn-outline-secondary btn-sm btn-block">Envoyer un mail</button>
                        
                    </div>
                    <footer class="twt-footer">
                        <a href="" class=" btn btn-default btn-lg " id="btn-like"><i class="fa fa-thumbs-up" title="Like"></i></a>

                        <a href="" class=" btn btn-default btn-lg" id="btn-dislike"><i class="fa fa-thumbs-down" title="Dislike"></i></a>
                        
                        <a href="" class=" btn btn-default btn-lg" id="btn-bonus"><i class="fa fa-plus" title="Bonus +1"></i></a>
                        
                        <a href="" class=" btn btn-default btn-lg" id="btn-malus"><i class="fa fa-minus" title="Malus -1"></i></a>
                        
                        <a href="" class=" btn btn-default btn-lg" id="btn-comment"><i class="fa fa-comments" title="Commentaire"></i></a>
                        
                        <span class="pull-right">
                            <p>Bonus: <span>300</span></p>
                        </span>
                    </footer>
                </section>
            </div>
            <!-- Group part -->
                  
                </div><!-- .row -->
            </div><!-- .animated -->
        </div><!-- .content -->

    <!-- script -->
    <?php include "link_script.php"; ?>
    <!-- /#script -->


    <script src="assets/js/widgets.js"></script>
    <script src="assets/js/lib/chart-js/Chart.bundle.js"></script>


    <script type="text/javascript">
        $(document).ready(function() {
          $('#bootstrap-data-table-export').DataTable();
        } );
    </script>


</body>
</html>
