<?php

class AdminIndex
{
	private $data = array();
	
	public function getDashboard()
	{
		$scriptStart = microtime(true);
		
		$dateFrom = ( isset($_GET['from']) ) ? $_GET['from'] : DATE_INIT;
		$dateTo	  = ( isset($_GET['to']) ) 	 ? $_GET['to'] 	 : DATE_NOW;
		$secondsMinDate = strtotime($dateFrom);
		$secondsMaxDate = strtotime($dateTo);
		
		$data['works'] = $this->getWorksByPeriod($dateFrom, $dateTo);
		$data['insulations'] = $this->getInsulationsByPeriod($dateFrom, $dateTo);
		$data['inspections'] = $this->getInspectionsByPeriod($dateFrom, $dateTo);
		$data['guarantees'] = $this->getGuaranteesByPeriod($dateFrom, $dateTo);
		
		$scriptEnd = microtime(true);
    	$scriptFinal = $scriptEnd - $scriptStart;
		$data['scriptTime'] = $scriptFinal;
		$data['chartjs'] = true;
		return $data;
	}
	
	private function getWorksByPeriod($dateStart, $dateEnd)
	{	
		$modelWork = Getter::model('work');
		$works = $modelWork->getWorksByPeriod($dateStart, $dateEnd);
		
		$year  = date('Y');
		$month = date('m');
		$day 	 = date('d');
		
		$data 					  = array();
		$data['total']    = count($works);
		$data['dates']    = array($year => ['total' => 0, $month => ['total' => 0, $day => 0]]);
		$data['status']   = array('pending' => 0, 'closed' => 0, 'cancelled' => 0);
		$data['kinds']    = array();
		$data['interms']  = array();
		$data['zipcodes'] = array('total' => 0, 'codes' => []);
		
		foreach($works as $work)
		{
			// BY DATES
			list($workYear, $workMonth, $workDay) = explode('-', $work['scheduled_at']);
			if( array_key_exists($workYear, $data['dates']) )
			{
				$data['dates'][ $workYear ]['total'] += 1;
				if( $workYear === $year && $workMonth === $month )
				{
					$data['dates'][ $workYear ][ $workMonth ]['total'] += 1;
					
					if( $workDay === $day )
					{
						$data['dates'][ $workYear ][ $workMonth ][ $workDay ] += 1;
					}
				}
			}
			else
			{
				$data['dates'][ $workYear ]['total'] = 1;
			}
			
			// BY STATUS
			$status = ( array_key_exists($work['status'], $data['status']) ) ? $work['status'] : 'pending';
			$data['status'][ $status ] += 1;
			
			// BY KINDS
			$kind = $work['kind'];
			if( !array_key_exists($kind, $data['kinds']) ) $data['kinds'][ $kind ] = 0;
			$data['kinds'][ $kind ] += 1;
			
			// BY INTERMEDIARIES
			$interm = $work['id_intermediary'];
			if( !array_key_exists($interm, $data['interms']) )
			{
				$data['interms'][ $interm ]['name']  = $work['intermname'];
				$data['interms'][ $interm ]['nick']  = $work['intermnick'];
				$data['interms'][ $interm ]['total'] = 0;			
				$data['interms'][ $interm ]['works'] = [];			
			}
			$data['interms'][ $interm ]['total'] += 1;
			
			if( !array_key_exists($kind, $data['interms'][ $interm ]['works']) )
			{
				$data['interms'][ $interm ]['works'][ $kind ] = 0;
			}
			$data['interms'][ $interm ]['works'][ $kind ] += 1;
			
			// BY ZIP CODES	
			$zip = $work['zip'];
			if( !array_key_exists($zip, $data['zipcodes']['codes']) )
			{
				$data['zipcodes']['codes'][ $zip ]['total'] = 0;
				$data['zipcodes']['codes'][ $zip ]['works'] = [];
			}
			$data['zipcodes']['codes'][ $zip ]['total'] += 1;
			
			if( !array_key_exists($kind, $data['zipcodes']['codes'][ $zip ]['works']) )
			{
				$data['zipcodes']['codes'][ $zip ]['works'][ $kind ] = 0;
			}
			$data['zipcodes']['codes'][ $zip ]['works'][ $kind ] += 1;
		}
		
		$data['zipcodes']['total'] = count($data['zipcodes']['codes']);
		return $data;
	}
	
