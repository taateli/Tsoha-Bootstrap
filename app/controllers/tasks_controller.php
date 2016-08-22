<?php

class TaskController extends BaseController{
    public static function index(){
    
    $tasks = Task::all();
    
    View::make('task/index.html', array('tasks' => $tasks));
  }

  public static function show($id){

  	$task = Task::find($id);

  	View::make('task/show.html', array('task' => $task));

  }

  public static function create(){
  	View::make('task/new.html');
  }

  public static function store(){

    $params = $_POST;
    
    $attributes = new Task(array(
      'name' => $params['name'],
      'description' => $params['description'],
      'deadline' => $params['deadline'],
      'place' => $params['place']
    ));
    $task = new Task($attributes);
    $errors = $task->errors();

  if(count($errors) == 0){
    
    $Task->save();

    Redirect::to('/task/' . $task->id, array('message' => 'Task added!'));
  }else{
    
    View::make('task/new.html', array('errors' => $errors, 'attributes' => $attributes));
  } 
  }

  public static function edit($id){
    $task = Task::find($id);
    View::make('task/edit.html', array('attributes' => $task));
  }

  public static function update($id){
    $params = $_POST;

    $attributes = array(
      	'id' => $id,
        'name' => $params['name'],
        'status' => $params['status'],
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
    
    $task = new Task(array('id' => $id));
    
    $task->destroy($id);

    Redirect::to('/task', array('message' => 'Task deleted!'));
  }
 
}