<?php 

class BoklagDB
{
	const DB_USER = 'root';
	const DB_PASS = 'root';
	const DB_NAME = 'boklag_zvit';	
	const DB_HOST = 'localhost';

	private $_paramCount = 1;
	private $_params = array();

	private $_conect;
	private $_select = '*';
	private $_where = '';

	public function __construct(){
		$this->_conect = new PDO('mysql:host='.self::DB_HOST.';dbname='.self::DB_NAME, self::DB_USER, self::DB_PASS); 
	}

	public function select($field){
		if(!empty($field) && is_array($field))
			$this->_select = implode(',',$field);
		elseif(!empty($field) && is_string($field))
			$this->_select = $field;
		return $this;
	}

	public function where($field,$param = false,$compare = false){
		if($compare){
			$this->_where = "`$field` $compare :par_".$this->_paramCount;
			$this->param[$this->_paramCount] = $param;
			$this->_paramCount++;
			return $this;
		}
		if($param){
			$this->_where = $this->_where = "`$field` = :par_".$this->_paramCount;
			$this->param[$this->_paramCount] = $param;
			$this->_paramCount++;
			return $this;
		}
		if(is_array($field)){
			foreach ($field as $key => $value) {
				$this->_where .= "`$key` = :par_".$this->_paramCount." AND ";
				$this->param[$this->_paramCount] = $param;
				$this->_paramCount++;
			}
			$this->_where = substr($this->_where,0,-4);
			return $this;
		}
		return $this->_where = $field;
	}

	public function query($str){
		if(!is_string($str))
			return;
		return $this->_conect->query($str);
	}

}

// foreach ((new BoklagDB)->query('SELECT * FROM oc_category') as $row) {
// 	print_r($row);
// }
// die;