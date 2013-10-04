<?php
    require('reporter.class.php');
    $report = new Reporter();

    $courseid = (!isset($_GET['courseid'])) ? 0  : (int)$_GET['courseid'];
    $groupid  = (!isset($_GET['groupid'])) ?  0   : (int)$_GET['groupid'];
    $plantel  = (!isset($_GET['plantel'])) ?  0  : (int)$_GET['plantel'];	

    $planteltxt = (!isset($_GET['planteltxt'])) ?  'todos'  : $_GET['planteltxt'];	
    $cursotxt = (!isset($_GET['cursotxt'])) ?  'todos'  : $_GET['cursotxt'];	
    $grupotxt = (!isset($_GET['grupotxt'])) ?  'todos'  : $_GET['grupotxt'];	

    $TEACHERS = $report->getTeacher($courseid, $groupid);  
    $ROWS     = $report->getReport($courseid, $plantel, $groupid);

    $filename = sprintf("0%s_%s_%s_%s.xls", $plantel, $cursotxt, $grupotxt, date(dmy));
    
    //header('Content-type: application/ms-excel');
	//header('Content-Disposition: attachment; filename='.$filename);    
?>
 <table style="width: 100%; margin-bottom: 25px;" id="resume_table">
    <!--tr>
        <td width="15%"><strong>Plantel:</strong></td>
        <td><span id="plantel_txt"><?php echo $planteltxt;?></span></td>
    </tr-->
    <tr>
        <td><strong>Asignatura:</strong></td>
        <td><span id="asignatura_txt"><?php echo $cursotxt;?></span></td>
    </tr>
    <tr>
        <td><strong>Grupo:</strong></td>
        <td><span id="grupo_txt"><?php echo $grupotxt;?></span></td>
    </tr>    
    <tr>
        <td><strong>Asesor:</strong></td>
        <td>
            	<?php foreach ($TEACHERS as $teacher): ?>
	                
	                     <span><?php echo $teacher['firstname'];?></span>
	                     <span><?php echo $teacher['lastname'];?></span>
	                    (<span><?php echo $teacher['username'];?></span>),
	                            	
            	<?php endforeach; ?>
            </ul>
        </td>
    </tr>    
    <tr>
        <td><strong>Fecha:</strong></td>
        <td><span id="fecha_txt"><?php echo $date = date('d-m-Y');?></span></td>
    </tr>                
  </table> 



   <table class="grid" id="report_table">
                <tr>
                    <td><strong>Matricula</strong></td>
                    <td><strong>Nombre</strong></td>
                    <td><strong>Apellidos</strong></td>
                    <td><strong>Email</strong></td>
                    <td><strong>Rol</strong></td>
                    <td><strong>Grupo</strong></td>
                    <td><strong>Actividad</strong></td>                    
                    <td><strong>Calificacion</strong></td>
                    <td><strong>Estatus</strong></td>
                </tr>
                <tbody >  
                <?php foreach ($ROWS as $row):?>
                    <tr>
                        <td><?php echo $row['Usernamse'];?></td>
                        <td><?php echo $row['Firstname'];?></td>
                        <td><?php echo $row['Lastname'];?></td>
                        <td><?php echo $row['Email'];?></td>
                        <td><?php echo $row['ROLE'];?></td>
                        <td><?php echo $row['grupo'];?></td>
                        <td><?php echo $row['actividad'];?></td>                        
                        <td><?php echo $row['grade'];?></td>
                        <td><?php echo $row['status'];?></td>
                    </tr>
                 <?php endforeach; ?>
                <tbody>
            </table>