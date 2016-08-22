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

  $routes->get('/task/:id/edit', function($id){
  TaskController::edit($id);
  });

  $routes->post('/task/:id/edit', function($id){
  TaskController::update($id);
  });

  $routes->post('/task/:id/destroy', function($id){
  TaskController::destroy($id);
  });

  $routes->get('/login', function(){
  UserController::login();
  });
  $routes->post('/login', function(){
  UserController::handle_login();
  });

  $routes->get('/user/new', function(){
  UserController::create();
  });

