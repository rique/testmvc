<?php
namespace libs\model;
use application\classes as cls;

class Model 
{
    protected $_db;
    
    public function __construct()
    {
	$this->_db = cls\connection::getInstance();
    }
}

?>
