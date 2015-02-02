<?php
require_once "Game.php";
require_once "Bank.php";
require_once "ClassicDeck.php";

class BlackJack implements Game{

  const TURN_INITIAL  = 0;
  const TURN_PLAYER   = 1;
  const TURN_BANK     = 2;
  const TURN_END      = 3;

  public $deck;
  public $player;
  public $bank;
  public $turn = 0;

  public function __construct(){
    $this->bank = new Bank();
    $this->deck = new ClassicDeck();
    $this->deck->shuffle();
    $this->turn = self::TURN_INITIAL;
  }

  /**
   *   TURNS
   **/

  public function initialDeal(){
    if($this->deck->countRemaining() < 13){
      $this->deck->reset();
    }
    
    $this->bank->takeCards($this->deck->distribute(2));
    $this->player->takeCards($this->deck->distribute(2));
    $this->turn = BlackJack::TURN_PLAYER;
  }

  public function playerDeal(){
    $total = $this->player->countCards($this);
    $decision = $this->player->decide($this);
    if($decision == "PASS"){
      $this->turn = BlackJack::TURN_BANK;
      return $total;
    }else if($decision == "HIT"){
      $this->player->takeCards($this->deck->distribute(1));
      $total = $this->player->countCards($this);
      if($total > 21){
        $this->turn = BlackJack::TURN_END;
        return "BUST";
      }else{
        return $total;
      }
    }

    return $total;
  }

  public function bankDeal(){
    $this->turn = BlackJack::TURN_END;
    while($this->bank->decide($this) == "HIT"){
      $this->bank->takeCards($this->deck->distribute(1));
      $total = $this->bank->countCards($this);
      if($total > 21){
        return "BUST";
      }
    }
    return $this->bank->countCards($this);
  }

  public function endDeal(){
    $playerScore = $this->player->countCards($this);
    $bankScore   = $this->bank->countCards($this);
    if($playerScore > 21){
      return "BANK WINS";
    }else if($bankScore > 21){
      return "PLAYER WINS";
    }else{
      if($playerScore > $bankScore){
        return "PLAYER WINS";
      }else if($playerScore < $bankScore){
        return "BANK WINS";
      }else{
        return "PUSH";
      }
    }
  }

  /**
   *   GAME INTERFACE
   **/
  public function addPlayer(Player $player){
    $this->player = $player;
  }

  public function cardValue(Card $card){
    if( in_array($card->getFace(), ["R","D","V"])){
      return 10;
    }else{
      return (int)$card->getFace();
    }
  }

  public function notify(array $data){
      $this->player->notify($data);
  }

}