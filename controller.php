<?php
session_start();

require_once "classes/BlackJack.php";
require_once "classes/Player.php";

if(isset($_POST['RESET'])){
  unset($_SESSION['game']);
  header('Location: '.$_SERVER['REQUEST_URI']);
  exit;
}

$view = [];

//if state exists in session, get it from there
if(!isset($_SESSION['game'])){
  $bj = new BlackJack();
  $me = new Player();
  $bj->addPlayer($me);
}else{
  $bj = unserialize($_SESSION['game']);
}


//let's do something useful
if($bj->turn == BlackJack::TURN_INITIAL){
  $bj->initialDeal();
}

if ($bj->turn == BlackJack::TURN_PLAYER) {
  if($_SERVER['REQUEST_METHOD'] == "POST"){
    $bj->notify($_POST);
    $view['player_result'] = $bj->playerDeal();
  }
}

if ($bj->turn == BlackJack::TURN_BANK) {
  $view['bank_result'] = $bj->bankDeal();
}

if ($bj->turn == BlackJack::TURN_END) {
  $view['end_result'] = $bj->endDeal();
}

$view['turn'] = $bj->turn;

//don't forget to save to session the new state
$_SESSION['game'] = serialize($bj);