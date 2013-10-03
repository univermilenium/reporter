<?php

    require('reporter.class.php');
    
    Class Teacher extends reporter
    {
    	public function getActivityReport()
    	{
            $allrows = array();

    		foreach($this->getCourses() as $course)
    		{
    			$cid = (int)$course['id'];
    			foreach($this->getGroups($cid) as $group)
    			{
    				$gid = (int)$group['id'];
    				$teacher = $this->getTeacher($cid, $gid);
    				$teachearid = (int)$teacher[0]['userid'];
    				$rows = $this->getLogs($teachearid, $cid, false);
                    array_push($allrows, $rows);
    			}
    		}

            return $allrows;
    	}
    }
    ini_set("memory_limit","1200M");
    $teacher = new Teacher();
    $rows    = $teacher->getActivityReport();

?>


    <?php foreach($rows as $row): ?>     
        <table>
            <?php foreach($row as $teacher): ?>
                <tr>
                    <td><?php echo $teacher['username']; ?></td>
                    <td><?php echo $teacher['shortname']; ?></td>
                    <td><?php echo $teacher['firstname']; ?></td>
                    <td><?php echo $teacher['lastname']; ?></td>
                    <td><?php echo $teacher['module']; ?></td>
                    <td><?php echo $teacher['action']; ?></td>
                    <td><?php echo $teacher['url']; ?></td>
                    <td><?php echo $teacher['ip']; ?></td>
                    <td><?php echo $teacher['course']; ?></td>
                </tr>
            <?php endforeach ?>
        </table>
    <?php endforeach;?>
