<?php

     if(isset($_GET['usuario']))
     {
        $_POST['user_name'] = $_GET['usuario'];
     }
     if(isset($_GET['token']))
     {
        $_POST['user_password'] = $_GET['token'];
     }
     
    require_once("config/db.php");
    require_once("classes/Login.php");
    require_once("libraries/password_compatibility_library.php");

    $login = new Login();
    if (!empty($_POST['user_name']) && !empty($_POST['user_password'])) 
    {
        if(count($_GET)>0) 
        {
          $login->loginWithPostData();  
        }
    }
    
    //print_r($_SERVER);
?>

<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->
<head>

    <!-- Basic Page Needs
  ================================================== -->
    <meta charset="utf-8">
    <title>Univer Milenium E-Learning Reportes</title>
    <meta name="description" content="">
    <meta name="author" content="MDA-Solutions | Moisés Rangel">

    <!-- Mobile Specific Metas
  ================================================== -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- CSS
  ================================================== -->
    <link rel="stylesheet" href="app/stylesheets/base.css">
    <link rel="stylesheet" href="app/stylesheets/skeleton.css">
    <link rel="stylesheet" href="app/stylesheets/layout.css">
    <link rel="stylesheet" href="app/stylesheets/univer.css">

    <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Favicons
    ================================================== -->
    <link rel="shortcut icon" href="app/images/favicon.ico">
    <link rel="apple-touch-icon" href="app/images/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="app/images/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="app/images/apple-touch-icon-114x114.png">

    <style type="text/css">
        .grid
        {
            width: 100%;
        }
        .grid TD
        {
            padding:5px;
        }

        .grid TR
        {
            border-bottom: 1px solid #CCC;
        }
    </style>

</head>
<body>

    <!-- Primary Page Layout
    ================================================== -->
    <div class="container">
        <div class="sixteen columns">
            <p style="margin-top: 40px; float:left;"><img src="app/images/logo.png" width="361" height="79"> <span class="Subtitle">&nbsp;&nbsp;&nbsp;&nbsp;Reportes</span> </p>
            
            <hr />
        </div>
        
        <div class="sixteen columns"> 

        <?php if(!$login->isUserLoggedIn()):?>       

            <div id="login_errors">
                <!-- errors -->
                <?php if($login->errors):?>
                    <ul id="errors">
                        <?php foreach($login->errors as $error):?>
                            <li><?php echo $error; ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif;?>

                <!-- errors -->
                <?php if($login->messages):?>
                    <ul id=""messages>
                        <?php foreach($login->messages as $message):?>
                            <li><?php echo $message; ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif;?>                

            </div>

            <form method="post" action="index.php" name="loginform">

                <label for="login_input_username">Usuario</label>
                <input id="login_input_username" class="login_input" type="text" name="user_name" required />

                <label for="login_input_password">Contraseña</label>
                <input id="login_input_password" class="login_input" type="password" name="user_password" autocomplete="off" required />

                <input type="submit"  name="login" value="Entrar" />

            </form>

        <?php else:?>
            
            <?php header('location: app/index.php'); ?>

        <?php endif;?>
            
        </div> 
    </div><!-- container -->

<!-- End Document
================================================== -->

</body>
</html>