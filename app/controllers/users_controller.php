<?php

class UserController extends BaseController{


  public static function login(){

      View::make('etusivu.html');
  }

  public static function logout(){
    $_SESSION['user'] = null;
    Redirect::to('/', array('message' => 'You have logged out!'));
  }

  public static function handle_login(){
    $params = $_POST;

    $user = User::authenticate($params['username'], $params['password']);

    if(!$user){
      View::make('etusivu.html', array('error' => 'Wrong username & password', 'username' => $params['username']));
    }else{
      $_SESSION['user'] = $user->id;

      Redirect::to('/task', array('message' => 'Welcome back ' . $user->name . '!'));
    }
  }

    public static function update($id){
    self::check_logged_in();

    $user_logged_in = self::get_user_logged_in();
    $params = $_POST;

    $attributes = array(
        'id' => $id,
        'name' => $user_logged_in->name,
        'password' => $params['password']
            );

    
    $user = new User($attributes);
    $errors = $user->errors();

    if(count($errors) > 0){
      View::make('user/edit.html', array('errors' => $errors, 'attributes' => $attributes));
    }else{
      
      $user->update($user_logged_in->id);

      Redirect::to('/task', array('message' => 'User info updated'));
    }
  }

  public static function create(){
    
    View::make('user/new.html');
  }

    public static function edit($id){
    self::check_logged_in();

    $user = self::get_user_logged_in();

    View::make('user/edit.html', array('attributes' => $user));
  }

  public static function store(){

    $params = $_POST;
    
    $attributes = new User(array(
      'name' => $params['name'],
      'password' => $params['password']
    ));
    $taskmaster = new User($attributes);
    $errors = $taskmaster->errors();

    if(count($errors) == 0){
    
    $taskmaster->save();

    Redirect::to('/login', array('message' => 'User creation succesful! You can now login'));
  }else{
    
    View::make('user/new.html', array('errors' => $errors, 'attributes' => $attributes));
  } 
  }
}