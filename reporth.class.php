<?php
	require('reporter.class.php');

	Class HorizontalReport extends reporter
	{
		public $rows;
		public $activities = array();
		public $users      = array();

		function __construct()
		{
			parent::__construct();
		}

		public function getActivityInfo($username, $activityid)
		{			
			$activity = new stdClass();
			foreach ($this->rows as $row)
			{
				if($row['Usernamse'] == $username && $row['actividadid'] == $activityid)
				{
					$activity->calificacion = $row['grade'];
					$activity->estatus      = $row['status'];
					$activity->name         = $row['actividad'];
				}
			}

			return $activity;
		}

		public function getActivityResult($userrow, $activityid)
		{
			$estatus = null;

			$activity = $userrow->{$activityid};
			
			if($activity->calificacion != "")
			{
				$estatus = $activity->calificacion;
			}

			if($activity->calificacion == "" && $activity->estatus == "")
			{
				$estatus = "Sin Entrega";
			}

			if($activity->calificacion == "" && $activity->estatus != "")
			{
				$estatus = "Enviado para calificar";
			}			

			return $estatus;
		}

		public function generateHorizontal($courseid = 0, $plantel = '0', $groupid = 0)
		{
			$this->rows = $this->getReport($courseid, $plantel, $groupid, false);

			//fill up activities & users
			foreach ($this->rows as $row) 
			{
				$activity = new stdClass();
				if(!array_key_exists($row['actividadid'], $this->activities))
				{
					$activity->name = $row['actividad'];
					$activity->id   = $row['actividadid'];
					$this->activities = parent::array_push_assoc($this->activities, $row['actividadid'], $activity);
				}
			}

			foreach ($this->rows as $row) 
			{
				if(!array_key_exists($row['Usernamse'], $this->users))
				{
					$user = new stdClass();

					$user->Usernamse 	= $row['Usernamse'];
					$user->Course 		= $row['Course'];
					$user->Email 		= $row['Email'];
					$user->Firstname 	= $row['Firstname'];
					$user->Lastname 	= $row['Lastname'];
					$user->ROLE 		= $row['ROLE'];
					$user->grupo 		= $row['grupo'];

					foreach($this->activities  as $activity)
					{
						$user->{$activity->id} = $this->getActivityInfo($user->Usernamse, $activity->id);
					}

					$this->users = parent::array_push_assoc($this->users, $row['Usernamse'], $user);
				}

			}

		}
	}
