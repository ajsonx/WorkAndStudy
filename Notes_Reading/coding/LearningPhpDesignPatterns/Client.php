<?php
	
ini_set("display_errors","1");
ERROR_REPORTING(E_ALL);

class Client(){
	private $mobile;
	public function __construct(){
		$this->mobile = new Mobile(); //需要建立Mobile类
		echo "This is test".$this->mobile->findWhoAmI();  
	}
}

new Client();