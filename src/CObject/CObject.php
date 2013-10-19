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
	public $config;
	public $request;
	public $data;
	public $db;
	public $views;
	public $session;


	/**
	 * Constructor
	 */
	protected function __construct() {
    $wi = CVincent::Instance();
    $this->config   = &$wi->config;
    $this->request  = &$wi->request;
    $this->data     = &$wi->data;
    $this->db       = &$wi->db;
    $this->views    = &$wi->views;
    $this->session  = &$wi->session;
  }


	/**
	 * Redirect to another url and store the session
	 */
	protected function RedirectTo($url) {
    $wi = CVincent::Instance();
    if(isset($wi->config['debug']['db-num-queries']) && $wi->config['debug']['db-num-queries'] && isset($wi->db)) {
      $this->session->SetFlash('database_numQueries', $this->db->GetNumQueries());
    }    
    if(isset($wi->config['debug']['db-queries']) && $wi->config['debug']['db-queries'] && isset($wi->db)) {
      $this->session->SetFlash('database_queries', $this->db->GetQueries());
    }    
    if(isset($wi->config['debug']['timer']) && $wi->config['debug']['timer']) {
	    $this->session->SetFlash('timer', $wi->timer);
    }    
    $this->session->StoreInSession();
    header('Location: ' . $this->request->CreateUrl($url));
  }


 /**
         * Redirect to a method within the current controller. Defaults to index-method. Uses RedirectTo().
         *
         * @param string method name the method, default is index method.
         */
        protected function RedirectToController($method=null) {
    $this->RedirectTo($this->request->controller, $method);
  }


        /**
         * Redirect to a controller and method. Uses RedirectTo().
         *
         * @param string controller name the controller or null for current controller.
         * @param string method name the method, default is current method.
         */
        protected function RedirectToControllerMethod($controller=null, $method=null) {
          $controller = is_null($controller) ? $this->request->controller : null;
          $method = is_null($method) ? $this->request->method : null;          
    $this->RedirectTo($this->request->CreateUrl($controller, $method));
  }


}
  