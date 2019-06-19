<?php
$GLOBALS['notSupported'] = array(
	'Edge'
);

$GLOBALS['works'] = array(
	'air_condition'  => 'AIR CONDITION',
	'attic_insulation' => 'ATTIC INSULATION',
	'batt_insulation'  => 'BATT INSULATION',
	'blow_door_test'  => 'BLOW DOOR TEST',
	'central_furnance' => 'CENTRAL FURNANCE',
	'closed'  => 'ROOFING',
	'cover_blower' => 'COVER &amp; BLOWER',
	'duct_test' => 'DUCT TEST',
	'duct_wrap' => 'DUCT WRAP',
	'final_inspection' => 'FINAL INSPECTION',
	'flex_duct' => 'FLEX DUCT',
	'manual_j' => 'MANUAL J',
	'minisplit' => 'MINISPLIT',
	'netting' => 'NETTING',
	'poly' => 'POLY',
	'pre_assessment' => 'PRE-ASSESSMENT',
	'rework' => 'REWORK',
	'rough_end' => 'ROUGH END',
	'service' => 'SERVICE',
	'supervision' => 'SUPERVISION',
	'third_party_inspection' => 'THIRD PARTY INSPECTION',
	'vent_to_code' => 'VENT TO CODE',
	'walk_thru' => 'WALK THRU',
	'wall_furnance' => 'WALL FURNANCE',
	'wall_insulation' => 'WALL INSULATION',
	'weatherzation' => 'WEATHERIZATION',
);

$GLOBALS['statusWork'] = array(
  'pending'   => ['color'=>'default', 'tag'=>'PENDING'],
  'opened'    => ['color'=>'primary', 'tag'=>'NEW'],
  'started'   => ['color'=>'warning', 'tag'=>'WORKING'],
  'finished'  => ['color'=>'info'	, 'tag'=>'DONE'],
  'closed'    => ['color'=>'success', 'tag'=>'COMPLETED'],
  'cancelled' => ['color'=>'danger' , 'tag'=>'CANCELLED'],
  'canceled'  => ['color'=>'danger' , 'tag'=>'CANCELLED']
);

$GLOBALS['statusInspection'] = array(
	'on hold' => ['color' => 'primary', 'tag' => 'ON HOLD'],
	'passed'  => ['color' => 'success', 'tag' => 'PASSED'],
	'failed'  => ['color' => 'danger' , 'tag' => 'FAILED']
);

$GLOBALS['statusWarranty'] = array(
	'new'  => ['color' => 'primary', 'tag' => 'NEW'],
	'done' => ['color' => 'success', 'tag' => 'DONE']
);

$GLOBALS['atticInsulations'] = array(
	'Airkrete' => array(
		'R-21 (2x4)' => 0, // 750
		'R-33 (2x6)' => 0  // 550
	),
	'Blown' => array(
		'R-13' => 168.5,
		'R-19' => 109.5,
		'R-22' => 94.1,
		'R-26' => 79.6,
		'R-30' => 68.5,
		'R-38' => 51.8,
		'R-44' => 44.5,
		'R-49' => 39.5,
		'R-60' => 31.4
	),
	'Cellulose' => array(
		'R-11' => 112.5,
		'R-13' => 88.3,
		'R-19' => 53.1,
		'R-20' => 50.1,
		'R-22' => 44.3,
		'R-24' => 39.4,
		'R-30' => 29.6,
		'R-32' => 21.3,
		'R-38' => 21.9,
		'R-40' => 20.6,
		'R-44' => 18.2,
		'R-48' => 16.4,
		'R-50' => 13.6,
		'R-60' => 12.4
	),
	'Foam' => array(
		'R-13 (2x4)' => 0,
		'R-19 (2x6)' => 0
	)
);

$GLOBALS['wallInsulations'] = array(
	'Airkrete' => array(
		'R-21 (2x4)' => 0, // 750
		'R-33 (2x6)' => 0	 // 550
	),
	'Blown' => array(
		'R-15 (2x4)' => 75.4,
		'R-21 (2x6)' => 55.4
	),
	'Cellulose' => array(
		'R-13 (2x4)' => 72.5,
		'R-15 (2x6)' => 61.5
	),
	'Foam' => array(
		'R-13 (2x4)' => 0,
		'R-19 (2x6)' => 0
	)
);

$GLOBALS['battInsulations'] = array(
	'Attic' => array(
		'R-19',
		'R-30',
		'R-38'
	),
	'Wall'	=> array(
		'R-13',
		'R-19',
		'R-38'
	),
	'Underbelly' => array(
		'R-11',
		'R-13',
		'R-19',
		'R-30',
		'R-38',
		'R-60'
	)
);

$GLOBALS['components'] = array(
	'Air handler',
	'Coil',
	'Condenser',
	'Cooper Line Cover',
	'Drain line',
	'Drain Pan',
	'Ductruns',
	'Ducts box and grill',
	'Electronic air cleaner',
	'Flex gas line for furnance',
	'Flex line',
	'Flue pipe',
	'Furnace',
	'Furnance feet',
	'Gas line cut off',
	'Grills',
	'KW Heater',
	'Media air cleaner',
	'Plenum',
	'Quick disconnect and whip',
	'Return Grills',
	'Secondary drain',
	'Slab',
	'Thermostat digital',
	'Thermostat Program',
	'Thermostat WiFi',
	'Transition',
	'Trunkline',
	'UV lights',
	'Zone system'
);

$GLOBALS['pieces'] = array(
	'air handler' => 'Ductless air handler',
	'condenser'   => 'Condenser'
);
