<?php

include dirname(__FILE__).'/../Configs/config.php';
include PERFECT_BUILD_ROOT.DIRECTORY_SEPARATOR.'autoload.php';

include dirname(__FILE__).'/utilities.php';

// Create a new instance of the Engine
$engine_obj = new \PerfectBuild\Engine\Engine();

// Create stats
$fiddlesticks_level = 1;
$spell_level_arr = Array(0,1,0,0);
$item_arr = Array();
$summoner_arr = Array('Flash', 'Smite');
$masteries_arr = Array();

// Create Rune Array
$runes_arr = Array(
	'Glyphs' => Array(			
		'CooldownReductionScaling',
		'MagicPenetration',
		'AbilityPowerScaling',
		'AbilityPower',
		'CooldownReduction'
	),
	'Quintessences' => Array(	
		'CooldownReductionScaling',
		'MagicPenetration',
		'AbilityPower',
		'HybridPenetration',
		'CooldownReduction'
	),
	'Seals' => Array(	
		'AbilityPowerScaling',
		'AbilityPower',
		'CooldownReduction'
	),
	'Marks' => Array(
		'ArmorPenetration',
		'MagicPenetration',
		'AbilityPowerScaling',
		'AbilityPower',
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
	$fiddlesticks_obj = new \PerfectBuild\Champions\Fiddlesticks($fiddlesticks_level, $spell_level_arr, $summoner_arr, $item_arr, $rune_arr, $masteries_arr);
	
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
	$top_damage[count($top_damage)] = Array(
		'damage' => $total_damage, 
		'dps' => ($total_damage/($slice/$tick_rate)), 
		'Glyphs' => $runes_arr['Glyphs'][$glyph_index], 
		'Marks' => $runes_arr['Marks'][$mark_index], 
		'Quintessences' => $runes_arr['Quintessences'][$quintessence_index], 
		'Seals' => $runes_arr['Seals'][$seal_index]
	);
	
	/*
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
	}*/
	
	// Top DPS
	$top_dps[count($top_dps)] = Array(
		'damage' => $total_damage, 
		'dps' => ($total_damage/($slice/$tick_rate)), 
		'Glyphs' => $runes_arr['Glyphs'][$glyph_index], 
		'Marks' => $runes_arr['Marks'][$mark_index], 
		'Quintessences' => $runes_arr['Quintessences'][$quintessence_index], 
		'Seals' => $runes_arr['Seals'][$seal_index]
	);
	
	/*if(count($top_dps) < 20){
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
	}*/
	
	/*
	if($runes_arr['Glyphs'][$glyph_index] == "AbilityPower" && $runes_arr['Marks'][$mark_index] == "MagicPenetration" && $runes_arr['Quintessences'][$quintessence_index] == "AbilityPower" && $runes_arr['Seals'][$seal_index] == "AbilityPower" ){
		echo "Total damage: ".$total_damage. "\tTotal DPS: ".($total_damage/($slice/$tick_rate)). "\tCurrent DPS: ".$damage_per_tick."\n";
	}*/
	
	$total_index++;
	
	// Exit if no more variations left
	if($glyph_index == count($runes_arr['Glyphs'])-1 && $mark_index == count($runes_arr['Marks'])-1 && $quintessence_index == count($runes_arr['Quintessences'])-1 && $seal_index == count($runes_arr['Seals'])-1){
		echo "\rProgress: ".number_format(100*($total_index/(count($runes_arr['Glyphs']) * count($runes_arr['Marks']) * count($runes_arr['Quintessences']) * count($runes_arr['Seals']))),4)."%";	
		break;
	}
	
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
}

displayResults($top_damage, $top_dps);

/*
 
20 Armor / 0 Magic Resistance
  
TOP 20 DAMAGE
-----------------------------
Damage: 762.81  DPS: 54.408701854494    Glyphs: AbilityPower    Marks: AbilityPower     Quintessences: AbilityPower     Seals: AbilityPower
Damage: 742.965 DPS: 52.993223965763    Glyphs: AbilityPower    Marks: AbilityPower     Quintessences: AbilityPower     Seals: AbilityPowerScaling
Damage: 742.965 DPS: 52.993223965763    Glyphs: AbilityPower    Marks: AbilityPowerScaling      Quintessences: AbilityPower     Seals: AbilityPower
Damage: 738.915 DPS: 53.856778425656    Glyphs: AbilityPower    Marks: AbilityPower     Quintessences: AbilityPower     Seals: CooldownReduction
Damage: 738.915 DPS: 52.704350927247    Glyphs: AbilityPower    Marks: HybridPenetration        Quintessences: AbilityPower     Seals: AbilityPower
Damage: 738.915 DPS: 52.704350927247    Glyphs: AbilityPower    Marks: ArmorPenetration Quintessences: AbilityPower     Seals: AbilityPower
Damage: 738.915 DPS: 53.351263537906    Glyphs: AbilityPower    Marks: CooldownReduction        Quintessences: AbilityPower     Seals: AbilityPower
Damage: 738.915 DPS: 52.704350927247    Glyphs: AbilityPower    Marks: MagicPenetration Quintessences: AbilityPower     Seals: AbilityPower
Damage: 723.12  DPS: 51.577746077033    Glyphs: AbilityPower    Marks: AbilityPowerScaling      Quintessences: AbilityPower     Seals: AbilityPowerScaling
Damage: 721.5   DPS: 51.462196861626    Glyphs: AbilityPowerScaling     Marks: AbilityPower     Quintessences: AbilityPower     Seals: AbilityPower
Damage: 719.07  DPS: 51.918411552347    Glyphs: AbilityPower    Marks: CooldownReduction        Quintessences: AbilityPower     Seals: AbilityPowerScaling
Damage: 719.07  DPS: 51.288873038516    Glyphs: AbilityPower    Marks: MagicPenetration Quintessences: AbilityPower     Seals: AbilityPowerScaling
Damage: 719.07  DPS: 51.288873038516    Glyphs: AbilityPower    Marks: HybridPenetration        Quintessences: AbilityPower     Seals: AbilityPowerScaling
Damage: 719.07  DPS: 51.288873038516    Glyphs: AbilityPower    Marks: ArmorPenetration Quintessences: AbilityPower     Seals: AbilityPowerScaling
Damage: 719.07  DPS: 52.410349854227    Glyphs: AbilityPower    Marks: AbilityPowerScaling      Quintessences: AbilityPower     Seals: CooldownReduction
Damage: 715.02  DPS: 52.115160349854    Glyphs: AbilityPower    Marks: ArmorPenetration Quintessences: AbilityPower     Seals: CooldownReduction
Damage: 715.02  DPS: 52.115160349854    Glyphs: AbilityPower    Marks: HybridPenetration        Quintessences: AbilityPower     Seals: CooldownReduction
Damage: 715.02  DPS: 52.730088495575    Glyphs: AbilityPower    Marks: CooldownReduction        Quintessences: AbilityPower     Seals: CooldownReduction
Damage: 715.02  DPS: 52.115160349854    Glyphs: AbilityPower    Marks: MagicPenetration Quintessences: AbilityPower     Seals: CooldownReduction
Damage: 714.615 DPS: 50.971112696148    Glyphs: MagicPenetration        Marks: AbilityPower     Quintessences: AbilityPower     Seals: AbilityPower

TOP 20 DPS
-----------------------------
DPS: 54.408701854494    Damage: 762.81  Glyphs: AbilityPower    Marks: AbilityPower     Quintessences: AbilityPower     Seals: AbilityPower
DPS: 53.856778425656    Damage: 738.915 Glyphs: AbilityPower    Marks: AbilityPower     Quintessences: AbilityPower     Seals: CooldownReduction
DPS: 53.569340329835    Damage: 714.615 Glyphs: CooldownReduction       Marks: AbilityPower     Quintessences: AbilityPower     Seals: AbilityPower
DPS: 53.351263537906    Damage: 738.915 Glyphs: AbilityPower    Marks: CooldownReduction        Quintessences: AbilityPower     Seals: AbilityPower
DPS: 52.993223965763    Damage: 742.965 Glyphs: AbilityPower    Marks: AbilityPower     Quintessences: AbilityPower     Seals: AbilityPowerScaling
DPS: 52.993223965763    Damage: 742.965 Glyphs: AbilityPower    Marks: AbilityPowerScaling      Quintessences: AbilityPower     Seals: AbilityPower
DPS: 52.928735632184    Damage: 690.72  Glyphs: CooldownReduction       Marks: AbilityPower     Quintessences: AbilityPower     Seals: CooldownReduction
DPS: 52.730088495575    Damage: 715.02  Glyphs: AbilityPower    Marks: CooldownReduction        Quintessences: AbilityPower     Seals: CooldownReduction
DPS: 52.704350927247    Damage: 738.915 Glyphs: AbilityPower    Marks: ArmorPenetration Quintessences: AbilityPower     Seals: AbilityPower
DPS: 52.704350927247    Damage: 738.915 Glyphs: AbilityPower    Marks: HybridPenetration        Quintessences: AbilityPower     Seals: AbilityPower
DPS: 52.704350927247    Damage: 738.915 Glyphs: AbilityPower    Marks: MagicPenetration Quintessences: AbilityPower     Seals: AbilityPower
DPS: 52.410349854227    Damage: 719.07  Glyphs: AbilityPower    Marks: AbilityPowerScaling      Quintessences: AbilityPower     Seals: CooldownReduction
DPS: 52.406676783005    Damage: 690.72  Glyphs: CooldownReduction       Marks: CooldownReduction        Quintessences: AbilityPower     Seals: AbilityPower
DPS: 52.172788605697    Damage: 695.985 Glyphs: AbilityPower    Marks: AbilityPower     Quintessences: CooldownReduction        Seals: AbilityPower
DPS: 52.115160349854    Damage: 715.02  Glyphs: AbilityPower    Marks: ArmorPenetration Quintessences: AbilityPower     Seals: CooldownReduction
DPS: 52.115160349854    Damage: 715.02  Glyphs: AbilityPower    Marks: HybridPenetration        Quintessences: AbilityPower     Seals: CooldownReduction
DPS: 52.115160349854    Damage: 715.02  Glyphs: AbilityPower    Marks: MagicPenetration Quintessences: AbilityPower     Seals: CooldownReduction
DPS: 52.081709145427    Damage: 694.77  Glyphs: CooldownReduction       Marks: AbilityPower     Quintessences: AbilityPower     Seals: AbilityPowerScaling
DPS: 52.081709145427    Damage: 694.77  Glyphs: CooldownReduction       Marks: AbilityPowerScaling      Quintessences: AbilityPower     Seals: AbilityPower
DPS: 51.918411552347    Damage: 719.07  Glyphs: AbilityPower    Marks: CooldownReduction        Quintessences: AbilityPower     Seals: AbilityPowerScaling

%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%  
  
20 Armor / 30 Magic Resistance  
  
TOP 20 DAMAGE
-----------------------------
Damage: 604.82524351314 DPS: 43.14017428767     Glyphs: AbilityPower    Marks: MagicPenetration Quintessences: AbilityPower     Seals: AbilityPower
Damage: 593.8876386433  DPS: 42.360031286969    Glyphs: AbilityPower    Marks: HybridPenetration        Quintessences: AbilityPower     Seals: AbilityPower
Damage: 592.89270386266 DPS: 42.289065896053    Glyphs: MagicPenetration        Marks: MagicPenetration Quintessences: AbilityPower     Seals: AbilityPower
Damage: 588.58148481624 DPS: 41.981560971201    Glyphs: AbilityPower    Marks: MagicPenetration Quintessences: AbilityPower     Seals: AbilityPowerScaling
Damage: 586.77692307692 DPS: 41.85284758038     Glyphs: AbilityPower    Marks: AbilityPower     Quintessences: AbilityPower     Seals: AbilityPower
Damage: 585.26643202095 DPS: 42.657903208524    Glyphs: AbilityPower    Marks: MagicPenetration Quintessences: AbilityPower     Seals: CooldownReduction
Damage: 581.65894736842 DPS: 41.487799384338    Glyphs: MagicPenetration        Marks: HybridPenetration        Quintessences: AbilityPower     Seals: AbilityPower
Damage: 578.68951265714 DPS: 41.275999476258    Glyphs: AbilityPower    Marks: MagicPenetration Quintessences: MagicPenetration Seals: AbilityPower
Damage: 577.93763060601 DPS: 41.222370228674    Glyphs: AbilityPower    Marks: HybridPenetration        Quintessences: AbilityPower     Seals: AbilityPowerScaling
Damage: 575.85836909871 DPS: 41.074063416456    Glyphs: MagicPenetration        Marks: MagicPenetration Quintessences: AbilityPower     Seals: AbilityPowerScaling
Damage: 574.77278211212 DPS: 40.996632105002    Glyphs: MagicPenetration        Marks: AbilityPower     Quintessences: AbilityPower     Seals: AbilityPower
Damage: 574.68252692493 DPS: 41.886481554295    Glyphs: AbilityPower    Marks: HybridPenetration        Quintessences: AbilityPower     Seals: CooldownReduction
Damage: 572.38197424893 DPS: 41.718802787823    Glyphs: MagicPenetration        Marks: MagicPenetration Quintessences: AbilityPower     Seals: CooldownReduction
Damage: 571.51153846154 DPS: 40.764018435202    Glyphs: AbilityPower    Marks: AbilityPower     Quintessences: AbilityPower     Seals: AbilityPowerScaling
Damage: 571.51153846154 DPS: 40.764018435202    Glyphs: AbilityPower    Marks: AbilityPowerScaling      Quintessences: AbilityPower     Seals: AbilityPower
Damage: 571.01170500123 DPS: 40.728366975837    Glyphs: AbilityPowerScaling     Marks: MagicPenetration Quintessences: AbilityPower     Seals: AbilityPower
Damage: 569.71263880648 DPS: 40.635708902031    Glyphs: AbilityPower    Marks: MagicPenetration Quintessences: HybridPenetration        Seals: AbilityPower
Damage: 568.39615384615 DPS: 41.039433490697    Glyphs: AbilityPower    Marks: CooldownReduction        Quintessences: AbilityPower     Seals: AbilityPower
Damage: 568.39615384615 DPS: 40.541808405574    Glyphs: AbilityPower    Marks: ArmorPenetration Quintessences: AbilityPower     Seals: AbilityPower
Damage: 568.39615384615 DPS: 41.428291096658    Glyphs: AbilityPower    Marks: AbilityPower     Quintessences: AbilityPower     Seals: CooldownReduction

TOP 20 DPS
-----------------------------
DPS: 43.14017428767     Damage: 604.82524351314 Glyphs: AbilityPower    Marks: MagicPenetration Quintessences: AbilityPower     Seals: AbilityPower
DPS: 42.657903208524    Damage: 585.26643202095 Glyphs: AbilityPower    Marks: MagicPenetration Quintessences: AbilityPower     Seals: CooldownReduction
DPS: 42.382017634876    Damage: 565.37611524924 Glyphs: CooldownReduction       Marks: MagicPenetration Quintessences: AbilityPower     Seals: AbilityPower
DPS: 42.360031286969    Damage: 593.8876386433  Glyphs: AbilityPower    Marks: HybridPenetration        Quintessences: AbilityPower     Seals: AbilityPower
DPS: 42.289065896053    Damage: 592.89270386266 Glyphs: MagicPenetration        Marks: MagicPenetration Quintessences: AbilityPower     Seals: AbilityPower
DPS: 41.981560971201    Damage: 588.58148481624 Glyphs: AbilityPower    Marks: MagicPenetration Quintessences: AbilityPower     Seals: AbilityPowerScaling
DPS: 41.886481554295    Damage: 574.68252692493 Glyphs: AbilityPower    Marks: HybridPenetration        Quintessences: AbilityPower     Seals: CooldownReduction
DPS: 41.85284758038     Damage: 586.77692307692 Glyphs: AbilityPower    Marks: AbilityPower     Quintessences: AbilityPower     Seals: AbilityPower
DPS: 41.825080747667    Damage: 545.81730375706 Glyphs: CooldownReduction       Marks: MagicPenetration Quintessences: AbilityPower     Seals: CooldownReduction
DPS: 41.718802787823    Damage: 572.38197424893 Glyphs: MagicPenetration        Marks: MagicPenetration Quintessences: AbilityPower     Seals: CooldownReduction
DPS: 41.615585070349    Damage: 555.15190483845 Glyphs: CooldownReduction       Marks: HybridPenetration        Quintessences: AbilityPower     Seals: AbilityPower
DPS: 41.487799384338    Damage: 581.65894736842 Glyphs: MagicPenetration        Marks: HybridPenetration        Quintessences: AbilityPower     Seals: AbilityPower
DPS: 41.428291096658    Damage: 568.39615384615 Glyphs: AbilityPower    Marks: AbilityPower     Quintessences: AbilityPower     Seals: CooldownReduction
DPS: 41.275999476258    Damage: 578.68951265714 Glyphs: AbilityPower    Marks: MagicPenetration Quintessences: MagicPenetration Seals: AbilityPower
DPS: 41.238895981329    Damage: 550.12687239093 Glyphs: AbilityPower    Marks: MagicPenetration Quintessences: CooldownReduction        Seals: AbilityPower
DPS: 41.222370228674    Damage: 577.93763060601 Glyphs: AbilityPower    Marks: HybridPenetration        Quintessences: AbilityPower     Seals: AbilityPowerScaling
DPS: 41.207184869104    Damage: 549.70384615385 Glyphs: CooldownReduction       Marks: AbilityPower     Quintessences: AbilityPower     Seals: AbilityPower
DPS: 41.164344569141    Damage: 549.13235655235 Glyphs: CooldownReduction       Marks: MagicPenetration Quintessences: AbilityPower     Seals: AbilityPowerScaling
DPS: 41.074063416456    Damage: 575.85836909871 Glyphs: MagicPenetration        Marks: MagicPenetration Quintessences: AbilityPower     Seals: AbilityPowerScaling
DPS: 41.068719779316    Damage: 535.94679312008 Glyphs: CooldownReduction       Marks: HybridPenetration        Quintessences: AbilityPower     Seals: CooldownReduction
*/