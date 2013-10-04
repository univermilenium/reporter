<?php
    require('db.class.php');
    require('report.querys.php');
    require('courses.class.php');

	Class reporter extends db 
	{
		public $settings;
		public $settings_file = "settings.ini";	

		function __construct()
		{
			try
			{
				$this->getSettings();
				$this->connection($this->settings["host"], $this->settings["database"],$this->settings["user"], $this->settings["pwd"]);

			}catch(Exception $e)
			{
				echo $e->getMessage();				
				die();
			}
		}

		public function getCourses($json = false, $asignaturas, $type)
		{
			$rows 			  = $this->getRows(Querys::getCoursesQuery());
			$rows_asignaturas = array();

			foreach($rows as $row)
			{
				foreach ($asignaturas as $asignatura) 
				{
					if($asignatura == $row['shortname'])
					{
						array_push($rows_asignaturas, $row);						
					}
				}
			}

			$rows_asignaturas = Courses::filterByType($rows_asignaturas, $type, $asignaturas);

			if(!$json)
			{
				return $rows_asignaturas;
			}

			return json_encode($rows_asignaturas);
		}

		public function getTeacher($courseid, $groupid, $json = false)
		{
			$qry = Querys::getTeacherQuery($this->settings['prefix']);
			$this->params = array
			(
				'groupid'   => $groupid
			);

			$rows = $this->getRows($qry);
			if($json)
			{
				return json_encode($rows);
			}

			return $rows;
		}

		public function getAllTeachers($json = false)
		{
			$qry = Querys::getAllTeachersQuery($this->settings['prefix']);

			$rows = $this->getRows($qry);
			if($json)
			{
				return json_encode($rows);
			}

			return $rows;
		}

		public function getGroups($courseid, $plantel, $json = false)
		{	

			$rows =  $this->getRows(Querys::getGroupsQuery(), 
									array(
										  ':courseid' => $courseid, 
										  ':plantel' => "%".$plantel."%"
										));			

			if($json)
			{
				$rows = json_encode($rows);
			}
			return $rows;
		}

		public function getLogs($userid, $courseid, $json = false)
		{
			$qry = Querys::getLogQry($this->settings['prefix']);
			$this->params = array
			(
				'userid'   => $userid,
				'courseid' => $courseid
			);	

			$rows = $this->getRows($qry);
			if($json)
			{
				return json_encode($rows);
			}

			return $rows;

		}

		public function getReport($courseid = 0, $plantel = '0', $groupid = 0, $json = false)
		{
			$qry          = Querys::getQueryData($this->settings['prefix']);			

			$this->params = array
			(
				'courseid' => $courseid,
			    'plantel'  => $plantel. '%',
				'groupid'  => $groupid
			);

			if($courseid > 0)
			{
				$qry = Querys::addCourse($qry);	
			}

			if($plantel > 0)
			{;
				$qry = Querys::addPlantel($qry);	
			}

			if($groupid > 0)
			{
				$qry = Querys::addGroup($qry);
			}

			$rows = $this->getRows($qry);
			if($json)
			{
				return json_encode($rows);
			}

			return $rows;
		}

		static public function getPlantel($uid)
		{
			$uid = (string)$uid;
			return "0".$uid[0];
		}

		private function getSettings()
		{
			$this->settings = parse_ini_file($this->settings_file);
		}
	}