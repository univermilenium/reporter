<?php 
    require('classes/reporter.class.php');
    require('../classes/Login.php');
    $report   = new Reporter();
    $login    = new Login();

    if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest')
    {
        throw new Exception("Not Allowed!", 1);
    }

    if(!$login->isUserLoggedIn())
    {
        throw new Exception("Not Allowed!", 1);        
    }

    $action   = $_GET['action'];
    $courseid = (!isset($_GET['courseid'])) ? 0  : (int)$_GET['courseid'];
    $groupid  = (!isset($_GET['groupid'])) ? 0   : (int)$_GET['groupid'];
    $plantel  = (!isset($_GET['plantel'])) ?  0  : $_GET['plantel'];
    $tipo     = $_SESSION['tipo'] ;
    $asigna   = $_SESSION['plantel_asignaturas'];

    switch ($action)
    {            
        case 'courses':
            echo $report->getCourses(true, $asigna, $tipo);
            break;

        case 'groups':
            echo $report->getGroups($courseid, $plantel, true);
            break;            

        case 'report':
            echo $report->getReport($courseid, $plantel, $groupid, true);
            break; 

        case 'teacher':
            echo $report->getTeacher($courseid, $groupid, true);
            break;                        
        
        default:
            echo "no action!";
            break;
    }