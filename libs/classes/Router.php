<?php
	namespace libs\classes;
	
	class Router
	{
		private $_pattern;
		private $_action = 'index';
		private $_controller;
		private $_args = array();
		
		
		public function __construct( $pattern, array $params, array $args = array() )
		{
			$this->_pattern = $pattern;
			$this->_controller = $params['controller'];
			if( isset( $params['action'] ) && $params['action'] != '' )
				$this->_action = $params['action'];
			$this->_args = $args;
		}
		
		public function dispatch( $uri )
		{
			$match = array();
			if( preg_match( "#^{$this->_pattern}$#", $uri, $match ) )
			{
				$class = '\\application\\controller\\'.$this->_controller;
				unset($match[0]);
				if( class_exists( $class ) )
				{
					$reflection = new \ReflectionClass( $class );
					
					if( $reflection->hasMethod( $this->_action ) )
					{
						$args = array();
						
						if( count( $this->_args ) > 0 && count( $match ) > 0 )
						{
							foreach( $match as $arg )
							{
								$args[] = $arg;
							}
						}
						$method = $reflection->getMethod( $this->_action );
						$method->invokeArgs( new $class, $args );
						return TRUE;
					}
					else
					{
						throw new \Exception("{$class} has no method {$method_name}");
					}
				}
				else
				{
					throw new \Exception("no class {$class} found");
				}
			}
			
			return FALSE;
		}
		
		/*public function __get( $property )
		{
			if( isset( $this->$property ) )
			{
				return $this->$property;
			}
		}*/
	}
?>