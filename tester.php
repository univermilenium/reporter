<?php
	require("reporth.class.php");
	$report = new HorizontalReport();
	$report->generateHorizontal(2, null, 1);
	print_r($report->users);


