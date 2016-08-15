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
    // POST-pyynnön muuttujat sijaitsevat $_POST nimisessä assosiaatiolistassa
    $params = $_POST;
    // Alustetaan uusi Game-luokan olion käyttäjän syöttämillä arvoilla
    $task = new Task(array(
      'name' => $params['name'],
      'description' => $params['description'],
      'deadline' => $params['deadline'],
      'place' => $params['place']
    ));

    Kint::dump($params);

 
    // Kutsutaan alustamamme olion save metodia, joka tallentaa olion tietokantaan
    $task->save();

    // Ohjataan käyttäjä lisäyksen jälkeen pelin esittelysivulle
    Redirect::to('/task/' . $task->id, array('message' => 'Task added to your TO-DO-LIST!'));
  }
}