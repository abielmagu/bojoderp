<?php

class NettingModel extends Model
{
	private $table = PREFIX.'_works_netting';

	public function create($idwork, $post)
	{
		$sql = "INSERT INTO {$this->table} (id_work, square_feets, attic, wall)
						VALUES (:idwork, :sqfts, :attic, :wall)";
		$stmt = $this->prepare($sql);
		$stmt->bindValue(':idwork', $idwork				, PDO::PARAM_INT);
		$stmt->bindValue(':sqfts' , $post['sqfts'], PDO::PARAM_STR);
		$stmt->bindValue(':attic' , $post['attic'], PDO::PARAM_STR);
		$stmt->bindValue(':wall' 	, $post['wall'] , PDO::PARAM_STR);
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
						SET square_feets = :sqfts, attic = :attic, wall = :wall
						WHERE id = :id LIMIT 1";
		$stmt = $this->prepare($sql);
		$stmt->bindValue(':id'		, $id						, PDO::PARAM_INT);
		$stmt->bindValue(':sqfts' , $post['sqfts'], PDO::PARAM_STR);
		$stmt->bindValue(':attic' , $post['attic'], PDO::PARAM_STR);
		$stmt->bindValue(':wall' 	, $post['wall'] , PDO::PARAM_STR);
		return $this->execute($stmt);
	}

	public function delete()
	{
		#code
	}
}
