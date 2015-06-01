<?php

include dirname(__FILE__).'/../Configs/config.php';
include PERFECT_BUILD_ROOT.DIRECTORY_SEPARATOR.'autoload.php';

include dirname(__FILE__).'/utilities.php';

// Create a new instance of the Engine
$engine_obj = new \PerfectBuild\Engine\Engine();

// Create stats
$fiddlesticks_level = 1;
$spell_level_arr = Array(0,1,0,0);
$summoner_arr = Array('Flash', 'Smite');
$masteries_arr = Array();

// Create Rune Array
$runes_arr = Array(
	'Glyphs' => Array(			
		'CooldownReductionScaling',
		'AttackSpeed',
		'AttackDamage',
		'MagicPenetration',
		'AbilityPowerScaling',
		'AttackDamageScaling',
		'AbilityPower',
		'CriticalChance',
		'CriticalDamage',
		'CooldownReduction'
	),
	'Quintessences' => Array(	
		'CooldownReductionScaling',
		'AttackSpeed',
		'AttackDamage',
		'ArmorPenetration',
		'MagicPenetration',
		'AbilityPowerScaling',
		'AttackDamageScaling',
		'AbilityPower',
		'CriticalChance',
		'CriticalDamage',
		'HealthRegeneration',
		'HybridPenetration',
		'CooldownReduction'
	),
	'Seals' => Array(	
		'AttackSpeed',
		'AttackDamage',
		'AbilityPowerScaling',
		'AttackDamageScaling',
		'AbilityPower',
		'CriticalChance',
		'CriticalDamage',
		'CooldownReduction'
	),
	'Marks' => Array(
		'AttackSpeed',
		'AttackDamage',
		'ArmorPenetration',
		'MagicPenetration',
		'AbilityPowerScaling',
		'AttackDamageScaling',
		'AbilityPower',
		'CriticalChance',
		'CriticalDamage',
		'HybridPenetration',
		'CooldownReduction',
	)
);

$rune_arr = Array(
	'Glyphs' => Array(),
	'Marks' => Array(),
	'Quintessences' => Array(),
	'Seals' => Array()
);

$total_index = 0;

$glyph_index = 0;
$mark_index = 0;
$quintessence_index = 0;
$seal_index = 0;

$top_damage = Array();
$top_dps = Array();

