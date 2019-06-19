<?php

class BattInsulationModel extends Model
{
	private $table = PREFIX.'_works_batt_insulation';

	public function create($idwork, $post)
	{
		$sql = "INSERT INTO {$this->table} (id_work, method, rvalue, square_feets, facing, size)
						VALUES (:idwork, :method, :rvalue, :sqfts, :facing, :size)";
		$stmt = $this->prepare($sql);
		$stmt->bindValue(':idwork', $idwork				 , PDO::PARAM_INT);
		$stmt->bindValue(':method', $post['method'], PDO::PARAM_STR);
		$stmt->bindValue(':rvalue', $post['rvalue'], PDO::PARAM_STR);
		$stmt->bindValue(':sqfts' , $post['sqfts'] , PDO::PARAM_STR);
		$stmt->bindValue(':facing', $post['facing'], PDO::PARAM_STR);
		$stmt->bindValue(':size'  , $post['size']	 , PDO::PARAM_STR);
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
		$sql = "UPDATE {$this->table}
						SET id = :id, method = :method, rvalue = :rvalue, square_feets = :sqfts, facing = :facing, size = :size
						WHERE id = :id LIMIT 1";
		$stmt = $this->prepare($sql);
		$stmt->bindValue(':id'		, $id						 , PDO::PARAM_INT);
		$stmt->bindValue(':method', $post['method'], PDO::PARAM_STR);
		$stmt->bindValue(':rvalue', $post['rvalue'], PDO::PARAM_STR);
		$stmt->bindValue(':sqfts' , $post['sqfts'] , PDO::PARAM_STR);
		$stmt->bindValue(':facing', $post['facing'], PDO::PARAM_STR);
		$stmt->bindValue(':size'  , $post['size']	 , PDO::PARAM_STR);
		return $this->execute($stmt);
	}

	public function delete()
	{
		# code
	}

	public function getBattsByPeriod($dateStart, $dateEnd)
	{
		$sql = "SELECT w.scheduled_at, w.kind, w.status, a.* FROM {$this->tables['works']} AS w
						INNER JOIN {$this->table} AS a
						ON w.id = a.id_work
						WHERE w.kind = 'batt_insulation'
						AND w.scheduled_at >= '{$dateStart}' AND w.scheduled_at <= '{$dateEnd}'";
		return $this->query($sql);
	}
}
