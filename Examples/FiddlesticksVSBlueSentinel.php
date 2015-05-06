<?php

include dirname(__FILE__).'/../Configs/config.php';
include PERFECT_BUILD_ROOT.DIRECTORY_SEPARATOR.'autoload.php';

// Create a new instance of the Engine
$engine_obj = new \PerfectBuild\Engine\Engine();

// Create stats
$fiddlesticks_level = 1;
$spell_level_arr = Array(0,1,0,0);
$summoner_arr = Array('Flash', 'Smite');
$rune_arr = Array();
$masteries_arr = Array();

$blue_sentinel_level = 1;

// Create a new instance of the Champion
$fiddlesticks_obj = new \PerfectBuild\Champions\Fiddlesticks($fiddlesticks_level, $spell_level_arr, $summoner_arr, $rune_arr, $masteries_arr);

// Create a new instance of the Monster
$blue_sentinel_obj = new \PerfectBuild\Monsters\BlueSentinel($blue_sentinel_level);

// Create Timeline
$timeline = Array(
	0 => Array('subject' => $fiddlesticks_obj, 'action' => 'attack', 'object' => $blue_sentinel_obj, 'status' => 'queued'),
	1 => Array('subject' => $fiddlesticks_obj, 'action' => 'attack', 'object' => $blue_sentinel_obj, 'status' => 'queued'),
	2 => Array('subject' => $fiddlesticks_obj, 'action' => 'attack', 'object' => $blue_sentinel_obj, 'status' => 'queued'),
	3 => Array('subject' => $fiddlesticks_obj, 'action' => 'attack', 'object' => $blue_sentinel_obj, 'status' => 'queued'),
	4 => Array('subject' => $fiddlesticks_obj, 'action' => 'attack', 'object' => $blue_sentinel_obj, 'status' => 'queued'),
	5 => Array('subject' => $fiddlesticks_obj, 'action' => 'attack', 'object' => $blue_sentinel_obj, 'status' => 'queued'),
	6 => Array('subject' => $fiddlesticks_obj, 'action' => 'attack', 'object' => $blue_sentinel_obj, 'status' => 'queued'),
	7 => Array('subject' => $fiddlesticks_obj, 'action' => 'attack', 'object' => $blue_sentinel_obj, 'status' => 'queued'),
	8 => Array('subject' => $fiddlesticks_obj, 'action' => 'attack', 'object' => $blue_sentinel_obj, 'status' => 'queued'),
	9 => Array('subject' => $fiddlesticks_obj, 'action' => 'attack', 'object' => $blue_sentinel_obj, 'status' => 'queued'),
	10 => Array('subject' => $fiddlesticks_obj, 'action' => 'attack', 'object' => $blue_sentinel_obj, 'status' => 'queued'),
	11 => Array('subject' => $fiddlesticks_obj, 'action' => 'attack', 'object' => $blue_sentinel_obj, 'status' => 'queued'),
	12 => Array('subject' => $fiddlesticks_obj, 'action' => 'attack', 'object' => $blue_sentinel_obj, 'status' => 'queued'),
	13 => Array('subject' => $fiddlesticks_obj, 'action' => 'attack', 'object' => $blue_sentinel_obj, 'status' => 'queued'),
	14 => Array('subject' => $fiddlesticks_obj, 'action' => 'attack', 'object' => $blue_sentinel_obj, 'status' => 'queued'),
	15 => Array('subject' => $fiddlesticks_obj, 'action' => 'attack', 'object' => $blue_sentinel_obj, 'status' => 'queued'),
	16 => Array('subject' => $fiddlesticks_obj, 'action' => 'attack', 'object' => $blue_sentinel_obj, 'status' => 'queued'),
	17 => Array('subject' => $fiddlesticks_obj, 'action' => 'attack', 'object' => $blue_sentinel_obj, 'status' => 'queued'),
	18 => Array('subject' => $fiddlesticks_obj, 'action' => 'attack', 'object' => $blue_sentinel_obj, 'status' => 'queued'),
	19 => Array('subject' => $fiddlesticks_obj, 'action' => 'attack', 'object' => $blue_sentinel_obj, 'status' => 'queued'),
	20 => Array('subject' => $fiddlesticks_obj, 'action' => 'attack', 'object' => $blue_sentinel_obj, 'status' => 'queued'),
	21 => Array('subject' => $fiddlesticks_obj, 'action' => 'attack', 'object' => $blue_sentinel_obj, 'status' => 'queued'),
	22 => Array('subject' => $fiddlesticks_obj, 'action' => 'attack', 'object' => $blue_sentinel_obj, 'status' => 'queued')
);

$tick_rate = $engine_obj->tickRate();
$damage_per_tick = 0;
$total_damage = 0;

// Step Engine's time
for($i = 0; ($slice = $engine_obj->step()) !== false; $i++){
	
	//echo $i ." ".$slice."\n";	
	
	// Decrement any effects
	$result = $fiddlesticks_obj->tick($tick_rate);
	$damage_per_tick+= $result['total_damage'];
	$total_damage += $result['total_damage'];
	
	$result = $blue_sentinel_obj ->tick($tick_rate);
	$damage_per_tick+= $result['total_damage'];
	$total_damage += $result['total_damage'];
	
	$complete = true;	
	
	foreach($timeline as &$timeline_index){			
		
		if($timeline_index['status'] == 'queued'){
			$complete = false;
		}
		
		if($timeline_index['status'] == 'queued' && $timeline_index['subject']->free() === true){
			$result = $timeline_index['subject']->$timeline_index['action']($timeline_index['object']);
			$timeline_index['status'] = 'complete';
			$damage_per_tick+= $result['total_damage'];
			$total_damage += $result['total_damage'];
			//var_dump($result);
		}else if($timeline_index['subject']->free() === false){
			$complete = false;
		}
	}
	
	if($i % $tick_rate == 0 && $i > 0){		
		echo "Total damage: ".$total_damage. "\tTotal DPS: ".(($total_damage/$i)*$tick_rate). "\tCurrent DPS: ".$damage_per_tick."\n";
		$damage_per_tick = 0;
	}
	
	if($complete === true){
		break;
	}
	
}

// Last tidbit of tick that is not a full tick. There has to be a better way to do all of this
$i--;
echo "Total damage: ".$total_damage. "\tTotal DPS: ".(($total_damage/$i)*$tick_rate). "\tCurrent DPS: ".$damage_per_tick."\n";