while(true){
		
	// Print progress
	if ($quintessence_index > 0 && $seal_index == 0){
		echo "\rProgress: ".number_format(100*($total_index/(count($runes_arr['Glyphs']) * count($runes_arr['Marks']) * count($runes_arr['Quintessences']) * count($runes_arr['Seals']))),4)."%";
	}
	
	// Populate Rune pages
	for($g = 0; $g<9; $g++){
		$rune_arr['Glyphs'][$g] = $runes_arr['Glyphs'][$glyph_index];
	}
	for($m = 0; $m<9; $m++){
		$rune_arr['Marks'][$m] = $runes_arr['Marks'][$mark_index];
	}
	for($q = 0; $q<3; $q++){
		$rune_arr['Quintessences'][$q] = $runes_arr['Quintessences'][$quintessence_index];
	}
	for($s = 0; $s<9; $s++){
		$rune_arr['Seals'][$s] = $runes_arr['Seals'][$seal_index];
	}	

	# Start Engine
		
	// Create a new instance of the Champion
	$fiddlesticks_obj = new \PerfectBuild\Champions\Fiddlesticks($fiddlesticks_level, $spell_level_arr, $summoner_arr, $rune_arr, $masteries_arr);
	
	// Level Drain 1 point
	$fiddlesticks_obj->levelSpell2();
	
	// Create a new instance of the Monster
	$blue_sentinel_level = 1;
	$blue_sentinel_obj = new \PerfectBuild\Monsters\BlueSentinel($blue_sentinel_level);
	
	// Create Timeline
	$timeline = Array(
		0 => Array('subject' => $fiddlesticks_obj, 'action' => 'spell2', 'object' => $blue_sentinel_obj, 'status' => 'queued'),
		1 => Array('subject' => $fiddlesticks_obj, 'action' => 'spell2', 'object' => $blue_sentinel_obj, 'status' => 'queued')
	);
	
	$tick_rate = $engine_obj->tickRate();
	$damage_per_tick = 0;
	$total_damage = 0;
	
	$engine_obj->reset();
	
	// Step Engine's time
	while(($slice = $engine_obj->step()) !== false){
		
		$i = $slice/$tick_rate;
			
		// Decrement any effects
		$result = $fiddlesticks_obj->tick($tick_rate);
		$damage_per_tick+= $result['total_damage'];
		$total_damage += $result['total_damage'];
		
		// Decrement any effects
		$result = $blue_sentinel_obj ->tick($tick_rate);
		$damage_per_tick+= $result['total_damage'];
		$total_damage += $result['total_damage'];
		
		$complete = true;	
		
		foreach($timeline as &$timeline_index){			
			
			if($timeline_index['status'] == 'queued'){
				$complete = false;
			}
			
			if($timeline_index['status'] == 'queued' && $timeline_index['subject']->free() === true){
				
				if($timeline_index['action'] == 'spell1' || $timeline_index['action'] == 'spell2' || $timeline_index['action'] == 'spell3' || $timeline_index['action'] == 'spell4'){
					$free_method = $timeline_index['action']."Free";	
					if(!$timeline_index['subject']->$free_method()){
						$complete = false;					
					}else{
						// Cast spell
						$result = $timeline_index['subject']->$timeline_index['action']($timeline_index['object']);
						$timeline_index['status'] = 'complete';
						$damage_per_tick+= $result['total_damage'];
						$total_damage += $result['total_damage'];
					}
				}else{
					// Do another action
					$result = $timeline_index['subject']->$timeline_index['action']($timeline_index['object']);
					$timeline_index['status'] = 'complete';
					$damage_per_tick+= $result['total_damage'];
					$total_damage += $result['total_damage'];
				}
			}else if($timeline_index['subject']->free() === false){
				$complete = false;
			}
		}
		
		if($slice % $tick_rate == 0 && $i > 0){
			//echo "Total damage: ".$total_damage. "\tTotal DPS: ".(($total_damage/($slice/$tick_rate))). "\tCurrent DPS: ".$damage_per_tick."\n";
			$damage_per_tick = 0;
		}
		
		if($complete === true){
			break;
		}
		
	}
	
	// Last tidbit of tick that is not a full tick. There has to be a better way to do all of this
	//echo "Total damage: ".$total_damage. "\tTotal DPS: ".($total_damage/($slice/$tick_rate)). "\tCurrent DPS: ".$damage_per_tick."\n";
	
	// Top Damage
	if(count($top_damage) < 20){
		$top_damage[count($top_damage)] = Array(
			'damage' => $total_damage, 
			'dps' => ($total_damage/($slice/$tick_rate)), 
			'Glyphs' => $runes_arr['Glyphs'][$glyph_index], 
			'Marks' => $runes_arr['Marks'][$mark_index], 
			'Quintessences' => $runes_arr['Quintessences'][$quintessence_index], 
			'Seals' => $runes_arr['Seals'][$seal_index]
		);
	}else{
		$lowest = 1000000000000;
		$lowest_key = null;
		for($index = 0; $index < 20; $index++){
			if($top_damage[$index]['damage'] < $lowest){
				$lowest = $top_damage[$index]['damage'];
				$lowest_key = $index;
			}
		}
		if($lowest_key !== null && $total_damage > $top_damage[$lowest_key]['damage']){
			$top_damage[$lowest_key] = Array(
				'damage' => $total_damage, 
				'dps' => ($total_damage/($slice/$tick_rate)), 
				'Glyphs' => $runes_arr['Glyphs'][$glyph_index], 
				'Marks' => $runes_arr['Marks'][$mark_index], 
				'Quintessences' => $runes_arr['Quintessences'][$quintessence_index], 
				'Seals' => $runes_arr['Seals'][$seal_index]
			); 
		}
	}
	
	// Top DPS
	if(count($top_dps) < 20){
		$top_dps[count($top_dps)] = Array(
			'damage' => $total_damage, 
			'dps' => ($total_damage/($slice/$tick_rate)), 
			'Glyphs' => $runes_arr['Glyphs'][$glyph_index], 
			'Marks' => $runes_arr['Marks'][$mark_index], 
			'Quintessences' => $runes_arr['Quintessences'][$quintessence_index], 
			'Seals' => $runes_arr['Seals'][$seal_index]
		);
	}else{
		$lowest = 1000000000000;
		$lowest_key = null;
		for($index = 0; $index < 20; $index++){
			if($top_damage[$index]['dps'] < $lowest){
				$lowest = $top_damage[$index]['dps'];
				$lowest_key = $index;
			}
		}
		if($lowest_key !== null && ($total_damage/($slice/$tick_rate)) > $top_dps[$lowest_key]['dps']){
			$top_dps[$lowest_key] = Array(
				'damage' => $total_damage, 
				'dps' => ($total_damage/($slice/$tick_rate)), 
				'Glyphs' => $runes_arr['Glyphs'][$glyph_index], 
				'Marks' => $runes_arr['Marks'][$mark_index], 
				'Quintessences' => $runes_arr['Quintessences'][$quintessence_index], 
				'Seals' => $runes_arr['Seals'][$seal_index]
			); 
		}
	}
	
	/*
	if($runes_arr['Glyphs'][$glyph_index] == "AbilityPower" && $runes_arr['Marks'][$mark_index] == "MagicPenetration" && $runes_arr['Quintessences'][$quintessence_index] == "AbilityPower" && $runes_arr['Seals'][$seal_index] == "AbilityPower" ){
		echo "Total damage: ".$total_damage. "\tTotal DPS: ".($total_damage/($slice/$tick_rate)). "\tCurrent DPS: ".$damage_per_tick."\n";
	}*/
	
	// Change up runes
	$seal_index++;
	if($seal_index == count($runes_arr['Seals'])){
		$seal_index = 0;
		$quintessence_index++;
	}
	if($quintessence_index == count($runes_arr['Quintessences'])){
		$quintessence_index = 0;
		$mark_index++;
	}
	if($mark_index == count($runes_arr['Marks'])){
		$mark_index = 0;
		$glyph_index++;
	}
	if($glyph_index == count($runes_arr['Glyphs'])-1 && $mark_index == count($runes_arr['Marks'])-1 && $quintessence_index == count($runes_arr['Quintessences'])-1 && $seal_index == count($runes_arr['Seals'])-1){
		break;
	}
		
	$total_index++;

}

