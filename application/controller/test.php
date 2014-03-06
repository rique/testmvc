<?php
namespace application\controller;
use libs\controller as controller;

class test extends controller\Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->setLayout();
	}
	
	public function test( $arg )
	{
		$this->getView()->set('arg', $arg );
		$this->render( 'test.php' );
	}
}
?>