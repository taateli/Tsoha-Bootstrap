<?php

class TaskController extends BaseController{
    
    public static function index(){
    self::check_logged_in();
    
    $user_logged_in = self::get_user_logged_in();
    $tasks = Task::all($user_logged_in->id);
    

    View::make('task/index.html', array('tasks' => $tasks));
  }

  public static function show($id){
    self::check_logged_in();
  	$task = Task::find($id);

  	View::make('task/show.html', array('task' => $task));

  }

  public static function create(){
    self::check_logged_in();
  	View::make('task/new.html');
  }

  public static function store(){
    self::check_logged_in();
    $user_logged_in = self::get_user_logged_in();
    $params = $_POST;
    
    $attributes = new Task(array(
      'name' => $params['name'],
      'description' => $params['description'],
      'deadline' => $params['deadline'],
      'place' => $params['place'],
      'taskmaster_id'=> $user_logged_in->id
    ));
    $task = new Task($attributes);
    $errors = $task->errors();

  if(count($errors) == 0){
    
    $task->save();

    Redirect::to('/task/' . $task->id, array('message' => 'Task added!'));
  }else{
    
    View::make('task/new.html', array('errors' => $errors, 'attributes' => $attributes));
  } 
  }

  public static function edit($id){
    self::check_logged_in();
    $task = Task::find($id);
    View::make('task/edit.html', array('attributes' => $task));
  }

  public static function update($id){
    self::check_logged_in();

    $user_logged_in = self::get_user_logged_in();
    $params = $_POST;

    $status = (isset($_POST['status'])) ? 1 : 0;

    $attributes = array(
      	'id' => $id,
        'name' => $params['name'],
        'status' => $status,
        'description' => $params['description'],
        'deadline' => $params['deadline'],
        'place' => $params['place']
    );

    
    $task = new Task($attributes);
    $errors = $task->errors();

    if(count($errors) > 0){
      View::make('task/edit.html', array('errors' => $errors, 'attributes' => $attributes));
    }else{
      
      $task->update($id);

      Redirect::to('/task/' . $task->id, array('message' => 'Task has been updated'));
    }
  }

  public static function destroy($id){
    self::check_logged_in();
    
    $task = new Task(array('id' => $id));
    
    $task->destroy($id);

    Redirect::to('/task', array('message' => 'Task deleted!'));
  }
 
}