<?php
    require('reporth.class.php');
    $report = new HorizontalReport();

    $courseid = (!isset($_GET['courseid'])) ? 0  : (int)$_GET['courseid'];
    $groupid  = (!isset($_GET['groupid'])) ?  0   : (int)$_GET['groupid'];
    $plantel  = (!isset($_GET['plantel'])) ?  0  : (int)$_GET['plantel'];

    $planteltxt = (!isset($_GET['planteltxt'])) ?  'todos'  : $_GET['planteltxt'];	
    $cursotxt = (!isset($_GET['cursotxt'])) ?  'todos'  : $_GET['cursotxt'];	
    $grupotxt = (!isset($_GET['grupotxt'])) ?  'todos'  : $_GET['grupotxt'];	

    $report->generateHorizontal($courseid, $plantel, $groupid);
    $TEACHERS = $report->getTeacher($courseid, $groupid);  
    $ROWS     = $report->users;	

    $filename = sprintf("0%s_%s_%s_%s.xls", $plantel, $cursotxt, $grupotxt, date(dmy));
    
    header('Content-type: application/ms-excel');
	header('Content-Disposition: attachment; filename='.$filename);    
?>

 <table style="width: 100%; margin-bottom: 25px;" id="resume_table">
    <tr>
        <td width="15%"><strong>Plantel:</strong></td>
        <td><span id="plantel_txt"><?php echo utf8_decode($planteltxt);?></span></td>
    </tr>
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
	                    (<span><?php echo $teacher['username'];?></span>)
	                            	
            	<?php endforeach; ?>
           
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
                    <td><strong>&Uacute;ltimo acceso</strong></td>
                    <?php foreach($report->activities as $activity):?>
						<td><strong><?php echo $activity->name; ?></strong></td>
                	<?php endforeach;?>
                    <td>Total</td>
                </tr>
                <tbody >  
                <?php foreach ($ROWS as $row):?>
                <?php
                    $totalrow  = 0;
                    $totalacts = 0;
                ?>
                    <tr>
                        <td><?php echo $row->Usernamse;?></td>
                        <td><?php echo $row->Firstname;?></td>
                        <td><?php echo $row->Lastname;?></td>
                        <td><?php echo $row->Email;?></td>
                        <td><?php echo $row->ROLE;?></td>
                        <td><?php echo $row->grupo;?></td>
                        <td><?php if($row->lastaccess==0) echo "Nunca"; else echo date("d/m/Y H:i",$row->lastaccess);?></td>

	                  	<?php foreach($report->activities as $activity):?>
							<td>
								<strong>
									<?php 
                                        $sub        = $report->getActivityResult($row, $activity->id);
                                        $totalrow   += $sub;
                                         $totalacts ++;
                                        echo $sub; 
                                    ?>
								</strong>
							</td>
	                	<?php endforeach;?>     
                        <td><?php echo $totalrow; ?></td>                   
                    </tr>
                 <?php endforeach; ?>
                <tbody>
            </table>
