<?php

class Allstats {
	public $ggwin = 0;
	public $rpswin = 0;
	public $rpsloss = 0;
	public $rpsdraw = 0;
	public $frogwin = 0;

	public function __construct($gw, $rpsw, $rpsl, $rpsd, $fw) {
        $this->ggwin = $gw;
        $this->rpswin = $rpsw;
		$this->rpsloss = $rpsl;
		$this->rpsdraw = $rpsd;
        $this->frogwin = $fw;
    }

    public function getggwin(){
		return $this->ggwin;
	}

	public function getrpswin(){
		return $this->rpswin;
	}

	public function getrpsloss(){
		return $this->rpsloss;
	}

	public function getrpsdraw(){
		return $this->rpsdraw;
	}

	public function getfrogwin(){
		return $this->frogwin;
	}
}
?>
