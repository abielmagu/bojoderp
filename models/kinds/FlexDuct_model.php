<?php

class FlexDuctModel extends Model
{
	private $table 			= PREFIX.'_works_flex_duct';
	private $tableDucts = PREFIX.'_works_flex_duct_ducts?';

	public function create($idwork, $post)
	{
		$ducts = $this->stringifyDucts($post['letters'], $post['meassures']);
		$sql = "INSERT INTO {$this->table} (id_work, plenum, tape_feets, ducts)
						VALUES (:idwork, :plenum, :tapeFeets, :ducts)";
		$stmt = $this->prepare($sql);
		$stmt->bindValue(':idwork'	 , $idwork					 , PDO::PARAM_INT);
		$stmt->bindValue(':plenum'	 , $post['plenum']	 , PDO::PARAM_STR);
		$stmt->bindValue(':tapeFeets', $post['tapeFeets'], PDO::PARAM_STR);
		$stmt->bindValue(':ducts'		 , $ducts						 , PDO::PARAM_STR);
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
		$removes = isset($post['removes']) ? $post['removes'] : array();
		$ducts = $this->stringifyDucts($post['letters'], $post['meassures'], $removes);
		$sql = "UPDATE {$this->table} SET plenum = :plenum, tape_feets = :tapeFeets, ducts = :ducts WHERE id = :id LIMIT 1";
		$stmt = $this->prepare($sql);
		$stmt->bindValue(':id'	 		 , $id					 		 , PDO::PARAM_INT);
		$stmt->bindValue(':plenum'	 , $post['plenum']	 , PDO::PARAM_STR);
		$stmt->bindValue(':tapeFeets', $post['tapeFeets'], PDO::PARAM_STR);
		$stmt->bindValue(':ducts'		 , $ducts						 , PDO::PARAM_STR);
		return $this->execute($stmt);
	}

	public function delete()
	{
		#code
	}

	private function stringifyDucts($letters, $meassures, $removes = [])
	{
		$ducts = array();
		$ductsCount = count($letters);
		for($i = 0; $i < $ductsCount; $i++)
		{
			if( !in_array($i, $removes) )
			{
				$duct = $letters[$i].':'.$meassures[$i];
				array_push($ducts, $duct);
			}
		}
		return implode(',', $ducts);
	}
}
