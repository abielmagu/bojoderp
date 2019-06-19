<?php

// GLOBALS
$kinds = $GLOBALS['works'];

 // RANGE
$from = isset($_GET['from']) ? $_GET['from'] : DATE_INIT;
$to	  = isset($_GET['to']) 	 ? $_GET['to'] 	 : DATE_NOW;

// WORKS
$works = $data['works'];
$worksCount = $works['total'];
$worksYearCount  = $works['dates'][date('Y')]['total'];
$worksMonthCount = $works['dates'][date('Y')][date('m')]['total'];
$worksDayCount 	 = $works['dates'][date('Y')][date('m')][date('d')];
$worksPending 	 = $works['status']['pending'];
$worksClosed		 = $works['status']['closed'];
$worksCancelled  = $works['status']['cancelled'];
$worksKind = $works['kinds'];
ksort($worksKind);

// INSULATIONS
$atticInsulations = $data['insulations']['attic'];
$battInsulations = $data['insulations']['batt'];
$wallInsulations = $data['insulations']['wall'];
	
// INTERMEDIARIES
$intermediaries = $works['interms'];

// ZIP
$worksZip = $works['zipcodes'];

// INSPECTIONS
$inspections = $data['inspections'];
$inspectionsCount = $inspections['total'];
$inspectionsOnHold = $inspections['status']['on hold'];
$inspectionsPassed = $inspections['status']['passed'];
$inspectionsFailed = $inspections['status']['failed'];

// GUARANTEES
$guarantees = $data['guarantees'];
$guaranteesCount = $guarantees['total'];
$guaranteesNew = $guarantees['status']['new'];
$guaranteesDone = $guarantees['status']['done'];