<?php

class Profile {
	public $name = "";
	public $password = "";
	public $email = "";
    public $gender = "";
    public $colour = "";
	public $state = "";

	public function __construct($n, $p, $e, $g, $c) {
        $this->name = $n;
        $this->password = $p;
        $this->email = $e;
        $this->gender = $g;
        $this->colour = $c;
    }

    public function getName(){
		return $this->name;
	}

	public function getPassword(){
		return $this->password;
	}

	public function getEmail(){
		return $this->email;
	}

	public function getGender(){
		return $this->gender;
	}

	public function getColour(){
		return $this->colour;
	}
	
	public function getState(){
		return $this->state;
	}
}
?>
