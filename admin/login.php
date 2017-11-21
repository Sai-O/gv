<?php 
session_start();


if( isset($_SESSION['admin']) && $_SESSION['admin']=='true'){
    header('location:index.php');
    exit();
}


if (isset($_POST['identifiant'] ) AND isset($_POST['mdp'])){ 
    
    if ($_POST['identifiant']=='admin' AND $_POST['mdp']=='admin') {
        $_SESSION['admin'] ='true';
        header('location:index.php');
        exit();
    }
    else $messagerreur="<p style='color:red;font-weight:bold;'>Identifiant ou mot de passe incorrect</p>";


}




 ?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin UAFF</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
   

</head>

<body>

   
        
    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header logo">
           
            <a class="navbar-brand" href="#">UAFF Admin</a>
        </div>
       
    </nav>


    <div class="container">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
                <div class="logregform">
    
                    <header>
                    
                        <h3>Admin UAFF</h3>
                        
                        <?php 
                        if(isset($messagerreur)) {
                            echo'<h3>'.$messagerreur.'</h3>';
                            unset($messagerreur);
                        }
                        ?>
                         

                    </header>
                    
                   
                    
                        <form role="form" method="POST">
                        
                            

                            <div class="form-group">
                                <label><i class="fa fa-user"></i> Identifiant</label>
                                <input class="form-control" type="text" name="identifiant">
                            </div>


                            <div class="form-group">
                                <label><i class="fa fa-lock"></i> Password</label>
                                <input class="form-control" type="password" name="mdp">
                            </div>
                            <button  type="submit" name="envoyer" value="val">Se connecter</button>

                                
                        </form>
                    
                    
                    

                </div>
            </div>
        </div>
        <!-- /.row -->

      
        
       

    </div>
    <!-- /.container-fluid -->



    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="js/plugins/morris/raphael.min.js"></script>
    <script src="js/plugins/morris/morris.min.js"></script>
    <script src="js/plugins/morris/morris-data.js"></script>

</body>

</html>
