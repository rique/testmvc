<?php

/*
* loade common classes
* note : use of anonymous function to avoid function name conflicts
*
*/
spl_autoload_register(function( $class )
{
	$class = str_replace( '\\', DS, $class );
	$pathes = explode( PS, ini_get('include_path') );
	$root = ROOT;
	foreach( $pathes as $path )
	{
		$fullpath = $root.DS.$path;
		
		$classname = $fullpath.DS.$class;
		if( file_exists( $classname . '.php' ) )
		{
			require_once( $classname . '.php' );
		}
	}
});

/*
* project classes autoloader
* load : models, controllers, classes...
*/
spl_autoload_register(function( $class )
{
	$class = str_replace( '\\', DS, $class );
	$path = ROOT.DS.'lol'.DS;
	$fullpath = $path.$class.'.php';
	if( file_exists( $fullpath ) )
	{
		require_once( $fullpath );
	}
});

require_once("application/config/constants.php");
require_once("application/config/routes.php");
?>