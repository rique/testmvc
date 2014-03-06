<?php
namespace application\classes;
use \PDO as PDO;
class connection
{
    private static $_instance;

    private $_pdo;
    private $_dsn;
    private $_username;
    private $_passwd;

    private function __construct()
    {
	    $this->_defineParams();
	    $this->_pdo = new PDO( $this->_dsn, $this->_username, $this->_passwd );

	    $this->_pdo->exec( 'SET NAMES UTF8' );
    }


    public static function &getInstance()
    {
	    if( !self::$_instance instanceof self )
	    {

		    self::$_instance = new self();
	    }

	    return self::$_instance;
    }

    public function query( $sql, $data = array() )
    {
	    $qry = $this->_pdo->prepare( $sql );
	    if( !$qry->execute( $data ) )
	    {
		    $error = $qry->errorInfo();
		    $nb_params = count( $data );
		    $param_display = var_export( $data, TRUE );
		    $message = "Unable to execute {$sql} query : {$error[2]}\r\n";
		    $message .= "numbers of params bound : {$nb_params}\r\n";
		    $message .= "params struct : {$param_display}";
		    throw new PDOException( $message );
		    return FALSE;
	    }

	    return $qry;
    }

    public function select( $sql )
    {
	    $query = $this->_pdo->query( $sql );

	    return $query;
    }

    public function execute( $sql )
    {
	    try 
	    {
		    $this->_pdo->exec($sql);
	    }  
	    catch ( Exception $e )
	    {
		    echo $e->getMessage();
		    echo $e->getTraceAsString();
	    }

    }

    public function insert( $sql )
    {
	    try 
	    {
		    $this->_pdo->exec($sql);
		    return $this->_pdo->lastInsertId();
	    }  
	    catch ( Exception $e )
	    {
		    echo $e->getMessage();
		    echo $e->getTraceAsString();
	    }
    }

    public function getPdoInstance()
    {
	    return $this->_pdo;
    }

    public function getLastInsertId( $name = NULL )
    {
	    return $this->_pdo->lastInsertId( $name );
    }

    public function quote( $str )
    {
	    return $this->_pdo->quote( $str );
    }

    private function _defineParams()
    {
	    //$this->_dsn = 'mysql:host='.config::get( 'sql_'.ENVIRONMENT.'.server').';dbname='.config::get('sql_'.ENVIRONMENT.'.database' );
	    $this->_dsn = 'mysql:host=localhost;dbname=site_test';
	    $this->_username = 'root';
	    $this->_passwd = '';
	    //var_dump($this->_dsn,$this->_username,$this->_passwd);
    }

    public function __get( $name )
    {
	    return $this->$name;
    }
    
    public function __call($name, $arguments) {
        $matches = array();
        if( preg_match( "#call([a-z]+)Proc#i", $name, $matches ) )
        {
            unset( $matches[0] );
            $proc = $matches[1];
            $args = '';
            
            if( count( $arguments ) > 0 )
            {
		$sep = '';
                foreach( $arguments as $arg )
                {
		    $args .= $sep.'"'.$arg.'"';
		    $sep = ',';
                }
            }
			
            $sql = "CALL {$proc}($args)";
            return $this->query($sql);
        }
    }
}
?>
