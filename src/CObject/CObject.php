<?php
/**
* Holding a instance of CVincent to enable use of $this in subclasses.
*
* @package VincentCore
*/
class CObject {

   /**
    * Members
    */
   public $config;
   public $request;
   public $data;
   public $db;
   

   /**
    * Constructor
    */
   protected function __construct() {
    $wi = CVincent::Instance();
    $this->config   = &$wi->config;
    $this->request  = &$wi->request;
    $this->data     = &$wi->data;
    $this->db       = &$wi->db;
  }

}