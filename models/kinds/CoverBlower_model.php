<?php

class CoverBlowerModel extends Model
{
	private $table = PREFIX.'_works_cover_blower';

	public function create($idwork, $post)
	{
		$sql = "INSERT INTO {$this->table} (id_work, cover, blower) VALUES (:idwork, :cover, :blower)";
		$stmt = $this->prepare($sql);
		$stmt->bindValue(':idwork', $idwork				 , PDO::PARAM_INT);
		$stmt->bindValue(':cover'	, $post['cover'] , PDO::PARAM_STR);
		$stmt->bindValue(':blower', $post['blower'], PDO::PARAM_STR);
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
		$sql = "UPDATE {$this->table} SET cover = :cover, blower = :blower WHERE id = :id LIMIT 1";
		$stmt = $this->prepare($sql);
		$stmt->bindValue(':id'		, $id						 , PDO::PARAM_INT);
		$stmt->bindValue(':cover' , $post['cover'] , PDO::PARAM_STR);
		$stmt->bindValue(':blower', $post['blower'], PDO::PARAM_STR);
		return $this->execute($stmt);
	}

	public function delete()
	{
		#code
	}
}
