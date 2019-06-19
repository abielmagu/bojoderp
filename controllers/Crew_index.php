<?php 

class CrewIndex
{
	public function getDashboard()
	{
		$modelCrew = Getter::model('crew');
		$crew = $modelCrew->getCrewBy('id_user', Session::get('id'));
		$idcrew = (int) $crew['id'];
			
		$modelWork = Getter::model('work');
		$data['works'] = $modelWork->getWorksCrew($idcrew);
		
		$modelWorker = Getter::model('worker');
		$workers = $modelWorker->getWorkersCrew($idcrew);
		$data['workers'] = $modelWorker->stringifyWorkers($workers);
		return $data;
	}
}