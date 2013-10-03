SELECT DISTINCT
 u.username, 
 u.firstname, 
 u.lastname, 
 FROM_UNIXTIME(u.firstaccess) as firstaccess ,
 c.shortname, 
 g.name,
(select count(id) calificadas from mdl_log where mdl_log.userid = u.id and mdl_log.action = 'grade submission') as calificadas, 
(select count(status) as enviadas from mdl_assign_submission where status = 'submitted' and mdl_assign_submission.groupid = g.id) as enviadas
FROM mdl_course c
JOIN mdl_context ct ON c.id = ct.instanceid
JOIN mdl_role_assignments ra ON ra.contextid = ct.id
JOIN mdl_user u ON u.id = ra.userid
JOIN mdl_role r ON r.id = ra.roleid
JOIN mdl_groups g ON g.courseid = c.id
JOIN mdl_groups_members m ON m.groupid = g.id

WHERE (r.shortname = 'non-editingteacher') 

forum add discussion

SELECT DISTINCT c.fullname,u.username, u.firstname, u.lastname, g.name, u.id as userid
FROM mdl_course c
JOIN mdl_context ct ON c.id = ct.instanceid
JOIN mdl_role_assignments ra ON ra.contextid = ct.id
JOIN mdl_user u ON u.id = ra.userid
JOIN mdl_role r ON r.id = ra.roleid
JOIN mdl_groups g ON g.courseid = c.id
JOIN mdl_groups_members m ON m.groupid = g.id

WHERE (r.shortname = 'non-editingteacher')


--profe por grupo

SELECT 
	a.name, b.userid, c.username
FROM
	mdl_groups a,
	mdl_groups_members b,
	mdl_user c
WHERE
 	a.id = b.groupid AND
 	c.id = b.userid AND
 	c.username LIKE '%PF%'



-- # actividadeds enviadas por grupo
 SELECT
	a.name,
	SUM((   
		select count(mdl_assign_submission.id) as enviadas 
		from mdl_assign_submission 
	    where mdl_assign_submission.id = b.userid AND status = 'submitted'
	)) as enviadas,
	(
		 SELECT 
			z.username
		FROM
			mdl_groups r,
			mdl_groups_members y,
			mdl_user z
		WHERE
		 	r.id = y.groupid AND
		 	z.id = y.userid AND
		 	z.username LIKE '%PF%' AND a.id = r.id order by z.username asc limit 0,1
	) as profe

FROM
	mdl_groups a,
	mdl_groups_members b,
	mdl_user c
WHERE
 	a.id = b.groupid AND
 	b.userid = c.id  AND
 	a.name LIKE 'S%'

 GROUP BY
 	a.name, profe
 ORDER BY 
    a.name, enviadas