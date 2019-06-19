<?php

class ServiceModel extends Model
{
	private $table = PREFIX.'_works_service';

	public function create($idwork, $post)
	{
		$sql = "INSERT INTO {$this->table} (id_work, kind, solutions) VALUES (:idwork, :kind, :solutions)";
		$stmt = $this->prepare($sql);
		$stmt->bindValue(':idwork'	 , $idwork						 , PDO::PARAM_INT);
		$stmt->bindValue(':kind'  	 , $post['kindservice'], PDO::PARAM_STR);
		$stmt->bindValue(':solutions', $post['solutions']	 , PDO::PARAM_STR);
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
		$sql = "UPDATE {$this->table} SET kind = :kind, solutions = :solutions WHERE id = :id LIMIT 1";
		$stmt = $this->prepare($sql);
		$stmt->bindValue(':id'	 		 , $id								 , PDO::PARAM_INT);
		$stmt->bindValue(':kind'  	 , $post['kindservice'], PDO::PARAM_STR);
		$stmt->bindValue(':solutions', $post['solutions']	 , PDO::PARAM_STR);
		return $this->execute($stmt);
	}
}
