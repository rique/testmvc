<?php
namespace libs\view;

class View 
{
	private $_data = array();
	private $_template_dir;
	private $_layout;
	private $_template;
	private $_content_for_layout;
	private static $_instace;
	
	private function __construct()
	{}
	
	public static function getInstance()
	{
		if( !self::$_instace instanceof self )
		{
			self::$_instace = new self();
		}
		
		return self::$_instace;
	}
	
	public function set( $name, $val )
	{
		$this->_data[$name] = $val;
	}
	
	public function setTemplateDir( $path )
	{
		$real_path = preg_replace( "#([/\\\\]+)#", DS, $path );
		if( !is_dir( $real_path ) )
		{
		    var_dump($real_path);
			throw new \Exception( "$path is not a valid directory !" );
		}
		
		$this->_template_dir = $path;
	}
	
	public function setLayout( $layout )
	{
		$this->_layout = $layout;
	}
	
	public function render( $file )
	{
		$viewpath = $this->getViewPath( $file );
		if( file_exists( $viewpath ) )
		{
			extract( $this->_data );
			ob_start();
			require_once $viewpath;
			$this->_content_for_layout = ob_get_clean();
			$this->layout();
		}
	}
	
	public function getViewPath( $file )
	{
		$path = $this->_template_dir . '/' . $file;
		return preg_replace( "#([/\\\\]+)#", DS, $path );
	}
	
	private function layout()
	{
		$layout = preg_replace( "#([/\\\\]+)#", DS, $this->_template_dir . '/' . $this->_layout );
		require_once $layout;
		exit;
	}
}

?>
