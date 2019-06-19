<?php

class InspectionModel extends Model
{
  public function __construct(){ parent::__construct(); }

  public function getInspection($id)
  {
    $sql = "SELECT i.id, i.id_work, i.name_by, i.notes, i.observations, i.approval, i.scheduled_at, i.inspected_at,
            w.kind, c.id AS 'idclient', c.name, c.lastname, c.address, c.zip, c.city, c.state
            FROM {$this->tables['inspections']} AS i
            INNER JOIN {$this->tables['works']} As w
            ON i.id_work = w.id
            INNER JOIN {$this->tables['clients']} AS c
            ON w.id_client = c.id
            WHERE i.id = :id LIMIT 1";
		$stmt = $this->prepare($sql);
		$stmt->bindValue(':id', $id, PDO::PARAM_INT);
		return $this->execute($stmt, 'fetch');
  }

  public function getInspections($date)
  {
    $sql = "SELECT i.id, i.id_work, i.name_by, i.notes, i.observations, i.approval, i.scheduled_at, i.inspected_at,
            w.kind, c.id AS 'idclient', c.name, c.lastname, c.address, c.zip, c.city, c.state
            FROM {$this->tables['inspections']} AS i
            INNER JOIN {$this->tables['works']} AS w
            ON i.id_work = w.id
            INNER JOIN {$this->tables['clients']} c
            ON w.id_client = c.id
            WHERE i.scheduled_at = '{$date}'
						ORDER BY i.scheduled_at DESC";
		# OR i.scheduled_at < '{$date}' AND i.approval = 'on hold'
    # WHERE CAST( i.scheduled_at AS DATE ) <= '$dateNow'
    return $this->query($sql);
  }

  public function getInspectionsPendings()
  {
		$DATE_NOW = DATE_NOW;
    $DATETIME_ZERO = DATETIME_ZERO;
    $sql = "SELECT i.id, i.id_work, i.approval, i.inspected_at, i.scheduled_at, w.kind, c.address, c.zip, c.city, c.state
            FROM {$this->tables['inspections']} AS i
            INNER JOIN {$this->tables['works']} AS w
            ON i.id_work = w.id
            INNER JOIN {$this->tables['clients']} AS c
            ON w.id_client = c.id
            WHERE i.inspected_at = '{$DATETIME_ZERO}' AND i.scheduled_at < '{$DATE_NOW}'
            ORDER BY i.scheduled_at DESC";
    return $this->query($sql);
  }

	public function getInspectionsByPeriod($dateStart, $dateEnd)
	{
		$sql = "SELECT * FROM {$this->tables['inspections']}
						WHERE scheduled_at >= '{$dateStart}' AND scheduled_at <= '{$dateEnd}'
						ORDER BY YEAR(scheduled_at) DESC";
		return $this->query($sql);
	}

	public function getInspectionsWork($id)
	{
		$sql = "SELECT * FROM {$this->tables['inspections']} WHERE id_work = {$id}";
		return $this->query($sql);
	}

	public function getWorkAddInspection($id)
	{
		$modelWork = Getter::model('work');
		return $modelWork->getWork($id);
	}

  /*******************************************************************************************/

  public function createInspection($post)
  {
		$sql = "INSERT INTO {$this->tables['inspections']}
						(id_work, name_by, notes, scheduled_at, created_at)
						VALUES
						(:idwork, :nameby, :notes, :scheduled, :created)";
		$stmt = $this->prepare($sql);
		$stmt->bindValue(':idwork'	 , $post['needle']	 , PDO::PARAM_INT);
		$stmt->bindValue(':nameby'	 , $post['nameby']	 , PDO::PARAM_STR);
		$stmt->bindValue(':notes'		 , $post['notes']		 , PDO::PARAM_STR);
		$stmt->bindValue(':scheduled', $post['scheduled'], PDO::PARAM_STR);
		$stmt->bindValue(':created'	 , DATETIME_NOW	  	 , PDO::PARAM_STR);
		$result = $this->execute($stmt);
		$this->updateInspectionsOpenCount();
		return $result;
  }

  public function updateInspection($id, $post)
  {
    $inspected = ( $post['approval'] === 'on hold' ) ? DATETIME_ZERO : DATETIME_NOW;
		$sql = "UPDATE {$this->tables['inspections']}
						SET name_by = :nameby, notes = :notes, observations = :observations, approval = :approval, scheduled_at = :scheduled, inspected_at = :inspected
						WHERE id = :id LIMIT 1";
		$stmt = $this->prepare($sql);
		$stmt->bindValue(':nameby'			, $post['nameby']			 , PDO::PARAM_STR);
		$stmt->bindValue(':notes'				, $post['notes']			 , PDO::PARAM_STR);
		$stmt->bindValue(':observations', $post['observations'], PDO::PARAM_STR);
		$stmt->bindValue(':approval'		, $post['approval']		 , PDO::PARAM_STR);
		$stmt->bindValue(':scheduled'		, $post['scheduled']	 , PDO::PARAM_STR);
		$stmt->bindValue(':inspected'		, $inspected			 		 , PDO::PARAM_STR);
		$stmt->bindValue(':id'					, $id	 								 , PDO::PARAM_INT);
		$result = $this->execute($stmt);
		$this->updateInspectionsOpenCount();
		return $result;
  }

  private function updateInspectionsOpenCount()
  {
		$sql = "SELECT COUNT(*) AS 'count' FROM {$this->tables['inspections']} WHERE inspected_at = :inspected";
		$stmt = $this->prepare($sql);
		$stmt->bindValue(':inspected', DATETIME_ZERO, PDO::PARAM_STR);
		$opened = $this->execute($stmt, 'fetch');
		$route = VIEWS.'/app/counters';
		$file	 = 'inspections.txt';
		return Explorer::putContent($route, $file, $opened['count']);
  }
}
