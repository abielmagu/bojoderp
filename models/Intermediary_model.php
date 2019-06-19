<?php

class IntermediaryModel extends Model
{
  public function __construct(){ parent::__construct(); }

  public function getInterm($id)
  {
    	$sql = "SELECT i.id, i.id_user, i.name, i.nick, i.contact, i.address, i.zip, i.city, i.state, i.phone, i.email, i.notes, u.name AS 'username', u.enabled
              FROM {$this->tables['interms']} AS i
              INNER JOIN {$this->tables['users']} AS u
              ON i.id_user = u.id
              WHERE i.id = :id AND i.destroyed_at = :destroyed";
  	$stmt = $this->prepare($sql);
  	$stmt->bindValue(':destroyed', DATETIME_ZERO, PDO::PARAM_STR);
  	$stmt->bindValue(':id'		 , $id		    , PDO::PARAM_INT);
    return $this->execute($stmt, 'fetch');
  }

  public function getIntermBy($column, $value)
  {
  	$sql = "SELECT * FROM {$this->tables['interms']} WHERE {$column} = :value LIMIT 1";
  	$stmt = $this->prepare($sql);
  	$PDOPARAM = ( is_string($value) ) ? PDO::PARAM_STR : PDO::PARAM_INT;
  	$stmt->bindValue(':value' , $value, $PDOPARAM);
  	return $this->execute($stmt, 'fetch');
  }

  public function getInterms()
  {
  	$datetimeZero = DATETIME_ZERO;
    	$sql = "SELECT i.id, i.id_user, i.name, i.nick, i.contact, i.address, i.zip, i.city, i.state, i.phone, i.email, i.notes, u.name AS 'username'
            	FROM {$this->tables['interms']} AS i
            	INNER JOIN {$this->tables['users']} AS u
            	ON i.id_user = u.id
  			ORDER BY i.id DESC";
  	return $this->query($sql);
  }

  public function getIntermsAvailable()
  {
  	$datetimeZero = DATETIME_ZERO;
  	$sql = "SELECT	i.id, i.id_user, i.name, i.nick, i.contact, i.address, i.zip, i.city, i.state, i.phone, i.email, i.notes, u.name AS 'username'
            FROM {$this->tables['interms']} AS i
            INNER JOIN {$this->tables['users']} AS u
            ON i.id_user = u.id
            WHERE i.destroyed_at = '{$datetimeZero}'
			      ORDER BY i.id DESC";
  	return $this->query($sql);
  }

  public function getIntermLastInsertId()
  {
    return $this->getLastInsertId();
  }

  public function createInterm($post)
  {
  	$sql = "INSERT INTO {$this->tables['interms']}
  			    (id_user, name, nick, contact, address, zip, city, state, phone, email, notes, created_at)
  			    VALUES
  			    (:iduser, :name, :nick, :contact, :address, :zip, :city, :state, :phone, :email, :notes, :created)";
  	$stmt = $this->prepare($sql);
  	$stmt->bindValue(':iduser' , $post['iduser'] , PDO::PARAM_INT);
  	$stmt->bindValue(':name'	 , $post['name']	 , PDO::PARAM_STR);
  	$stmt->bindValue(':nick'	 , $post['nick']	 , PDO::PARAM_STR);
  	$stmt->bindValue(':contact', $post['contact'], PDO::PARAM_STR);
  	$stmt->bindValue(':address', $post['address'], PDO::PARAM_STR);
  	$stmt->bindValue(':zip'		 , $post['zip']		 , PDO::PARAM_STR);
  	$stmt->bindValue(':city'	 , $post['city']	 , PDO::PARAM_STR);
  	$stmt->bindValue(':state'	 , $post['state']	 , PDO::PARAM_STR);
  	$stmt->bindValue(':phone'	 , $post['phone']	 , PDO::PARAM_STR);
  	$stmt->bindValue(':email'	 , $post['email']	 , PDO::PARAM_STR);
  	$stmt->bindValue(':notes'	 , $post['notes']	 , PDO::PARAM_STR);
  	$stmt->bindValue(':created', DATETIME_NOW	   , PDO::PARAM_STR);
  	return $this->execute($stmt);
  }

  public function updateInterm($id, $post)
  {
  	$sql = "UPDATE {$this->tables['interms']}
  			    SET name = :name, nick = :nick, contact = :contact,
            address = :address, zip = :zip, city = :city, state = :state,
            phone = :phone, email = :email, notes = :notes, updated_at = :updated
  			    WHERE id = :id LIMIT 1";
  	$stmt = $this->prepare($sql);
  	$stmt->bindValue(':name'	 , $post['name']	 , PDO::PARAM_STR);
  	$stmt->bindValue(':nick'	 , $post['nick']	 , PDO::PARAM_STR);
  	$stmt->bindValue(':contact'  , $post['contact']  , PDO::PARAM_STR);
  	$stmt->bindValue(':address'  , $post['address']  , PDO::PARAM_STR);
  	$stmt->bindValue(':zip'		 , $post['zip']		 , PDO::PARAM_STR);
  	$stmt->bindValue(':city'	 , $post['city']	 , PDO::PARAM_STR);
  	$stmt->bindValue(':state'	 , $post['state']	 , PDO::PARAM_STR);
  	$stmt->bindValue(':phone'	 , $post['phone']	 , PDO::PARAM_STR);
  	$stmt->bindValue(':email'	 , $post['email']	 , PDO::PARAM_STR);
  	$stmt->bindValue(':notes'	 , $post['notes']	 , PDO::PARAM_STR);
  	$stmt->bindValue(':updated'  , DATETIME_NOW	     , PDO::PARAM_STR);
  	$stmt->bindValue(':id'	 	 , $id				 , PDO::PARAM_INT);
  	return $this->execute($stmt);
  }

  public function removeInterm($id)
  {
  	$sql = "UPDATE {$this->tables['interms']} SET destroyed_at = :destroyed WHERE id = :id LIMIT 1";
  	$stmt = $this->prepare($sql);
  	$stmt->bindValue(':destroyed', DATETIME_NOW , PDO::PARAM_STR);
  	$stmt->bindValue(':id'		 , $id		    , PDO::PARAM_INT);
  	return $this->execute($stmt);
  }
}
