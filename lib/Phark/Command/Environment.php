<?php

namespace Phark\Command;

class Environment
{
	public function summary()
	{
		return 'Shows the paths and environment used by phark';
	}

	public function execute($args, $shell)
	{
		$env = new \Phark\Environment();

		$shell
			->printf("Phark Environment\n")
			->printf("  - PHARK VERSION: %s\n", \Phark::VERSION)
			->printf("  - PHP VERSION: %s\n", phpversion())
			->printf("  - INSTALLATION DIRECTORY: %s\n", $env->installDir())
			->printf("  - PHP EXECUTABLE: %s\n", trim(`which php`))
			->printf("  - EXECUTABLE DIRECTORY: %s\n", $env->executableDir())
			->printf("  - PACKAGE DIRS: \n")
			;

		foreach($env->packageDirs() as $path)
			$shell->printf("    - $path\n");

		$shell->printf("  - SOURCES: \n");

		foreach($env->remoteSources() as $source)
			$shell->printf("    - $source\n");

		$shell->printf("  - INCLUDE PATHS: \n");

		foreach(explode(PATH_SEPARATOR,get_include_path()) as $path)
			if($path != '.') 
				$shell->printf("    - $path\n");


	}
}

