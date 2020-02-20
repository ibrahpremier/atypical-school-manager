<?php
   include 'verif_connexion.php';
?>
<!doctype html>
<html class="no-js" lang="fr-FR"> 
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>NaN Admin</title>
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
    <!-- Left Panel -->

    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">
        <!-- Header-->
            <?php include "header.php"; ?>
        <!-- /header -->
        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Liste des projets de groupe</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="#">Gestion</a></li>
                            <li class="active">Projet de groupe</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content mt-3">
          <div class=" animated fadeIn">
            <div class="row card">
                <div class="card-content col-md-12">
                <br>
                <button class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>&nbsp;Ajouter un projet</button>
                <hr>
                <table id="bootstrap-data-table" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>Projets</th>
                        <th>Matière</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Tiger </td>
                        <td>Nixon</td>
                        <td>
                            <div class="">
                            <a href="" class=" btn btn-link"><i class="fa fa-edit" title="Modifier"></i></a>
                            <a href="" class=" btn btn-link"><i class="fa fa-trash" title="Supprimer"></i></a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Garrett </td>
                        <td>Winters</td>
                        <td><div class="">
                            <a href="" class=" btn btn-link"><i class="fa fa-edit" title="Modifier"></i></a>
                            <a href="" class=" btn btn-link"><i class="fa fa-trash" title="Supprimer"></i></a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Ashton </td>
                        <td>Cox</td>
                        <td><div class="">
                            <a href="" class=" btn btn-link"><i class="fa fa-edit" title="Modifier"></i></a>
                            <a href="" class=" btn btn-link"><i class="fa fa-trash" title="Supprimer"></i></a>
                            </div>
                        </td>
                    </tr>
                </tbody>
                </table>
                <br>
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
