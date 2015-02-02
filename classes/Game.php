<?php
require_once "Card.php";
require_once "Player.php";

interface Game{
  public function cardValue(Card $card);
  public function addPlayer(Player $player);
  public function notify(array $data);
}