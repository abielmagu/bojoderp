<?php

class WarrantyModel extends Model
{
  public function __construct(){ parent::__construct(); }

  public function getWarranty($id)
  {
    $sql = "SELECT g.id, g.id_work, g.id_crew, g.repairers, g.issues, g.solutions, g.status, g.scheduled_at, g.solved_at,
            w.scheduled_at AS 'scheduled_work', w.kind, c.name, c.lastname, c.address, c.zip, c.city, c.state
            FROM {$this->tables['guarantees']} AS g
            INNER JOIN {$this->tables['works']} AS w
            ON g.id_work = w.id
            INNER JOIN {$this->tables['clients']} AS c
            ON w.id_client = c.id
            WHERE g.id = :id LIMIT 1";
		$stmt = $this->prepare($sql);
		$stmt->bindValue(':id', $id, PDO::PARAM_INT);
    return $this->execute($stmt, 'fetch');
  }

	public function getGuarantees($date)
	{
		$sql = "SELECT g.id, g.id_work, g.id_crew, g.repairers, g.issues, g.solutions, g.status, g.scheduled_at, g.solved_at,
						w.scheduled_at AS 'scheduled_work', w.kind, c.name, c.lastname, c.address, c.zip, c.city, c.state
						FROM {$this->tables['guarantees']} AS g
						INNER JOIN {$this->tables['works']} AS w
						ON g.id_work = w.id
						INNER JOIN {$this->tables['clients']} AS c
						ON w.id_client = c.id
						WHERE g.scheduled_at = '{$date}'
						ORDER BY g.scheduled_at DESC";
		# OR g.scheduled_at < '{$date}' AND g.status != 'done'
		# CAST( g.scheduled_date AS DATE ) = '$dateNow'
		return $this->query($sql);
	}

	public function getGuaranteesPendings()
  {
		$DATE_NOW = DATE_NOW;
    $DATETIME_ZERO = DATETIME_ZERO;
    $sql = "SELECT g.id, g.scheduled_at, w.kind, c.address, c.zip, c.city, c.state
            FROM {$this->tables['guarantees']} AS g
            INNER JOIN {$this->tables['works']} AS w
            ON g.id_work = w.id
            INNER JOIN {$this->tables['clients']} AS c
            ON w.id_client = c.id
            WHERE g.solved_at = '{$DATETIME_ZERO}' AND g.scheduled_at < '{$DATE_NOW}'
            ORDER BY g.scheduled_at DESC";
    return $this->query($sql);
  }

	public function getGuaranteesByPeriod($dateStart, $dateEnd)
	{
		$sql = "SELECT * FROM {$this->tables['guarantees']}
						WHERE scheduled_at >= '{$dateStart}' AND scheduled_at <= '{$dateEnd}'
						ORDER BY YEAR(scheduled_at) DESC";
		return $this->query($sql);
	}

	public function getGuaranteesWork($id)
	{
		$sql = "SELECT * FROM {$this->tables['guarantees']} WHERE id_work = {$id}";
		return $this->query($sql);
	}

	public function getWorkAddWarranty($id)
	{
		$modelWork = Getter::model('work');
		return $modelWork->getWork($id);
	}

  public function createWarranty($post)
  {
		$sql = "INSERT INTO {$this->tables['guarantees']}
						(id_work, id_crew, repairers, issues, scheduled_at, created_at)
						VALUES
						(:idwork, :idcrew, :repairers, :issues, :scheduled, :created)";
		$stmt = $this->prepare($sql);
		$stmt->bindValue(':idwork'	 , $post['needle']	 , PDO::PARAM_INT);
		$stmt->bindValue(':idcrew'	 , 0								 , PDO::PARAM_INT);
		$stmt->bindValue(':repairers', $post['repairers'], PDO::PARAM_STR);
		$stmt->bindValue(':issues'	 , $post['issues']	 , PDO::PARAM_STR);
		$stmt->bindValue(':scheduled', $post['scheduled'], PDO::PARAM_STR);
		$stmt->bindValue(':created'	 , DATETIME_NOW			 , PDO::PARAM_STR);
    #$crewId = (int) $warrantyCrew;
    #id_crew: $crewId - repairer

		$result = $this->execute($stmt);
		$this->updateGuaranteesOpenCount();
		return $result;
  }

  public function updateWarranty($id, $post)
  {
		$solved = ($post['status'] === 'done') ? DATETIME_NOW : DATETIME_ZERO;
		$sql = "UPDATE {$this->tables['guarantees']}
						SET repairers = :repairers, issues = :issues, solutions = :solutions, status = :status, scheduled_at = :scheduled, solved_at = :solved
						WHERE id = :id LIMIT 1";
		$stmt = $this->prepare($sql);
		$stmt->bindValue(':repairers', $post['repairers'], PDO::PARAM_STR);
		$stmt->bindValue(':issues'	 , $post['issues']	 , PDO::PARAM_STR);
		$stmt->bindValue(':solutions', $post['solutions'], PDO::PARAM_STR);
		$stmt->bindValue(':status'	 , $post['status']	 , PDO::PARAM_STR);
		$stmt->bindValue(':scheduled', $post['scheduled'], PDO::PARAM_STR);
		$stmt->bindValue(':solved'	 , $solved					 , PDO::PARAM_STR);
		$stmt->bindValue(':id'			 , $id							 , PDO::PARAM_INT);
		$result = $this->execute($stmt);
		$this->updateGuaranteesOpenCount();
		return $result;
  }

	private function updateGuaranteesOpenCount()
	{
		$sql = "SELECT COUNT(*) AS 'count' FROM {$this->tables['guarantees']} WHERE solved_at = :solved";
		$stmt = $this->prepare($sql);
		$stmt->bindValue(':solved', DATETIME_ZERO, PDO::PARAM_STR);
		$opened = $this->execute($stmt, 'fetch');
		$route = VIEWS.'/app/counters';
		$file	 = 'guarantees.txt';
		return Explorer::putContent($route, $file, $opened['count']);
	}
}
