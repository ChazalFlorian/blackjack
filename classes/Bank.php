<?php
require_once "Player.php";

class Bank extends Player{
  public function decide(Game $game){
    if($this->countCards($game) < 17){
      return "HIT";
    }else{
      return "PASS";
    }
  }
}