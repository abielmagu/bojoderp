<?php

class ClosedModel extends Model
{
	private $table = PREFIX.'_works_closed';

	public function create($idwork, $post)
	{
		$sql 	= "INSERT INTO {$this->table} (id_work) VALUES (:idwork)";
		$stmt = $this->prepare($sql);
		$stmt->bindValue(':idwork', $idwork, PDO::PARAM_INT);
		if( $this->execute($stmt) )
		{
			$sql = "UPDATE {$this->tables['works']} SET
							status = :status, closed_at = :closed
							WHERE id = :id LIMIT 1";
			$stmt = $this->prepare($sql);
			$stmt->bindValue(':status', 'closed'					, PDO::PARAM_STR);
			$stmt->bindValue(':closed', $post['scheduled'], PDO::PARAM_STR);
			$stmt->bindValue(':id'		, $idwork					 	, PDO::PARAM_INT);
			return $this->execute($stmt);
		}
		return false;
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
		return true;
	}

	public function delete($id)
	{
		#code
	}
}
