<?php

class WallFurnanceModel extends Model
{
	private $table = PREFIX.'_works_wall_furnance';

	public function create($idwork, $post)
	{
		$sql = "INSERT INTO {$this->table} (id_work, number_serial, model)
						VALUES (:idwork, :serial, :model)";
		$stmt = $this->prepare($sql);
		$stmt->bindValue(':idwork', $idwork				 , PDO::PARAM_INT);
		$stmt->bindValue(':serial', $post['serial'], PDO::PARAM_STR);
		$stmt->bindValue(':model'	, $post['model'] , PDO::PARAM_STR);
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
		$cover_date = ( isset($post['cover_date']) && !empty($post['cover_date'])) ? $post['cover_date'] : DATE_ZERO;
		$cover_time = $post['cover_time'];
		$cover_at = $cover_date.' '.$cover_time;

		$sql = "UPDATE {$this->table} SET number_serial = :serial, model = :model, cover_at = :cover
						WHERE id = :id LIMIT 1";
		$stmt = $this->prepare($sql);
		$stmt->bindValue(':id'	 	, $id						 , PDO::PARAM_INT);
		$stmt->bindValue(':serial', $post['serial'], PDO::PARAM_STR);
		$stmt->bindValue(':model' , $post['model'] , PDO::PARAM_STR);
		$stmt->bindValue(':cover' , $cover_at 		 , PDO::PARAM_STR);
		return $this->execute($stmt);
	}
}
