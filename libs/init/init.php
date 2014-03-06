<?php
if( !defined( 'DS' ) )
	define( 'DS', DIRECTORY_SEPARATOR );

if( !defined( 'PS' ) )
	define( 'PS', PATH_SEPARATOR );

if( !defined( 'ROOT' ) )
{
	$root = $_SERVER['DOCUMENT_ROOT'];
	$root = preg_replace( "#([/\\\\]+)#", DS, $root );
	$root = rtrim( $root, DS );
	define( 'ROOT', $root );
}
?>