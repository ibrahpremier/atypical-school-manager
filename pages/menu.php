
<?php
    require_once '../nan/database/connexion_bd.php';


?>
    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">

            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="./"><img src="../images/logo.png" alt="Logo"></a>
                <a class="navbar-brand hidden" href="./"><img src="../images/logo2.png" alt="Logo"></a>
            </div>

            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active">
                        <a href="index.php"> <i class="menu-icon fa fa-dashboard"></i>Tableau de bord </a>
                    </li>
                    <h3 class="menu-title">Gestion</h3><!-- /.menu-title -->

                    <li class="">
                        <a href="equipe.php"> <i class="menu-icon fa fa-users"></i>Equipes</a>
                    </li>
                    <li class="">
                        <a href="groupe.php"> <i class="menu-icon fa fa-users"></i>Groupes</a>
                    </li>
                    <li class="menu-item-has-children dropdown">
                    <a href="equipe.php" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="menu-icon fa fa-sitemap"></i>Gestion des étudiants</a>
                        <ul class="sub-menu children dropdown-menu">

<?php 
$req="select * from equipe where id_equipe!=10";
$result = $bdd->query($req) or die(print_r($bdd->errorInfo()));
while($donnees = $result->fetch(PDO::FETCH_ASSOC)){ ?>
                            <li><i class="menu-icon fa fa-caret-right"></i><a href="liste_etudiants.php?eq=<?php echo $donnees['id_equipe'] ?>"><?php echo $donnees['nom_equipe'] ?></a></li>
<?php } ?>
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown">
                    <a href="equipe.php" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="menu-icon fa fa-sitemap"></i>Gestion des Absences</a>
                        <ul class="sub-menu children dropdown-menu">
<?php 
$req="select * from equipe where id_equipe!=10";
$result = $bdd->query($req) or die(print_r($bdd->errorInfo()));
while($donnees = $result->fetch(PDO::FETCH_ASSOC)){ ?>
                            <li><i class="menu-icon fa fa-caret-right"></i><a href="display_presence.php?eq=<?php echo $donnees['id_equipe'] ?>"><?php echo $donnees['nom_equipe'] ?></a></li>
<?php } ?>
                        </ul>
                    </li>

                    <li class="menu-item-has-children dropdown">
                    <a href="equipe.php" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="menu-icon fa fa-sitemap"></i>Gestion des notes</a>
                        <ul class="sub-menu children dropdown-menu">
<?php 
$req="select * from equipe where id_equipe!=10";
$result = $bdd->query($req) or die(print_r($bdd->errorInfo()));
while($donnees = $result->fetch(PDO::FETCH_ASSOC)){ ?>
                            <li><i class="menu-icon fa fa-caret-right"></i><a href="display_notes.php?eq=<?php echo $donnees['id_equipe'] ?>&compo=1"><?php echo $donnees['nom_equipe'] ?></a></li>
<?php } ?>
                        </ul>
                    </li>
                    <li class="">
                        <a href="archives.php"> <i class="menu-icon fa fa-archive"></i>Archive</a>
                    </li>

                    <h3 class="menu-title">Paramètres</h3><!-- /.menu-title -->

                    <li class="menu-item-has-children dropdown">
                        <a href="" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-tasks"></i>Composition</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-caret-right"></i><a href="form_compo.php">Nouvel Evaluation</a></li>

                            
<?php 
$req="select * from type_composition";
$result = $bdd->query($req) or die(print_r($bdd->errorInfo()));
while($donnees = $result->fetch(PDO::FETCH_ASSOC)){ ?>
                            <li><i class="menu-icon fa fa-caret-right"></i><a href="liste_compo.php?tc=<?php echo $donnees['id_type_composition'] ?>"><?php echo $donnees['libelle_type_composition'] ?></a></li>
<?php } ?>
                        </ul>
                    </li>
                    <li>
                        <a href="liste_matieres.php"> <i class="menu-icon fa fa-book"></i>Matières</a>
                    </li>
                    <li>
                        <a href="liste_localisations.php"> <i class="menu-icon fa fa-location-arrow"></i>Localisation</a>
                    </li>
                    <li>
                        <a href="#"> <i class="menu-icon fa fa-user"></i>Utilisateurs</a>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside><!-- /#left-panel -->
