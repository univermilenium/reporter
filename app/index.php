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

    <script type='text/javascript' src="js/jquery.min.js"></script>
    <script type='text/javascript' src='js/knockout-min.js'></script> 

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
    <div class="container" style="margin-top: 55px;">
   <?php if($_SESSION['addusers']==1): ?>
  <button onclick="window.location='../register.php'" style="position:absolute; right:5px; top:-35px;">Administrar usuarios</button>
  <?php endif; ?>
 
            <div class="one-third column">
              <h3>Seguimiento</h3>
              
            </div>
            <div class="one-third column">
                &nbsp;
            </div>
            <div class="one-third column" style="text-align: right;">
                <span class="user_name">
                    <?php echo ($_SESSION['nombre']);?> <?php echo ($_SESSION['apellidos']);?> 
                </span> <br>

                <span class="user_tipo">
                    <?php echo ($_SESSION['tipo']);?> 
                </span> <br>
 
            </div>

 <hr />

        <div class="one-third column">
            <h4>Plantel: <?php echo $_SESSION['plantel'];?></h4>

            <?php if($_SESSION['plantel']!=''):?>
                <input type="hidden" name="plantel" id="plantel" value="<?php echo $_SESSION['plantel'];?>" />
            <?php else:?>
                <select name="plantel" id="plantel" onChange="window.location='?cplantel='+this.value">
                	<option>--Seleccione--</option>
                    <option value="RAYON">Ray&oacute;n</option>
                    <option value="NEZA">Nezahualc&oacute;tl</option>
                    <option value="IXTAPA">Ixtapaluca</option>
                    <option value="HIDALGO">Hidalgo</option>
                    <option value="SALUD">Salud</option>
                </select>                
                <?php if($_GET['cplantel']!=''){ ?><script> $('#plantel').val('<?=$_GET['cplantel']?>'); </script> <?php } ?>
            <?php endif; ?>
        </div>
        <div class="one-third column">
            <h4>Seleccione la asignatura</h4>
            <select name="courseid" id="courseid" data-bind="event: { change: getGroups }, options: courses, optionsText: 'shortname', optionsValue: 'id'"> </select>
        </div>
        <div class="one-third column" id="group">
            <h4>Seleccione el grupo</h4>
            <select name="groupid" id="groupid" data-bind="event: { change: updateResume }, options: groups, optionsText: 'name', optionsValue: 'id'"> </select>            
        </div> 
    

  <div class="sixteen columns clearfix" id="resume" style="display:none;">

  <table style="width: 100%; margin-bottom: 25px; border: solid 1px #ECE5E5;" id="resume_table">
    <tr style="border-bottom: solid 1px #CCC;">
        <td style="width:150px;text-align:left; padding-top:10px;padding-left: 5px;"><strong>Asignatura:</strong></td>
        <td><span id="asignatura_txt"></span></td>
    </tr>
    <tr style="border-bottom: solid 1px #CCC;">
        <td style="width:150px;text-align:left; padding-top:10px;padding-left: 5px;"><strong>Grupo:</strong></td>
        <td><span id="grupo_txt"></span></td>
    </tr>    
    <tr style="border-bottom: solid 1px #CCC;">
        <td style="width:150px;text-align:left; padding-top:10px;padding-left: 5px;"><strong>Asesor:</strong></td>
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
    <tr style="border-bottom: solid 1px #CCC;">
        <td style="width:150px;text-align:left;padding-top:10px;padding-left: 5px;"><strong>Fecha:</strong></td>
        <td><span id="fecha_txt"></span></td>
    </tr>                
  </table>         


    <div class="three columns"><a href="#" style="margin-left:-10px;" class="button" id="download" data-bind="click: getExcel">Descargar Excel</a></div>
  </div>    
         

    </div><!-- container -->


<!-- End Document
================================================== -->
<script type="text/javascript" src="js/report.ui.min.js"></script>
</body>
</html>