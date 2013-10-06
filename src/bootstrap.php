<?php
/**
 * Bootstrapping, setting up and loading the core.
 *
 * @package VincentCore
 */

/**
 * Enable auto-load of class declarations.
 */
function autoload($aClassName) {
  $classFile = "/src/{$aClassName}/{$aClassName}.php";
	$file1 = VINCENT_SITE_PATH . $classFile;
	$file2 = VINCENT_INSTALL_PATH . $classFile;
	if(is_file($file1)) {
	  require_once($file1);
	} elseif(is_file($file2)) {
	  require_once($file2);
	}
}
spl_autoload_register('autoload');


/**
 * Helper, wrap html_entites with correct character encoding
 */
function htmlent($str, $flags = ENT_COMPAT) {
  return htmlentities($str, $flags, CLydia::Instance()->config['character_encoding']);
}