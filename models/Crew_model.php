<?php

class CrewModel extends Model
{	
  public function __construct(){ parent::__construct(); }
	
	public function getCrew($id)
	{
    $sql = "SELECT c.*, u.name, u.enabled 
            FROM {$this->tables['crews']} AS c
            INNER JOIN {$this->tables['users']} AS u
            ON c.id_user = u.id
            WHERE c.id = :id AND c.destroyed_at = :destroyed LIMIT 1";
		$stmt = $this->prepare($sql);
		$stmt->bindValue(':destroyed', DATETIME_ZERO, PDO::PARAM_STR);
		$stmt->bindValue(':id', $id, PDO::PARAM_INT);
		return $this->execute($stmt, 'fetch');
	}
	
	public function getCrewBy($column, $value)
	{
		$sql = "SELECT * FROM {$this->tables['crews']} WHERE {$column} = :value LIMIT 1";
		$stmt = $this->prepare($sql);
		$PDOPARAM = ( is_string($value) ) ? PDO::PARAM_STR : PDO::PARAM_INT;
		$stmt->bindValue(':value' , $value, $PDOPARAM);
		return $this->execute($stmt, 'fetch');
	}

	public function getCrews()
	{
		$destroyedZero = DATETIME_ZERO;
		$sql = "SELECT * FROM {$this->tables['crews']} 
                WHERE destroyed_at = '{$destroyedZero}' ORDER BY kind, enabled DESC, id";
		return $this->query($sql);
	}
	
	public function getCrewsEnabled()
	{
		$destroyedZero = DATETIME_ZERO;
		$sql = "SELECT * FROM {$this->tables['crews']} 
                WHERE destroyed_at = '{$destroyedZero}' AND enabled = 1
                ORDER BY nick, kind";
		return $this->query($sql);
	}
	
	public function getCrewWorkers($id)
	{
		$destroyedZero = DATETIME_ZERO;
		$sql = "SELECT * FROM {$this->tables['workers']} WHERE id_crew = {$id} AND destroyed_at = '{$destroyedZero}'";
		return $this->query($sql);	
	}
	
	public function createCrew($post)
	{
		$sql = "INSERT INTO {$this->tables['crews']} (id_user, kind, nick, notes, created_at)
				VALUES (:iduser, :kind, :nick, :notes, :created)";
		$stmt = $this->prepare($sql);
		$stmt->bindValue(':iduser' , $post['iduser']	, PDO::PARAM_INT);
		$stmt->bindValue(':kind'	 , $post['kindname'], PDO::PARAM_STR);
		$stmt->bindValue(':nick'	 , $post['nickname'], PDO::PARAM_STR);
		$stmt->bindValue(':notes'	 , $post['notes']   , PDO::PARAM_STR);
		$stmt->bindValue(':created', DATETIME_NOW 		, PDO::PARAM_STR);
		return $this->execute($stmt);
	}
	
	public function updateCrew($id, $post)
	{		
		$sql = "UPDATE {$this->tables['crews']} 
						SET enabled = :enabled, kind = :kind, nick = :nick, notes = :notes, updated_at = :updated 
						WHERE id = :id LIMIT 1";
		$stmt = $this->prepare($sql);
		$stmt->bindValue(':kind' 	 , $post['kindname'], PDO::PARAM_STR);
		$stmt->bindValue(':nick' 	 , $post['nickname'], PDO::PARAM_STR);
		$stmt->bindValue(':notes'	 , $post['notes'], PDO::PARAM_STR);
		$stmt->bindValue(':updated', DATETIME_NOW, PDO::PARAM_STR);
		$stmt->bindValue(':enabled', 1, PDO::PARAM_INT);
		$stmt->bindValue(':id', $id, PDO::PARAM_INT);
		return $this->execute($stmt);
	}

	public function disableCrew($id)
	{
		$sql = "UPDATE {$this->tables['crews']} SET 
				enabled = :disabled, id_leader = :leader 
				WHERE id = :id LIMIT 1";
		$stmt = $this->prepare($sql);
		$stmt->bindValue(':disabled', 0, PDO::PARAM_INT);
		$stmt->bindValue(':leader', 0, PDO::PARAM_INT);
		$stmt->bindValue(':id', $id, PDO::PARAM_INT);
		return $this->execute($stmt);
	}
	
	public function reorganizeCrew($id, $post)
	{
		#Code
	}
	
	public function setCrewLeader($id, $idworker)
	{
		$sql = "UPDATE {$this->tables['crews']} SET id_leader = :idworker, updated_at = :updated WHERE id = :id LIMIT 1";
		$stmt = $this->prepare($sql);
		$stmt->bindValue(':updated'	, DATETIME_NOW, PDO::PARAM_STR);
		$stmt->bindValue(':idworker', $idworker	  , PDO::PARAM_INT);
		$stmt->bindValue(':id', $id, PDO::PARAM_INT);
		return $this->execute($stmt);
	}
	
	public function getCrewLeader($id)
	{
		$sql = "SELECT id_leader FROM {$this->tables['crews']} WHERE id = :id LIMIT 1";
		$stmt = $this->prepare($sql);
		$stmt->bindValue(':id', $id, PDO::PARAM_INT);
		if($result = $this->execute($stmt))
		{
			return $result['id_leader'];
		}
		return false;
	}
  
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
  /********************************************************************************************************/

  public function alterCrewWork( $post )
  {
    extract( $post );
    $id = (int) $workRow;
    $datetime_now = DATETIME_NOW;
    if( $alter_work == 'finish' )
    {
      $alterDate = 'finished_date';
      $alterStatus = 'finished';
      $result['alter'] = ucfirst( $alterStatus );
    }
    else
    {
      $alterDate = 'started_date';
      $alterStatus = 'started';
      $result['alter'] = ucfirst( $alterStatus );
    }

    $modelWork = $this->getWorkModel();
    $result['status'] = $modelWork->alterWork( $id , $alterDate , $datetime_now );
    $result['status'] = $modelWork->alterWork( $id , 'status' , $alterStatus );
    return $result;
  }

  public function getCrewWorksByDate($id, $date)
  {
    $crewId = (int) $id;
      
    $sql = "SELECT w.id, w.workers, w.kind, w.priority, w.started_date, w.finished_date, w.status, w.scheduled_date, 
            c.name, c.lastname, c.address, c.zip, c.city, c.state, c.phone
            FROM pfm_works w
            INNER JOIN pfm_clients c
            ON w.id_client = c.id
            WHERE w.id_crew = $crewId AND w.scheduled_date = '$date' AND w.status IN ('opened', 'started', 'finished')
            OR w.id_crew = $crewId AND w.scheduled_date < '$date' AND w.status IN ('opened', 'started') 
            ORDER BY w.scheduled_date DESC, w.priority";
    
    $result = $this->query( $sql );

    return $result;
  }
    
  public function getCrewGuaranteesByDate($id, $date)
  {
    $crewId = (int) $id;
      
    $sql = "SELECT g.id, g.workers, g.kind, g.priority, g.started_date, g.finished_date, g.status, g.scheduled_date, 
            c.name, c.lastname, c.address, c.zip, c.city, c.state, c.phone
            FROM pfm_guarantees g
            INNER JOIN pfm_clients c
            ON w.id_client = c.id
            WHERE w.id_crew = $crewId AND w.scheduled_date = '$date' AND w.status IN ('opened', 'started', 'finished')
            OR w.id_crew = $crewId AND w.scheduled_date < '$date' AND w.status IN ('opened', 'started') 
            ORDER BY w.priority ASC, w.scheduled_date DESC";
    
    $result = $this->query( $sql );

    return $result;
  }
}
