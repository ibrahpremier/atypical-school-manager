
        <header id="header" class="header">
            <div class="header-menu">
                <div class="col-sm-8">
                    <a id="menuToggle" class="menutoggle pull-left"><i class="fa fa fa-tasks"></i></a>
                    <div class="header-left text-right">
                        <h3>Programmer! Nannn c'est pas sorcier!</h3>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="user-area dropdown float-right">
                        <a href="../#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <!--<img class="user-avatar rounded-circle" src="../images/admin.jpg" alt="User Avatar">-->
                            <?php echo $prenom ?>
                            <i class="menu-icon fa fa-caret-right"></i>
                        </a>
                        <div class="user-menu dropdown-menu">
                          <!--<a class="nav-link" href="#"><i class="fa fa- user"></i>Mon profil</a>-->
                          <a class="nav-link" href="login.php?disconnect"><i class="fa fa-power"></i>Déconnexion</a>
                        </div>
                    </div>
                </div>
            </div>
        </header>