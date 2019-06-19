<?php

class UserModel extends Model
{
  public function __construct(){ parent::__construct(); }

	public function getUser($id)
	{
		$sql = "SELECT * FROM {$this->tables['users']} WHERE id = :id LIMIT 1";
		$stmt = $this->prepare($sql);
		$stmt->bindValue(':id', $id, PDO::PARAM_INT);
		return $this->execute($stmt, 'fetch');
	}

	public function getUserBy($column, $value)
	{
		$sql = "SELECT * FROM {$this->tables['users']} WHERE {$column} = :value LIMIT 1";
		$stmt = $this->prepare($sql);
		$PDOPARAM = ( is_string($value) ) ? PDO::PARAM_STR : PDO::PARAM_INT;
		$stmt->bindValue(':value' , $value , $PDOPARAM);
		return $this->execute($stmt, 'fetch');
	}

  public function getUserLastInsertId()
  {
    return $this->getLastInsertId();
  }

	public function loggingUser($post)
  {
		$postUsername = Tool::minimum($post['username'], USERNAME_MIN);
		$postPassword = Tool::minimum($post['password'], PASSWORD_MIN);
		if($postUsername && $postPassword)
		{
			$crypted 	= Tool::encrypt($postPassword);
			$sql = "SELECT id, name, kind, updated_at FROM {$this->tables['users']}
							WHERE name = :username AND passcode = :crypted AND enabled = 1
							LIMIT 1";
			$stmt = $this->prepare($sql);
			$stmt->bindValue(':username', $postUsername, PDO::PARAM_STR);
			$stmt->bindValue(':crypted' , $crypted	 	 , PDO::PARAM_STR);
			return $this->execute($stmt, 'fetch');
		}
		return false;
  }

	public function createUser($post)
	{
		$postUsername = Tool::minimum($post['username'], USERNAME_MIN);
		$postPassword = Tool::minimum($post['password'], PASSWORD_MIN);
		if($postUsername && $postPassword)
		{
			$postUsername = strtolower($postUsername);
			$crypted = Tool::encrypt($postPassword);
			$sql = "INSERT INTO {$this->tables['users']} (kind, name, passcode)
							VALUES (:kind, :name, :passcode)";
			$stmt = $this->prepare($sql);
			$stmt->bindValue(':kind'		, $post['kind'], PDO::PARAM_STR);
			$stmt->bindValue(':name'		, $postUsername, PDO::PARAM_STR);
			$stmt->bindValue(':passcode', $crypted		 , PDO::PARAM_STR);
			return $this->execute($stmt);
		}
		return false;
	}

	public function updateEnable($id, $switch)
	{
		if( is_int($id) && is_int($switch) )
		{
			$sql = "UPDATE {$this->tables['users']} SET enabled = :switch, updated_at = :updated
							WHERE id = :id LIMIT 1";
			$stmt = $this->prepare($sql);
			$stmt->bindValue(':updated', DATETIME_NOW, PDO::PARAM_STR);
			$stmt->bindValue(':switch' , $switch		 , PDO::PARAM_INT);
			$stmt->bindValue(':id'		 , $id				 , PDO::PARAM_INT);
			return $this->execute($stmt);
		}
		return false;
	}

	public function updateUsername($id, $name)
	{
		if( $nameNew = Tool::minimum($name, USERNAME_MIN) )
		{
			$sql = "UPDATE {$this->tables['users']} SET name = :name, updated_at = :updated
							WHERE id = :id AND enabled = 1 LIMIT 1";
			$stmt = $this->prepare($sql);
			$stmt->bindValue(':name'	 , $nameNew	   , PDO::PARAM_STR);
			$stmt->bindValue(':updated', DATETIME_NOW, PDO::PARAM_STR);
			$stmt->bindValue(':id'		 , $id		 		 , PDO::PARAM_INT);
			return $this->execute($stmt);
		}
		return false;
	}

	public function updatePassword($id, $password)
	{
		if( $passwordNew = Tool::minimum($password, PASSWORD_MIN) )
		{
			$crypted = Tool::encrypt($passwordNew);
			$sql = "UPDATE {$this->tables['users']} SET passcode = :crypted, updated_at = :updated
							WHERE id = :id AND enabled = 1 LIMIT 1";
			$stmt = $this->prepare($sql);
			$stmt->bindValue(':crypted', $crypted		 , PDO::PARAM_STR);
			$stmt->bindValue(':updated', DATETIME_NOW, PDO::PARAM_STR);
			$stmt->bindValue(':id'		 , $id				 , PDO::PARAM_INT);
			return $this->execute($stmt);
		}
		return false;
	}

	public function deleteUser($id)
	{
		$sql = "DELETE FROM {$this->tables['users']} WHERE id = :id LIMIT 1";
		$stmt = $this->prepare($sql);
		$stmt->bindValue(':id', $id, PDO::PARAM_INT);
		return $this->execute($stmt);
	}

	public function verification($id, $post)
	{
		$user = $this->getUser($id);
		$username = $post['username'];
		$password = Tool::encrypt($post['password']);

		if($user['name'] === $username && $user['passcode'] === $password)
		{
			return true;
		}
		return false;
	}
}
