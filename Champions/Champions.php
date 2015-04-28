<?php

namespace PerfectBuild\Champions;

abstract Class Champions{
	
	protected $gold;
	protected $level;
	protected $experience;
	protected $current_health;
	protected $current_mana;
	protected $current_fury;
	
	protected $base_health;
	protected $health_per_level;
	protected $base_health_regen;
	protected $health_regen_per_level;
	
	protected $base_mana;
	protected $mana_per_level;
	protected $base_mana_regen;
	protected $mana_regen_per_level;
	
	protected $base_attack_damage;
	protected $attack_damage_per_level;
	protected $base_attack_speed;
	protected $attack_speed_per_level;
	protected $attack_delay;
	
	protected $base_armor;
	protected $armor_per_level;
	
	protected $base_magic_resistance;
	
	protected $base_movement_speed;
	
	protected $spell_level_arr;
	
	protected $passive_obj;
	
	protected $spell1_obj;
	protected $spell2_obj;
	protected $spell3_obj;
	protected $spell4_obj;
	
	protected $summoner1_obj;
	protected $summoner2_obj;
	
	protected $effects_arr;
		
	public function __construct($summoner_arr, $rune_arr, $masteries_arr) {		
		
		$this->effects_arr = Array();
		
		$summoner1 = '\PerfectBuild\Summoners\\'.$summoner_arr[0];
		$summoner2 = '\PerfectBuild\Summoners\\'.$summoner_arr[1];
		
		$this->summoner1_obj 			= new $summoner1();
		$this->summoner2_obj 			= new $summoner2();
		
	}
	
	abstract public function spell1();
	abstract public function spell2();
	abstract public function spell3();
	abstract public function spell4();	
	
	public function summoner1(){
		
	}
	
	public function summoner2(){
		
	}
	
	public function attack($mob_obj){
		
		// TODO: Apply passives and on hits
		
		// Disable champion from other things while attacking
		$this->addEffect('Disable', Array('duration' => $this->attackSpeed()));
		
		return $mob_obj->receiveDamage(
			$attack_arr = Array(
				'attack_damage' 					=> $this->base_attack_damage + ((1 - $this->level) * $this->attack_damage_per_level),
				'magic_damage' 						=> 0.0,
				'armor_penetration_flat' 			=> 0.0,
				'armor_penetration_percent' 		=> 0.0,
				'armor_reduction_flat' 				=> 0.0,
				'armor_reduction_percent'			=> 0.0,
				'magic_resist_reduction_flat' 		=> 0.0,
				'magic_resist_reduction_percent' 	=> 0.0,
				'magic_resist_penetration_flat' 	=> 0.0,
				'magic_resist_penetration_percent' 	=> 0.0,
				'percent_health' 					=> 0.0
			)
		);		
	}	
	
	public function receiveDamage($attack_arr){
		######
		#ARMOR
		######
		// Calculate Armor after reductions and penetrations		
		$effective_armor = (($this->armor() - $attack_arr['armor_reduction_flat']) * (1 - $attack_arr['armor_reduction_percent']) * (1 - $attack_arr['armor_penetration_percent'])) - $attack_arr['armor_penetration_flat'];
				
		// Apply attack damage
		if ($effective_armor >= 0){
			$effective_armor_reduction = 100 / (100 + $effective_armor);
		}else{
			$effective_armor_reduction = 2 - (100 / (100 - $effective_armor));
		}		
		$true_attack_damage = $attack_arr['attack_damage'] * $effective_armor_reduction;		
		
		######
		#MAGIC
		######		
		// Calculate Magic Resist after reductions and penetrations
		$effective_magic_resist = (($this->magicResist() - $attack_arr['magic_resist_reduction_flat']) * (1 - $attack_arr['magic_resist_reduction_percent']) * (1 - $attack_arr['magic_resist_penetration_percent'])) - $attack_arr['magic_resist_penetration_flat'];
		
		// Apply magic damage		
		if ($effective_magic_resist >= 0){
			$effective_magic_resist_reduction = 100 / (100 + $effective_magic_resist);
		}else{
			$effective_magic_resist_reduction = 2 - (100 / (100 - $effective_magic_resist));
		}		
		$true_magic_damage = $attack_arr['magic_damage'] * $effective_magic_resist_reduction;
		
		######
		#TOTAL
		######
		$total_damage = $true_attack_damage + $true_magic_damage;	
		$this->current_health -= $total_damage;
		
		return Array(
			'total_damage' => $total_damage,
			'total_attack_damage' => $true_attack_damage,
			'total_magic_damage' => $true_magic_damage,
		);		
	}	
		
	public function free(){
		foreach($this->effects_arr as $effect){
			if($effect->name() == "Disable"){
				return false;
			}
		}
		return true;
	}	
	
	public function armor(){	
		// TODO: Fix this			
		return $this->base_armor + ((1 - $this->level) * $this->armor_per_level);
	}	
	
	public function magicResist(){	
		// TODO: Fix this			
		return $this->base_magic_resist;
	}	
	
	public function attackSpeed(){
		// TODO: Fix this		
		return $this->base_attack_speed;
	}
	
	public function addEffect($name, $option_arr){
		// TODO: Fix this		
		foreach($this->effects_arr as $effect){
			if($effect->name() == "Disable"){
				throw new \Exception("Add Disable Effect Error.");
			}
		}
		$this->effects_arr[] = new \PerfectBuild\Effects\Disable($option_arr);			
	}		
	
	public function tick($tick_rate){
		// TODO: Fix this		
		foreach($this->effects_arr as $key => &$effect){
			$effects_arr = $effect->tick($tick_rate);
			if($effects_arr['expire'] === true){
				unset($this->effects_arr[$key]);
			}else{
				
			}
		}
	}	
	
}

