<?php

class ClientModel extends Model
{
  public function __construct(){ parent::__construct(); }

  public function getClient($id)
  {
    $sql = "SELECT id, name, lastname, address, zip, state, city, phone, email, notes
            FROM {$this->tables['clients']} WHERE id = :id LIMIT 1";
		$stmt = $this->prepare($sql);
		$stmt->bindValue(':id', $id, PDO::PARAM_INT);
		return $this->execute($stmt, 'fetch');
  }
	
  public function getClients()
  {
    $sql_works = "SELECT c.id, c.name, c.lastname, c.address, c.zip, c.city, c.state, c.phone, c.email,
									COUNT(w.id_client) AS 'works_count'
									FROM {$this->tables['clients']} AS c
									LEFT JOIN {$this->tables['works']} AS w
									ON c.id = w.id_client
									GROUP BY c.id, w.id_client
									ORDER BY c.id DESC
									LIMIT 25";
		$sql = "SELECT id, name, lastname, address, zip, city, state, phone, email 
						FROM {$this->tables['clients']} ORDER BY id DESC";
    return $this->query($sql);
  }
	
	public function getClientsCount()
	{
		return $this->getTableCount($this->tables['clients']);
	}
	
	public function getClientsPagination($start, $limit)
	{
		$sql = "SELECT id, name, lastname, address, zip, city, state, phone, email 
						FROM {$this->tables['clients']} ORDER BY id DESC LIMIT {$start}, {$limit}";
		return $this->query($sql);
	}
	
	public function searchClient($value, $column)
	{
		$sql = "SELECT * FROM {$this->tables['clients']} WHERE {$column} LIKE '%{$value}%'";
		return $this->query($sql);
	}
	
  public function createClient($post)
	{
		$sql = "INSERT INTO {$this->tables['clients']} (name, lastname, address, zip, city, state, phone, email, notes, created_at) 
						VALUES (:name, :lastname, :address, :zip, :city, :state, :phone, :email, :notes, :created)";
		$stmt = $this->prepare($sql);
		$stmt->bindValue(':name'		, $post['name']		 , PDO::PARAM_STR);
		$stmt->bindValue(':lastname', $post['lastname'], PDO::PARAM_STR);
		$stmt->bindValue(':address'	, $post['address'] , PDO::PARAM_STR);
		$stmt->bindValue(':zip'			, $post['zip']		 , PDO::PARAM_STR);
		$stmt->bindValue(':city'		, $post['city']		 , PDO::PARAM_STR);
		$stmt->bindValue(':state'		, $post['state']	 , PDO::PARAM_STR);
		$stmt->bindValue(':phone'		, $post['phone']	 , PDO::PARAM_STR);
		$stmt->bindValue(':email'		, $post['email']	 , PDO::PARAM_STR);
		$stmt->bindValue(':notes'		, $post['notes']	 , PDO::PARAM_STR);
		$stmt->bindValue(':created'	, DATETIME_NOW		 , PDO::PARAM_STR);
		return $this->execute($stmt);
	}

  public function updateClient($id, $post)
  {
		$sql = "UPDATE {$this->tables['clients']} 
						SET name = :name, lastname = :lastname, address = :address, zip = :zip, city = :city, state = :state, phone = :phone, email = :email, notes = :notes, updated_at = :updated  
						WHERE id = :id LIMIT 1";
		$stmt = $this->prepare($sql);
		$stmt->bindValue(':name'		, $post['name']		 , PDO::PARAM_STR);
		$stmt->bindValue(':lastname', $post['lastname'], PDO::PARAM_STR);
		$stmt->bindValue(':address'	, $post['address'] , PDO::PARAM_STR);
		$stmt->bindValue(':zip'			, $post['zip']		 , PDO::PARAM_STR);
		$stmt->bindValue(':city'		, $post['city']		 , PDO::PARAM_STR);
		$stmt->bindValue(':state'		, $post['state']	 , PDO::PARAM_STR);
		$stmt->bindValue(':phone'		, $post['phone']	 , PDO::PARAM_STR);
		$stmt->bindValue(':email'		, $post['email']	 , PDO::PARAM_STR);
		$stmt->bindValue(':notes'		, $post['notes']	 , PDO::PARAM_STR);
		$stmt->bindValue(':updated'	, DATETIME_NOW		 , PDO::PARAM_STR);
		$stmt->bindValue(':id'			, $id							 , PDO::PARAM_INT);
		return $this->execute($stmt);
  }
	
	public function getClientLastInsert()
	{
		return $this->getLastInsertId();
	}
}