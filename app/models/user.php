<?php

class User extends BaseModel{

	public $id, $name, $password, $joined;

	public function __construct($attributes){
    parent::__construct($attributes);
    $this->validators = array('validate_name', 'validate_password');
}

	public function authenticate($name, $password) {
		$query = DB::connection()->prepare('SELECT * FROM Taskmaster WHERE name = :name AND password = :password LIMIT 1');
			$query->execute(array('name' => $name, 'password' => $password));
			$row = $query->fetch();
			if($row){
		
     		 $user = new Task(array(
        		'id' => $row['id'],
        		'name' => $row['name'],
        		'password' => $row['password'],
        		'joined' => $row['joined']
      			));

      		return $user;
    } else{
			return null;
		}

	}

	public function save(){
    
    $query = DB::connection()->prepare('INSERT INTO Taskmaster (name, password) VALUES (:name, :password) RETURNING id');
    
    $query->execute(array('name' => $this->name, 'password' => $this->password));

    $row = $query->fetch();

    $this->id = $row['id'];
  }


  public function validate_name(){
  $errors = array();
  if($this->name == '' || $this->name == null){
    $errors[] = 'User have to have name';
  }
  if($this->validate_string_length($this->name, 3)){
    $errors[] = 'Name should have atleast 3 characters!';
  }

  return $errors;
}

  public function validate_password(){
  $errors = array();
  if($this->password == '' || $this->password == null){
    $errors[] = 'User have to have a password';
  }
  if($this->validate_string_length($this->password, 5)){
    $errors[] = 'Password should have atleast 5 characters!';
  }

  return $errors;
}


}

