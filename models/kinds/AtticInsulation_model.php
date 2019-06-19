<?php

class AtticInsulationModel extends Model
{
	private $table = PREFIX.'_works_attic_insulation';

	public function create($idwork, $post)
	{
		$sql = "INSERT INTO {$this->table} (id_work, method, rvalue, square_feets, bags)
						VALUES (:idwork, :method, :rvalue, :square_feets, :bags)";
		$stmt = $this->prepare($sql);
		$stmt->bindValue(':method'			, $post['method'], PDO::PARAM_STR);
		$stmt->bindValue(':rvalue'			,	$post['rvalue'], PDO::PARAM_STR);
		$stmt->bindValue(':square_feets', $post['sqfts'] , PDO::PARAM_STR);
		$stmt->bindValue(':bags'				, $post['bags']	 , PDO::PARAM_STR);
		$stmt->bindValue(':idwork'			, $idwork				 , PDO::PARAM_INT);
		return $this->execute($stmt);
	}

	public function read($id)
	{
		$sql = "SELECT * FROM {$this->table} WHERE id_work = :id";
		$stmt = $this->prepare($sql);
		$stmt->bindValue(':id', $id, PDO::PARAM_INT);
		return $this->execute($stmt, 'fetch');
	}

	public function update($id, $post)
	{
		$post['bags'] = (int) $post['bags'];
		$sql = "UPDATE {$this->table} SET
						method = :method, rvalue = :rvalue, square_feets = :sqfts, bags = :bags
						WHERE id = :id LIMIT 1";
		$stmt = $this->prepare($sql);
		$stmt->bindValue(':method', $post['method'], PDO::PARAM_STR);
		$stmt->bindValue(':rvalue', $post['rvalue'], PDO::PARAM_STR);
		$stmt->bindValue(':sqfts'	, $post['sqfts'] , PDO::PARAM_STR);
		$stmt->bindValue(':bags'	, $post['bags']	 , PDO::PARAM_INT);
		$stmt->bindValue(':id'		, $id				 		 , PDO::PARAM_INT);
		return $this->execute($stmt);
	}

	public function delete()
	{
		#code
	}

	public function getAtticsByPeriod($dateStart, $dateEnd)
	{
		$sql = "SELECT w.scheduled_at, w.kind, w.status, a.* FROM {$this->tables['works']} AS w
						INNER JOIN {$this->table} AS a
						ON w.id = a.id_work
						WHERE w.kind = 'attic_insulation'
						AND w.scheduled_at >= '{$dateStart}' AND w.scheduled_at <= '{$dateEnd}'";
		return $this->query($sql);
	}
}
