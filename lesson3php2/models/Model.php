<?php
namespace App\models;

use App\services\DB;

abstract class Model
{
    protected $db;

    abstract public function getTableName(): string;

    public function __construct()
    {
        $this->db = DB::getInstance();
    }

    public function getOne($id)
    {
	   $sql = 'SELECT * FROM ' . $this->getTableName() . ' WHERE id = :id';
	   return $this->db->find($sql, [':id' => $id]);
    }

    public function getAll()
    {
	   $sql = 'SELECT * FROM ' . $this->getTableName();
	   return $this->db->findAll($sql);
    }

    public function delete($id)
    {
	    $sql = 'DELETE FROM ' . $this->getTableName() . ' WHERE id = :id';
	    return $this->db->delete($sql, [':id' => $id]);
    }

	protected function insert()
	{
		foreach ($this as $key => $value) {
			if ($key == 'user_login') {
				$user_login = $value;
		   	} elseif ($key == 'user_password') {
			   	$user_password = $value;
		   	} elseif ($key == 'user_address') {
				   $user_address = $value;
			   }
	   	}

		$sql = "INSERT INTO users (user_login, user_password, user_address) VALUES ('$user_login', '$user_password', '$user_address')";
		$params = [];
	   
		$this->db->execute($sql, $params);
	}

    	protected function update()
    	{
		foreach ($this as $key => $value) {
			if ($key == 'id') {
				$id = $value;
			} elseif ($key == 'user_login') {
				$user_login = $value;
		   	} elseif ($key == 'user_password') {
			   	$user_password = $value;
		   	} elseif ($key == 'user_address') {
				   $user_address = $value;
			   }
	   	}

		$sql = "UPDATE users SET user_login = '$user_login', user_password = '$user_password', user_address = '$user_address' WHERE id = $id";
		$params = [];

		$this->db->execute($sql, $params);
    	}

    public function save()
    {
        if(empty($this->id)) {
            return $this->insert();
        }
        return $this->update();
    }
}