	private function getInspectionsByPeriod($dateStart, $dateEnd)
	{
		$modelInspection = Getter::model('inspection');
		$inspections = $modelInspection->getInspectionsByPeriod($dateStart, $dateEnd);
		
		$data = array();
		$data['total']  = count($inspections);
		$data['status'] = array('on hold' => 0, 'passed' => 0, 'failed' => 0);
		
		foreach($inspections as $inspection)
		{
			$key = $inspection['approval'];
			$data['status'][ $key ] += 1; 
		}
		return $data;
	}
	
	private function getGuaranteesByPeriod($dateStart, $dateEnd)
	{
		$modelWarranty = Getter::model('warranty');
		$guarantees = $modelWarranty->getGuaranteesByPeriod($dateStart, $dateEnd);
		
		$data = array();
		$data['total'] = count($guarantees);
		$data['status'] = array('new' => 0, 'done' => 0);
		
		foreach($guarantees as $warranty)
		{
			$key = $warranty['status'];
			$data['status'][ $key ] += 1;
		}
		return $data;
	}
	
	public function getInsulationsByPeriod($dateStart, $dateEnd)
	{
		$insulations = array('attic' => [], 'batt' => [], 'wall' => []);
		
		$modelAttic = Getter::modelKind('attic_insulation');
		$attics = $modelAttic->getAtticsByPeriod($dateStart, $dateEnd);
		$insulations['attic'] = $this->getAtticsCounters($attics);
			
		$modelWall = Getter::modelKind('wall_insulation');
		$walls = $modelWall->getWallsByPeriod($dateStart, $dateEnd);
		$insulations['wall'] = $this->getWallsCounters($walls);
		
		$modelBatt = Getter::modelKind('batt_insulation');
		$batts = $modelBatt->getBattsByPeriod($dateStart, $dateEnd);
		$insulations['batt'] = $this->getBattsCounters($batts);
			
		return $insulations;
	}
	
	private function getAtticsCounters($insulations)
	{
		$counters = array('total' => 0, 'closed' => 0, 'cancelled' => 0, 'pending' => 0);
		$methods = array(
			'Airkrete' 	=> [ 'total' => 0, 'sqfts' => 0, 'bags' => 0, 'rvalues' => [] ],
			'Blown' 	=> [ 'total' => 0, 'sqfts' => 0, 'bags' => 0, 'rvalues' => [] ],
			'Cellulose' => [ 'total' => 0, 'sqfts' => 0, 'bags' => 0, 'rvalues' => [] ],
			'Foam' 		=> [ 'total' => 0, 'sqfts' => 0, 'bags' => 0, 'rvalues' => [] ]
		);
		
		if($insulations)
		{
			$counters['total'] = count($insulations);

			foreach($insulations as $attic)
			{
				$keystatus = ($attic['status'] === 'closed' || $attic['status'] === 'cancelled') ? $attic['status'] : 'pending';
				$counters[ $keystatus ] += 1;
				
				$method = &$methods[ $attic['method'] ];
				$method['total'] += 1;
				$method['sqfts'] += $attic['square_feets'];
				$method['bags']  += $attic['bags'];
				
				$rvalue = $attic['rvalue'];
				if( !array_key_exists($rvalue, $method['rvalues']) )
				{
					$method['rvalues'][ $rvalue ] = [];
					$method['rvalues'][ $rvalue ]['sqfts'] = 0;
					$method['rvalues'][ $rvalue ]['bags']  = 0;
					$method['rvalues'][ $rvalue ]['total'] = 0;
				}
				$method['rvalues'][ $rvalue ]['sqfts'] += $attic['square_feets'];
				$method['rvalues'][ $rvalue ]['bags']  += $attic['bags'];
				$method['rvalues'][ $rvalue ]['total'] += 1;
			}
		}
		$counters['methods'] = $methods;
		return $counters;
	}
    
