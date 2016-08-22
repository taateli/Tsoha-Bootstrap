<?php

  class BaseModel{
    
    protected $validators;

    public function __construct($attributes = null){
      
      foreach($attributes as $attribute => $value){
        
        if(property_exists($this, $attribute)){
          
          $this->{$attribute} = $value;
        }
      }
    }

    public function errors(){
      // Lisätään $errors muuttujaan kaikki virheilmoitukset taulukkona
      $errors = array();

      foreach($this->validators as $validator){
        
        $errors = array_merge($errors, $this->{$validator}());
      }

      return $errors;
    }

    public function validate_string_length($string, $length){
      
      if (strlen($string) < $length){
        return true;
      }
      return false;
    }

   

   
    
  }
