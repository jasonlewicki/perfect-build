<?php 

namespace PerfectBuild\Runes\Marks;

class Mana extends \PerfectBuild\Runes\Rune{
		
	// Constructor
	public function __construct() {		
		parent::__construct('Mana');						
		$this->basic_effects_arr['mana'] = 5.91;				
	}
}