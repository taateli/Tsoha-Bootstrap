<?php

  class HelloWorldController extends BaseController{

    public static function index(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
   	  View::make('suunnitelmat/etusivu.html');
    }

    public static function sandbox(){
      
      View::make('helloworld.html');
    }

    public static function show_task(){
      
      View::make('suunnitelmat/show_task.html');
    }

    public static function edit_task(){
      
      View::make('suunnitelmat/edit_task.html');
    }

    public static function login(){
      
      View::make('suunnitelmat/login.html');
    }

    public static function todo_list() {

      View::make('suunnitelmat/todo_list.html');
    }


  }
