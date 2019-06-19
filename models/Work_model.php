<?php

class WorkModel extends Model
{
  public function __construct(){ parent::__construct(); }

	public function getWorkLastInsert()
	{
		return $this->getLastInsertId();
	}

	public function getWorkMaxId()
	{
    $table = $this->tables['works'];
		return $this->getMaxId($table) ;
	}

	public function getWork($id)
	{
    $sql = "SELECT w.id, w.id_user, w.id_client, w.id_intermediary, w.id_crew, w.workers, w.kind, w.priority, w.notes AS 'wnotes',
            w.status, w.scheduled_at, w.opened_at, w.started_at, w.finished_at, w.closed_at, w.cancelled_at, w.updated_at,
            c.id AS 'idclient', c.name, c.lastname, c.address, c.zip, c.city, c.state, c.phone, c.email, c.notes
            FROM {$this->tables['works']} AS w
            INNER JOIN {$this->tables['clients']} AS c
            ON w.id_client = c.id
            WHERE w.id = :id LIMIT 1";
		$stmt = $this->prepare($sql);
		$stmt->bindValue(':id', $id, PDO::PARAM_INT);
		return $this->execute($stmt, 'fetch');
	}
    
    public function getWorkForIntermediary($id)
    {
        $sql = "SELECT w.id, w.id_user, w.id_client, w.id_intermediary, w.id_crew, w.workers, w.kind, w.priority, w.notes AS 'wnotes',
            w.status, w.scheduled_at, w.opened_at, w.started_at, w.finished_at, w.closed_at, w.cancelled_at, w.updated_at,
            c.id AS 'idclient', c.name, c.lastname, c.address, c.zip, c.city, c.state, c.phone, c.email, c.notes,
            t.nick AS 'nick_crew'
            FROM {$this->tables['works']} AS w
            INNER JOIN {$this->tables['clients']} AS c
            ON w.id_client = c.id
            INNER JOIN {$this->tables['crews']} AS t
            ON w.id_crew = t.id
            WHERE w.id = :id LIMIT 1";
		$stmt = $this->prepare($sql);
		$stmt->bindValue(':id', $id, PDO::PARAM_INT);
		return $this->execute($stmt, 'fetch');      
    }

  public function getWorks($date)
  {
    $sql = "SELECT w.*, t.nick AS 'crew_nick', t.kind AS 'crew_kind',
            c.id AS 'idclient', c.name, c.lastname, c.phone, c.email, c.address, c.zip, c.state, c.city,
            i.nick AS 'interm_nick'
            FROM {$this->tables['works']} AS w
            INNER JOIN {$this->tables['clients']} AS c
            ON w.id_client = c.id
            INNER JOIN {$this->tables['crews']} AS t
            ON w.id_crew = t.id
            INNER JOIN {$this->tables['interms']} AS i
            ON w.id_intermediary = i.id
            WHERE w.scheduled_at = '{$date}'
            ORDER BY w.id_crew, w.scheduled_at DESC, w.priority ASC";
		/*
		OR w.scheduled_at < '{$date}'
		AND w.status != 'cancelled' AND w.status != 'closed'
		WHERE w.scheduled_date = '$dateNow' ORDER BY w.id_crew, w.priority"
		WHERE CAST( w.scheduled_date AS DATE ) = '$dateNow'
		*/
    return $this->query($sql);
  }

  public function getWorksPendings()
  {
    $DATE_NOW  = DATE_NOW;
    $DATETIME_ZERO = DATETIME_ZERO;
    $sql = "SELECT w.id, w.kind, w.scheduled_at, w.status, c.address, c.zip, c.city, c.state
            FROM {$this->tables['works']} AS w
            INNER JOIN {$this->tables['clients']} AS c
            ON w.id_client = c.id
            WHERE w.closed_at = '{$DATETIME_ZERO}' AND w.cancelled_at = '{$DATETIME_ZERO}' AND scheduled_at < '{$DATE_NOW}'
            OR w.status = 'pending' AND scheduled_at < '{$DATE_NOW}'
            ORDER BY w.scheduled_at DESC";
    # w.scheduled_date != '$date_now'
    return $this->query($sql);
  }

  public function getWorksBy($column, $value)
  {
		$PDO_PARAM = ( is_string($value) ) ? PDO::PARAM_STR : PDO::PARAM_INT;
		$sql = "SELECT w.*, c.name AS 'nameClient', c.lastname, c.address, c.zip, c.city, c.state, c.phone, c.email, c.notes,
                i.name AS 'nameInterm', i.nick
                FROM {$this->tables['works']} AS w
                INNER JOIN {$this->tables['clients']} AS c
                ON w.id_client = c.id
                INNER JOIN {$this->tables['interms']} AS i
                ON w.id_intermediary = i.id
                WHERE {$column} = :value";
		$stmt = $this->prepare($sql);
		$stmt->bindValue(':value', $value, $PDO_PARAM);
    return $this->execute($stmt, 'fetchAll');
  }

