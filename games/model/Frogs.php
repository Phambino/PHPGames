<?php

class Frogs {
	public $position = array(-1,-1,1,1,1,0,2,2,2,-1,-1);
	public $leftfrog1pos = 2;
	public $leftfrog2pos = 3;
	public $leftfrog3pos = 4;
	public $emptpos = 5;
	public $rightfrog3pos = 6;
	public $rightfrog2pos = 7;
	public $rightfrog1pos = 8;	
        public $state = "";	
        public $wins = 0;

	public function __construct() {
    	}

	public function makeMove($guess) {
		if($guess == "leftfrog1") {
                        if (($this->position[$this->leftfrog1pos + 1]) == 0 && ($this->position[$this->leftfrog1pos + 1]) != -1) {
                                $this->leftfrog1pos++;
                                $this->emptpos--;
                                $this->position[($this->leftfrog1pos)] = 1;
                                $this->position[($this->emptpos)] = 0; 	
                        } else if (($this->position[$this->leftfrog1pos + 2]) == 0 && ($this->position[$this->leftfrog1pos + 2]) != -1) {
                                $this->leftfrog1pos+=2;
                                $this->emptpos-=2;
                                $this->position[$this->leftfrog1pos] = 1;
                                $this->position[$this->emptpos] = 0;
                        }
		} else if($guess == "leftfrog2") {
            if (($this->position[$this->leftfrog2pos + 1]) == 0 && ($this->position[$this->leftfrog2pos + 1]) != -1) {
                    $this->leftfrog2pos++;
                    $this->emptpos--;
                    $this->position[($this->leftfrog2pos)] = 1;
                    $this->position[($this->emptpos)] = 0;
            } else if (($this->position[$this->leftfrog2pos + 2]) == 0 && ($this->position[$this->leftfrog2pos + 2]) != -1) {
                    $this->leftfrog2pos+=2;
                    $this->emptpos-=2;
                    $this->position[$this->leftfrog2pos] = 1;
                    $this->position[$this->emptpos] = 0;
            }
		} else if($guess == "leftfrog3") {
            if (($this->position[$this->leftfrog3pos + 1]) == 0 && ($this->position[$this->leftfrog3pos + 1]) != -1) {
                    $this->leftfrog3pos++;
                    $this->emptpos--;
                    $this->position[($this->leftfrog3pos)] = 1;
                    $this->position[($this->emptpos)] = 0;
            } else if (($this->position[$this->leftfrog3pos + 2]) == 0 && ($this->position[$this->leftfrog3pos + 2]) != -1) {
                    $this->leftfrog3pos+=2;
                    $this->emptpos-=2;
                    $this->position[$this->leftfrog3pos] = 1;
                    $this->position[$this->emptpos] = 0;
            }
		} else if($guess == "rightfrog3") {
            if (($this->position[$this->rightfrog3pos - 1]) == 0 && ($this->position[$this->rightfrog3pos - 1]) != -1) {
                    $this->rightfrog3pos--;
                    $this->emptpos++;
                    $this->position[($this->rightfrog3pos)] = 2;
                    $this->position[($this->emptpos)] = 0;
            } else if (($this->position[$this->rightfrog3pos - 2]) == 0 && ($this->position[$this->rightfrog3pos - 2]) != -1) {
                    $this->rightfrog3pos-=2;
                    $this->emptpos+=2;
                    $this->position[$this->rightfrog3pos] = 2;
                    $this->position[$this->emptpos] = 0;
            }
		} else if($guess == "rightfrog2") {
            if (($this->position[$this->rightfrog2pos - 1]) == 0 && ($this->position[$this->rightfrog2pos - 1]) != -1) {
                    $this->rightfrog2pos--;
                    $this->emptpos++;
                    $this->position[($this->rightfrog2pos)] = 2;
                    $this->position[($this->emptpos)] = 0;
            } else if (($this->position[$this->rightfrog2pos - 2]) == 0 && ($this->position[$this->rightfrog2pos - 2]) != -1) {
                    $this->rightfrog2pos-=2;
                    $this->emptpos+=2;
                    $this->position[$this->rightfrog2pos] = 2;
                    $this->position[$this->emptpos] = 0;
            }
		} else if($guess == "rightfrog1") {
            if (($this->position[$this->rightfrog1pos - 1]) == 0 && ($this->position[$this->rightfrog1pos - 1]) != -1) {
                    $this->rightfrog1pos--;
                    $this->emptpos++;
                    $this->position[($this->rightfrog1pos)] = 2;
                    $this->position[($this->emptpos)] = 0;
            } else if (($this->position[$this->rightfrog1pos - 2]) == 0 && ($this->position[$this->rightfrog1pos - 2]) != -1) {
                    $this->rightfrog1pos-=2;
                    $this->emptpos+=2;
                    $this->position[$this->rightfrog1pos] = 2;
                    $this->position[$this->emptpos] = 0;
            }
		}


        if($this->position[2] == 2 && $this->position[3] == 2 && 
        $this->position[4] == 2 && $this->position[5] == 0 && 
        $this->position[6] == 1 && $this->position[7] == 1 &&
        $this->position[8] == 1) {
                $this->wins++;
                $this->state = "YOU WIN";
            }

	}

	public function getState(){
		return $this->state;
	}
}
?>