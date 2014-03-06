<?php
namespace application\controller;
use libs\controller as controller;
use application\model as model;
use application\classes as cls;

class home extends controller\Controller
{
   public function __construct()
   {
       $this->_model = new model\user();
       parent::__construct();
   }
   
   public function index()
   {
       if( !cls\user::isUserOnline() )
       {
			$this->_request->redirect( '/connection' );
       }
   }
}

?>