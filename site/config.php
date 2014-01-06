<?php
/**
 * Site configuration, this file is changed by user per site.
 *
 */

/**
 * Set level of error reporting
 */
error_reporting(-1);
ini_set('display_errors', 1);


/**
 * Set what to show as debug or developer information in the get_debug() theme helper.
 */
$wi->config['debug']['vincent'] = false;
$wi->config['debug']['session'] = false;
$wi->config['debug']['timer'] = true;
$wi->config['debug']['db-num-queries'] = true;
$wi->config['debug']['db-queries'] = true;


/**
 * Set database(s).
 */
$wi->config['database'][0]['dsn'] = 'sqlite:' . VINCENT_SITE_PATH . '/data/.ht.sqlite';


/**
 * What type of urls should be used?
 * 
 * default      = 0      => index.php/controller/method/arg1/arg2/arg3
 * clean        = 1      => controller/method/arg1/arg2/arg3
 * querystring  = 2      => index.php?q=controller/method/arg1/arg2/arg3
 */
$wi->config['url_type'] = 1;


/**
 * Set a base_url to use another than the default calculated
 */
$wi->config['base_url'] = null;


/**
 * How to hash password of new users, choose from: plain, md5salt, md5, sha1salt, sha1.
 */
$wi->config['hashing_algorithm'] = 'sha1salt';


/**
 * Allow or disallow creation of new user accounts.
 */
$wi->config['create_new_users'] = true;


/**
 * Define session name
 */
$wi->config['session_name'] = preg_replace('/[:\.\/-_]/', '', __DIR__);
$wi->config['session_key']  = 'vincent';


/**
  * Define default server timezone when displaying date and times to the user. All internals are still UTC.
 */
$wi->config['timezone'] = 'Europe/Stockholm';


/**
 * Define internal character encoding
 */
$wi->config['character_encoding'] = 'UTF-8';


/**
 * Define language
 */
$wi->config['language'] = 'en';


/**
 * Define the controllers, their classname and enable/disable them.
 *
 * The array-key is matched against the url, for example: 
 * the url 'developer/dump' would instantiate the controller with the key "developer", that is 
 * CCDeveloper and call the method "dump" in that class. This process is managed in:
 * $wi->FrontControllerRoute();
 * which is called in the frontcontroller phase from index.php.
 */
$wi->config['controllers'] = array(
  'index'     => array('enabled' => true,'class' => 'CCIndex'),
  'developer' => array('enabled' => true,'class' => 'CCDeveloper'),
  'theme'     => array('enabled' => true,'class' => 'CCTheme'),
  'guestbook' => array('enabled' => true,'class' => 'CCGuestbook'),
  'content'   => array('enabled' => true,'class' => 'CCContent'),
  'blog'      => array('enabled' => true,'class' => 'CCBlog'),
  'page'      => array('enabled' => true,'class' => 'CCPage'),	 
  'user'      => array('enabled' => true,'class' => 'CCUser'),
  'acp'       => array('enabled' => true,'class' => 'CCAdminControlPanel'),
   'module'   => array('enabled' => true,'class' => 'CCModules'),
 );


/**
 * Settings for the theme.
 */
$wi->config['theme'] = array(
  'name'    	=> 'grid',		 //The name of the theme in theme directory 
  'stylesheet'	=> 'style.php',  // maim stylsheet to include in template files
  'template_file'   => 'index.tpl.php',   // Default template file, else use default.tpl.php
    // A list of valid theme regions
  'regions' => array('flash','featured-first','featured-middle','featured-last',
    'primary','sidebar','triptych-first','triptych-middle','triptych-last',
    'footer-column-one','footer-column-two','footer-column-three','footer-column-four',
    'footer',
  ),
  
   // Add static entries for use in the template file. 
  'data' => array(
    'header' => 'Vincent',
    'slogan' => 'A PHP-based MVC-inspired CMF',
    'favicon' => 'logga_phpmvh_icon.png',
    'logo' => 'logga_phpmvh_thumb.png',
    'logo_width'  => 60,
    'logo_height' => 70,
    'footer' => '<p>Footer: &copy; Vincent by Kajvin (rowe12@student.bth.se)</p>',
  ),

);