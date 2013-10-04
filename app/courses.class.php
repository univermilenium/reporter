<?php

	Class Courses
	{

		static $PEDAGOGIA     = array('MPEG0103', 'MPEG0418');
		static $PSICOLOGIA    = array('MPS0101');
		static $DERECHO       = array('MDER0101');
		static $CRIMINOLOGIA  = array('CRIMINOLOGIAIM0103');

		static public function filterByType($courses, $type, $asignaturas)
		{
			$finalcourses = array();

			if(strtoupper($type) != "DIRECTOR" && $type != "")
			{
				foreach ($courses as $course) 
				{
					if(in_array($course['shortname'], Courses::$$type))
					{
						array_push($finalcourses, $course);
					}
				}
			}

			return (count($finalcourses) < 1 ) ? $courses : $finalcourses;
		}

	}