	public function getWorksByPeriod($dateStart, $dateEnd)
	{
		$sql = "SELECT w.*, c.zip, c.city, c.state, i.name AS 'intermname', i.nick AS 'intermnick'
                FROM {$this->tables['works']} AS w
                INNER JOIN {$this->tables['clients']} AS c
                ON w.id_client = c.id
                INNER JOIN {$this->tables['interms']} AS i
                ON w.id_intermediary = i.id
                WHERE scheduled_at >= '{$dateStart}' AND scheduled_at <= '$dateEnd'
                ORDER BY YEAR(w.scheduled_at) DESC";
		return $this->query($sql);
	}

  public function getWorksClient($id)
  {
      $sql = "SELECT * FROM {$this->tables['works']} WHERE id_client = {$id} ORDER BY id DESC";
      return $this->query($sql);
  }

	public function getWorksCrew($id)
	{
		$sql = "SELECT w.*, c.name AS 'nameClient', c.lastname, c.address, c.zip, c.city, c.state, c.phone, c.email, c.notes,
                i.name AS 'nameInterm', i.nick
                FROM {$this->tables['works']} AS w
                INNER JOIN {$this->tables['clients']} AS c
                ON w.id_client = c.id
                INNER JOIN {$this->tables['interms']} AS i
                ON w.id_intermediary = i.id
                WHERE w.id_crew = :crew AND w.scheduled_at = :date
                ORDER BY w.priority ASC";
		$stmt = $this->prepare($sql);
		$stmt->bindValue(':crew', $id, PDO::PARAM_INT);
		$stmt->bindValue(':date', DATE_NOW, PDO::PARAM_STR);
    return $this->execute($stmt, 'fetchAll');
	}

	public function getWorksInterm($id, $date)
	{
		$sql = "SELECT w.*, c.name AS 'nameClient', c.lastname, c.address, c.zip, c.city, c.state, c.phone, c.email, c.notes,
                i.name AS 'nameInterm', i.nick, t.nick AS 'nick_crew'
                FROM {$this->tables['works']} AS w
                INNER JOIN {$this->tables['clients']} AS c
                ON w.id_client = c.id
                INNER JOIN {$this->tables['interms']} AS i
                ON w.id_intermediary = i.id
                INNER JOIN {$this->tables['crews']} AS t
                ON w.id_crew = t.id
                WHERE w.id_intermediary = :interm AND w.scheduled_at = :date
                ORDER BY w.kind, w.priority ASC";
		$stmt = $this->prepare($sql);
		$stmt->bindValue(':interm', $id	 , PDO::PARAM_INT);
		$stmt->bindValue(':date'	, $date, PDO::PARAM_STR);
        return $this->execute($stmt, 'fetchAll');
	}

	public function createWork($post)
	{
		$sql = "INSERT INTO {$this->tables['works']}
                (id_user, id_client, id_intermediary, id_crew, workers, kind, notes, scheduled_at, opened_at)
                VALUES
                (:iduser, :idclient, :idinterm, :idcrew, :workers, :kind, :notes, :scheduled, :opened)";
		$stmt = $this->prepare($sql);
		$stmt->bindValue(':iduser'	 , $post['iduser']	 , PDO::PARAM_INT);
		$stmt->bindValue(':idclient' , $post['idclient'] , PDO::PARAM_INT);
		$stmt->bindValue(':idinterm' , $post['idinterm'] , PDO::PARAM_INT);
		$stmt->bindValue(':idcrew'	 , $post['idcrew']	 , PDO::PARAM_INT);
		$stmt->bindValue(':workers'	 , $post['workers']	 , PDO::PARAM_STR);
		$stmt->bindValue(':kind'		 , $post['kindwork'] , PDO::PARAM_STR);
		$stmt->bindValue(':notes'		 , $post['notes']		 , PDO::PARAM_STR);
		$stmt->bindValue(':scheduled', $post['scheduled'], PDO::PARAM_STR);
		$stmt->bindValue(':opened'	 , DATETIME_NOW			 , PDO::PARAM_STR);
		$result = $this->execute($stmt);
		$this->updateWorksOpenCount();
		return $result;
	}

