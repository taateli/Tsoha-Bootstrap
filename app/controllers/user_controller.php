<?php

class UserController extends BaseController{
  public static function login(){
      View::make('etusivu.html');
  }
  public static function handle_login(){
    $params = $_POST;

    $user = User::authenticate($params['username'], $params['password']);

    if(!$user){
      View::make('etusivu.html', array('error' => 'Väärä käyttäjätunnus tai salasana!', 'username' => $params['username']));
    }else{
      $_SESSION['user'] = $user->id;

      Redirect::to('/', array('message' => 'Tervetuloa takaisin ' . $user->name . '!'));
    }
  }

  public static function create(){
    View::make('user/new.html');
  }

  public static function store(){

    $params = $_POST;
    
    $attributes = new Taskmaster(array(
      'name' => $params['name'],
      'password' => $params['password']
    ));
    $taskmaster = new Taskmaster($attributes);
    $errors = $taskmaster->errors();

    if(count($errors) == 0){
    
    $taskmaster->save();

    Redirect::to('etusivu.html' . $task->id, array('message' => 'User creation succesful!'));
  }else{
    
    View::make('etusivu.html', array('errors' => $errors, 'attributes' => $attributes));
  } 
  }
}