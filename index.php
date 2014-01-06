<?php
/**
 * All requests routed through here. This is an overview of what actaully happens during
 * a request.
 *
 * @package VincentCore
 */
 
 //------------------------------------
//
// PHASE: BOOTSTRAP
//
define('VINCENT_INSTALL_PATH', dirname(__FILE__));
define('VINCENT_SITE_PATH', VINCENT_INSTALL_PATH . '/site');

require(VINCENT_INSTALL_PATH.'/src/bootstrap.php');

$wi = CVincent::Instance();


//----------------------------------------------
//
// PHASE: FRONTCONTROLLER ROUTE
//
$wi->FrontControllerRoute();

//____________________________________
// PHASE: THEME ENGINE RENDER
//


$wi->ThemeEngineRender();