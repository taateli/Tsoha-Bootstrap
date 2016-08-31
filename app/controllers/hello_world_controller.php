<?php



  class HelloWorldController extends BaseController{

    public static function index(){
   	  View::make('suunnitelmat/etusivu.html');
    }

    public static function sandbox(){
      $doom = new Task(array(
    'name' => 'd',
    'deadline' => '2016-32-21',
    'place' => 'id Software',
    'description' => 'Boom, boom!'
    ));
    $errors = $doom->errors();

    Kint::dump($errors);
    }

    public static function show_task(){
      
      View::make('suunnitelmat/show_task.html');
    }

    public static function edit_task(){
      $findone = Task::find(1);
      View::make('suunnitelmat/edit_task.html');
    }

    public static function login(){
      
      View::make('suunnitelmat/login.html');
    }

    public static function todo_list() {
      $findone = Task::find(1);
      $tasks = Task::all();
      View::make('suunnitelmat/todo_list.html');
    }


  }
