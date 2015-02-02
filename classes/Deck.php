<?php
require_once "Card.php";

class Deck{
  protected $cards= [];
  protected  $options = [];

  public function __construct(array $options = []){
    $this->options = $options;
    $this->reset();
  }

  public function distribute($n){
    $cards = array_splice($this->cards, 0, $n);
    return $cards;
  }

  public function shuffle(){
    shuffle($this->cards);
  }

  public function reset(){
    return [];
  }

  public function countRemaining(){
    return count($this->cards);
  }
}