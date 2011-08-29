<?php

class Contractor extends FastModel{
	public static $layout = 'Contractors';
	
	public static $id = 'ContractorID';
	
	public function __construct() {
		
	}
	
	public static function getByEmail($userName) {
		return self::where(array('Email' => '=='.str_replace("@","\@",$userName)), true);
	}
	
}
?>