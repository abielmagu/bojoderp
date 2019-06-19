<?php

class WeatherzationModel extends Model
{
	private $table 		 		 = PREFIX.'_works_weatherzation';
	private $tableProducts = PREFIX.'_works_weatherzation_products';

	public function create($idwork, $post)
	{
		$sql = "INSERT INTO {$this->table} (id_work, products)
						VALUES (:idwork, :products)";
		$stmt = $this->prepare($sql);
		$stmt->bindValue(':idwork'  , $idwork			 	   , PDO::PARAM_INT);
		$stmt->bindValue(':products', $post['products'], PDO::PARAM_STR);
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
		$sql = "UPDATE {$this->table} SET products = :products WHERE id = :id LIMIT 1";
		$stmt = $this->prepare($sql);
		$stmt->bindValue(':id'	    , $id					     , PDO::PARAM_INT);
		$stmt->bindValue(':products', $post['products'], PDO::PARAM_STR);
		return $this->execute($stmt);
	}
}
