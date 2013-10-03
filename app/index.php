<?php
    require_once("../config/db.php");
    require_once("../classes/Login.php");
    require_once("../libraries/password_compatibility_library.php");
    $login = new Login();
    if(!$login->isUserLoggedIn()){ header('location: ../index.php'); }
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
    <link rel="stylesheet" href="stylesheets/base.css">
    <link rel="stylesheet" href="stylesheets/skeleton.css">
    <link rel="stylesheet" href="stylesheets/layout.css">
    <link rel="stylesheet" href="stylesheets/univer.css">

    <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Favicons
    ================================================== -->
    <link rel="shortcut icon" href="images/favicon.ico">
    <link rel="apple-touch-icon" href="images/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">

    <script type='text/javascript' src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
    <script type='text/javascript' src='http://cdnjs.cloudflare.com/ajax/libs/knockout/2.3.0/knockout-min.js'></script> 

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

            <p style="margin-top: 40px"><img src="app/images/logo.png" width="361" height="79"> </p>
            <h1 class="Subtitle">Reportes</h1><a href="index.php?logout">Logout</a>

            <hr />
        </div>
        <div class="one-third column">
            <h4>Plantel: <?php echo $_SESSION['plantel'];?></h4>
            <input type="hidden" name="plantel" id="plantel" value="<?php echo $_SESSION['plantel'];?>" />
        </div>
        <div class="one-third column">
            <h4>Seleccione la asignatura</h4>
            <select name="courseid" id="courseid" data-bind="event: { change: getGroups }, options: courses, optionsText: 'shortname', optionsValue: 'id'"> </select>
        </div>
        <div class="one-third column">
            <h4>Seleccione el grupo</h4>
            <select name="groupid" id="groupid" data-bind="options: groups, optionsText: 'name', optionsValue: 'id'"> </select>            
            
        </div> 
        
        <div class="sixteen columns">            
            <a href="#" class="full-width button" id="generator" data-bind="click: getRows">Mostrar Actividades</a>
        </div> 

  <div class="sixteen columns clearfix" id="resume" style="display:none;">
    <div class="thirteen columns alpha">
  <table style="width: 100%; margin-bottom: 25px;" id="resume_table">
    <tr>
        <td width="15%"><strong>Plantel:</strong></td>
        <td><span id="plantel_txt"></span></td>
    </tr>
    <tr>
        <td><strong>Asignatura:</strong></td>
        <td><span id="asignatura_txt"></span></td>
    </tr>
    <tr>
        <td><strong>Grupo:</strong></td>
        <td><span id="grupo_txt"></span></td>
    </tr>    
    <tr>
        <td><strong>Asesor:</strong></td>
        <td>
            <ul data-bind="foreach: teachers">
                <li>
                     <span data-bind="text: firstname"></span>
                     <span data-bind="text: lastname"></span>
                    (<span data-bind="text: username"></span>)
                </li>
            </ul>
        </td>
    </tr>    
    <tr>
        <td><strong>Fecha:</strong></td>
        <td><span id="fecha_txt"></span></td>
    </tr>                
  </table>         

    </div>
    <div class="three columns omega"><a href="#" class="button" id="download" data-bind="click: getExcel">Descargar Excel</a></div>
  </div>    

        <div class="sixteen columns">            
            <table class="grid" id="report_table">
                <tr>
                    <td><strong>Matricula</strong></td>
                    <td><strong>Nombre</strong></td>
                    <td><strong>Apellidos</strong></td>
                    <td><strong>Email</strong></td>
                    <td><strong>Rol</strong></td>
                    <td><strong>Grupo</strong></td>
                    <td><strong>Actividad</strong></td>                    
                    <td><strong>Calificación</strong></td>
                    <td><strong>Estatus</strong></td>
                </tr>
                <tbody data-bind="foreach: students">                
                    <tr>
                        <td data-bind="text: Username"></td>
                        <td data-bind="text: Firstname"></td>
                        <td data-bind="text: Lastname"></td>
                        <td data-bind="text: Email"></td>
                        <td data-bind="text: ROLE"></td>
                        <td data-bind="text: grupo"></td>
                        <td data-bind="text: actividad"></td>                        
                        <td data-bind="text: grade"></td>
                        <td data-bind="text: status"></td>
                    </tr>
                <tbody>
            </table>
        </div>                

    </div><!-- container -->


<!-- End Document
================================================== -->
<script type="text/javascript" src="report.ui.min.js"></script>
</body>
</html>