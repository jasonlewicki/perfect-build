<?php

include dirname(__FILE__).'/Configs/config.php';
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
	6 => Array('subject' => $fiddlesticks_obj, 'action' => 'attack', 'object' => $blue_sentinel_obj, 'status' => 'queued')
);

$tick_rate = $engine_obj->tickRate();

// Step Engine's time
for($i = 0; ($slice = $engine_obj->step()) !== false; $i++){
	//echo $i ." ".$slice."\n";
	
	foreach($timeline as &$timeline_index){
			
		// Decrement any effects
		$fiddlesticks_obj->tick($tick_rate);
		$blue_sentinel_obj ->tick($tick_rate);
		
		if($timeline_index['status'] = 'queue' && $timeline_index['subject']->free() === true){
			$timeline_index['subject']->$timeline_index['subject']['action']($timeline_index['subject']['object']);
			$timeline_index['status'] = 'complete';
		}
	}
	
}