displayResults($top_damage, $top_dps);

/*
TOP 20 DAMAGE
-----------------------------
Damage: 762.81  DPS: 54.408701854494    Glyphs: AbilityPower    Marks: AbilityPower     Quintessences: AbilityPower     Seals: AbilityPower
Damage: 742.965 DPS: 52.993223965763    Glyphs: AbilityPower    Marks: AbilityPower     Quintessences: AbilityPower     Seals: AbilityPowerScaling
Damage: 742.965 DPS: 52.993223965763    Glyphs: AbilityPowerScaling     Marks: AbilityPowerScaling      Quintessences: AbilityPower     Seals: AbilityPower
Damage: 738.915 DPS: 52.704350927247    Glyphs: HybridPenetration       Marks: HybridPenetration        Quintessences: AbilityPower     Seals: AbilityPower
Damage: 738.915 DPS: 52.704350927247    Glyphs: AbilityPower    Marks: AbilityPower     Quintessences: AbilityPower     Seals: CriticalDamage
Damage: 738.915 DPS: 52.704350927247    Glyphs: AbilityPower    Marks: AbilityPower     Quintessences: AbilityPower     Seals: CriticalChance
Damage: 738.915 DPS: 52.704350927247    Glyphs: AttackDamage    Marks: AttackDamage     Quintessences: AbilityPower     Seals: AbilityPower
Damage: 738.915 DPS: 52.704350927247    Glyphs: AttackDamageScaling     Marks: AttackDamageScaling      Quintessences: AbilityPower     Seals: AbilityPower
Damage: 738.915 DPS: 52.704350927247    Glyphs: AbilityPower    Marks: AbilityPower     Quintessences: AbilityPower     Seals: AttackSpeed
Damage: 738.915 DPS: 53.351263537906    Glyphs: CooldownReduction       Marks: CooldownReduction        Quintessences: AbilityPower     Seals: AbilityPower
Damage: 738.915 DPS: 53.856778425656    Glyphs: AbilityPower    Marks: AbilityPower     Quintessences: AbilityPower     Seals: CooldownReduction
Damage: 738.915 DPS: 52.704350927247    Glyphs: CriticalDamage  Marks: CriticalDamage   Quintessences: AbilityPower     Seals: AbilityPower
Damage: 738.915 DPS: 52.704350927247    Glyphs: AbilityPower    Marks: AbilityPower     Quintessences: AbilityPower     Seals: AttackDamageScaling
Damage: 738.915 DPS: 52.704350927247    Glyphs: AbilityPower    Marks: AbilityPower     Quintessences: AbilityPower     Seals: AttackDamage
Damage: 738.915 DPS: 52.704350927247    Glyphs: MagicPenetration        Marks: MagicPenetration Quintessences: AbilityPower     Seals: AbilityPower
Damage: 738.915 DPS: 52.704350927247    Glyphs: CriticalChance  Marks: CriticalChance   Quintessences: AbilityPower     Seals: AbilityPower
Damage: 738.915 DPS: 52.704350927247    Glyphs: ArmorPenetration        Marks: ArmorPenetration Quintessences: AbilityPower     Seals: AbilityPower
Damage: 738.915 DPS: 52.704350927247    Glyphs: AttackSpeed     Marks: AttackSpeed      Quintessences: AbilityPower     Seals: AbilityPower
Damage: 723.12  DPS: 51.577746077033    Glyphs: AbilityPowerScaling     Marks: AbilityPowerScaling      Quintessences: AbilityPower     Seals: AbilityPowerScaling
Damage: 721.5   DPS: 51.462196861626    Glyphs: AbilityPower    Marks: AbilityPower     Quintessences: AbilityPower     Seals: AbilityPower

TOP 20 DPS
-----------------------------
DPS: 54.408701854494    Damage: 762.81  Glyphs: AbilityPower    Marks: AbilityPower     Quintessences: AbilityPower     Seals: AbilityPower
DPS: 53.856778425656    Damage: 738.915 Glyphs: AbilityPower    Marks: AbilityPower     Quintessences: AbilityPower     Seals: CooldownReduction
DPS: 53.569340329835    Damage: 714.615 Glyphs: AbilityPower    Marks: AbilityPower     Quintessences: AbilityPower     Seals: AbilityPower
DPS: 52.993223965763    Damage: 742.965 Glyphs: AbilityPower    Marks: AbilityPower     Quintessences: AbilityPower     Seals: AbilityPowerScaling
DPS: 52.993223965763    Damage: 742.965 Glyphs: AbilityPowerScaling     Marks: AbilityPowerScaling      Quintessences: AbilityPower     Seals: AbilityPower
DPS: 52.704350927247    Damage: 738.915 Glyphs: CriticalChance  Marks: CriticalChance   Quintessences: AbilityPower     Seals: AbilityPower
DPS: 52.704350927247    Damage: 738.915 Glyphs: AttackDamage    Marks: AttackDamage     Quintessences: AbilityPower     Seals: AbilityPower
DPS: 52.704350927247    Damage: 738.915 Glyphs: HybridPenetration       Marks: HybridPenetration        Quintessences: AbilityPower     Seals: AbilityPower
DPS: 52.704350927247    Damage: 738.915 Glyphs: AttackDamageScaling     Marks: AttackDamageScaling      Quintessences: AbilityPower     Seals: AbilityPower
DPS: 52.704350927247    Damage: 738.915 Glyphs: MagicPenetration        Marks: MagicPenetration Quintessences: AbilityPower     Seals: AbilityPower
DPS: 52.704350927247    Damage: 738.915 Glyphs: CriticalDamage  Marks: CriticalDamage   Quintessences: AbilityPower     Seals: AbilityPower
DPS: 52.704350927247    Damage: 738.915 Glyphs: AbilityPower    Marks: AbilityPower     Quintessences: AbilityPower     Seals: AttackDamage
DPS: 52.704350927247    Damage: 738.915 Glyphs: ArmorPenetration        Marks: ArmorPenetration Quintessences: AbilityPower     Seals: AbilityPower
DPS: 51.288873038516    Damage: 719.07  Glyphs: AttackDamageScaling     Marks: AttackDamageScaling      Quintessences: AbilityPower     Seals: AbilityPowerScaling
DPS: 51.288873038516    Damage: 719.07  Glyphs: AttackSpeed     Marks: AttackSpeed      Quintessences: AbilityPower     Seals: AbilityPowerScaling
DPS: 51.288873038516    Damage: 719.07  Glyphs: AbilityPowerScaling     Marks: AbilityPowerScaling      Quintessences: AbilityPower     Seals: AttackDamage
DPS: 51 Damage: 715.02  Glyphs: AttackDamage    Marks: AttackDamage     Quintessences: AbilityPower     Seals: CriticalDamage
DPS: 51 Damage: 715.02  Glyphs: AttackSpeed     Marks: AttackSpeed      Quintessences: AbilityPower     Seals: AttackDamageScaling
DPS: 51 Damage: 715.02  Glyphs: AttackDamage    Marks: AttackDamage     Quintessences: AbilityPower     Seals: AttackDamageScaling
DPS: 51 Damage: 715.02  Glyphs: AttackSpeed     Marks: AttackSpeed      Quintessences: AbilityPower     Seals: CriticalDamage
*/