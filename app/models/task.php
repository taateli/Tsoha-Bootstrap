<?php


class Task extends BaseModel{
  
  public $id, $taskmaster_id, $name, $status, $description, $deadline, $place, $added;
  
  public function __construct($attributes){
    parent::__construct($attributes);
    $this->validators = array('validate_name', 'validate_date', 'validate_place');
  }

  public static function all($taskmaster_id){
    
    $query = DB::connection()->prepare('SELECT * FROM Task WHERE taskmaster_id = :taskmaster_id');
    
    $query->execute(array('taskmaster_id' => $taskmaster_id));
    
    $rows = $query->fetchAll();
    $tasks = array();

    
    foreach($rows as $row){
      
      $tasks[] = new Task(array(
        'id' => $row['id'],
        'taskmaster_id' => $row['taskmaster_id'],
        'name' => $row['name'],
        'status' => $row['status'],
        'description' => $row['description'],
        'deadline' => $row['deadline'],
        'place' => $row['place'],
        'added' => $row['added']
      ));
    }

    return $tasks;
  }

  public static function find($id){
    $query = DB::connection()->prepare('SELECT * FROM Task WHERE id = :id LIMIT 1');
    $query->execute(array('id' => $id));
    $row = $query->fetch();

    if($row){
      $task = new Task(array(
        'id' => $row['id'],
        'taskmaster_id' => $row['taskmaster_id'],
        'name' => $row['name'],
        'status' => $row['status'],
        'description' => $row['description'],
        'deadline' => $row['deadline'],
        'place' => $row['place'],
        'added' => $row['added']
      ));

      return $task;
    }

    return null;
  }

    public function save(){
    
    $query = DB::connection()->prepare('INSERT INTO Task (name, deadline, place, description, taskmaster_id) VALUES (:name, :deadline, :place, :description, :taskmaster_id) RETURNING id');
    
    $query->execute(array('name' => $this->name, 'deadline' => $this->deadline, 'place' => $this->place, 'description' => $this->description, 'taskmaster_id' => $this->taskmaster_id));

    $row = $query->fetch();

    $this->id = $row['id'];
  }

    public function update($id){
      $query = DB::connection()->prepare('UPDATE Task SET name = :name, deadline = :deadline, place = :place, description = :description, status = :status WHERE ID = :id');

      $query->execute(array('name'=> $this->name, 'deadline' => $this->deadline, 'place' => $this->place, 'description' => $this->description, 'status' => $this->status, 'id' => $this->id));
    }

    public function destroy($id){
      $query = DB::connection()->prepare('DELETE FROM Task WHERE ID = :id');
      $query->execute(array('id' => $id));

    }

  public function validate_name(){
  $errors = array();
  if($this->name == '' || $this->name == null){
    $errors[] = 'Task have to have name';
  }
  if($this->validate_string_length($this->name, 3)){
    $errors[] = 'Name should have atleast 3 characters!';
  }

  return $errors;
}

  public function validate_date(){
  $tempDate = explode('-', $this->deadline);
  $errors = array();

  if (!$this->deadline) {
    $errors[] = "Task must have a deadline";
    return $errors;
  }  
  if (checkdate($tempDate[1], $tempDate[2], $tempDate[0])) {

  } else {
     $errors[] = 'Date is incorrect';  }
  return $errors;   
}

  public function validate_place(){
  $errors = array();
  if($this->place == '' || $this->place == null){
    $errors[] = 'Place can not be empty';
  }

  return $errors;
}


}
