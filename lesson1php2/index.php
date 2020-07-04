<?php
class User
{
	protected $name;
	protected $age;
	protected $city;

	public function __construct($name, $age, $city)
	{
		$this->name = $name;
		$this->age = $age;
		$this->city = $city;
	}

	public function display()
	{
		return $this->getName() . $this->getAge() . $this->getCity() . '<hr>';
	}

	protected function getName()
	{
		return "<h1>{$this->name}</h1>";
	}

	protected function getAge()
	{
		return "<p>{$this->age}</p>";
	}

	protected function getCity()
	{
		return "<p>{$this->city}</p>";
	}
}

class UserAdmin extends User
{
	protected $isAdmin;

	public function __construct($name, $age, $city, $isAdmin)
	{
		parent::__construct($name, $age, $city);
		$this->isAdmin = $isAdmin;
	}

	public function display()
	{
		return $this->getName() . $this->getAge() . $this->getCity() . $this->getAdmin() . '<hr>';
	}

	private function getAdmin()
	{
		return "<h1>{$this->isAdmin}</h1>";
	}
}

$user = new User(Sam, 23, 'New-York');
echo $user->display();

$userAdmin = new UserAdmin(Dean, 26, Kansas, Admin);
echo $userAdmin->display();