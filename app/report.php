<?php
    require('reporter.class.php');
    $report = new Reporter();

    $action   = $_GET['action'];
    $courseid = (!isset($_GET['courseid'])) ? 0  : (int)$_GET['courseid'];
    $groupid  = (!isset($_GET['groupid'])) ? 0   : (int)$_GET['groupid'];
    $plantel  = (!isset($_GET['plantel'])) ?  0  : (int)$_GET['plantel'];

    switch ($action)
    {            
        case 'courses':
            echo $report->getCourses(true);
            break;

        case 'groups':
            echo $report->getGroups($courseid, true);
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