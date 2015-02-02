<?php
require_once "Card.php";

class Player{
  private $hand = [];
  private $decision = "NONE";

  public function showHand(){
    return $this->hand;
  }

  public function takeCards(array $cards){
    $this->hand = array_merge($this->hand, $cards);
  }

  public function takeCard(Card $c){
    $this->hand[] = $c;
  }

  public function notify($data){
    if(array_key_exists("PASS",$data)){
      $this->decision = "PASS";
    }else if(array_key_exists("HIT",$data)){
      $this->decision = "HIT";
    }else{
      $this->decision = "NONE";
    }
  }
  public function decide(Game $game){
    return $this->decision;
  }

  public function countCards(Game $game){
    $total = 0;
    foreach ($this->hand as $card) {
      $total += $game->cardValue($card);
    }
    return $total;
  }
}