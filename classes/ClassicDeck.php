<?php

require "Deck.php";

class ClassicDeck extends Deck{
  
  public function reset(){
    $faces = range(1,10);
    $faces = array_merge($faces,["V","D","R"]);
    $suits = ["Heart","Spade","Diamond","Club"];

    $this->cards = [];
    foreach ($faces as $face) {
      foreach ($suits as $suit) {
        $this->cards[] = new Card($face, $suit);
      }
    }
  }
}