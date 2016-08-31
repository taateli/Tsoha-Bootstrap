<?php

  $routes->get('/', function() {
    UserController::login();
  });

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
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

  $routes->post('/user', function(){
  UserController::store();
  });

  $routes->post('/etusivu', function() {
  TaskController::index();
  });

  $routes->post('/logout', function(){
  UserController::logout();
  });

  $routes->get('/user/:id/edit', function($id){
  UserController::edit($id);
  });

  $routes->post('/user/:id/edit', function($id){
  UserController::update($id);
  });

  $routes->post('/user/:id/destroy', function($id){
  UserController::destroy($id);
  });
