<!doctype html>
<html class="no-js" lang="fr-FR">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sufee Admin - HTML5 Admin Template</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">

    <link rel="stylesheet" href="../assets/css/normalize.css">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/css/themify-icons.css">
    <link rel="stylesheet" href="../assets/css/flag-icon.min.css">
    <link rel="stylesheet" href="../assets/css/cs-skin-elastic.css">
    <!-- <link rel="stylesheet" href="../assets/css/bootstrap-select.less"> -->
    <link rel="stylesheet" href="../assets/scss/style.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

</head>
<body class="bg-dark">

<?php 

//demarrer session
//

// remove all session variables
//session_unset(); 

// destroy the session 
//session_destroy();


	require '../nan/database/connexion_bd.php';
    session_start();

	$msg = "";
	$email = "";
	$mdp = "";


	if(isset($_GET["disconnect"])){
        if(isset($_SESSION['id_user'])){
            unset($_SESSION['id_user']);
            session_destroy();
        }

        // destroy the session 
        
        $msg2= "Vous êtes déconnecté";
    }





	if(isset($_POST["email"])){
		$email = verifyInput($_POST["email"]);
		$mdp = verifyInput($_POST["passw"]);

		$req = $bdd -> query("SELECT * FROM user WHERE email_user='$email' AND passw='$mdp' ");
            
            $cpt=0;
            while($donnees = $req->fetch(PDO::FETCH_ASSOC)){
                $cpt++;
                $id_user=$donnees["id_user"];
            }

			
			if($cpt==1){
                header("location:index.php");
                $_SESSION['id_user']=$id_user;
            }
            else{
				$msg = "Email ou mot de passe incorrect";
			}

	}


function verifyInput($var){

		$var = trim($var);
		$var = stripslashes($var);
		$var = htmlspecialchars($var);
		return $var;
}
?>
    <div class="sufee-login d-flex align-content-center flex-wrap">
        <div class="container">
            <div class="login-content">
                <div class="login-logo">
                    <a href="index.html">
                        <img class="align-content" src="images/logo.png" alt="">
                    </a>
                </div>
                <div class="login-form">
                    <?php if (isset($_GET["disconnect"])) echo '<h4 class="alert alert-success">'.$msg2.'</h4>'; ?>
                    <form method="post" action="">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <label>Mot de passe</label>
                            <input type="password" name="passw" class="form-control" placeholder="mot de passe">
                        </div>
                        <small class="bg-danger text-light">
                            <?php echo $msg ?>
                        </small>
                        <br><br>
                        <button type="submit" class="btn btn-primary btn-flat m-b-30 m-t-30">Connexion</button>
                        <div class="register-link m-t-15 text-center">
                            <p>Vous n'avez pas de compte ? <a href="#"> S'inscrire</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script src="../assets/js/vendor/jquery-2.1.4.min.js"></script>
    <script src="../assets/js/popper.min.js"></script>
    <script src="../assets/js/plugins.js"></script>
    <script src="../assets/js/main.js"></script>


</body>
</html>
