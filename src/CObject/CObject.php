<?php
/**
 * Holding a instance of CVincent to enable use of $this in subclasses and provide some helpers.
 *
 * @package VincentCore
 */
class CObject {

        /**
         * Members
         */
        protected $wi;
        protected $config;
        protected $request;
        protected $data;
        protected $db;
        protected $views;
        protected $session;
        protected $user;


        /**
         * Constructor, can be instantiated by sending in the $wi reference.
         */
        protected function __construct($wi=null) {
          if(!$wi) {
            $wi = CVincent::Instance();
          }
          $this->wi       = &$wi;
    $this->config   = &$wi->config;
    $this->request  = &$wi->request;
    $this->data     = &$wi->data;
    $this->db       = &$wi->db;
    $this->views    = &$wi->views;
    $this->session  = &$wi->session;
    $this->user     = &$wi->user;
        }


        /**
         * Wrapper for same method in CVincent. See there for documentation.
         */
        protected function RedirectTo($urlOrController=null, $method=null, $arguments=null) {
    $this->wi->RedirectTo($urlOrController, $method, $arguments);
  }


        /**
         * Wrapper for same method in CVincent. See there for documentation.
         */
        protected function RedirectToController($method=null, $arguments=null) {
    $this->wi->RedirectToController($method, $arguments);
  }


        /**
         * Wrapper for same method in CVincent. See there for documentation.
         */
        protected function RedirectToControllerMethod($controller=null, $method=null, $arguments=null) {
    $this->wi->RedirectToControllerMethod($controller, $method, $arguments);
  }


        /**
         * Wrapper for same method in CVincent. See there for documentation.
         */
  protected function AddMessage($type, $message, $alternative=null) {
    return $this->wi->AddMessage($type, $message, $alternative);
  }


        /**
         * Wrapper for same method in CVincent. See there for documentation.
         */
        protected function CreateUrl($urlOrController=null, $method=null, $arguments=null) {
    return $this->wi->CreateUrl($urlOrController, $method, $arguments);
  }


}
  