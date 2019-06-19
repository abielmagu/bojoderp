<?php

class MinisplitModel extends Model
{
	private $table 		 	 = PREFIX.'_works_minisplit';
	private $tablePieces = PREFIX.'_works_minisplit_pieces';

	public function create($idwork, $post)
	{
		$sql = "INSERT INTO {$this->table} (id_work, permit_serial) VALUES (:idwork, :permitSerial)";
		$stmt = $this->prepare($sql);
		$stmt->bindValue(':idwork'			, $idwork							 , PDO::PARAM_INT);
		$stmt->bindValue(':permitSerial', $post['permitSerial'], PDO::PARAM_STR);
		if( $result = $this->execute($stmt) )
		{
			$idms = $this->getLastInsertId();
			$pieces = $this->compressPieces($post);
			if( !$result = $this->addPieces($idms, $pieces) )
			{
				$this->delete($idms);
			}
		}
		return $result;
	}

	public function read($id)
	{
		$ms = $this->getMinisplit($id);
		$idms = (int) $ms['id'];
		$ms['pieces'] = $this->getPieces($idms);
		return $ms;
	}

	private function getMinisplit($id)
	{
		$sql = "SELECT * FROM {$this->table} WHERE id_work = :id";
		$stmt = $this->prepare($sql);
		$stmt->bindValue(':id', $id, PDO::PARAM_INT);
		return $this->execute($stmt, 'fetch');
	}

	public function update($id, $post)
	{
		$sql = "UPDATE {$this->table} SET permit_serial = :permitSerial WHERE id = :id LIMIT 1";
		$stmt = $this->prepare($sql);
		$stmt->bindValue(':id'				  , $id									 , PDO::PARAM_INT);
		$stmt->bindValue(':permitSerial', $post['permitSerial'], PDO::PARAM_STR);
		if( $result = $this->execute($stmt) )
		{
			if( isset($post['setPieces']) )
			{
				$result = $this->setAllPieces($post['setPieces']);
			}

			if( isset($post['kinds']) )
			{
				$pieces = $this->compressPieces($post);
				$result = $this->addPieces($id, $pieces);
			}
		}
		return $result;
	}

	public function delete($idms)
	{
		$sql = "DELETE FROM {$this->table} WHERE id = :id LIMIT 1";
		$stmt = $this->prepare($sql);
		$stmt->bindValue(':id', $idms, PDO::PARAM_INT);
		return $this->execute($stmt);
	}

	private function addPieces($idms, $pieces)
	{
		$piecesCount = count($pieces['kinds']);
		$sql = "INSERT INTO {$this->tablePieces}
						(id_minisplit, kind, number_serial, brand, placement)
						VALUES
						(:idms, :kind, :numberSerial, :brand, :placement)";
		$stmt = $this->prepare($sql);
		for($i = 0; $i < $piecesCount; $i++)
		{
			$stmt->bindParam(':idms'		 		, $idms										 , PDO::PARAM_INT);
			$stmt->bindParam(':kind'		 		, $pieces['kinds'][$i]		 , PDO::PARAM_STR);
			$stmt->bindParam(':numberSerial', $pieces['serials'][$i]	 , PDO::PARAM_STR);
			$stmt->bindParam(':brand'				, $pieces['brands'][$i]		 , PDO::PARAM_STR);
			$stmt->bindParam(':placement'		, $pieces['placements'][$i], PDO::PARAM_STR);

			if( !$result = $this->execute($stmt) )
			{
				$this->removeAllPieces($idms);
				break;
			}
		}
		return $result;
	}

	private function getPieces($idms)
	{
		$sql = "SELECT * FROM {$this->tablePieces} WHERE id_minisplit = {$idms}";
		return $this->query($sql);
	}

	private function setAllPieces($pieces)
	{
		foreach($pieces as $piece)
		{
			$id = (int) $piece['needle'];
			if( !isset($piece['remove']) )
			{
				$result = $this->updatePiece($id, $piece['kind'], $piece['serial'], $piece['brand'], $piece['placement']);
			}
			else
			{
				$result = $this->removePiece($id);
			}
		}
		return $result;
	}

	private function updatePiece($id, $kind, $serial, $brand, $placement)
	{
		$sql = "UPDATE {$this->tablePieces} SET
						kind = :kind, number_serial = :numberSerial, brand = :brand, placement = :placement
						WHERE id = :id LIMIT 1";
		$stmt = $this->prepare($sql);
		$stmt->bindValue(':id'					, $id				, PDO::PARAM_INT);
		$stmt->bindValue(':kind'				, $kind			, PDO::PARAM_STR);
		$stmt->bindValue(':numberSerial', $serial		, PDO::PARAM_STR);
		$stmt->bindValue(':brand'				, $brand		, PDO::PARAM_STR);
		$stmt->bindValue(':placement'		, $placement, PDO::PARAM_STR);
		return $this->execute($stmt);
	}

	private function removePiece($id)
	{
		$sql = "DELETE FROM {$this->tablePieces} WHERE id = :id";
		$stmt = $this->prepare($sql);
		$stmt->bindValue(':id', $id, PDO::PARAM_INT);
		return $this->execute($stmt);
	}

	private function removeAllPieces($idms)
	{
		$sql = "DELETE FROM {$this->tablePieces} WHERE id_minisplit = :idms";
		$stmt = $this->prepare($sql);
		$stmt->bindValue(':idms', $idms, PDO::PARAM_INT);
		return $this->execute($stmt);
	}

	private function compressPieces($post)
	{
		$pieces = array();
		$pieces['kinds'] 			= $post['kinds'];
		$pieces['serials'] 		= $post['serials'];
		$pieces['brands'] 		= $post['brands'];
		$pieces['placements'] = $post['placements'];
		return $pieces;
	}
}
