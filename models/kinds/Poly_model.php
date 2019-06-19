<?php

class PolyModel extends Model
{
	# After: PREPARATION
	private $table = PREFIX.'_works_poly';

	public function create($idwork, $post)
	{
		$sql = "INSERT INTO {$this->table} (id_work, name) VALUES (:idwork, :name)";
		$stmt = $this->prepare($sql);
		$stmt->bindValue(':idwork', $idwork			 , PDO::PARAM_INT);
		$stmt->bindValue(':name'  , $post['name'], PDO::PARAM_STR);
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
		$sql = "UPDATE {$this->table} SET name = :name WHERE id = :id LIMIT 1";
		$stmt = $this->prepare($sql);
		$stmt->bindValue(':id'	 , $id					, PDO::PARAM_INT);
		$stmt->bindValue(':name' , $post['name'], PDO::PARAM_STR);
		return $this->execute($stmt);
	}
}
