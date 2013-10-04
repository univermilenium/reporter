<?php

/**
 * Class login
 *
 * handles the user login/logout/session
 * @author Panique
 * @link http://www.php-login.net
 * @link https://github.com/panique/php-login/
 * @license http://opensource.org/licenses/MIT MIT License
 */
class Login
{
    /**
     * @var object The database connection
     */
    private $db_connection = null;
    /**
     * @var string The user's name
     */
    private $user_name = "";
    /**
     * @var string The user's mail
     */
    private $user_email = "";
    /**
     * @var string The user's password hash
     */
    private $user_password_hash = "";
    /**
     * @var boolean The user's login status
     */
    private $user_is_logged_in = false;
    /**
     * @var array Collection of error messages
     */
    public $errors = array();
    /**
     * @var array Collection of success / neutral messages
     */
    public $messages = array();

    /**
     * the function "__construct()" automatically starts whenever an object of this class is created,
     * you know, when you do "$login = new Login();"
     */
    public function __construct()
    {

        // TODO: adapt the minimum check like in 0-one-file version

        // create/read session
        session_start();

        // check the possible login actions:
        // 1. logout (happen when user clicks logout button)
        // 2. login via session data (happens each time user opens a page on your php project AFTER he has sucessfully logged in via the login form)
        // 3. login via post data, which means simply logging in via the login form. after the user has submit his login/password successfully, his
        //    logged-in-status is written into his session data on the server. this is the typical behaviour of common login scripts.

        // if user tried to log out
        if (isset($_GET["logout"])) {
            $this->doLogout();
        }
        // if user has an active session on the server
        elseif (!empty($_SESSION['user_name']) && ($_SESSION['user_logged_in'] == 1)) {
            $this->loginWithSessionData();
        }
        // if user just submitted a login form
        elseif (isset($_POST["login"])) {
            $this->loginWithPostData();
        }
    }

    /**
     * log in with session data
     */
    private function loginWithSessionData()
    {
        // set logged in status to true, because we just checked for this:
        // !empty($_SESSION['user_name']) && ($_SESSION['user_logged_in'] == 1)
        // when we called this method (in the constructor)
        $this->user_is_logged_in = true;
    }

    private function getAsignaturas($plantel)
    {

        $this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if (!$this->db_connection->connect_errno)
         {
            $asignaturas = $this->db_connection->query("SELECT asignatura FROM asignaturas WHERE plantel = '" . $plantel . "';");

            if($asignaturas->num_rows > 0)
            {
                 $result_row = $asignaturas->fetch_object();
                 $arr_asignaturas = array();
                 foreach($result_row as $row)
                 {
                    array_push($arr_asignaturas, $row);
                 }
                 $_SESSION['plantel_asignaturas'] = $arr_asignaturas;
            }
         }
    }

    /**
     * log in with post data
     */
    public function loginWithPostData()
    {
        // if POST data (from login form) contains non-empty user_name and non-empty user_password
        if (!empty($_POST['user_name']) && !empty($_POST['user_password'])) {

            // create a database connection, using the constants from config/db.php (which we loaded in index.php)
            $this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

            // if no connection errors (= working database connection)
            if (!$this->db_connection->connect_errno) {

                // escape the POST stuff
                $this->user_name = $this->db_connection->real_escape_string($_POST['user_name']);
                // database query, getting all the info of the selected user
                $checklogin = $this->db_connection->query("SELECT user_name, user_email, user_password_hash, nombre, apellidos, tipo, plantel FROM users WHERE user_name = '" . $this->user_name . "';");

                // if this user exists
                if ($checklogin->num_rows == 1) {

                    // get result row (as an object)
                    $result_row = $checklogin->fetch_object();

                    // using PHP 5.5's password_verify() function to check if the provided passwords fits to the hash of that user's password
                    if (password_verify($_POST['user_password'], $result_row->user_password_hash)) {

                        // write user data into PHP SESSION [a file on your server]
                        $_SESSION['user_name']  = $result_row->user_name;
                        $_SESSION['user_email'] = $result_row->user_email;
                        $_SESSION['nombre']     = $result_row->nombre;
                        $_SESSION['apellidos']  = $result_row->apellidos;
                        $_SESSION['tipo']       = $result_row->tipo;
                        $_SESSION['plantel']    = $result_row->plantel;

                        $_SESSION['user_logged_in'] = 1;

                        // set the login status to true
                        $this->user_is_logged_in = true;
                        if($_GET['cplantel']!='') $this->getAsignaturas($_GET['cplantel']);
						else $this->getAsignaturas($result_row->plantel);

                    } else {
                        $this->errors[] = "Contraseña incorrecta.";
                    }
                } else {
                    $this->errors[] = "El usuario no existe.";
                }
            } else {
                $this->errors[] = "No se puede conectar a la BD.";
            }
        } elseif (empty($_POST['user_name'])) {
            $this->errors[] = "Campo Usuario vacio.";
        } elseif (empty($_POST['user_password'])) {
            $this->errors[] = "Campo Contraseña vacio.";
        }
    }

    /**
     * perform the logout
     */
    public function doLogout()
    {
        $_SESSION = array();
        session_destroy();
        $this->user_is_logged_in = false;
        $this->messages[] = "You have been logged out.";

    }

    /**
     * simply return the current state of the user's login
     * @return boolean user's login status
     */
    public function isUserLoggedIn()
    {        
        $val =  $this->user_is_logged_in;
        return $val;
    }

}
