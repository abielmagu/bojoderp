<?php

class RoughEndModel extends Model
{
	private $table = PREFIX.'_works_rough_end';

	public function create($idwork, $post)
	{
		$sql = "INSERT INTO {$this->table} (id_work) VALUES (:idwork)";
		$stmt = $this->prepare($sql);
		$stmt->bindValue(':idwork', $idwork, PDO::PARAM_INT);
		// $stmt->bindValue(':name'  , $post['name'], PDO::PARAM_STR);
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
		return true;
		
		$sql = "UPDATE {$this->table} SET name = :name WHERE id = :id LIMIT 1";
		$stmt = $this->prepare($sql);
		$stmt->bindValue(':id'	, $id, PDO::PARAM_INT);
		$stmt->bindValue(':name', $post['name'], PDO::PARAM_STR);
		return $this->execute($stmt);
	}
}
