<?php

class WorkerModel extends Model
{
  public function __construct(){ parent::__construct(); }

	public function getWorker($id)
  {
		$sql = "SELECT * FROM {$this->tables['workers']} WHERE id = :id AND destroyed_at = :datetimezero LIMIT 1";
		$stmt = $this->prepare($sql);
		$stmt->bindValue(':id', $id, PDO::PARAM_INT);
		$stmt->bindValue(':datetimezero', DATETIME_ZERO, PDO::PARAM_INT);
    return $this->execute($stmt, 'fetch');
  }
	
  public function getWorkers()
  {
    $destroyedZero = DATETIME_ZERO;
    $sql = "SELECT id, name, lastname, phone, email, birthday, created_at 
            FROM {$this->tables['workers']} WHERE destroyed_at = '{$destroyedZero}'
						ORDER BY created_at DESC";
		return $this->query($sql);
  }
	
	public function getWorkersFree()
	{
		$destroyedZero = DATETIME_ZERO;
		$sql = "SELECT * FROM {$this->tables['workers']} WHERE id_crew = 0 AND destroyed_at = '{$destroyedZero}'";
		return $this->query($sql);
	}
	
	public function getWorkersNoFree()
	{
		$destroyedZero = DATETIME_ZERO;
		$sql = "SELECT * FROM {$this->tables['workers']} WHERE id_crew != 0 AND destroyed_at = '{$destroyedZero}'";
		return $this->query($sql);
	}
	
	public function getWorkersCrew($id)
	{
		$destroyedZero = DATETIME_ZERO;
		$sql = "SELECT * FROM {$this->tables['workers']} WHERE id_crew = {$id} AND destroyed_at = '{$destroyedZero}'";
		return $this->query($sql);
	}
	
	public function freedomWorkers($idcrew)
	{
		$sql 	= "UPDATE {$this->tables['workers']} SET id_crew = 0 WHERE id_crew = :idcrew";
		$stmt = $this->prepare($sql);
		$stmt->bindValue(':idcrew', $idcrew, PDO::PARAM_INT);
		return $this->execute($stmt);
	}

	public function emigrateWorkers($idcrew, $emigrates)
	{
		$ids = implode(',', $emigrates);
		$sql = "UPDATE {$this->tables['workers']} SET id_crew = :idcrew WHERE id IN ({$ids})";
		$stmt = $this->prepare($sql);
		$stmt->bindValue(':idcrew', $idcrew, PDO::PARAM_INT);
		return $this->execute($stmt);
	}
	
	public function createWorker($post)
  {
		$languages = (isset($post['languages'])) ? implode(',', $post['languages']) : 'none';
		$documents = (isset($post['documents'])) ? implode(',', $post['documents']) : 'none';
		$drives 	 = 'none';
		
    $sql = "INSERT INTO {$this->tables['workers']} (name, lastname, birthday, phone, email, skills_languages, skills_documents, skills_drives, stage, notes, created_at)
            VALUES (:name, :lastname, :birthday, :phone, :email, :languages, :documents, :drives, :stage, :notes, :created)";
		$stmt = $this->prepare($sql);
		$stmt->bindValue(':name'		 , $post['name']		, PDO::PARAM_STR);
		$stmt->bindValue(':lastname' , $post['lastname'], PDO::PARAM_STR);
		$stmt->bindValue(':birthday' , $post['birthday'], PDO::PARAM_STR);
		$stmt->bindValue(':phone'		 , $post['phone']		, PDO::PARAM_STR);
		$stmt->bindValue(':email'		 , $post['email']		, PDO::PARAM_STR);
		$stmt->bindValue(':languages', $languages				, PDO::PARAM_STR);
		$stmt->bindValue(':documents', $documents				, PDO::PARAM_STR);
		$stmt->bindValue(':drives'	 , $drives					, PDO::PARAM_STR);
		$stmt->bindValue(':stage'	 	 , $post['stage']		, PDO::PARAM_STR);
		$stmt->bindValue(':notes'		 , $post['notes']		, PDO::PARAM_STR);
		$stmt->bindValue(':created'	 , DATETIME_NOW			, PDO::PARAM_STR);
		return $this->execute($stmt);
  }
	
	public function updateWorker($id, $post)
  {
		$languages = (isset($post['languages'])) ? implode(',', $post['languages']) : 'none';
		$documents = (isset($post['documents'])) ? implode(',', $post['documents']) : 'none';
		$drives 	 = 'none';
    $sql = "UPDATE {$this->tables['workers']} 
						SET name = :name, lastname = :lastname, birthday = :birthday, phone = :phone, email = :email, skills_languages = :languages, skills_documents = :documents, skills_drives = :drives, stage = :stage, notes = :notes, updated_at = :updated 
            WHERE id = :id LIMIT 1";
		$stmt = $this->prepare($sql);
		$stmt->bindValue(':name'		 , $post['name']		, PDO::PARAM_STR);
		$stmt->bindValue(':lastname' , $post['lastname'], PDO::PARAM_STR);
		$stmt->bindValue(':birthday' , $post['birthday'], PDO::PARAM_STR);
		$stmt->bindValue(':phone'		 , $post['phone']		, PDO::PARAM_STR);
		$stmt->bindValue(':email'		 , $post['email']		, PDO::PARAM_STR);
		$stmt->bindValue(':languages', $languages				, PDO::PARAM_STR);
		$stmt->bindValue(':documents', $documents				, PDO::PARAM_STR);
		$stmt->bindValue(':drives'	 , $drives					, PDO::PARAM_STR);
		$stmt->bindValue(':stage'	 	 , $post['stage']		, PDO::PARAM_STR);
		$stmt->bindValue(':notes'		 , $post['notes']		, PDO::PARAM_STR);
		$stmt->bindValue(':updated'	 , DATETIME_NOW			, PDO::PARAM_STR);
		$stmt->bindValue(':id'	 		 , $id							, PDO::PARAM_INT);
		return $this->execute($stmt);
  }
 
	public function removeWorker($id)
	{
		$sql = "UPDATE {$this->tables['workers']} SET destroyed_at = :destroyed
						WHERE id = :id LIMIT 1";
		$stmt = $this->prepare($sql);
		$stmt->bindValue(':destroyed', DATETIME_NOW, PDO::PARAM_STR);
		$stmt->bindValue(':id'			 , $id			   , PDO::PARAM_INT);
		return $this->execute($stmt);
		#DELETE FROM {$this->tables['workers']} WHERE id = :id LIMIT 1
	}
	
	public static function stringifyWorkers($workers, $leaderCrew = null)
	{
		if(count($workers))
		{
			$arrayNames = array();
			foreach($workers as $worker)
			{
				$leader = ($worker['id'] == $leaderCrew) ? '(Leader)' : '' ;
				$name = $worker['name'].' '.$worker['lastname'].$leader;
				array_push($arrayNames, $name);
			}
			return implode(', ', $arrayNames);
		}
		return 'None';
	}
}
