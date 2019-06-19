<?php

class AirConditionModel extends Model
{
	private $table 		 			 = PREFIX.'_works_air_condition';
	private $tableComponents = PREFIX.'_works_air_condition_components';

	public function create($idwork, $post)
	{
		$sql = "INSERT INTO {$this->table}
		(id_work, complete, type_unit, code_permit, disconnect_box, rewire_condenser, rewire_furnance, reconnect_gas, closet_door, ladder, codes_inspections, done_jurisdiction, warranty_compresor, warranty_evaporator, warranty_heat_exchanger, warranty_labor, warranty_manufacturer, warranty_parts, warranty_maintenance)
		VALUES
		(:idwork, :complete, :typeUnit, :codePermit, :disconnectBox, :rewireCondenser, :rewireFurnance, :reconnectGas, :closetDoor, :ladder, :codesInspections, :doneJurisdiction, :warrantyCompresor, :warrantyEvaporator, :warrantyHeatExchanger, :warrantyLabor, :warrantyManufacturer, :warrantyParts, :warrantyMaintenance)";
		$stmt = $this->prepare($sql);
		$stmt->bindValue(':idwork'							 , $idwork											 , PDO::PARAM_INT);
		$stmt->bindValue(':complete'						 , $post['complete']						 , PDO::PARAM_STR);
		$stmt->bindValue(':typeUnit'						 , $post['typeUnit']						 , PDO::PARAM_STR);
		$stmt->bindValue(':codePermit'					 , $post['codePermit']					 , PDO::PARAM_STR);
		$stmt->bindValue(':disconnectBox'				 , $post['disconnectBox']				 , PDO::PARAM_STR);
		$stmt->bindValue(':rewireCondenser'			 , $post['rewireCondenser']			 , PDO::PARAM_STR);
		$stmt->bindValue(':rewireFurnance'			 , $post['rewireFurnance']			 , PDO::PARAM_STR);
		$stmt->bindValue(':reconnectGas'				 , $post['reconnectGas']				 , PDO::PARAM_STR);
		$stmt->bindValue(':closetDoor'					 , $post['closetDoor']					 , PDO::PARAM_STR);
		$stmt->bindValue(':ladder'							 , $post['ladder']							 , PDO::PARAM_STR);
		$stmt->bindValue(':codesInspections'		 , $post['codesInspections']		 , PDO::PARAM_STR);
		$stmt->bindValue(':doneJurisdiction'		 , $post['doneJurisdiction']		 , PDO::PARAM_STR);
		$stmt->bindValue(':warrantyCompresor'		 , $post['warrantyCompresor']		 , PDO::PARAM_STR);
		$stmt->bindValue(':warrantyEvaporator'	 , $post['warrantyEvaporator']	 , PDO::PARAM_STR);
		$stmt->bindValue(':warrantyHeatExchanger', $post['warrantyHeatExchanger'], PDO::PARAM_STR);
		$stmt->bindValue(':warrantyLabor'				 , $post['warrantyLabor']				 , PDO::PARAM_STR);
		$stmt->bindValue(':warrantyManufacturer' , $post['warrantyManufacturer'] , PDO::PARAM_STR);
		$stmt->bindValue(':warrantyParts'				 , $post['warrantyParts']				 , PDO::PARAM_STR);
		$stmt->bindValue(':warrantyMaintenance'	 , $post['warrantyMaintenance']	 , PDO::PARAM_STR);
		if( $this->execute($stmt) )
		{
			$idac = $this->getLastInsertId();
			$components = $this->compressComponents($post);
			if( !$result = $this->addComponents($idac, $components) )
			{
				$this->delete($idac);
			}
			return $result;
		}
		return false;
	}

	public function read($id)
	{
		$aircondition = $this->getAirCondition($id);
		$idac = (int) $aircondition['id'];
		$aircondition['components'] = $this->getComponents($idac);
		return $aircondition;
	}

	private function getAirCondition($id)
	{
		$sql = "SELECT * FROM {$this->table} WHERE id_work = :id";
		$stmt = $this->prepare($sql);
		$stmt->bindValue(':id', $id, PDO::PARAM_INT);
		return $this->execute($stmt, 'fetch');
	}

