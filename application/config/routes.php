<?php
	use \libs\classes as cls;
	
	$route = new cls\Route();
	$route->add( new cls\Router( '/', array('controller' => 'home', 'action' => 'index' ) ) );
	$route->add( new cls\Router( '/test-p([0-9]+)', array( 'controller' => 'test', 'action' => 'test' ),array( 'test' ) ) );
	
	$route->exec();
?>