<?php

class Card{
  private $face;
  private $suit;

  public function __construct($face, $suit){
    $this->face = $face;
    $this->suit = $suit;
  }

  public function getFace(){
    return $this->face;
  }

  public function getSuit(){
    return $this->suit;
  }
}