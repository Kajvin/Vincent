<?php
/**
 * Helpers for theming, available for all themes in their template files and functions.php.
 * This file is included right before the themes own functions.php
 */
 

/**
 * Print debuginformation from the framework.
 */
function get_debug() {
  $wi = CVincent::Instance();  
  $html = null;
  if(isset($wi->config['debug']['display-vincent']) && $wi->config['debug']['display-vincent']) {
    $html = "<hr><h3>Debuginformation</h3><p>The content of CVincent:</p><pre>" . htmlent(print_r($wi, true)) . "</pre>";
  }    
  return $html;
}


/**
 * Prepend the base_url.
 */
function base_url($url) {
  return CVincent::Instance()->request->base_url . trim($url, '/');
}


/**
 * Prepend the theme_url, which is the url to the current theme directory.
 */
function theme_url($url) {
  $wi = CVincent::Instance();
  return "{$wi->request->base_url}themes/{$wi->config['theme']['name']}/{$url}";
}


/**
 * Return the current url.
 */
function current_url() {
  return CVincent::Instance()->request->current_url;
}