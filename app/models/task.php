<?php


class Task extends BaseModel{
  // Attribuutit
  public $id, $taskmaster_id, $name, $status, $description, $deadline, $place, $added;
  // Konstruktori

  public function __construct($attributes){
    parent::__construct($attributes);
  }

  public static function all(){
    // Alustetaan kysely tietokantayhteydellämme
    $query = DB::connection()->prepare('SELECT * FROM Task');
    // Suoritetaan kysely
    $query->execute();
    // Haetaan kyselyn tuottamat rivit
    $rows = $query->fetchAll();
    $games = array();

    // Käydään kyselyn tuottamat rivit läpi
    foreach($rows as $row){
      // Tämä on PHP:n hassu syntaksi alkion lisäämiseksi taulukkoon :)
      $games[] = new Task(array(
        'id' => $row['id'],
        'taskmaster_id' => $row['taskmaster_id'],
        'name' => $row['name'],
        'status' => $row['status'],
        'description' => $row['description'],
        'deadline' => $row['deadline'],
        'place' => $row['place'],
        'added' => $row['added']
      ));
    }

    return $games;
  }

  public static function find($id){
    $query = DB::connection()->prepare('SELECT * FROM Task WHERE id = :id LIMIT 1');
    $query->execute(array('id' => $id));
    $row = $query->fetch();

    if($row){
      $game = new Task(array(
        'id' => $row['id'],
        'taskmaster_id' => $row['taskmaster_id'],
        'name' => $row['name'],
        'status' => $row['status'],
        'description' => $row['description'],
        'deadline' => $row['deadline'],
        'place' => $row['place'],
        'added' => $row['added']
      ));

      return $game;
    }

    return null;
  }

    public function save(){
    // Lisätään RETURNING id tietokantakyselymme loppuun, niin saamme lisätyn rivin id-sarakkeen arvon
    $query = DB::connection()->prepare('INSERT INTO Task (name, deadline, place, description) VALUES (:name, :deadline, :place, :description) RETURNING id');
    // Muistathan, että olion attribuuttiin pääse syntaksilla $this->attribuutin_nimi
    $query->execute(array('name' => $this->name, 'deadline' => $this->deadline, 'place' => $this->place, 'description' => $this->description));
    // Haetaan kyselyn tuottama rivi, joka sisältää lisätyn rivin id-sarakkeen arvon
    $row = $query->fetch();

    $this->id = $row['id'];
  }


}