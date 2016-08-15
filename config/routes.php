<?php

  $routes->get('/', function() {
    HelloWorldController::index();
  });

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });

  $routes->get('/todo', function() {
    HelloWorldController::todo_list();
  });

  $routes->get('/todo/1', function() {
    HelloWorldController::show_task();
  });

  $routes->get('/todo/1/edit', function() {
    HelloWorldController::edit_task();
  });

  $routes->get('/login', function() {
    HelloWorldController::login();
  });

  $routes->get('/task', function(){
  TaskController::index();
  });

  $routes->post('/task', function(){
  TaskController::store();
  });

  $routes->get('/task/new', function(){
  TaskController::create();
  });

  $routes->get('/task/:id', function($id){
  TaskController::show($id);
  });