	private function getWallsCounters($insulations)
	{
		$counters = array('total' => 0, 'closed' => 0, 'cancelled' => 0, 'pending' => 0);
		$methods = array(
			'Airkrete' 	=> [ 'total' => 0, 'sqfts' => 0, 'bags' => 0, 'rvalues' => [] ],
			'Blown' 		=> [ 'total' => 0, 'sqfts' => 0, 'bags' => 0, 'rvalues' => [] ],
			'Cellulose' => [ 'total' => 0, 'sqfts' => 0, 'bags' => 0, 'rvalues' => [] ],
			'Foam' 			=> [ 'total' => 0, 'sqfts' => 0, 'bags' => 0, 'rvalues' => [] ]
		);
		
		if($insulations)
		{
			$counters['total'] = count($insulations);

			foreach($insulations as $wall)
			{
				$keystatus = ($wall['status'] === 'closed' || $wall['status'] === 'cancelled') ? $wall['status'] : 'pending';
				$counters[ $keystatus ] += 1;
				
				$method =& $methods[ $wall['method'] ];
				$method['total'] += 1;
				$method['sqfts'] += $wall['square_feets'];
				$method['bags']  += $wall['bags'];
				
				$rvalue = $wall['rvalue'];
				if( !array_key_exists($rvalue, $method['rvalues']) )
				{
					$method['rvalues'][ $rvalue ] = [];
					$method['rvalues'][ $rvalue ]['sqfts'] = 0;
					$method['rvalues'][ $rvalue ]['bags']  = 0;
					$method['rvalues'][ $rvalue ]['total'] = 0;
				}
				$method['rvalues'][ $rvalue ]['sqfts'] += $wall['square_feets'];
				$method['rvalues'][ $rvalue ]['bags']  += $wall['bags'];
				$method['rvalues'][ $rvalue ]['total'] += 1;
			}
		}
		$counters['methods'] = $methods;
		return $counters;
	}
	  
	private function getBattsCounters($insulations)
	{
		$counters = array('total' => 0, 'closed' => 0, 'cancelled' => 0, 'pending' => 0);
		$methods = array(
			'Attic' 	 => [ 'total' => 0, 'sqfts' => 0, 'rvalues' => [] ],
			'Wall' 		 => [ 'total' => 0, 'sqfts' => 0, 'rvalues' => [] ],
			'Underbelly' => [ 'total' => 0, 'sqfts' => 0, 'rvalues' => [] ]
		);
		
		if($insulations)
		{
			$counters['total'] = count($insulations);
			
			foreach($insulations as $batt)
			{
				$keystatus = ($batt['status'] === 'closed' || $batt['status'] === 'cancelled') ? $batt['status'] : 'pending';
				$counters[ $keystatus ] += 1;
				
				$method =& $methods[ $batt['method'] ];
				$method['total'] += 1;
				$method['sqfts'] += $batt['square_feets'];
				
				$rvalue = $batt['rvalue'];
				$facing = $batt['facing'];
				$size = $batt['size'];
				if( !array_key_exists($rvalue, $method['rvalues']) )
				{
					$method['rvalues'][ $rvalue ] = [];
					$method['rvalues'][ $rvalue ]['total'] = 0;
					$method['rvalues'][ $rvalue ]['sqfts'] = 0;
					$method['rvalues'][ $rvalue ]['facing']['face'] = 0;
					$method['rvalues'][ $rvalue ]['facing']['unface'] = 0;
					$method['rvalues'][ $rvalue ]['size']['big'] = 0;
					$method['rvalues'][ $rvalue ]['size']['small'] = 0;
				}
				$method['rvalues'][ $rvalue ]['sqfts'] 						 += $batt['square_feets'];
				$method['rvalues'][ $rvalue ]['facing'][ $facing ] += 1;
				$method['rvalues'][ $rvalue ]['size'][ $size ] 		 += 1;
				$method['rvalues'][ $rvalue ]['total'] 						 += 1;
			}
		}
		$counters['methods'] = $methods;
		return $counters;
	}
}