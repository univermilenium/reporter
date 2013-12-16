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
    <script>
	function editar(p){
		$('#user_id').val(p[0]);
		$('#login_input_username').val(p[1]);
		$('#login_input_email').val(p[2]);
		$('#nombre').val(p[3]);
		$('#apellidos').val(p[4]);
		$('#tipo').val(p[5]);
		$('#plantel').val(p[6]);
		if(p[7]==1) document.registerform.addusers.checked=true;
		else document.registerform.addusers.checked=false;
		$('#register').val("Modificar");
		$('#login_input_password_new').removeAttr( "required" );
		$('#login_input_password_repeat').removeAttr( "required" );
		$('#nombre').focus();
	}
	</script>
</head>
<body>
    <div class="container" style="margin-top: 55px;">
  <?php if($_SESSION['addusers']==1): ?>
  <button onClick="window.location='index.php'" style="position:absolute; right:5px; top:-35px;">Regresar a reportes</button>
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
<div class="sixteen columns clearfix">
<!-- errors & messages --->
<?php

// show negative messages
if ($registration->errors) {
    foreach ($registration->errors as $error) {
        echo '<div style="color:#900; background:#FFA6A6; padding:10px; font-weight:bold;">'.$error.'</div>';    
    }
}

// show positive messages
if ($registration->messages) {
    foreach ($registration->messages as $message) {
        echo '<div style=" color:#060; background:#B9FFB9; padding:10px; font-weight:bold;">'.$message.'</div>';
    }
}
?>
<!-- errors & messages --->
<div class="nine columns alpha" id="form_register">
<form method="post" action="register.php" name="registerform" id="registerform">   
    <input type="hidden" name="user_id" id="user_id">
    <!-- the user name input field uses a HTML5 pattern check -->
    <label class="four columns alpha">Usuario
    <input id="login_input_username" class="login_input" type="text" pattern="[a-zA-Z0-9]{2,64}" name="user_name" title="sólo caractéres alfanúmericos, de 2 a 64" required />
    
    </label>
    <!-- the email input field uses a HTML5 email type check -->
    <label class="four columns omega">Correo electrónico    
    <input id="login_input_email" class="login_input" type="email" name="user_email" required />
    </label>        
    
    <label class="four columns alpha">Contraseña
    <input id="login_input_password_new" class="login_input" type="password" name="user_password_new" pattern=".{6,}" required autocomplete="off" title="mínimo 6 caractéres" />
    </label>  
    
    <label class="four columns omega">Confirmar contraseña
    <input id="login_input_password_repeat" class="login_input" type="password" name="user_password_repeat" pattern=".{6,}" required autocomplete="off" />
    </label>
    <label class="four columns alpha">Nombre
    <input name="nombre" type="text" id="nombre" />
    </label>    
    <label class="four columns omega">Apellidos
    <input name="apellidos" type="text" id="apellidos" />
    </label>    
    <label class="four columns alpha">Tipo
    <select name="tipo" id="tipo" required>
    	<option value=""></option>
        <option value="DIRECTOR">Director</option>
        <option value="PEDAGOGIA">Coordinador de Pedagogia</option>
        <option value="PSICOLOGIA">Coordinador de Psicologia</option>
        <option value="DERECHO">Coordinador de Derecho</option>
        <option value="CRIMINOLOGIA">Coordinador de Criminología</option>
    </select>
    </label>  
    <label class="four columns omega">Plantel
    <select name="plantel" id="plantel">
    	<?php foreach($planteles as $c=>$v): ?>
    	<option value="<?=$c?>"><?=$v?></option>
        <?php endforeach; ?>
    </select>
    </label>    
    <label class="eight columns alpha">
    <input name="addusers" type="checkbox" id="addusers" value="1" /> Activar la administracion de usuarios
    </label>    
    <input type="submit"  name="register" id="register" value="Registrar" />
    <input type="reset" value="Cancelar" onClick="window.location='register.php'" />
    
</form>
</div>
	<div class="seven columns omega" id="users">
    <?php include("users.php") ?>
    </div>
</div>
	</div>
</body>