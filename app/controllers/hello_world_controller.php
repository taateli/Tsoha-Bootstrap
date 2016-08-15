<?php



  class HelloWorldController extends BaseController{

    public static function index(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
   	  View::make('suunnitelmat/etusivu.html');
    }

    public static function sandbox(){
    
    $tsoha = Task::find(1);
    $tasks = Task::all();
    // Kint-luokan dump-metodi tulostaa muuttujan arvon
    Kint::dump($tasks);
    Kint::dump($tsoha);
  
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
