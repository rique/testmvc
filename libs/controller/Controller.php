<?php
namespace libs\controller;
use libs\view as view;
use libs\classes as cls;

class Controller 
{
	private $_view;
	private $_view_path;
	private $_class_name;
	protected $_model;
	protected $_request;


	public function __construct()
	{
		$this->_view = view\View::getInstance();
		$this->_view instanceof view\View;
		$this->_view_path = ROOT . DS . 'public/view';
		$class = explode( '\\', get_called_class() );
		$this->_class_name = array_pop( $class );
		$this->_request = new cls\Request();
		$this->_setParams();
	}
	
	public function getView()
	{
		return $this->_view;
	}
	
	public function setLayout( $layout = 'layout.php' )
	{
		$path = '';
		if( $this->_class_name != '' )
		{
			//$path .= $this->_class_name . '/';
		}
		
		$path .= $layout;
		$this->_view->setLayout( $path );
	}
	
	public function render( $template )
	{
		$this->_view->render( $template );
	}
	
	private function _setParams()
	{
		$this->_autoLoadModel();
		$this->_autoSetTemplateDir();
	}
	
	private function _autoLoadModel()
	{
		$model = '\\application\\model\\' . $this->_class_name;
		if( class_exists( $model ) )
		{
			$this->_model = new $model;
		}
	}
	
	private function _autoSetTemplateDir()
	{
		if( $this->_class_name != '' )
		{
			$this->_view_path .= '/' . $this->_class_name;
		}
		
		$this->_view->setTemplateDir( $this->_view_path );
	}
}

?>