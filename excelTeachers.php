<?php
    require('reporter.class.php');
    $report = new Reporter();
	

    $TEACHERS = $report->getAllTeachers();  

    $filename = sprintf("asesores_%s.xls", date(dmy));
    
    header('Content-type: application/ms-excel');
	header('Content-Disposition: attachment; filename='.$filename);    
?>
 <table style="width: 100%; margin-bottom: 25px;" id="resume_table" border="1">
    <tr>
        <th>Usuario</th>
        <th>Nombre</th>
        <th>Apellidos</th>
        <th>Grupo</th>
        <th>Rol</th>
    </tr>
            	<?php foreach ($TEACHERS as $teacher): ?>
	                <tr>
                    <td><?php echo $teacher['username'];?></td>
	                <td><?php echo $teacher['firstname'];?></td>
	                <td><?php echo $teacher['lastname'];?></td>
                    <td><?php echo $teacher['name'];?></td>
                    <td><?php echo $teacher['shortname'];?></td>
	                </tr>            	
            	<?php endforeach; ?>
    <tr>
        <td><strong>Fecha:</strong></td>
        <td colspan="3"><span id="fecha_txt"><?php echo $date = date('d-m-Y');?></span></td>
    </tr>                
  </table>