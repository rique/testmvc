<?php

/*
* project classes autoloader
* load : models, controllers, classes...
*/
require_once("application/config/constants.php");

spl_autoload_register(function( $class )
{
	$class = str_replace( '\\', DS, $class );
	$path = ROOT . DS;
	$fullpath = $path.$class.'.php';
	if( file_exists( $fullpath ) )
	{
		require_once( $fullpath );
	}
});

require_once("application/config/routes.php");
?>