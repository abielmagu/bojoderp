<?php

class IntermediaryIndex
{
    private $model;
    
	public function getDashboard()
	{
		$modelInterm = Getter::model('intermediary');
		$interm = $modelInterm->getIntermBy('id_user', Session::get('id'));
		$idinterm = (int) $interm['id'];
		
		$data['date'] = (isset($_GET['date'])) ? $_GET['date'] : DATE_NOW;
		$modelWork = Getter::model('work');
        
        if( isset($_GET['work']) && is_numeric($_GET['work']) )
        {
            $work_id = $_GET['work'];
            if( !$data['work'] = $modelWork->getWorkForIntermediary($work_id) )
            {
                Service::relocation('?date='.$data['date']);
            }
            $details = $this->callKindAction($data['work']['kind'], 'read', $work_id);
            foreach($details as $k => $v)
            {
                if( !is_numeric($k) && $k !== 'id' && $k !== 'id_work' )
                {
                    $k = ucwords( str_replace('_', ' ', $k) );
                    $data['details'][$k] = $v;
                }
            }
            /*
            $data['details'] = array_filter($details, function ($k) {
                return !is_numeric($k);
            }, ARRAY_FILTER_USE_KEY);
            unset($data['details']['id'], $data['details']['id_work']);
            */
        }
        else
        {
		  $data['works'] = $modelWork->getWorksInterm($idinterm, $data['date']);
        }
		return $data;
	}
    
    private function callKindAction($kind, $action, $id, $params = false)
	{
		$modelKind = Getter::modelKind($kind);
		$objAction = array($modelKind, $action);
		$objParams = $params ? array($id, $params) : array($id);
		return call_user_func_array($objAction, $objParams);
	}

	public function kind($params)
	{
		$kind = $params[0];
		$path = VIEWS.'kinds'.DS.$kind.DS.'add.php';
		require_once $path;
		#$this->view->renderTemplate($path);
	}
}