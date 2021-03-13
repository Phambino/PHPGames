<?php

class RPS {
	public $totalgames = 0;
	public $wins = 0;
	public $losses = 0;
	public $draws = 0;
	public $num = -1;
	public $history = array();
	public $state = "";

	public function __construct() {
	}

	public function makeGuess($guess){
		$this->num = rand(0,2);
		$this->totalgames++;
		if($this->num == $guess){
			$this->draws++;
			$this->state ="draw!";
		} else if($guess == 0 && $this->num == 1) {
			$this->losses++;
			$this->state = "you lose!";
		} else if($guess == 0 && $this->num == 2) {
			$this->wins++;
			$this->state = "you win!";
		} else if($guess == 1 && $this->num == 0) {
			$this->wins++;
			$this->state = "you win!";
		} else if($guess == 1 && $this->num == 2) {
			$this->losses++;
			$this->state = "you lose!";
		} else if($guess == 2 && $this->num == 0) {
			$this->losses++;
			$this->state = "you lose!";
		} else if($guess == 2 && $this->num == 1) {
			$this->wins++;
			$this->state = "you win!";
		}
		$this->history[] = "$this->state";
	}

	public function getState(){
		return $this->state;
	}
}
?>
