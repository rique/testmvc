<?php
	namespace libs\classes;
	
	class Request
	{
	    private $_uri;
	    private $_mode_project = TRUE;

	    public function __construct()
	    {
		    $this->_uri = $_SERVER['REQUEST_URI'];
	    }

	    public function getUri()
	    {
		    if( $this->_mode_project )
			    $this->_uri = str_replace( PROJECT_NAME, '', $this->_uri );
		    return $this->_uri;
	    }

	    public function setModeProject( $val )
	    {
		    $this->_mode_project = (bool) $val;
	    }
	    
	    public function redirect( $url, $r = '301' )
	    {
		header('Location:'.$url,$r);exit;
	    }
	}
?>