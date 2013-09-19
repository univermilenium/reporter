<?php

  Class Querys
  {
		static public function addPlantel($qry)
		{
			$qry  = Querys::addWhere($qry);
			$qry .= " AND user2.username like :plantel";
			return $qry;
		}		

		static public function addGroup($qry)
		{
			$qry  = Querys::addWhere($qry);
			$qry .= " AND members.groupid = :groupid";
			return $qry;
		}

		static public function addCourse($qry)
		{
			$qry  = Querys::addWhere($qry);
			$qry .= " AND course.id = :courseid";
			return $qry;
		}

		public static function getCoursesQuery()
		{
			return "SELECT id, fullname, shortname FROM mdl_course";
		}		

		public static function getGroupsQuery()
		{
			return "SELECT id, name FROM mdl_groups WHERE courseid = :courseid";
		}	

		static public function addWhere($qry)
		{
			$pos  =  strrpos(strtolower($qry), "from");
			$from =  substr($qry, $pos);

			if (!strpos(strtolower($from),'where') !== false) 
			{
			    $qry .=  " WHERE 1=1 ";	
			}

			return $qry;
		}	

		static public function getTeacherQuery($prefix = "mdl_")
		{
			return "

				SELECT DISTINCT c.fullname,u.username, u.firstname, u.lastname, g.name
				FROM ".$prefix."course c
				JOIN ".$prefix."context ct ON c.id = ct.instanceid
				JOIN ".$prefix."role_assignments ra ON ra.contextid = ct.id
				JOIN ".$prefix."user u ON u.id = ra.userid
				JOIN ".$prefix."role r ON r.id = ra.roleid
				JOIN ".$prefix."groups g ON g.courseid = c.id
				JOIN ".$prefix."groups_members m ON m.groupid = g.id

				WHERE (r.shortname = 'teacher' or r.shortname = 'editingteacher') AND c.id = :courseid AND g.id = :groupid

			";
		}

		static public function getQueryData($prefix = "mdl_")
		{
			$qry="
					SELECT
					distinct(assign.id),
					user2.username AS Usernamse,
					user2.firstname AS Firstname,
					user2.lastname AS Lastname,
					user2.lastaccess AS lastaccess,
					user2.email AS Email,
					user2.city AS City,
					course.fullname AS Course
					,(SELECT shortname FROM ".$prefix."role WHERE id=en.roleid) AS ROLE
					,(SELECT name FROM ".$prefix."role WHERE id=en.roleid) AS RoleName,
					assign.name as actividad,
					(SELECT grade FROM ".$prefix."assign_grades WHERE assignment = assign.id AND userid = user2.id) as grade,
					(SELECT status FROM ".$prefix."assign_submission WHERE assignment = assign.id AND userid = user2.id ) as status,
					(SELECT name FROM ".$prefix."groups WHERE id = members.groupid)  as grupo,
					assign.id as actividadid
					FROM ".$prefix."course AS course
					JOIN ".$prefix."enrol AS en ON en.courseid = course.id
					JOIN ".$prefix."user_enrolments AS ue ON ue.enrolid = en.id
					JOIN ".$prefix."user AS user2 ON ue.userid = user2.id
					JOIN ".$prefix."assign as assign ON assign.course = course.id
					JOIN ".$prefix."groups_members as members ON members.userid = user2.id
				";

				return $qry;
		}  	
  }