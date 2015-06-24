<?php

include dirname(__FILE__).'/../Configs/config.php';
include PERFECT_BUILD_ROOT.DIRECTORY_SEPARATOR.'autoload.php';

include dirname(__FILE__).'/utilities.php';

// Create a new instance of the Engine
$engine_obj = new \PerfectBuild\Engine\Engine();