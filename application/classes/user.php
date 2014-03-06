<?php
namespace application\classes;

class user 
{
    public static function isUserOnline()
    {
	return isset( $_SESSION['usr_id'] );
    }
}

?>
