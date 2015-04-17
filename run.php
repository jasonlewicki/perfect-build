<?php

include dirname(__FILE__).'/Configs/config.php';
include PERFECT_BUILD_ROOT.DIRECTORY_SEPARATOR.'autoload.php';

// Create a new instance of the Engine
$engine_obj = new \PerfectBuild\Engine\Engine();

// Create a new instance of the Champion
$fiddlesticks_obj = new \PerfectBuild\Champions\Fiddlesticks();

// Create a new instance of the Monster
$blue_sentinel_obj = new \PerfectBuild\Monsters\BlueSentinel();



// Step Engine's time
for($i = 0; ($slice = $engine_obj->step()) !== false; $i++){
	echo $i ." ".$slice."\n";
}