	public function updateWork($id, $post)
	{
		$post['idcrew'] 	= (int) $post['crew'];
		$post['idinterm'] = (int) $post['intermediary'];
		$sql = "UPDATE {$this->tables['works']} SET
                id_user = :iduser, id_intermediary = :idinterm, id_crew = :idcrew,
                workers = :workers, notes = :notes, scheduled_at = :scheduled, updated_at = :updated
                WHERE id = :id LIMIT 1";
		$stmt = $this->prepare($sql);
		$stmt->bindValue(':iduser'	 , $post['iduser']	 , PDO::PARAM_INT);
		$stmt->bindValue(':idinterm' , $post['idinterm'] , PDO::PARAM_INT);
		$stmt->bindValue(':idcrew'	 , $post['idcrew']	 , PDO::PARAM_INT);
		$stmt->bindValue(':workers'	 , $post['workers']	 , PDO::PARAM_STR);
		$stmt->bindValue(':notes'	 	 , $post['notes']	 	 , PDO::PARAM_STR);
		$stmt->bindValue(':scheduled', $post['scheduled'], PDO::PARAM_STR);
		$stmt->bindValue(':updated'	 , DATETIME_NOW			 , PDO::PARAM_STR);
		$stmt->bindValue(':id'			 , $id							 , PDO::PARAM_INT);
		return $this->execute($stmt);
	}

	public function alterWorkStatusProcess($id, $started, $finished)
	{
		$status = ($finished === DATETIME_ZERO) ? 'started' : 'finished';
		$sql = "UPDATE {$this->tables['works']} SET
				status = :status, started_at = :started, finished_at = :finished, updated_at = :updated
				WHERE id = :id LIMIT 1";
		$stmt = $this->prepare($sql);
		$stmt->bindValue(':status'	, $status			, PDO::PARAM_STR);
		$stmt->bindValue(':started'	, $started		, PDO::PARAM_STR);
		$stmt->bindValue(':finished', $finished		, PDO::PARAM_STR);
		$stmt->bindValue(':updated'	, DATETIME_NOW, PDO::PARAM_STR);
		$stmt->bindValue(':id'			, $id					, PDO::PARAM_INT);
		return $this->execute($stmt);
	}

	public function alterWorkStatus($id, $status)
	{
		$arrayStatus = array(
			'closed'   => 'closed_at',
			'cancelled'=> 'cancelled_at'
		);

		if( array_key_exists($status, $arrayStatus) )
		{
			$false = $status === 'closed' ? 'cancelled' : 'closed';
			$columnZero  = $arrayStatus[$false];
			$columnAlter = $arrayStatus[$status];
			$sql = "UPDATE {$this->tables['works']} SET
				    status = :status, {$columnZero} = :columnZero, {$columnAlter} = :columnAlter, updated_at = :updated
				    WHERE id = :id LIMIT 1";
			$stmt = $this->prepare($sql);
			$stmt->bindValue(':columnZero' , DATETIME_ZERO, PDO::PARAM_STR);
			$stmt->bindValue(':columnAlter', DATETIME_NOW, PDO::PARAM_STR);
			$stmt->bindValue(':updated', DATETIME_NOW, PDO::PARAM_STR);
			$stmt->bindValue(':status', $status, PDO::PARAM_STR);
			$stmt->bindValue(':id', $id, PDO::PARAM_INT);
			$this->updateWorksOpenCount();
			return $this->execute($stmt);
		}
		return false;
	}

	public function alterWorkStatusPending($id)
	{
		$sql = "UPDATE {$this->tables['works']} SET
				status = :pending, updated_at = :updated
				WHERE id = :id LIMIT 1";
		$stmt = $this->prepare($sql);
		$stmt->bindValue(':pending', 'pending', PDO::PARAM_STR);
		$stmt->bindValue(':updated', DATETIME_NOW, PDO::PARAM_STR);
		$stmt->bindValue(':id', $id, PDO::PARAM_INT);
		$this->updateWorksOpenCount();
		return $this->execute($stmt);
	}

	public function deleteWork($id)
	{
		$sql = "DELETE FROM {$this->tables['works']} WHERE id = :id LIMIT 1";
		$stmt = $this->prepare($sql);
		$stmt->bindValue(':id', $id, PDO::PARAM_INT);
		return $this->execute($stmt);
	}

	private function updateWorksOpenCount()
  {
		$datetimeZero = DATETIME_ZERO;
		$sql = "SELECT COUNT(*) AS 'count' FROM {$this->tables['works']}
                WHERE closed_at = '{$datetimeZero}' AND cancelled_at = '{$datetimeZero}'
				OR status = 'pending'";
		$result = $this->query($sql);
		$route = VIEWS.'/app/counters';
        $file = 'works.txt';
		# $result = $worksClosed - $worksCancelled;
        return Explorer::putContent($route, $file, $result[0]['count']);
  }

	public function prioritizeWorks($post)
  {
		if(isset($post['priorities']) && count($post['priorities']))
		{
			foreach($post['priorities'] as $key => $value)
			{
				$priority = (int) $value;
				$id = (int) $key;
                $sql = "UPDATE {$this->tables['works']} SET priority = :priority WHERE id = :id LIMIT 1";
				$stmt = $this->prepare($sql);
				$stmt->bindParam(':priority', $priority, PDO::PARAM_INT);
				$stmt->bindParam(':id', $id, PDO::PARAM_INT);
				$result = $this->execute($stmt);
			}
			return $result;
		}
		return false;
  }
}
