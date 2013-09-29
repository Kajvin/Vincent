<?php
//
// PHASE: BOOTSTRAP
//
define('VINCENT_INSTALL_PATH', dirname(__FILE__));
define('VINCENT_SITE_PATH', VINCENT_INSTALL_PATH . '/site');

require(VINCENT_INSTALL_PATH.'/src/CVincent/bootstrap.php');

$wi = CVincent::Instance();

//
// PHASE: FRONTCONTROLLER ROUTE
//
$wi->FrontControllerRoute();


//
// PHASE: THEME ENGINE RENDER
//
$wi->ThemeEngineRender();
