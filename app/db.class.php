<?php

  Class db
  {
  	public $conn     = null;
    public $params   = array();

  	function __construct()
  	{

  	}

  	public function connection($host, $database, $user, $pass)
  	{
  		try
  		{
	  		$this->conn = new PDO(sprintf('mysql:host=%s;dbname=%s', $host, $database), $user, $pass);
  		}catch(PDOException $e)
  		{
  			throw new Exception($e->getMessage(), 1);  			
  		}
  	}
    
    //http://jaswanttak.wordpress.com/2010/04/23/php-associative-array-push/
    static public function array_push_assoc($array, $key, $value)
    {
      $array[$key] = $value;
      return $array;
    }  

    private function flatParams()
    {
      $params = array();
      foreach($this->params as $key => $value)
      {
        if($value > 0)
        {
          $params = self::array_push_assoc($params, $key, $value);
        }
      }
      return $params;
    }   

  	public function getRows($query, $params = null)
  	{
  		try
  		{  			
        //$to  = ($params == null) ? $this->flatParams() : $params;
        $sql = $this->conn->prepare($query);	
        $sql->execute($this->params); 
        return $sql->fetchAll();

  		}catch(PDOException $e)
  		{
		  	throw new Exception($e->getMessage(), 1);
  		}
  	}
  }