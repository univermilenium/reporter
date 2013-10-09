<!-- register form -->
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

    <script type='text/javascript' src="app/js/jquery.min.js"></script>
    <script type='text/javascript' src='app/js/knockout-min.js'></script> 

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
    <div class="container" style="margin-top: 55px;">
  <?php if($_SESSION['addusers']==1): ?>
  <button onclick="window.location='index.php'" style="position:absolute; right:5px; top:-35px;">Regresar a reportes</button>
  <?php endif; ?>
            <div class="one-third column">
              <h3>Seguimiento</h3>
              
            </div>
            <div class="one-third column">
                &nbsp;
            </div>
            <div class="one-third column" style="text-align: right;">
                <span class="user_name">
                    <?php echo utf8_encode($_SESSION['nombre']);?> <?php echo utf8_encode($_SESSION['apellidos']);?> 
                </span> <br>

                <span class="user_tipo">
                    <?php echo utf8_encode($_SESSION['tipo']);?> 
                </span> <br>
 
            </div>

 <hr />
<div class="sixteen columns clearfix">
<!-- errors & messages --->
<div style="color:#900; background:#FFA6A6">
<?php

// show negative messages
if ($registration->errors) {
    foreach ($registration->errors as $error) {
        echo $error;    
    }
}

// show positive messages
if ($registration->messages) {
    foreach ($registration->messages as $message) {
        echo $message;
    }
}

?>
</div>
<!-- errors & messages --->
<form method="post" action="register.php" name="registerform">   
    
    <!-- the user name input field uses a HTML5 pattern check -->
    <label style="float:left; margin-right:15px;">Usuario
    <input id="login_input_username" class="login_input" type="text" pattern="[a-zA-Z0-9]{2,64}" name="user_name" title="sólo caractéres alfanúmericos, de 2 a 64" required />
    
    </label>
    <!-- the email input field uses a HTML5 email type check -->
    <label>User's email    
    <input id="login_input_email" class="login_input" type="email" name="user_email" required />
    </label>        
    
    <label style="float:left; margin-right:15px;">Contraseña
    <input id="login_input_password_new" class="login_input" type="password" name="user_password_new" pattern=".{6,}" required autocomplete="off" title="mínimo 6 caractéres" />
    </label>  
    
    <label>Confirmar contraseña
    <input id="login_input_password_repeat" class="login_input" type="password" name="user_password_repeat" pattern=".{6,}" required autocomplete="off" />
    </label>
    <label style="float:left; margin-right:15px;">Nombre
    <input type="text" name="nombre" />
    </label>    
    <label>Apellidos
    <input type="text" name="apelidos" />
    </label>    
    <label style="float:left; margin-right:15px;">Tipo
    <select name="tipo" required>
    	<option value=""></option>
        <option value="DIRECTOR">Director</option>
        <option value="PEDAGOGIA">Coordinador de Pedagogia</option>
        <option value="PSICOLOGIA">Coordinador de Psicologia</option>
        <option value="DERECHO">Coordinador de Derecho</option>
        <option value="CRIMINOLOGIA">Coordinador de Criminología</option>
    </select>
    </label>  
    <label>Plantel
    <select name="plantel">
    	<option value="">Todos</option>
        <option value="RAYON">Rayon</option>
        <option value="NEZA">Nezahoalcóyotl</option>
        <option value="IXTAPA">Ixtapaluca</option>
        <option value="HIDALGO">Hidalgo</option>
        <option value="SALUD">Salud</option>
    </select>
    </label>    
    <label>
    <input type="checkbox" name="addusers" value="1" /> El usuario puede agregar más usuarios
    </label>    
    <input type="submit"  name="register" value="Registrar" />
    
</form>
</div>
	</div>
</body>