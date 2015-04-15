<?php

include dirname(__FILE__).'/Configs/config.php';
include PERFECT_BUILD_ROOT.DIRECTORY_SEPARATOR.'autoload.php';

// Create a new instance of the Engine
$engine_obj = new \PerfectBuild\Engine\Engine();

// Step Engine's time
for($i = 0; ($slice = $engine_obj->step()) !== false; $i++){
	echo $i ." ".$slice."\n";
}
