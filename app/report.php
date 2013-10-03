<?php 
    require('reporter.class.php');
    require('../classes/Login.php');
    $report   = new Reporter();
    $login    = new Login();
    if(!$login->isUserLoggedIn()){ header('location: ../index.php'); }

    $action   = $_GET['action'];
    $courseid = (!isset($_GET['courseid'])) ? 0  : (int)$_GET['courseid'];
    $groupid  = (!isset($_GET['groupid'])) ? 0   : (int)$_GET['groupid'];
    $plantel  = (!isset($_GET['plantel'])) ?  0  : $_GET['plantel'];
    $asigna   = $_SESSION['plantel_asignaturas'];
    
    switch ($action)
    {            
        case 'courses':
            echo $report->getCourses(true, $asigna);
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