	public function update($id, $post)
	{
		$sql = "UPDATE {$this->table} SET complete = :complete, type_unit = :typeUnit, code_permit = :codePermit,
		disconnect_box = :disconnectBox, rewire_condenser = :rewireCondenser, rewire_furnance = :rewireFurnance, reconnect_gas = :reconnectGas, closet_door = :closetDoor, ladder = :ladder, codes_inspections = :codesInspections, done_jurisdiction = :doneJurisdiction,
		warranty_compresor = :warrantyCompresor, warranty_evaporator = :warrantyEvaporator, warranty_heat_exchanger = :warrantyHeatExchanger, warranty_labor = :warrantyLabor, warranty_manufacturer = :warrantyManufacturer, warranty_parts = :warrantyParts, warranty_maintenance = :warrantyMaintenance
		WHERE id = :id LIMIT 1";
		$stmt = $this->prepare($sql);
		$stmt->bindValue(':complete'						 , $post['complete']						 , PDO::PARAM_STR);
		$stmt->bindValue(':typeUnit'						 , $post['typeUnit']						 , PDO::PARAM_STR);
		$stmt->bindValue(':codePermit'					 , $post['codePermit']					 , PDO::PARAM_STR);
		$stmt->bindValue(':disconnectBox'				 , $post['disconnectBox']				 , PDO::PARAM_STR);
		$stmt->bindValue(':rewireCondenser'			 , $post['rewireCondenser']			 , PDO::PARAM_STR);
		$stmt->bindValue(':rewireFurnance'			 , $post['rewireFurnance']			 , PDO::PARAM_STR);
		$stmt->bindValue(':reconnectGas'				 , $post['reconnectGas']				 , PDO::PARAM_STR);
		$stmt->bindValue(':closetDoor'					 , $post['closetDoor']					 , PDO::PARAM_STR);
		$stmt->bindValue(':ladder'							 , $post['ladder']							 , PDO::PARAM_STR);
		$stmt->bindValue(':codesInspections'		 , $post['codesInspections']		 , PDO::PARAM_STR);
		$stmt->bindValue(':doneJurisdiction'		 , $post['doneJurisdiction']		 , PDO::PARAM_STR);
		$stmt->bindValue(':warrantyCompresor'		 , $post['warrantyCompresor']		 , PDO::PARAM_STR);
		$stmt->bindValue(':warrantyEvaporator'	 , $post['warrantyEvaporator']	 , PDO::PARAM_STR);
		$stmt->bindValue(':warrantyHeatExchanger', $post['warrantyHeatExchanger'], PDO::PARAM_STR);
		$stmt->bindValue(':warrantyLabor'				 , $post['warrantyLabor']				 , PDO::PARAM_STR);
		$stmt->bindValue(':warrantyManufacturer' , $post['warrantyManufacturer'] , PDO::PARAM_STR);
		$stmt->bindValue(':warrantyParts'				 , $post['warrantyParts']				 , PDO::PARAM_STR);
		$stmt->bindValue(':warrantyMaintenance'	 , $post['warrantyMaintenance']	 , PDO::PARAM_STR);
		$stmt->bindValue(':id'							 		 , $id											 		 , PDO::PARAM_INT);

		if( $result = $this->execute($stmt) )
		{
			$result = $this->setAllComponents($post['setComponents']);

			if( isset($post['addComponentsName']) )
			{
				$components = $this->compressComponents($post);
				$result = $this->addComponents($id, $components);
			}
		}
		return $result;
	}

	public function delete($idac)
	{
		$sql = "DELETE FROM {$this->table} WHERE id = :id LIMIT 1";
		$stmt = $this->prepare($sql);
		$stmt->bindValue(':id', $idac, PDO::PARAM_INT);
		return $this->execute($stmt);
	}

	private function addComponents($idac, $components)
	{
		$componentsCount = count($components);
		$sql = "INSERT INTO {$this->tableComponents} (id_aircondition, name, quantity)
						VALUES (:idac, :name, :quantity)";
		$stmt = $this->prepare($sql);

		for($i = 0; $i < $componentsCount; $i++)
		{
			$stmt->bindParam(':idac'		, $idac		 							 			 , PDO::PARAM_INT);
			$stmt->bindParam(':name'		, $components['names'][$i]		 , PDO::PARAM_STR);
			$stmt->bindParam(':quantity', $components['quantities'][$i], PDO::PARAM_STR);

			if( !$result = $this->execute($stmt) )
			{
				$this->removeAllComponents($idac);
				break;
			}
		}
		return $result;
	}

	private function getComponents($idac)
	{
		$sql = "SELECT * FROM {$this->tableComponents} WHERE id_aircondition = {$idac}";
		return $this->query($sql);
	}

	private function setAllComponents($components)
	{
		foreach($components as $component)
		{
			$id = (int) $component['needle'];
			if( !isset($component['remove']) )
			{
				$result = $this->updateComponent($id, $component['name'], $component['quantity']);
			}
			else
			{
				$result = $this->removeComponent($id);
			}
		}
		return $result;
	}

	private function updateComponent($id, $componentName, $componentQuantity)
	{
		$sql = "UPDATE {$this->tableComponents} SET name = :name, quantity = :quantity WHERE id = :id LIMIT 1";
		$stmt = $this->prepare($sql);
		$stmt->bindValue(':name'		, $componentName		, PDO::PARAM_STR);
		$stmt->bindValue(':quantity', $componentQuantity, PDO::PARAM_STR);
		$stmt->bindValue(':id'			, $id								, PDO::PARAM_INT);
		return $this->execute($stmt);
	}

	private function removeComponent($id)
	{
		$sql = "DELETE FROM {$this->tableComponents} WHERE id = :id";
		$stmt = $this->prepare($sql);
		$stmt->bindValue(':id', $id, PDO::PARAM_INT);
		return $this->execute($stmt);
	}

	private function removeAllComponents($idac)
	{
		$sql = "DELETE FROM {$this->tableComponents} WHERE id_aircondition = :idac";
		$stmt = $this->prepare($sql);
		$stmt->bindValue(':idac', $idac, PDO::PARAM_INT);
		return $this->execute($stmt);
	}

	private function compressComponents($post)
	{
		$components = array();
		$components['names'] 			= $post['addComponentsName'];
		$components['quantities'] = $post['addComponentsQuantity'];
		return $components;
	}
}
