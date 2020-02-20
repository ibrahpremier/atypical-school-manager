<?php
   include 'verif_connexion.php';
?>
<!doctype html>
<html class="no-js" lang="fr-FR"> 
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
    <!-- <link rel="stylesheet" href="../assets/css/bootstrap-select.less"> -->
    <link rel="stylesheet" href="../assets/scss/style.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

    <!-- <script type="text/javascript" src="../https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->

</head>
<body>
        <!-- Left Panel -->
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
                        <h1>Profil</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="../#">Groupes</a></li>
                            <li class="active">Profil</li>  
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content mt-3">
          <div class="animated fadeIn">
            <div class="row">
                <div class="col-md-4">
                    <section class="card">
                        <div class="twt-feed blue-bg">
                            <div class="corner-ribon black-ribon">
                                <a href="#"><i class="fa fa-pencil"></i></a>
                            </div>
                            <div class=""></div>
                            <div class="media">
                                <div class="">
                                    <img class="align-self-center rounded-circle mr-3" style="width:100px; height:100px;" alt="" src="../images/admin.jpg">
                                </div>
                                <div class="media-body">
                                    <h3 class="text-white display-6">Geek 3.0</h3>
                                    <p class="text-light">Ange (Porte-parole)</p>
                                </div>
                            </div>
                        </div>
                        <div class="weather-category">
                            <ul>
                                <li class="active">
                                    <h5>350</h5>
                                    Points
                                </li>
                                <li>
                                    <h5>15,5</h5>
                                    Moyenne
                                </li>
                                <li>
                                    <h5>+5</h5>
                                    Bonus
                                </li>
                            </ul>
                            <hr>
                            <div class="card-text text-sm-center row">
                                <div class="col-md-4">
                                    <a href="#" title="Like"><i class="fa fa-thumbs-up fa-1x"></i></a>
                                    &nbsp;
                                    <a href="#" title="Dislike"><i class="fa fa-thumbs-down fa-1x"></i></a>
                                </div>
                                <div class="col-md-4">
                                    <a href="#" title=""><i class="fa fa-plus-circle fa-1x"></i>&nbsp;1</a>
                                    &nbsp;
                                    <a href="#" title=""><i class="fa fa-minus-circle fa-1x"></i>&nbsp;1</a>
                                </div>
                                <div class="col-md-4 tex">
                                    <i class="text-success fa fa-circle"></i>&nbsp;Présents(3)
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <h4>Membres</h4>
                            <hr>
                            <table class="table">
                                <thead class="thead-dark">
                                    <tr>
                                    <th scope="col">N°</th>
                                    <th scope="col">Nom</th>
                                    <th scope="col">Prénoms</th>
                                    <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                    <th scope="row">1</th>
                                    <td>Mark</td>
                                    <td>Otto</td>
                                    <td>@mdo</td>
                                    </tr>
                                    <tr>
                                    <th scope="row">2</th>
                                    <td>Jacob</td>
                                    <td>Thornton</td>
                                    <td>@fat</td>
                                    </tr>
                                    <tr>
                                    <th scope="row">3</th>
                                    <td>Larry</td>
                                    <td>the Bird</td>
                                    <td>@twitter</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h5>Projets réalisés</h5>
                            <hr>
                            <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                    <th>N°</th>
                                    <th>Compositions</th>
                                    <th>Notes</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                    <td>1</td>
                                    <td>PROJET NaN #1 - Linux</td>
                                    <td>100</td>
                                    </tr>
                                    <tr>
                                    <td>2</td>
                                    <td>PROJET NaN #2 - Réseaux</td>
                                    <td>0</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
          </div><!-- .animated -->
        </div><!-- .content -->
    </div><!-- /#right-panel -->
    <!-- Right Panel -->

    <!-- script -->
    <?php include "link_script.php"; ?>
    <!-- /#script -->

    <script type="text/javascript">
        $(document).ready(function() {
          $('#bootstrap-data-table-export').DataTable();
        } );
    </script>


</body>
</html>
