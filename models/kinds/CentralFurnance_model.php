<?php

class CentralFurnanceModel extends Model
{
	private $table = PREFIX.'_works_central_furnance';

	public function create($idwork, $post)
	{
		$sql = "INSERT INTO {$this->table} (id_work, serial_number, model, tons, kind, platform)
						VALUES (:idwork, :serialnumber, :model, :tons, :kindcentral, :platform)";
		$stmt = $this->prepare($sql);
		$stmt->bindValue(':idwork'			, $idwork					 		, PDO::PARAM_INT);
		$stmt->bindValue(':serialnumber', $post['serial']	 		, PDO::PARAM_STR);
		$stmt->bindValue(':model'				, $post['model']	 		, PDO::PARAM_STR);
		$stmt->bindValue(':tons'				, $post['tons']		 		, PDO::PARAM_STR);
		$stmt->bindValue(':kindcentral'	, $post['kindcentral'], PDO::PARAM_STR);
		$stmt->bindValue(':platform'		, $post['platform']		, PDO::PARAM_STR);
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
		$sql = "UPDATE {$this->table} SET
						serial_number = :serialnumber, model = :model, tons = :tons, kind = :kindcentral, platform = :platform
						WHERE id = :id LIMIT 1";
		$stmt = $this->prepare($sql);
		$stmt->bindValue(':id'					, $id					 		 		, PDO::PARAM_INT);
		$stmt->bindValue(':serialnumber', $post['serial']	 		, PDO::PARAM_STR);
		$stmt->bindValue(':model'				, $post['model']	 		, PDO::PARAM_STR);
		$stmt->bindValue(':tons'				, $post['tons']		 		, PDO::PARAM_STR);
		$stmt->bindValue(':kindcentral'	, $post['kindcentral'], PDO::PARAM_STR);
		$stmt->bindValue(':platform'		, $post['platform']		, PDO::PARAM_STR);
		return $this->execute($stmt);
	}

	public function delete()
	{
		#code
	}
}
