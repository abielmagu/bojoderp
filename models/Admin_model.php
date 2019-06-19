<?php

class AdminModel extends Model
{
  public function __construct(){ parent::__construct(); }
	
	public function getAdmin($id)
	{
		$sql = "SELECT id, enabled, kind, name, updated_at FROM {$this->tables['users']}
						WHERE id = :id LIMIT 1";
		$stmt = $this->prepare($sql);
		$stmt->bindValue(':id', $id, PDO::PARAM_INT);
		return $this->execute($stmt, 'fetch');
	}
	
	public function getAdmins($kinds = ["'admin'","'coord'"])
	{
		$id = Session::get('id');
		$values = implode(',', $kinds);
		$sql = "SELECT id, enabled, kind, name, updated_at FROM {$this->tables['users']} 
						WHERE kind IN	({$values}) AND id != {$id} ORDER BY enabled DESC, kind";
		return $this->query($sql);
	}
	
	public function createAdmin($post)
	{
		# Code
	}
	
	public function updateAdmin($id, $post)
	{
			$sql = "UPDATE {$this->tables['users']} SET enabled = 1, kind = :kind, updated_at = :updated 
							WHERE id = :id LIMIT 1";
			$stmt = $this->prepare($sql);
			$stmt->bindValue(':kind'	 , $post['kind'], PDO::PARAM_STR);
			$stmt->bindValue(':updated', DATETIME_NOW , PDO::PARAM_STR);
			$stmt->bindValue(':id'		 , $id					, PDO::PARAM_INT);
			return $this->execute($stmt);
	}
}
