<?php

/**
 * KreativanBlueprint.info.php
 *
 * Return information about this module.
 *
 * If preferred, you can use a getModuleInfo() method in your module file,
 * or you can use a ModuleName.info.json file (if you prefer JSON definition).
 *
 */

$info = array(

	// Your module's title
	'title' => 'Kreativan: Blueprint',

	// A 1 sentence description of what your module does
	'summary' => 'Manage main menu.',

	// Module version number: use 1 for 0.0.1 or 100 for 1.0.0, and so on
	'version' => 1,

	// Name of person who created this module (change to your name)
	'author' => 'Ivan Milincic',

	// Icon to accompany this module (optional), uses font-awesome icon names, minus the "fa-" part
	'icon' => 'bars',

	// URL to more info: change to your full modules.processwire.com URL (if available), or something else if you prefer
	'href' => 'http://modules.processwire.com/',

	// page that you want created to execute this module
	'page' => array(
		'name' => 'kreativan-blueprint',
		'parent' => '',
		'title' => 'Kreativan Blueprint'
    ),
    
    'singular' => true,
    'autoload' => true, // need for Redirect
	
	// dependency
	'requires' => "KreativanHelper",

	// for more options that you may specify here, see the file: /wire/core/Process.php
	// and the file: /wire/core/Module.php

);
