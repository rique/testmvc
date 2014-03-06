<?php
	namespace libs\classes;
	
	/**
	* Class Route, manage the diferents routes defined
	* @author enrique arteaga
	*/
	class Route
	{
		
		private $_routes = array();
		private $_request;
		
		public function __construct()
		{
			$this->_request = new Request();
		}
		
		/**
		*	adds a new definiton route
		*	@param Router object $route
		*   @return the current Route instance
		*/
		public function add( Router $route )
		{
			$this->_routes[] = $route;
			unset( $route );
			return $this;
		}
		
		/**
		*	will execute each defined route untile one match with the requested uri is found
		*	@param void
		*/
		public function exec()
		{
			if( count( $this->_routes ) > 0 )
			{
				$uri = $this->_request->getUri();
				
				if( $uri != '' )
				{
					$find = FALSE;
					foreach( $this->_routes as $route )
					{
						$find = $route->dispatch( $uri );
						
						if( $find )
						{
							break;
						}
					}
					
					if( !$find )
					{
						//TODO : a method that calls the default 404 controller and its display method
						echo 'ERROR 404';
						var_dump($uri, $this->_routes);
					}
				}
			}
		}
	}
?>