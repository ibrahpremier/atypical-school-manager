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
                        <h1>TABLEAU DE BORD</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="#">Dashbord</a></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>


            <div class="content mt-3">
            <div class="animated fadeIn">
<div class="row">


            <div class="col-sm-4 col-md-3">
                <div class="card text-white bg-flat-color-1">
                    <div class="card-body pb-0">
                        <h4 class="mb-0">
                            <span class="count">48</span>
                        </h4>
                        <p class="text-light">Quiz</p>
                        <div class="chart-wrapper px-0" style="height:70px;" height="70">
                            <canvas id="widgetChart1"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <!--/.col-->

            <div class="col-sm-4 col-md-3">
                <div class="card text-white bg-flat-color-1">
                    <div class="card-body pb-0">
                        <h4 class="mb-0">
                            <span class="count">48</span>
                        </h4>
                        <p class="text-light">Projets de groupe</p>
                        <div class="chart-wrapper px-0" style="height:70px;" height="70">
                            <canvas id="widgetChart2"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <!--/.col-->

            <div class="col-sm-4 col-md-3">
                <div class="card text-white bg-flat-color-1">
                    <div class="card-body pb-0">
                        <h4 class="mb-0">
                            <span class="count">48</span>
                        </h4>
                        <p class="text-light">Projet Personnel</p>
                        <div class="chart-wrapper px-0" style="height:70px;" height="70">
                            <canvas id="widgetChart3"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <!--/.col-->

            <div class="col-sm-4 col-md-3">
                <div class="card text-white bg-flat-color-1">
                    <div class="card-body pb-0">
                        <h4 class="mb-0">
                            <span class="count">48</span>
                        </h4>
                        <p class="text-light">Projet defis</p>
                        <div class="chart-wrapper px-0" style="height:70px;" height="70">
                            <canvas id="widgetChart4"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <!--/.col-->
</div>
<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h4 class="mb-3">Classement generale</h4>
                <canvas id="bestStudent"></canvas>
            </div>
        </div>
    </div><!-- /# column -->



    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h4 class="mb-3">Taux de presence</h4>
                <canvas id="bestTeam"></canvas>
            </div>
        </div>
    </div><!-- /# column -->
</div>

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
                chart_main_page();
            } );
        </script>


</body>
</html>
